@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Finance</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Laporan Keuangan</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    Pantau status invoice, pembayaran customer, dan arus kas operasional logistik.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('finance.reports.export-pdf', request()->query()) }}"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-slate-900 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8V4m0 0L8 8m4-4l4 4M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4M8 12h8" />
                    </svg>
                    Export PDF
                </a>

            </div>
        </div>

        @php
        $formatRp = fn ($value) => 'Rp ' . number_format((float) $value, 0, ',', '.');
        @endphp

        <section class="mb-6 grid gap-5 xl:grid-cols-5">
            <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Invoice</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-950">{{ number_format($summary['total'] ?? 0) }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Belum Bayar</p>
                        <p class="mt-3 text-3xl font-semibold text-rose-600">{{ number_format($summary['unpaid'] ?? 0) }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728" />
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">DP</p>
                        <p class="mt-3 text-3xl font-semibold text-amber-600">{{ number_format($summary['dp'] ?? 0) }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m0-12V4m0 4v4m0 4v4" />
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Lunas</p>
                        <p class="mt-3 text-3xl font-semibold text-emerald-600">{{ number_format($summary['paid'] ?? 0) }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Pembayaran Masuk</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-950">{{ $formatRp($summary['incoming_payments'] ?? 0) }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-slate-50 text-slate-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </article>
        </section>

        <section class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <form method="GET" action="{{ route('finance.reports.index') }}" class="space-y-5">
                <div class="flex flex-col gap-3 border-b border-slate-200 pb-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Filter Laporan</h2>
                        <p class="mt-1 text-sm text-slate-500">Cari invoice dan pembayaran untuk analisis keuangan operasional.</p>
                    </div>
                    <span class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ collect(['search', 'payment_status', 'payment_method', 'from', 'to'])->filter(fn ($key) => request()->filled($key))->count() }} filter aktif
                    </span>
                </div>

                <div class="grid gap-4 xl:grid-cols-5">
                    <div class="xl:col-span-2">
                        <label for="search" class="mb-2 block text-sm font-semibold text-slate-700">Cari Invoice atau Customer</label>
                        <input id="search" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Nomor invoice, resi, customer..."
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    </div>

                    <div>
                        <label for="payment_status" class="mb-2 block text-sm font-semibold text-slate-700">Status Pembayaran</label>
                        <select id="payment_status" name="payment_status"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                            <option value="">Semua Status</option>
                            @foreach($statusOptions as $status)
                            <option value="{{ $status }}" @selected(request('payment_status') === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="payment_method" class="mb-2 block text-sm font-semibold text-slate-700">Metode Pembayaran</label>
                        <select id="payment_method" name="payment_method"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                            <option value="">Semua Metode</option>
                            @foreach($paymentMethods as $method)
                            <option value="{{ $method->method_name }}" @selected(request('payment_method') === $method->method_name)>
                                {{ $method->method_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="from" class="mb-2 block text-sm font-semibold text-slate-700">Dari Tanggal</label>
                        <input id="from" type="date" name="from" value="{{ request('from') }}"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    </div>

                    <div>
                        <label for="to" class="mb-2 block text-sm font-semibold text-slate-700">Sampai Tanggal</label>
                        <input id="to" type="date" name="to" value="{{ request('to') }}"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-500">Menampilkan <span class="font-semibold text-slate-900">{{ $invoices->count() }}</span> dari <span class="font-semibold text-slate-900">{{ $invoices->total() }}</span> invoice.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('finance.reports.index') }}"
                            class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Reset
                        </a>

                        <button type="submit"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                            </svg>
                            Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4">
                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Laporan Invoice</h2>
                        <p class="mt-1 text-sm text-slate-500">Daftar invoice dan status pembayaran pelanggan.</p>
                    </div>

                    <div class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ $invoices->total() }} invoice
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1280px] border-collapse">
                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Invoice</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Metode Pembayaran</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide whitespace-nowrap">Total Invoice</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide whitespace-nowrap">Amount Paid</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide whitespace-nowrap">Remaining</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wide whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($invoices as $invoice)
                        @php
                            $amountPaid = $invoice->payment_amount_paid_sum ?? 0;
                            $remaining = max(0, $invoice->grand_total - $amountPaid);
                        @endphp
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="font-semibold text-slate-950">{{ $invoice->invoice_number }}</div>
                                <div class="mt-1 text-xs text-slate-500">{{ $invoice->receipt_number }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm text-slate-900">{{ $invoice->customer_name }}</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-slate-900">{{ $invoice->payment_method ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                <div class="font-semibold text-slate-950">{{ $formatRp($invoice->grand_total) }}</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                <div class="font-semibold text-slate-950">{{ $formatRp($amountPaid) }}</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                <div class="font-semibold text-slate-950">{{ $formatRp($remaining) }}</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-slate-600">{{ optional($invoice->invoice_date)->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $invoice->paymentStatusBadge() }}">
                                    {{ $invoice->payment_status }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex flex-wrap items-center justify-center gap-2">
                                    <a href="{{ route('invoices.show', $invoice) }}"
                                        class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-3 text-xs font-semibold text-slate-700 transition hover:bg-slate-50">
                                        Detail
                                    </a>
                                    <a href="{{ route('invoices.print-pdf', $invoice) }}"
                                        class="inline-flex h-10 items-center justify-center rounded-lg bg-slate-900 px-3 text-xs font-semibold text-white transition hover:bg-slate-800">
                                        Print
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-sm text-slate-500">
                                Tidak ada data laporan yang cocok.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-200 px-5 py-4">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-500">Halaman {{ $invoices->currentPage() }} dari {{ $invoices->lastPage() }}</p>
                    <div class="w-full sm:w-auto">
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const printButton = document.querySelector('button[onclick="window.print()"]');
        if (!printButton) return;
    });
</script>
@endpush
