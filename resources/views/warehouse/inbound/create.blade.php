@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Tambah Barang Masuk</h1>
                <p class="text-slate-600">Tambahkan data barang yang masuk ke gudang.</p>
            </div>
            <a href="{{ route('warehouse.inbound.index') }}" class="px-4 py-2 bg-slate-500 text-white rounded-lg hover:bg-slate-600 transition">
                ← Kembali
            </a>
        </div>

        <!-- Form Tambah Barang Masuk -->
        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="px-6 py-6 border-b border-slate-200 bg-gradient-to-r from-emerald-50 to-emerald-100">
                <h2 class="text-xl font-semibold text-slate-900">Form Barang Masuk</h2>
                <p class="mt-2 text-slate-600 text-sm">Isi detail barang yang akan masuk ke gudang</p>
            </div>
            <div class="p-6">
                <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Barang</label>
                        <input type="text" name="nama_barang" placeholder="Contoh: Pallet Item A" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Jumlah</label>
                        <input type="number" name="jumlah" placeholder="Masukkan jumlah" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Satuan</label>
                        <select name="satuan" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" required>
                            <option value="">Pilih Satuan</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Box">Box</option>
                            <option value="Kg">Kg</option>
                            <option value="Roll">Roll</option>
                            <option value="Karton">Karton</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Supplier</label>
                        <input type="text" name="supplier" placeholder="Nama supplier" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">No Referensi</label>
                        <input type="text" name="no_referensi" placeholder="PO-001" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Gudang</label>
                        <select name="gudang" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" required>
                            <option value="">Pilih Gudang</option>
                            <option value="Gudang Cikarang">Gudang Cikarang</option>
                            <option value="Gudang Jakarta">Gudang Jakarta</option>
                            <option value="Gudang Surabaya">Gudang Surabaya</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Catatan</label>
                        <textarea name="catatan" rows="3" placeholder="Catatan tambahan (opsional)" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"></textarea>
                    </div>
                    <div class="md:col-span-2 flex justify-end space-x-4">
                        <a href="{{ route('warehouse.inbound.index') }}" class="px-6 py-2 bg-slate-500 text-white font-medium rounded-lg hover:bg-slate-600 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium rounded-lg hover:from-emerald-600 hover:to-emerald-700 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection