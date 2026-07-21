@extends('layouts.app')

@section('title', 'Dashboard Super Admin')

@section('content')
{{-- ===========================

Hero Dashboard
=========================== --}}
<div class="mx-auto w-full max-w-7xl px-3 sm:px-6 lg:px-8 2xl:px-0">
<section class="relative overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-sm">

    <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 via-white to-cyan-50 opacity-80"></div>

    <div class="relative p-8 lg:p-10 xl:p-12">

        <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-emerald-700">

                    Dashboard Overview

                </span>

                <h1 class="mt-5 text-3xl font-bold text-slate-900 lg:text-4xl">

                    {{ $greeting ?? 'Welcome Back' }}, {{ auth()->user()->name }}

                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">

                    Pantau seluruh aktivitas operasional perusahaan,
                    pengiriman, pergudangan, serta performa bisnis
                    melalui satu dashboard yang terintegrasi.

                </p>

            </div>

            <div class="w-full max-w-[280px] rounded-3xl border border-slate-200 bg-white p-6 shadow-sm lg:ml-auto">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">

                            Login Sebagai

                        </p>

                        <h3 class="mt-2 text-2xl font-bold text-slate-900">

                            {{ auth()->user()->role_label }}

                        </h3>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 12c2.761 0 5-2.239 5-5S14.761 2 12 2 7 4.239 7 7s2.239 5 5 5zm0 2c-4.418 0-8 1.79-8 4v2h16v-2c0-2.21-3.582-4-8-4z" />

                        </svg>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
{{-- ===========================================================
SUMMARY KPI
=========================================================== --}}

<section class="mt-8">

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Card --}}
        <article
            class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Shipment
                    </p>

                    <h2 class="mt-3 text-4xl font-bold tracking-tight text-slate-900">
                        {{ number_format($totalShipment ?? 0) }}
                    </h2>

                    <div class="mt-5 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1">

                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                        <span class="text-xs font-semibold text-emerald-700">
                            Active
                        </span>

                    </div>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">

                    {{-- icon --}}
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7h13l3 5v5H5v-5l-2-5zM16 15a2 2 0 100 4 2 2 0 000-4zm-9 0a2 2 0 100 4 2 2 0 000-4z" />
                    </svg>

                </div>

            </div>

        </article>

        {{-- Card --}}
        <article
            class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Customer
                    </p>

                    <h2 class="mt-3 text-4xl font-bold tracking-tight text-slate-900">
                        {{ number_format($totalCustomer ?? 0) }}
                    </h2>

                    <div class="mt-5 inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1">

                        <span class="h-2 w-2 rounded-full bg-slate-500"></span>

                        <span class="text-xs font-semibold text-slate-700">
                            Registered
                        </span>

                    </div>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>

                </div>

            </div>

        </article>

        {{-- Card --}}
        <article
            class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Revenue
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                        Rp {{ number_format($totalRevenue ?? 0,0,',','.') }}
                    </h2>

                    <div class="mt-5 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1">

                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                        <span class="text-xs font-semibold text-emerald-700">

                            Income

                        </span>

                    </div>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                </div>

            </div>

        </article>

        {{-- Card --}}
        <article
            class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Delivery Success
                    </p>

                    <h2 class="mt-3 text-4xl font-bold tracking-tight text-slate-900">
                        {{ $deliverySuccess ?? '98' }}%
                    </h2>

                    <div class="mt-5 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1">

                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                        <span class="text-xs font-semibold text-emerald-700">

                            Excellent

                        </span>

                    </div>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-slate-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 13l4 4L19 7" />

                    </svg>

                </div>

            </div>

        </article>

    </div>

</section>

{{-- ======================================================
ANALYTICS
====================================================== --}}

