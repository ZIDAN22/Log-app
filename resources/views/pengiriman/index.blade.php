@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">SHIPMENT</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Daftar Pengiriman
                </h1>
  
            </div>

            <a
                href="{{ route('pengiriman.create') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Pengiriman
            </a>
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
            $statusOptions = \App\Models\Shipment::STATUSES;
            $formatRp = fn ($value) => 'Rp ' . number_format((float) $value, 0, ',', '.');
            $activeFilters = collect(['search', 'status', 'from', 'to'])->filter(fn ($key) => request()->filled($key))->count();
        @endphp

        <section class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <form method="GET" action="{{ route('pengiriman.index') }}" class="space-y-5">
                <div class="flex flex-col gap-3 border-b border-slate-200 pb-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Filter Pengiriman</h2>
                        <p class="mt-1 text-sm text-slate-500">Cari berdasarkan invoice, resi, nama pengirim, penerima, status, atau tanggal.</p>
                    </div>

                    <span class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ $activeFilters }} filter aktif
                    </span>
                </div>

                <div class="grid gap-4 xl:grid-cols-5">
                    <div class="xl:col-span-2">
                        <label for="search" class="mb-2 block text-sm font-semibold text-slate-700">Cari Pengiriman</label>
                        <input
                            id="search"
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Invoice, resi, pengirim, penerima"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        />
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                        <select
                            id="status"
                            name="status"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        >
                            <option value="">Semua Status</option>
                            @foreach($statusOptions as $status)
                                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
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
                        Total data ditemukan: <span class="font-semibold text-slate-900">{{ $shipments->total() }}</span>
                    </p>

                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                        <a
                            href="{{ route('pengiriman.index') }}"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        >

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
                        <h2 class="text-base font-bold text-slate-950">Data Pengiriman</h2>
                        <p class="mt-1 text-sm text-slate-500">Seluruh data pengiriman yang telah dibuat.</p>
                    </div>

                    <div class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ $shipments->total() }} Pengiriman
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1280px] border-collapse">
                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Invoice</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Resi</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Pengirim</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Penerima</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Tujuan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Transportasi</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wide whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($shipments as $shipment)
                            @php
                                $style = \App\Models\Shipment::statusStyles()[$shipment->shipment_status] ?? [
                                    'bg' => 'bg-slate-100',
                                    'text' => 'text-slate-800',
                                ];
                            @endphp

                            <tr class="transition hover:bg-slate-50">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="font-semibold text-slate-950">{{ $shipment->invoice_number }}</div>
                                    <div class="mt-1 text-xs text-slate-500">{{ optional($shipment->pickup_date)->format('d M Y') }}</div>
                                </td>

                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">{{ $shipment->receipt_number }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-800">{{ $shipment->sender_name }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-800">{{ $shipment->receiver_name }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">{{ $shipment->destination_city }}</td>

                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                        {{ ucfirst($shipment->transportation_type) }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-sm font-bold text-slate-950">{{ $formatRp($shipment->grand_total) }}</td>

                                <td class="px-5 py-4">
                                    @if($shipment->deliveryManagement)
                                        @php
                                            $deliveryStatus = $shipment->deliveryManagement->delivery_status;
                                            $statusLabel = $shipment->deliveryManagement->statusLabel();
                                            $deliveryStyles = [
                                                'ready_to_ship' => ['bg' => 'bg-violet-100', 'text' => 'text-violet-800'],
                                                'picked_up' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-800'],
                                                'in_transit' => ['bg' => 'bg-cyan-100', 'text' => 'text-cyan-800'],
                                                'arrived_destination' => ['bg' => 'bg-sky-100', 'text' => 'text-sky-800'],
                                                'delivered' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-800'],
                                                'completed' => ['bg' => 'bg-slate-100', 'text' => 'text-slate-700'],
                                            ];
                                            $style = $deliveryStyles[$deliveryStatus] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-800'];
                                        @endphp

                                        <span class="inline-flex items-center rounded-md px-2.5 py-1 text-xs font-semibold {{ $style['bg'] }} {{ $style['text'] }}">
                                            {{ $statusLabel }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-md px-2.5 py-1 text-xs font-semibold {{ $style['bg'] }} {{ $style['text'] }}">
                                            {{ $shipment->shipment_status }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a
                                            href="{{ route('pengiriman.show', $shipment) }}"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-700 transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-200"
                                            title="Lihat Detail"
                                            aria-label="Lihat detail shipment"
                                        >
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <a
                                            href="{{ route('pengiriman.edit', $shipment) }}"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-700 transition hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-amber-100"
                                            title="Edit Shipment"
                                            aria-label="Edit shipment"
                                        >
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        @if($shipment->deliveryOrder)
                                            <a
                                                href="{{ route('delivery-orders.show', $shipment->deliveryOrder) }}"
                                                target="_blank"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-700 transition hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                                title="Lihat Surat Jalan"
                                                aria-label="Lihat surat jalan"
                                            >
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-8 0h8v4H10v-4z" />
                                                </svg>
                                            </a>
                                        @else
                                            <form action="{{ route('delivery-orders.generate', $shipment) }}" method="POST" class="inline">
                                                @csrf
                                                <button
                                                    type="submit"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-cyan-50 text-cyan-700 transition hover:bg-cyan-100 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                                                    title="Buat Surat Jalan"
                                                    aria-label="Buat surat jalan"
                                                >
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-8 0h8v4H10v-4z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif

                                        <button
                                            type="button"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-rose-50 text-rose-700 transition hover:bg-rose-100 focus:outline-none focus:ring-2 focus:ring-rose-100"
                                            title="Hapus Shipment"
                                            aria-label="Hapus shipment"
                                            data-open-delete-modal
                                            data-delete-url="{{ route('pengiriman.destroy', $shipment) }}"
                                            data-invoice="{{ $shipment->invoice_number }}"
                                            data-receipt="{{ $shipment->receipt_number }}"
                                            data-customer="{{ $shipment->sender_name }} ke {{ $shipment->receiver_name }}"
                                        >
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-lg bg-slate-100 text-slate-400">
                                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />
                                            </svg>
                                        </div>

                                        <h3 class="text-base font-bold text-slate-950">Belum Ada Pengiriman</h3>
                                        <p class="mt-2 max-w-md text-sm text-slate-500">Mulai dengan membuat shipment baru atau ubah filter pencarian.</p>

                                        <a
                                            href="{{ route('pengiriman.create') }}"
                                            class="mt-5 inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                                        >
                                            Buat Pengiriman
                                        </a>
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
                <strong>{{ $shipments->firstItem() ?? 0 }}</strong>
                sampai
                <strong>{{ $shipments->lastItem() ?? 0 }}</strong>
                dari
                <strong>{{ $shipments->total() }}</strong>
                hasil
            </p>

            <div>
                {{ $shipments->links() }}
            </div>
        </div>
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
                <h2 id="delete-modal-title" class="text-base font-bold text-slate-950">Konfirmasi Hapus Pengiriman</h2>
                <p class="mt-1 text-sm leading-6 text-slate-600">
                    Data Pengiriman akan dihapus permanen dari daftar pengiriman. Periksa detailnya sebelum melanjutkan.
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
                        <dt class="text-slate-500">Rute</dt>
                        <dd id="delete-modal-customer" class="text-right font-semibold text-slate-950">-</dd>
                    </div>
                </dl>
            </div>
        </div>

        <form id="delete-shipment-form" method="POST" action="#" class="flex flex-col-reverse gap-3 border-t border-slate-200 p-5 sm:flex-row sm:justify-end">
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
                Hapus Pengiriman
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const flashClose = document.querySelector('[data-dismiss-flash]');
        const flashSuccess = document.getElementById('flash-success');
        const deleteModal = document.getElementById('delete-confirmation-modal');
        const deleteForm = document.getElementById('delete-shipment-form');
        const deleteInvoice = document.getElementById('delete-modal-invoice');
        const deleteReceipt = document.getElementById('delete-modal-receipt');
        const deleteCustomer = document.getElementById('delete-modal-customer');

        if (flashClose && flashSuccess) {
            flashClose.addEventListener('click', function () {
                flashSuccess.remove();
            });
        }

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
