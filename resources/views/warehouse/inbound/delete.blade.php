@extends('layouts.app')

@section('title', 'Hapus Barang Masuk')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="px-6 py-6 border-b border-slate-200 bg-gradient-to-r from-red-50 to-red-100">
                <h2 class="text-xl font-semibold text-slate-900">Konfirmasi Hapus</h2>
                <p class="mt-2 text-slate-600 text-sm">Apakah Anda yakin ingin menghapus data berikut?</p>
            </div>
            <div class="p-6">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-slate-700">No Referensi:</span>
                            <span class="text-slate-900">{{ $inbound->no_referensi ?? 'INB-001' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-slate-700">Tanggal:</span>
                            <span class="text-slate-900">{{ $inbound->tanggal_masuk ?? '07 Mei 2026' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-slate-700">Nama Barang:</span>
                            <span class="text-slate-900">{{ $inbound->nama_barang ?? 'Pallet Item A' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-slate-700">Jumlah:</span>
                            <span class="text-slate-900">{{ $inbound->jumlah ?? '120' }} {{ $inbound->satuan ?? 'Pcs' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-slate-700">Supplier:</span>
                            <span class="text-slate-900">{{ $inbound->supplier ?? 'Supplier X' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-slate-700">Gudang:</span>
                            <span class="text-slate-900">{{ $inbound->gudang ?? 'Gudang Cikarang' }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-yellow-800">Peringatan</h3>
                            <p class="text-sm text-yellow-700 mt-1">Tindakan ini tidak dapat dibatalkan. Data yang dihapus akan hilang permanen.</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('warehouse.inbound.edit', $inbound->id ?? 1) }}" class="px-6 py-2 bg-slate-500 text-white font-medium rounded-lg hover:bg-slate-600 transition">
                        Batal
                    </a>
                    <form action="{{ route('warehouse.inbound.destroy', $inbound->id ?? 1) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-6 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection