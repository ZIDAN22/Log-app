@extends('layouts.app')

@section('title', 'Outbound Barang')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Barang Keluar (Outbound)</h1>
                <p class="text-slate-600">Kelola pengiriman barang dari gudang</p>
            </div>
            <a href="{{ route('warehouse.outbound.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-orange-500 text-white rounded-lg font-medium hover:bg-orange-600 transition shadow-lg shadow-orange-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Buat Pengiriman Baru
            </a>
        </div>

        <!-- Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Pengiriman Hari Ini</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">12</p>
                <p class="text-xs text-slate-500 mt-2">Dalam proses</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Total Volume Kirim</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">1,980 kg</p>
                <p class="text-xs text-slate-500 mt-2">Hari ini</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Siap Pengiriman</p>
                <p class="text-3xl font-bold text-orange-600 mt-2">8</p>
                <p class="text-xs text-slate-500 mt-2">Menunggu kendaraan</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Dalam Transit</p>
                <p class="text-3xl font-bold text-purple-600 mt-2">24</p>
                <p class="text-xs text-slate-500 mt-2">Sedang dikirim</p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 mb-6 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Cari No Resi / Tujuan</label>
                    <input type="text" placeholder="Ketik untuk mencari..." class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition text-sm">
                </div>

                <!-- Vehicle Filter -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Kendaraan</label>
                    <select class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition text-sm">
                        <option>Semua Kendaraan</option>
                        <option>Pick-up (MB-001)</option>
                        <option>Truck (MB-002)</option>
                        <option>Bus (MB-003)</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                    <select class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition text-sm">
                        <option>Semua Status</option>
                        <option>Dipacking</option>
                        <option>Siap Kirim</option>
                        <option>Keluar Gudang</option>
                        <option>Dikirim</option>
                    </select>
                </div>

                <!-- Destination Filter -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tujuan</label>
                    <select class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition text-sm">
                        <option>Semua Tujuan</option>
                        <option>Jakarta</option>
                        <option>Bandung</option>
                        <option>Surabaya</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 mt-4">
                <button class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition text-sm font-medium">Filter</button>
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition text-sm font-medium">Reset</button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50 sticky top-0">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No Resi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tujuan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Kendaraan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Driver</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Barang</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Berat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Jadwal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-semibold text-slate-900">OUT-00156</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Jakarta Pusat</p>
                                    <p class="text-xs text-slate-500">PT Maju Jaya</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">Pick-up MB-001</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Budi Santoso</p>
                                    <p class="text-xs text-slate-500">0821-XXXX</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">Box Produk</td>
                            <td class="px-6 py-4">450 kg</td>
                            <td class="px-6 py-4">
                                <div class="text-xs">
                                    <p class="font-medium text-slate-900">07 Mei 2026</p>
                                    <p class="text-slate-500">16:00 WIB</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800">Dikirim</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openDetailModal(1)" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-xs font-medium">Detail</button>
                                    <button class="px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition text-xs font-medium">Surat Jalan</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-semibold text-slate-900">OUT-00155</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Bandung</p>
                                    <p class="text-xs text-slate-500">CV Sentosa</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Truck MB-002</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Ahmad Wijaya</p>
                                    <p class="text-xs text-slate-500">0856-YYYY</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">Pallet Material</td>
                            <td class="px-6 py-4">2,100 kg</td>
                            <td class="px-6 py-4">
                                <div class="text-xs">
                                    <p class="font-medium text-slate-900">07 Mei 2026</p>
                                    <p class="text-slate-500">14:30 WIB</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-800">Keluar Gudang</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openDetailModal(2)" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-xs font-medium">Detail</button>
                                    <button class="px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition text-xs font-medium">Surat Jalan</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-semibold text-slate-900">OUT-00154</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Surabaya</p>
                                    <p class="text-xs text-slate-500">PT Bersama</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">Tidak Assigned</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-slate-500 italic">-</span>
                            </td>
                            <td class="px-6 py-4">Karung Bahan</td>
                            <td class="px-6 py-4">1,200 kg</td>
                            <td class="px-6 py-4">
                                <div class="text-xs">
                                    <p class="font-medium text-slate-900">08 Mei 2026</p>
                                    <p class="text-slate-500">09:00 WIB</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">Siap Kirim</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openDetailModal(3)" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-xs font-medium">Detail</button>
                                    <button onclick="openAssignModal(3)" class="px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition text-xs font-medium">Assign</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-semibold text-slate-900">OUT-00153</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Jakarta Selatan</p>
                                    <p class="text-xs text-slate-500">Toko ABC</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">Pick-up MB-001</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Budi Santoso</p>
                                    <p class="text-xs text-slate-500">0821-XXXX</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">Box Premium</td>
                            <td class="px-6 py-4">320 kg</td>
                            <td class="px-6 py-4">
                                <div class="text-xs">
                                    <p class="font-medium text-slate-900">06 Mei 2026</p>
                                    <p class="text-slate-500">10:00 WIB</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800">Dikirim</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openDetailModal(4)" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-xs font-medium">Detail</button>
                                    <button class="px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition text-xs font-medium">Surat Jalan</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-semibold text-slate-900">OUT-00152</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Bekasi</p>
                                    <p class="text-xs text-slate-500">Store XYZ</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">Tidak Assigned</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-slate-500 italic">-</span>
                            </td>
                            <td class="px-6 py-4">Plastik Roll</td>
                            <td class="px-6 py-4">890 kg</td>
                            <td class="px-6 py-4">
                                <div class="text-xs">
                                    <p class="font-medium text-slate-900">07 Mei 2026</p>
                                    <p class="text-slate-500">13:00 WIB</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">Dipacking</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openDetailModal(5)" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-xs font-medium">Detail</button>
                                    <button class="px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition text-xs font-medium">Update</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-6">
            <p class="text-sm text-slate-600">Menampilkan 5 dari 87 data</p>
            <div class="flex gap-2">
                <button class="px-3 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition text-sm">← Sebelumnya</button>
                <button class="px-3 py-2 bg-orange-500 text-white rounded-lg text-sm">1</button>
                <button class="px-3 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition text-sm">2</button>
                <button class="px-3 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition text-sm">3</button>
                <button class="px-3 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition text-sm">Selanjutnya →</button>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-orange-50 to-orange-100 px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900">Detail Pengiriman</h2>
            <button onclick="closeDetailModal()" class="p-1 hover:bg-slate-300 rounded-lg transition">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="px-6 py-6 space-y-6">
            <!-- Header Info -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs uppercase text-slate-500 font-medium mb-1">No Resi</p>
                    <p class="text-lg font-bold text-slate-900">OUT-00156</p>
                </div>
                <div>
                    <p class="text-xs uppercase text-slate-500 font-medium mb-1">Status</p>
                    <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-sm font-semibold text-purple-800">Dikirim</span>
                </div>
            </div>

            <!-- Shipment Info -->
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Pengiriman
                </h3>
                <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 rounded-lg">
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Tujuan</p>
                        <p class="text-sm font-semibold text-slate-900 mt-1">Jakarta Pusat - PT Maju Jaya</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Jadwal Pengiriman</p>
                        <p class="text-sm font-semibold text-slate-900 mt-1">07 Mei 2026 - 16:00 WIB</p>
                    </div>
                </div>
            </div>

            <!-- Vehicle & Driver Info -->
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 9m0 0h4m-4 0a2 2 0 110-4" />
                    </svg>
                    Kendaraan & Driver
                </h3>
                <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 rounded-lg">
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Kendaraan</p>
                        <p class="text-sm font-semibold text-slate-900 mt-1">Pick-up MB-001</p>
                        <p class="text-xs text-slate-600">Plat: B-1234-MB</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Driver</p>
                        <p class="text-sm font-semibold text-slate-900 mt-1">Budi Santoso</p>
                        <p class="text-xs text-slate-600">0821-XXXX-XXXX</p>
                    </div>
                </div>
            </div>

            <!-- Item Details -->
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Daftar Barang
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-4 py-2 text-left font-semibold text-slate-700">Nama Barang</th>
                                <th class="px-4 py-2 text-right font-semibold text-slate-700">Jumlah</th>
                                <th class="px-4 py-2 text-right font-semibold text-slate-700">Berat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-900">Box Produk</td>
                                <td class="px-4 py-3 text-right text-slate-700">58 box</td>
                                <td class="px-4 py-3 text-right text-slate-700">450 kg</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Packing List -->
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-3">Surat Jalan</h3>
                <div class="bg-slate-50 p-4 rounded-lg">
                    <p class="text-sm text-slate-700 mb-3">Nomor: SJ-OUT-00156-070526</p>
                    <div class="flex gap-2">
                        <button class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition text-sm font-medium">Lihat PDF</button>
                        <button class="px-3 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-100 transition text-sm font-medium">Cetak</button>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Timeline Pengiriman
                </h3>
                <div class="space-y-3">
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="h-3 w-3 bg-green-500 rounded-full mt-1.5"></div>
                            <div class="h-12 w-0.5 bg-green-500 my-1"></div>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Dipacking</p>
                            <p class="text-xs text-slate-600">07 Mei 2026 - 10:00 WIB</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="h-3 w-3 bg-green-500 rounded-full mt-1.5"></div>
                            <div class="h-12 w-0.5 bg-green-500 my-1"></div>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Siap Kirim</p>
                            <p class="text-xs text-slate-600">07 Mei 2026 - 13:30 WIB</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="h-3 w-3 bg-green-500 rounded-full mt-1.5"></div>
                            <div class="h-12 w-0.5 bg-green-500 my-1"></div>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Keluar Gudang</p>
                            <p class="text-xs text-slate-600">07 Mei 2026 - 14:30 WIB</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="h-3 w-3 bg-green-500 rounded-full mt-1.5"></div>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Dikirim</p>
                            <p class="text-xs text-slate-600">07 Mei 2026 - 16:45 WIB (Sampai)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-slate-50 px-6 py-4 border-t border-slate-200 flex gap-3">
            <button onclick="closeDetailModal()" class="flex-1 px-4 py-2.5 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-100 transition font-medium">Tutup</button>
            <button class="flex-1 px-4 py-2.5 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition font-medium">Update Status</button>
        </div>
    </div>
