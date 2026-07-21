@extends('layouts.app')

@section('title', 'Data Gudang')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">
        <div
            class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Warehouse</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Data Gudang</h1>

            </div>

            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('warehouse.export') }}" class="inline-flex items-center gap-2">
                    <label for="export_type" class="sr-only">Pilih Laporan</label>
                    <select id="export_type" name="type"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                        <option value="inbound">Barang Masuk (Inbound)</option>
                        <option value="packing">Packing List</option>
                        <option value="outbound">Barang Keluar (Outbound)</option>
                    </select>

                    <label for="export_format" class="sr-only">Format</label>
                    <select id="export_format" name="format"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                        <option value="xlsx">Excel (.xlsx)</option>
                        <option value="csv">CSV (.csv)</option>
                    </select>

                    <button type="submit"
                        class="rounded-xl bg-emerald-600 px-3 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">Export</button>
                </form>

            </div>
        </div>

        <section class="grid gap-4 xl:grid-cols-4">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Barang Masuk</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-950">{{ number_format($totalInbounds, 0, ',',
                            '.') }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-sky-50 text-sky-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Packing List</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-950">{{ number_format($totalPackingLists, 0,
                            ',', '.') }}</p>
                    </div>
                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-50 text-orange-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Barang Keluar</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-950">{{ number_format($totalOutbounds, 0, ',',
                            '.') }}</p>
                    </div>
                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-50 text-orange-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Stok Gudang</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-950">{{ number_format($warehouseStock, 0, ',',
                            '.') }}</p>
                    </div>
                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11m16-11v11M8 14v3m4-3v3m4-3v3" />
                        </svg>
                    </div>
                </div>
            </article>
        </section>

        <section class="mt-6 grid gap-4 xl:grid-cols-4">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Siap Dikirim</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-950">{{ number_format($readyToShipOutbounds, 0,
                            ',', '.') }}</p>
                    </div>
                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8"></path>
                        </svg>
                    </div>
                </div>
            </article>


            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Dalam Perjalanan</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-950">{{ number_format($inTransitOutbounds, 0,
                            ',', '.') }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-sky-50 text-sky-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Sampai</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-950">{{ number_format($deliveredOutbounds, 0,
                            ',', '.') }}</p>
                    </div>
                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5">
                            </path>
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Konversi Packing</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-950">{{ $packingConversionRate }}<span
                                class="text-base">%</span></p>
                    </div>
                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l2 2 4-4" />
                        </svg>
                    </div>
                </div>
            </article>
        </section>


        <section class="mt-6 grid gap-4 lg:grid-cols-3">
            <a href="{{ route('inbound.index') }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-slate-300 hover:bg-slate-50">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Monitor Inbound</p>
                        <h2 class="mt-3 text-lg font-bold text-slate-950">Lihat Barang Masuk</h2>
                    </div>
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('packing-list.index') }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-slate-300 hover:bg-slate-50">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Packing List</p>
                        <h2 class="mt-3 text-lg font-bold text-slate-950">Lihat Packing List</h2>
                    </div>
                    <div
                        class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-orange-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('warehouse.outbound.index') }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-slate-300 hover:bg-slate-50">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Outbound</p>
                        <h2 class="mt-3 text-lg font-bold text-slate-950">Lihat Barang Keluar</h2>
                    </div>
                    <div
                        class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-orange-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </section>

        @if($lowStockAlert)
        <section class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 p-5 text-rose-900 shadow-sm">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wide">Peringatan Stok Rendah</p>
                    <p class="mt-1 text-sm text-rose-900/80">
                        Stok gudang saat ini berada di <span class="font-semibold">{{ number_format($warehouseStock, 0,
                            ',', '.') }}</span> item, di bawah ambang batas <span class="font-semibold">{{
                            number_format($lowStockThreshold, 0, ',', '.') }}</span>.
                    </p>
                </div>
                <div
                    class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-rose-700 shadow-sm">
                    <span class="h-2.5 w-2.5 rounded-full bg-rose-600"></span>
                    Segera cek dan isi ulang stok.
                </div>
            </div>
        </section>
        @endif

        <section class="mt-6 grid gap-4 xl:grid-cols-1">
            <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 pb-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Grafik Aktivitas</p>
                        <h2 class="mt-2 text-xl font-bold text-slate-950">Aktivitas Gudang</h2>
                    </div>
                    <div class="flex flex-col items-start gap-3 sm:items-end">

                        <form method="GET" action="{{ route('warehouse.index') }}"
                            class="inline-flex items-center gap-2 rounded-2xl bg-slate-50 p-2">
                            <input type="hidden" name="activity_type" value="{{ $activityType }}">
                            <input type="hidden" name="activity_search" value="{{ $activitySearch }}">
                            <label for="chart_timeframe" class="sr-only">Pilih Timeframe</label>
                            <select id="chart_timeframe" name="chart_timeframe"
                                class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                                <option value="weekly" {{ $chartTimeframe==='weekly' ? 'selected' : '' }}>Mingguan
                                </option>
                                <option value="monthly" {{ $chartTimeframe==='monthly' ? 'selected' : '' }}>Bulanan
                                </option>
                                <option value="quarterly" {{ $chartTimeframe==='quarterly' ? 'selected' : '' }}>
                                    Kuartalan</option>
                            </select>
                            <button type="submit"
                                class="rounded-xl bg-sky-600 px-3 py-2 text-sm font-semibold text-white transition hover:bg-sky-700">Terapkan</button>
                        </form>
                    </div>
                </div>

                <div class="mt-5 min-h-[320px]">
                    <canvas id="warehouseMonthlyTrendChart" class="w-full h-[320px]"></canvas>
                </div>
            </article>


        </section>

        <section class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4">
                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Aktivitas Gudang Terbaru</h2>
                        <p class="mt-1 text-sm text-slate-500">Ringkasan kegiatan inbound, packing list, dan outbound.
                        </p>
                    </div>
                    <div
                        class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ $recentActivities->count() }} aktivitas terakhir
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] border-collapse text-left text-sm">
                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wide">Tipe</th>
                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wide">Referensi</th>
                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wide">Deskripsi</th>
                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wide">Tanggal</th>
                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wide">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($recentActivities as $activity)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-5 py-4 text-sm font-semibold text-slate-900">{{ $activity['type'] }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $activity['reference'] }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $activity['description'] }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $activity['date']->format('d M Y') }}</td>
                            <td class="px-5 py-4">
                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $activity['status'] === 'Selesai' ? 'bg-emerald-100 text-emerald-700' : ($activity['status'] === 'Tersedia' ? 'bg-sky-100 text-sky-700' : 'bg-slate-100 text-slate-700') }}">
                                    {{ $activity['status'] }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center text-sm text-slate-500">
                                Belum ada aktivitas gudang terbaru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('warehouseMonthlyTrendChart');
            if (!ctx) return;

            const timeframe = '{{ $chartTimeframe }}';
            const chartData = {
                weekly: {
                    labels: @json($weeklyLabels),
                    inbound: @json($inboundWeeklyData),
                    packing: @json($packingWeeklyData),
                    outbound: @json($outboundWeeklyData),
                },
                monthly: {
                    labels: @json($monthLabels),
                    inbound: @json($inboundMonthlyData),
                    packing: @json($packingMonthlyData),
                    outbound: @json($outboundMonthlyData),
                },
                quarterly: {
                    labels: @json($quarterLabels),
                    inbound: @json($inboundQuarterlyData),
                    packing: @json($packingQuarterlyData),
                    outbound: @json($outboundQuarterlyData),
                },
            };

            const activeData = chartData[timeframe] || chartData.monthly;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: activeData.labels,
                    datasets: [
                        {
                            label: 'Inbound',
                            data: activeData.inbound,
                            borderColor: '#0ea5e9',
                            backgroundColor: 'rgba(14, 165, 233, 0.16)',
                            tension: 0.3,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 3,
                        },
                        {
                            label: 'Packing List',
                            data: activeData.packing,
                            borderColor: '#22c55e',
                            backgroundColor: 'rgba(34, 197, 94, 0.14)',
                            tension: 0.3,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 3,
                        },
                        {
                            label: 'Outbound',
                            data: activeData.outbound,
                            borderColor: '#f97316',
                            backgroundColor: 'rgba(249, 115, 22, 0.14)',
                            tension: 0.3,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 3,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#334155',
                                padding: 20,
                                usePointStyle: true,
                            },
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        },
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#475569',
                            },
                            grid: {
                                display: false,
                            },
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#475569',
                                stepSize: 5,
                            },
                            grid: {
                                color: 'rgba(148, 163, 184, 0.18)',
                            },
                        },
                    },
                },
            });
        });
</script>
@endpush
@endsection