@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header with Back Button -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('invoices.index') }}" class="p-2 hover:bg-white rounded-lg transition">
                <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Invoice Detail</h1>
                <p class="text-slate-600 mt-1">INV-2026-0001</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-3 mb-6">
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak
            </button>
            <button class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export PDF
            </button>
            <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Email
            </button>
        </div>

        <!-- Main Invoice Container -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Invoice Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <img src="{{ asset('images/bll.png') }}" alt="LogistikPro" class="h-12 w-auto">
                            <div>
                                <h2 class="text-2xl font-bold">LogistikPro</h2>
                                <p class="text-blue-100">Invoice Management System</p>
                            </div>
                        </div>
                        <p class="text-blue-100">Jl. Raya Logistik No. 123</p>
                        <p class="text-blue-100">Jakarta Selatan, 12310</p>
                        <p class="text-blue-100">Tel: +62-21-1234567</p>
                    </div>
                    <div class="text-right">
                        <p class="text-4xl font-bold mb-2">INVOICE</p>
                        <p class="text-blue-100">INV-2026-0001</p>
                        <p class="text-blue-100 text-sm mt-2">Issued: 05 May 2026</p>
                        <p class="text-blue-100 text-sm">Due: 19 May 2026</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <!-- Invoice Details Grid -->
                <div class="grid grid-cols-2 gap-8 mb-8">
                    <!-- From Section -->
                    <div>
                        <h3 class="text-sm font-semibold text-slate-600 uppercase mb-3">Dari</h3>
                        <p class="font-semibold text-slate-900">LogistikPro Indonesia</p>
                        <p class="text-slate-600 text-sm mt-2">PT Logistik Indonesia Raya</p>
                        <p class="text-slate-600 text-sm">Jl. Raya Logistik No. 123</p>
                        <p class="text-slate-600 text-sm">Jakarta Selatan, 12310</p>
                        <p class="text-slate-600 text-sm">Indonesia</p>
                    </div>

                    <!-- To Section -->
                    <div>
                        <h3 class="text-sm font-semibold text-slate-600 uppercase mb-3">Kepada</h3>
                        <p class="font-semibold text-slate-900">PT Mitra Logistik</p>
                        <p class="text-slate-600 text-sm mt-2">Attn: Ahmad Santoso</p>
                        <p class="text-slate-600 text-sm">Jl. Gatot Subroto No. 456</p>
                        <p class="text-slate-600 text-sm">Jakarta Pusat, 12140</p>
                        <p class="text-slate-600 text-sm">Indonesia</p>
                        <p class="text-slate-600 text-sm mt-3">Email: ahmad.santoso@mitralogistik.com</p>
                        <p class="text-slate-600 text-sm">Phone: +62-21-9876543</p>
                    </div>
                </div>

                <!-- Invoice Info Grid -->
                <div class="grid grid-cols-4 gap-4 mb-8 bg-slate-50 p-6 rounded-lg">
                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase mb-1">Nomor Invoice</p>
                        <p class="text-lg font-bold text-slate-900">INV-2026-0001</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase mb-1">Tanggal Invoice</p>
                        <p class="text-lg font-bold text-slate-900">05 May 2026</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase mb-1">Tanggal Jatuh Tempo</p>
                        <p class="text-lg font-bold text-slate-900">19 May 2026</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase mb-1">Status</p>
                        <p class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Belum Dibayar</p>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="mb-8">
                    <h3 class="text-sm font-semibold text-slate-900 mb-4 uppercase">Detail Pengiriman</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-100 border-b-2 border-slate-300">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Deskripsi</th>
                                    <th class="px-4 py-3 text-left font-semibold text-slate-700">No Resi</th>
                                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Tujuan</th>
                                    <th class="px-4 py-3 text-center font-semibold text-slate-700">Qty</th>
                                    <th class="px-4 py-3 text-right font-semibold text-slate-700">Harga Satuan</th>
                                    <th class="px-4 py-3 text-right font-semibold text-slate-700">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <tr>
                                    <td class="px-4 py-3">Pengiriman ke Jakarta</td>
                                    <td class="px-4 py-3">RES-20260505-00123</td>
                                    <td class="px-4 py-3">Jakarta</td>
                                    <td class="px-4 py-3 text-center">1</td>
                                    <td class="px-4 py-3 text-right">Rp 150,000</td>
                                    <td class="px-4 py-3 text-right font-semibold">Rp 150,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Summary Section -->
                <div class="flex justify-end mb-8">
                    <div class="w-96">
                        <div class="space-y-2 mb-4 pb-4 border-b-2 border-slate-300">
                            <div class="flex justify-between text-slate-700">
                                <span>Subtotal</span>
                                <span>Rp 150,000</span>
                            </div>
                            <div class="flex justify-between text-slate-700">
                                <span>Diskon (0%)</span>
                                <span>Rp 0</span>
                            </div>
                            <div class="flex justify-between text-slate-700">
                                <span>Pajak (10%)</span>
                                <span>Rp 15,000</span>
                            </div>
                            <div class="flex justify-between text-slate-700">
                                <span>Biaya Admin</span>
                                <span>Rp 0</span>
                            </div>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg border-2 border-blue-500 mb-4">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-slate-900 text-lg">TOTAL</span>
                                <span class="font-bold text-blue-600 text-2xl">Rp 165,000</span>
                            </div>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-500">
                            <p class="text-sm font-semibold text-slate-900">Belum Dibayar</p>
                            <p class="text-2xl font-bold text-yellow-600">Rp 165,000</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="bg-slate-50 p-6 rounded-lg mb-8">
                    <h3 class="text-sm font-semibold text-slate-900 mb-4 uppercase">Informasi Pembayaran</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-semibold text-slate-600 mb-1">METODE PEMBAYARAN</p>
                            <p class="text-slate-900 font-semibold">Transfer Bank</p>
                            <p class="text-slate-600 text-sm mt-2">Bank: BCA</p>
                            <p class="text-slate-600 text-sm">No Rek: 1234567890</p>
                            <p class="text-slate-600 text-sm">A/N: PT Logistik Indonesia Raya</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-600 mb-1">RIWAYAT PEMBAYARAN</p>
                            <div class="space-y-2">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-slate-900 font-semibold text-sm">Belum ada pembayaran</p>
                                        <p class="text-slate-600 text-xs">-</p>
                                    </div>
                                    <span class="text-red-600 font-semibold">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                <div class="border-t-2 border-slate-300 pt-6">
                    <h3 class="text-sm font-semibold text-slate-900 mb-3 uppercase">Catatan</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Terima kasih telah menggunakan layanan LogistikPro. Pembayaran diharapkan sesuai dengan tanggal jatuh tempo yang tertera di atas. Untuk pertanyaan mengenai invoice ini, silakan hubungi customer service kami di +62-21-1234567 atau email support@logistikpro.com
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-slate-50 px-8 py-4 border-t border-slate-200 flex justify-between items-center">
                <p class="text-xs text-slate-600">Generated on {{ date('d M Y H:i:s') }}</p>
                <p class="text-xs text-slate-600">LogistikPro © 2026 - Confidential</p>
            </div>
        </div>

        <!-- Additional Actions -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Tindakan Lanjutan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <button class="p-4 border-2 border-blue-300 rounded-lg hover:bg-blue-50 transition text-left">
                    <p class="font-semibold text-slate-900 mb-1">Catat Pembayaran</p>
                    <p class="text-sm text-slate-600">Catat pembayaran untuk invoice ini</p>
                </button>
                <button class="p-4 border-2 border-green-300 rounded-lg hover:bg-green-50 transition text-left">
                    <p class="font-semibold text-slate-900 mb-1">Kirim Reminder</p>
                    <p class="text-sm text-slate-600">Kirim pengingat pembayaran ke customer</p>
                </button>
                <button class="p-4 border-2 border-red-300 rounded-lg hover:bg-red-50 transition text-left">
                    <p class="font-semibold text-slate-900 mb-1">Batalkan Invoice</p>
                    <p class="text-sm text-slate-600">Batalkan atau hapus invoice ini</p>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style media="print">
    @page {
        size: A4;
        margin: 0.5cm;
    }
    
    body {
        margin: 0;
        padding: 0;
    }
    
    .min-h-screen {
        min-height: auto;
    }
    
    .mt-8, .flex.flex-wrap, .flex.items-center.gap-4 {
        display: none;
    }
    
    .bg-white {
        box-shadow: none;
        border: 1px solid #ccc;
    }
</style>
@endsection
