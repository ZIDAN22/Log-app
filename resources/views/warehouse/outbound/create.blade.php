@extends('layouts.app')

@section('title', 'Buat Outbound')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">
    <div class="mx-auto max-w-[1700px]">
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Buat Outbound</h1>
                <p class="mt-2 text-slate-600">Pilih packing list dan lengkapi detail pengiriman outbound.</p>
            </div>
            <a href="{{ route('warehouse.outbound.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                Kembali ke Outbound
            </a>
        </div>

        @if($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-800 shadow-sm">
            Silakan perbaiki data berikut.
        </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-12">
            <div class="xl:col-span-4">
                <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-xl font-bold text-slate-900">Pilih Packing List</h2>
                    <form method="GET" action="{{ route('warehouse.outbound.create') }}" id="packing-list-form">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Cari Packing List</label>
                        <input
                            id="packing-list-search"
                            type="text"
                            placeholder="Cari PL, No Resi, penerima, tujuan..."
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                        />

                        <div id="packing-list-cards" class="mt-4 grid gap-3 max-h-[420px] overflow-y-auto">
                            @foreach($packingLists as $packingList)
                            <button
                                type="button"
                                class="packing-list-card w-full rounded-[24px] border border-slate-200 bg-white p-4 text-left transition hover:border-blue-500 hover:bg-slate-50"
                                data-id="{{ $packingList->id }}"
                                data-search="{{ strtolower('PL-' . str_pad($packingList->id, 4, '0', STR_PAD_LEFT) . ' ' . $packingList->shipment->receipt_number . ' ' . $packingList->shipment->receiver_name . ' ' . $packingList->shipment->destination_city . ' ' . $packingList->shipment->destination_province) }}"
                            >
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">PL-{{ str_pad($packingList->id, 4, '0', STR_PAD_LEFT) }}</p>
                                        <p class="text-xs text-slate-500">No Resi: {{ $packingList->shipment->receipt_number }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-slate-900">{{ $packingList->shipment->receiver_name }}</p>
                                        <p class="text-xs text-slate-500">{{ $packingList->packing_date->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="mt-3 grid gap-2 sm:grid-cols-2 text-sm text-slate-600">
                                    <div>
                                        <p class="font-semibold text-slate-700">Tujuan</p>
                                        <p>{{ $packingList->shipment->destination_city }}, {{ $packingList->shipment->destination_province }}</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-700">Total Qty</p>
                                        <p>{{ $packingList->total_qty }}</p>
                                    </div>
                                </div>
                            </button>
                            @endforeach
                        </div>

                        <select name="packing_list_id" id="packing_list_id" class="hidden">
                            <option value="">Pilih packing list</option>
                            @foreach($packingLists as $packingList)
                            <option value="{{ $packingList->id }}" @selected(optional($selectedPackingList)->id === $packingList->id)>
                                PL-{{ str_pad($packingList->id, 4, '0', STR_PAD_LEFT) }} - {{ $packingList->shipment->receipt_number }}
                            </option>
                            @endforeach
                        </select>
                    </form>

                    @if(!$packingLists->count())
                    <div class="mt-6 rounded-3xl border border-slate-200 bg-slate-50 p-5 text-sm text-slate-600">
                        Tidak ada packing list tersedia. Pastikan inbound dan packing list sudah dibuat.
                    </div>
                    @endif
                </div>
            </div>

            <div class="xl:col-span-8">
                <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-xl font-bold text-slate-900">Detail Outbound</h2>

                    @if($selectedPackingList)
                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-700">No Resi</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $selectedPackingList->shipment->receipt_number }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-700">Customer</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $selectedPackingList->shipment->receiver_name }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-700">Tujuan</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $selectedPackingList->shipment->destination_city }}, {{ $selectedPackingList->shipment->destination_province }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-700">Tanggal Packing</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $selectedPackingList->packing_date->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200">
                        <div class="border-b border-slate-200 bg-slate-900 px-6 py-4 text-sm font-semibold text-white uppercase tracking-wider">Daftar Barang</div>
                        <div class="overflow-x-auto bg-white">
                            <table class="w-full min-w-[800px] text-left text-sm">
                                <thead class="bg-slate-100 text-slate-600">
                                    <tr>
                                        <th class="px-4 py-3">Nama Barang</th>
                                        <th class="px-4 py-3">Qty</th>
                                        <th class="px-4 py-3">Berat</th>
                                        <th class="px-4 py-3">Total Paket</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    @foreach($selectedPackingList->items as $item)
                                    <tr>
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

                    <div class="mt-6 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Total Qty</p>
                            <p class="mt-3 text-2xl font-semibold text-slate-900">{{ $selectedPackingList->total_qty }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Total Berat</p>
                            <p class="mt-3 text-2xl font-semibold text-slate-900">{{ number_format($selectedPackingList->total_weight, 2, ',', '.') }} kg</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Total Paket</p>
                            <p class="mt-3 text-2xl font-semibold text-slate-900">{{ $selectedPackingList->total_package }}</p>
                        </div>
                    </div>
                    @else
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-slate-500">
                        Pilih packing list terlebih dahulu untuk melihat data otomatis dan membuat outbound.
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @if($selectedPackingList)
        <form method="POST" action="{{ route('warehouse.outbound.store') }}" class="mt-8 rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            <input type="hidden" name="packing_list_id" value="{{ $selectedPackingList->id }}">

            <!-- Shipment transport fields -->
            <div class="mb-6 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <h3 class="mb-4 text-lg font-semibold text-slate-900">Informasi Transportasi</h3>

                @php
                    $defaultShippingMethod = old('shipping_method');
                    if (!$defaultShippingMethod && optional($selectedPackingList->shipment)->transportation_type) {
                        $map = [
                            'darat' => App\Models\Outbound::SHIPPING_METHOD_LAND,
                            'laut' => App\Models\Outbound::SHIPPING_METHOD_SEA,
                            'udara' => App\Models\Outbound::SHIPPING_METHOD_AIR,
                        ];
                        $defaultShippingMethod = $map[optional($selectedPackingList->shipment)->transportation_type] ?? App\Models\Outbound::SHIPPING_METHOD_LAND;
                    }
                    $defaultShippingMethod = $defaultShippingMethod ?? App\Models\Outbound::SHIPPING_METHOD_LAND;
                @endphp

                <div class="grid gap-4 lg:grid-cols-3">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Tipe Transportasi</label>
                        <select id="shipping-method" name="shipping_method" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900">
                            @foreach(App\Models\Outbound::shippingMethods() as $method)
                                <option value="{{ $method }}" @selected(old('shipping_method', $defaultShippingMethod) === $method)>{{ $method }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" id="shipment_transportation_type" name="shipment[transportation_type]" value="{{ old('shipment.transportation_type', optional($selectedPackingList->shipment)->transportation_type ?? 'darat') }}">

                    <div id="transport-detail-land" class="hidden">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Driver</label>
                        <select name="driver_id" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900">
                            <option value="">Pilih driver</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" @selected(old('driver_id', optional($selectedPackingList->shipment)->driver_id) == $driver->id)>{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="transport-detail-vehicle" class="hidden">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Kendaraan</label>
                        <select name="vehicle_id" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900">
                            <option value="">Pilih kendaraan</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" @selected(old('vehicle_id', optional($selectedPackingList->shipment)->vehicle_id) == $vehicle->id)>{{ $vehicle->name }} ({{ $vehicle->license_plate }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="transport-detail-land-extra" class="mt-6 hidden">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Keberangkatan Darat</label>
                    <input type="date" name="shipment[land_departure_date]" value="{{ old('shipment.land_departure_date', optional($selectedPackingList->shipment)->land_departure_date?->format('Y-m-d')) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900" />
                </div>

                <div id="transport-detail-sea" class="mt-6 hidden">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Pelayaran Laut</label>
                    <input type="text" name="shipment[sea_shipping]" value="{{ old('shipment.sea_shipping', optional($selectedPackingList->shipment)->sea_shipping) }}" placeholder="Nama kapal atau rute laut" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900" />
                    <div class="mt-4">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Keberangkatan Laut</label>
                        <input type="date" name="shipment[sea_departure_date]" value="{{ old('shipment.sea_departure_date', optional($selectedPackingList->shipment)->sea_departure_date?->format('Y-m-d')) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900" />
                    </div>
                </div>

                <div id="transport-detail-air" class="mt-6 hidden">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Pengiriman Udara</label>
                    <input type="text" name="shipment[air_shipping]" value="{{ old('shipment.air_shipping', optional($selectedPackingList->shipment)->air_shipping) }}" placeholder="Nama maskapai atau kode penerbangan" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900" />
                    <div class="mt-4">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Keberangkatan Udara</label>
                        <input type="date" name="shipment[air_departure_date]" value="{{ old('shipment.air_departure_date', optional($selectedPackingList->shipment)->air_departure_date?->format('Y-m-d')) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900" />
                    </div>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Outbound</label>
                    <input type="date" name="outbound_date" value="{{ old('outbound_date', now()->format('Y-m-d')) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                    @error('outbound_date')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Status Pengiriman</label>
                    <select name="status" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                        @foreach(App\Models\Outbound::statuses() as $status)
                        <option value="{{ $status }}" @selected(old('status', App\Models\Outbound::STATUS_READY_TO_SHIP) === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('status')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan Outbound</button>
                <a href="{{ route('warehouse.outbound.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Batal</a>
            </div>
        </form>
        @endif
    </div>
</div>

<script>
    function updateOutboundTransportFields() {
        const select = document.getElementById('shipping-method');
        if (!select) {
            return;
        }

        const method = select.value;
        const mapping = {
            'Darat': 'darat',
            'Laut': 'laut',
            'Udara': 'udara',
        };

        const shipmentTypeInput = document.getElementById('shipment_transportation_type');
        if (shipmentTypeInput) {
            shipmentTypeInput.value = mapping[method] ?? '';
        }

        const landSection = document.getElementById('transport-detail-land');
        const vehicleSection = document.getElementById('transport-detail-vehicle');
        const landExtraSection = document.getElementById('transport-detail-land-extra');
        const seaSection = document.getElementById('transport-detail-sea');
        const airSection = document.getElementById('transport-detail-air');

        const showLand = method === 'Darat';
        const showSea = method === 'Laut';
        const showAir = method === 'Udara';

        if (landSection) landSection.style.display = showLand ? 'block' : 'none';
        if (vehicleSection) vehicleSection.style.display = showLand ? 'block' : 'none';
        if (landExtraSection) landExtraSection.style.display = showLand ? 'block' : 'none';
        if (seaSection) seaSection.style.display = showSea ? 'block' : 'none';
        if (airSection) airSection.style.display = showAir ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateOutboundTransportFields();
        const shippingSelect = document.getElementById('shipping-method');
        if (shippingSelect) {
            shippingSelect.addEventListener('change', updateOutboundTransportFields);
        }

        const packingListSearch = document.getElementById('packing-list-search');
        const packingListCards = document.querySelectorAll('.packing-list-card');
        const packingListForm = document.getElementById('packing-list-form');
        const packingListSelect = document.getElementById('packing_list_id');

        function highlightSelectedCard(selectedId) {
            packingListCards.forEach(card => {
                card.classList.remove('border-blue-500', 'bg-sky-50');
                card.classList.add('border-slate-200', 'bg-white');
                if (card.dataset.id === selectedId) {
                    card.classList.add('border-blue-500', 'bg-sky-50');
                }
            });
        }

        packingListCards.forEach(card => {
            card.addEventListener('click', function () {
                if (!packingListSelect) return;
                packingListSelect.value = this.dataset.id;
                highlightSelectedCard(this.dataset.id);
                packingListForm.submit();
            });
        });

        if (packingListSearch) {
            packingListSearch.addEventListener('input', function () {
                const keyword = this.value.toLowerCase();
                packingListCards.forEach(card => {
                    const text = card.dataset.search;
                    card.style.display = text.includes(keyword) ? 'block' : 'none';
                });
            });
        }

        if (packingListSelect && packingListSelect.value) {
            highlightSelectedCard(packingListSelect.value);
        }
    });
</script>

@endsection
