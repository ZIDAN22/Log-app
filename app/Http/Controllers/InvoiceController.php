<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\PackingList;
use App\Models\Shipment;
use App\Models\PaymentMethod;
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

        $paymentMethods = PaymentMethod::where('status', PaymentMethod::STATUS_ACTIVE)
            ->orderBy('method_name')
            ->get();

        return view('invoices.create', compact('packingLists', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'packing_list_id' => 'required|exists:packing_lists,id|unique:invoices,packing_list_id',
            'invoice_number' => 'nullable|string|max:255',

            'invoice_date' => 'required|date',
            'payment_status' => 'required|in:' . implode(',', Invoice::PAYMENT_STATUSES),
            'payment_method_id' => 'nullable|exists:payment_methods,id',
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

        // Ambil nominal PPN/PPH dari shipment jika tersedia (nominal),
        // jika tidak, fallback ke persentase dari baseTransport.
        $ppnAmount = round($shipment->ppn ?? ($baseTransport * 0.011), 2);
        $pphAmount = round($shipment->pph ?? ($baseTransport * 0.02), 2);
        $grandTotal = round($baseTotal + $ppnAmount - $pphAmount, 2);

        // Resolve payment method / bank details: prefer selected payment method record
        $paymentMethodText = $validated['payment_method'] ?? null;
        $bankName = $validated['bank_name'] ?? null;
        $bankAccountNumber = $validated['bank_account_number'] ?? null;
        $bankAccountName = $validated['bank_account_name'] ?? null;

        if (!empty($validated['payment_method_id'])) {
            $pm = PaymentMethod::find($validated['payment_method_id']);
            if ($pm) {
                $paymentMethodText = $pm->method_name;
                $bankName = $pm->bank_name;
                $bankAccountNumber = $pm->account_number;
                $bankAccountName = $pm->account_name;
            }
        }

        $data = [
            'packing_list_id' => $packingList->id,
            'invoice_number' => $invoiceNumber,
            'receipt_number' => $receiptNumber,
            'invoice_date' => $validated['invoice_date'],
            'customer_name' => $customerName,
            'transportation_type' => $shipment->transportation_type,
            'payment_status' => $validated['payment_status'],
            'payment_method' => $paymentMethodText,
            'notes' => $validated['notes'],
            'bank_name' => $bankName ?? null,
            'bank_account_number' => $bankAccountNumber ?? null,
            'bank_account_name' => $bankAccountName ?? null,
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

        $paymentMethods = PaymentMethod::where('status', PaymentMethod::STATUS_ACTIVE)
            ->orderBy('method_name')
            ->get();

        return view('invoices.edit', compact('invoice', 'paymentMethods'));
    }


    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_date' => 'required|date',
            'payment_status' => 'required|in:' . implode(',', Invoice::PAYMENT_STATUSES),
            'payment_method_id' => 'nullable|exists:payment_methods,id',
            'payment_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'bank_account_name' => 'nullable|string|max:255',
            'delivery_fee' => 'nullable|numeric|min:0',
            'proof_of_payment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $deliveryFee = $invoice->delivery_fee ?? 0;
        if (array_key_exists('delivery_fee', $validated)) {
            $deliveryFee = $validated['delivery_fee'] ?? $deliveryFee;
        }

        $invoice->load('packingList.shipment');
        $shipment = $invoice->packingList->shipment;
        $transportPricePerKg = $shipment->price_per_kg ?? 0;
        $baseTransport = round($transportPricePerKg * $invoice->total_weight, 2);
        $baseTotal = round($baseTransport + $deliveryFee, 2);

        // Ambil nominal PPN/PPH dari shipment jika tersedia (nominal),
        // jika tidak, fallback ke persentase dari baseTransport.
        $ppnAmount = round($shipment->ppn ?? ($baseTransport * 0.011), 2);
        $pphAmount = round($shipment->pph ?? ($baseTransport * 0.02), 2);
        $grandTotal = round($baseTotal + $ppnAmount - $pphAmount, 2);

        $paymentMethodText = $validated['payment_method'] ?? $invoice->payment_method;
        $bankName = $validated['bank_name'] ?? $invoice->bank_name;
        $bankAccountNumber = $validated['bank_account_number'] ?? $invoice->bank_account_number;
        $bankAccountName = $validated['bank_account_name'] ?? $invoice->bank_account_name;

        if (!empty($validated['payment_method_id'])) {
            $pm = PaymentMethod::find($validated['payment_method_id']);
            if ($pm) {
                $paymentMethodText = $pm->method_name;
                $bankName = $pm->bank_name;
                $bankAccountNumber = $pm->account_number;
                $bankAccountName = $pm->account_name;
            }
        }

        $data = [
            'invoice_date' => $validated['invoice_date'],
            'payment_status' => $validated['payment_status'],
            'payment_method' => $paymentMethodText,
            'notes' => $validated['notes'],
            'bank_name' => $bankName ?? null,
            'bank_account_number' => $bankAccountNumber ?? null,
            'bank_account_name' => $bankAccountName ?? null,
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