</div>

<!-- Assign Modal -->
<div id="assignModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-xl w-full">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900">Assign Kendaraan & Driver</h2>
            <button onclick="closeAssignModal()" class="p-1 hover:bg-slate-300 rounded-lg transition">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="px-6 py-6 space-y-6">
            <!-- Shipment Info -->
            <div>
                <p class="text-sm text-slate-600 font-medium">No Resi: <span class="font-bold text-slate-900">OUT-00154</span></p>
                <p class="text-sm text-slate-600 font-medium mt-1">Tujuan: <span class="font-bold text-slate-900">Surabaya - PT Bersama</span></p>
            </div>

            <!-- Vehicle Selection -->
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-3">Pilih Kendaraan</label>
                <div class="space-y-2">
                    <label class="flex items-start gap-3 p-3 border-2 border-slate-200 rounded-lg hover:border-emerald-300 cursor-pointer">
                        <input type="radio" name="vehicle" value="mb001" class="mt-1">
                        <div>
                            <p class="font-medium text-slate-900">Pick-up MB-001</p>
                            <p class="text-xs text-slate-600">Plat: B-1234-MB | Kapasitas: 500 kg (Tersedia: 120 kg)</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3 p-3 border-2 border-slate-200 rounded-lg hover:border-emerald-300 cursor-pointer">
                        <input type="radio" name="vehicle" value="mb002" class="mt-1">
                        <div>
                            <p class="font-medium text-slate-900">Truck MB-002</p>
                            <p class="text-xs text-slate-600">Plat: B-5678-MB | Kapasitas: 5000 kg (Tersedia: 2800 kg)</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3 p-3 border-2 border-slate-200 rounded-lg hover:border-emerald-300 cursor-pointer">
                        <input type="radio" name="vehicle" value="mb003" class="mt-1" checked>
                        <div>
                            <p class="font-medium text-slate-900">Bus MB-003</p>
                            <p class="text-xs text-slate-600">Plat: B-9012-MB | Kapasitas: 3000 kg (Tersedia: 1900 kg)</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Driver Selection -->
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-3">Pilih Driver</label>
                <select class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                    <option>-- Pilih Driver --</option>
                    <option selected>Ahmad Wijaya - 0856-YYYY</option>
                    <option>Budi Santoso - 0821-XXXX</option>
                    <option>Rudi Hermawan - 0877-ZZZZ</option>
                </select>
            </div>

            <!-- Schedule -->
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-3">Jadwal Pengiriman</label>
                <div class="grid grid-cols-2 gap-4">
                    <input type="date" value="2026-05-08" class="px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                    <input type="time" value="09:00" class="px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                </div>
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">Catatan Pengiriman (Opsional)</label>
                <textarea rows="3" placeholder="Tambahkan catatan khusus..." class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm"></textarea>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex gap-3">
            <button onclick="closeAssignModal()" class="flex-1 px-4 py-2.5 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-100 transition font-medium">Batal</button>
            <button class="flex-1 px-4 py-2.5 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition font-medium">Assign Sekarang</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openDetailModal(id) {
    document.getElementById('detailModal').classList.remove('hidden');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

function openAssignModal(id) {
    document.getElementById('assignModal').classList.remove('hidden');
}

function closeAssignModal() {
    document.getElementById('assignModal').classList.add('hidden');
}

// Close modals when clicking outside
document.getElementById('detailModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});

document.getElementById('assignModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeAssignModal();
    }
});
</script>
@endpush
@endsection
