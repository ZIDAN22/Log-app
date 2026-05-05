@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header with Action -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Daftar Pengiriman</h1>
                <p class="text-slate-600">Kelola dan pantau semua pengiriman Anda</p>
            </div>
            <a href="{{ route('pengiriman.create') }}" 
               class="mt-4 md:mt-0 inline-flex items-center justify-center px-6 py-3 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium hover:from-blue-600 hover:to-blue-700 transition duration-200 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Buat Pengiriman Baru
            </a>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Cari Pengiriman</label>
                    <input type="text" placeholder="No Invoice, No Resi, atau Nama..." 
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option>Semua Status</option>
                        <option>Menunggu</option>
                        <option>Dalam Perjalanan</option>
                        <option>Selesai</option>
                    </select>
                </div>

                <!-- Date Range -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal</label>
                    <input type="date" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">No Invoice</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">No Resi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Pengirim</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Penerima</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Tujuan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Transportasi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Total</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <!-- Sample Row 1 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">INV-2026-0001</td>
                            <td class="px-6 py-4 text-sm text-slate-700">RES-20260505-00123</td>
                            <td class="px-6 py-4 text-sm text-slate-700">PT Mitra Logistik</td>
                            <td class="px-6 py-4 text-sm text-slate-700">Ahmad Santoso</td>
                            <td class="px-6 py-4 text-sm text-slate-700">Jakarta</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    🚛 Darat
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-slate-900">Rp 150,000</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Dalam Perjalanan
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Row 2 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">INV-2026-0002</td>
                            <td class="px-6 py-4 text-sm text-slate-700">RES-20260504-00456</td>
                            <td class="px-6 py-4 text-sm text-slate-700">CV Ekspor Makmur</td>
                            <td class="px-6 py-4 text-sm text-slate-700">Budi Hartono</td>
                            <td class="px-6 py-4 text-sm text-slate-700">Surabaya</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    ✈️ Udara
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-slate-900">Rp 2,500,000</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Row 3 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">INV-2026-0003</td>
                            <td class="px-6 py-4 text-sm text-slate-700">RES-20260503-00789</td>
                            <td class="px-6 py-4 text-sm text-slate-700">PT Global Cargo</td>
                            <td class="px-6 py-4 text-sm text-slate-700">Siti Nurhaliza</td>
                            <td class="px-6 py-4 text-sm text-slate-700">Medan</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800">
                                    🚢 Laut
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-slate-900">Rp 5,000,000</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Menunggu
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Empty State (uncomment if needed) -->
            <!-- <div class="p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-slate-900">Tidak ada pengiriman</h3>
                <p class="mt-1 text-sm text-slate-500">Mulai dengan membuat pengiriman baru</p>
            </div> -->
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between">
            <p class="text-sm text-slate-600">Menampilkan <strong>1</strong> sampai <strong>10</strong> dari <strong>20</strong> hasil</p>
            <div class="flex gap-2">
                <button class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition disabled:opacity-50">← Sebelumnya</button>
                <button class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition">Selanjutnya →</button>
            </div>
        </div>
    </div>
</div>
@endsection
