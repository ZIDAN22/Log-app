@extends('layouts.app')

@section('title', 'Riwayat Barang')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Riwayat Barang</h1>
                <p class="text-slate-600">Lihat sejarah barang masuk dan keluar pada gudang.</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Gudang</label>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option selected>Gudang Cikarang</option>
                        <option>Gudang Jakarta</option>
                        <option>Gudang Surabaya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tipe</label>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option>Semua</option>
                        <option>Inbound</option>
                        <option>Outbound</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Dari Tanggal</label>
                    <input type="date" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Hingga Tanggal</label>
                    <input type="date" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-3xl bg-emerald-50 p-5">
                    <p class="text-sm text-slate-500">Total Inbound</p>
                    <p class="mt-3 text-3xl font-bold text-emerald-800">84</p>
                </div>
                <div class="rounded-3xl bg-orange-50 p-5">
                    <p class="text-sm text-slate-500">Total Outbound</p>
                    <p class="mt-3 text-3xl font-bold text-orange-800">52</p>
                </div>
                <div class="rounded-3xl bg-purple-50 p-5">
                    <p class="text-sm text-slate-500">Total Aktivitas</p>
                    <p class="mt-3 text-3xl font-bold text-purple-800">136</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="px-6 py-6 border-b border-slate-200">
                <h2 class="text-xl font-semibold text-slate-900">Riwayat Inbound & Outbound</h2>
                <p class="mt-2 text-slate-600 text-sm">Semua catatan barang masuk dan keluar dalam satu tampilan.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm text-slate-700">
                    <thead class="bg-slate-50 text-slate-900">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                            <th class="px-6 py-4 text-left font-semibold">Tipe</th>
                            <th class="px-6 py-4 text-left font-semibold">No Ref</th>
                            <th class="px-6 py-4 text-left font-semibold">Nama Barang</th>
                            <th class="px-6 py-4 text-left font-semibold">Jumlah</th>
                            <th class="px-6 py-4 text-left font-semibold">Gudang</th>
                            <th class="px-6 py-4 text-left font-semibold">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">07 Mei 2026</td>
                            <td class="px-6 py-4"><span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Inbound</span></td>
                            <td class="px-6 py-4">INB-001</td>
                            <td class="px-6 py-4">Pallet Item A</td>
                            <td class="px-6 py-4">120</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">Masuk dari Supplier X</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">07 Mei 2026</td>
                            <td class="px-6 py-4"><span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-800">Outbound</span></td>
                            <td class="px-6 py-4">OUT-001</td>
                            <td class="px-6 py-4">Box Produk B</td>
                            <td class="px-6 py-4">58</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">Dikirim ke Toko Y</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">06 Mei 2026</td>
                            <td class="px-6 py-4"><span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Inbound</span></td>
                            <td class="px-6 py-4">INB-002</td>
                            <td class="px-6 py-4">Karung Bahan</td>
                            <td class="px-6 py-4">200</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">Masuk dari Pabrik Z</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">05 Mei 2026</td>
                            <td class="px-6 py-4"><span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-800">Outbound</span></td>
                            <td class="px-6 py-4">OUT-002</td>
                            <td class="px-6 py-4">Karton C</td>
                            <td class="px-6 py-4">36</td>
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
