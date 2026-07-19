@extends('layouts.app')

@section('title', 'Input Pembayaran Baru')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        {{-- Header --}}
        <div class="mb-5 flex items-end justify-between border-b border-slate-200 pb-5">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">
                    KEUANGAN
                </p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Input Pembayaran 
                </h1>
            </div>
            <a href="{{ route('payments.index') }}"
                class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Kembali
            </a>
        </div>

        {{-- Content --}}
        <div class="grid gap-6 xl:grid-cols-3">

            {{-- Form Section --}}
            <div class="xl:col-span-2">
                <div class="rounded-lg border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-4">
                        <h2 class="text-base font-bold text-slate-950">Data Pembayaran</h2>
                        <p class="mt-1 text-sm text-slate-500">Lengkapi informasi pembayaran untuk invoice yang belum lunas.</p>
                    </div>

                    <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 px-6 py-5">
                        @csrf

                        {{-- Invoice Selection --}}
                        <div>
                            <label for="invoice_id" class="mb-2 block text-sm font-semibold text-slate-700">
                                Pilih Invoice <span class="text-red-500">*</span>
                            </label>
                            <select id="invoice_id" name="invoice_id" required
                                class="h-11 w-full rounded-lg border @error('invoice_id') border-red-500 @else border-slate-300 @enderror bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                onchange="loadInvoiceData(this.value)">
                                <option value="">-- Pilih Invoice --</option>
                                @forelse($invoices as $invoice)
                                <option value="{{ $invoice->id }}" data-invoice="{{ json_encode($invoice) }}">
                                    {{ $invoice->invoice_number }} - {{ $invoice->customer_name }}
                                    (Status: {{ $invoice->payment_status }})
                                </option>
                                @empty
                                <option disabled>Tidak ada invoice yang tersedia</option>
                                @endforelse
                            </select>
                            @error('invoice_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Invoice Details (Read-only) --}}
                        <div class="grid gap-4 rounded-lg border border-slate-200 bg-slate-50 p-4 xl:grid-cols-2">

                            {{-- Invoice Number --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">No. Invoice</label>
                                <input type="text" id="invoice_number" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm text-slate-600" />
                            </div>

                            {{-- Receipt Number --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">No. Resi</label>
                                <input type="text" id="receipt_number" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm text-slate-600" />
                            </div>

                            {{-- Customer Name --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Customer</label>
                                <input type="text" id="customer_name" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm text-slate-600" />
                            </div>

                            {{-- Payment Method --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Metode Pembayaran</label>
                                <input type="text" id="payment_method" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm text-slate-600" />
                            </div>

                            {{-- Grand Total --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Total Invoice</label>
                                <input type="text" id="grand_total" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm font-semibold text-slate-900" />
                            </div>

                            {{-- Remaining Balance --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Sisa Pembayaran</label>
                                <input type="text" id="remaining_balance" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm font-semibold text-red-600" />
                            </div>

                        </div>

                        {{-- Payment Date --}}
                        <div>
                            <label for="payment_date" class="mb-2 block text-sm font-semibold text-slate-700">
                                Tanggal Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="payment_date" name="payment_date" value="{{ old('payment_date') }}" required
                                class="h-11 w-full rounded-lg border @error('payment_date') border-red-500 @else border-slate-300 @enderror bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            @error('payment_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Amount Paid --}}
                        <div>
                            <label for="amount_paid" class="mb-2 block text-sm font-semibold text-slate-700">
                                Nominal Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-600">Rp</span>
                                <input type="number" id="amount_paid" name="amount_paid" value="{{ old('amount_paid') }}" 
                                    min="1" step="0.01" required placeholder="0"
                                    class="h-11 w-full rounded-lg border @error('amount_paid') border-red-500 @else border-slate-300 @enderror bg-white pl-8 pr-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>
                            @error('amount_paid')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Proof of Payment --}}
                        <div>
                            <label for="proof_payment" class="mb-2 block text-sm font-semibold text-slate-700">
                                Bukti Pembayaran (Opsional)
                            </label>
                            <p class="mb-3 text-xs text-slate-500">Format: JPG, PNG, PDF. Ukuran maksimal: 10MB</p>
                            <div class="relative">
                                <input type="file" id="proof_payment" name="proof_payment" accept=".jpg,.jpeg,.png,.pdf"
                                    class="hidden" onchange="updateFileLabel(this)" />
                                <label for="proof_payment"
                                    class="flex h-20 w-full cursor-pointer items-center justify-center rounded-lg border-2 border-dashed border-slate-300 bg-slate-50 transition hover:border-blue-400 hover:bg-blue-50">
                                    <div class="text-center">
                                        <svg class="mx-auto h-6 w-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <p id="file-label" class="mt-1 text-xs font-semibold text-slate-600">Klik untuk upload atau drag &amp; drop</p>
                                    </div>
                                </label>
                            </div>
                            @error('proof_payment')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Notes --}}
                        <div>
                            <label for="notes" class="mb-2 block text-sm font-semibold text-slate-700">
                                Catatan (Opsional)
                            </label>
                            <textarea id="notes" name="notes" rows="4" placeholder="Tambahkan catatan tentang pembayaran ini..."
                                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ old('notes') }}</textarea>
                            @error('notes')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex gap-3 border-t border-slate-200 pt-5">
                            <a href="{{ route('payments.index') }}"
                                class="inline-flex h-11 items-center justify-center rounded-lg border border-slate-300 bg-white px-6 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex h-11 items-center justify-center rounded-lg bg-blue-600 px-6 text-sm font-semibold text-white hover:bg-blue-700">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Pembayaran
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            {{-- Info Section --}}
            <div>

                {{-- Instructions --}}
                {{-- <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="font-bold text-slate-950">Panduan</h3>

                    <div class="mt-4 space-y-3 text-sm text-slate-600">
                        <div>
                            <p class="font-semibold text-slate-900">1. Pilih Invoice</p>
                            <p>Hanya invoice dengan status belum lunas yang dapat dipilih.</p>
                        </div>

                        <div>
                            <p class="font-semibold text-slate-900">2. Isi Nominal</p>
                            <p>Nominal pembayaran tidak boleh melebihi total invoice.</p>
                        </div>

                        <div>
                            <p class="font-semibold text-slate-900">3. Upload Bukti</p>
                            <p>Bukti pembayaran membantu verifikasi transaksi Anda.</p>
                        </div>

                        <div>
                            <p class="font-semibold text-slate-900">4. Catatan Opsional</p>
                            <p>Tambahkan informasi tambahan tentang pembayaran.</p>
                        </div>
                    </div>
                </div> --}}

                {{-- Info Box --}}
                <div class="mt-5 rounded-lg border border-emerald-200 bg-emerald-50 p-4">
                    <div class="flex gap-3">
                        <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="text-sm text-emerald-900">
                            <p class="font-semibold">Status Invoice</p>
                            <p class="mt-1">Status invoice akan otomatis diperbarui setelah pembayaran disimpan.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
function loadInvoiceData(invoiceId) {
    if (!invoiceId) {
        clearInvoiceData();
        return;
    }

    const select = document.getElementById('invoice_id');
    const option = select.options[select.selectedIndex];
    const invoice = JSON.parse(option.dataset.invoice);

    // Format Rp
    const formatRp = (value) => 'Rp ' + Number(value).toLocaleString('id-ID', { maximumFractionDigits: 0 });

    document.getElementById('invoice_number').value = invoice.invoice_number;
    document.getElementById('receipt_number').value = invoice.receipt_number;
    document.getElementById('customer_name').value = invoice.customer_name;
    document.getElementById('payment_method').value = invoice.payment_method || '-';
    document.getElementById('grand_total').value = formatRp(invoice.grand_total);
    document.getElementById('remaining_balance').value = formatRp(invoice.grand_total);
}

function clearInvoiceData() {
    document.getElementById('invoice_number').value = '';
    document.getElementById('receipt_number').value = '';
    document.getElementById('customer_name').value = '';
    document.getElementById('payment_method').value = '';
    document.getElementById('grand_total').value = '';
    document.getElementById('remaining_balance').value = '';
}

function updateFileLabel(input) {
    const label = document.getElementById('file-label');
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    }
}

// Load data if form is re-rendered with old value
document.addEventListener('DOMContentLoaded', function() {
    const invoiceId = document.getElementById('invoice_id').value;
    if (invoiceId) {
        loadInvoiceData(invoiceId);
    }
});
</script>

@endsection
