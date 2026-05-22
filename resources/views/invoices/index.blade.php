@extends('layouts.app')

@section('title', 'Daftar Invoice')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">

    <div class="mx-auto max-w-[1700px]">

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                    Daftar Invoice
                </h1>

                <p class="mt-2 text-slate-600">
                    Kelola dan pantau seluruh data invoice pengiriman.
                </p>
            </div>

            <a href="{{ route('invoices.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>

                Buat Invoice
            </a>

        </div>

        <!-- Filter -->
        <form action="{{ route('invoices.index') }}" method="GET"
            class="mb-7 rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">
                        Filter Invoice
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Cari invoice berdasarkan nomor invoice, resi, status pembayaran, dan tanggal.
                    </p>
                </div>
            </div>

            <div class="grid gap-5 xl:grid-cols-4">

                <!-- Search -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Cari Invoice / Resi
                    </label>

                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="INV-2026 / RESI-2026"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                </div>

                <!-- Status -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Status Pembayaran
                    </label>

                    <select name="payment_status"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">

                        <option value="">Semua Status</option>

                        @foreach(\App\Models\Invoice::PAYMENT_STATUSES as $status)
                        <option value="{{ $status }}"
                            {{ request('payment_status') === $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <!-- From -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Dari Tanggal
                    </label>

                    <input type="date"
                        name="from"
                        value="{{ request('from') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                </div>

                <!-- To -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Sampai Tanggal
                    </label>

                    <input type="date"
                        name="to"
                        value="{{ request('to') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                </div>

            </div>

            <!-- Action -->
            <div class="mt-6 flex flex-wrap justify-end gap-3">

                <a href="{{ route('invoices.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                    Reset
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Terapkan Filter
                </button>

            </div>

        </form>

<!-- Summary -->
<div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-4">

    <!-- Total Invoice -->
    <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-slate-500">
                    Total Invoice
                </p>

                <p class="mt-3 text-3xl font-bold text-slate-900">
                    {{ number_format($summary['total']) }}
                </p>
            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">

                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                </svg>

            </div>

        </div>
    </div>

    <!-- Belum Bayar -->
    <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-slate-500">
                    Belum Bayar
                </p>

                <p class="mt-3 text-3xl font-bold text-red-600">
                    {{ number_format($summary['unpaid']) }}
                </p>
            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-100 text-red-600">

                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728" />

                </svg>

            </div>

        </div>
    </div>

    <!-- DP -->
    <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-slate-500">
                    DP
                </p>

                <p class="mt-3 text-3xl font-bold text-amber-600">
                    {{ number_format($summary['dp']) }}
                </p>
            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">

                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3 1.343 3 3-1.343 3-3 3m0-12V4m0 4v4m0 4v4" />

                </svg>

            </div>

        </div>
    </div>

    <!-- Lunas -->
    <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-slate-500">
                    Lunas
                </p>

                <p class="mt-3 text-3xl font-bold text-emerald-600">
                    {{ number_format($summary['paid']) }}
                </p>
            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">

                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7" />

                </svg>

            </div>

        </div>
    </div>

</div>

        <!-- Table -->
        <div class="overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">

                    <div>
                        <h2 class="text-xl font-bold text-slate-900">
                            Data Invoice
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Seluruh data invoice pengiriman customer.
                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                        Total Invoice: {{ $invoices->total() }}
                    </div>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1450px] border-collapse">

                    <thead class="bg-slate-900 text-white">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Invoice
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Resi
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Customer
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider">
                                Qty
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider">
                                Berat
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider">
                                Grand Total
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">

                        @forelse($invoices as $invoice)

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-5">
                                <div class="font-semibold text-slate-900">
                                    {{ $invoice->invoice_number }}
                                </div>
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $invoice->receipt_number }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $invoice->customer_name }}
                            </td>

                            <td class="px-6 py-5 text-right text-sm text-slate-700">
                                {{ $invoice->total_qty }}
                            </td>

                            <td class="px-6 py-5 text-right text-sm text-slate-700">
                                {{ number_format($invoice->total_weight, 2, ',', '.') }} kg
                            </td>

                            <td class="px-6 py-5 text-right text-sm font-bold text-slate-900">
                                Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-5">

                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $invoice->paymentStatusBadge() }}">
                                    {{ $invoice->payment_status }}
                                </span>

                            </td>

                            <!-- Action -->
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- View -->
                                    <a href="{{ route('invoices.show', $invoice) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700 transition hover:bg-slate-200"
                                        title="Detail Invoice">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                        </svg>

                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('invoices.edit', $invoice) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 transition hover:bg-amber-200"
                                        title="Edit Invoice">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />

                                        </svg>

                                    </a>

                                    <!-- Print -->
                                    <a href="{{ route('invoices.print-pdf', $invoice) }}"
                                        target="_blank"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700 transition hover:bg-blue-200"
                                        title="Print Invoice">

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-8 0h8v4H10v-4z" />

                                        </svg>

                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('invoices.destroy', $invoice) }}"
                                        method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Hapus invoice ini?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-700 transition hover:bg-red-200"
                                            title="Hapus Invoice">

                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />

                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="8" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">

                                        <svg class="h-8 w-8 text-slate-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                        </svg>

                                    </div>

                                    <h3 class="text-lg font-semibold text-slate-900">
                                        Belum Ada Invoice
                                    </h3>

                                    <p class="mt-2 text-sm text-slate-500">
                                        Data invoice belum tersedia.
                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Pagination -->
        <div class="mt-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <p class="text-sm text-slate-600">
                Menampilkan
                <strong>{{ $invoices->firstItem() ?? 0 }}</strong>
                sampai
                <strong>{{ $invoices->lastItem() ?? 0 }}</strong>
                dari
                <strong>{{ $invoices->total() }}</strong>
                hasil
            </p>

            <div>
                {{ $invoices->withQueryString()->links() }}
            </div>

        </div>

    </div>

</div>
@endsection