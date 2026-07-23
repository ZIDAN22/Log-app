@extends('layouts.app')

@section('title', 'Dashboard Admin Operasional')

@section('content')

<div class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8 xl:px-10">

    <div class="mx-auto w-full max-w-[1600px]">

        {{-- =========================================================
            HEADER / WELCOME
        ========================================================== --}}
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="relative">

                <div class="absolute inset-0 bg-gradient-to-r from-cyan-50/80 via-white to-slate-50"></div>

                <div class="relative flex flex-col gap-6 p-6 sm:p-8 lg:flex-row lg:items-center lg:justify-between">

                    <div class="max-w-3xl">

                        <div class="flex flex-wrap items-center gap-3">

                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-cyan-200 bg-cyan-50 px-3 py-1.5 text-xs font-semibold text-cyan-700">

                                <span class="h-2 w-2 rounded-full bg-cyan-500"></span>

                                Dashboard Operasional

                            </span>

                            <span class="text-xs font-medium text-slate-400">
                                PT. Berlian Lintas Logistik
                            </span>

                        </div>

                        <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">

                            {{ $greeting }}, {{ auth()->user()->name }}

                        </h1>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">

                            Pantau pengiriman, aktivitas gudang, armada, dan driver
                            melalui satu pusat informasi operasional.

                        </p>

                    </div>


                    {{-- USER ROLE --}}
                    <div
                        class="flex min-w-[240px] items-center gap-4 rounded-2xl border border-slate-200 bg-white/90 p-4 shadow-sm">

                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-950 text-white">

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 12c2.761 0 5-2.239 5-5S14.761 2 12 2 7 4.239 7 7s2.239 5 5 5zm0 2c-4.418 0-8 1.79-8 4v2h16v-2c0-2.21-3.582-4-8-4z"
                                />

                            </svg>

                        </div>

                        <div>

                            <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                                Login Sebagai
                            </p>

                            <p class="mt-1 font-bold text-slate-900">
                                {{ auth()->user()->role_label }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
            KPI
        ========================================================== --}}
        <section class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- TOTAL SHIPMENT --}}
            <article
                class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Total Pengiriman
                        </p>

                        <h3 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">
                            {{ $summary['totalShipments'] }}
                        </h3>

                        <p class="mt-2 text-xs text-slate-400">
                            Seluruh data pengiriman
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 7h13l3 5v5H5v-5l-2-5zM16 15a2 2 0 100 4 2 2 0 000-4zm-9 0a2 2 0 100 4 2 2 0 000-4z"
                            />

                        </svg>

                    </div>

                </div>

            </article>


            {{-- SHIPMENT TODAY --}}
            <article
                class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Pengiriman Hari Ini
                        </p>

                        <h3 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">
                            {{ $summary['shipmentToday'] }}
                        </h3>

                        <p class="mt-2 text-xs text-slate-400">
                            Pengiriman terjadwal hari ini
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 7V3m8 4V3M5 11h14M5 7h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2z"
                            />

                        </svg>

                    </div>

                </div>

            </article>


            {{-- INBOUND --}}
            <article
                class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Masuk
                        </p>

                        <h3 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">
                            {{ $summary['inboundToday'] }}
                        </h3>

                        <p class="mt-2 text-xs text-slate-400">
                            Diterima hari ini
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 3v10m0 0l-4-4m4 4l4-4M5 17h14v4H5z"
                            />

                        </svg>

                    </div>

                </div>

            </article>


            {{-- OUTBOUND --}}
            <article
                class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Barang Keluar
                        </p>

                        <h3 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">
                            {{ $summary['outboundToday'] }}
                        </h3>

                        <p class="mt-2 text-xs text-slate-400">
                            Diproses hari ini
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 21V11m0 0l4 4m-4-4l-4 4M5 7h14V3H5z"
                            />

                        </svg>

                    </div>

                </div>

            </article>

        </section>


        {{-- =========================================================
            ANALYTICS
        ========================================================== --}}
        <section class="mt-6 grid gap-6 xl:grid-cols-[1.7fr_0.8fr]">

            {{-- SHIPMENT TREND --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-cyan-600">
                            Analitik Pengiriman
                        </p>

                        <h2 class="mt-1 text-lg font-bold text-slate-950">
                            Tren Pengiriman
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Perbandingan volume pengiriman berdasarkan periode.
                        </p>

                    </div>

                    <div
                        class="hidden items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-2 sm:flex">

                        <span class="h-2 w-2 rounded-full bg-cyan-500"></span>

                        <span class="text-xs font-medium text-slate-600">
                            Data Operasional
                        </span>

                    </div>

                </div>


                <div class="relative p-6">

                    {{-- GRID --}}
                    <div class="pointer-events-none absolute inset-x-6 bottom-12 top-6 flex flex-col justify-between">

                        @for ($i = 0; $i < 5; $i++)

                            <div class="border-t border-dashed border-slate-100"></div>

                        @endfor

                    </div>

                    <div
                        id="shipmentTrendChart"
                        class="relative flex h-[300px] items-end justify-between gap-3">
                    </div>

                </div>

            </section>


            {{-- DELIVERY OVERVIEW --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">

                    <p class="text-xs font-semibold uppercase tracking-wider text-cyan-600">
                        Status
                    </p>

                    <h2 class="mt-1 text-lg font-bold text-slate-950">
                        Ringkasan Pengiriman
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Distribusi status seluruh pengiriman.
                    </p>

                </div>


                <div class="space-y-4 p-5">

                    @foreach([
                        'pending' => [
                            'label' => 'Siap Dikirim',
                            'color' => 'bg-amber-500',
                            'bg' => 'bg-amber-50',
                            'text' => 'text-amber-700'
                        ],

                        'in_transit' => [
                            'label' => 'Dalam Perjalanan',
                            'color' => 'bg-sky-500',
                            'bg' => 'bg-sky-50',
                            'text' => 'text-sky-700'
                        ],

                        'delivered' => [
                            'label' => 'Sampai',
                            'color' => 'bg-emerald-500',
                            'bg' => 'bg-emerald-50',
                            'text' => 'text-emerald-700'
                        ]

                    ] as $key => $item)

                        @php

                            $count = $deliveryOverview[$key] ?? 0;

                            $percent =
                                $summary['totalShipments'] > 0
                                ? round(
                                    ($count / max($summary['totalShipments'], 1)) * 100
                                )
                                : 0;

                        @endphp


                        <div class="rounded-xl border border-slate-100 bg-slate-50/70 p-4">

                            <div class="flex items-center justify-between gap-3">

                                <div class="flex min-w-0 items-center gap-3">

                                    <span class="h-2.5 w-2.5 shrink-0 rounded-full {{ $item['color'] }}"></span>

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-semibold text-slate-800">
                                            {{ $item['label'] }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            {{ $count }} pengiriman
                                        </p>

                                    </div>

                                </div>

                                <span
                                    class="rounded-full px-2.5 py-1 text-xs font-bold {{ $item['bg'] }} {{ $item['text'] }}">

                                    {{ $percent }}%

                                </span>

                            </div>


                            <div class="mt-4 h-1.5 overflow-hidden rounded-full bg-slate-200">

                                <div
                                    class="delivery-progress h-full rounded-full {{ $item['color'] }} transition-all duration-700"
                                    data-width="{{ $percent }}"
                                    style="width:0%">
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>

        </section>


        {{-- =========================================================
            RECENT SHIPMENTS
        ========================================================== --}}
        <section class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="flex flex-col gap-4 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-cyan-600">
                        Operasional
                    </p>

                    <h2 class="mt-1 text-lg font-bold text-slate-950">
                        Pengiriman Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Daftar pengiriman yang baru diproses.
                    </p>

                </div>


                <a
                    href="{{ route('pengiriman.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">

                    Lihat Semua

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />

                    </svg>

                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full min-w-[850px]">

                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                No. Resi
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                Penerima
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                Tujuan
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                Jadwal
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($recentShipments as $shipment)

                            @php
                                $statusStyles = $shipment->shipmentStatusBadge();
                            @endphp

                            <tr class="transition hover:bg-slate-50/80">

                                <td class="px-6 py-4">

                                    <p class="font-semibold text-slate-900">
                                        {{ $shipment->receipt_number }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        ID Pengiriman
                                    </p>

                                </td>


                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-cyan-50 text-sm font-bold text-cyan-700">

                                            {{ strtoupper(substr($shipment->receiver_name, 0, 1)) }}

                                        </div>

                                        <p class="font-medium text-slate-800">
                                            {{ $shipment->receiver_name }}
                                        </p>

                                    </div>

                                </td>


                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-2 text-sm text-slate-600">

                                        <svg
                                            class="h-4 w-4 shrink-0 text-slate-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 21s7-4.35 7-11A7 7 0 105 10c0 6.65 7 11 7 11z"
                                            />

                                            <circle cx="12" cy="10" r="2" />

                                        </svg>

                                        {{ $shipment->destination_city }}

                                    </div>

                                </td>


                                <td class="px-6 py-4">

                                    <span
                                        class="inline-flex rounded-full px-3 py-1.5 text-xs font-semibold {{ $statusStyles }}">

                                        {{ $shipment->shipment_status }}

                                    </span>

                                </td>


                                <td class="px-6 py-4 text-right text-sm text-slate-600">

                                    {{ optional($shipment->pickup_date)->format('d M Y') ?? '-' }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-14 text-center">

                                    <p class="font-medium text-slate-600">
                                        Belum ada data pengiriman
                                    </p>

                                    <p class="mt-1 text-sm text-slate-400">
                                        Data pengiriman terbaru akan tampil di sini.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>


        {{-- =========================================================
            INBOUND + OUTBOUND
        ========================================================== --}}
        <section class="mt-6 grid gap-6 lg:grid-cols-2">

            {{-- INBOUND --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">
                            Warehouse
                        </p>

                        <h2 class="mt-1 text-lg font-bold text-slate-950">
                            Barang Masuk Terbaru
                        </h2>

                    </div>

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 3v10m0 0l-4-4m4 4l4-4M5 17h14v4H5z"
                            />

                        </svg>

                    </div>

                </div>


                <div class="divide-y divide-slate-100">

                    @forelse($recentInbound as $inbound)

                        <div class="p-5 transition hover:bg-slate-50">

                            <div class="flex items-start justify-between gap-4">

                                <div class="min-w-0">

                                    <p class="font-semibold text-slate-900">
                                        {{ $inbound->shipment?->receipt_number ?? 'Barang Masuk' }}
                                    </p>

                                    <p class="mt-1 truncate text-sm text-slate-500">
                                        Tujuan: {{ $inbound->shipment?->destination_city ?? 'N/A' }}
                                    </p>

                                </div>

                                <span
                                    class="shrink-0 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">

                                    Selesai

                                </span>

                            </div>


                            <div class="mt-4 flex items-center justify-between text-xs text-slate-500">

                                <span>
                                    {{ $inbound->total_package }} Paket
                                </span>

                                <span>
                                    {{ optional($inbound->inbound_date)->format('d M Y') ?? '-' }}
                                </span>

                            </div>

                        </div>

                    @empty

                        <div class="p-10 text-center text-sm text-slate-500">
                            Data barang masuk tidak tersedia.
                        </div>

                    @endforelse

                </div>

            </section>


            {{-- OUTBOUND --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">
                            Warehouse
                        </p>

                        <h2 class="mt-1 text-lg font-bold text-slate-950">
                            Barang Keluar Terbaru
                        </h2>

                    </div>

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 21V11m0 0l4 4m-4-4l-4 4M5 7h14V3H5z"
                            />

                        </svg>

                    </div>

                </div>


                <div class="divide-y divide-slate-100">

                    @forelse($recentOutbound as $outbound)

                        <div class="p-5 transition hover:bg-slate-50">

                            <div class="flex items-start justify-between gap-4">

                                <div class="min-w-0">

                                    <p class="font-semibold text-slate-900">
                                        Barang Keluar
                                    </p>

                                    <p class="mt-1 truncate text-sm text-slate-500">

                                        {{ $outbound->packingList->shipment->destination_city ?? 'N/A' }}

                                    </p>

                                </div>

                                <span
                                    class="shrink-0 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">

                                    {{ $outbound->status }}

                                </span>

                            </div>


                            <div class="mt-4 flex items-center justify-between text-xs text-slate-500">

                                <span>
                                    {{ $outbound->shipping_method }}
                                </span>

                                <span>
                                    {{ optional($outbound->outbound_date)->format('d M Y') ?? '-' }}
                                </span>

                            </div>

                        </div>

                    @empty

                        <div class="p-10 text-center text-sm text-slate-500">
                            Data barang keluar tidak tersedia.
                        </div>

                    @endforelse

                </div>

            </section>

        </section>


        {{-- =========================================================
            FLEET
        ========================================================== --}}
        <section class="mt-6 grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">

            {{-- FLEET SUMMARY --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">

                    <p class="text-xs font-semibold uppercase tracking-wider text-cyan-600">
                        Armada
                    </p>

                    <h2 class="mt-1 text-lg font-bold text-slate-950">
                        Ringkasan Armada
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Ketersediaan kendaraan operasional.
                    </p>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-2 gap-4">

                        <div class="rounded-xl bg-slate-950 p-5 text-white">

                            <p class="text-xs font-medium text-slate-400">
                                Total Armada
                            </p>

                            <p class="mt-2 text-3xl font-bold">
                                {{ $totalArmada }}
                            </p>

                        </div>


                        <div class="rounded-xl border border-cyan-100 bg-cyan-50 p-5">

                            <p class="text-xs font-medium text-cyan-700">
                                Tersedia
                            </p>

                            <p class="mt-2 text-3xl font-bold text-cyan-800">
                                {{ $availableVehicle }}
                            </p>

                        </div>

                    </div>


                    <div class="mt-7 space-y-5">

                        @foreach([
                            [
                                'label' => 'Tersedia',
                                'count' => $availableVehicle,
                                'color' => 'bg-emerald-500'
                            ],
                            [
                                'label' => 'Sedang Antar',
                                'count' => $onDeliveryVehicle,
                                'color' => 'bg-sky-500'
                            ],
                            [
                                'label' => 'Perawatan',
                                'count' => $maintenanceVehicle,
                                'color' => 'bg-amber-500'
                            ]

                        ] as $item)

                            @php

                                $percent =
                                    $totalArmada > 0
                                    ? round(($item['count'] / $totalArmada) * 100)
                                    : 0;

                            @endphp


                            <div>

                                <div class="mb-2 flex items-center justify-between">

                                    <span class="text-sm font-medium text-slate-700">
                                        {{ $item['label'] }}
                                    </span>

                                    <span class="text-xs font-semibold text-slate-500">
                                        {{ $item['count'] }} Unit
                                    </span>

                                </div>

                                <div class="h-2 overflow-hidden rounded-full bg-slate-100">

                                    <div
                                        class="fleet-progress h-full rounded-full {{ $item['color'] }} transition-all duration-700"
                                        data-width="{{ $percent }}"
                                        style="width:0%">
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </section>


            {{-- VEHICLES --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">

                    <h2 class="text-lg font-bold text-slate-950">
                        Status Kendaraan
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Kendaraan dan driver yang sedang ditugaskan.
                    </p>

                </div>


                <div class="divide-y divide-slate-100">

                    @forelse($armadaVehicles as $vehicle)

                        @php

                            $style =
                                $vehicle->status === \App\Models\Vehicle::STATUS_READY
                                ? 'bg-emerald-50 text-emerald-700'
                                : (
                                    $vehicle->status === \App\Models\Vehicle::STATUS_USED
                                    ? 'bg-sky-50 text-sky-700'
                                    : 'bg-amber-50 text-amber-700'
                                );

                            $driverName =
                                $vehicle
                                    ->deliveryManagements
                                    ->first()?->driver->name ?? 'N/A';

                        @endphp


                        <div class="p-5 transition hover:bg-slate-50">

                            <div class="flex items-start justify-between gap-4">

                                <div class="flex min-w-0 items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600">

                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 7h13l3 5v5H5v-5l-2-5z"
                                            />

                                        </svg>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="font-semibold text-slate-900">
                                            {{ $vehicle->code }}
                                        </p>

                                        <p class="mt-0.5 text-sm text-slate-500">
                                            {{ $vehicle->vehicle_type }}
                                            •
                                            {{ $vehicle->license_plate }}
                                        </p>

                                    </div>

                                </div>

                                <span
                                    class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold {{ $style }}">

                                    {{ $vehicle->status }}

                                </span>

                            </div>


                            <div class="mt-4 border-t border-slate-100 pt-3 text-xs text-slate-500">

                                Driver:
                                <span class="font-medium text-slate-700">
                                    {{ $driverName }}
                                </span>

                            </div>

                        </div>

                    @empty

                        <div class="p-10 text-center text-sm text-slate-500">
                            Data kendaraan tidak tersedia.
                        </div>

                    @endforelse

                </div>

            </section>

        </section>


        {{-- =========================================================
            DRIVER
        ========================================================== --}}
        <section class="mt-6 grid gap-6 xl:grid-cols-[0.8fr_1.2fr]">

            {{-- DRIVER SUMMARY --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">

                    <p class="text-xs font-semibold uppercase tracking-wider text-cyan-600">
                        Driver
                    </p>

                    <h2 class="mt-1 text-lg font-bold text-slate-950">
                        Ringkasan Driver
                    </h2>

                </div>


                <div class="grid gap-3 p-5 sm:grid-cols-3 xl:grid-cols-1">

                    <div class="flex items-center justify-between rounded-xl border border-slate-200 p-4">

                        <span class="text-sm font-medium text-slate-600">
                            Driver Aktif
                        </span>

                        <span class="text-2xl font-bold text-slate-950">
                            {{ $activeDriverCount }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between rounded-xl border border-sky-100 bg-sky-50/60 p-4">

                        <span class="text-sm font-medium text-sky-700">
                            Sedang Antar
                        </span>

                        <span class="text-2xl font-bold text-sky-700">
                            {{ $onDeliveryDriverCount }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between rounded-xl border border-emerald-100 bg-emerald-50/60 p-4">

                        <span class="text-sm font-medium text-emerald-700">
                            Tersedia
                        </span>

                        <span class="text-2xl font-bold text-emerald-700">
                            {{ $availableDriverCount }}
                        </span>

                    </div>

                </div>

            </section>


            {{-- DRIVER STATUS --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

                    <div>

                        <h2 class="text-lg font-bold text-slate-950">
                            Status Driver
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Ketersediaan driver operasional.
                        </p>

                    </div>

                    <span class="rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                        {{ count($driverItems) }} Driver
                    </span>

                </div>


                <div class="grid gap-3 p-5 md:grid-cols-2">

                    @forelse($driverItems as $driver)

                        @php

                            $latest = $driver->deliveryManagements->first();

                            $status =
                                $latest?->delivery_status
                                ? 'Sedang Antar'
                                : (
                                    $driver->status === \App\Models\Driver::STATUS_ACTIVE
                                    ? 'Tersedia'
                                    : 'Tidak Bertugas'
                                );

                            $badge =
                                $status === 'Tersedia'
                                ? 'bg-emerald-50 text-emerald-700'
                                : (
                                    $status === 'Sedang Antar'
                                    ? 'bg-sky-50 text-sky-700'
                                    : 'bg-slate-100 text-slate-600'
                                );

                            $vehicleName =
                                $latest?->vehicle->code ?? '-';

                        @endphp


                        <div
                            class="rounded-xl border border-slate-200 p-4 transition hover:border-cyan-200 hover:bg-slate-50">

                            <div class="flex items-start justify-between gap-3">

                                <div class="flex min-w-0 items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-cyan-50 text-sm font-bold text-cyan-700">

                                        {{ strtoupper(substr($driver->name, 0, 1)) }}

                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-semibold text-slate-900">
                                            {{ $driver->name }}
                                        </p>

                                        <p class="mt-0.5 truncate text-xs text-slate-400">
                                            {{ $driver->phone }}
                                        </p>

                                    </div>

                                </div>

                                <span
                                    class="shrink-0 rounded-full px-2.5 py-1 text-[10px] font-semibold {{ $badge }}">

                                    {{ $status }}

                                </span>

                            </div>


                            <div class="mt-4 flex items-center gap-2 border-t border-slate-100 pt-3">

                                <svg
                                    class="h-4 w-4 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 7h13l3 5v5H5v-5l-2-5z"
                                    />

                                </svg>

                                <span class="text-xs text-slate-500">
                                    Armada:
                                    <span class="font-semibold text-slate-700">
                                        {{ $vehicleName }}
                                    </span>
                                </span>

                            </div>

                        </div>

                    @empty

                        <div class="col-span-full p-8 text-center text-sm text-slate-500">
                            Data driver tidak tersedia.
                        </div>

                    @endforelse

                </div>

            </section>

        </section>


        {{-- =========================================================
            TIMELINE
        ========================================================== --}}
        <section class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-cyan-600">
                        Aktivitas Sistem
                    </p>

                    <h2 class="mt-1 text-lg font-bold text-slate-950">
                        Aktivitas Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Riwayat aktivitas operasional terbaru.
                    </p>

                </div>


                <div class="flex items-center gap-2">

                    <button
                        type="button"
                        id="timelinePrevBtn"
                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50"
                        aria-label="Sebelumnya">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            />

                        </svg>

                    </button>


                    <button
                        type="button"
                        id="timelineNextBtn"
                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50"
                        aria-label="Berikutnya">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />

                        </svg>

                    </button>

                </div>

            </div>


            <div id="timelineList" class="divide-y divide-slate-100">

                @forelse($timeline->take(5) as $item)

                    <div class="timeline-item flex gap-4 px-6 py-5 transition hover:bg-slate-50">

                        <div class="relative flex shrink-0 flex-col items-center">

                            <span
                                class="mt-1 flex h-8 w-8 items-center justify-center rounded-full bg-cyan-50">

                                <span class="h-2.5 w-2.5 rounded-full bg-cyan-500"></span>

                            </span>

                        </div>


                        <div class="min-w-0 flex-1">

                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                                <h4 class="font-semibold text-slate-900">
                                    {{ $item['title'] }}
                                </h4>

                                <span class="shrink-0 text-xs text-slate-400">

                                    {{ optional($item['time'])->format('d M Y H:i') }}

                                </span>

                            </div>

                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                {{ $item['description'] }}
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="p-10 text-center text-sm text-slate-500">
                        Belum ada aktivitas terbaru.
                    </div>

                @endforelse

            </div>


            <div class="border-t border-slate-100 px-6 py-3">

                <p
                    id="timelineInfo"
                    class="text-center text-xs font-medium text-slate-400">
                </p>

            </div>

        </section>


        {{-- FOOTER SPACE --}}
        <div class="h-8"></div>

    </div>

</div>

@endsection



@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* ============================================================
       SHIPMENT TREND
    ============================================================ */

    const chartContainer =
        document.getElementById('shipmentTrendChart');

    const data =
        @json($shipmentTrend->toArray());


    if (chartContainer && data.length > 0) {

        chartContainer.innerHTML = '';

        const maxValue = Math.max(
            ...data.map(item => item.value),
            1
        );


        data.forEach((item, index) => {

            const wrapper =
                document.createElement('div');

            wrapper.className =
                'group relative flex h-full min-w-0 flex-1 flex-col items-center justify-end gap-3';


            const chartArea =
                document.createElement('div');

            chartArea.className =
                'relative flex h-full w-full items-end justify-center';


            const barTrack =
                document.createElement('div');

            barTrack.className =
                'relative h-[245px] w-full max-w-[44px] overflow-hidden rounded-lg bg-slate-100';


            const fill =
                document.createElement('div');

            fill.className =
                'absolute bottom-0 left-0 w-full rounded-lg bg-gradient-to-t from-slate-900 via-sky-600 to-cyan-400 transition-all duration-[1200ms] ease-out';

            fill.style.height = '0%';

            fill.dataset.target =
                Math.max(
                    (item.value / maxValue) * 100,
                    item.value > 0 ? 5 : 0
                );


            const tooltip =
                document.createElement('div');

            tooltip.className =
                'pointer-events-none absolute bottom-full left-1/2 z-10 mb-3 -translate-x-1/2 whitespace-nowrap rounded-lg bg-slate-950 px-2.5 py-1.5 text-xs font-semibold text-white opacity-0 shadow-lg transition group-hover:opacity-100';

            tooltip.textContent =
                `${item.value} Pengiriman`;


            const label =
                document.createElement('p');

            label.className =
                'max-w-full truncate text-xs font-semibold text-slate-500';

            label.textContent =
                item.label;


            barTrack.appendChild(fill);

            chartArea.appendChild(barTrack);
            chartArea.appendChild(tooltip);

            wrapper.appendChild(chartArea);
            wrapper.appendChild(label);

            chartContainer.appendChild(wrapper);


            setTimeout(() => {

                fill.style.height =
                    fill.dataset.target + '%';

            }, 100 + (index * 100));

        });

    }


    /* ============================================================
       DELIVERY PROGRESS
    ============================================================ */

    document
        .querySelectorAll('.delivery-progress')
        .forEach((element, index) => {

            setTimeout(() => {

                element.style.width =
                    element.dataset.width + '%';

            }, 200 + (index * 150));

        });


    /* ============================================================
       FLEET PROGRESS
    ============================================================ */

    document
        .querySelectorAll('.fleet-progress')
        .forEach((element, index) => {

            setTimeout(() => {

                element.style.width =
                    element.dataset.width + '%';

            }, 250 + (index * 150));

        });


    /* ============================================================
       TIMELINE PAGINATION
    ============================================================ */

    const timelineItems =
        Array.from(
            document.querySelectorAll('.timeline-item')
        );

    const prevButton =
        document.getElementById('timelinePrevBtn');

    const nextButton =
        document.getElementById('timelineNextBtn');

    const timelineInfo =
        document.getElementById('timelineInfo');


    /*
     * Data Blade saat ini menggunakan:
     * $timeline->take(5)
     *
     * Jadi pagination di browser hanya berlaku
     * pada item yang sudah dirender.
     */

    const itemsPerPage = 5;

    let currentPage = 1;

    const totalPages =
        Math.max(
            Math.ceil(
                timelineItems.length / itemsPerPage
            ),
            1
        );


    function renderTimeline() {

        const start =
            (currentPage - 1) * itemsPerPage;

        const end =
            start + itemsPerPage;


        timelineItems.forEach(
            (item, index) => {

                item.style.display =
                    index >= start && index < end
                    ? 'flex'
                    : 'none';

            }
        );


        if (timelineInfo) {

            timelineInfo.textContent =
                timelineItems.length > 0
                ? `Halaman ${currentPage} dari ${totalPages}`
                : '';

        }


        if (prevButton) {

            prevButton.disabled =
                currentPage <= 1;

            prevButton.classList.toggle(
                'opacity-40',
                currentPage <= 1
            );

            prevButton.classList.toggle(
                'cursor-not-allowed',
                currentPage <= 1
            );

        }


        if (nextButton) {

            nextButton.disabled =
                currentPage >= totalPages;

            nextButton.classList.toggle(
                'opacity-40',
                currentPage >= totalPages
            );

            nextButton.classList.toggle(
                'cursor-not-allowed',
                currentPage >= totalPages
            );

        }

    }


    if (prevButton) {

        prevButton.addEventListener(
            'click',
            function () {

                if (currentPage > 1) {

                    currentPage--;

                    renderTimeline();

                }

            }
        );

    }


    if (nextButton) {

        nextButton.addEventListener(
            'click',
            function () {

                if (currentPage < totalPages) {

                    currentPage++;

                    renderTimeline();

                }

            }
        );

    }


    renderTimeline();

});

</script>

@endpush