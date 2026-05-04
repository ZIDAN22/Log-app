@extends('layouts.app')

@section('title', 'Dashboard Monitoring - LogistikPro')

@section('content')
<div class="space-y-6">
    <div class="grid gap-6 xl:grid-cols-12">
        <div class="xl:col-span-8">
            <div class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/50 md:p-8">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-3xl font-semibold text-slate-900">Dashboard Monitoring</h2>
                        <p class="mt-2 text-sm text-slate-500">Pantau pengiriman, inventaris, dan performa armada secara real-time.</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 px-4 py-3 text-sm text-slate-600">
                        Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}
                    </div>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <div class="flex items-center gap-3 text-slate-700">
                            <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-sky-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l1.5-1.5M7 4h10l3 3v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Total Pengiriman</p>
                                <p class="mt-1 text-2xl font-semibold text-slate-900">1,247</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <div class="flex items-center gap-3 text-slate-700">
                            <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-emerald-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Pengiriman Aktif</p>
                                <p class="mt-1 text-2xl font-semibold text-slate-900">89</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <div class="flex items-center gap-3 text-slate-700">
                            <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-amber-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M5.64 19h12.72a2 2 0 001.9-2.6l-5.86-13.12A2 2 0 0014.5 2h-5a2 2 0 00-1.9 1.28L1.74 16.4A2 2 0 003.64 19z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Pengiriman Tertunda</p>
                                <p class="mt-1 text-2xl font-semibold text-slate-900">12</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <div class="flex items-center gap-3 text-slate-700">
                            <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-violet-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 5h10M7 19h10" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Selesai Hari Ini</p>
                                <p class="mt-1 text-2xl font-semibold text-slate-900">156</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <section class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Kondisi Stok</h3>
                            <p class="mt-1 text-sm text-slate-500">Prioritas paket dan ketersediaan barang untuk distribusi cepat.</p>
                        </div>
                        <div class="text-sm font-medium text-slate-600">Update realtime</div>
                    </div>
                    <div class="mt-8 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                        <div class="w-full lg:w-1/2">
                            <canvas id="stockPieChart"></canvas>
                        </div>
                        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Stok Minimum</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-900">24 item</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Aset di Gudang</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-900">318</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Topik Prioritas</h3>
                            <p class="mt-1 text-sm text-slate-500">Fokus untuk memastikan pengiriman lebih cepat dan risiko rendah.</p>
                        </div>
                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Stabil</span>
                    </div>
                    <ul class="mt-6 space-y-4">
                        <li class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                            <p class="font-semibold text-slate-900">Rute ekspres penuh</p>
                            <p class="mt-1 text-sm text-slate-500">24 rute prioritas memerlukan pemantauan posisi kendaraan.</p>
                        </li>
                        <li class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                            <p class="font-semibold text-slate-900">Stok kurang</p>
                            <p class="mt-1 text-sm text-slate-500">Watchlist 8 item kritis untuk replenishment segera.</p>
                        </li>
                        <li class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                            <p class="font-semibold text-slate-900">Kepatuhan SOP</p>
                            <p class="mt-1 text-sm text-slate-500">Pastikan proses sortir dan pengiriman sesuai standard operasional.</p>
                        </li>
                    </ul>
                </section>
            </div>
        </div>

        <div class="xl:col-span-4 space-y-6">
            <section class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/50">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Tren Pengiriman</h3>
                        <p class="mt-1 text-sm text-slate-500">Volume pengiriman dibandingkan minggu lalu.</p>
                    </div>
                    <div class="text-sm font-semibold text-sky-600">+12% dari minggu lalu</div>
                </div>
                <div class="mt-8">
                    <canvas id="deliveryTrendChart" class="w-full"></canvas>
                </div>
            </section>

            <section class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/50">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Laporan Inventaris</h3>
                        <p class="mt-1 text-sm text-slate-500">Item yang perlu segera ditindaklanjuti.</p>
                    </div>
                    <div class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">8 Kritis</div>
                </div>
                <div class="mt-6 space-y-4">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Kapasitas Gudang</p>
                            <p class="mt-2 text-xl font-semibold text-slate-900">78%</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Rute Darurat</p>
                            <p class="mt-2 text-xl font-semibold text-slate-900">14</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto rounded-3xl border border-slate-200 bg-slate-50">
                        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                            <thead class="bg-slate-100 text-slate-700">
                                <tr>
                                    <th class="px-4 py-3 font-semibold">Item</th>
                                    <th class="px-4 py-3 font-semibold">Stok</th>
                                    <th class="px-4 py-3 font-semibold">Prioritas</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <tr>
                                    <td class="px-4 py-3">Karung Plastik</td>
                                    <td class="px-4 py-3">12</td>
                                    <td class="px-4 py-3 text-amber-600">Tinggi</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">Pallet Kayu</td>
                                    <td class="px-4 py-3">6</td>
                                    <td class="px-4 py-3 text-red-600">Kritis</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">Label Pengiriman</td>
                                    <td class="px-4 py-3">38</td>
                                    <td class="px-4 py-3 text-emerald-600">Normal</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    setInterval(() => {
        console.log('Refreshing dashboard data...');
    }, 30000);
</script>
@endpush
