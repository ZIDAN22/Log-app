@extends('layouts.app')

@section('title', 'Riwayat Packing List')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">

    <div class="mx-auto max-w-[1700px]">

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                    Riwayat Packing List
                </h1>

                <p class="mt-2 text-slate-600">
                    Pantau seluruh packing list yang terbentuk otomatis dari inbound shipment.
                </p>
            </div>

        </div>

        <!-- Success -->
        @if(session('success'))
        <div
            class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        <!-- Filter -->
        <form method="GET" action="{{ route('packing-list.index') }}"
            class="mb-7 rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6 flex items-center justify-between">

                <div>
                    <h2 class="text-xl font-bold text-slate-900">
                        Filter Packing List
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Cari packing list berdasarkan nomor resi, invoice, atau tanggal.
                    </p>
                </div>

            </div>

            <div class="grid gap-5 xl:grid-cols-4">

                <!-- Search -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Cari Resi / Invoice
                    </label>

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="No Resi atau Invoice"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                </div>

                <!-- From -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Dari Tanggal
                    </label>

                    <input type="date" name="from" value="{{ request('from') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                </div>

                <!-- To -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Sampai Tanggal
                    </label>

                    <input type="date" name="to" value="{{ request('to') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                </div>

                <!-- Action -->
                <div class="flex items-end gap-3">

                    <button type="submit"
                        class="w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                        Terapkan
                    </button>

                    <a href="{{ route('packing-list.index') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                        Reset
                    </a>

                </div>

            </div>

        </form>

        <!-- Table -->
        <div class="overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">

                    <div>
                        <h2 class="text-xl font-bold text-slate-900">
                            Data Packing List
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Seluruh data packing list shipment yang telah dibuat.
                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                        Total Packing List: {{ $packingLists->total() }}
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
                                Total Berat
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Total Value
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Tanggal Packing
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">

                        @forelse($packingLists as $packingList)

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-5 text-sm font-semibold text-slate-900">
                                {{ $packingList->shipment->receipt_number }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $packingList->shipment->invoice_number }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $packingList->shipment->sender_name }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $packingList->total_qty }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ number_format($packingList->total_weight, 2, ',', '.') }} kg
                            </td>

                            <td class="px-6 py-5 text-sm font-bold text-slate-900">
                                Rp {{ number_format($packingList->total_value, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $packingList->packing_date->format('d M Y') }}
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- Detail -->
                                    <a href="{{ route('packing-list.show', $packingList) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700 transition hover:bg-slate-200"
                                        title="Detail Packing List">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                        </svg>

                                    </a>

                                    <!-- Print -->
                                    <a href="{{ route('packing-list.print-pdf', $packingList) }}" target="_blank"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700 transition hover:bg-blue-200"
                                        title="Print Packing List">

                                        <!-- PRINT ICON -->
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-8 0h8v4H10v-4z" />

                                        </svg>
                                    </a>

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

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                                        </svg>

                                    </div>

                                    <h3 class="text-lg font-semibold text-slate-900">
                                        Belum Ada Packing List
                                    </h3>

                                    <p class="mt-2 text-sm text-slate-500">
                                        Data packing list belum tersedia.
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
                <strong>{{ $packingLists->firstItem() ?? 0 }}</strong>
                sampai
                <strong>{{ $packingLists->lastItem() ?? 0 }}</strong>
                dari
                <strong>{{ $packingLists->total() }}</strong>
                hasil
            </p>

            <div>
                {{ $packingLists->links() }}
            </div>

        </div>

    </div>

</div>
@endsection