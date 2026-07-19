@extends('layouts.app')

@section('title', 'Riwayat Packing List')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Packing List</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Riwayat Packing List
                </h1>
  
            </div>
        </div>

        @if(session('success'))
            <div
                id="flash-success"
                role="alert"
                class="mb-5 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm"
            >
                <div class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="font-semibold">Berhasil</p>
                    <p class="mt-0.5">{{ session('success') }}</p>
                </div>
                <button
                    type="button"
                    data-dismiss-flash
                    class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md text-emerald-700 transition hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                    aria-label="Tutup notifikasi"
                    title="Tutup notifikasi"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @php
            $activeFilters = collect(['search','from','to'])->filter(fn ($key) => request()->filled($key))->count();
            $formatRp = fn ($value) => 'Rp ' . number_format((float) $value, 0, ',', '.');
        @endphp

        <section class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <form method="GET" action="{{ route('packing-list.index') }}" class="space-y-5">
                <div class="flex flex-col gap-3 border-b border-slate-200 pb-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Filter Packing List</h2>
                        <p class="mt-1 text-sm text-slate-500">Cari berdasarkan nomor resi, invoice, atau tanggal.</p>
                    </div>

                    <span class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ $activeFilters }} filter aktif
                    </span>
                </div>

                <div class="grid gap-4 xl:grid-cols-4">
                    <div class="xl:col-span-2">
                        <label for="search" class="mb-2 block text-sm font-semibold text-slate-700">Cari Resi / Invoice</label>
                        <input
                            id="search"
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="No Resi atau Invoice"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        />
                    </div>

                    <div>
                        <label for="from" class="mb-2 block text-sm font-semibold text-slate-700">Dari Tanggal</label>
                        <input
                            id="from"
                            type="date"
                            name="from"
                            value="{{ request('from') }}"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        />
                    </div>

                    <div>
                        <label for="to" class="mb-2 block text-sm font-semibold text-slate-700">Sampai Tanggal</label>
                        <input
                            id="to"
                            type="date"
                            name="to"
                            value="{{ request('to') }}"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        />
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-500">
                        Total data ditemukan: <span class="font-semibold text-slate-900">{{ $packingLists->total() }}</span>
                    </p>

                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                        <a
                            href="{{ route('packing-list.index') }}"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M5 19A9 9 0 0019 5" />
                            </svg>
                            Reset
                        </a>

                        <button
                            type="submit"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
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
                        <h2 class="text-base font-bold text-slate-950">Data Packing List</h2>
                        <p class="mt-1 text-sm text-slate-500">Seluruh data packing list Pengiriman yang telah dibuat.</p>
                    </div>

                    <div class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ $packingLists->total() }} packing list
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1280px] border-collapse">
                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">No Resi</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Invoice</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Pengirim</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Total Qty</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Total Berat</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Total Harga</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Tanggal Packing</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wide whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($packingLists as $packingList)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="font-semibold text-slate-950">{{ $packingList->shipment->receipt_number }}</div>
                                </td>

                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">{{ $packingList->shipment->invoice_number }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-800">{{ $packingList->shipment->sender_name }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">{{ $packingList->total_qty }}</td>

                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">{{ number_format($packingList->total_weight, 2, ',', '.') }} kg</td>
                                <td class="px-5 py-4 text-sm font-bold text-slate-950">{{ $formatRp($packingList->total_value) }}</td>
                                <td class="px-5 py-4 text-sm text-slate-700">{{ $packingList->packing_date->format('d M Y') }}</td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a
                                            href="{{ route('packing-list.show', $packingList) }}"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-700 transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-200"
                                            title="Lihat Detail"
                                            aria-label="Lihat detail packing list"
                                        >
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <a
                                            href="{{ route('packing-list.print-pdf', $packingList) }}"
                                            target="_blank"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-cyan-50 text-cyan-700 transition hover:bg-cyan-100 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                                            title="Print Packing List"
                                            aria-label="Print packing list"
                                        >
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-8 0h8v4H10v-4z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-lg bg-slate-100 text-slate-400">
                                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />
                                            </svg>
                                        </div>

                                        <h3 class="text-base font-bold text-slate-950">Belum Ada Packing List</h3>
                                        <p class="mt-2 max-w-md text-sm text-slate-500">Data packing list belum tersedia.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <div class="mt-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const flashClose = document.querySelector('[data-dismiss-flash]');
        const flashSuccess = document.getElementById('flash-success');

        if (flashClose && flashSuccess) {
            flashClose.addEventListener('click', function () {
                flashSuccess.remove();
            });
        }
    });
</script>
@endsection
