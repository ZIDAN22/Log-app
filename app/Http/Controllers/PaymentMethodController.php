<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentMethod::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('method_name', 'like', '%' . $request->search . '%')
                    ->orWhere('bank_name', 'like', '%' . $request->search . '%')
                    ->orWhere('payment_code', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('method_type')) {
            $query->where('method_type', $request->method_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $paymentMethods = $query
            ->latest()
            ->paginate(10);

        $summary = [
            'total' => PaymentMethod::count(),
            'bank_transfer' => PaymentMethod::where(
                'method_type',
                PaymentMethod::TYPE_BANK_TRANSFER
            )->count(),

            'ewallet' => PaymentMethod::where(
                'method_type',
                PaymentMethod::TYPE_E_WALLET
            )->count(),

            'active' => PaymentMethod::where(
                'status',
                PaymentMethod::STATUS_ACTIVE
            )->count(),
        ];

        return view(
            'payment-methods.index',
            compact('paymentMethods', 'summary')
        );
    }

    public function create()
    {
        return view('payment-methods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'method_name' => 'required|string|max:255',
            'method_type' => 'required',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'status' => 'required',
            'notes' => 'nullable|string',
        ]);



        // Contoh kode sederhana: PAY001, PAY002, dst.
        // Ambil nomor urut berdasarkan jumlah data saat ini (tanpa ketergantungan seed).
        $nextNumber = (PaymentMethod::count() + 1);
        $validated['payment_code'] = 'PAY' . str_pad((string) $nextNumber, 3, '0', STR_PAD_LEFT);

        PaymentMethod::create($validated);

        return redirect()
            ->route('payment-methods.index')
            ->with(
                'success',
                'Metode pembayaran berhasil ditambahkan.'
            );
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view(
            'payment-methods.edit',
            compact('paymentMethod')
        );
    }

    public function update(
        Request $request,
        PaymentMethod $paymentMethod
    ) {
        $validated = $request->validate([
            'method_name' => 'required|string|max:255',
            'method_type' => 'required',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'status' => 'required',
            'notes' => 'nullable|string',
        ]);



        $paymentMethod->update($validated);

        return redirect()
            ->route('payment-methods.index')
            ->with(
                'success',
                'Metode pembayaran berhasil diperbarui.'
            );
    }

    public function destroy(PaymentMethod $paymentMethod)
    {

        $paymentMethod->delete();

        return redirect()
            ->route('payment-methods.index')
            ->with(
                'success',
                'Metode pembayaran berhasil dihapus.'
            );
    }
}