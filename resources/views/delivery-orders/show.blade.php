@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Detail Surat Jalan</h1>
                <p class="text-slate-600">{{ $deliveryOrder->delivery_order_number }}</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('delivery-orders.print-pdf', $deliveryOrder) }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3M6 9h12v8H6V9zm3 7h6" />
                    </svg>
                    Print PDF
                </a>
                <a href="{{ route('pengiriman.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Delivery Order Info -->
            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Informasi Surat Jalan</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-slate-500">No Surat Jalan</dt>
                        <dd class="text-sm text-slate-900">{{ $deliveryOrder->delivery_order_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Tanggal Order</dt>
                        <dd class="text-sm text-slate-900">{{ $deliveryOrder->order_date->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Transportasi</dt>
                        <dd class="text-sm text-slate-900">{{ ucfirst($deliveryOrder->transportation_type) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Dibuat Oleh</dt>
                        <dd class="text-sm text-slate-900">{{ $deliveryOrder->creator->name ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Dibuat Pada</dt>
                        <dd class="text-sm text-slate-900">{{ $deliveryOrder->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Shipment Info -->
            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Informasi Shipment</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-slate-500">No Invoice</dt>
                        <dd class="text-sm text-slate-900">{{ $deliveryOrder->shipment->invoice_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">No Resi</dt>
                        <dd class="text-sm text-slate-900">{{ $deliveryOrder->shipment->receipt_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Status</dt>
                        <dd class="text-sm">
                            @php
                                $style = \App\Models\Shipment::statusStyles()[$deliveryOrder->shipment->shipment_status] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-800'];
                            @endphp
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium {{ $style['bg'] }} {{ $style['text'] }}">
                                {{ $deliveryOrder->shipment->shipment_status }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Berat Total</dt>
                        <dd class="text-sm text-slate-900">{{ number_format($deliveryOrder->shipment->total_weight, 2) }} kg</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Grand Total</dt>
                        <dd class="text-sm text-slate-900">Rp {{ number_format($deliveryOrder->shipment->grand_total, 0, ',', '.') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Sender Info -->
            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Informasi Pengirim</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Nama</dt>
                        <dd class="text-sm text-slate-900">{{ $deliveryOrder->sender_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Alamat Pickup</dt>
                        <dd class="text-sm text-slate-900">{{ $deliveryOrder->pickup_address }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Receiver Info -->
            <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Informasi Penerima</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Nama</dt>
                        <dd class="text-sm text-slate-900">{{ $deliveryOrder->receiver_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Tujuan</dt>
                        <dd class="text-sm text-slate-900">{{ $deliveryOrder->destination_city }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        @if($deliveryOrder->notes)
            <div class="mt-6 bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Catatan</h3>
                <p class="text-sm text-slate-700">{{ $deliveryOrder->notes }}</p>
            </div>
        @endif
    </div>
</div>
@endsection