@extends('layouts.app')

@section('title', 'Riwayat Inbound')

@section('content')

<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">

    <div class="mx-auto max-w-[1700px]">

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                    Riwayat Inbound
                </h1>

                <p class="mt-2 text-slate-600">
                    Pantau seluruh data inbound shipment dan detail barang masuk.
                </p>
            </div>

            <a href="{{ route('inbound.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>

                Buat Inbound
            </a>

        </div>

        <!-- Success -->
        @if(session('success'))
        <div
            class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        <!-- Filter -->
        <form method="GET" action="{{ route('inbound.index') }}"
            class="mb-7 rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-900">
                    Filter Inbound
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Cari inbound berdasarkan invoice, resi, atau tanggal inbound.
                </p>
            </div>

            <div class="grid gap-5 xl:grid-cols-4">

                <!-- Search -->
                <div class="xl:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Cari Resi / Invoice
                    </label>

                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="No Resi atau Invoice"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                </div>

                <!-- From -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Dari Tanggal
                    </label>

                    <input type="date"
                        name="from"
                        value="{{ request('from') }}"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                </div>

                <!-- To -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Sampai Tanggal
                    </label>

                    <input type="date"
                        name="to"
                        value="{{ request('to') }}"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                </div>

            </div>

            <!-- Action -->
            <div class="mt-6 flex flex-wrap justify-end gap-3">

                <a href="{{ route('inbound.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">

                    Reset
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                    Terapkan Filter
                </button>

            </div>

        </form>

        <!-- Table -->
        <div class="overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">

                    <div>
                        <h2 class="text-xl font-bold text-slate-900">
                            Data Inbound
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Seluruh data inbound shipment yang telah tercatat.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                        Total Inbound: {{ $inbounds->total() }}
                    </div>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1450px] border-collapse">

                    <thead class="bg-slate-900 text-white">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                No Resi
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Invoice
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Pengirim
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Total Qty
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Berat
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Package
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Tanggal Inbound
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">

                        @forelse($inbounds as $inbound)

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-5 text-sm font-semibold text-slate-900">
                                {{ $inbound->shipment->receipt_number }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $inbound->shipment->invoice_number }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $inbound->shipment->sender_name }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $inbound->total_qty }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ number_format($inbound->total_weight, 2, ',', '.') }} kg
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $inbound->total_package }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $inbound->inbound_date->format('d M Y') }}
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- Detail -->
                                    <a href="{{ route('inbound.show', $inbound) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700 transition hover:bg-slate-200"
                                        title="Detail Inbound">

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
                                    <a href="{{ route('inbound.edit', $inbound) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 transition hover:bg-amber-200"
                                        title="Edit Inbound">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />

                                        </svg>

                                    </a>

                                    <!-- Print -->
                                    <a href="{{ route('inbound.package-label.preview', $inbound) }}"
                                        target="_blank"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 transition hover:bg-emerald-200"
                                        title="Print Label">

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-8 0h8v4H10v-4z" />

                                        </svg>

                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('inbound.destroy', $inbound) }}"
                                        method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Hapus inbound ini?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-700 transition hover:bg-red-200"
                                            title="Hapus Inbound">

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

                                    <div
                                        class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">

                                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />

                                        </svg>

                                    </div>

                                    <h3 class="text-lg font-semibold text-slate-900">
                                        Belum Ada Data Inbound
                                    </h3>

                                    <p class="mt-2 text-sm text-slate-500">
                                        Mulai dengan membuat inbound baru terlebih dahulu.
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
                <strong>{{ $inbounds->firstItem() ?? 0 }}</strong>
                sampai
                <strong>{{ $inbounds->lastItem() ?? 0 }}</strong>
                dari
                <strong>{{ $inbounds->total() }}</strong>
                hasil

            </p>

            <div>
                {{ $inbounds->links() }}
            </div>

        </div>

    </div>

</div>

@endsection