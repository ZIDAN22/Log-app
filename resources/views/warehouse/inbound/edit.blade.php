@extends('layouts.app')

@section('title', 'Edit Barang Masuk')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Edit Barang Masuk</h1>
                <p class="text-slate-600">Edit data barang yang masuk ke gudang.</p>
            </div>
            <a href="{{ route('warehouse.inbound.index') }}" class="px-4 py-2 bg-slate-500 text-white rounded-lg hover:bg-slate-600 transition">
                ← Kembali
            </a>
        </div>

        <!-- Form Edit Barang Masuk -->
        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="px-6 py-6 border-b border-slate-200 bg-gradient-to-r from-blue-50 to-blue-100">
                <h2 class="text-xl font-semibold text-slate-900">Form Edit Barang Masuk</h2>
                <p class="mt-2 text-slate-600 text-sm">Ubah detail barang yang sudah masuk ke gudang</p>
            </div>
            <div class="p-6">
                <form action="{{ route('warehouse.inbound.update', $inbound->id ?? 1) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ $inbound->nama_barang ?? 'Pallet Item A' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Jumlah</label>
                        <input type="number" name="jumlah" value="{{ $inbound->jumlah ?? '120' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Satuan</label>
                        <select name="satuan" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                            <option value="">Pilih Satuan</option>
                            <option value="Pcs" {{ ($inbound->satuan ?? 'Pcs') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="Box" {{ ($inbound->satuan ?? 'Pcs') == 'Box' ? 'selected' : '' }}>Box</option>
                            <option value="Kg" {{ ($inbound->satuan ?? 'Pcs') == 'Kg' ? 'selected' : '' }}>Kg</option>
                            <option value="Roll" {{ ($inbound->satuan ?? 'Pcs') == 'Roll' ? 'selected' : '' }}>Roll</option>
                            <option value="Karton" {{ ($inbound->satuan ?? 'Pcs') == 'Karton' ? 'selected' : '' }}>Karton</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Supplier</label>
                        <input type="text" name="supplier" value="{{ $inbound->supplier ?? 'Supplier X' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">No Referensi</label>
                        <input type="text" name="no_referensi" value="{{ $inbound->no_referensi ?? 'INB-001' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" value="{{ $inbound->tanggal_masuk ?? '2026-05-07' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Gudang</label>
                        <select name="gudang" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                            <option value="">Pilih Gudang</option>
                            <option value="Gudang Cikarang" {{ ($inbound->gudang ?? 'Gudang Cikarang') == 'Gudang Cikarang' ? 'selected' : '' }}>Gudang Cikarang</option>
                            <option value="Gudang Jakarta" {{ ($inbound->gudang ?? 'Gudang Cikarang') == 'Gudang Jakarta' ? 'selected' : '' }}>Gudang Jakarta</option>
                            <option value="Gudang Surabaya" {{ ($inbound->gudang ?? 'Gudang Cikarang') == 'Gudang Surabaya' ? 'selected' : '' }}>Gudang Surabaya</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Catatan</label>
                        <textarea name="catatan" rows="3" placeholder="Catatan tambahan (opsional)" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ $inbound->catatan ?? '' }}</textarea>
                    </div>
                    <div class="md:col-span-2 flex justify-between">
                        <button type="button" onclick="confirmDelete()" class="px-6 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition">
                            Hapus Data
                        </button>
                        <div class="flex space-x-4">
                            <a href="{{ route('warehouse.inbound.index') }}" class="px-6 py-2 bg-slate-500 text-white font-medium rounded-lg hover:bg-slate-600 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 transition">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.')) {
        // Create a form to submit delete request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("warehouse.inbound.destroy", $inbound->id ?? 1) }}';

        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';

        const csrfField = document.createElement('input');
        csrfField.type = 'hidden';
        csrfField.name = '_token';
        csrfField.value = '{{ csrf_token() }}';

        form.appendChild(methodField);
        form.appendChild(csrfField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection