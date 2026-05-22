@extends('layouts.app')

@section('title', 'Inbound Barang')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">Barang Masuk (Inbound)</h1>
                <p class="text-slate-600">Catat dan kelola barang masuk ke gudang</p>
            </div>
            <a href="{{ route('warehouse.inbound.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-500 text-white rounded-lg font-medium hover:bg-emerald-600 transition shadow-lg shadow-emerald-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Barang Masuk
            </a>
        </div>

        <!-- Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Total Transaksi Hari Ini</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">12</p>
                <p class="text-xs text-slate-500 mt-2">↑ 3 lebih dari kemarin</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Total Volume Masuk</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">1,840 kg</p>
                <p class="text-xs text-slate-500 mt-2">Hari ini</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Barang Pending</p>
                <p class="text-3xl font-bold text-yellow-600 mt-2">3</p>
                <p class="text-xs text-slate-500 mt-2">Menunggu verifikasi</p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 mb-6 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Cari No Resi / Supplier</label>
                    <input type="text" placeholder="Ketik untuk mencari..." class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                </div>

                <!-- Date Filter -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Masuk</label>
                    <input type="date" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                    <select class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Diterima</option>
                        <option>Disimpan</option>
                    </select>
                </div>

                <!-- Warehouse Filter -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Gudang</label>
                    <select class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                        <option>Semua Gudang</option>
                        <option>Gudang Cikarang</option>
                        <option>Gudang Jakarta</option>
                        <option>Gudang Surabaya</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 mt-4">
                <button class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition text-sm font-medium">Filter</button>
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition text-sm font-medium">Reset</button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50 sticky top-0">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tanggal Masuk</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No Resi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Pengirim</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Barang</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Berat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Gudang</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium">07 Mei 2026</td>
                            <td class="px-6 py-4 font-semibold text-slate-900">INB-00124</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Supplier X</p>
                                    <p class="text-xs text-slate-500">Kontak: 0812-XXXX</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">Pallet Item A</td>
                            <td class="px-6 py-4">120 pcs</td>
                            <td class="px-6 py-4">680 kg</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">Disimpan</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openDetailModal(1)" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-xs font-medium">Detail</button>
                                    <button class="px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition text-xs font-medium">Edit</button>
                                    <a href="#" target="_blank" class="px-2 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition inline-flex items-center" title="Print Label">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium">07 Mei 2026</td>
                            <td class="px-6 py-4 font-semibold text-slate-900">INB-00123</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Pabrik Z</p>
                                    <p class="text-xs text-slate-500">Kontak: 0898-YYYY</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">Roll Plastik</td>
                            <td class="px-6 py-4">320 roll</td>
                            <td class="px-6 py-4">480 kg</td>
                            <td class="px-6 py-4">Gudang Jakarta</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">Pending</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openDetailModal(2)" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-xs font-medium">Detail</button>
                                    <button class="px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition text-xs font-medium">Edit</button>
                                    <a href="#" target="_blank" class="px-2 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition inline-flex items-center" title="Print Label">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium">06 Mei 2026</td>
                            <td class="px-6 py-4 font-semibold text-slate-900">INB-00122</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Supplier Y</p>
                                    <p class="text-xs text-slate-500">Kontak: 0877-ZZZZ</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">Karung Bahan</td>
                            <td class="px-6 py-4">200 karung</td>
                            <td class="px-6 py-4">1,200 kg</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">Disimpan</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openDetailModal(3)" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-xs font-medium">Detail</button>
                                    <button class="px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition text-xs font-medium">Edit</button>
                                    <a href="#" target="_blank" class="px-2 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition inline-flex items-center" title="Print Label">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium">05 Mei 2026</td>
                            <td class="px-6 py-4 font-semibold text-slate-900">INB-00121</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Distributor A</p>
                                    <p class="text-xs text-slate-500">Kontak: 0821-AAAA</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">Box Komponen</td>
                            <td class="px-6 py-4">450 box</td>
                            <td class="px-6 py-4">1,500 kg</td>
                            <td class="px-6 py-4">Gudang Surabaya</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Diterima</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openDetailModal(4)" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-xs font-medium">Detail</button>
                                    <button class="px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition text-xs font-medium">Edit</button>
                                    <a href="#" target="_blank" class="px-2 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition inline-flex items-center" title="Print Label">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium">04 Mei 2026</td>
                            <td class="px-6 py-4 font-semibold text-slate-900">INB-00120</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">Supplier B</p>
                                    <p class="text-xs text-slate-500">Kontak: 0856-BBBB</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">Pipa Material</td>
                            <td class="px-6 py-4">80 batang</td>
                            <td class="px-6 py-4">2,400 kg</td>
                            <td class="px-6 py-4">Gudang Jakarta</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">Pending</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openDetailModal(5)" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-xs font-medium">Detail</button>
                                    <button class="px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition text-xs font-medium">Edit</button>
                                    <a href="#" target="_blank" class="px-2 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition inline-flex items-center" title="Print Label">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-6">
            <p class="text-sm text-slate-600">Menampilkan 5 dari 124 data</p>
            <div class="flex gap-2">
                <button class="px-3 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition text-sm">← Sebelumnya</button>
                <button class="px-3 py-2 bg-emerald-500 text-white rounded-lg text-sm">1</button>
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
        <div class="sticky top-0 bg-gradient-to-r from-emerald-50 to-emerald-100 px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900">Detail Barang Masuk</h2>
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
                    <p class="text-lg font-bold text-slate-900">INB-00124</p>
                </div>
                <div>
                    <p class="text-xs uppercase text-slate-500 font-medium mb-1">Status</p>
                    <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800">Disimpan</span>
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
                        <p class="text-xs text-slate-500 font-medium">Tanggal Masuk</p>
                        <p class="text-sm font-semibold text-slate-900 mt-1">07 Mei 2026 - 14:30 WIB</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Gudang Tujuan</p>
                        <p class="text-sm font-semibold text-slate-900 mt-1">Gudang Cikarang</p>
                    </div>
                </div>
            </div>

            <!-- Sender Info -->
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Data Pengirim
                </h3>
                <div class="bg-slate-50 p-4 rounded-lg space-y-3">
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Nama Pengirim</p>
                        <p class="text-sm font-semibold text-slate-900 mt-1">Supplier X</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Kontak</p>
                        <p class="text-sm font-semibold text-slate-900 mt-1">0812-XXXX-XXXX</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Alamat</p>
                        <p class="text-sm font-semibold text-slate-900 mt-1">Jl. Industri No.10, Karawang 41254</p>
                    </div>
                </div>
            </div>

            <!-- Item Details -->
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Detail Barang
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
                                <td class="px-4 py-3 font-medium text-slate-900">Pallet Item A</td>
                                <td class="px-4 py-3 text-right text-slate-700">120 pcs</td>
                                <td class="px-4 py-3 text-right text-slate-700">680 kg</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Timeline -->
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Timeline Status
                </h3>
                <div class="space-y-3">
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="h-3 w-3 bg-green-500 rounded-full mt-1.5"></div>
                            <div class="h-12 w-0.5 bg-green-500 my-1"></div>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Diterima</p>
                            <p class="text-xs text-slate-600">07 Mei 2026 - 14:30 WIB</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="h-3 w-3 bg-green-500 rounded-full mt-1.5"></div>
                            <div class="h-12 w-0.5 bg-slate-300 my-1"></div>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Disimpan</p>
                            <p class="text-xs text-slate-600">07 Mei 2026 - 15:15 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-slate-50 px-6 py-4 border-t border-slate-200 flex gap-3">
            <button onclick="closeDetailModal()" class="flex-1 px-4 py-2.5 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-100 transition font-medium">Tutup</button>
            <button class="flex-1 px-4 py-2.5 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition font-medium">Verifikasi</button>
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

// Close modal when clicking outside
document.getElementById('detailModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});
</script>
@endpush
@endsection
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        // Here you would typically submit a form or make an AJAX call
        // For now, we'll just show an alert
        alert('Data dengan ID ' + id + ' akan dihapus');
    }
}
</script>
@endsection
