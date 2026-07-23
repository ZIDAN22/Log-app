@extends('layouts.app')

@section('title', 'Riwayat Inbound')

@section('content')

<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">

    <div class="mx-auto w-full max-w-screen-2xl">

        <!-- Header -->
        <div
            class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Inbound</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Barang Masuk
                </h1>
  
            </div>

            <a href="{{ route('inbound.create') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">

                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Buat Barang Masuk
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

        <!-- Filter -->
        <form method="GET" action="{{ route('inbound.index') }}"
            class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

            <div
                class="mb-5 flex flex-col gap-3 border-b border-slate-200 pb-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-950">Filter Barang Masuk</h2>
                    <p class="mt-1 text-sm text-slate-500">Cari barang masuk berdasarkan invoice, resi, atau tanggal barang masuk.
                    </p>
                </div>
            </div>

            <div class="grid gap-4 xl:grid-cols-4">

                <!-- Search -->
                <div class="xl:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Cari Resi / Invoice
                    </label>

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="No Resi atau Invoice"
                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>

                <!-- From -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Dari Tanggal
                    </label>

                    <input type="date" name="from" value="{{ request('from') }}"
                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>

                <!-- To -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Sampai Tanggal
                    </label>

                    <input type="date" name="to" value="{{ request('to') }}"
                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>

            </div>

            <!-- Action -->
            <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:justify-end">

                <a href="{{ route('inbound.index') }}"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                    Reset
                </a>

                <button type="submit"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">

                    Terapkan Filter
                </button>

            </div>

        </form>

        <!-- Table -->
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">

                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

                    <div>
                        <h2 class="text-base font-bold text-slate-950">Barang Masuk</h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Seluruh data barang masuk pengiriman yang telah tercatat.
                        </p>
                    </div>

                    <div
                        class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        Total Barang Masuk: {{ $inbounds->total() }}
                    </div>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1450px] border-collapse">

                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">

                        <tr>

                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">No Resi</th>

                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Invoice</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Pengirim</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Total Qty</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Berat</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Package</th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide">Tanggal Barang Masuk
                            </th>
                            <th class="px-5 py-3 text-center text-xs font-bold uppercase tracking-wide">Action</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">

                        @forelse($inbounds as $inbound)

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-5 py-4 text-sm font-semibold text-slate-900">
                                {{ $inbound->shipment->receipt_number }}
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-700">
                                {{ $inbound->shipment->invoice_number }}
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-700">
                                {{ $inbound->shipment->sender_name }}
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-700">
                                {{ $inbound->total_qty }}
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-700">
                                {{ number_format($inbound->total_weight, 2, ',', '.') }} kg
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-700">
                                {{ $inbound->total_package }}
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-700">
                                {{ $inbound->inbound_date->format('d M Y') }}
                            </td>

                            <!-- Action -->
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- Detail -->
                                    <a href="{{ route('inbound.show', $inbound) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700 transition hover:bg-slate-200"
                                        title="Detail Inbound">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                        </svg>

                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('inbound.edit', $inbound) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 transition hover:bg-amber-200"
                                        title="Edit Inbound">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />

                                        </svg>

                                    </a>

                                    <!-- Print -->
                                    <a href="{{ route('inbound.package-label.pdf', $inbound) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-cyan-50 text-cyan-700 transition hover:bg-cyan-100 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                                        title="Download Label PDF">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-8 0h8v4H10v-4z" />
                                        </svg>

                                    </a>

                                    <!-- Delete -->
                                    <button type="button"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-700 transition hover:bg-red-200"
                                        title="Hapus Inbound" aria-label="Hapus Inbound" data-open-delete-modal
                                        data-delete-url="{{ route('inbound.destroy', $inbound) }}"
                                        data-invoice="{{ $inbound->shipment->invoice_number }}"
                                        data-receipt="{{ $inbound->shipment->receipt_number }}"
                                        data-customer="{{ $inbound->shipment->sender_name }}">
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

                            <td colspan="8" class="px-5 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div
                                        class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">

                                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                        <h2 id="delete-modal-title" class="text-base font-bold text-slate-950">Konfirmasi Hapus Inbound
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-slate-600">
                            Data inbound akan dihapus permanen dari daftar inbound. Periksa detail sebelum melanjutkan.
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
                                <dt class="text-slate-500">Invoice</dt>
                                <dd id="delete-modal-invoice" class="text-right font-semibold text-slate-950">-</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-slate-500">Resi</dt>
                                <dd id="delete-modal-receipt" class="text-right font-semibold text-slate-950">-</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt class="text-slate-500">Pengirim</dt>
                                <dd id="delete-modal-customer" class="text-right font-semibold text-slate-950">-</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <form id="delete-inbound-form" method="POST" action="#"
                    class="flex flex-col-reverse gap-3 border-t border-slate-200 p-5 sm:flex-row sm:justify-end">
                    @csrf
                    @method('DELETE')

                    <button type="button" data-close-delete-modal
                        class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Batal
                    </button>

                    <button type="submit"
                        class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-rose-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-200">
                        Hapus Inbound
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
    const deleteForm = document.getElementById('delete-inbound-form');
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