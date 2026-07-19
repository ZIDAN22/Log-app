@extends('layouts.app')

@section('title', 'Edit Invoice')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        {{-- Header --}}
        <div
            class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">
                    Invoice
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Edit Invoice
                </h1>

 
            </div>

            <a href="{{ route('invoices.index') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">

                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>

                Kembali
            </a>
        </div>

        {{-- Validation Error --}}
        @if ($errors->any())
        <div class="mb-5 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            <p class="font-semibold">
                Ada data yang perlu diperbaiki.
            </p>

            <p class="mt-1">
                Periksa kembali field invoice sebelum menyimpan perubahan.
            </p>
        </div>
        @endif

        <form id="invoice-edit-form" action="{{ route('invoices.update', $invoice) }}" method="POST"
            enctype="multipart/form-data" class="space-y-6">

            @csrf
            @method('PUT')

            <div class="grid gap-8 xl:grid-cols-[minmax(0,1fr)_360px]">

                {{-- LEFT CONTENT --}}
                <div class="space-y-6">

                    {{-- Nomor Dokumen --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <div
                            class="mb-5 flex flex-col gap-3 border-b border-slate-200 pb-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>
                                <h2 class="text-base font-bold text-slate-950">
                                    Nomor Dokumen
                                </h2>

                                <p class="mt-1 text-sm text-slate-500">
                                    Informasi invoice yang sudah dibuat sebelumnya.
                                </p>
                            </div>

                            <span
                                class="inline-flex w-fit items-center rounded-md bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                Mode Edit
                            </span>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nomor Invoice
                                </label>

                                <input type="text" readonly value="{{ $invoice->invoice_number }}"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Tanggal Invoice
                                </label>

                                <input type="date" name="invoice_date" required
                                    value="{{ old('invoice_date', optional($invoice->invoice_date)->format('Y-m-d')) }}"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>

                        </div>
                    </section>

                    {{-- Shipment / Packing List --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">
                                Data Shipment / Packing List
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Data shipment dan packing list terhubung otomatis.
                            </p>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Packing List
                                </label>

                                <input type="text" readonly
                                    value="{{ $invoice->packingList->shipment->receipt_number ?? '-' }} - {{ $invoice->customer_name }}"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    No Resi
                                </label>

                                <input type="text" readonly value="{{ $invoice->receipt_number }}"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Customer
                                </label>

                                <input type="text" readonly value="{{ $invoice->customer_name }}"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Transportasi
                                </label>

                                <input type="text" readonly value="{{ ucfirst($invoice->transportation_type ?? '-') }}"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Total Berat
                                </label>

                                <input id="total_weight" type="text" readonly
                                    value="{{ number_format($invoice->total_weight, 2, ',', '.') }} KG"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                        </div>

                        {{-- Detail Barang --}}
                        <div class="mt-5 rounded-lg border border-slate-200 bg-white p-4">
                            <h3 class="text-sm font-bold text-slate-900">
                                Detail Barang (Otomatis)
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Data barang berasal dari packing list.
                            </p>

                            <div class="mt-4 overflow-x-auto rounded-lg border border-slate-200">

                                <table class="min-w-full divide-y divide-slate-200 text-sm">

                                    <thead class="bg-slate-50 text-slate-700">
                                        <tr>
                                            <th class="px-4 py-3 text-left">Nama Barang</th>
                                            <th class="px-4 py-3 text-center">Qty</th>
                                            <th class="px-4 py-3 text-center">Packaging</th>
                                            <th class="px-4 py-3 text-center">Total Packaging</th>
                                            <th class="px-4 py-3 text-right">Berat</th>
                                            <th class="px-4 py-3 text-right">Harga Unit</th>
                                            <th class="px-4 py-3 text-right">Subtotal</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-slate-200 bg-white">
                                        @foreach($invoice->packingList->items as $item)
                                        <tr class="transition hover:bg-slate-50">

                                            <td class="px-4 py-4 text-slate-700">
                                                {{ $item->item_name }}
                                            </td>

                                            <td class="px-4 py-4 text-center text-slate-700">
                                                {{ $item->qty }}
                                            </td>

                                            <td class="px-4 py-4 text-center text-slate-700">
                                                {{ $item->packaging_type }}
                                            </td>

                                            <td class="px-4 py-4 text-center text-slate-700">
                                                {{ $item->total_packaging }}
                                            </td>

                                            <td class="px-4 py-4 text-right text-slate-700">
                                                {{ number_format($item->weight, 2, ',', '.') }}
                                            </td>

                                            <td class="px-4 py-4 text-right text-slate-700">
                                                Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                                            </td>

                                            <td class="px-4 py-4 text-right font-semibold text-slate-900">
                                                Rp {{ number_format($item->subtotal_price, 0, ',', '.') }}
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </section>
                    {{-- Perhitungan Invoice --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">
                                Detail Perhitungan Invoice
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Perubahan biaya akan dihitung otomatis.
                            </p>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Harga per KG
                                </label>

                                <div class="relative">
                                    <span
                                        class="absolute left-3 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-500">
                                        Rp
                                    </span>

                                    <input type="number" id="price_per_kg" readonly
                                        value="{{ $invoice->packingList->shipment->price_per_kg ?? 0 }}"
                                        class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 pl-10 pr-3 text-sm text-slate-500" />
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Biaya Transport
                                </label>

                                <input id="transport_base_display" type="text" readonly
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-700" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    PPN 1.1%
                                </label>

                                <input id="ppn_preview" type="text" readonly
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-700" />

                                <input type="hidden" id="ppn_amount" name="ppn_amount"
                                    value="{{ old('ppn_amount', $invoice->ppn_amount) }}" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    PPH 2%
                                </label>

                                <input id="pph_preview" type="text" readonly
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-700" />

                                <input type="hidden" id="pph_amount" name="pph_amount"
                                    value="{{ old('pph_amount', $invoice->pph_amount) }}" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Grand Total
                                </label>

                                <div
                                    class="flex h-11 items-center rounded-lg border border-emerald-200 bg-emerald-50 px-4">

                                    <span id="grand-total-preview" class="text-lg font-bold text-emerald-700">
                                        Rp 0
                                    </span>
                                </div>

                                <input type="hidden" id="grand_total" name="grand_total"
                                    value="{{ old('grand_total', $invoice->grand_total) }}" />
                            </div>

                        </div>
                    </section>

                    {{-- Pembayaran --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">
                                Pembayaran
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Ubah status pembayaran dan data transfer.
                            </p>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Status Pembayaran
                                </label>

                                <select name="payment_status" required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                                    @foreach(\App\Models\Invoice::PAYMENT_STATUSES as $status)
                                    <option value="{{ $status }}" {{ old('payment_status', $invoice->payment_status) ==
                                        $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Metode Pembayaran
                                </label>

                                <select id="payment_method_id" name="payment_method_id"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                    <option value="">Pilih metode (atau ketik manual)</option>
                                    @foreach($paymentMethods as $method)
                                        <option value="{{ $method->id }}"
                                            {{ old('payment_method_id', optional($invoice->paymentMethod)->id) == $method->id ? 'selected' : '' }}>
                                            {{ $method->method_name }}@if($method->bank_name) - {{ $method->bank_name }}@endif
                                        </option>
                                    @endforeach
                                </select>

                                <input name="payment_method" id="payment_method_input" type="text"
                                    value="{{ old('payment_method', $invoice->payment_method) }}"
                                    placeholder="Ketik metode pembayaran jika tidak ada dalam daftar"
                                    class="mt-2 h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nama Bank
                                </label>

                                <input type="text" name="bank_name" value="{{ old('bank_name', $invoice->bank_name) }}"
                                    readonly
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nomor Rekening
                                </label>

                                <input type="text" name="bank_account_number"
                                    value="{{ old('bank_account_number', $invoice->bank_account_number) }}"
                                    readonly
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Atas Nama
                                </label>

                                <input type="text" name="bank_account_name"
                                    value="{{ old('bank_account_name', $invoice->bank_account_name) }}"
                                    readonly
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Catatan Invoice
                                </label>

                                <textarea name="notes" rows="4"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ old('notes', $invoice->notes) }}</textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Upload Bukti Pembayaran
                                </label>

                                <input type="file" name="proof_of_payment" accept="image/*,.pdf"
                                    class="w-full text-sm text-slate-700" />

                                @if($invoice->proof_of_payment)
                                <div class="mt-3 rounded-lg border border-slate-200 bg-slate-50 p-3">
                                    <p class="text-sm text-slate-600">
                                        File saat ini:

                                        <a href="{{ asset('storage/' . $invoice->proof_of_payment) }}" target="_blank"
                                            class="font-semibold text-blue-600 hover:text-blue-700">

                                            Lihat Bukti Pembayaran
                                        </a>
                                    </p>
                                </div>
                                @endif
                            </div>

                        </div>
                    </section>

                </div>

                {{-- RIGHT SIDEBAR --}}
                <aside class="space-y-4 xl:sticky xl:top-6 xl:self-start">

                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <h2 class="text-base font-bold text-slate-950">
                            Ringkasan Invoice
                        </h2>

                        <dl class="mt-4 space-y-4 text-sm">

                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">Customer</dt>
                                <dd class="font-semibold text-slate-900">
                                    {{ $invoice->customer_name }}
                                </dd>
                            </div>

                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">No Resi</dt>
                                <dd class="font-semibold text-slate-900">
                                    {{ $invoice->receipt_number }}
                                </dd>
                            </div>

                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">Total Berat</dt>
                                <dd class="font-semibold text-slate-900">
                                    {{ number_format($invoice->total_weight, 2, ',', '.') }} KG
                                </dd>
                            </div>

                            <div class="flex items-center justify-between">
                                <dt class="text-slate-500">Grand Total</dt>

                                <dd id="summary-grand-total" class="text-lg font-bold text-emerald-600">
                                    Rp 0
                                </dd>
                            </div>

                        </dl>
                    </section>

                    <section class="rounded-lg border border-amber-100 bg-amber-50 p-5 text-sm text-amber-900">
                        <p class="font-semibold">
                            Perubahan Invoice
                        </p>

                        <p class="mt-2 leading-6">
                            Semua perubahan biaya akan diperbarui otomatis sebelum invoice disimpan.
                        </p>
                    </section>

                </aside>

            </div>

            {{-- Footer Action --}}
            <div
                class="flex flex-col gap-3 rounded-lg border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">

                <p class="text-sm text-slate-500">
                    Pastikan data invoice sudah benar sebelum menyimpan perubahan.
                </p>

                <div class="flex flex-col gap-3 sm:flex-row">

                    <a href="{{ route('invoices.index') }}"
                        class="inline-flex h-11 items-center justify-center rounded-lg border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Batal
                    </a>

                    <button id="submit-invoice-button" type="submit"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>

                        <span>Perbarui Invoice</span>
                    </button>

                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function formatRupiah(number) {
        return 'Rp ' + Number(number).toLocaleString('id-ID');
    }

    function recalculateInvoice() {

        const totalWeight =
            parseFloat(@json($invoice->total_weight)) || 0;

        const pricePerKg =
            parseFloat(document.getElementById('price_per_kg').value) || 0;

        const deliveryFee =
            parseFloat(@json($invoice->delivery_fee ?? 0)) || 0;

        const baseTransport =
            totalWeight * pricePerKg;

        const subtotal =
            baseTransport + deliveryFee;

        const ppn =
            subtotal * 0.011;

        const pph =
            subtotal * 0.02;

        const grandTotal =
            subtotal + ppn - pph;

        document.getElementById('transport_base_display').value =
            formatRupiah(baseTransport);

        document.getElementById('ppn_preview').value =
            formatRupiah(ppn);

        document.getElementById('pph_preview').value =
            formatRupiah(pph);

        document.getElementById('grand-total-preview').textContent =
            formatRupiah(grandTotal);

        document.getElementById('summary-grand-total').textContent =
            formatRupiah(grandTotal);

        document.getElementById('grand_total').value =
            grandTotal.toFixed(2);

        document.getElementById('ppn_amount').value =
            ppn.toFixed(2);

        document.getElementById('pph_amount').value =
            pph.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', function () {
        recalculateInvoice();
    });
</script>
@endpush