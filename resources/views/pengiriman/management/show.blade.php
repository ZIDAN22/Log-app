@extends('layouts.app')

@section('title', 'Detail Pengiriman')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase text-slate-500">Manajemen Pengiriman</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Detail Pengiriman</h1>
                <p class="mt-1 text-sm text-slate-500">Kelola status, upload POD, dan cetak dokumen pengiriman.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('delivery-management.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                @if(in_array($deliveryManagement->delivery_status, ['in_transit', 'arrived_destination', 'delivered'], true))
                <button type="button" data-action="open-modal" data-target="podUploadModal" class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Upload POD
                </button>
                @endif
            </div>
        </div>

        @if(session('success'))
        <div class="mb-5 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-[2fr_1fr]">
            <div class="space-y-6">
                <!-- Section 1: Shipment Information -->
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-5 border-b border-slate-200 pb-4">
                        <h2 class="text-base font-bold text-slate-950">Informasi Shipment</h2>
                        <p class="mt-1 text-sm text-slate-500">Detail nomor resi dan data pengiriman utama.</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">No Resi</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->shipment->receipt_number ?? '-' }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Customer</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ substr($deliveryManagement->shipment->sender_name ?? '', 0, 25) }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Pengirim</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->shipment->sender_name ?? '-' }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ substr($deliveryManagement->shipment->sender_address ?? '', 0, 40) }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Penerima</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->shipment->receiver_name ?? '-' }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ substr($deliveryManagement->shipment->receiver_address ?? '', 0, 40) }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Kota Tujuan</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->outbound->destination_city ?? $deliveryManagement->shipment->destination_city ?? '-' }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Tanggal Shipment</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->shipment->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Outbound Information -->
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-5 border-b border-slate-200 pb-4">
                        <h2 class="text-base font-bold text-slate-950">Informasi Barang Keluar</h2>
                        <p class="mt-1 text-sm text-slate-500">Rincian jumlah dan berat barang yang dikirim.</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-3">
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Total Qty</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ number_format(optional($deliveryManagement->outbound->packingList)->total_qty ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Total Berat</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ number_format(optional($deliveryManagement->outbound->packingList)->total_weight ?? 0, 2, ',', '.') }} kg</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Total Paket</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ number_format(optional($deliveryManagement->outbound->packingList)->total_package ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Informasi Pengiriman -->
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-5 border-b border-slate-200 pb-4">
                        <h2 class="text-base font-bold text-slate-950">Informasi Pengiriman</h2>
                        <p class="mt-1 text-sm text-slate-500">Detail metode pengiriman, driver, dan kendaraan.</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-3">
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Metode Pengiriman</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->delivery_method }}</p>
                        </div>

                        @if($deliveryManagement->delivery_method === 'DARAT')
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Driver</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->driver->name ?? '-' }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Kendaraan</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->vehicle->name ?? '-' }}</p>
                        </div>
                        @elseif($deliveryManagement->delivery_method === 'LAUT')
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Vendor Transportasi</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->outbound->shipping_vendor ?? '-' }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Nama Kapal / Ekspedisi</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->outbound->vessel_name ?? '-' }}</p>
                        </div>
                        @elseif($deliveryManagement->delivery_method === 'UDARA')
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Maskapai</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->shipment->air_shipping ?? '-' }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Tanggal Keberangkatan</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $deliveryManagement->shipment->air_departure_date ? $deliveryManagement->shipment->air_departure_date->format('d M Y') : '-' }}</p>
                        </div>
                        @endif

                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">ETA</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ optional($deliveryManagement->estimatedEta)->format('d M Y') ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Timeline Status -->
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-5 border-b border-slate-200 pb-4">
                        <h2 class="text-base font-bold text-slate-950">Timeline Status</h2>
                        <p class="mt-1 text-sm text-slate-500">Riwayat status pengiriman terkini.</p>
                    </div>
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

                    <div class="space-y-0">
                        @foreach($timeline as $index => $status)
                            @php
                            [$key, $label, $date] = $status;
                            $keyIndex = array_search($key, $order, true);
                            $isPassed = $keyIndex !== false && $currentIndex !== false && $keyIndex <= $currentIndex;
                            $isActive = $key === $deliveryManagement->delivery_status;
                            @endphp
                            <div class="flex gap-6">
                                <!-- Kolom kiri: lingkaran nomor dan ceklis terpisah -->
                                <div class="flex items-start">
                                    <div class="flex items-center gap-2">
                                        <div class="h-9 w-9 rounded-full flex items-center justify-center shadow-sm flex-shrink-0 z-10 border @if($isPassed) bg-slate-900 text-white border-slate-900 @else bg-white text-slate-900 border-slate-200 @endif">
                                            <span class="text-sm font-bold">{{ $index + 1 }}</span>
                                        </div>

                                        <div class="h-6 w-6 flex items-center justify-center">
                                            @if($isPassed)
                                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            @else
                                            <div class="h-5 w-5"></div>
                                            @endif
                                        </div>
                                    </div>

                                    @if(!$loop->last)
                                    <div class="ml-0 mt-2 w-0.5 flex-1 @if($isPassed) bg-slate-900 @else bg-slate-200 @endif"></div>
                                    @endif
                                </div>

                                <!-- Kolom kanan: konten teks -->
                                <div class="pb-10 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <p class="font-semibold text-slate-900">{{ $label }}</p>
                                        @if($isActive)
                                        <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-700">Saat ini</span>
                                        @endif
                                        @if($isPassed)
                                        <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-semibold text-emerald-700">Selesai</span>
                                        @endif
                                    </div>
                                    @if($date)
                                    <p class="text-sm text-slate-500 mt-1">{{ $date->format('d M Y · H:i') }}</p>
                                    @else
                                    <p class="text-sm text-slate-400 mt-1">Menunggu</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($deliveryManagement->delivery_status !== 'completed')
                    <form method="POST" action="{{ route('delivery-management.update-status', $deliveryManagement) }}" class="mt-5 border-t border-slate-200 pt-5">
                        @csrf
                        <label class="block">
                            <span class="text-sm font-medium text-slate-700">Update Status Pengiriman</span>
                            <select name="delivery_status" required class="mt-3 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                                <option value="">Pilih status baru</option>
                                <option value="ready_to_ship" @if('ready_to_ship' === $displayStatus) selected @endif>Ready to Ship</option>
                                <option value="in_transit" @if('in_transit' === $displayStatus) selected @endif>In Transit</option>
                                <option value="delivered" @if('delivered' === $displayStatus) selected @endif>Delivered</option>
                            </select>
                        </label>
                        <button type="submit" class="mt-4 w-full rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                            Update Status
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-bold text-slate-950">Status Pengiriman</h2>
                    <div class="mt-4 space-y-4">
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Delivery Status</p>
                            <div class="mt-2">
                                <span class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold {{ $deliveryManagement->statusBadge() }}">
                                    {{ $deliveryManagement->statusLabel() }}
                                </span>
                            </div>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">POD Status</p>
                            <div class="mt-2">
                                <span class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold {{ $deliveryManagement->podBadge() }}">
                                    {{ $deliveryManagement->podLabel() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- POD Upload Modal -->
<div id="podUploadModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4 py-6">
    <div class="w-full max-w-2xl rounded-lg border border-slate-200 bg-white shadow-xl">
        <div class="flex items-start gap-3 border-b border-slate-200 p-5">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <h2 class="text-base font-bold text-slate-950">Upload POD</h2>
                <p class="mt-1 text-sm leading-6 text-slate-600">Upload bukti penerimaan barang dari penerima.</p>
            </div>
            <button type="button" data-action="close-modal" data-target="podUploadModal" class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('delivery-management.upload-pod', $deliveryManagement) }}" enctype="multipart/form-data" class="space-y-5 p-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700">Nama Penerima</label>
                <input type="text" name="receiver_name" required placeholder="Nama lengkap penerima" class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" />
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Foto Bukti Penerimaan</label>
                <div class="mt-2 rounded-lg border border-dashed border-slate-300 bg-slate-50 px-4 py-8 text-center">
                    <input type="file" name="receiver_photo" accept="image/*" class="w-full" />
                    <p class="mt-2 text-xs text-slate-500">Upload bukti penerimaan barang, baik dokumen maupun foto penerima. Max 5MB.</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Catatan Penerimaan</label>
                <textarea name="delivery_notes" rows="4" placeholder="Catatan khusus tentang penerimaan barang..." class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"></textarea>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
                <button type="button" data-action="close-modal" data-target="podUploadModal" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</button>
                <button type="submit" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-slate-900 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Upload POD
                </button>
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
