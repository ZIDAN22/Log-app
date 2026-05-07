@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Detail Pengiriman</h1>
                <p class="text-slate-600">Informasi lengkap shipment dan timeline status.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('pengiriman.edit', $shipment) }}" class="inline-flex items-center justify-center rounded-xl bg-amber-100 px-5 py-3 text-sm font-semibold text-amber-800 hover:bg-amber-200">Edit</a>
                <a href="{{ route('pengiriman.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Kembali</a>
            </div>
        </div>

        @php
            $badge = \App\Models\Shipment::statusStyles()[$shipment->shipment_status] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-800'];
            function formatRp($value) { return 'Rp ' . number_format($value, 0, ',', '.'); }
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
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Rincian Shipment</h2>
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
                            <p class="text-sm text-slate-500">Transportasi</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ ucfirst($shipment->transportation_type) }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Berat</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ number_format($shipment->total_weight, 2, ',', '.') }} KG</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Pickup Date</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->pickup_date->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Biaya Pengiriman</h2>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Subtotal</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ formatRp($shipment->subtotal) }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">PPN (1.1%)</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ formatRp($shipment->ppn) }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">PPH (2%)</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ formatRp($shipment->pph) }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Grand Total</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ formatRp($shipment->grand_total) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Ringkasan</h2>
                    <dl class="space-y-4 text-sm text-slate-600">
                        <div class="flex justify-between gap-3">
                            <dt>Invoice</dt>
                            <dd class="font-semibold text-slate-900">{{ $shipment->invoice_number }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt>No Resi</dt>
                            <dd class="font-semibold text-slate-900">{{ $shipment->receipt_number }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt>Status</dt>
                            <dd class="font-semibold text-slate-900">{{ $shipment->shipment_status }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt>Dibuat</dt>
                            <dd class="font-semibold text-slate-900">{{ $shipment->created_at->format('d M Y') }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Timeline Status</h2>
                    <ol class="space-y-4">
                        @foreach(\App\Models\Shipment::STATUSES as $status)
                            <li class="rounded-3xl border px-4 py-4 {{ $shipment->shipment_status === $status ? 'border-blue-300 bg-blue-50' : 'border-slate-200 bg-slate-50' }}">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="font-medium text-slate-900">{{ $status }}</p>
                                    @if($shipment->shipment_status === $status)
                                        <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">Current</span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