<section class="mt-8">

    <div class="grid gap-6 xl:grid-cols-3">

        {{-- Shipment Trend --}}
        <article class="xl:col-span-2 rounded-3xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-100 px-7 py-6">

                <div>

                    <h3 class="text-lg font-semibold text-slate-900">

                        Shipment Analytics

                    </h3>

                    <p class="mt-1 text-sm text-slate-500">

                        Statistik pengiriman berdasarkan periode.

                    </p>

                </div>

                <button
                    class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100">

                    Export

                </button>

            </div>

            {{-- Chart --}}
            <div class="p-7">

                <div class="h-[360px]">

                    <canvas id="shipmentChart"></canvas>

                </div>

            </div>

        </article>

        {{-- Right Summary --}}
        <article class="rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-6">

                <h3 class="text-lg font-semibold text-slate-900">

                    Performance

                </h3>

                <p class="mt-1 text-sm text-slate-500">

                    Ringkasan performa operasional.

                </p>

            </div>

            <div class="space-y-6 p-6">

                {{-- item --}}
                <div>

                    <div class="mb-2 flex justify-between">

                        <span class="text-sm text-slate-500">

                            Delivery Success

                        </span>

                        <span class="font-semibold text-slate-800">

                            {{ $deliverySuccess ?? 0 }}%

                        </span>

                    </div>

                    <div class="h-2 rounded-full bg-slate-100">

                        <div class="h-full rounded-full bg-emerald-500" style="width: {{ $deliverySuccess ?? 0 }}%;">

                        </div>

                    </div>

                </div>

                {{-- item --}}
                <div>

                    <div class="mb-2 flex justify-between">

                        <span class="text-sm text-slate-500">

                            Warehouse Capacity

                        </span>

                        <span class="font-semibold text-slate-800">

                            {{ $warehouseCapacity ?? 0 }}%

                        </span>

                    </div>

                    <div class="h-2 rounded-full bg-slate-100">

                        <div class="h-full rounded-full bg-slate-500" style="width: {{ $warehouseCapacity ?? 0 }}%;">

                        </div>

                    </div>

                </div>

                {{-- item --}}
                <div>

                    <div class="mb-2 flex justify-between">

                        <span class="text-sm text-slate-500">

                            Payment Completion

                        </span>

                        <span class="font-semibold text-slate-800">

                            {{ $paymentCompletion ?? 0 }}%

                        </span>

                    </div>

                    <div class="h-2 rounded-full bg-slate-100">

                        <div class="h-full rounded-full bg-emerald-500" style="width: {{ $paymentCompletion ?? 0 }}%;">

                        </div>

                    </div>

                </div>

            </div>

        </article>

    </div>

</section>

<section class="mt-6">

    <div class="grid gap-6 lg:grid-cols-2">

        {{-- Revenue --}}
        <article class="rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-5">

                <h3 class="font-semibold text-slate-900">

                    Revenue Overview

                </h3>

            </div>

            <div class="p-6">

                <div class="h-[300px]">

                    <canvas id="revenueChart"></canvas>

                </div>

            </div>

        </article>

        {{-- Warehouse --}}
        <article class="rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-5">

                <h3 class="font-semibold text-slate-900">

                    Warehouse Activity

                </h3>

            </div>

            <div class="p-6">

                <div class="h-[300px]">

                    <canvas id="warehouseChart"></canvas>

                </div>

            </div>

        </article>

    </div>

</section>

{{-- ==========================================================
RECENT ACTIVITY & QUICK ACTION
========================================================== --}}

