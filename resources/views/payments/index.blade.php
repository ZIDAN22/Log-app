@extends('layouts.app')

@section('title', 'Manajemen Pembayaran')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        {{-- Header --}}
        <div
            class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">
                    PAYMENT MANAGEMENT
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Manajemen Pembayaran
                </h1>

 
            </div>

            <a href="{{ route('payments.create') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Input Pembayaran
            </a>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="mb-5 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm">
            <div class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="font-semibold">Berhasil</p>
                <p class="mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        {{-- Statistics --}}
        @php
        $formatRp = fn ($value) => 'Rp ' . number_format((float) $value, 0, ',', '.');
        @endphp

        <section class="mb-6 grid gap-5 xl:grid-cols-4">

            {{-- Total Pembayaran --}}
            <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">Total Pembayaran</h2>
                        <p class="mt-3 text-2xl font-semibold text-slate-950">{{ number_format($summary['total'] ?? 0) }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-blue-50 text-blue-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </article>

            {{-- Menunggu Verifikasi --}}
            <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">Menunggu Verifikasi</h2>
                        <p class="mt-3 text-2xl font-semibold text-slate-950">{{ number_format($summary['pending'] ?? 0) }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-yellow-50 text-yellow-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                </div>
            </article>

            {{-- Terverifikasi --}}
            <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">Terverifikasi</h2>
                        <p class="mt-3 text-2xl font-semibold text-slate-950">{{ number_format($summary['verified'] ?? 0) }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </article>

            {{-- Total Nominal --}}
            <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">Total Nominal</h2>
                        <p class="mt-3 text-lg font-semibold text-slate-950">{{ $formatRp($summary['total_amount'] ?? 0) }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-rose-50 text-rose-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </article>

        </section>

        {{-- Filter --}}
        <section class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

            <form action="{{ route('payments.index') }}" method="GET" class="space-y-5">

                <div class="flex flex-col gap-3 border-b border-slate-200 pb-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Filter & Cari</h2>
                        <p class="mt-1 text-sm text-slate-500">Cari pembayaran berdasarkan kode, invoice, atau customer.</p>
                    </div>
                    <span class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ $payments->total() }} pembayaran
                    </span>
                </div>

                <div class="grid gap-4 xl:grid-cols-4">

                    {{-- Search --}}
                    <div class="xl:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Pencarian</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kode, Invoice, atau Customer..."
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    </div>

                    {{-- Status Filter --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                        <select name="status" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                            <option value="">Semua Status</option>
                            @foreach($statuses as $status)
                            <option value="{{ $status }}" @selected(request('status') == $status)>
                                {{ $status == 'pending' ? 'Menunggu Verifikasi' : 'Terverifikasi' }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Date Range --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Dari Tanggal</label>
                        <input type="date" name="from" value="{{ request('from') }}"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Sampai Tanggal</label>
                        <input type="date" name="to" value="{{ request('to') }}"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    </div>

                </div>

                <div class="flex flex-col gap-3 border-t border-slate-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-500">
                        Menampilkan <span class="font-semibold text-slate-900">{{ $payments->count() }}</span> dari
                        <span class="font-semibold text-slate-900">{{ $payments->total() }}</span> pembayaran
                    </p>

                    <div class="flex gap-3">
                        <a href="{{ route('payments.index') }}"
                            class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Reset
                        </a>

                        <button type="submit"
                            class="inline-flex h-10 items-center justify-center rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-blue-700">
                            Terapkan Filter
                        </button>
                    </div>
                </div>

            </form>

        </section>

        {{-- Table --}}
        <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">
                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Daftar Pembayaran</h2>
                        <p class="mt-1 text-sm text-slate-500">Kelola status pembayaran dan verifikasi transaksi pelanggan.</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                @if($payments->count())
                <table class="w-full min-w-[1400px] border-collapse">

                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Kode Pembayaran</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Invoice</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Metode</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide">Nominal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @foreach($payments as $payment)
                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="font-semibold text-slate-950">{{ $payment->payment_code }}</div>
                            </td>

                            <td class="px-6 py-5">
                                <div class="font-semibold text-slate-950">{{ $payment->invoice->invoice_number }}</div>
                                <div class="mt-1 text-xs text-slate-500">{{ $payment->invoice->receipt_number }}</div>
                            </td>

                            <td class="px-6 py-5">
                                <div class="text-sm text-slate-900">{{ $payment->invoice->customer_name }}</div>
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-slate-900">{{ $payment->invoice->payment_method ?? '-' }}</div>
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                <div class="font-semibold text-slate-950">{{ $formatRp($payment->amount_paid) }}</div>
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-slate-600">{{ $payment->payment_date->format('d M Y') }}</div>
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $payment->getStatusBadge() }}">
                                    {{ $payment->getStatusLabel() }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('payments.show', $payment) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-700 transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-200"
                                        title="Detail">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('payments.edit', $payment) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-700 transition hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-amber-100"
                                        title="Edit">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    @if($payment->status === 'pending')
                                    <form action="{{ route('payments.verify', $payment) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700 transition hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-100"
                                            title="Verifikasi">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif

                                    <button
                                        type="button"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-rose-50 text-rose-700 transition hover:bg-rose-100 focus:outline-none focus:ring-2 focus:ring-rose-100"
                                        title="Hapus"
                                        aria-label="Hapus pembayaran"
                                        data-open-delete-modal
                                        data-delete-url="{{ route('payments.destroy', $payment) }}"
                                        data-invoice="{{ $payment->invoice->invoice_number }}"
                                        data-receipt="{{ $payment->invoice->receipt_number }}"
                                        data-customer="{{ $payment->invoice->customer_name }}"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
                @else
                <div class="flex items-center justify-center rounded-lg border-2 border-dashed border-slate-300 px-6 py-16 text-center">
                    <div>
                        <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="mt-4 text-sm font-semibold text-slate-900">Tidak ada pembayaran</p>
                        <p class="mt-2 text-sm text-slate-500">Mulai dengan membuat pembayaran baru</p>
                    </div>
                </div>
                @endif
            </div>

        </section>

        {{-- Pagination --}}
        @if($payments->hasPages())
        <div class="mt-5">
            {{ $payments->links() }}
        </div>
        @endif

    </div>
</div>

<div
    id="delete-confirmation-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4 py-6"
    aria-hidden="true"
>
    <div class="w-full max-w-md rounded-lg border border-slate-200 bg-white shadow-xl" role="dialog" aria-modal="true" aria-labelledby="delete-modal-title">
        <div class="flex items-start gap-3 border-b border-slate-200 p-5">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-rose-50 text-rose-700">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M5.07 19h13.86a2 2 0 001.74-3L13.74 4a2 2 0 00-3.48 0L3.33 16a2 2 0 001.74 3z" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <h2 id="delete-modal-title" class="text-base font-bold text-slate-950">Konfirmasi Hapus Pembayaran</h2>
                <p class="mt-1 text-sm leading-6 text-slate-600">
                    Pembayaran ini akan dihapus permanen dari sistem. Pastikan data pembayaran sudah benar sebelum melanjutkan.
                </p>
            </div>
            <button
                type="button"
                data-close-delete-modal
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
                aria-label="Tutup konfirmasi"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-3 p-5 text-sm">
            <div class="rounded-lg bg-slate-50 p-4">
                <dl class="space-y-3">
                    <div class="flex items-start justify-between gap-4">
                        <dt class="text-slate-500">Invoice</dt>
                        <dd id="delete-modal-invoice" class="text-right font-semibold text-slate-950">-</dd>
                    </div>
                    <div class="flex items-start justify-between gap-4">
                        <dt class="text-slate-500">Resi</dt>
                        <dd id="delete-modal-receipt" class="text-right font-semibold text-slate-950">-</dd>
                    </div>
                    <div class="flex items-start justify-between gap-4">
                        <dt class="text-slate-500">Customer</dt>
                        <dd id="delete-modal-customer" class="text-right font-semibold text-slate-950">-</dd>
                    </div>
                </dl>
            </div>
        </div>

        <form id="delete-payment-form" method="POST" action="#" class="flex flex-col-reverse gap-3 border-t border-slate-200 p-5 sm:flex-row sm:justify-end">
            @csrf
            @method('DELETE')

            <button
                type="button"
                data-close-delete-modal
                class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
                Batal
            </button>

            <button
                type="submit"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-rose-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-200"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Hapus Pembayaran
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('delete-confirmation-modal');
        const deleteForm = document.getElementById('delete-payment-form');
        const deleteInvoice = document.getElementById('delete-modal-invoice');
        const deleteReceipt = document.getElementById('delete-modal-receipt');
        const deleteCustomer = document.getElementById('delete-modal-customer');

        function openDeleteModal(button) {
            deleteForm.action = button.dataset.deleteUrl;
            deleteInvoice.textContent = button.dataset.invoice || '-';
            deleteReceipt.textContent = button.dataset.receipt || '-';
            deleteCustomer.textContent = button.dataset.customer || '-';
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
            deleteModal.setAttribute('aria-hidden', 'false');
            deleteModal.querySelector('[data-close-delete-modal]').focus();
        }

        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
            deleteModal.setAttribute('aria-hidden', 'true');
            deleteForm.action = '#';
        }

        document.querySelectorAll('[data-open-delete-modal]').forEach(function (button) {
            button.addEventListener('click', function () {
                openDeleteModal(button);
            });
        });

        document.querySelectorAll('[data-close-delete-modal]').forEach(function (button) {
            button.addEventListener('click', closeDeleteModal);
        });

        if (deleteModal) {
            deleteModal.addEventListener('click', function (event) {
                if (event.target === deleteModal) {
                    closeDeleteModal();
                }
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && deleteModal && !deleteModal.classList.contains('hidden')) {
                closeDeleteModal();
            }
        });
    });
</script>

@endsection
