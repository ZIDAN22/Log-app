<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments with search and filters
     */
    public function index(Request $request)
    {
        $query = Payment::with('invoice', 'verifiedBy');

        // Search by payment code or invoice number
        if ($search = $request->query('search')) {
            $query->where(function ($sub) use ($search) {
                $sub->where('payment_code', 'like', "%{$search}%")
                    ->orWhereHas('invoice', function ($invoiceQuery) use ($search) {
                        $invoiceQuery->where('invoice_number', 'like', "%{$search}%")
                            ->orWhere('customer_name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        // Filter by date range
        if ($from = $request->query('from')) {
            $query->whereDate('payment_date', '>=', $from);
        }

        if ($to = $request->query('to')) {
            $query->whereDate('payment_date', '<=', $to);
        }

        // Summary statistics
        $summary = [
            'total' => Payment::count(),
            'pending' => Payment::where('status', Payment::STATUS_PENDING)->count(),
            'verified' => Payment::where('status', Payment::STATUS_VERIFIED)->count(),
            'total_amount' => Payment::sum('amount_paid'),
        ];

        $payments = $query->orderBy('payment_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $statuses = Payment::STATUSES;

        return view('payments.index', compact('payments', 'summary', 'statuses'));
    }

    /**
     * Show the form for creating a new payment
     */
    public function create()
    {
        // Get only invoices that are not yet fully paid and don't have payment record
        $invoices = Invoice::where('payment_status', '!=', Invoice::STATUS_PAID)
            ->with('packingList', 'payment')
            ->get()
            ->filter(function ($invoice) {
                return !$invoice->payment;
            })
            ->values();

        return view('payments.create', compact('invoices'));
    }

    /**
     * Store a newly created payment in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'payment_date' => 'required|date',
            'amount_paid' => 'required|numeric|min:0.01',
            'proof_payment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'notes' => 'nullable|string|max:500',
        ]);

        $invoice = Invoice::findOrFail($validated['invoice_id']);

        // Check if invoice already has payment
        if ($invoice->payment) {
            return back()->withInput()->withErrors(['invoice_id' => 'Invoice ini sudah memiliki data pembayaran.']);
        }

        // Validate amount doesn't exceed invoice total
        if ($validated['amount_paid'] > $invoice->grand_total) {
            return back()->withInput()->withErrors(['amount_paid' => 'Nominal pembayaran tidak boleh melebihi total invoice.']);
        }

        // Generate payment code
        $paymentCode = Payment::generatePaymentCode();

        $paymentData = [
            'invoice_id' => $validated['invoice_id'],
            'payment_code' => $paymentCode,
            'payment_date' => $validated['payment_date'],
            'amount_paid' => $validated['amount_paid'],
            'notes' => $validated['notes'],
            'status' => Payment::STATUS_PENDING,
        ];

        // Handle proof of payment upload
        if ($request->hasFile('proof_payment')) {
            $paymentData['proof_payment'] = $request->file('proof_payment')->store('payments', 'public');
        }

        $payment = Payment::create($paymentData);

        // Auto-update invoice payment status
        $this->updateInvoicePaymentStatus($invoice, $payment);

        return redirect()
            ->route('payments.show', $payment)
            ->with('success', 'Pembayaran berhasil dicatat. Kode Pembayaran: ' . $paymentCode);
    }

    /**
     * Display the specified payment
     */
    public function show(Payment $payment)
    {
        $payment->load(['invoice.packingList.shipment', 'verifiedBy']);

        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified payment
     */
    public function edit(Payment $payment)
    {
        $payment->load('invoice');

        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified payment in storage
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'payment_date' => 'required|date',
            'amount_paid' => 'required|numeric|min:0.01',
            'proof_payment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'notes' => 'nullable|string|max:500',
        ]);

        $invoice = $payment->invoice;

        // Validate amount doesn't exceed invoice total
        if ($validated['amount_paid'] > $invoice->grand_total) {
            return back()->withInput()->withErrors(['amount_paid' => 'Nominal pembayaran tidak boleh melebihi total invoice.']);
        }

        // Update payment data
        $payment->payment_date = $validated['payment_date'];
        $payment->amount_paid = $validated['amount_paid'];
        $payment->notes = $validated['notes'];

        // Handle proof of payment upload
        if ($request->hasFile('proof_payment')) {
            // Delete old file if exists
            if ($payment->proof_payment) {
                Storage::disk('public')->delete($payment->proof_payment);
            }
            $payment->proof_payment = $request->file('proof_payment')->store('payments', 'public');
        }

        $payment->save();

        // Re-update invoice payment status based on new payment data
        $this->updateInvoicePaymentStatus($invoice, $payment);

        return redirect()
            ->route('payments.show', $payment)
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified payment from storage
     */
    public function destroy(Payment $payment)
    {
        $invoice = $payment->invoice;
        $paymentCode = $payment->payment_code;

        // Delete proof payment file if exists
        if ($payment->proof_payment) {
            Storage::disk('public')->delete($payment->proof_payment);
        }

        // Reset invoice payment status
        $invoice->update(['payment_status' => Invoice::STATUS_UNPAID]);

        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->with('success', "Pembayaran {$paymentCode} berhasil dihapus dan status invoice direset.");
    }

    /**
     * Verify a payment (mark as verified)
     */
    public function verify(Request $request, Payment $payment)
    {
        $payment->update([
            'status' => Payment::STATUS_VERIFIED,
            'verified_by' => auth()->id(),
        ]);

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    /**
     * Auto-update invoice payment status based on payment amount
     */
    private function updateInvoicePaymentStatus(Invoice $invoice, Payment $payment): void
    {
        $amountPaid = $payment->amount_paid;
        $totalInvoice = $invoice->grand_total;

        if ($amountPaid == 0) {
            $status = Invoice::STATUS_UNPAID;
        } elseif ($amountPaid >= $totalInvoice) {
            $status = Invoice::STATUS_PAID;
        } else {
            $status = Invoice::STATUS_DP;
        }

        $invoice->update(['payment_status' => $status]);
    }

    /**
     * Get invoice data for create form (AJAX)
     */
    public function getInvoiceData(Invoice $invoice)
    {
        // Check if invoice already has payment
        if ($invoice->payment) {
            return response()->json(['error' => 'Invoice ini sudah memiliki pembayaran'], 422);
        }

        return response()->json([
            'invoice_number' => $invoice->invoice_number,
            'customer_name' => $invoice->customer_name,
            'payment_method' => $invoice->payment_method,
            'grand_total' => $invoice->grand_total,
            'payment_status' => $invoice->payment_status,
        ]);
    }
}
