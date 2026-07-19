@extends('layouts.app')

@section('title', 'Detail Outbound')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Outbound</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Detail Barang Keluar</h1>
            </div>
            <a href="{{ route('warehouse.outbound.index') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-200">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        @if(session('success'))
        <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm xl:col-span-2">
                <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Informasi Keluar Barang</h2>
                        <p class="mt-1 text-sm text-slate-500">Detail pengiriman dan status terkini.</p>
                    </div>
                    <span class="inline-flex items-center rounded-full px-3.5 py-1.5 text-sm font-semibold {{ $outbound->statusBadge() }}">{{ $outbound->status }}</span>
                </div>

                <div class="grid gap-4 lg:grid-cols-2">
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-700">Tanggal Outbound</p>
                        <p class="mt-2 text-base font-semibold text-slate-900">{{ $outbound->outbound_date->format('d M Y') }}</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-700">Metode Pengiriman</p>
                        <p class="mt-2 text-base font-semibold text-slate-900">{{ $outbound->shipping_method }}</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-700">Driver</p>
                        <p class="mt-2 text-base font-semibold text-slate-900">{{ $outbound->driver?->name ?? 'N/A' }}</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-700">Kendaraan</p>
                        <p class="mt-2 text-base font-semibold text-slate-900">{{ $outbound->vehicle?->name ?? 'N/A' }}</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 lg:col-span-2">
                        <p class="text-sm font-semibold text-slate-700">Catatan</p>
                        <p class="mt-2 text-base font-semibold text-slate-900">{{ $outbound->delivery_notes ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-6 rounded-lg border border-slate-200 bg-slate-50 p-4">
                    <h3 class="mb-4 text-base font-semibold text-slate-950">Timeline Status</h3>
                    <div class="space-y-4">
                        @foreach(App\Models\Outbound::statuses() as $status)
                        <div class="flex items-start gap-3">
                            <div class="mt-1.5 flex h-3 w-3 shrink-0 items-center justify-center rounded-full {{ $outbound->status === $status ? 'bg-slate-900' : 'border border-slate-300 bg-white' }}"></div>
                            <div>
                                <p class="font-semibold text-slate-900">{{ $status }}</p>
                                <p class="text-sm text-slate-500">{{ $status === App\Models\Outbound::STATUS_READY_TO_SHIP ? 'Outbound dipersiapkan.' : ($status === App\Models\Outbound::STATUS_IN_TRANSIT ? 'Barang sedang dikirim.' : 'Barang telah sampai tujuan.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="mb-4 text-base font-bold text-slate-950">Informasi Pengiriman</h2>
                    <div class="space-y-3 text-sm text-slate-700">
                        <div><span class="font-semibold">No Resi:</span> {{ optional(optional($outbound->packingList)->shipment)->receipt_number }}</div>
                        <div><span class="font-semibold">Invoice:</span> {{ optional(optional($outbound->packingList)->shipment)->invoice_number }}</div>
                        <div><span class="font-semibold">Customer:</span> {{ optional(optional($outbound->packingList)->shipment)->receiver_name }}</div>
                        <div><span class="font-semibold">Alamat Tujuan:</span> {{ optional(optional($outbound->packingList)->shipment)->destination_address }}, {{ optional(optional($outbound->packingList)->shipment)->destination_city }}, {{ optional(optional($outbound->packingList)->shipment)->destination_province }}</div>
                    </div>
                </div>

                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="mb-4 text-base font-bold text-slate-950">Ringkasan Packing List</h2>
                    <div class="space-y-3 text-sm text-slate-700">
                        <div><span class="font-semibold">Total Qty:</span> {{ optional($outbound->packingList)->total_qty }}</div>
                        <div><span class="font-semibold">Total Berat:</span> {{ number_format(optional($outbound->packingList)->total_weight ?? 0, 2, ',', '.') }} kg</div>
                        <div><span class="font-semibold">Total Paket:</span> {{ optional($outbound->packingList)->total_package }}</div>
                        <div><span class="font-semibold">Packing Date:</span> {{ optional(optional($outbound->packingList)->packing_date)->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-4 py-4 sm:px-5">
                <h2 class="text-base font-bold text-slate-950">Daftar Barang</h2>
                <p class="mt-1 text-sm text-slate-500">Data barang yang keluar berdasarkan packing list.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] border-collapse text-left text-sm">
                    <thead class="bg-slate-100 text-slate-600">
                        <tr>
                            <th class="px-4 py-3">Nama Barang</th>
                            <th class="px-4 py-3">Qty</th>
                            <th class="px-4 py-3">Berat</th>
                            <th class="px-4 py-3">Paket</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach(optional($outbound->packingList)->items ?? [] as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-4 text-slate-700">{{ $item->item_name }}</td>
                            <td class="px-4 py-4 text-slate-700">{{ $item->qty }}</td>
                            <td class="px-4 py-4 text-slate-700">{{ number_format($item->weight, 2, ',', '.') }} kg</td>
                            <td class="px-4 py-4 text-slate-700">{{ $item->total_packaging }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
