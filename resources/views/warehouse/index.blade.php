@extends('layouts.app')

@section('title', 'Warehouse')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Data Gudang</h1>
                <p class="text-slate-600">Ringkasan dan informasi utama tentang gudang Anda.</p>
            </div>
        </div>

        <!-- Navigation Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <a href="{{ route('warehouse.inbound.index') }}" class="group relative rounded-2xl border-2 border-slate-200 bg-white p-5 hover:border-emerald-400 hover:shadow-md transition">
                <div class="flex items-start justify-between mb-3">
                    <div class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-emerald-700">12</span>
                </div>
                <p class="font-semibold text-slate-900">Barang Masuk</p>
                <p class="text-xs text-slate-500 mt-1">Hari ini</p>
            </a>
            <a href="{{ route('warehouse.outbound.index') }}" class="group relative rounded-2xl border-2 border-slate-200 bg-white p-5 hover:border-orange-400 hover:shadow-md transition">
                <div class="flex items-start justify-between mb-3">
                    <div class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100 text-orange-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-orange-700">8</span>
                </div>
                <p class="font-semibold text-slate-900">Barang Keluar</p>
                <p class="text-xs text-slate-500 mt-1">Siap dikirim</p>
            </a>
            <a href="{{ route('warehouse.history') }}" class="group relative rounded-2xl border-2 border-slate-200 bg-white p-5 hover:border-purple-400 hover:shadow-md transition">
                <div class="flex items-start justify-between mb-3">
                    <div class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-purple-700">136</span>
                </div>
                <p class="font-semibold text-slate-900">Riwayat</p>
                <p class="text-xs text-slate-500 mt-1">Semua aktivitas</p>
            </a>
            <div class="rounded-2xl border-2 border-slate-200 bg-white p-5">
                <div class="flex items-start justify-between mb-3">
                    <div class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <p class="font-semibold text-slate-900">Kapasitas Gudang</p>
                <div class="mt-3 h-2 bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full w-3/4 bg-gradient-to-r from-blue-400 to-blue-500"></div>
                </div>
                <p class="text-xs text-slate-600 mt-2">75% terisi (9,000 unit)</p>
            </div>
        </div>

        <!-- Warehouse Info -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Data Gudang</h2>
                <div class="space-y-4 text-slate-700 text-sm">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-slate-500 text-xs uppercase tracking-[0.2em] mb-1">Nama Gudang</p>
                        <p class="font-semibold text-slate-900">Gudang Cikarang</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-slate-500 text-xs uppercase tracking-[0.2em] mb-1">Lokasi</p>
                        <p class="font-semibold text-slate-900">Cikarang, Bekasi</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-slate-500 text-xs uppercase tracking-[0.2em] mb-1">Kapasitas</p>
                        <p class="font-semibold text-slate-900">12,000 unit</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Barang Masuk (Inbound)</h2>
                <div class="grid gap-4">
                    <div class="rounded-2xl bg-emerald-50 p-4">
                        <p class="text-slate-500 text-sm">Total Barang Masuk Hari Ini</p>
                        <p class="mt-2 text-3xl font-bold text-emerald-700">84</p>
                    </div>
                    <div class="rounded-2xl bg-emerald-50 p-4">
                        <p class="text-slate-500 text-sm">Total Volume</p>
                        <p class="mt-2 text-2xl font-semibold text-emerald-700">3,460 kg</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Barang Keluar (Outbound)</h2>
                <div class="grid gap-4">
                    <div class="rounded-2xl bg-orange-50 p-4">
                        <p class="text-slate-500 text-sm">Total Barang Keluar Hari Ini</p>
                        <p class="mt-2 text-3xl font-bold text-orange-700">52</p>
                    </div>
                    <div class="rounded-2xl bg-orange-50 p-4">
                        <p class="text-slate-500 text-sm">Total Volume</p>
                        <p class="mt-2 text-2xl font-semibold text-orange-700">1,980 kg</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Barang -->
        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="px-6 py-6 border-b border-slate-200">
                <h2 class="text-xl font-semibold text-slate-900">Riwayat Barang Masuk / Keluar</h2>
                <p class="mt-2 text-slate-600 text-sm">Tabel menampilkan log terakhir barang inbound dan outbound untuk gudang ini.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm text-slate-700">
                    <thead class="bg-slate-50 text-slate-900">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                            <th class="px-6 py-4 text-left font-semibold">Tipe</th>
                            <th class="px-6 py-4 text-left font-semibold">Nama Barang</th>
                            <th class="px-6 py-4 text-left font-semibold">Jumlah</th>
                            <th class="px-6 py-4 text-left font-semibold">Satuan</th>
                            <th class="px-6 py-4 text-left font-semibold">Gudang</th>
                            <th class="px-6 py-4 text-left font-semibold">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">07 Mei 2026</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Inbound</span>
                            </td>
                            <td class="px-6 py-4">Pallet Item A</td>
                            <td class="px-6 py-4">120</td>
                            <td class="px-6 py-4">Pcs</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">Masuk dari Supplier X</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">07 Mei 2026</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-800">Outbound</span>
                            </td>
                            <td class="px-6 py-4">Box Produk B</td>
                            <td class="px-6 py-4">58</td>
                            <td class="px-6 py-4">Box</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">Dikirim ke Toko Y</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">06 Mei 2026</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Inbound</span>
                            </td>
                            <td class="px-6 py-4">Karung Bahan</td>
                            <td class="px-6 py-4">200</td>
                            <td class="px-6 py-4">Kg</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">Masuk dari Pabrik Z</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">05 Mei 2026</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-800">Outbound</span>
                            </td>
                            <td class="px-6 py-4">Karton C</td>
                            <td class="px-6 py-4">36</td>
                            <td class="px-6 py-4">Karton</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">Kirim ke Pelanggan Z</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
