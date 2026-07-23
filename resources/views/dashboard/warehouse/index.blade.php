@extends('layouts.app')

@section('title', 'Dashboard Staff Warehouse')

@section('content')

<div class="min-h-screen bg-slate-50 px-4 py-5 sm:px-6 lg:px-10 2xl:px-14">

    <div class="mx-auto w-full max-w-[1500px]">


        {{-- =========================================================
             HERO / HEADER
        ========================================================== --}}
        <section class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="absolute inset-0 bg-gradient-to-r from-amber-50/80 via-white to-slate-50"></div>

            <div class="relative px-6 py-7 lg:px-8 lg:py-8">

                <div class="flex flex-col gap-6 xl:flex-row xl:items-center xl:justify-between">


                    {{-- LEFT --}}
                    <div class="max-w-3xl">

                        <div class="flex flex-wrap items-center gap-2">

                            <span class="inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-amber-700">

                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                Staff Warehouse

                            </span>

                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-semibold text-slate-500">
                                Operasional Gudang
                            </span>

                        </div>


                        <h1 class="mt-4 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-[34px]">

                            {{ $greeting }},
                            {{ auth()->user()->name }}

                        </h1>


                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">

                            Pantau aktivitas inbound, packing list, outbound,
                            dan kesiapan pengiriman melalui satu dashboard operasional.

                        </p>


                        {{-- FILTER --}}
                        <form
                            method="GET"
                            action="{{ route('dashboard') }}"
                            id="dashboardFilter"
                            class="mt-5 inline-flex flex-wrap items-end gap-3 rounded-2xl border border-slate-200 bg-white/90 p-3 shadow-sm"
                        >


                            {{-- YEAR --}}
                            <div>

                                <label
                                    for="year"
                                    class="mb-1.5 block text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400"
                                >
                                    Tahun
                                </label>


                                <select
                                    id="year"
                                    name="year"
                                    class="min-w-[115px] rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm font-semibold text-slate-700 outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100"
                                >

                                    @for($year = 2022; $year <= now()->year; $year++)

                                        <option
                                            value="{{ $year }}"
                                            @selected($selectedYear == $year)
                                        >
                                            {{ $year }}
                                        </option>

                                    @endfor

                                </select>

                            </div>



                            {{-- MONTH --}}
                            <div>

                                <label
                                    for="month"
                                    class="mb-1.5 block text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400"
                                >
                                    Bulan
                                </label>


                                <select
                                    id="month"
                                    name="month"
                                    class="min-w-[150px] rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm font-semibold text-slate-700 outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100"
                                >

                                    @for($month = 1; $month <= 12; $month++)

                                        <option
                                            value="{{ $month }}"
                                            @selected($selectedMonth == $month)
                                        >

                                            {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}

                                        </option>

                                    @endfor

                                </select>

                            </div>



                            {{-- APPLY --}}
                            <button
                                type="submit"
                                id="applyFilterButton"
                                class="inline-flex h-[42px] items-center gap-2 rounded-xl bg-slate-900 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 disabled:cursor-not-allowed disabled:opacity-60"
                            >

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707L14 14v5l-4 2v-7L3.293 7.293A1 1 0 013 6.586V4z"
                                    />
                                </svg>

                                <span id="applyFilterText">
                                    Terapkan
                                </span>

                            </button>



                            {{-- RESET --}}
                            <a
                                href="{{ route('dashboard') }}"
                                class="inline-flex h-[42px] items-center rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50"
                            >
                                Reset
                            </a>


                        </form>

                    </div>



                    {{-- ROLE --}}
                    <div class="w-full xl:w-auto">

                        <div class="flex min-w-[260px] items-center gap-4 rounded-2xl border border-slate-200 bg-white/90 p-4 shadow-sm">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                                <svg
                                    class="h-6 w-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14L4 7m8 4v10"
                                    />
                                </svg>

                            </div>


                            <div>

                                <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                                    Login Sebagai
                                </p>

                                <p class="mt-1 text-base font-bold text-slate-900">
                                    {{ auth()->user()->role_label }}
                                </p>

                                <div class="mt-1.5 flex items-center gap-1.5">

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                    <span class="text-xs font-medium text-slate-500">
                                        Sesi aktif
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>



        {{-- =========================================================
             KPI CARDS
        ========================================================== --}}
        <section class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


            {{-- INBOUND --}}
            <article class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-xs font-semibold text-slate-500">
                            Barang Masuk
                        </p>

                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                            {{ number_format($totalInbound, 0, ',', '.') }}
                        </h3>

                        <p class="mt-1 text-xs text-slate-400">
                            Total inbound
                        </p>

                    </div>


                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 3v10m0 0l-3-3m3 3l3-3M7 17h10M5 21h14a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2z"
                            />

                        </svg>

                    </div>

                </div>

            </article>



            {{-- PACKING --}}
            <article class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-xs font-semibold text-slate-500">
                            Packing List
                        </p>

                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                            {{ number_format($totalPackingList, 0, ',', '.') }}
                        </h3>

                        <p class="mt-1 text-xs text-slate-400">
                            Total packing
                        </p>

                    </div>


                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 012-2h10a2 2 0 012 2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-4 4h-4"
                            />

                        </svg>

                    </div>

                </div>

            </article>



            {{-- OUTBOUND --}}
            <article class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-xs font-semibold text-slate-500">
                            Barang Keluar
                        </p>

                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                            {{ number_format($totalOutbound, 0, ',', '.') }}
                        </h3>

                        <p class="mt-1 text-xs text-slate-400">
                            Total outbound
                        </p>

                    </div>


                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 3v10m0 0l4-4m-4 4l-4-4M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />

                        </svg>

                    </div>

                </div>

            </article>



            {{-- READY --}}
            <article class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <p class="text-xs font-semibold text-slate-500">
                            Siap Dikirim
                        </p>

                        <h3 class="mt-2 text-3xl font-bold tracking-tight text-amber-600">
                            {{ number_format($readyToShip, 0, ',', '.') }}
                        </h3>

                        <p class="mt-1 text-xs text-slate-400">
                            Menunggu pengiriman
                        </p>

                    </div>


                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 17l3 3 3-3M12 14V5"
                            />

                        </svg>

                    </div>

                </div>

            </article>

        </section>



        {{-- =========================================================
             ANALYTICS
        ========================================================== --}}
        <section class="mt-5 grid gap-5 xl:grid-cols-[1.65fr_0.85fr]">


            {{-- =====================================================
                 WAREHOUSE CHART
            ====================================================== --}}
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                {{-- HEADER --}}
                <div class="flex flex-col gap-4 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <div class="flex items-center gap-2">

                            <span class="h-2 w-2 rounded-full bg-amber-500"></span>

                            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">
                                Warehouse Analytics
                            </p>

                        </div>


                        <h2 class="mt-2 text-lg font-bold text-slate-900">
                            Aktivitas Gudang
                        </h2>


                        <p class="mt-1 text-xs text-slate-500">
                            Perbandingan inbound, packing, dan outbound berdasarkan periode.
                        </p>

                    </div>


                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2">

                        <p class="text-[9px] font-bold uppercase tracking-wide text-slate-400">
                            Periode Aktif
                        </p>

                        <p
                            id="filterBadge"
                            class="mt-0.5 text-xs font-bold text-slate-700"
                        >
                            {{ $selectedMonthLabel }} {{ $selectedYear }}
                        </p>

                    </div>

                </div>



                {{-- SUMMARY --}}
                <div class="grid grid-cols-1 border-b border-slate-100 sm:grid-cols-3">


                    <div class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>

                            <span class="text-xs font-medium text-slate-500">
                                Barang Masuk
                            </span>

                        </div>

                        <p class="mt-1.5 text-lg font-bold text-slate-900">
                            {{ number_format($totalInbound, 0, ',', '.') }}
                        </p>

                    </div>



                    <div class="border-slate-100 px-6 py-4 sm:border-x">

                        <div class="flex items-center gap-2">

                            <span class="h-2.5 w-2.5 rounded-full bg-teal-600"></span>

                            <span class="text-xs font-medium text-slate-500">
                                Packing List
                            </span>

                        </div>

                        <p class="mt-1.5 text-lg font-bold text-slate-900">
                            {{ number_format($totalPackingList, 0, ',', '.') }}
                        </p>

                    </div>



                    <div class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <span class="h-2.5 w-2.5 rounded-full bg-slate-500"></span>

                            <span class="text-xs font-medium text-slate-500">
                                Barang Keluar
                            </span>

                        </div>

                        <p class="mt-1.5 text-lg font-bold text-slate-900">
                            {{ number_format($totalOutbound, 0, ',', '.') }}
                        </p>

                    </div>


                </div>



                {{-- CHART --}}
                <div class="relative h-[350px] p-5 sm:p-6">

                    <canvas id="warehouseActivityChart"></canvas>

                </div>

            </article>



            {{-- =====================================================
                 TRANSPORTATION
            ====================================================== --}}
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                <div class="border-b border-slate-100 px-6 py-5">

                    <div class="flex items-center gap-2">

                        <span class="h-2 w-2 rounded-full bg-teal-600"></span>

                        <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">
                            Distribution
                        </p>

                    </div>


                    <h2 class="mt-2 text-lg font-bold text-slate-900">
                        Metode Transportasi
                    </h2>


                    <p class="mt-1 text-xs text-slate-500">
                        Komposisi pengiriman berdasarkan moda transportasi.
                    </p>

                </div>



                <div class="relative h-[285px] px-5 pt-5">

                    <canvas id="shippingMethodChart"></canvas>

                </div>



                <div class="px-5 pb-5">

                    <div class="flex items-start gap-3 rounded-xl border border-slate-200 bg-slate-50 p-3">

                        <div class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white text-slate-500 shadow-sm">

                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01"
                                />

                                <circle cx="12" cy="12" r="9" stroke-width="2"></circle>

                            </svg>

                        </div>


                        <p class="text-[11px] leading-5 text-slate-500">
                            Distribusi dihitung berdasarkan data pengiriman pada periode yang dipilih.
                        </p>

                    </div>

                </div>

            </article>

        </section>



        {{-- =========================================================
             KPI OPERATIONAL
        ========================================================== --}}
        <section class="mt-5 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


            <div class="flex flex-col gap-3 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">
                        KPI Operasional
                    </p>

                    <h2 class="mt-1.5 text-lg font-bold text-slate-900">
                        Kinerja Warehouse
                    </h2>

                </div>


                <span
                    id="chartTitle"
                    class="inline-flex w-fit items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700"
                >
                    {{ $chartTitle }}
                </span>

            </div>



            <div class="grid gap-0 md:grid-cols-3">


                {{-- PACKING --}}
                <div class="p-6">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-xs font-semibold text-slate-500">
                                Kelengkapan Packing
                            </p>

                            <p class="mt-1 text-[11px] text-slate-400">
                                Rasio packing terhadap inbound
                            </p>

                        </div>


                        <span
                            id="packingCoverageValue"
                            class="text-2xl font-bold text-slate-900"
                        >
                            {{ $packingCoverage }}%
                        </span>

                    </div>


                    <div class="mt-5 h-2 overflow-hidden rounded-full bg-slate-100">

                        <div
                            id="packingCoverageBar"
                            class="h-full rounded-full bg-amber-500 transition-all duration-500"
                            style="width: {{ min($packingCoverage, 100) }}%"
                        ></div>

                    </div>

                </div>



                {{-- READINESS --}}
                <div class="border-y border-slate-100 p-6 md:border-x md:border-y-0">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-xs font-semibold text-slate-500">
                                Kesiapan Kirim
                            </p>

                            <p class="mt-1 text-[11px] text-slate-400">
                                Rasio outbound siap diproses
                            </p>

                        </div>


                        <span
                            id="dispatchReadinessValue"
                            class="text-2xl font-bold text-slate-900"
                        >
                            {{ $dispatchReadiness }}%
                        </span>

                    </div>


                    <div class="mt-5 h-2 overflow-hidden rounded-full bg-slate-100">

                        <div
                            id="dispatchReadinessBar"
                            class="h-full rounded-full bg-emerald-500 transition-all duration-500"
                            style="width: {{ min($dispatchReadiness, 100) }}%"
                        ></div>

                    </div>

                </div>



                {{-- PERFORMANCE --}}
                <div class="p-6">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-xs font-semibold text-slate-500">
                                Pencapaian Pengiriman
                            </p>

                            <p class="mt-1 text-[11px] text-slate-400">
                                Performa proses distribusi
                            </p>

                        </div>


                        <span
                            id="performanceScoreValue"
                            class="text-2xl font-bold text-slate-900"
                        >
                            {{ $performanceScore }}%
                        </span>

                    </div>


                    <div class="mt-5 h-2 overflow-hidden rounded-full bg-slate-100">

                        <div
                            id="performanceScoreBar"
                            class="h-full rounded-full bg-sky-500 transition-all duration-500"
                            style="width: {{ min($performanceScore, 100) }}%"
                        ></div>

                    </div>

                </div>


            </div>

        </section>



        {{-- =========================================================
             ACTIVITY + TODAY
        ========================================================== --}}
        <section class="mt-5 grid gap-5 xl:grid-cols-[1.35fr_0.65fr]">


            {{-- =====================================================
                 ACTIVITY
            ====================================================== --}}
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">
                            Aktivitas Terbaru
                        </p>

                        <h2 class="mt-1.5 text-lg font-bold text-slate-900">
                            Riwayat Operasional
                        </h2>

                    </div>


                    <a
                        href="{{ route('inbound.index') }}"
                        class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 transition hover:text-amber-700"
                    >

                        Lihat semua

                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />

                        </svg>

                    </a>

                </div>



                <div class="divide-y divide-slate-100">

                    @forelse($recentActivities as $activity)

                        <div class="group flex items-start gap-4 px-6 py-4 transition hover:bg-slate-50">


                            <div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-amber-600 ring-1 ring-slate-200 transition group-hover:bg-white">


                                @if($activity['icon'] === 'incoming')

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 3v10m0 0l-3-3m3 3l3-3M7 17h10"
                                        />

                                    </svg>


                                @elseif($activity['icon'] === 'box')

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 8h14M5 8a2 2 0 012-2h10a2 2 0 012 2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8"
                                        />

                                    </svg>


                                @else

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 3v10m0 0l4-4m-4 4l-4-4M5 21h14"
                                        />

                                    </svg>

                                @endif


                            </div>



                            <div class="min-w-0 flex-1">

                                <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">

                                    <p class="text-sm font-semibold text-slate-800">
                                        {{ $activity['title'] }}
                                    </p>


                                    <span class="shrink-0 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                                        {{ $activity['time']->diffForHumans() }}
                                    </span>

                                </div>


                                <p class="mt-1 text-xs leading-5 text-slate-500">
                                    {{ $activity['description'] }}
                                </p>

                            </div>

                        </div>


                    @empty

                        <div class="px-6 py-12 text-center">

                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400">

                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />

                                </svg>

                            </div>


                            <p class="mt-3 text-sm font-semibold text-slate-700">
                                Belum ada aktivitas
                            </p>


                            <p class="mt-1 text-xs text-slate-400">
                                Aktivitas warehouse terbaru akan muncul di sini.
                            </p>

                        </div>

                    @endforelse

                </div>

            </article>



            {{-- =====================================================
                 TODAY SUMMARY
            ====================================================== --}}
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                <div class="border-b border-slate-100 px-6 py-5">

                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">
                        Hari Ini
                    </p>

                    <h2 class="mt-1.5 text-lg font-bold text-slate-900">
                        Ringkasan Gudang
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Aktivitas operasional hari berjalan.
                    </p>

                </div>



                <div class="divide-y divide-slate-100">


                    {{-- INBOUND --}}
                    <div class="flex items-center justify-between gap-4 px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v12m0 0l-4-4m4 4l4-4"
                                    />

                                </svg>

                            </div>


                            <div>

                                <p class="text-xs font-semibold text-slate-700">
                                    Barang Masuk
                                </p>

                                <p class="mt-0.5 text-[10px] text-slate-400">
                                    Inbound hari ini
                                </p>

                            </div>

                        </div>


                        <span class="text-xl font-bold text-slate-900">
                            {{ number_format($inboundToday, 0, ',', '.') }}
                        </span>

                    </div>



                    {{-- PACKING --}}
                    <div class="flex items-center justify-between gap-4 px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-sky-50 text-sky-600">

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 8h14v11H5zM8 8V5h8v3"
                                    />

                                </svg>

                            </div>


                            <div>

                                <p class="text-xs font-semibold text-slate-700">
                                    Packing List
                                </p>

                                <p class="mt-0.5 text-[10px] text-slate-400">
                                    Packing hari ini
                                </p>

                            </div>

                        </div>


                        <span class="text-xl font-bold text-slate-900">
                            {{ number_format($packingToday, 0, ',', '.') }}
                        </span>

                    </div>



                    {{-- OUTBOUND --}}
                    <div class="flex items-center justify-between gap-4 px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-violet-50 text-violet-600">

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 20V8m0 0l-4 4m4-4l4 4"
                                    />

                                </svg>

                            </div>


                            <div>

                                <p class="text-xs font-semibold text-slate-700">
                                    Barang Keluar
                                </p>

                                <p class="mt-0.5 text-[10px] text-slate-400">
                                    Outbound hari ini
                                </p>

                            </div>

                        </div>


                        <span class="text-xl font-bold text-slate-900">
                            {{ number_format($outboundToday, 0, ',', '.') }}
                        </span>

                    </div>



                    {{-- TRANSIT --}}
                    <div class="flex items-center justify-between gap-4 px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 13h11V5H3v8zm11-4h4l3 3v5h-7V9zM7 19a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"
                                    />

                                </svg>

                            </div>


                            <div>

                                <p class="text-xs font-semibold text-slate-700">
                                    Dalam Perjalanan
                                </p>

                                <p class="mt-0.5 text-[10px] text-slate-400">
                                    Shipment aktif
                                </p>

                            </div>

                        </div>


                        <span class="text-xl font-bold text-amber-600">
                            {{ number_format($inTransit, 0, ',', '.') }}
                        </span>

                    </div>


                </div>

            </article>

        </section>


        {{-- FOOTER SPACE --}}
        <div class="h-8"></div>


    </div>

