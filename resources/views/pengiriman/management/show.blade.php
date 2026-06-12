@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
<section class="rounded-none bg-white p-6 shadow-sm border border-slate-200">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('delivery-management.index') }}" class="hover:text-slate-700">Manajemen Pengiriman</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-semibold text-slate-900">{{ $deliveryManagement->delivery_number }}</span>
                </div>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Detail Pengiriman</h1>
                <p class="mt-2 text-sm text-slate-500">Kelola status, upload POD, dan cetak dokumen pengiriman.</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('delivery-management.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                @if(in_array($deliveryManagement->delivery_status, ['in_transit', 'arrived_destination', 'delivered'], true))
                <button type="button" data-action="open-modal" data-target="podUploadModal" class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Upload POD
                </button>
                @endif
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <div class="grid gap-6 xl:grid-cols-[2fr_1fr]">
        <!-- Left Column -->
        <div class="space-y-6">
            <!-- Section 1: Shipment Information -->
            <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                <h2 class="text-lg font-semibold text-slate-900">Informasi Shipment</h2>
                <div class="mt-6 grid gap-6 sm:grid-cols-2">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">No Resi</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ $deliveryManagement->shipment->receipt_number ?? '-' }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Customer</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ substr($deliveryManagement->shipment->sender_name ?? '', 0, 25) }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Pengirim</p>
                        <p class="mt-3 text-sm font-semibold text-slate-900">{{ $deliveryManagement->shipment->sender_name ?? '-' }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ substr($deliveryManagement->shipment->sender_address ?? '', 0, 40) }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Penerima</p>
                        <p class="mt-3 text-sm font-semibold text-slate-900">{{ $deliveryManagement->shipment->receiver_name ?? '-' }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ substr($deliveryManagement->shipment->receiver_address ?? '', 0, 40) }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Kota Tujuan</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ $deliveryManagement->outbound->destination_city ?? $deliveryManagement->shipment->destination_city ?? '-' }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Tanggal Shipment</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ $deliveryManagement->shipment->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </section>

            <!-- Section 2: Outbound Information -->
            <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                <h2 class="text-lg font-semibold text-slate-900">Informasi Barang Keluar</h2>
                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Total Qty</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ number_format(optional($deliveryManagement->outbound->packingList)->total_qty ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Total Berat</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ number_format(optional($deliveryManagement->outbound->packingList)->total_weight ?? 0, 2, ',', '.') }} kg</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Total Paket</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ number_format(optional($deliveryManagement->outbound->packingList)->total_package ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </section>

            <!-- Section 3: Informasi Pengiriman -->
            <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                <h2 class="text-lg font-semibold text-slate-900">Informasi Pengiriman</h2>
                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Metode Pengiriman</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ $deliveryManagement->delivery_method }}</p>
                    </div>

                    @if($deliveryManagement->delivery_method === 'DARAT')
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Driver</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ $deliveryManagement->driver->name ?? '-' }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Kendaraan</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ $deliveryManagement->vehicle->name ?? '-' }}</p>
                    </div>
                    @elseif($deliveryManagement->delivery_method === 'LAUT')
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Vendor Transportasi</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ $deliveryManagement->outbound->shipping_vendor ?? '-' }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Nama Kapal / Ekspedisi</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ $deliveryManagement->outbound->vessel_name ?? '-' }}</p>
                    </div>
                    @elseif($deliveryManagement->delivery_method === 'UDARA')
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Maskapai</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ $deliveryManagement->shipment->air_shipping ?? '-' }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Tanggal Keberangkatan</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ $deliveryManagement->shipment->air_departure_date ? $deliveryManagement->shipment->air_departure_date->format('d M Y') : '-' }}</p>
                    </div>
                    @endif

                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">ETA</p>
                        <p class="mt-3 text-lg font-semibold text-slate-900">{{ optional($deliveryManagement->estimatedEta)->format('d M Y') ?? '-' }}</p>
                    </div>
                </div>
            </section>

            <!-- Section 4: Timeline Status -->
            <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                <h2 class="text-lg font-semibold text-slate-900">Timeline Status</h2>
                <div class="mt-6 space-y-4">
                    @php
                    $displayStatus = match ($deliveryManagement->delivery_status) {
                        'picked_up' => 'in_transit',
                        'arrived_destination' => 'delivered',
                        'completed' => 'delivered',
                        default => $deliveryManagement->delivery_status,
                    };

                    $timeline = [
                        ['ready_to_ship', 'Siap Dikirim', $deliveryManagement->created_at],
                        ['in_transit', 'Dalam Perjalanan', null],
                        ['delivered', 'Delivered', $deliveryManagement->delivered_at],
                    ];

                    $order = array_column($timeline, 0);
                    $currentIndex = array_search($displayStatus, $order, true);
                    @endphp

                    @foreach($timeline as $status)
                        @php
                        [$key, $label, $date] = $status;
                        $keyIndex = array_search($key, $order, true);

                        $isPassed = $keyIndex !== false && $currentIndex !== false && $keyIndex <= $currentIndex;
                        $isActive = $key === $deliveryManagement->delivery_status;
                        @endphp
                        <div class="relative flex gap-4 pb-4">
                            @if(!$loop->last)
                            <div class="absolute left-[11px] top-8 h-6 w-px @if($isPassed) bg-slate-900 @else bg-slate-200 @endif"></div>
                            @endif
                            <div class="relative flex-shrink-0">
                                <div class="@if($isPassed) bg-slate-900 @else bg-slate-200 @endif h-6 w-6 rounded-full flex items-center justify-center">
                                    @if($isPassed)
                                    <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold @if($isPassed) text-slate-900 @else text-slate-500 @endif">{{ $label }}</p>
                                @if($date)
                                <p class="text-sm text-slate-500">{{ $date->format('d M Y · H:i') }}</p>
                                @else
                                <p class="text-sm text-slate-400">Pending</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($deliveryManagement->delivery_status !== 'completed')
                <form method="POST" action="{{ route('delivery-management.update-status', $deliveryManagement) }}" class="mt-6 border-t border-slate-200 pt-6">
                    @csrf
                    <label class="block">
                        <span class="text-sm font-medium text-slate-700">Update Status Pengiriman</span>
                        <select name="delivery_status" required class="mt-3 w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                            <option value="">Pilih status baru</option>
                            <option value="ready_to_ship" @if('ready_to_ship' === $displayStatus) selected @endif>Ready to Ship</option>
                            <option value="in_transit" @if('in_transit' === $displayStatus) selected @endif>In Transit</option>
                            <option value="delivered" @if('delivered' === $displayStatus) selected @endif>Delivered</option>
                        </select>
                    </label>
                    <button type="submit" class="mt-4 w-full rounded-3xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                        Update Status
                    </button>
                </form>
                @endif
            </section>
        </div>

        <!-- Right Column -->
        <aside class="space-y-6">
            <!-- Status Overview -->
            <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                <h2 class="text-lg font-semibold text-slate-900">Status Pengiriman</h2>
                <div class="mt-6 space-y-4">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Delivery Status</p>
                        <div class="mt-3">
                            <span class="inline-flex items-center rounded-full px-3 py-1.5 text-sm font-semibold {{ $deliveryManagement->statusBadge() }}">
                                {{ $deliveryManagement->statusLabel() }}
                            </span>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">POD Status</p>
                        <div class="mt-3">
                            <span class="inline-flex items-center rounded-full px-3 py-1.5 text-sm font-semibold {{ $deliveryManagement->podBadge() }}">
                                {{ $deliveryManagement->podLabel() }}
                            </span>
                        </div>
                    </div>
                </div>
            </section>

        </aside>
    </div>