<section class="mt-8">

    <div class="grid gap-6 xl:grid-cols-3">

        {{-- ==========================================================
        RECENT ACTIVITY
        ========================================================== --}}

        <article class="xl:col-span-3 rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-slate-100 px-7 py-6">

                <div>

                    <h3 class="text-lg font-semibold text-slate-900">
                        Recent Activity
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Aktivitas terbaru seluruh operasional perusahaan.
                    </p>

                </div>

                <button
                    class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 transition">

                    View All

                </button>

            </div>

            <div class="divide-y divide-slate-100">
                @forelse($recentActivities as $activity)
                <div class="flex items-start gap-4 px-7 py-5 hover:bg-slate-50 transition">
                    <div class="mt-1 flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-slate-800">
                                {{ $activity['title'] }}
                            </h4>

                            <span class="text-xs text-slate-400">
                                {{ $activity['time']->diffForHumans() }}
                            </span>
                        </div>

                        <p class="mt-2 text-sm leading-6 text-justify text-slate-500">
                            {{ $activity['description'] }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="px-7 py-5 text-sm text-slate-500">
                    Belum ada aktivitas terbaru.
                </div>
                @endforelse
            </div>

        </article>

        {{-- ==========================================================
        QUICK ACTION
        ========================================================== --}}

        {{-- ==========================================================
        (Kosong) Quick Action
        Saat ini tidak ditampilkan agar card Recent Activity tidak terdorong/menjadi sempit.
        ========================================================== --}}


    </div>


</section>

{{-- ==========================================================
BUSINESS INSIGHT
========================================================== --}}

<section class="mt-8">

    <div class="grid gap-6 lg:grid-cols-2">

        {{-- ==========================================================
        TOP CUSTOMER
        ========================================================== --}}

        <article class="rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

                <div>

                    <h3 class="text-lg font-semibold text-slate-900">

                        Top Customers

                    </h3>

                    <p class="mt-1 text-sm text-slate-500">

                        Pelanggan dengan aktivitas pengiriman terbanyak.

                    </p>

                </div>

            </div>

            <div class="divide-y divide-slate-100">
                @forelse($topCustomers as $customer)
                <div class="flex items-center justify-between px-6 py-5">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100">
                            <span class="text-sm font-semibold text-slate-700">
                                {{ strtoupper(substr($customer->customer_name, 0, 2)) }}
                            </span>
                        </div>
                        <div>
                            <h4 class="font-medium text-slate-800">
                                {{ $customer->customer_name }}
                            </h4>
                            <p class="text-sm text-slate-500">
                                {{ number_format($customer->total_shipments) }} Shipment
                            </p>
                        </div>
                    </div>
                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                        Active
                    </span>
                </div>
                @empty
                <div class="px-6 py-5 text-sm text-slate-500">
                    Belum ada customer aktif.
                </div>
                @endforelse
            </div>

        </article>

        {{-- ==========================================================
        TOP DRIVER
        ========================================================== --}}

        <article class="rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-5">

                <h3 class="text-lg font-semibold text-slate-900">

                    Driver Performance

                </h3>

                <p class="mt-1 text-sm text-slate-500">

                    Driver dengan performa pengiriman terbaik.

                </p>

            </div>

            <div class="divide-y divide-slate-100">
                @forelse($topDrivers as $driver)
                <div class="flex items-center justify-between px-6 py-5">
                    <div>
                        <h4 class="font-medium text-slate-800">
                            {{ $driver->name }}
                        </h4>
                        <p class="text-sm text-slate-500">
                            {{ number_format($driver->total_shipments) }} Delivery
                        </p>
                    </div>
                    <div class="text-right">
                        <strong class="text-lg text-slate-900">
                            {{ $driver->total_shipments ? round(($driver->completed_shipments /
                            $driver->total_shipments) * 100) : 0 }}%
                        </strong>
                        <p class="text-xs text-slate-500">
                            Success Rate
                        </p>
                    </div>
                </div>
                @empty
                <div class="px-6 py-5 text-sm text-slate-500">
                    Belum ada data driver.
                </div>
                @endforelse
            </div>

        </article>

    </div>

</section>

<section class="mt-6">

    <div class="grid gap-6 lg:grid-cols-2">

        {{-- Vehicle --}}
        <article class="rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-5">

                <h3 class="font-semibold text-slate-900">

                    Vehicle Utilization

                </h3>

            </div>

            <div class="divide-y divide-slate-100">
                @forelse($topVehicles as $vehicle)
                <div class="flex justify-between px-6 py-5">
                    <div>
                        <h4 class="font-medium text-slate-800">
                            {{ $vehicle->license_plate }}
                        </h4>
                        <p class="text-sm text-slate-500">
                            {{ $vehicle->vehicle_type }}
                        </p>
                    </div>
                    <span class="font-semibold text-slate-800">
                        {{ number_format($vehicle->shipment_count) }} Trip
                    </span>
                </div>
                @empty
                <div class="px-6 py-5 text-sm text-slate-500">
                    Belum ada data kendaraan.
                </div>
                @endforelse
            </div>

        </article>

        {{-- Destination --}}
        <article class="rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-5">

                <h3 class="font-semibold text-slate-900">

                    Top Destination

                </h3>

            </div>

            <div class="divide-y divide-slate-100">
                @forelse($topDestination as $city => $count)
                <div class="flex justify-between px-6 py-5">
                    <div>
                        <h4 class="font-medium text-slate-800">
                            {{ $city }}
                        </h4>
                        <p class="text-sm text-slate-500">
                            Destination
                        </p>
                    </div>
                    <span class="font-semibold text-slate-800">
                        {{ number_format($count) }}
                    </span>
                </div>
                @empty
                <div class="px-6 py-5 text-sm text-slate-500">
                    Belum ada destinasi teratas.
                </div>
                @endforelse
            </div>

        </article>

    </div>

</section>

</div>

@push('scripts')
<script>
    const shipmentTrendLabels = @json($shipmentTrend->pluck('label'));
    const shipmentTrendData = @json($shipmentTrend->pluck('value'));
    const revenueTrendLabels = @json($revenueTrend->pluck('label'));
    const revenueTrendData = @json($revenueTrend->pluck('value'));
    const warehouseActivityLabels = @json($warehouseActivity['labels']);
    const warehouseActivityData = {
        inbound: @json($warehouseActivity['inbound']),
        outbound: @json($warehouseActivity['outbound']),
        packing: @json($warehouseActivity['packing']),
    };

    const defaultOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: { color: '#475569' }
            },
            tooltip: {
                mode: 'nearest',
                intersect: false
            }
        },
        scales: {
            x: {
                ticks: { color: '#64748b' },
                grid: { color: 'rgba(148, 163, 184, 0.12)' }
            },
            y: {
                beginAtZero: true,
                ticks: { color: '#64748b' },
                grid: { color: 'rgba(148, 163, 184, 0.12)' }
            }
        }
    };

    document.addEventListener('DOMContentLoaded', () => {
        const shipmentTrendCtx = document.getElementById('shipmentChart');
        if (shipmentTrendCtx && window.Chart) {
            new Chart(shipmentTrendCtx, {
                type: 'line',
                data: {
                    labels: shipmentTrendLabels,
                    datasets: [{
                        label: 'Shipment',
                        data: shipmentTrendData,
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.16)',
                        fill: true,
                        tension: 0.35,
                        pointRadius: 4,
                        pointBackgroundColor: '#10B981',
                        pointBorderColor: '#ffffff',
                        pointHoverRadius: 6
                    }]
                },
                options: defaultOptions
            });
        }

        const revenueTrendCtx = document.getElementById('revenueChart');
        if (revenueTrendCtx && window.Chart) {
            new Chart(revenueTrendCtx, {
                type: 'line',
                data: {
                    labels: revenueTrendLabels,
                    datasets: [{
                        label: 'Revenue',
                        data: revenueTrendData,
                        borderColor: '#0EA5E9',
                        backgroundColor: 'rgba(14, 165, 233, 0.16)',
                        fill: true,
                        tension: 0.35,
                        pointRadius: 4,
                        pointBackgroundColor: '#0EA5E9',
                        pointBorderColor: '#ffffff',
                        pointHoverRadius: 6
                    }]
                },
                options: defaultOptions
            });
        }

        const warehouseActivityCtx = document.getElementById('warehouseChart');
        if (warehouseActivityCtx && window.Chart) {
            new Chart(warehouseActivityCtx, {
                type: 'bar',
                data: {
                    labels: warehouseActivityLabels,
                    datasets: [
                        {
                            label: 'Barang Masuk',
                            data: warehouseActivityData.inbound,
                            backgroundColor: '#0EA5E9',
                            borderRadius: 12,
                            maxBarThickness: 24
                        },
                        {
                            label: 'Barang Keluar',
                            data: warehouseActivityData.outbound,
                            backgroundColor: '#10B981',
                            borderRadius: 12,
                            maxBarThickness: 24
                        },
                        {
                            label: 'Packing List',
                            data: warehouseActivityData.packing,
                            backgroundColor: '#F59E0B',
                            borderRadius: 12,
                            maxBarThickness: 24
                        }
                    ]
                },
                options: {
                    ...defaultOptions,
                    plugins: { legend: { position: 'top', labels: { color: '#475569' } } },
                    scales: {
                        x: { stacked: false, ticks: { color: '#64748b' }, grid: { display: false } },
                        y: { beginAtZero: true, ticks: { color: '#64748b' }, grid: { color: 'rgba(148, 163, 184, 0.12)' } }
                    }
                }
            });
        }

        const paymentStatusCtx = document.getElementById('paymentStatusChart');
        if (paymentStatusCtx && window.Chart) {
            new Chart(paymentStatusCtx, {
                type: 'pie',
                data: {
                    labels: paymentStatusLabels,
                    datasets: [{
                        data: paymentStatusData,
                        backgroundColor: ['#22C55E', '#F59E0B', '#EF4444'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { color: '#475569' } },
                        tooltip: { callbacks: { label: context => `${context.label}: ${context.parsed}` } }
                    }
                }
            });
        }

        const topDestinationCtx = document.getElementById('topDestinationChart');
        if (topDestinationCtx && window.Chart) {
            new Chart(topDestinationCtx, {
                type: 'bar',
                data: {
                    labels: topDestinationLabels,
                    datasets: [{
                        label: 'Destinasi',
                        data: topDestinationData,
                        backgroundColor: topDestinationData.map((_, index) => ['#34D399', '#60A5FA', '#FBBF24', '#A78BFA', '#38BDF8'][index]),
                        borderRadius: 12,
                        barThickness: 16
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    plugins: { legend: { display: false }, tooltip: { callbacks: { label: context => `${context.label}: ${context.parsed}` } } },
                    scales: {
                        x: { beginAtZero: true, ticks: { color: '#64748b' }, grid: { color: 'rgba(148, 163, 184, 0.12)' } },
                        y: { ticks: { color: '#64748b' }, grid: { display: false } }
                    }
                }
            });
        }

        const employeeActivityCtx = document.getElementById('employeeActivityChart');
        if (employeeActivityCtx && window.Chart) {
            new Chart(employeeActivityCtx, {
                type: 'bar',
                data: {
                    labels: employeeLabels,
                    datasets: [{
                        label: 'Aktivitas',
                        data: employeeData,
                        backgroundColor: ['#38BDF8', '#0EA5E9', '#22C55E'],
                        borderRadius: 12,
                        maxBarThickness: 34
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { callbacks: { label: context => `${context.label}: ${context.parsed}` } } },
                    scales: {
                        x: { ticks: { color: '#64748b' }, grid: { display: false } },
                        y: { beginAtZero: true, ticks: { color: '#64748b' }, grid: { color: 'rgba(148, 163, 184, 0.12)' } }
                    }
                }
            });
        }
    });
</script>
@endpush

@endsection

