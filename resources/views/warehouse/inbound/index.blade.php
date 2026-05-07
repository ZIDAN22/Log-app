@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Barang Masuk</h1>
                <p class="text-slate-600">Catat dan pantau barang inbound ke gudang.</p>
            </div>
            <a href="{{ route('warehouse.inbound.create') }}" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                + Tambah Barang Masuk
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-3xl bg-emerald-50 p-5">
                    <p class="text-sm text-slate-500">Total Transaksi Hari Ini</p>
                    <p class="mt-3 text-3xl font-bold text-emerald-800">12</p>
                </div>
                <div class="rounded-3xl bg-emerald-50 p-5">
                    <p class="text-sm text-slate-500">Total Volume</p>
                    <p class="mt-3 text-3xl font-bold text-emerald-800">1,840 kg</p>
                </div>
                <div class="rounded-3xl bg-emerald-50 p-5">
                    <p class="text-sm text-slate-500">Pending</p>
                    <p class="mt-3 text-3xl font-bold text-yellow-700">3</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="px-6 py-6 border-b border-slate-200">
                <h2 class="text-xl font-semibold text-slate-900">Daftar Barang Masuk</h2>
                <p class="mt-2 text-slate-600 text-sm">Riwayat inbound terbaru dari gudang.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm text-slate-700">
                    <thead class="bg-slate-50 text-slate-900">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                            <th class="px-6 py-4 text-left font-semibold">No Ref</th>
                            <th class="px-6 py-4 text-left font-semibold">Nama Barang</th>
                            <th class="px-6 py-4 text-left font-semibold">Jumlah</th>
                            <th class="px-6 py-4 text-left font-semibold">Satuan</th>
                            <th class="px-6 py-4 text-left font-semibold">Gudang</th>
                            <th class="px-6 py-4 text-left font-semibold">Supplier</th>
                            <th class="px-6 py-4 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">07 Mei 2026</td>
                            <td class="px-6 py-4">INB-001</td>
                            <td class="px-6 py-4">Pallet Item A</td>
                            <td class="px-6 py-4">120</td>
                            <td class="px-6 py-4">Pcs</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">Supplier X</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('warehouse.inbound.edit', 1) }}" class="px-3 py-1 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600 transition">Edit</a>
                                    <button onclick="confirmDelete(1)" class="px-3 py-1 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600 transition">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">06 Mei 2026</td>
                            <td class="px-6 py-4">INB-002</td>
                            <td class="px-6 py-4">Karung Bahan</td>
                            <td class="px-6 py-4">200</td>
                            <td class="px-6 py-4">Kg</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">Pabrik Z</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('warehouse.inbound.edit', 2) }}" class="px-3 py-1 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600 transition">Edit</a>
                                    <button onclick="confirmDelete(2)" class="px-3 py-1 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600 transition">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">05 Mei 2026</td>
                            <td class="px-6 py-4">INB-003</td>
                            <td class="px-6 py-4">Roll Plastik</td>
                            <td class="px-6 py-4">320</td>
                            <td class="px-6 py-4">Roll</td>
                            <td class="px-6 py-4">Gudang Cikarang</td>
                            <td class="px-6 py-4">Supplier Y</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('warehouse.inbound.edit', 3) }}" class="px-3 py-1 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600 transition">Edit</a>
                                    <button onclick="confirmDelete(3)" class="px-3 py-1 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600 transition">Hapus</button>
                                </div>
                            </td>
                        </tr>
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