</div>

<!-- POD Upload Modal -->
<div id="podUploadModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4 py-6 sm:px-6">
    <div class="relative w-full max-w-2xl overflow-hidden rounded-[32px] bg-white shadow-2xl">
        <div class="flex flex-col gap-4 border-b border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Upload POD</p>
                <h3 class="mt-2 text-2xl font-semibold text-slate-900">Bukti Penerimaan</h3>
            </div>
            <button type="button" data-action="close-modal" data-target="podUploadModal" class="inline-flex h-10 items-center justify-center rounded-2xl bg-slate-900 px-5 text-sm font-semibold text-white transition hover:bg-slate-800">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('delivery-management.upload-pod', $deliveryManagement) }}" enctype="multipart/form-data" class="space-y-6 p-6">
            @csrf

            <div class="space-y-4">
                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Nama Penerima</span>
                    <input type="text" name="receiver_name" required placeholder="Nama lengkap penerima" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100" />
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Foto Bukti Penerimaan</span>
                    <div class="mt-2 rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-4 py-8 text-center">
                        <input type="file" name="receiver_photo" accept="image/*" class="w-full" />
                        <p class="mt-2 text-xs text-slate-500">Upload bukti penerimaan barang, baik dokumen maupun foto penerima. Max 5MB.</p>
                    </div>
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Catatan Penerimaan</span>
                    <textarea name="delivery_notes" rows="4" placeholder="Catatan khusus tentang penerimaan barang..." class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100"></textarea>
                </label>
            </div>

            <div class="border-t border-slate-200 pt-6 flex gap-3">
                <button type="button" data-action="close-modal" data-target="podUploadModal" class="flex-1 rounded-3xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</button>
                <button type="submit" class="flex-1 rounded-3xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Upload POD</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (['#uploadPOD', '#podUploadModal'].includes(location.hash)) {
            const modal = document.getElementById('podUploadModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }
    });

    document.addEventListener('click', function(event) {
        const modalOpen = event.target.closest('[data-action="open-modal"]');
        const modalClose = event.target.closest('[data-action="close-modal"]');

        if (modalOpen) {
            event.preventDefault();
            const targetId = modalOpen.getAttribute('data-target');
            const modal = document.getElementById(targetId);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        if (modalClose) {
            event.preventDefault();
            const targetId = modalClose.getAttribute('data-target');
            const modal = document.getElementById(targetId);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }
    });
</script>
@endsection
