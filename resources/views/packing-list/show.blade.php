@extends('layouts.app')

@section('title', 'Detail Packing List')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Detail Packing List</h1>
                <p class="text-slate-600">Ringkasan isi barang pengiriman, status, dan detail verifikasi.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('packing-list.print-pdf', $packingList) }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3M6 9h12v8H6V9zm3 7h6" />
                    </svg>
                    Print PDF
                </a>
                <a href="{{ route('packing-list.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900">
            {{ session('success') }}
        </div>
        @endif

        @php
            $shipment = $packingList->shipment;
            $badge = \App\Models\Shipment::statusStyles()[$shipment->shipment_status] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-800'];
        @endphp

        <div class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">
            <div class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Invoice</p>
                            <p class="text-xl font-semibold text-slate-900">{{ $shipment->invoice_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">No Resi</p>
                            <p class="text-xl font-semibold text-slate-900">{{ $shipment->receipt_number }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold {{ $badge['bg'] }} {{ $badge['text'] }}">{{ $shipment->shipment_status }}</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Informasi pengiriman</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Pengirim</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->sender_name }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ $shipment->pickup_address }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Penerima</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->receiver_name }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ $shipment->destination_city }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Tipe Barang</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->item_type }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Tanggal Packing</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $packingList->packing_date->format('d M Y') }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Transportasi</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ ucfirst($shipment->transportation_type) }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Pickup Date</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->pickup_date->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Daftar Barang</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-100 border-b border-slate-300 text-slate-700">
                                <tr>
                                    <th class="px-4 py-3 text-left">Nama Barang</th>
                                    <th class="px-4 py-3 text-center">Qty</th>
                                    <th class="px-4 py-3 text-center">Packaging</th>
                                    <th class="px-4 py-3 text-center">Total Packaging</th>
                                    <th class="px-4 py-3 text-right">Berat (kg)</th>
                                    <th class="px-4 py-3 text-right">Harga / Unit</th>
                                    <th class="px-4 py-3 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach($packingList->items as $item)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-4 py-4 text-slate-700">{{ $item->item_name }}</td>
                                    <td class="px-4 py-4 text-center text-slate-700">{{ $item->qty }}</td>
                                    <td class="px-4 py-4 text-center text-slate-700">{{ $item->packaging_type }}</td>
                                    <td class="px-4 py-4 text-center text-slate-700">{{ $item->total_packaging }}</td>
                                    <td class="px-4 py-4 text-right text-slate-700">{{ number_format($item->weight, 2, ',', '.') }}</td>
                                    <td class="px-4 py-4 text-right text-slate-700">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-4 text-right text-slate-900 font-semibold">Rp {{ number_format($item->subtotal_price, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Ringkasan Packing</h2>
                    <div class="space-y-4 text-slate-700">
                        <div class="flex justify-between gap-4">
                            <span>Total Qty</span>
                            <strong>{{ $packingList->total_qty }}</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Total Package</span>
                            <strong>{{ $packingList->total_package }}</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Total Berat</span>
                            <strong>{{ number_format($packingList->total_weight, 2, ',', '.') }} kg</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Total Value</span>
                            <strong>Rp {{ number_format($packingList->total_value, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Catatan Packing</h2>
                    <p class="text-slate-600 text-sm leading-relaxed">{{ $packingList->notes ?: 'Tidak ada catatan tambahan.' }}</p>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection