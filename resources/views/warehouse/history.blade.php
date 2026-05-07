@extends('layouts.app')

@section('title', 'Riwayat Pergerakan Barang')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-slate-900 mb-2">Riwayat Pergerakan Barang</h1>
            <p class="text-slate-600">Log lengkap semua aktivitas barang masuk dan keluar dari gudang</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 mb-6 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Cari No Resi</label>
                    <input type="text" placeholder="Ketik No Resi..." class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent transition text-sm">
                </div>

                <!-- Date From -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Dari Tanggal</label>
                    <input type="date" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent transition text-sm">
                </div>

                <!-- Date To -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Sampai Tanggal</label>
                    <input type="date" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent transition text-sm">
                </div>

                <!-- Activity Type -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tipe Aktivitas</label>
                    <select class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent transition text-sm">
                        <option>Semua Tipe</option>
                        <option>Barang Masuk</option>
                        <option>Barang Keluar</option>
                        <option>Update Status</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                    <select class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent transition text-sm">
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Diterima</option>
                        <option>Disimpan</option>
                        <option>Siap Kirim</option>
                        <option>Dikirim</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 mt-4">
                <button class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition text-sm font-medium">Filter</button>
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition text-sm font-medium">Reset</button>
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition text-sm font-medium ml-auto">📥 Export</button>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Total Aktivitas</p>
                <p class="text-3xl font-bold text-slate-900 mt-2">486</p>
                <p class="text-xs text-slate-500 mt-1">Periode 7 hari terakhir</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Barang Masuk</p>
                <p class="text-3xl font-bold text-emerald-600 mt-2">156</p>
                <p class="text-xs text-slate-500 mt-1">Total: 8,240 kg</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Barang Keluar</p>
                <p class="text-3xl font-bold text-orange-600 mt-2">142</p>
                <p class="text-xs text-slate-500 mt-1">Total: 5,120 kg</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <p class="text-sm text-slate-600 font-medium">Pending Verifikasi</p>
                <p class="text-3xl font-bold text-yellow-600 mt-2">12</p>
                <p class="text-xs text-slate-500 mt-1">Menunggu aksi</p>
            </div>
        </div>

        <!-- Activity Table -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50 sticky top-0">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tanggal & Waktu</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No Resi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Aktivitas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Detail</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                        <!-- Activity 1 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">07 Mei 2026</div>
                                <div class="text-xs text-slate-500">16:45 WIB</div>
                            </td>
                            <td class="px-6 py-4 font-semibold">OUT-00156</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800">Outbound</span>
                            </td>
                            <td class="px-6 py-4 font-medium">Barang Dikirim</td>
                            <td class="px-6 py-4">
                                <button onclick="openActivityDetail(1)" class="text-blue-600 hover:text-blue-700 font-medium text-xs">Lihat Detail</button>
                            </td>
                            <td class="px-6 py-4">Budi Santoso</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800">Dikirim</span>
                            </td>
                        </tr>

                        <!-- Activity 2 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">07 Mei 2026</div>
                                <div class="text-xs text-slate-500">14:30 WIB</div>
                            </td>
                            <td class="px-6 py-4 font-semibold">OUT-00156</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-800">Outbound</span>
                            </td>
                            <td class="px-6 py-4 font-medium">Barang Keluar Gudang</td>
                            <td class="px-6 py-4">
                                <button onclick="openActivityDetail(2)" class="text-blue-600 hover:text-blue-700 font-medium text-xs">Lihat Detail</button>
                            </td>
                            <td class="px-6 py-4">Budi Santoso</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-800">Keluar Gudang</span>
                            </td>
                        </tr>

                        <!-- Activity 3 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">07 Mei 2026</div>
                                <div class="text-xs text-slate-500">13:30 WIB</div>
                            </td>
                            <td class="px-6 py-4 font-semibold">OUT-00156</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">Update Status</span>
                            </td>
                            <td class="px-6 py-4 font-medium">Siap Pengiriman</td>
                            <td class="px-6 py-4">
                                <button onclick="openActivityDetail(3)" class="text-blue-600 hover:text-blue-700 font-medium text-xs">Lihat Detail</button>
                            </td>
                            <td class="px-6 py-4">Budi Santoso</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">Siap Kirim</span>
                            </td>
                        </tr>

                        <!-- Activity 4 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">07 Mei 2026</div>
                                <div class="text-xs text-slate-500">14:30 WIB</div>
                            </td>
                            <td class="px-6 py-4 font-semibold">INB-00124</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Inbound</span>
                            </td>
                            <td class="px-6 py-4 font-medium">Barang Disimpan</td>
                            <td class="px-6 py-4">
                                <button onclick="openActivityDetail(4)" class="text-blue-600 hover:text-blue-700 font-medium text-xs">Lihat Detail</button>
                            </td>
                            <td class="px-6 py-4">Ahmad Wijaya</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">Disimpan</span>
                            </td>
                        </tr>

                        <!-- Activity 5 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">07 Mei 2026</div>
                                <div class="text-xs text-slate-500">10:00 WIB</div>
                            </td>
                            <td class="px-6 py-4 font-semibold">INB-00124</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Inbound</span>
                            </td>
                            <td class="px-6 py-4 font-medium">Barang Diterima</td>
                            <td class="px-6 py-4">
                                <button onclick="openActivityDetail(5)" class="text-blue-600 hover:text-blue-700 font-medium text-xs">Lihat Detail</button>
                            </td>
                            <td class="px-6 py-4">Ahmad Wijaya</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Diterima</span>
                            </td>
                        </tr>

                        <!-- Activity 6 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">06 Mei 2026</div>
                                <div class="text-xs text-slate-500">15:20 WIB</div>
                            </td>
                            <td class="px-6 py-4 font-semibold">OUT-00152</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800">Outbound</span>
                            </td>
                            <td class="px-6 py-4 font-medium">Barang Dikirim</td>
                            <td class="px-6 py-4">
                                <button onclick="openActivityDetail(6)" class="text-blue-600 hover:text-blue-700 font-medium text-xs">Lihat Detail</button>
                            </td>
                            <td class="px-6 py-4">Ahmad Wijaya</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800">Dikirim</span>
                            </td>
                        </tr>

                        <!-- Activity 7 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">05 Mei 2026</div>
                                <div class="text-xs text-slate-500">09:45 WIB</div>
                            </td>
                            <td class="px-6 py-4 font-semibold">INB-00122</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Inbound</span>
                            </td>
                            <td class="px-6 py-4 font-medium">Barang Disimpan</td>
                            <td class="px-6 py-4">
                                <button onclick="openActivityDetail(7)" class="text-blue-600 hover:text-blue-700 font-medium text-xs">Lihat Detail</button>
                            </td>
                            <td class="px-6 py-4">Rudi Hermawan</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">Disimpan</span>
                            </td>
                        </tr>

                        <!-- Activity 8 -->
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">04 Mei 2026</div>
                                <div class="text-xs text-slate-500">11:20 WIB</div>
                            </td>
                            <td class="px-6 py-4 font-semibold">OUT-00150</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800">Outbound</span>
                            </td>
                            <td class="px-6 py-4 font-medium">Barang Keluar Gudang</td>
                            <td class="px-6 py-4">
                                <button onclick="openActivityDetail(8)" class="text-blue-600 hover:text-blue-700 font-medium text-xs">Lihat Detail</button>
                            </td>
                            <td class="px-6 py-4">Rudi Hermawan</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-800">Keluar Gudang</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-6">
            <p class="text-sm text-slate-600">Menampilkan 8 dari 486 data</p>
            <div class="flex gap-2">
                <button class="px-3 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition text-sm">← Sebelumnya</button>
                <button class="px-3 py-2 bg-slate-900 text-white rounded-lg text-sm">1</button>
                <button class="px-3 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition text-sm">2</button>
                <button class="px-3 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition text-sm">3</button>
                <button class="px-3 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition text-sm">...</button>
                <button class="px-3 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition text-sm">Selanjutnya →</button>
            </div>
        </div>
    </div>
</div>

<!-- Activity Detail Modal -->
<div id="activityModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900">Detail Aktivitas</h2>
            <button onclick="closeActivityModal()" class="p-1 hover:bg-slate-300 rounded-lg transition">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="px-6 py-6 space-y-4">
            <div>
                <p class="text-xs uppercase text-slate-500 font-medium mb-1">No Resi</p>
                <p class="text-lg font-bold text-slate-900">OUT-00156</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs uppercase text-slate-500 font-medium mb-1">Tanggal & Waktu</p>
                    <p class="text-sm font-semibold text-slate-900">07 Mei 2026 - 16:45 WIB</p>
                </div>
                <div>
                    <p class="text-xs uppercase text-slate-500 font-medium mb-1">User</p>
                    <p class="text-sm font-semibold text-slate-900">Budi Santoso</p>
                </div>
            </div>

            <div>
                <p class="text-xs uppercase text-slate-500 font-medium mb-1">Aktivitas</p>
                <p class="text-sm font-semibold text-slate-900">Barang Dikirim</p>
                <p class="text-sm text-slate-600 mt-1">Pengiriman barang telah diselesaikan dan diterima oleh penerima.</p>
            </div>

            <div>
                <p class="text-xs uppercase text-slate-500 font-medium mb-1">Status</p>
                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-sm font-semibold text-purple-800">Dikirim</span>
            </div>

            <div class="bg-slate-50 p-4 rounded-lg">
                <p class="text-xs uppercase text-slate-500 font-medium mb-3">Informasi Tambahan</p>
                <div class="space-y-2 text-sm">
                    <p><span class="text-slate-600">Kendaraan:</span> <span class="font-semibold text-slate-900">Pick-up MB-001</span></p>
                    <p><span class="text-slate-600">Driver:</span> <span class="font-semibold text-slate-900">Budi Santoso</span></p>
                    <p><span class="text-slate-600">Destinasi:</span> <span class="font-semibold text-slate-900">Jakarta Pusat - PT Maju Jaya</span></p>
                    <p><span class="text-slate-600">Volume:</span> <span class="font-semibold text-slate-900">450 kg</span></p>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-slate-50 px-6 py-4 border-t border-slate-200">
            <button onclick="closeActivityModal()" class="w-full px-4 py-2.5 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-100 transition font-medium">Tutup</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openActivityDetail(id) {
    document.getElementById('activityModal').classList.remove('hidden');
}

function closeActivityModal() {
    document.getElementById('activityModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('activityModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeActivityModal();
    }
});
</script>
@endpush
@endsection
