@extends('layouts.app')

@section('title', 'Pembayaran')

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

            <div class="flex gap-3">
                <button type="button"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-slate-900 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>

                    Export Data
                </button>
            </div>
        </div>

        {{-- Statistics --}}
        <section class="mb-6 grid gap-5 xl:grid-cols-5">

            {{-- Total --}}
            <article class="rounded-none border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-sm font-medium text-slate-500">
                            Total Pembayaran
                        </h2>

                        <p class="mt-3 text-2xl font-semibold text-slate-950">
                            1,245
                        </p>
                    </div>

                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-sky-50 text-sky-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a5 5 0 00-10 0v2m-2 0h14l-1 11H6L5 9z" />
                        </svg>
                    </div>

                </div>
            </article>

            {{-- Lunas --}}
            <article class="rounded-none border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-sm font-medium text-slate-500">
                            Lunas
                        </h2>

                        <p class="mt-3 text-2xl font-semibold text-slate-950">
                            870
                        </p>
                    </div>

                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                </div>
            </article>

            {{-- Pending --}}
            <article class="rounded-none border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-sm font-medium text-slate-500">
                            Pending
                        </h2>

                        <p class="mt-3 text-2xl font-semibold text-slate-950">
                            230
                        </p>
                    </div>

                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-amber-50 text-amber-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                        </svg>
                    </div>

                </div>
            </article>

            {{-- Verifikasi --}}
            <article class="rounded-none border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-sm font-medium text-slate-500">
                            Menunggu Verifikasi
                        </h2>

                        <p class="mt-3 text-2xl font-semibold text-slate-950">
                            95
                        </p>
                    </div>

                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-violet-50 text-violet-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6" />
                        </svg>
                    </div>

                </div>
            </article>

            {{-- Pendapatan --}}
            <article class="rounded-none border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-sm font-medium text-slate-500">
                            Total Pendapatan
                        </h2>

                        <p class="mt-3 text-2xl font-semibold text-slate-950">
                            Rp245.000.000
                        </p>
                    </div>

                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-rose-50 text-rose-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-3 0-5 1.5-5 3s2 3 5 3 5 1.5 5 3-2 3-5 3" />
                        </svg>
                    </div>

                </div>
            </article>

        </section>

        {{-- Filter --}}
        <section class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

            <div
                class="flex flex-col gap-3 border-b border-slate-200 pb-4 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h2 class="text-base font-bold text-slate-950">
                        Filter & Cari
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Cari pembayaran berdasarkan invoice, customer,
                        resi, atau status pembayaran.
                    </p>
                </div>

                <span
                    class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                    245 data
                </span>

            </div>

            <div class="mt-5 grid gap-4 xl:grid-cols-4">

                <div class="xl:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Search Payment
                    </label>

                    <input type="text" placeholder="Cari Invoice, Customer, Resi..."
                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Status
                    </label>

                    <select class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm">
                        <option>Semua Status</option>
                        <option>Lunas</option>
                        <option>Pending</option>
                        <option>Verifikasi</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Metode Pembayaran
                    </label>

                    <select class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm">
                        <option>Semua Metode</option>
                        <option>Transfer Bank</option>
                        <option>Cash</option>
                        <option>E-Wallet</option>
                    </select>
                </div>

            </div>

            <div
                class="mt-5 flex flex-col gap-3 border-t border-slate-100 pt-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-sm text-slate-500">
                    Total data:
                    <span class="font-semibold text-slate-900">
                        245
                    </span>
                </p>

                <div class="flex gap-3">
                    <button
                        class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Reset
                    </button>

                    <button
                        class="inline-flex h-10 items-center justify-center rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-blue-700">
                        Terapkan Filter
                    </button>
                </div>
            </div>

        </section>

        {{-- Table --}}
        <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">
                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

                    <div>
                        <h2 class="text-base font-bold text-slate-950">
                            Daftar Pembayaran
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Kelola status pembayaran dan verifikasi transaksi pelanggan.
                        </p>
                    </div>

                    <div class="inline-flex rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        245 pembayaran
                    </div>

                </div>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1400px] border-collapse">

                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Invoice</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">No Resi</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Metode</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">Bukti</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white">
                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="font-semibold text-slate-950">
                                    INV-000124
                                </div>
                                <div class="mt-1 text-xs text-slate-500">
                                    Invoice Pengiriman
                                </div>
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-800">
                                PT Sinar Logistik Indonesia
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">
                                RESI-92817281
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center rounded-md bg-sky-50 px-2.5 py-1 text-xs font-semibold text-sky-700">
                                    Transfer Bank
                                </span>
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-slate-950">
                                Rp12.500.000
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">
                                12 Jun 2026
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                    Lunas
                                </span>
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap">
                                <button type="button"
                                    class="inline-flex items-center rounded-lg bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                                    Lihat Bukti
                                </button>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    <button type="button"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700 transition hover:bg-emerald-100"
                                        title="Verifikasi">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>

                                    <button type="button"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-700 transition hover:bg-slate-200"
                                        title="Detail">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01" />
                                        </svg>
                                    </button>

                                </div>
                            </td>
                        </tr>

                        {{-- Row 2 --}}
                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-5 font-semibold text-slate-950">
                                INV-000125
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-800">
                                CV Nusantara Cargo
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                RESI-66182921
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center rounded-md bg-violet-50 px-2.5 py-1 text-xs font-semibold text-violet-700">
                                    Cash
                                </span>
                            </td>

                            <td class="px-6 py-5 font-semibold text-slate-950">
                                Rp8.750.000
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                10 Jun 2026
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center rounded-md bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                    Pending
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <button
                                    class="inline-flex items-center rounded-lg bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-200">
                                    Belum Upload
                                </button>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <button type="button"
                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-700 transition hover:bg-slate-200"
                                    title="Detail">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01" />
                                    </svg>
                                </button>
                            </td>
                        </tr>

                        {{-- Row 3 --}}
                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-5 font-semibold text-slate-950">
                                INV-000126
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-800">
                                PT Global Freight
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                RESI-77272882
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center rounded-md bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-700">
                                    E-Wallet
                                </span>
                            </td>

                            <td class="px-6 py-5 font-semibold text-slate-950">
                                Rp15.200.000
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">
                                09 Jun 2026
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center rounded-md bg-violet-50 px-2.5 py-1 text-xs font-semibold text-violet-700">
                                    Menunggu Verifikasi
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <button
                                    class="inline-flex items-center rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 hover:bg-blue-100">
                                    Lihat Bukti
                                </button>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    <button
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700 transition hover:bg-emerald-100"
                                        title="Approve">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>

                                    <button
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-700 transition hover:bg-red-100"
                                        title="Reject">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </section>

        {{-- Footer Table --}}
        <div class="mt-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <p class="text-sm text-slate-600">
                Menampilkan
                <strong>1</strong>
                sampai
                <strong>10</strong>
                dari
                <strong>245</strong>
                hasil
            </p>

            {{-- Dummy Pagination --}}
            <div class="flex items-center gap-2">

                <button
                    class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Previous
                </button>

                <button
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-sm font-semibold text-white">
                    1
                </button>

                <button
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-300 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50">
                    2
                </button>

                <button
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-300 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50">
                    3
                </button>

                <button
                    class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Next
                </button>

            </div>
        </div>

    </div>
</div>
@endsection