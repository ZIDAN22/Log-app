@extends('layouts.app')

@section('title', 'Outbound')

@section('content')

<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">

    <div class="mx-auto w-full max-w-screen-2xl">

        <!-- Header -->
        <div
            class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Outbound</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Riwayat Outbound</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Kelola outbound yang dibuat dari packing list
                    dan cetak surat jalan.</p>
            </div>

            <a href="{{ route('warehouse.outbound.create') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Outbound
            </a>

        </div>

        <!-- Success -->
        @if(session('success'))
        <div id="flash-success" role="alert"
            class="mb-5 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm">
            <div
                class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <p class="font-semibold">Berhasil</p>
                <p class="mt-0.5">{{ session('success') }}</p>
            </div>
            <button type="button" data-dismiss-flash
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md text-emerald-700 transition hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-200"
                aria-label="Tutup notifikasi" title="Tutup notifikasi">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        @endif

        <!-- Stats (tetap ada) -->
        <div class="grid gap-5 lg:grid-cols-4 mb-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.18em] text-slate-400">Total Barang Keluar</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['total'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.18em] text-slate-400">Siap Dikirim</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['ready'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.18em] text-slate-400">dalam perjalanan</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['inTransit'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.18em] text-slate-400">sampai</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['delivered'] }}</p>
            </div>
        </div>

        <!-- Filter -->
        <form id="outbound-filter-form" method="GET" action="{{ route('warehouse.outbound.index') }}"
            class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

            <div
                class="mb-5 flex flex-col gap-3 border-b border-slate-200 pb-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-950">Filter Barang Keluar</h2>
                    <p class="mt-1 text-sm text-slate-500">Cari dan saring outbound berdasarkan status, metode, atau
                        nomor resi.</p>
                </div>
            </div>

            <div class="grid gap-4 xl:grid-cols-4">

                <div class="xl:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Cari Resi / Customer</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nomor resi atau customer"
                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                    <select name="status"
                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option value="">Semua Status</option>
                        @foreach(App\Models\Outbound::statuses() as $status)
                        <option value="{{ $status }}" @selected(request('status')===$status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Metode Pengiriman</label>
                    <select name="method"
                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option value="">Semua Metode</option>
                        @foreach(App\Models\Outbound::shippingMethods() as $method)
                        <option value="{{ $method }}" @selected(request('method')===$method)>{{ $method }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('warehouse.outbound.index') }}"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Reset
                </a>
                <button type="submit"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    Terapkan
                </button>
            </div>

        </form>

        <!-- Table -->
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">

                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Data Outbound</h2>
                        <p class="mt-1 text-sm text-slate-500">Tabel outbound menyajikan status, resi, tujuan, dan total
                            paket.</p>
                    </div>
                    <div
                        class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        Total Outbound: {{ $outbounds->total() }}
                    </div>
                </div>

            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1450px] border-collapse text-left text-sm">
                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">No Resi</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Customer</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Tujuan</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Transportasi</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Total Package</th>

                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Total Berat</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Status</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Tanggal Outbound
                            </th>
                            <th class="px-5 py-3 text-center text-xs font-bold uppercase tracking-wide">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($outbounds as $outbound)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-5 py-4 text-sm font-semibold text-slate-900">{{
                                $outbound->packingList->shipment->receipt_number }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{
                                $outbound->packingList->shipment->receiver_name }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{
                                $outbound->packingList->shipment->destination_city }}, {{
                                $outbound->packingList->shipment->destination_province }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">
                                @php
                                    $method = $outbound->shipping_method;
                                @endphp

                                @if($method === App\Models\Outbound::SHIPPING_METHOD_LAND)
                                    <div class="font-medium text-slate-900">
                                        {{ $method }}
                                    </div>
                                    <div class="mt-1 text-xs text-slate-500">
                                        {{ $outbound->driver?->name ?? '-' }} · {{ $outbound->vehicle?->license_plate ?? $outbound->vehicle?->name ?? '-' }}
                                    </div>
                                @elseif($method === App\Models\Outbound::SHIPPING_METHOD_SEA)
                                    <div class="font-medium text-slate-900">
                                        {{ $method }}
                                    </div>
                                    <div class="mt-1 text-xs text-slate-500">
                                        {{ $outbound->packingList?->shipment?->sea_shipping ?? '-' }}
                                        @if(!empty($outbound->packingList?->shipment?->sea_departure_date))
                                            · {{ optional($outbound->packingList?->shipment?->sea_departure_date)->format('d M Y') }}
                                        @endif
                                    </div>
                                @elseif($method === App\Models\Outbound::SHIPPING_METHOD_AIR)
                                    <div class="font-medium text-slate-900">
                                        {{ $method }}
                                    </div>
                                    <div class="mt-1 text-xs text-slate-500">
                                        {{ $outbound->packingList?->shipment?->air_shipping ?? '-' }}
                                        @if(!empty($outbound->packingList?->shipment?->air_departure_date))
                                            · {{ optional($outbound->packingList?->shipment?->air_departure_date)->format('d M Y') }}
                                        @endif
                                    </div>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-700">{{ $outbound->packingList->total_package }}
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-700">{{
                                number_format($outbound->packingList->total_weight, 2, ',', '.') }} kg</td>
                            <td class="px-5 py-4">
                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $outbound->statusBadge() }}">
                                    {{ $outbound->status }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $outbound->outbound_date->format('d M Y') }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('warehouse.outbound.show', $outbound) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700 transition hover:bg-slate-200"
                                        title="Detail">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('warehouse.outbound.edit', $outbound) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 transition hover:bg-amber-200"
                                        title="Edit">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>


                                    <button type="button"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-700 transition hover:bg-rose-200"
                                        title="Hapus Outbound" aria-label="Hapus Outbound" data-open-delete-modal
                                        data-delete-url="{{ route('warehouse.outbound.destroy', $outbound) }}"
                                        data-receipt="{{ $outbound->packingList->shipment->receipt_number }}"
                                        data-customer="{{ $outbound->packingList->shipment->receiver_name }}">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-slate-900">Belum Ada Data Outbound</h3>
                                    <p class="mt-2 text-sm text-slate-500">Mulai dengan membuat outbound dari packing
                                        list.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Pagination + info (biar mirip inbound) -->
        <div class="mt-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <p class="text-sm text-slate-600">
                Menampilkan
                <strong>{{ $outbounds->firstItem() ?? 0 }}</strong>
                sampai
                <strong>{{ $outbounds->lastItem() ?? 0 }}</strong>
                dari
                <strong>{{ $outbounds->total() }}</strong>
                hasil
            </p>
            <div>
                {{ $outbounds->links() }}
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="delete-confirmation-modal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4 py-6" aria-hidden="true">
            <div class="w-full max-w-md rounded-lg border border-slate-200 bg-white shadow-xl" role="dialog"
                aria-modal="true" aria-labelledby="delete-modal-title">
                <div class="flex items-start gap-3 border-b border-slate-200 p-5">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-rose-50 text-rose-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v4m0 4h.01M5.07 19h13.86a2 2 0 001.74-3L13.74 4a2 2 0 00-3.48 0L3.33 16a2 2 0 001.74 3z" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h2 id="delete-modal-title" class="text-base font-bold text-slate-950">Konfirmasi Hapus Outbound
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-slate-600">
                            Data outbound akan dihapus permanen dari daftar outbound. Periksa detail sebelum
                            melanjutkan.
                        </p>
                    </div>
                    <button type="button" data-close-delete-modal
                        class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
                        aria-label="Tutup konfirmasi">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-3 p-5 text-sm">
                    <div class="rounded-lg bg-slate-50 p-4">
                        <dl class="space-y-3">
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

                <form id="delete-outbound-form" method="POST" action="#"
                    class="flex flex-col-reverse gap-3 border-t border-slate-200 p-5 sm:flex-row sm:justify-end">
                    @csrf
                    @method('DELETE')

                    <button type="button" data-close-delete-modal
                        class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Batal
                    </button>

                    <button type="submit"
                        class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-rose-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-200">
                        Hapus Outbound
                    </button>
                </form>
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

    const deleteModal = document.getElementById('delete-confirmation-modal');
    const deleteForm = document.getElementById('delete-outbound-form');
    const deleteReceipt = document.getElementById('delete-modal-receipt');
    const deleteCustomer = document.getElementById('delete-modal-customer');

    function openDeleteModal(button) {
        deleteForm.action = button.dataset.deleteUrl;
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
            if (event.target === deleteModal) closeDeleteModal();
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