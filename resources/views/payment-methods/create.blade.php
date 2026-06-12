@extends('layouts.app')

@section('title', 'Tambah Metode Pembayaran')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        {{-- Header --}}
        <div
            class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">
                    Keuangan
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Tambah Payment Method
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    Tambahkan metode pembayaran perusahaan yang akan digunakan customer
                    untuk pembayaran invoice logistik.
                </p>
            </div>

            <a href="{{ route('payment-methods.index') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">

                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>

                Kembali
            </a>
        </div>

        {{-- Error --}}
        @if ($errors->any())
        <div class="mb-5 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">

            <p class="font-semibold">
                Ada data yang perlu diperbaiki.
            </p>

            <p class="mt-1">
                Periksa kembali field payment method sebelum menyimpan.
            </p>
        </div>
        @endif

        <form action="{{ route('payment-methods.store') }}" method="POST"
            class="space-y-6">

            @csrf

            <div class="grid gap-8 xl:grid-cols-[minmax(0,1fr)_360px]">

                {{-- LEFT CONTENT --}}
                <div class="space-y-6">

                    {{-- Informasi Payment Method --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">
                                Informasi Metode Pembayaran
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Lengkapi informasi rekening atau pembayaran digital perusahaan.
                            </p>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">

                            {{-- Nama Payment --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nama Payment Method
                                    <span class="text-rose-500">*</span>
                                </label>

                                <input type="text" name="method_name" value="{{ old('method_name') }}" placeholder="Contoh: Bank BCA"
                                    required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />

                                @error('method_name')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Tipe Payment --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Tipe Payment
                                    <span class="text-rose-500">*</span>
                                </label>

                                <select id="payment_type" name="method_type" required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100">

                                    <option value="">Pilih Tipe</option>
                                    @foreach (\App\Models\PaymentMethod::types() as $value => $label)
                                    <option value="{{ $value }}" {{ old('method_type')== $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- Nama Bank --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nama Bank / Provider
                                </label>

                                <input type="text" name="bank_name" value="{{ old('bank_name') }}"
                                    placeholder="Contoh: BCA / Dana / OVO"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                            </div>

                            {{-- Nomor Rekening --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nomor Rekening / Nomor Akun
                                </label>

                                <input type="text" name="account_number" value="{{ old('account_number') }}"
                                    placeholder="Masukkan nomor rekening"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                            </div>

                            {{-- Atas Nama --}}
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Atas Nama
                                </label>

                                <input type="text" name="account_name" value="{{ old('account_name') }}"
                                    placeholder="Nama pemilik rekening"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                            </div>

                        </div>
                    </section>


                    {{-- Status --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">
                                Pengaturan Status
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Tentukan apakah metode pembayaran langsung aktif atau tidak.
                            </p>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Status
                                    <span class="text-rose-500">*</span>
                                </label>

                                <select name="status" required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100">

                                    @foreach (\App\Models\PaymentMethod::statuses() as $value => $label)
                                    <option value="{{ $value }}" {{ old('status', 'ACTIVE')== $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Urutan Tampil
                                </label>

                                <input type="number" min="0" name="sort_order" value="{{ old('sort_order', 1) }}"
                                    placeholder="1"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                            </div>

                        </div>
                    </section>

                </div>

                {{-- RIGHT SIDEBAR --}}
                <aside class="space-y-4 xl:sticky xl:top-6 xl:self-start">

                    {{-- Ringkasan --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <h2 class="text-base font-bold text-slate-950">
                            Ringkasan Payment
                        </h2>

                        <dl class="mt-4 space-y-4 text-sm">

                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">

                                <dt class="text-slate-500">
                                    Nama
                                </dt>

                                <dd id="summary-name" class="font-semibold text-slate-900">
                                    -
                                </dd>
                            </div>

                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">

                                <dt class="text-slate-500">
                                    Tipe
                                </dt>

                                <dd id="summary-type" class="font-semibold text-slate-900">
                                    -
                                </dd>
                            </div>

                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">

                                <dt class="text-slate-500">
                                    Provider
                                </dt>

                                <dd id="summary-bank" class="font-semibold text-slate-900">
                                    -
                                </dd>
                            </div>

                            <div class="flex items-center justify-between">

                                <dt class="text-slate-500">
                                    Status
                                </dt>

                                <dd id="summary-status" class="font-semibold text-emerald-600">
                                    Aktif
                                </dd>
                            </div>

                        </dl>
                    </section>

                    {{-- Info --}}
                    <section class="rounded-lg border border-emerald-100 bg-emerald-50 p-5 text-sm text-emerald-900">

                        <p class="font-semibold">
                            Informasi
                        </p>

                        <p class="mt-2 leading-6">
                            Payment method yang aktif akan muncul pada halaman pembayaran invoice customer.
                        </p>
                    </section>

                </aside>
            </div>

            {{-- Footer Action --}}
            <div
                class="flex flex-col gap-3 rounded-lg border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">

                <p class="text-sm text-slate-500">
                    Pastikan data rekening sudah benar sebelum menyimpan.
                </p>

                <div class="flex flex-col gap-3 sm:flex-row">

                    <a href="{{ route('payment-methods.index') }}"
                        class="inline-flex h-11 items-center justify-center rounded-lg border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-emerald-600 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>

                        <span>
                            Simpan Payment Method
                        </span>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

    const paymentName = document.querySelector('input[name="method_name"]');
    const paymentType = document.querySelector('select[name="method_type"]');
    const bankName = document.querySelector('input[name="bank_name"]');
    const paymentStatus = document.querySelector('select[name="status"]');

    function updateSummary() {
        document.getElementById('summary-name').textContent = paymentName?.value || '-';
        document.getElementById('summary-type').textContent = paymentType?.options[paymentType.selectedIndex]?.text || '-';
        document.getElementById('summary-bank').textContent = bankName?.value || '-';
        document.getElementById('summary-status').textContent = paymentStatus?.value === 'ACTIVE' ? 'Aktif' : 'Nonaktif';
    }

    if (paymentName) paymentName.addEventListener('input', updateSummary);
    if (paymentType) paymentType.addEventListener('change', updateSummary);
    if (bankName) bankName.addEventListener('input', updateSummary);
    if (paymentStatus) paymentStatus.addEventListener('change', updateSummary);

    updateSummary();
});
</script>
@endpush