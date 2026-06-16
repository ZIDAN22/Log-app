@extends('layouts.app')

@section('title', 'Dashboard Admin Operasional')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-12 2xl:px-16">

    <div class="mx-auto w-full max-w-6xl">

        {{-- HERO SECTION --}}
        <section
            class="relative overflow-hidden rounded-none bg-gradient-to-br from-slate-950 via-slate-900 to-cyan-950 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.2)]">

            {{-- Glow --}}
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute right-0 top-0 h-80 w-80 rounded-full bg-cyan-500/10 blur-[90px]">
                </div>

                <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-sky-500/10 blur-[90px]">
                </div>
            </div>

            <div class="relative z-10 grid gap-6 xl:grid-cols-[1.3fr_0.7fr]">

                {{-- LEFT CONTENT --}}
                <div>

                    <div
                        class="inline-flex items-center gap-2 border border-white/10 bg-white/10 px-4 py-2 backdrop-blur-xl">
                        <span class="h-2 w-2 animate-pulse rounded-full bg-emerald-400"></span>

                        <span class="text-xs font-semibold uppercase tracking-[0.25em] text-cyan-100">
                            Dashboard Operasional
                        </span>
                    </div>

                    <h1 class="mt-6 text-4xl font-bold tracking-tight text-white lg:text-5xl">
                        Dashboard
                        <span class="bg-gradient-to-r from-cyan-300 to-sky-400 bg-clip-text text-transparent">
                            Admin Operasional
                        </span>
                    </h1>

                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300">
                        Pantau seluruh aktivitas logistik, armada, pengiriman,
                        inbound, outbound, serta performa operasional
                        secara real-time dalam satu dashboard modern.
                    </p>

                    {{-- QUICK ACTION --}}
                    <div class="mt-8 grid w-full gap-3 sm:grid-cols-2 lg:grid-cols-3">

                        {{-- Kelola Pengiriman --}}
                        <a href="{{ route('pengiriman.index') }}"
                            class="inline-flex items-center gap-2 rounded-none bg-cyan-700 px-5 py-3 text-sm font-semibold text-white transition duration-300 hover:scale-[1.02] hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-slate-950">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7h13l3 5v5H5v-5l-2-5zM16 15a2 2 0 100 4 2 2 0 000-4zm-9 0a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>

                            Kelola Pengiriman
                        </a>

                        {{-- Manajemen Pengiriman --}}
                        <a href="{{ route('delivery-management.index') }}"
                            class="inline-flex items-center gap-2 rounded-none bg-cyan-700 px-5 py-3 text-sm font-semibold text-white transition duration-300 hover:scale-[1.02] hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-slate-950">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6v12" />
                            </svg>

                            Manajemen Pengiriman
                        </a>

                        {{-- Barang Masuk --}}
                        <a href="{{ route('inbound.index') }}"
                            class="inline-flex items-center gap-2 rounded-none bg-cyan-700 px-5 py-3 text-sm font-semibold text-white transition duration-300 hover:scale-[1.02] hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-slate-950">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>

                            Barang Masuk
                        </a>

                        {{-- Barang Keluar --}}
                        <a href="{{ route('warehouse.outbound.index') }}"
                            class="inline-flex items-center gap-2 rounded-none bg-cyan-700 px-5 py-3 text-sm font-semibold text-white transition duration-300 hover:scale-[1.02] hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-slate-950">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                </path>
                            </svg>

                            Barang Keluar
                        </a>

                        {{-- Kendaraan --}}
                        <a href="{{ route('vehicles.index') }}"
                            class="inline-flex items-center gap-2 rounded-none bg-cyan-700 px-5 py-3 text-sm font-semibold text-white transition duration-300 hover:scale-[1.02] hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-slate-950">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414A1 1 0 0121 12v4a1 1 0 01-1 1h-1">
                                </path>
                            </svg>

                            Kendaraan
                        </a>

                        {{-- Driver --}}
                        <a href="{{ route('drivers.index') }}"
                            class="inline-flex items-center gap-2 rounded-none bg-cyan-700 px-5 py-3 text-sm font-semibold text-white transition duration-300 hover:scale-[1.02] hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-slate-950">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A6.004 6.004 0 0112 15a6.004 6.004 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            Driver
                        </a>

                    </div>
                </div>

                {{-- RIGHT PANEL --}}
                <div class="rounded-none border border-white/10 bg-white/10 p-6 backdrop-blur-2xl">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">
                                {{ $greeting }}
                            </p>

                            <h3 class="mt-2 text-2xl font-bold text-white">
                                Admin Operasional
                            </h3>
                        </div>

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-none bg-cyan-500/10 text-cyan-300">

                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A6.004 6.004 0 0112 15a6.004 6.004 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                        </div>
                    </div>

                    {{-- Date --}}
                    <div class="mt-8 rounded-none bg-slate-950/30 p-5">

                        <p class="text-sm text-slate-400">
                            Hari ini
                        </p>

                        <p class="mt-2 text-lg font-semibold text-white">
                            {{ $dayNames[$now->format('l')] }},
                            {{ $now->translatedFormat('j F Y') }}
                        </p>

                        <p id="liveClock" class="mt-2 text-3xl font-bold text-cyan-300">
                            {{ $now->format('H:i:s') }}
                        </p>
                    </div>

                    {{-- MINI KPI --}}
                    <div class="mt-5 grid grid-cols-2 gap-4">

                        <div class="rounded-none bg-emerald-500/10 p-4">
                            <p class="text-xs uppercase text-emerald-300">
                                Driver Aktif
                            </p>

                            <p class="mt-2 text-2xl font-bold text-white">
                                {{ $summary['activeDriver'] }}
                            </p>
                        </div>

                        <div class="rounded-none bg-cyan-500/10 p-4">
                            <p class="text-xs uppercase text-cyan-300">
                                Armada Aktif
                            </p>

                            <p class="mt-2 text-2xl font-bold text-white">
                                {{ $summary['activeArmada'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- KPI SECTION --}}
        <section class="mt-6 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Total Shipment --}}
            <article
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:shadow-md">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Pengiriman
                        </p>

                        <h3 class="mt-4 text-4xl font-bold text-slate-900">
                            {{ $summary['totalShipments'] }}
                        </h3>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-cyan-100 text-cyan-700">

                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7h13l3 5v5H5v-5l-2-5zM16 15a2 2 0 100 4 2 2 0 000-4zm-9 0a2 2 0 100 4 2 2 0 000-4z" />
                        </svg>
                    </div>
                </div>
            </article>

            {{-- Shipment Today --}}
            <article
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Pengiriman Hari Ini
                        </p>

                        <h3 class="mt-4 text-4xl font-bold text-slate-900">
                            {{ $summary['shipmentToday'] }}
                        </h3>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-cyan-100 text-cyan-700">

                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 4h10m-10 8h10m0 0l-3-3m3 3l-3 3M5 7h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2z" />
                        </svg>
                    </div>
                </div>
            </article>

            {{-- Inbound --}}
            <article
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Barang Masuk Hari Ini
                        </p>

                        <h3 class="mt-4 text-4xl font-bold text-slate-900">
                            {{ $summary['inboundToday'] }}
                        </h3>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-cyan-100 text-cyan-700">

                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v10m0 0l-3-3m3 3l3-3M7 17h10M5 21h14a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </article>

            {{-- Outbound --}}
            <article
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Barang Keluar Hari Ini
                        </p>

                        <h3 class="mt-4 text-4xl font-bold text-slate-900">
                            {{ $summary['outboundToday'] }}
                        </h3>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-cyan-100 text-cyan-700">

                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v10m0 0l4-4m-4 4l-4-4M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </article>

        </section>
        {{-- ANALYTICS SECTION --}}
        <section class="mt-6 grid gap-6 xl:grid-cols-[1.65fr_0.75fr]">

            {{-- SHIPMENT TREND --}}
            <section class="overflow-hidden rounded-none border border-slate-200/70 bg-white shadow-sm">

                {{-- HEADER --}}
                <div
                    class="flex flex-col gap-4 border-b border-slate-100 p-7 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-cyan-50 px-4 py-2">

                            <span class="h-2 w-2 rounded-full bg-cyan-500"></span>

                            <span class="text-xs font-semibold uppercase tracking-[0.15em] text-cyan-700">
                                Analitik
                            </span>
                        </div>

                        <h2 class="mt-4 text-2xl font-bold text-slate-900">
                            Tren Pengiriman
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Analisis volume pengiriman bulanan operasional logistik.
                        </p>
                    </div>

                    <div class="rounded-none border border-emerald-200 bg-emerald-50 px-4 py-3">

                        <p class="text-xs uppercase tracking-[0.15em] text-emerald-600">
                            Status
                        </p>

                        <div class="mt-1 flex items-center gap-2">
                            <span class="h-2 w-2 animate-pulse rounded-full bg-emerald-500"></span>

                            <span class="text-sm font-semibold text-emerald-700">
                                Analitik Langsung
                            </span>
                        </div>
                    </div>
                </div>

                {{-- CHART --}}
                <div class="relative p-7">

                    {{-- GRID --}}
                    <div
                        class="pointer-events-none absolute inset-0 flex flex-col justify-between px-7 py-8 opacity-50">

                        @for ($i = 0; $i < 5; $i++) <div class="border-t border-dashed border-slate-200">
                    </div>
                    @endfor
                </div>

                <div id="shipmentTrendChart" class="relative flex h-[350px] items-end justify-between gap-4">
                </div>
    </div>
    </section>

    {{-- DELIVERY STATUS --}}
    <section class="overflow-hidden rounded-none border border-slate-200/70 bg-white shadow-sm">

        {{-- Header --}}
        <div class="border-b border-slate-100 p-7">

            <div class="inline-flex items-center gap-2 rounded-full bg-cyan-50 px-4 py-2">

                <span class="h-2 w-2 rounded-full bg-cyan-600"></span>

                <span class="text-xs font-semibold uppercase tracking-[0.15em] text-cyan-700">
                    Pemantauan Pengiriman
                </span>
            </div>

            <h2 class="mt-4 text-2xl font-bold text-slate-900">
                Ringkasan Pengiriman
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Memantau status pengiriman aktif secara real-time.
            </p>
        </div>

        {{-- Content --}}
        <div class="space-y-6 p-7">

            @foreach([
            'pending' => [
            'label' => 'Siap Dikirim',
            'color' => 'bg-amber-500',
            'bg' => 'bg-amber-100',
            'text' => 'text-amber-700'
            ],
            'in_transit' => [
            'label' => 'Dalam Perjalanan',
            'color' => 'bg-sky-500',
            'bg' => 'bg-sky-100',
            'text' => 'text-sky-700'
            ],
            'delivered' => [
            'label' => 'Sampai',
            'color' => 'bg-emerald-500',
            'bg' => 'bg-emerald-100',
            'text' => 'text-emerald-700'
            ]
            ] as $key => $item)

            @php
            $count = $deliveryOverview[$key] ?? 0;

            $percent =
            $summary['totalShipments'] > 0
            ? round(
            ($count /
            max(
            $summary['totalShipments'],
            1,
            )) * 100,
            )
            : 0;
            @endphp

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                <div class="mb-4 flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl {{ $item['bg'] }}">

                            <div class="h-3 w-3 rounded-full {{ $item['color'] }}">
                            </div>
                        </div>

                        <div>
                            <h4 class="font-semibold text-slate-900">
                                {{ $item['label'] }}
                            </h4>

                            <p class="text-sm text-slate-500">
                                {{ $count }} pengiriman
                            </p>
                        </div>
                    </div>

                    <span class="rounded-full px-3 py-1 text-sm font-bold {{ $item['bg'] }} {{ $item['text'] }}">
                        {{ $percent }}%
                    </span>
                </div>

                <div class="relative h-2 overflow-hidden rounded-full bg-slate-200">

                    <div class="delivery-progress h-full rounded-full {{ $item['color'] }} transition-all duration-700"
                        data-width="{{ $percent }}" style="width:0%">
                    </div>
                </div>

            </div>

            @endforeach

        </div>
    </section>
    </section>
    <section class="mt-6 overflow-hidden rounded-none border border-slate-200/70 bg-white shadow-sm">

        <div class="flex flex-col gap-4 border-b border-slate-100 p-7 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-cyan-50 px-4 py-2">

                    <span class="h-2 w-2 rounded-full bg-cyan-500"></span>

                    <span class="text-xs font-semibold uppercase tracking-[0.15em] text-cyan-700">
                        Pengiriman
                    </span>
                </div>

                <h2 class="mt-4 text-2xl font-bold text-slate-900">
                    Pengiriman Terbaru
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Memantau pengiriman terbaru operasional logistik.
                </p>
            </div>

            <a href="{{ route('pengiriman.index') }}"
                class="inline-flex items-center gap-2 rounded-none bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">

                Lihat Semua

                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-fixed">

                <thead class="sticky top-0 border-b border-slate-100 bg-slate-50">

                    <tr>

                        <th class="px-7 py-5 text-left text-xs font-bold uppercase tracking-[0.15em] text-slate-500">
                            Pengiriman
                        </th>

                        <th class="px-7 py-5 text-left text-xs font-bold uppercase tracking-[0.15em] text-slate-500">
                            Pelanggan
                        </th>

                        <th class="px-7 py-5 text-left text-xs font-bold uppercase tracking-[0.15em] text-slate-500">
                            Tujuan
                        </th>

                        <th class="px-7 py-5 text-left text-xs font-bold uppercase tracking-[0.15em] text-slate-500">
                            Status
                        </th>

                        {{-- JADWAL --}}
                        <th
                            class="w-[18%] px-6 py-5 text-center text-xs font-bold uppercase tracking-[0.15em] text-slate-500">
                            Jadwal
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($recentShipments as $shipment)

                    @php
                    $statusStyles =
                    $shipment->shipmentStatusBadge();
                    @endphp

                    <tr class="transition duration-300 hover:bg-slate-50">

                        {{-- Pengiriman --}}
                        <td class="px-7 py-5">

                            <div>
                                <p class="font-semibold text-slate-900">
                                    {{ $shipment->receipt_number }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    ID Pengiriman
                                </p>
                            </div>
                        </td>

                        {{-- Pelanggan --}}
                        <td class="px-7 py-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-100 font-semibold text-cyan-700">

                                    {{ strtoupper(substr($shipment->receiver_name,0,1)) }}
                                </div>

                                <div>
                                    <p class="font-medium text-slate-900">
                                        {{ $shipment->receiver_name }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        {{-- Tujuan --}}
                        <td class="px-7 py-5 text-slate-600">
                            {{ $shipment->destination_city }}
                        </td>

                        {{-- Status --}}
                        <td class="px-7 py-5">

                            <span class="inline-flex rounded-full px-4 py-2 text-xs font-semibold {{ $statusStyles }}">

                                {{ $shipment->shipment_status }}
                            </span>
                        </td>

                        {{-- Jadwal --}}
                        <td class="px-6 py-5 text-center text-slate-600">

                            {{ optional($shipment->pickup_date)->format('d M Y') ?? '-' }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="px-6 py-14 text-center text-slate-500">

                            Data pengiriman tidak tersedia
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>
        </div>
    </section>
    <section class="mt-6 grid gap-6 lg:grid-cols-2"> {{-- INBOUND --}}
        {{-- INBOUND --}}
        <section class="overflow-hidden rounded-none border border-slate-200/70 bg-white shadow-sm">

            <div class="border-b border-slate-100 p-7">
                <h2 class="text-2xl font-bold text-slate-900">
                    Barang Masuk Terbaru
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Barang terbaru masuk ke gudang.
                </p>
            </div>

            <div class="space-y-4 p-6">

                @forelse($recentInbound as $inbound)

                <div
                    class="rounded-2xl border border-slate-200 bg-slate-50 p-5 transition duration-300 hover:border-cyan-300 hover:bg-cyan-50/30">

                    <div class="flex items-start justify-between">

                        <div>
                            <h4 class="font-semibold text-slate-900">
                                Barang Masuk
                            </h4>

                            <p class="mt-1 text-sm text-slate-500">
                                Gudang:
                                {{ $inbound->shipment?->destination_city ?? 'N/A' }}
                            </p>
                        </div>

                        <span class="rounded-full bg-cyan-100 px-3 py-2 text-xs font-semibold text-cyan-700">
                            Selesai
                        </span>
                    </div>

                    <div class="mt-5 flex items-center justify-between text-sm text-slate-600">
                        <span>
                            {{ $inbound->total_package }} Paket
                        </span>

                        <span>
                            {{ optional($inbound->inbound_date)->format('d M Y') }}
                        </span>
                    </div>
                </div>

                @empty

                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-8 text-center text-slate-500">
                    Data Barang Masuk tidak tersedia
                </div>

                @endforelse

            </div>
        </section>

        {{-- OUTBOUND --}}
        <section class="overflow-hidden rounded-none border border-slate-200/70 bg-white shadow-sm">

            <div class="border-b border-slate-100 p-7">
                <h2 class="text-2xl font-bold text-slate-900">
                    Barang Keluar Terbaru
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Pengiriman terbaru menuju pelanggan.
                </p>
            </div>

            <div class="space-y-4 p-6">

                @forelse($recentOutbound as $outbound)

                <div
                    class="rounded-2xl border border-slate-200 bg-slate-50 p-5 transition duration-300 hover:border-cyan-300 hover:bg-cyan-50/30">

                    <div class="flex items-start justify-between">

                        <div>
                            <h4 class="font-semibold text-slate-900">
                                Barang Keluar
                            </h4>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $outbound->packingList->shipment->destination_city ?? 'N/A' }}
                            </p>
                        </div>

                        <span class="rounded-full bg-cyan-100 px-3 py-2 text-xs font-semibold text-cyan-700">
                            {{ $outbound->status }}
                        </span>
                    </div>

                    <div class="mt-5 flex items-center justify-between text-sm text-slate-600">
                        <span>
                            {{ $outbound->shipping_method }}
                        </span>

                        <span>
                            {{ optional($outbound->outbound_date)->format('d M Y') }}
                        </span>
                    </div>
                </div>

                @empty

                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-8 text-center text-slate-500">
                    Data Barang Keluar tidak tersedia
                </div>

                @endforelse

            </div>
        </section>
    </section>

    {{-- ===================================== --}}
    {{-- ARMADA MANAGEMENT --}}
    {{-- ===================================== --}}
    <section class="mt-6 grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">

        {{-- FLEET OVERVIEW --}}
        <section class="overflow-hidden rounded-none border border-slate-200/70 bg-white shadow-sm">

            <div class="border-b border-slate-100 p-7">

                <div class="inline-flex items-center gap-2 rounded-full bg-cyan-50 px-4 py-2">

                    <span class="h-2 w-2 rounded-full bg-cyan-500"></span>

                    <span class="text-xs font-semibold uppercase tracking-[0.15em] text-cyan-700">
                        Pemantauan Armada
                    </span>
                </div>

                <h2 class="mt-4 text-2xl font-bold text-slate-900">
                    Armada Management
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Pemantauan kendaraan operasional secara realtime.
                </p>
            </div>

            <div class="p-7">

                {{-- KPI --}}
                <div class="grid gap-4 md:grid-cols-2">

                    <div class="rounded-2xl bg-gradient-to-br from-slate-950 to-slate-800 p-6 text-white shadow-sm">

                        <p class="text-sm text-slate-400">
                            Total Armada
                        </p>

                        <h3 class="mt-3 text-4xl font-bold">
                            {{ $totalArmada }}
                        </h3>
                    </div>

                    <div class="rounded-2xl bg-gradient-to-br from-cyan-700 to-cyan-600 p-6 text-white shadow-sm">

                        <p class="text-sm text-cyan-100">
                            Armada Tersedia
                        </p>

                        <h3 class="mt-3 text-4xl font-bold">
                            {{ $availableVehicle }}
                        </h3>
                    </div>
                </div>

                {{-- STATUS PROGRESS --}}
                <div class="mt-8 space-y-6">

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
                    ? round(
                    ($item['count'] /
                    $totalArmada) * 100
                    )
                    : 0;
                    @endphp

                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <span class="font-medium text-slate-700">
                                {{ $item['label'] }}
                            </span>

                            <span class="text-sm font-semibold text-slate-500">
                                {{ $item['count'] }} Unit
                            </span>
                        </div>

                        <div class="h-3 overflow-hidden rounded-full bg-slate-100">

                            <div class="fleet-progress h-full rounded-full {{ $item['color'] }}"
                                data-width="{{ $percent }}" style="width:0%">
                            </div>

                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </section>


        {{-- VEHICLE STATUS --}}
        <section class="overflow-hidden rounded-none border border-slate-200/70 bg-white shadow-sm">

            <div class="border-b border-slate-100 p-7">

                <h2 class="text-2xl font-bold text-slate-900">
                    Status Kendaraan
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Ringkasan kendaraan operasional.
                </p>
            </div>

            <div class="space-y-4 p-6">

                @foreach($armadaVehicles as $vehicle)

                @php
                $style =
                $vehicle->status === \App\Models\Vehicle::STATUS_READY
                ? 'bg-emerald-100 text-emerald-700'
                : ($vehicle->status === \App\Models\Vehicle::STATUS_USED
                ? 'bg-sky-100 text-sky-700'
                : 'bg-amber-100 text-amber-700');

                $driverName =
                $vehicle
                ->deliveryManagements
                ->first()?->driver->name ?? 'N/A';
                @endphp

                <div
                    class="rounded-none border border-slate-200 bg-slate-50 p-5 transition hover:border-cyan-300 hover:bg-cyan-50/20">

                    <div class="flex items-start justify-between">

                        <div>
                            <h4 class="font-semibold text-slate-900">
                                {{ $vehicle->code }}
                            </h4>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $vehicle->vehicle_type }}
                            </p>
                        </div>

                        <span class="rounded-none px-4 py-2 text-xs font-semibold {{ $style }}">
                            {{ $vehicle->status }}
                        </span>
                    </div>

                    <div class="mt-5 flex justify-between text-sm text-slate-600">

                        <span>
                            Driver:
                            {{ $driverName }}
                        </span>

                        <span>
                            {{ $vehicle->license_plate }}
                        </span>
                    </div>
                </div>

                @endforeach
            </div>
        </section>
    </section>


    {{-- ===================================== --}}
    {{-- DRIVER OVERVIEW --}}
    {{-- ===================================== --}}
    <section class="mt-6 grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">

        {{-- DRIVER KPI --}}
        {{-- DRIVER KPI --}}
        <section class="overflow-hidden rounded-none border border-slate-200/70 bg-white shadow-sm">

            <div class="border-b border-slate-100 p-7">

                <h2 class="text-2xl font-bold text-slate-900">
                    Ringkasan Driver
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Memantau driver operasional.
                </p>
            </div>

            <div class="grid gap-4 p-7 md:grid-cols-3">

                {{-- Driver Aktif --}}
                <div
                    class="rounded-2xl border border-slate-200 bg-slate-50 p-6 transition duration-300 hover:border-cyan-300">

                    <p class="text-sm text-slate-500">
                        Driver Aktif
                    </p>

                    <h3 class="mt-3 text-4xl font-bold text-slate-900">
                        {{ $activeDriverCount }}
                    </h3>
                </div>

                {{-- Sedang Antar --}}
                <div
                    class="rounded-2xl border border-cyan-100 bg-cyan-50 p-6 transition duration-300 hover:border-cyan-300">

                    <p class="text-sm text-slate-500">
                        Sedang Antar
                    </p>

                    <h3 class="mt-3 text-4xl font-bold text-cyan-700">
                        {{ $onDeliveryDriverCount }}
                    </h3>
                </div>

                {{-- Tersedia --}}
                <div
                    class="rounded-2xl border border-cyan-100 bg-cyan-50/60 p-6 transition duration-300 hover:border-cyan-300">

                    <p class="text-sm text-slate-500">
                        Tersedia
                    </p>

                    <h3 class="mt-3 text-4xl font-bold text-cyan-700">
                        {{ $availableDriverCount }}
                    </h3>
                </div>

            </div>
        </section>


        {{-- DRIVER STATUS --}}
        <section class="overflow-hidden rounded-none border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-100 px-5 py-4">
                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-lg font-bold text-slate-900">
                            Status Driver
                        </h2>

                        <p class="text-sm text-slate-500">
                            Monitoring status driver aktif
                        </p>
                    </div>

                    <span class="rounded-full bg-cyan-100 px-3 py-1 text-xs font-semibold text-cyan-700">
                        {{ count($driverItems) }} Driver
                    </span>
                </div>
            </div>

            {{-- Content --}}
            <div class="space-y-3 p-4">

                @foreach($driverItems as $driver)

                @php
                $latest = $driver->deliveryManagements->first();

                $status =
                $latest?->delivery_status
                ? 'Sedang Antar'
                : ($driver->status === \App\Models\Driver::STATUS_ACTIVE
                ? 'Tersedia'
                : 'Tidak Bertugas');

                $badge =
                $status === 'Tersedia'
                ? 'bg-cyan-100 text-cyan-700'
                : ($status === 'Sedang Antar'
                ? 'bg-cyan-200 text-cyan-800'
                : 'bg-slate-100 text-slate-600');

                $vehicleName =
                $latest?->vehicle->code ?? '-';
                @endphp

                <div
                    class="rounded-xl border border-slate-200 bg-slate-50/70 p-4 transition duration-300 hover:border-cyan-300 hover:bg-cyan-50/40">

                    <div class="flex items-start justify-between gap-3">

                        <div class="min-w-0 flex-1">

                            <div class="flex items-center gap-2">

                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-full bg-cyan-100 text-cyan-700 font-semibold text-sm">
                                    {{ strtoupper(substr($driver->name, 0, 1)) }}
                                </div>

                                <div class="min-w-0">

                                    <h4 class="truncate text-sm font-semibold text-slate-900">
                                        {{ $driver->name }}
                                    </h4>

                                    <p class="truncate text-xs text-slate-500">
                                        {{ $driver->phone }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-3 flex items-center gap-2 text-xs text-slate-500">
                                <svg class="h-4 w-4 text-cyan-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 13l1-5h16l1 5M5 13V8a1 1 0 011-1h12a1 1 0 011 1v5" />
                                </svg>

                                <span>
                                    {{ $vehicleName }}
                                </span>
                            </div>
                        </div>

                        <span class="rounded-full px-3 py-1 text-[11px] font-semibold whitespace-nowrap {{ $badge }}">
                            {{ $status }}
                        </span>
                    </div>
                </div>

                @endforeach

            </div>
        </section>
    </section>

    {{-- ===================================== --}}
    {{-- ACTIVITY TIMELINE --}}
    {{-- ===================================== --}}
    <section class="mt-6 overflow-hidden rounded-none border border-slate-200/70 bg-white shadow-sm">

        <div class="border-b border-slate-100 p-7">

            <h2 class="text-2xl font-bold text-slate-900">
                Timeline Aktivitas Terbaru
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Aktivitas operasional terbaru.
            </p>
        </div>

        <div class="space-y-4 p-7">

            <div class="flex items-center justify-between gap-3 mb-3">
                <div>
                    <p class="text-xs uppercase tracking-[0.15em] text-slate-400">Daftar Aktivitas</p>
                    <p class="mt-1 text-sm text-slate-600">Tampilkan data dengan pagination.</p>
                </div>

                <div class="flex items-center gap-2">
                    <button type="button" id="timelinePrevBtn"
                        class="rounded-none border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        aria-label="Sebelumnya">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button type="button" id="timelineNextBtn"
                        class="rounded-none border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        aria-label="Berikutnya">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="timelineList" class="space-y-4">
                @foreach($timeline->take(5) as $item)
                <div class="timeline-item flex gap-4 rounded-none bg-slate-50 p-5 transition hover:bg-slate-100">

                    <div class="mt-2 h-3 w-3 rounded-full bg-cyan-500"></div>

                    <div>
                        <h4 class="font-semibold text-slate-900">{{ $item['title'] }}</h4>
                        <p class="mt-1 text-sm text-slate-600">{{ $item['description'] }}</p>
                        <p class="mt-2 text-xs uppercase tracking-[0.15em] text-slate-400">
                            {{ optional($item['time'])->format('d M Y H:i') }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4 flex items-center justify-center gap-3">
                <p id="timelineInfo" class="text-sm font-semibold text-slate-600"></p>
            </div>
        </div>
    </section>

    @endsection

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

    // ========================================
    // REALTIME CLOCK
    // ========================================
    function updateClock() {

        const clock =
            document.getElementById('liveClock');

        if (!clock) return;

        const now = new Date();

        const formatter = new Intl.DateTimeFormat('id-ID', {
            timeZone: 'Asia/Jakarta',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false,
        });

        clock.textContent = formatter.format(now);
    }

    updateClock();
    setInterval(updateClock, 1000);


    // ========================================
    // SHIPMENT TREND CHART
    // ========================================
    const chartContainer =
        document.getElementById(
            'shipmentTrendChart'
        );

    const data =
        @json($shipmentTrend->toArray());

    if (chartContainer && data.length > 0) {

        chartContainer.innerHTML = '';

        const maxValue = Math.max(
            ...data.map(item => item.value),
            1
        );

        data.forEach((item, index) => {

            // Wrapper
            const wrapper =
                document.createElement('div');

            wrapper.className =
                'group flex h-full flex-1 flex-col items-center justify-end gap-4';

            // Chart area
            const chartArea =
                document.createElement('div');

            chartArea.className =
                'relative flex h-full w-full items-end justify-center';

            // Bar container
            const bar =
                document.createElement('div');

            bar.className =
                'relative w-full max-w-[58px] overflow-hidden rounded-none bg-slate-100 transition-all duration-500 group-hover:scale-105';

            bar.style.height = '280px';

            // Fill bar
            const fill =
                document.createElement('div');

            fill.className =
                'absolute bottom-0 w-full rounded-none bg-gradient-to-b from-cyan-400 via-sky-500 to-slate-900 transition-all duration-[1400ms] ease-out';

            fill.style.height = '0%';

            fill.dataset.target =
                (item.value / maxValue) * 100;

            // Tooltip
            const tooltip =
                document.createElement('div');

            tooltip.className =
                'absolute -top-14 left-1/2 -translate-x-1/2 rounded-none bg-slate-950 px-3 py-2 text-xs font-semibold text-white shadow-xl opacity-0 transition duration-300 group-hover:opacity-100';

            tooltip.innerHTML =
                `${item.value} Shipment`;

            // Glow
            const glow =
                document.createElement('div');

            glow.className =
                'absolute bottom-0 h-16 w-full bg-cyan-300/30 blur-2xl';

            // Label
            const label =
                document.createElement('p');

            label.className =
                'text-sm font-semibold text-slate-600';

            label.textContent =
                item.label;

            // Assemble
            bar.appendChild(glow);
            bar.appendChild(fill);

            chartArea.appendChild(bar);
            chartArea.appendChild(tooltip);

            wrapper.appendChild(chartArea);
            wrapper.appendChild(label);

            chartContainer
                .appendChild(wrapper);

            // Animate
            setTimeout(() => {

                fill.style.height =
                    fill.dataset.target + '%';

            }, index * 120);
        });
    }


    // ========================================
    // DELIVERY STATUS PROGRESS
    // ========================================
    const progressBars =
        document.querySelectorAll(
            '.delivery-progress'
        );

    progressBars.forEach((el, index) => {

        setTimeout(() => {

            el.style.width =
                el.dataset.width + '%';

        }, 250 * index);
    });


    // ========================================
    // CARD HOVER EFFECT
    // ========================================
    const cards =
        document.querySelectorAll(
            '.group-hover-card'
        );

    cards.forEach(card => {

        card.addEventListener(
            'mouseenter',
            () => {
                card.classList.add(
                    'shadow-2xl'
                );
            }
        );

        card.addEventListener(
            'mouseleave',
            () => {
                card.classList.remove(
                    'shadow-2xl'
                );
            }
        );
    });

// ========================================
// FLEET PROGRESS ANIMATION
// ========================================
document
    .querySelectorAll('.fleet-progress')
    .forEach((el, index) => {

        setTimeout(() => {

            el.style.width =
                el.dataset.width + '%';

        }, 300 * index);
    });

});
    </script>
    @endpush