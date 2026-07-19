@extends('layouts.app')

@section('title', 'Dashboard Staff Warehouse')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-12 2xl:px-16">
    <div class="mx-auto w-full max-w-7xl">
        <section class="relative overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-sm">
            <div class="absolute inset-0 bg-gradient-to-r from-amber-50 via-white to-orange-50 opacity-80"></div>
            <div class="relative p-8 lg:p-10 xl:p-12">
                <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <span class="inline-flex items-center rounded-full border border-amber-200 bg-amber-50 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-amber-700">
                            Dashboard Staff Warehouse
                        </span>
                        <h1 class="mt-5 text-3xl font-bold text-slate-900 lg:text-4xl">
                            {{ $greeting }}, {{ auth()->user()->name }}
                        </h1>
                        <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">
                            Pantau aktivitas gudang, inbound, packing list, outbound, dan status pengiriman secara terintegrasi dari satu dashboard.
                        </p>
                    </div>

                    <div class="w-full max-w-[280px] rounded-3xl border border-slate-200 bg-white p-6 shadow-sm lg:ml-auto">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Login Sebagai</p>
                                <h3 class="mt-2 text-2xl font-bold text-slate-900">{{ auth()->user()->role_label }}</h3>
                            </div>
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14L4 7m8 4v10" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-6 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Barang Masuk</p>
                        <h3 class="mt-4 text-4xl font-bold text-slate-900">{{ number_format($totalInbound, 0, ',', '.') }}</h3>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v10m0 0l-3-3m3 3l3-3M7 17h10M5 21h14a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Packing List</p>
                        <h3 class="mt-4 text-4xl font-bold text-slate-900">{{ number_format($totalPackingList, 0, ',', '.') }}</h3>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-sky-100 text-sky-700">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 012-2h10a2 2 0 012 2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-4 4h-4" />
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Barang Keluar</p>
                        <h3 class="mt-4 text-4xl font-bold text-slate-900">{{ number_format($totalOutbound, 0, ',', '.') }}</h3>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-violet-100 text-violet-700">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v10m0 0l4-4m-4 4l-4-4M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Siap Dikirim</p>
                        <h3 class="mt-4 text-4xl font-bold text-amber-600">{{ number_format($readyToShip, 0, ',', '.') }}</h3>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-amber-100 text-amber-700">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17l3 3 3-3M12 14V5" />
                        </svg>
                    </div>
                </div>
            </article>
        </section>

        <section class="mt-6 grid gap-6 xl:grid-cols-[1.55fr_0.95fr]">
            <section class="overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col gap-4 border-b border-slate-100 p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Aktivitas Gudang</p>
                        <h2 class="mt-2 text-xl font-bold text-slate-900">Tren 6 Minggu Terakhir</h2>
                    </div>
                    <div class="rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-sm font-semibold text-emerald-700">
                        Update real-time
                    </div>
                </div>
                <div class="p-6">
                    <canvas id="warehouseActivityChart" class="h-[320px] w-full"></canvas>
                </div>
            </section>

            <section class="overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 p-6">
                    <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Distribusi Pengiriman</p>
                    <h2 class="mt-2 text-xl font-bold text-slate-900">Metode Transportasi</h2>
                </div>
                <div class="p-6">
                    <canvas id="shippingMethodChart" class="h-[320px] w-full"></canvas>
                </div>
            </section>
        </section>

        <section class="mt-6 grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
            <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Aktivitas Terbaru</p>
                        <h2 class="mt-2 text-xl font-bold text-slate-900">Riwayat Operasional</h2>
                    </div>
                    <a href="{{ route('inbound.index') }}" class="text-sm font-semibold text-amber-600 hover:text-amber-700">Lihat semua</a>
                </div>

                <div class="mt-6 space-y-4">
                    @forelse($recentActivities as $activity)
                    <div class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white text-amber-600 shadow-sm">
                            @if($activity['icon'] === 'incoming')
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v10m0 0l-3-3m3 3l3-3M7 17h10" />
                            </svg>
                            @elseif($activity['icon'] === 'box')
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 012-2h10a2 2 0 012 2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8" />
                            </svg>
                            @else
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v10m0 0l4-4m-4 4l-4-4M5 21h14" />
                            </svg>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-slate-900">{{ $activity['title'] }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $activity['description'] }}</p>
                            <p class="mt-2 text-xs font-medium uppercase tracking-wide text-slate-400">{{ $activity['time']->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-sm text-slate-500">
                        Belum ada aktivitas terbaru yang tercatat.
                    </div>
                    @endforelse
                </div>
            </section>

            <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Ringkasan Hari Ini</p>
                <h2 class="mt-2 text-xl font-bold text-slate-900">Pencapaian gudang</h2>

                <div class="mt-6 space-y-4">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Barang Masuk Hari Ini</span>
                            <span class="text-lg font-semibold text-slate-900">{{ $inboundToday }}</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Packing List Hari Ini</span>
                            <span class="text-lg font-semibold text-slate-900">{{ $packingToday }}</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Barang Keluar Hari Ini</span>
                            <span class="text-lg font-semibold text-slate-900">{{ $outboundToday }}</span>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-600">Status Dalam Perjalanan</span>
                            <span class="text-lg font-semibold text-slate-900">{{ $inTransit }}</span>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const activityCtx = document.getElementById('warehouseActivityChart');
        if (activityCtx && window.Chart) {
            new Chart(activityCtx, {
                type: 'bar',
                data: {
                    labels: @json($warehouseActivity['labels']),
                    datasets: [
                        {
                            label: 'Barang Masuk',
                            data: @json($warehouseActivity['inbound']),
                            backgroundColor: '#f59e0b',
                            borderRadius: 8,
                            maxBarThickness: 26
                        },
                        {
                            label: 'Packing List',
                            data: @json($warehouseActivity['packing']),
                            backgroundColor: '#0f766e',
                            borderRadius: 8,
                            maxBarThickness: 26
                        },
                        {
                            label: 'Barang Keluar',
                            data: @json($warehouseActivity['outbound']),
                            backgroundColor: '#64748b',
                            borderRadius: 8,
                            maxBarThickness: 26
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        const methodCtx = document.getElementById('shippingMethodChart');
        if (methodCtx && window.Chart) {
            new Chart(methodCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($shippingMethodLabels),
                    datasets: [
                        {
                            data: @json($shippingMethodData),
                            backgroundColor: ['#f59e0b', '#0f766e', '#64748b'],
                            borderWidth: 0
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection
