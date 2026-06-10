<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\PackingList;
use App\Models\Shipment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with('packingList.shipment');

        if ($search = $request->query('search')) {
            $query->where(function ($sub) use ($search) {
                $sub->where('invoice_number', 'like', "%{$search}%")
                    ->orWhere('receipt_number', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }

        if ($paymentStatus = $request->query('payment_status')) {
            $query->where('payment_status', $paymentStatus);
        }

        if ($from = $request->query('from')) {
            $query->whereDate('invoice_date', '>=', $from);
        }

        if ($to = $request->query('to')) {
            $query->whereDate('invoice_date', '<=', $to);
        }

        $summary = [
            'total' => Invoice::count(),
            'unpaid' => Invoice::where('payment_status', Invoice::STATUS_UNPAID)->count(),
            'dp' => Invoice::where('payment_status', Invoice::STATUS_DP)->count(),
            'paid' => Invoice::where('payment_status', Invoice::STATUS_PAID)->count(),
        ];

        $invoices = $query->orderBy('invoice_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('invoices.index', compact('invoices', 'summary'));
    }

    public function create()
    {
        $packingLists = PackingList::with('shipment', 'items')
            ->doesntHave('invoice')
            ->orderBy('packing_date', 'desc')
            ->get();

        return view('invoices.create', compact('packingLists'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'packing_list_id' => 'required|exists:packing_lists,id|unique:invoices,packing_list_id',
            'invoice_number' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'payment_status' => 'required|in:' . implode(',', Invoice::PAYMENT_STATUSES),
            'payment_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'bank_account_name' => 'nullable|string|max:255',
            'delivery_fee' => 'nullable|numeric|min:0',
            'proof_of_payment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $packingList = PackingList::with('shipment')->findOrFail($validated['packing_list_id']);

        if ($packingList->invoice) {
            return back()->withInput()->withErrors(['packing_list_id' => 'Packing List ini sudah memiliki invoice.']);
        }

        $shipment = $packingList->shipment;
        $invoiceNumber = $shipment->invoice_number ?: Shipment::generateInvoiceNumber();
        $receiptNumber = $shipment->receipt_number ?: Shipment::generateReceiptNumber();
        $customerName = $shipment->receiver_name ?: $shipment->sender_name ?: 'Pelanggan';

        $deliveryFee = $validated['delivery_fee'] ?? 0;
        $transportPricePerKg = $shipment->price_per_kg ?? 0;
        $baseTransport = round($transportPricePerKg * $packingList->total_weight, 2);
        $baseTotal = round($baseTransport + $deliveryFee, 2);
        $ppnAmount = round($baseTotal * 0.011, 2);
        $pphAmount = round($baseTotal * 0.02, 2);
        $grandTotal = round($baseTotal + $ppnAmount - $pphAmount, 2);

        $data = [
            'packing_list_id' => $packingList->id,
            'invoice_number' => $invoiceNumber,
            'receipt_number' => $receiptNumber,
            'invoice_date' => $validated['invoice_date'],
            'customer_name' => $customerName,
            'transportation_type' => $shipment->transportation_type,
            'payment_status' => $validated['payment_status'],
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'],
            'bank_name' => $validated['bank_name'] ?? null,
            'bank_account_number' => $validated['bank_account_number'] ?? null,
            'bank_account_name' => $validated['bank_account_name'] ?? null,
            'total_qty' => $packingList->total_qty,
            'total_weight' => $packingList->total_weight,
            'total_value' => $packingList->total_value,
            'delivery_fee' => $deliveryFee,
            'ppn_amount' => $ppnAmount,
            'pph_amount' => $pphAmount,
            'grand_total' => $grandTotal,
        ];

        if ($request->hasFile('proof_of_payment')) {
            $data['proof_of_payment'] = $request->file('proof_of_payment')->store('invoice-proofs', 'public');
        }

        $invoice = Invoice::create($data);

        return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice berhasil dibuat.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('packingList.items');

        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $invoice->load('packingList.items');

        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_date' => 'required|date',
            'payment_status' => 'required|in:' . implode(',', Invoice::PAYMENT_STATUSES),
            'payment_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'bank_account_name' => 'nullable|string|max:255',
            'delivery_fee' => 'nullable|numeric|min:0',
            'proof_of_payment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $deliveryFee = $validated['delivery_fee'] ?? 0;

        $invoice->load('packingList.shipment');
        $shipment = $invoice->packingList->shipment;
        $transportPricePerKg = $shipment->price_per_kg ?? 0;
        $baseTransport = round($transportPricePerKg * $invoice->total_weight, 2);
        $baseTotal = round($baseTransport + $deliveryFee, 2);
        $ppnAmount = round($baseTotal * 0.011, 2);
        $pphAmount = round($baseTotal * 0.02, 2);
        $grandTotal = round($baseTotal + $ppnAmount - $pphAmount, 2);

        $data = [
            'invoice_date' => $validated['invoice_date'],
            'payment_status' => $validated['payment_status'],
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'],
            'bank_name' => $validated['bank_name'] ?? null,
            'bank_account_number' => $validated['bank_account_number'] ?? null,
            'bank_account_name' => $validated['bank_account_name'] ?? null,
            'delivery_fee' => $deliveryFee,
            'ppn_amount' => $ppnAmount,
            'pph_amount' => $pphAmount,
            'grand_total' => $grandTotal,
        ];

        if ($request->hasFile('proof_of_payment')) {
            if ($invoice->proof_of_payment) {
                Storage::disk('public')->delete($invoice->proof_of_payment);
            }
            $data['proof_of_payment'] = $request->file('proof_of_payment')->store('invoice-proofs', 'public');
        }

        $invoice->update($data);

        return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice berhasil diperbarui.');
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->proof_of_payment) {
            Storage::disk('public')->delete($invoice->proof_of_payment);
        }

        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dihapus.');
    }

    public function printPdf(Invoice $invoice)
    {
        $invoice->load('packingList.items', 'packingList.shipment');

        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream($invoice->receipt_number . '.pdf');
    }
}
