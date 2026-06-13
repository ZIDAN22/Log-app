@extends('layouts.app')

@section('title', 'Edit Pembayaran')

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
                    Edit Data Pembayaran
                </h1>
                <p class="mt-1 text-sm text-slate-500">Kode: {{ $payment->payment_code }}</p>
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
                        <p class="mt-1 text-sm text-slate-500">Perbarui informasi pembayaran invoice.</p>
                    </div>

                    <form action="{{ route('payments.update', $payment) }}" method="POST" enctype="multipart/form-data" class="space-y-6 px-6 py-5">
                        @csrf
                        @method('PUT')

                        {{-- Invoice Information (Read-only) --}}
                        <div class="grid gap-4 rounded-lg border border-slate-200 bg-slate-50 p-4 xl:grid-cols-2">

                            {{-- Invoice Number --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">No. Invoice</label>
                                <input type="text" value="{{ $payment->invoice->invoice_number }}" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm text-slate-600" />
                            </div>

                            {{-- Receipt Number --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">No. Resi</label>
                                <input type="text" value="{{ $payment->invoice->receipt_number }}" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm text-slate-600" />
                            </div>

                            {{-- Customer Name --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Customer</label>
                                <input type="text" value="{{ $payment->invoice->customer_name }}" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm text-slate-600" />
                            </div>

                            {{-- Payment Method --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Metode Pembayaran</label>
                                <input type="text" value="{{ $payment->invoice->payment_method ?? '-' }}" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm text-slate-600" />
                            </div>

                            {{-- Grand Total --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Total Invoice</label>
                                <input type="text" value="Rp {{ number_format($payment->invoice->grand_total, 0, ',', '.') }}" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm font-semibold text-slate-900" />
                            </div>

                            {{-- Current Status --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Status Invoice</label>
                                <input type="text" value="{{ $payment->invoice->payment_status }}" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-sm font-semibold text-slate-900" />
                            </div>

                        </div>

                        {{-- Payment Date --}}
                        <div>
                            <label for="payment_date" class="mb-2 block text-sm font-semibold text-slate-700">
                                Tanggal Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="payment_date" name="payment_date" value="{{ $payment->payment_date->format('Y-m-d') }}" required
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
                                <input type="number" id="amount_paid" name="amount_paid" value="{{ $payment->amount_paid }}" 
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
                            <p class="mb-3 text-xs text-slate-500">Format: JPG, PNG, PDF. Ukuran maksimal: 10MB. Biarkan kosong untuk tidak mengubah file.</p>

                            {{-- Current File --}}
                            @if($payment->proof_payment)
                            <div class="mb-4 rounded-lg border border-slate-200 bg-slate-50 p-3">
                                <p class="text-xs font-semibold text-slate-600">File saat ini:</p>
                                <div class="mt-2 flex items-center justify-between">
                                    <a href="{{ Storage::url($payment->proof_payment) }}" target="_blank"
                                        class="text-sm font-semibold text-blue-600 hover:underline">
                                        Lihat File
                                    </a>
                                    <span class="text-xs text-slate-500">{{ basename($payment->proof_payment) }}</span>
                                </div>
                            </div>
                            @endif

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
                                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ $payment->notes }}</textarea>
                            @error('notes')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex gap-3 border-t border-slate-200 pt-5">
                            <a href="{{ route('payments.show', $payment) }}"
                                class="inline-flex h-11 items-center justify-center rounded-lg border border-slate-300 bg-white px-6 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex h-11 items-center justify-center rounded-lg bg-blue-600 px-6 text-sm font-semibold text-white hover:bg-blue-700">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Perbarui Pembayaran
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            {{-- Info Section --}}
            <div>

                {{-- Status Badge --}}
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-4">
                        <p class="text-sm font-semibold text-slate-600">Status Pembayaran</p>
                        <div class="mt-3">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $payment->getStatusBadge() }}">
                                {{ $payment->getStatusLabel() }}
                            </span>
                        </div>
                    </div>

                    <div class="border-t border-slate-200 pt-4">
                        <p class="text-sm font-semibold text-slate-600">Informasi</p>
                        <div class="mt-3 space-y-2 text-xs text-slate-600">
                            <div>
                                <span class="text-slate-500">Dibuat:</span>
                                <span class="font-semibold text-slate-900">{{ $payment->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="text-slate-500">Diubah:</span>
                                <span class="font-semibold text-slate-900">{{ $payment->updated_at->format('d M Y H:i') }}</span>
                            </div>
                            @if($payment->verified_by)
                            <div>
                                <span class="text-slate-500">Diverifikasi oleh:</span>
                                <span class="font-semibold text-slate-900">{{ $payment->verifiedBy->name ?? 'Sistem' }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="mt-5 rounded-lg border border-amber-200 bg-amber-50 p-4">
                    <div class="flex gap-3">
                        <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-700">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="text-sm text-amber-900">
                            <p class="font-semibold">Perhatian</p>
                            <p class="mt-1">Mengubah nominal pembayaran akan otomatis memperbarui status invoice.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
function updateFileLabel(input) {
    const label = document.getElementById('file-label');
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    }
}
</script>

@endsection