</div>

@endsection



{{-- =============================================================
     JAVASCRIPT
============================================================= --}}
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =========================================================
       CHECK CHART JS
    ========================================================= */

    if (!window.Chart) {

        console.error('Chart.js belum dimuat.');

        return;

    }



    /* =========================================================
       ELEMENT
    ========================================================= */

    const activityCanvas =
        document.getElementById('warehouseActivityChart');

    const methodCanvas =
        document.getElementById('shippingMethodChart');


    if (!activityCanvas || !methodCanvas) {
        return;
    }


    const activityCtx =
        activityCanvas.getContext('2d');

    const methodCtx =
        methodCanvas.getContext('2d');


    let activityChart = null;

    let methodChart = null;



    /* =========================================================
       DEFAULT CHART CONFIG
    ========================================================= */

    Chart.defaults.font.family =
        "'Inter', 'Arial', sans-serif";

    Chart.defaults.color =
        '#64748b';



    /* =========================================================
       ACTIVITY CHART
    ========================================================= */

    function createActivityChart(data) {


        if (activityChart) {

            activityChart.destroy();

        }


        activityChart = new Chart(activityCtx, {


            type: 'line',


            data: {

                labels: data.labels,


                datasets: [


                    /* =========================================
                       INBOUND
                    ========================================== */

                    {

                        label: 'Barang Masuk',

                        data: data.inbound,

                        borderColor: '#f59e0b',

                        backgroundColor:
                            'rgba(245, 158, 11, 0.08)',

                        borderWidth: 2.5,

                        pointRadius: 3,

                        pointHoverRadius: 6,

                        pointBackgroundColor:
                            '#ffffff',

                        pointBorderColor:
                            '#f59e0b',

                        pointBorderWidth: 2,

                        pointHoverBorderWidth: 3,

                        tension: 0.35,

                        fill: false

                    },



                    /* =========================================
                       PACKING
                    ========================================== */

                    {

                        label: 'Packing List',

                        data: data.packing,

                        borderColor: '#0f766e',

                        backgroundColor:
                            'rgba(15, 118, 110, 0.08)',

                        borderWidth: 2.5,

                        pointRadius: 3,

                        pointHoverRadius: 6,

                        pointBackgroundColor:
                            '#ffffff',

                        pointBorderColor:
                            '#0f766e',

                        pointBorderWidth: 2,

                        pointHoverBorderWidth: 3,

                        tension: 0.35,

                        fill: false

                    },



                    /* =========================================
                       OUTBOUND
                    ========================================== */

                    {

                        label: 'Barang Keluar',

                        data: data.outbound,

                        borderColor: '#64748b',

                        backgroundColor:
                            'rgba(100, 116, 139, 0.08)',

                        borderWidth: 2.5,

                        pointRadius: 3,

                        pointHoverRadius: 6,

                        pointBackgroundColor:
                            '#ffffff',

                        pointBorderColor:
                            '#64748b',

                        pointBorderWidth: 2,

                        pointHoverBorderWidth: 3,

                        tension: 0.35,

                        fill: false

                    }


                ]

            },



            options: {


                responsive: true,

                maintainAspectRatio: false,


                interaction: {

                    mode: 'index',

                    intersect: false

                },


                animation: {

                    duration: 600

                },



                plugins: {


                    /* =========================================
                       LEGEND
                    ========================================== */

                    legend: {

                        display: false

                    },



                    /* =========================================
                       TOOLTIP
                    ========================================== */

                    tooltip: {


                        backgroundColor:
                            '#0f172a',

                        titleColor:
                            '#ffffff',

                        bodyColor:
                            '#cbd5e1',

                        borderColor:
                            '#1e293b',

                        borderWidth:
                            1,

                        padding:
                            12,

                        cornerRadius:
                            10,

                        displayColors:
                            true,


                        callbacks: {


                            title: function(context) {

                                if (!context.length) {
                                    return '';
                                }

                                return context[0].label;

                            },


                            label: function(context) {


                                const value =
                                    context.parsed.y ?? 0;


                                return ' ' +
                                    context.dataset.label +
                                    ': ' +
                                    Number(value)
                                        .toLocaleString('id-ID');

                            }


                        }

                    }

                },



                scales: {


                    /* =========================================
                       X AXIS
                    ========================================== */

                    x: {


                        grid: {

                            display: false

                        },


                        border: {

                            display: false

                        },


                        ticks: {


                            color:
                                '#94a3b8',


                            maxRotation:
                                0,


                            font: {

                                size: 11,

                                weight: '500'

                            }

                        }

                    },



                    /* =========================================
                       Y AXIS
                    ========================================== */

                    y: {


                        beginAtZero:
                            true,


                        border: {

                            display: false

                        },


                        grid: {

                            color:
                                '#f1f5f9',

                            drawTicks:
                                false

                        },


                        ticks: {


                            precision:
                                0,


                            color:
                                '#94a3b8',


                            padding:
                                12,


                            font: {

                                size: 11

                            },


                            callback: function(value) {

                                return Number(value)
                                    .toLocaleString('id-ID');

                            }

                        }

                    }

                }

            }

        });

    }



    /* =========================================================
       SHIPPING METHOD DOUGHNUT
    ========================================================= */

    function createMethodChart(labels, values) {


        if (methodChart) {

            methodChart.destroy();

        }


        methodChart = new Chart(methodCtx, {


            type: 'doughnut',


            data: {


                labels: labels,


                datasets: [{

                    data: values,

                    backgroundColor: [

                        '#f59e0b',

                        '#0f766e',

                        '#64748b',

                        '#0284c7',

                        '#7c3aed'

                    ],

                    borderColor:
                        '#ffffff',

                    borderWidth:
                        4,

                    hoverOffset:
                        5

                }]

            },



            options: {


                responsive:
                    true,

                maintainAspectRatio:
                    false,

                cutout:
                    '72%',


                animation: {

                    duration:
                        600

                },



                plugins: {


                    /* =========================================
                       LEGEND
                    ========================================== */

                    legend: {


                        position:
                            'bottom',


                        labels: {


                            usePointStyle:
                                true,

                            pointStyle:
                                'circle',

                            boxWidth:
                                7,

                            boxHeight:
                                7,

                            padding:
                                16,

                            color:
                                '#64748b',


                            font: {

                                size:
                                    11,

                                weight:
                                    '600'

                            }

                        }

                    },



                    /* =========================================
                       TOOLTIP
                    ========================================== */

                    tooltip: {


                        backgroundColor:
                            '#0f172a',

                        titleColor:
                            '#ffffff',

                        bodyColor:
                            '#cbd5e1',

                        padding:
                            12,

                        cornerRadius:
                            10,


                        callbacks: {


                            label: function(context) {


                                const datasetValues =
                                    context.dataset.data;


                                const total =
                                    datasetValues.reduce(

                                        function(sum, value) {

                                            return sum +
                                                Number(value);

                                        },

                                        0

                                    );


                                const value =
                                    Number(context.raw || 0);


                                const percentage =
                                    total > 0

                                        ? (
                                            (value / total) * 100
                                        ).toFixed(1)

                                        : '0.0';


                                return ' ' +
                                    context.label +
                                    ': ' +
                                    value.toLocaleString('id-ID') +
                                    ' (' +
                                    percentage +
                                    '%)';

                            }

                        }

                    }

                }

            }

        });

    }



    /* =========================================================
       INITIAL SERVER DATA
    ========================================================= */

    createActivityChart({

        labels:
            @json($warehouseActivity['labels']),

        inbound:
            @json($warehouseActivity['inbound']),

        packing:
            @json($warehouseActivity['packing']),

        outbound:
            @json($warehouseActivity['outbound'])

    });



    createMethodChart(

        @json($shippingMethodLabels),

        @json($shippingMethodData)

    );



    /* =========================================================
       UPDATE ACTIVITY CHART
    ========================================================= */

    function updateActivityChart(payload) {


        if (
            !activityChart ||
            !payload ||
            !payload.warehouseActivity
        ) {
            return;
        }


        activityChart.data.labels =
            payload.warehouseActivity.labels || [];


        activityChart.data.datasets[0].data =
            payload.warehouseActivity.inbound || [];


        activityChart.data.datasets[1].data =
            payload.warehouseActivity.packing || [];


        activityChart.data.datasets[2].data =
            payload.warehouseActivity.outbound || [];


        activityChart.update();

    }



    /* =========================================================
       UPDATE METHOD CHART
    ========================================================= */

    function updateMethodChart(labels, values) {


        if (!methodChart) {
            return;
        }


        methodChart.data.labels =
            labels || [];


        methodChart.data.datasets[0].data =
            values || [];


        methodChart.update();

    }



    /* =========================================================
       SAFE PERCENT
    ========================================================= */

    function safePercent(value) {


        const number =
            Number(value || 0);


        return Math.min(
            Math.max(number, 0),
            100
        );

    }



    /* =========================================================
       UPDATE KPI
    ========================================================= */

    function updateKPIs(payload) {


        if (!payload) {
            return;
        }



        /* PACKING */

        const packing =
            safePercent(
                payload.packingCoverage
            );


        const packingValue =
            document.getElementById(
                'packingCoverageValue'
            );


        const packingBar =
            document.getElementById(
                'packingCoverageBar'
            );


        if (packingValue) {

            packingValue.textContent =
                packing + '%';

        }


        if (packingBar) {

            packingBar.style.width =
                packing + '%';

        }



        /* READINESS */

        const readiness =
            safePercent(
                payload.dispatchReadiness
            );


        const readinessValue =
            document.getElementById(
                'dispatchReadinessValue'
            );


        const readinessBar =
            document.getElementById(
                'dispatchReadinessBar'
            );


        if (readinessValue) {

            readinessValue.textContent =
                readiness + '%';

        }


        if (readinessBar) {

            readinessBar.style.width =
                readiness + '%';

        }



        /* PERFORMANCE */

        const performance =
            safePercent(
                payload.performanceScore
            );


        const performanceValue =
            document.getElementById(
                'performanceScoreValue'
            );


        const performanceBar =
            document.getElementById(
                'performanceScoreBar'
            );


        if (performanceValue) {

            performanceValue.textContent =
                performance + '%';

        }


        if (performanceBar) {

            performanceBar.style.width =
                performance + '%';

        }



        /* CHART TITLE */

        const chartTitle =
            document.getElementById(
                'chartTitle'
            );


        if (
            chartTitle &&
            payload.chartTitle
        ) {

            chartTitle.textContent =
                payload.chartTitle;

        }



        /* FILTER BADGE */

        const filterBadge =
            document.getElementById(
                'filterBadge'
            );


        if (filterBadge) {


            const month =
                payload.selectedMonthLabel || '';


            const year =
                payload.selectedYear || '';


            filterBadge.textContent =
                month + ' ' + year;

        }

    }



    /* =========================================================
       FILTER AJAX
    ========================================================= */

    const filterForm =
        document.getElementById(
            'dashboardFilter'
        );


    const filterButton =
        document.getElementById(
            'applyFilterButton'
        );


    const filterButtonText =
        document.getElementById(
            'applyFilterText'
        );



    if (filterForm) {


        filterForm.addEventListener(
            'submit',

            function(event) {


                event.preventDefault();



                /* =============================================
                   LOADING STATE
                ============================================== */

                if (filterButton) {

                    filterButton.disabled =
                        true;

                }


                if (filterButtonText) {

                    filterButtonText.textContent =
                        'Memuat...';

                }



                /* =============================================
                   QUERY
                ============================================== */

                const queryString =
                    new URLSearchParams(
                        new FormData(filterForm)
                    ).toString();



                /* =============================================
                   REQUEST
                ============================================== */

                fetch(

                    '{{ route('dashboard') }}?' +
                    queryString,

                    {

                        headers: {

                            'X-Requested-With':
                                'XMLHttpRequest',

                            'Accept':
                                'application/json'

                        }

                    }

                )


                .then(function(response) {


                    if (!response.ok) {

                        throw new Error(
                            'Gagal memuat data dashboard.'
                        );

                    }


                    return response.json();

                })


                .then(function(json) {


                    /* CHART */

                    updateActivityChart(json);


                    updateMethodChart(

                        json.shippingMethodLabels,

                        json.shippingMethodData

                    );


                    /* KPI */

                    updateKPIs(json);



                    /* =========================================
                       UPDATE URL WITHOUT RELOAD
                    ========================================== */

                    const newUrl =

                        window.location.pathname +
                        '?' +
                        queryString;


                    window.history.replaceState(

                        {},

                        '',

                        newUrl

                    );

                })


                .catch(function(error) {


                    console.error(

                        'Dashboard fetch error:',

                        error

                    );


                    /*
                    Jika request AJAX gagal,
                    form tetap dapat dijalankan
                    secara normal.
                    */

                    window.location.href =

                        '{{ route('dashboard') }}?' +
                        queryString;

                })


                .finally(function() {


                    if (filterButton) {

                        filterButton.disabled =
                            false;

                    }


                    if (filterButtonText) {

                        filterButtonText.textContent =
                            'Terapkan';

                    }

                });

            }

        );

    }


});

</script>

@endpush