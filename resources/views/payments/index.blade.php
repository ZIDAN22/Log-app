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
                    KEUANGAN
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Manajemen Pembayaran
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    Kelola pembayaran invoice pelanggan, verifikasi pembayaran,
                    dan monitoring status transaksi pengiriman dalam satu halaman.
                </p>
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
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
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
                                        class="inline-flex items-center justify-center rounded-md p-2 text-slate-600 hover:bg-slate-100"
                                        title="Detail">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('payments.edit', $payment) }}"
                                        class="inline-flex items-center justify-center rounded-md p-2 text-slate-600 hover:bg-slate-100"
                                        title="Edit">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    @if($payment->status === 'pending')
                                    <form action="{{ route('payments.verify', $payment) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Verifikasi pembayaran ini?')">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center rounded-md p-2 text-slate-600 hover:bg-emerald-100"
                                            title="Verifikasi">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif

                                    <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Hapus pembayaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center rounded-md p-2 text-slate-600 hover:bg-red-100"
                                            title="Hapus">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
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

@endsection
