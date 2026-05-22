@extends('layouts.app')

@section('title', 'Detail Inbound')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-slate-900">
                    <svg class="h-6 w-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4v11a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18" />
                    </svg>
                    <h1 class="text-3xl font-bold text-slate-900">Detail Inbound</h1>
                </div>
                <p class="text-slate-600">Ringkasan penerimaan barang shipment.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('inbound.edit', $inbound) }}" class="inline-flex items-center justify-center rounded-xl bg-amber-100 px-5 py-3 text-sm font-semibold text-amber-800 hover:bg-amber-200 transition">Edit</a>
                <a href="{{ route('inbound.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">Kembali</a>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900">
            {{ session('success') }}
        </div>
        @endif

        @php
            $shipment = $inbound->shipment;
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
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Informasi Shipment</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
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
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
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
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Tipe Barang</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->item_type }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Tanggal Inbound</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $inbound->inbound_date->format('d M Y') }}</p>
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
                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Ringkasan Inbound</h2>
                    <div class="space-y-4 text-slate-700">
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

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Catatan Inbound</h2>
                    <p class="text-slate-600 text-sm leading-relaxed">{{ $inbound->notes ?: 'Tidak ada catatan tambahan.' }}</p>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection