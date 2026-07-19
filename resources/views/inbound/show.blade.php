@extends('layouts.app')

@section('title', 'Detail Inbound')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Inbound</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Detail Barang Masuk</h1>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('inbound.edit', $inbound) }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232a2.062 2.062 0 0 1 2.916 2.916L7.75 18.646a.75.75 0 0 1-.338.197l-4 1a.75.75 0 0 1-.928-.928l1-4a.75.75 0 0 1 .197-.338l10.75-10.75Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 5l3 3" />
                    </svg>
                    Edit
                </a>
                <a href="{{ route('inbound.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-5 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        @php
            $shipment = $inbound->shipment;
            $badge = \App\Models\Shipment::statusStyles()[$shipment->shipment_status] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-800'];
        @endphp

        <div class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">
            <div class="space-y-6">
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
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

                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-5 border-b border-slate-200 pb-4">
                        <h2 class="text-base font-bold text-slate-950">Informasi Pengiriman</h2>
                        <p class="mt-1 text-sm text-slate-500">Detail pengirim, penerima, dan data utama pengiriman.</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Pengirim</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->sender_name }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ $shipment->pickup_address }}</p>
                            <p class="mt-2 text-sm text-slate-500">
                                {{ collect([
                                    $shipment->pickup_village,
                                    $shipment->pickup_district,
                                    $shipment->pickup_city,
                                    $shipment->pickup_province
                                ])->filter()->implode(', ') }}
                            </p>
                            @if($shipment->pickup_postal_code)
                                <p class="mt-2 text-sm text-slate-500">Kode Pos: {{ $shipment->pickup_postal_code }}</p>
                            @endif
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Penerima</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->receiver_name }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ $shipment->destination_address }}</p>
                            <p class="mt-2 text-sm text-slate-500">
                                {{ collect([
                                    $shipment->destination_village,
                                    $shipment->destination_district,
                                    $shipment->destination_city,
                                    $shipment->destination_province
                                ])->filter()->implode(', ') }}
                            </p>
                            @if($shipment->destination_postal_code)
                                <p class="mt-2 text-sm text-slate-500">Kode Pos: {{ $shipment->destination_postal_code }}</p>
                            @endif
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Tipe Barang</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->item_type }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Tanggal Inbound</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $inbound->inbound_date->format('d M Y') }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Transportasi</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ ucfirst($shipment->transportation_type) }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Pickup Date</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->pickup_date->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-5 border-b border-slate-200 pb-4">
                        <h2 class="text-base font-bold text-slate-950">Daftar Barang</h2>
                        <p class="mt-1 text-sm text-slate-500">Rincian item yang diterima pada inbound ini.</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[900px] text-sm">
                            <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                                <tr>
                                    <th class="px-4 py-3 text-left">Nama Barang</th>
                                    <th class="px-4 py-3 text-center">Qty</th>
                                    <th class="px-4 py-3 text-center">Packaging</th>
                                    <th class="px-4 py-3 text-center">Total Packaging</th>
                                    <th class="px-4 py-3 text-right">Berat (kg)</th>
                                    <th class="px-4 py-3 text-right">Harga / Unit</th>
                                    <th class="px-4 py-3 text-left">Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach($inbound->items as $item)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-4 py-4 text-slate-700">{{ $item->item_name }}</td>
                                    <td class="px-4 py-4 text-center text-slate-700">{{ $item->qty }}</td>
                                    <td class="px-4 py-4 text-center text-slate-700">{{ $item->packaging_type }}</td>
                                    <td class="px-4 py-4 text-center text-slate-700">{{ $item->total_packaging }}</td>
                                    <td class="px-4 py-4 text-right text-slate-700">{{ number_format($item->weight, 2, ',', '.') }}</td>
                                    <td class="px-4 py-4 text-right text-slate-700">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-4 text-slate-700">{{ $item->item_notes ?: '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-bold text-slate-950">Ringkasan Pengiriman</h2>
                    <div class="mt-4 space-y-3 text-sm text-slate-700">
                        <div class="flex justify-between gap-4">
                            <span>Total Qty</span>
                            <strong>{{ $inbound->total_qty }}</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Total Package</span>
                            <strong>{{ $inbound->total_package }}</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Total Berat</span>
                            <strong>{{ number_format($inbound->total_weight, 2, ',', '.') }} kg</strong>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-bold text-slate-950">Catatan Pengiriman</h2>
                    <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $inbound->notes ?: 'Tidak ada catatan tambahan.' }}</p>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection