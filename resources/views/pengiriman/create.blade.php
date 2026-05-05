@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Buat Pengiriman Baru</h1>
            <p class="text-slate-600">Isi form di bawah untuk membuat pengiriman baru</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <form id="pengirimanForm" method="POST" action="{{ route('pengiriman.store') }}" class="divide-y divide-slate-200">
                @csrf

                <!-- Form Section 1: Informasi Dasar -->
                <div class="p-6 sm:p-8">
                    <h2 class="text-xl font-semibold text-slate-900 mb-6 flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-100 text-blue-600 mr-3">1</span>
                        Informasi Dasar
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- No Invoice -->
                        <div>
                            <label for="no_invoice" class="block text-sm font-medium text-slate-700 mb-2">
                                No Invoice <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="no_invoice" name="no_invoice" 
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg bg-slate-50 text-slate-900 cursor-not-allowed"
                                   placeholder="Auto Generated" disabled>
                            <input type="hidden" name="no_invoice" id="no_invoice_hidden">
                            <p class="text-xs text-slate-500 mt-1">Nomor invoice akan digenerate otomatis</p>
                        </div>

                        <!-- No Resi -->
                        <div>
                            <label for="no_resi" class="block text-sm font-medium text-slate-700 mb-2">
                                No Resi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="no_resi" name="no_resi" 
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg bg-slate-50 text-slate-900 cursor-not-allowed"
                                   placeholder="Auto Generated" disabled>
                            <input type="hidden" name="no_resi" id="no_resi_hidden">
                            <p class="text-xs text-slate-500 mt-1">Nomor resi akan digenerate otomatis</p>
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-slate-700 mb-2">
                                Tanggal <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="tanggal" name="tanggal" required
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>

                        <!-- Pengirim -->
                        <div>
                            <label for="pengirim" class="block text-sm font-medium text-slate-700 mb-2">
                                Pengirim <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="pengirim" name="pengirim" required
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Nama Pengirim">
                        </div>
                    </div>
                </div>

                <!-- Form Section 2: Data Penerima -->
                <div class="p-6 sm:p-8 bg-slate-50">
                    <h2 class="text-xl font-semibold text-slate-900 mb-6 flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 mr-3">2</span>
                        Data Penerima
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Penerima -->
                        <div>
                            <label for="penerima" class="block text-sm font-medium text-slate-700 mb-2">
                                Nama Penerima <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="penerima" name="penerima" required
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Nama Penerima">
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-slate-700 mb-2">
                                Alamat Pengiriman <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="alamat" name="alamat" required
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Alamat Lengkap">
                        </div>

                        <!-- Tujuan -->
                        <div class="md:col-span-2">
                            <label for="tujuan" class="block text-sm font-medium text-slate-700 mb-2">
                                Tujuan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="tujuan" name="tujuan" required
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Kota/Provinsi Tujuan">
                        </div>
                    </div>
                </div>

                <!-- Form Section 3: Detail Barang -->
                <div class="p-6 sm:p-8">
                    <h2 class="text-xl font-semibold text-slate-900 mb-6 flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-purple-100 text-purple-600 mr-3">3</span>
                        Detail Barang
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Jenis Barang -->
                        <div>
                            <label for="jenis_barang" class="block text-sm font-medium text-slate-700 mb-2">
                                Jenis Barang <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="jenis_barang" name="jenis_barang" required
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Contoh: Elektronik, Pakaian, dll">
                        </div>

                        <!-- Berat -->
                        <div>
                            <label for="berat" class="block text-sm font-medium text-slate-700 mb-2">
                                Berat (KG) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="berat" name="berat" required step="0.01" min="0"
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="0.00">
                        </div>

                        <!-- Harga per KG -->
                        <div>
                            <label for="harga_per_kg" class="block text-sm font-medium text-slate-700 mb-2">
                                Harga per KG (Rp) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-500 font-medium">Rp</span>
                                <input type="number" id="harga_per_kg" name="harga_per_kg" required step="0.01" min="0"
                                       class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                       placeholder="0.00">
                            </div>
                        </div>

                        <!-- Transportasi -->
                        <div>
                            <label for="transportasi" class="block text-sm font-medium text-slate-700 mb-2">
                                Jenis Transportasi <span class="text-red-500">*</span>
                            </label>
                            <select id="transportasi" name="transportasi" required
                                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                <option value="">-- Pilih Transportasi --</option>
                                <option value="darat">🚛 Darat (Ekspedisi)</option>
                                <option value="laut">🚢 Laut (Kapal)</option>
                                <option value="udara">✈️ Udara (Pesawat)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Form Section 4: Detail Transportasi (Dynamic) -->
                <div id="transportasiDetails" class="p-6 sm:p-8 bg-slate-50 hidden">
                    <h2 class="text-xl font-semibold text-slate-900 mb-6 flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-amber-100 text-amber-600 mr-3">4</span>
                        Detail Transportasi
                    </h2>
                    
                    <!-- Darat Fields -->
                    <div id="daratFields" class="space-y-6 hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="ekspedisi" class="block text-sm font-medium text-slate-700 mb-2">
                                    Nama Ekspedisi <span class="text-red-500">*</span>
                                </label>
                                <select id="ekspedisi" name="ekspedisi"
                                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                    <option value="">-- Pilih Ekspedisi --</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="gojek">Gojek Logistik</option>
                                    <option value="grab">Grab Logistik</option>
                                </select>
                            </div>
                            <div>
                                <label for="estimasi_hari" class="block text-sm font-medium text-slate-700 mb-2">
                                    Estimasi Hari <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="estimasi_hari" name="estimasi_hari" min="1"
                                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                       placeholder="Berapa hari?">
                            </div>
                        </div>
                    </div>

                    <!-- Laut Fields -->
                    <div id="luatFields" class="space-y-6 hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_kapal" class="block text-sm font-medium text-slate-700 mb-2">
                                    Nama Kapal <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="nama_kapal" name="nama_kapal"
                                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                       placeholder="Nama Kapal">
                            </div>
                            <div>
                                <label for="jadwal_kapal" class="block text-sm font-medium text-slate-700 mb-2">
                                    Jadwal Keberangkatan <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" id="jadwal_kapal" name="jadwal_kapal"
                                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>
                        </div>
                    </div>

                    <!-- Udara Fields -->
                    <div id="udaraFields" class="space-y-6 hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="maskapai" class="block text-sm font-medium text-slate-700 mb-2">
                                    Maskapai Penerbangan <span class="text-red-500">*</span>
                                </label>
                                <select id="maskapai" name="maskapai"
                                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                    <option value="">-- Pilih Maskapai --</option>
                                    <option value="garuda">Garuda Indonesia</option>
                                    <option value="batik">Batik Air</option>
                                    <option value="lion">Lion Air</option>
                                    <option value="citilink">Citilink</option>
                                    <option value="sriwijaya">Sriwijaya Air</option>
                                </select>
                            </div>
                            <div>
                                <label for="nomor_flight" class="block text-sm font-medium text-slate-700 mb-2">
                                    Nomor Flight <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="nomor_flight" name="nomor_flight"
                                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                       placeholder="Contoh: GA-123">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section 5: Ringkasan & Perhitungan -->
                <div class="p-6 sm:p-8">
                    <h2 class="text-xl font-semibold text-slate-900 mb-6 flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-rose-100 text-rose-600 mr-3">5</span>
                        Ringkasan Biaya
                    </h2>
                    
                    <div class="bg-slate-50 rounded-lg p-6 space-y-4">
                        <!-- Subtotal -->
                        <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                            <span class="text-slate-700 font-medium">Subtotal (Berat × Harga/KG)</span>
                            <span class="text-lg font-semibold text-slate-900">Rp <span id="subtotal">0</span></span>
                        </div>

                        <!-- PPN -->
                        <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                            <span class="text-slate-700 font-medium">PPN (1.1%)</span>
                            <span class="text-lg font-semibold text-slate-900">Rp <span id="ppn">0</span></span>
                        </div>

                        <!-- PPH -->
                        <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                            <span class="text-slate-700 font-medium">PPH (2%)</span>
                            <span class="text-lg font-semibold text-slate-900">Rp <span id="pph">0</span></span>
                        </div>

                        <!-- Grand Total -->
                        <div class="flex justify-between items-center pt-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg px-4 py-4">
                            <span class="text-slate-900 font-bold text-lg">Grand Total</span>
                            <span class="text-2xl font-bold text-blue-600">Rp <span id="grandTotal">0</span></span>
                        </div>

                        <!-- Hidden Input untuk Total -->
                        <input type="hidden" id="totalAmount" name="total_amount">
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <p class="text-sm text-blue-900 flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                            </svg>
                            <span><strong>Catatan:</strong> Semua perhitungan dilakukan secara otomatis saat Anda mengisi data berat dan harga per KG.</span>
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 sm:px-8 py-6 bg-slate-50 flex gap-3 justify-end border-t border-slate-200">
                    <a href="{{ route('pengiriman.index') }}" 
                       class="px-6 py-2.5 rounded-lg border border-slate-300 text-slate-700 font-medium hover:bg-slate-100 transition duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium hover:from-blue-600 hover:to-blue-700 transition duration-200 shadow-lg">
                        Simpan Pengiriman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generate Invoice dan Resi Numbers
        function generateInvoiceNumber() {
            const date = new Date();
            const timestamp = date.getTime();
            return 'INV-' + date.getFullYear() + String(date.getMonth() + 1).padStart(2, '0') + '-' + Math.floor(Math.random() * 9999).toString().padStart(4, '0');
        }

        function generateResiNumber() {
            const date = new Date();
            return 'RES-' + date.getFullYear() + String(date.getMonth() + 1).padStart(2, '0') + String(date.getDate()).padStart(2, '0') + '-' + Math.floor(Math.random() * 99999).toString().padStart(5, '0');
        }

        // Set auto-generated values
        const invoiceNum = generateInvoiceNumber();
        const resiNum = generateResiNumber();
        document.getElementById('no_invoice').value = invoiceNum;
        document.getElementById('no_invoice_hidden').value = invoiceNum;
        document.getElementById('no_resi').value = resiNum;
        document.getElementById('no_resi_hidden').value = resiNum;

        // Set today's date
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal').value = today;

        // Transportasi Dynamic Fields
        const transportasiSelect = document.getElementById('transportasi');
        const transportasiDetails = document.getElementById('transportasiDetails');
        const daratFields = document.getElementById('daratFields');
        const luatFields = document.getElementById('luatFields');
        const udaraFields = document.getElementById('udaraFields');

        transportasiSelect.addEventListener('change', function() {
            const value = this.value;
            daratFields.classList.add('hidden');
            luatFields.classList.add('hidden');
            udaraFields.classList.add('hidden');

            if (value) {
                transportasiDetails.classList.remove('hidden');
                if (value === 'darat') {
                    daratFields.classList.remove('hidden');
                } else if (value === 'laut') {
                    luatFields.classList.remove('hidden');
                } else if (value === 'udara') {
                    udaraFields.classList.remove('hidden');
                }
            } else {
                transportasiDetails.classList.add('hidden');
            }
        });

        // Format number as currency
        function formatCurrency(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }

        // Calculate totals
        function calculateTotals() {
            const berat = parseFloat(document.getElementById('berat').value) || 0;
            const hargaPerKg = parseFloat(document.getElementById('harga_per_kg').value) || 0;

            const subtotal = berat * hargaPerKg;
            const ppn = subtotal * 0.011; // 1.1%
            const pph = subtotal * 0.02;  // 2%
            const grandTotal = subtotal + ppn + pph;

            document.getElementById('subtotal').textContent = formatCurrency(Math.round(subtotal));
            document.getElementById('ppn').textContent = formatCurrency(Math.round(ppn));
            document.getElementById('pph').textContent = formatCurrency(Math.round(pph));
            document.getElementById('grandTotal').textContent = formatCurrency(Math.round(grandTotal));
            document.getElementById('totalAmount').value = Math.round(grandTotal);
        }

        // Listen to input changes
        document.getElementById('berat').addEventListener('input', calculateTotals);
        document.getElementById('harga_per_kg').addEventListener('input', calculateTotals);

        // Form submission
        document.getElementById('pengirimanForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate transportation details
            const transportasi = document.getElementById('transportasi').value;
            if (!transportasi) {
                alert('Silakan pilih jenis transportasi');
                return;
            }

            if (transportasi === 'darat' && !document.getElementById('ekspedisi').value) {
                alert('Silakan pilih ekspedisi');
                return;
            }
            if (transportasi === 'darat' && !document.getElementById('estimasi_hari').value) {
                alert('Silakan masukkan estimasi hari');
                return;
            }

            if (transportasi === 'laut' && !document.getElementById('nama_kapal').value) {
                alert('Silakan masukkan nama kapal');
                return;
            }
            if (transportasi === 'laut' && !document.getElementById('jadwal_kapal').value) {
                alert('Silakan masukkan jadwal kapal');
                return;
            }

            if (transportasi === 'udara' && !document.getElementById('maskapai').value) {
                alert('Silakan pilih maskapai');
                return;
            }
            if (transportasi === 'udara' && !document.getElementById('nomor_flight').value) {
                alert('Silakan masukkan nomor flight');
                return;
            }

            // Form is valid, submit
            this.submit();
        });
    });
</script>
@endsection
