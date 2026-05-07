@extends('layouts.app')

@section('title', 'Packing List')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Packing List</h1>
                <p class="text-slate-600">Dokumen packing list untuk pengiriman dan invoice terkait.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print
                </button>
                <button class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export PDF
                </button>
                <a href="{{ route('invoices.show', $invoiceNumber) }}" class="inline-flex items-center px-4 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-800 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Invoice
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-8">
                <div class="flex flex-col lg:flex-row justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="h-12 w-12 bg-white/20 rounded-full flex items-center justify-center text-xl font-bold">L</div>
                            <div>
                                <h2 class="text-2xl font-bold">LogistikPro</h2>
                                <p class="text-blue-100">Packing List Document</p>
                            </div>
                        </div>
                        <p class="text-blue-100">Jl. Raya Logistik No. 123</p>
                        <p class="text-blue-100">Jakarta Selatan, 12310</p>
                        <p class="text-blue-100">Tel: +62-21-1234567</p>
                    </div>
                    <div class="text-right">
                        <p class="text-4xl font-bold mb-2">PACKING LIST</p>
                        <p class="text-blue-100">Invoice: {{ $invoiceNumber }}</p>
                        <p class="text-blue-100 text-sm mt-2">Tanggal: {{ date('d M Y') }}</p>
                        <p class="text-blue-100 text-sm">Dokumen: PL-{{ substr($invoiceNumber, 4) }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                        <h3 class="text-sm font-semibold text-slate-600 uppercase mb-3">Invoice Terkait</h3>
                        <p class="text-lg font-bold text-slate-900">{{ $invoiceNumber }}</p>
                        <p class="text-slate-600 mt-2">Nama Pelanggan: PT Mitra Logistik</p>
                        <p class="text-slate-600">No. Resi: RES-20260505-00123</p>
                    </div>
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                        <h3 class="text-sm font-semibold text-slate-600 uppercase mb-3">Alamat Pengiriman</h3>
                        <p class="text-lg font-bold text-slate-900">Jakarta</p>
                        <p class="text-slate-600 mt-2">Jl. Gatot Subroto No. 456</p>
                        <p class="text-slate-600">Jakarta Pusat, 12140</p>
                    </div>
                </div>

                <div class="overflow-x-auto mb-8">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-100 border-b-2 border-slate-300">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-slate-700">No Invoice</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-700">Nama Barang</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-700">Qty</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-700">Jumlah Koli</th>
                                <th class="px-4 py-3 text-right font-semibold text-slate-700">Harga per Barang</th>
                                <th class="px-4 py-3 text-right font-semibold text-slate-700">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach ($packingItems as $item)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-4 text-slate-900 font-medium">{{ $invoiceNumber }}</td>
                                <td class="px-4 py-4 text-slate-700">{{ $item['description'] }}</td>
                                <td class="px-4 py-4 text-center text-slate-700">{{ $item['qty'] }}</td>
                                <td class="px-4 py-4 text-center text-slate-700">{{ $item['koli'] }}</td>
                                <td class="px-4 py-4 text-right text-slate-700">Rp {{ number_format($item['unit_price'], 0, ',', '.') }}</td>
                                <td class="px-4 py-4 text-right text-slate-900 font-semibold">Rp {{ number_format($item['qty'] * $item['unit_price'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-6">
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                        <h3 class="text-sm font-semibold text-slate-600 uppercase mb-3">Ringkasan Packing</h3>
                        <div class="space-y-3 text-slate-700">
                            <div class="flex justify-between gap-4">
                                <span>Total Item</span>
                                <strong>{{ $summary['total_items'] }}</strong>
                            </div>
                            <div class="flex justify-between gap-4">
                                <span>Total Koli</span>
                                <strong>{{ $summary['total_koli'] }}</strong>
                            </div>
                            <div class="flex justify-between gap-4">
                                <span>Total Harga</span>
                                <strong>Rp {{ number_format($summary['grand_total'], 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-sm font-semibold text-slate-600 uppercase mb-3">Catatan Pengiriman</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">Pastikan semua barang dicatat sesuai jumlah koli dan dikemas dengan aman. Periksa label packing sebelum barang dikirim.</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 px-8 py-4 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-slate-600">Generated on {{ date('d M Y H:i:s') }}</p>
                <p class="text-xs text-slate-600">LogistikPro © {{ date('Y') }} - Packing List</p>
            </div>
        </div>
    </div>
</div>

<style media="print">
    @page {
        size: A4;
        margin: 0.5cm;
    }

    body {
        margin: 0;
        padding: 0;
        background: #fff;
    }

    .min-h-screen {
        min-height: auto;
    }

    button,
    a[href],
    .flex.flex-wrap,
    .flex.items-center.gap-4 {
        display: none !important;
    }

    .bg-white,
    .bg-slate-50,
    .bg-gradient-to-r {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }

    .rounded-xl,
    .rounded-lg,
    .rounded-full {
        border-radius: 0 !important;
    }

    .overflow-x-auto {
        overflow-x: visible !important;
    }
</style>
@endsection