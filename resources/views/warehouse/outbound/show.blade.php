@extends('layouts.app')

@section('title', 'Detail Outbound')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-[1800px]">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Detail Outbound</h1>
                <p class="mt-2 text-slate-600">Lihat informasi shipment, packing list, dan status pengiriman.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('warehouse.outbound.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Kembali ke Outbound</a>
                <a href="{{ route('warehouse.outbound.print-pdf', $outbound) }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Cetak Surat Jalan</a>
                <a href="{{ route('warehouse.outbound.edit', $outbound) }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-100 px-5 py-3 text-sm font-semibold text-amber-700 transition hover:bg-amber-200">Edit Outbound</a>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="grid gap-6 xl:grid-cols-3">
            <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm xl:col-span-2">
                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Informasi Outbound</h2>
                        <p class="mt-1 text-sm text-slate-500">Detail pengiriman outbound dan status terkini.</p>
                    </div>
                    <span class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold {{ $outbound->statusBadge() }}">{{ $outbound->status }}</span>
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">No Outbound</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">OB-{{ str_pad($outbound->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Tanggal Outbound</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $outbound->outbound_date->format('d M Y') }}</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Metode Pengiriman</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $outbound->shipping_method }}</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Driver</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $outbound->driver?->name ?? 'N/A' }}</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Kendaraan</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $outbound->vehicle?->name ?? 'N/A' }}</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Catatan</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $outbound->delivery_notes ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-8 rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h3 class="mb-4 text-lg font-semibold text-slate-900">Timeline Status</h3>
                    <div class="space-y-4">
                        @foreach(App\Models\Outbound::statuses() as $status)
                        <div class="flex items-start gap-4">
                            <div class="mt-1 flex h-3 w-3 items-center justify-center rounded-full {{ $outbound->status === $status ? 'bg-slate-900' : 'border border-slate-300 bg-white' }}"></div>
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
                <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-xl font-bold text-slate-900">Informasi Shipment</h2>
                    <div class="space-y-4 text-sm text-slate-700">
                        <div><span class="font-semibold">No Resi:</span> {{ $outbound->packingList->shipment->receipt_number }}</div>
                        <div><span class="font-semibold">Invoice:</span> {{ $outbound->packingList->shipment->invoice_number }}</div>
                        <div><span class="font-semibold">Customer:</span> {{ $outbound->packingList->shipment->receiver_name }}</div>
                        <div><span class="font-semibold">Alamat Tujuan:</span> {{ $outbound->packingList->shipment->destination_address }}, {{ $outbound->packingList->shipment->destination_city }}, {{ $outbound->packingList->shipment->destination_province }}</div>
                    </div>
                </div>

                <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-xl font-bold text-slate-900">Ringkasan Packing List</h2>
                    <div class="space-y-4 text-sm text-slate-700">
                        <div><span class="font-semibold">Total Qty:</span> {{ $outbound->packingList->total_qty }}</div>
                        <div><span class="font-semibold">Total Berat:</span> {{ number_format($outbound->packingList->total_weight, 2, ',', '.') }} kg</div>
                        <div><span class="font-semibold">Total Paket:</span> {{ $outbound->packingList->total_package }}</div>
                        <div><span class="font-semibold">Packing Date:</span> {{ $outbound->packingList->packing_date->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-xl font-bold text-slate-900">Daftar Barang</h2>
                <p class="mt-1 text-sm text-slate-500">Data barang yang keluar berdasarkan packing list.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] border-collapse text-left text-sm">
                    <thead class="bg-slate-100 text-slate-600">
                        <tr>
                            <th class="px-6 py-4">Nama Barang</th>
                            <th class="px-6 py-4">Qty</th>
                            <th class="px-6 py-4">Berat</th>
                            <th class="px-6 py-4">Paket</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach($outbound->packingList->items as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-700">{{ $item->item_name }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ $item->qty }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ number_format($item->weight, 2, ',', '.') }} kg</td>
                            <td class="px-6 py-4 text-slate-700">{{ $item->total_packaging }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-xl font-bold text-slate-900">Update Status</h2>
            <form method="POST" action="{{ route('warehouse.outbound.update-status', $outbound) }}" class="space-y-5">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Pilih Status Baru</label>
                    <select name="status" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                        @foreach(App\Models\Outbound::statuses() as $status)
                        <option value="{{ $status }}" @selected($outbound->status === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Perbarui Status</button>
            </form>
        </div>
    </div>
</div>
@endsection
