@extends('layouts.app')

@section('title', 'Dashboard Warehouse')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Dashboard Gudang</h1>
                <p class="text-slate-600">Monitoring real-time statusgudang dan aktivitas terkini</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg border border-slate-200">
                    <span class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-sm text-slate-600">Gudang Aktif</span>
                </span>
            </div>
        </div>

        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Barang Masuk Today -->
            <a href="{{ route('warehouse.inbound.index') }}" class="group relative rounded-2xl bg-white border border-slate-200 p-6 hover:border-emerald-400 hover:shadow-lg hover:shadow-emerald-100 transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <span class="inline-flex h-8 px-3 rounded-full bg-emerald-100 text-emerald-700 text-sm font-semibold">+12 hari ini</span>
                </div>
                <p class="text-sm text-slate-600 mb-1">BARANG MASUK</p>
                <p class="text-2xl font-bold text-slate-900">84</p>
                <p class="text-xs text-slate-500 mt-2">Total volume: 3,460 kg</p>
            </a>

            <!-- Barang Keluar -->
            <a href="{{ route('warehouse.outbound.index') }}" class="group relative rounded-2xl bg-white border border-slate-200 p-6 hover:border-orange-400 hover:shadow-lg hover:shadow-orange-100 transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="inline-flex h-8 px-3 rounded-full bg-orange-100 text-orange-700 text-sm font-semibold">Siap kirim</span>
                </div>
                <p class="text-sm text-slate-600 mb-1">BARANG KELUAR</p>
                <p class="text-2xl font-bold text-slate-900">52</p>
                <p class="text-xs text-slate-500 mt-2">Total volume: 1,980 kg</p>
            </a>

            <!-- Barang Pending -->
            <a href="{{ route('warehouse.inbound.index') }}" class="group relative rounded-2xl bg-white border border-slate-200 p-6 hover:border-yellow-400 hover:shadow-lg hover:shadow-yellow-100 transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-100 text-yellow-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="inline-flex h-8 px-3 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">Attention</span>
                </div>
                <p class="text-sm text-slate-600 mb-1">BARANG PENDING</p>
                <p class="text-2xl font-bold text-slate-900">8</p>
                <p class="text-xs text-slate-500 mt-2">Menunggu verifikasi</p>
            </a>

            <!-- Kapasitas Gudang -->
            <div class="rounded-2xl bg-white border border-slate-200 p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 9m0 0h4m-4 0a2 2 0 110-4" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-slate-600 mb-1">KAPASITAS GUDANG</p>
                <p class="text-2xl font-bold text-slate-900">75%</p>
                <div class="mt-4 h-2 bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full w-3/4 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full"></div>
                </div>
                <p class="text-xs text-slate-500 mt-2">9,000 / 12,000 unit</p>
            </div>
        </div>

        <!-- Main Info Section -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
            <!-- Warehouse Info -->
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Informasi Gudang
                </h3>
                <div class="space-y-3">
                    <div class="rounded-lg bg-slate-50 p-3">
                        <p class="text-xs uppercase tracking-wider text-slate-500 font-medium mb-1">Nama Gudang</p>
                        <p class="text-sm font-semibold text-slate-900">Gudang Cikarang</p>
                    </div>
                    <div class="rounded-lg bg-slate-50 p-3">
                        <p class="text-xs uppercase tracking-wider text-slate-500 font-medium mb-1">Lokasi</p>
                        <p class="text-sm font-semibold text-slate-900">Cikarang, Bekasi</p>
                    </div>
                    <div class="rounded-lg bg-slate-50 p-3">
                        <p class="text-xs uppercase tracking-wider text-slate-500 font-medium mb-1">Kapasitas Total</p>
                        <p class="text-sm font-semibold text-slate-900">12,000 unit</p>
                    </div>
                    <div class="rounded-lg bg-slate-50 p-3">
                        <p class="text-xs uppercase tracking-wider text-slate-500 font-medium mb-1">Manager</p>
                        <p class="text-sm font-semibold text-slate-900">Budi Santoso</p>
                    </div>
                </div>
            </div>

            <!-- Inbound Stats -->
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Statistik Inbound
                </h3>
                <div class="space-y-3">
                    <div class="rounded-lg bg-emerald-50 p-4">
                        <p class="text-xs text-slate-600 font-medium">Total Barang Masuk (Hari Ini)</p>
                        <p class="text-3xl font-bold text-emerald-700 mt-2">84</p>
                    </div>
                    <div class="rounded-lg bg-emerald-50 p-4">
                        <p class="text-xs text-slate-600 font-medium">Total Volume</p>
                        <p class="text-2xl font-semibold text-emerald-700 mt-2">3,460 kg</p>
                    </div>
                    <div class="rounded-lg bg-yellow-50 p-4">
                        <p class="text-xs text-slate-600 font-medium">Pending Verifikasi</p>
                        <p class="text-2xl font-semibold text-yellow-700 mt-2">3 items</p>
                    </div>
                </div>
            </div>

            <!-- Outbound Stats -->
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Statistik Outbound
                </h3>
                <div class="space-y-3">
                    <div class="rounded-lg bg-orange-50 p-4">
                        <p class="text-xs text-slate-600 font-medium">Total Barang Keluar (Hari Ini)</p>
                        <p class="text-3xl font-bold text-orange-700 mt-2">52</p>
                    </div>
                    <div class="rounded-lg bg-orange-50 p-4">
                        <p class="text-xs text-slate-600 font-medium">Total Volume</p>
                        <p class="text-2xl font-semibold text-orange-700 mt-2">1,980 kg</p>
                    </div>
                    <div class="rounded-lg bg-blue-50 p-4">
                        <p class="text-xs text-slate-600 font-medium">Siap Pengiriman</p>
                        <p class="text-2xl font-semibold text-blue-700 mt-2">12 items</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Timeline -->
        <div class="rounded-2xl bg-white border border-slate-200 overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">
                <h2 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Aktivitas Terbaru
                </h2>
                <p class="text-sm text-slate-600 mt-1">Log pergerakan barang inbound dan outbound terkini</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 sticky top-0">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tanggal & Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-700">
                                <div class="text-sm font-medium">07 Mei 2026</div>
                                <div class="text-xs text-slate-500">14:30 WIB</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Inbound</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Pallet Item A</td>
                            <td class="px-6 py-4 text-slate-700">120 pcs</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">Disimpan</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-xs">Masuk dari Supplier X</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-700">
                                <div class="text-sm font-medium">07 Mei 2026</div>
                                <div class="text-xs text-slate-500">12:15 WIB</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-800">Outbound</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Box Produk B</td>
                            <td class="px-6 py-4 text-slate-700">58 box</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800">Dikirim</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-xs">Dikirim ke Toko Y</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-700">
                                <div class="text-sm font-medium">06 Mei 2026</div>
                                <div class="text-xs text-slate-500">09:45 WIB</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Inbound</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Karung Bahan</td>
                            <td class="px-6 py-4 text-slate-700">200 kg</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">Disimpan</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-xs">Masuk dari Pabrik Z</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-700">
                                <div class="text-sm font-medium">05 Mei 2026</div>
                                <div class="text-xs text-slate-500">15:20 WIB</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-800">Outbound</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Karton C</td>
                            <td class="px-6 py-4 text-slate-700">36 karton</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800">Dikirim</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-xs">Kirim ke Pelanggan Z</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                <a href="{{ route('warehouse.history') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
                    Lihat Semua Riwayat
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
