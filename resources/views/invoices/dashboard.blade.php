@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Dashboard Invoice</h1>
                <p class="text-slate-600">Lihat ringkasan dan manajemen invoice dalam format card</p>
            </div>
            <a href="{{ route('invoices.index') }}" class="mt-4 md:mt-0 inline-flex items-center justify-center px-6 py-3 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                Lihat Daftar
            </a>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <div class="flex flex-wrap gap-3">
                <select class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Semua Status</option>
                    <option>Belum Dibayar</option>
                    <option>Sebagian Dibayar</option>
                    <option>Lunas</option>
                </select>
                <input type="text" placeholder="Cari Customer..." class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 flex-1">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Filter</button>
                <button class="px-4 py-2 bg-slate-300 text-slate-700 rounded-lg hover:bg-slate-400 transition">Reset</button>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                <p class="text-slate-600 text-sm">Total Invoice</p>
                <p class="text-3xl font-bold text-slate-900">20</p>
                <p class="text-xs text-slate-500 mt-2">untuk periode ini</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
                <p class="text-slate-600 text-sm">Belum Dibayar</p>
                <p class="text-3xl font-bold text-red-600">8</p>
                <p class="text-xs text-slate-500 mt-2">Rp 10,650,000</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                <p class="text-slate-600 text-sm">Sebagian Dibayar</p>
                <p class="text-3xl font-bold text-yellow-600">5</p>
                <p class="text-xs text-slate-500 mt-2">Rp 2,500,000</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                <p class="text-slate-600 text-sm">Lunas</p>
                <p class="text-3xl font-bold text-green-600">7</p>
                <p class="text-xs text-slate-500 mt-2">100% terbayar</p>
            </div>
        </div>

        <!-- Invoice Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Invoice Card 1 - Belum Dibayar -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-6 border-l-4 border-red-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">INV-2026-0001</h3>
                        <p class="text-sm text-slate-600 mt-1">PT Mitra Logistik</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Belum Dibayar
                    </span>
                </div>

                <div class="space-y-2 mb-4 pb-4 border-b border-slate-200 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-600">Tanggal</span>
                        <span class="text-slate-900 font-semibold">05 May 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Jatuh Tempo</span>
                        <span class="text-slate-900 font-semibold">19 May 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Terbayar</span>
                        <span class="text-slate-900 font-semibold">Rp 0</span>
                    </div>
                </div>

                <div class="bg-slate-50 p-3 rounded mb-4">
                    <p class="text-xs text-slate-600 mb-1">TOTAL</p>
                    <p class="text-2xl font-bold text-slate-900">Rp 150,000</p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('invoices.show', 1) }}" class="flex-1 px-3 py-2 bg-blue-500 text-white text-center rounded text-sm hover:bg-blue-600 transition">
                        Detail
                    </a>
                    <button class="flex-1 px-3 py-2 bg-green-500 text-white rounded text-sm hover:bg-green-600 transition">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        PDF
                    </button>
                </div>
            </div>

            <!-- Invoice Card 2 - Lunas -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-6 border-l-4 border-green-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">INV-2026-0002</h3>
                        <p class="text-sm text-slate-600 mt-1">CV Ekspor Makmur</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Lunas
                    </span>
                </div>

                <div class="space-y-2 mb-4 pb-4 border-b border-slate-200 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-600">Tanggal</span>
                        <span class="text-slate-900 font-semibold">04 May 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Jatuh Tempo</span>
                        <span class="text-slate-900 font-semibold">18 May 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Terbayar</span>
                        <span class="text-green-600 font-semibold">Rp 2,500,000</span>
                    </div>
                </div>

                <div class="bg-slate-50 p-3 rounded mb-4">
                    <p class="text-xs text-slate-600 mb-1">TOTAL</p>
                    <p class="text-2xl font-bold text-slate-900">Rp 2,500,000</p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('invoices.show', 2) }}" class="flex-1 px-3 py-2 bg-blue-500 text-white text-center rounded text-sm hover:bg-blue-600 transition">
                        Detail
                    </a>
                    <button class="flex-1 px-3 py-2 bg-green-500 text-white rounded text-sm hover:bg-green-600 transition">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        PDF
                    </button>
                </div>
            </div>

            <!-- Invoice Card 3 - Sebagian Dibayar -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-6 border-l-4 border-yellow-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">INV-2026-0003</h3>
                        <p class="text-sm text-slate-600 mt-1">PT Global Cargo</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Sebagian Dibayar
                    </span>
                </div>

                <div class="space-y-2 mb-4 pb-4 border-b border-slate-200 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-600">Tanggal</span>
                        <span class="text-slate-900 font-semibold">03 May 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Jatuh Tempo</span>
                        <span class="text-slate-900 font-semibold">17 May 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Terbayar</span>
                        <span class="text-slate-900 font-semibold">Rp 2,500,000 / Rp 5,000,000</span>
                    </div>
                </div>

                <div class="bg-slate-50 p-3 rounded mb-4">
                    <p class="text-xs text-slate-600 mb-1">TOTAL</p>
                    <p class="text-2xl font-bold text-slate-900">Rp 5,000,000</p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('invoices.show', 3) }}" class="flex-1 px-3 py-2 bg-blue-500 text-white text-center rounded text-sm hover:bg-blue-600 transition">
                        Detail
                    </a>
                    <button class="flex-1 px-3 py-2 bg-green-500 text-white rounded text-sm hover:bg-green-600 transition">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        PDF
                    </button>
                </div>
            </div>

            <!-- Invoice Card 4 - Belum Dibayar -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-6 border-l-4 border-red-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">INV-2026-0004</h3>
                        <p class="text-sm text-slate-600 mt-1">PT Mitra Logistik</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Belum Dibayar
                    </span>
                </div>

                <div class="space-y-2 mb-4 pb-4 border-b border-slate-200 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-600">Tanggal</span>
                        <span class="text-slate-900 font-semibold">02 May 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Jatuh Tempo</span>
                        <span class="text-slate-900 font-semibold">16 May 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Terbayar</span>
                        <span class="text-slate-900 font-semibold">Rp 0</span>
                    </div>
                </div>

                <div class="bg-slate-50 p-3 rounded mb-4">
                    <p class="text-xs text-slate-600 mb-1">TOTAL</p>
                    <p class="text-2xl font-bold text-slate-900">Rp 750,000</p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('invoices.show', 4) }}" class="flex-1 px-3 py-2 bg-blue-500 text-white text-center rounded text-sm hover:bg-blue-600 transition">
                        Detail
                    </a>
                    <button class="flex-1 px-3 py-2 bg-green-500 text-white rounded text-sm hover:bg-green-600 transition">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        PDF
                    </button>
                </div>
            </div>

            <!-- Invoice Card 5 - Lunas -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-6 border-l-4 border-green-500">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">INV-2026-0005</h3>
                        <p class="text-sm text-slate-600 mt-1">CV Ekspor Makmur</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Lunas
                    </span>
                </div>

                <div class="space-y-2 mb-4 pb-4 border-b border-slate-200 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-600">Tanggal</span>
                        <span class="text-slate-900 font-semibold">01 May 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Jatuh Tempo</span>
                        <span class="text-slate-900 font-semibold">15 May 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Terbayar</span>
                        <span class="text-green-600 font-semibold">Rp 3,200,000</span>
                    </div>
                </div>

                <div class="bg-slate-50 p-3 rounded mb-4">
                    <p class="text-xs text-slate-600 mb-1">TOTAL</p>
                    <p class="text-2xl font-bold text-slate-900">Rp 3,200,000</p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('invoices.show', 5) }}" class="flex-1 px-3 py-2 bg-blue-500 text-white text-center rounded text-sm hover:bg-blue-600 transition">
                        Detail
                    </a>
                    <button class="flex-1 px-3 py-2 bg-green-500 text-white rounded text-sm hover:bg-green-600 transition">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        PDF
                    </button>
                </div>
            </div>
        </div>

        <!-- Load More -->
        <div class="mt-12 text-center">
            <button class="px-8 py-3 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition font-semibold">
                Tampilkan Lebih Banyak
            </button>
        </div>
    </div>
</div>
@endsection
