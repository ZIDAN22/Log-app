@extends('layouts.app')

@section('title', 'Edit Outbound')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Outbound</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Edit Barang Keluar</h1>
            </div>
            <a href="{{ route('warehouse.outbound.index') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-slate-900 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-200">
                Kembali ke Barang Keluar
            </a>
        </div>

        @if($errors->any())
        <div class="mb-5 flex items-start gap-3 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 shadow-sm">
            <div class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-rose-100 text-rose-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="font-semibold">Silakan perbaiki data berikut.</p>
            </div>
        </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm xl:col-span-2">
                <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Informasi Packing List</h2>
                        <p class="mt-1 text-sm text-slate-500">Data packing list yang akan digunakan untuk outbound.</p>
                    </div>
                    <span class="inline-flex items-center rounded-full px-3.5 py-1.5 text-sm font-semibold {{ $outbound->statusBadge() }}">{{ $outbound->status ?? 'Outbound' }}</span>
                </div>

                <div class="grid gap-4 lg:grid-cols-3">
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-700">No Resi</p>
                        <p class="mt-2 text-base font-semibold text-slate-900">{{ $outbound->packingList->shipment->receipt_number }}</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-700">Customer</p>
                        <p class="mt-2 text-base font-semibold text-slate-900">{{ $outbound->packingList->shipment->receiver_name }}</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-700">Tujuan</p>
                        <p class="mt-2 text-base font-semibold text-slate-900">{{ $outbound->packingList->shipment->destination_city }}, {{ $outbound->packingList->shipment->destination_province }}</p>
                    </div>
                </div>

                <div class="mt-6 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 px-4 py-4 sm:px-5">
                        <h3 class="text-base font-bold text-slate-950">Daftar Barang</h3>
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
                                @foreach($outbound->packingList->items as $item)
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

            <div class="space-y-6">
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="mb-4 text-base font-bold text-slate-950">Ringkasan</h2>
                    <div class="space-y-3 text-sm text-slate-700">
                        <div><span class="font-semibold">Total Qty:</span> {{ $outbound->packingList->total_qty }}</div>
                        <div><span class="font-semibold">Total Berat:</span> {{ number_format($outbound->packingList->total_weight, 2, ',', '.') }} kg</div>
                        <div><span class="font-semibold">Total Paket:</span> {{ $outbound->packingList->total_package }}</div>
                    </div>
                </div>

                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="mb-2 text-base font-bold text-slate-950">Aksi</h2>
                    <p class="text-sm text-slate-600">Perbarui detail Barang keluar pada form di bawah.</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('warehouse.outbound.update', $outbound) }}" class="mt-8 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-950">Form Edit Barang Keluar</h2>
                    <p class="mt-1 text-sm text-slate-500">Perbarui metode pengiriman dan detail pengantaran.</p>
                </div>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Transportasi</label>
                    <select id="shipping-method" name="shipping_method" onchange="toggleDriverVehicle()" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @foreach(App\Models\Outbound::shippingMethods() as $method)
                        <option value="{{ $method }}" @selected(old('shipping_method', $outbound->shipping_method) === $method)>{{ $method }}</option>
                        @endforeach
                    </select>
                    @error('shipping_method')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div id="driver-field" class="transition duration-200">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Driver</label>
                    <select name="driver_id" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option value="">Pilih driver</option>
                        @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" @selected(old('driver_id', $outbound->driver_id) == $driver->id)>{{ $driver->name }}</option>
                        @endforeach
                    </select>
                    @error('driver_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div id="vehicle-field" class="transition duration-200">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Kendaraan</label>
                    <select name="vehicle_id" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option value="">Pilih kendaraan</option>
                        @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" @selected(old('vehicle_id', $outbound->vehicle_id) == $vehicle->id)>{{ $vehicle->name }} ({{ $vehicle->license_plate }})</option>
                        @endforeach
                    </select>
                    @error('vehicle_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div id="sea-field" class="transition duration-200">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Pelayaran</label>
                    <input type="text" name="sea_shipping" value="{{ old('sea_shipping', $outbound->shipment?->sea_shipping ?? '') }}" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Masukkan nama kapal/rute" />
                    @error('sea_shipping')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div id="sea-date-field" class="transition duration-200">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Keberangkatan Laut</label>
                    <input type="date" name="sea_departure_date" value="{{ old('sea_departure_date', $outbound->shipment?->sea_departure_date?->format('Y-m-d') ?? '') }}" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    @error('sea_departure_date')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div id="airline-field" class="transition duration-200">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Maskapai</label>
                    <input type="text" name="air_shipping" value="{{ old('air_shipping', $outbound->shipment?->air_shipping ?? '') }}" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Masukkan nama maskapai" />
                    @error('air_shipping')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div id="air-date-field" class="transition duration-200">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Keberangkatan Udara</label>
                    <input type="date" name="air_departure_date" value="{{ old('air_departure_date', $outbound->shipment?->air_departure_date?->format('Y-m-d') ?? '') }}" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    @error('air_departure_date')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal barang keluar</label>
                    <input type="date" name="outbound_date" value="{{ old('outbound_date', $outbound->outbound_date->format('Y-m-d')) }}" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    @error('outbound_date')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="mb-2 block text-sm font-semibold text-slate-700">Catatan Pengiriman</label>
                <textarea name="delivery_notes" rows="4" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ old('delivery_notes', $outbound->delivery_notes) }}</textarea>
                @error('delivery_notes')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan Perubahan</button>
                <a href="{{ route('warehouse.outbound.show', $outbound) }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function toggleDriverVehicle() {
        const method = document.getElementById('shipping-method').value;
        const showLand = method === '{{ App\Models\Outbound::SHIPPING_METHOD_LAND }}';
        const showSea = method === '{{ App\Models\Outbound::SHIPPING_METHOD_SEA }}';
        const showAir = method === '{{ App\Models\Outbound::SHIPPING_METHOD_AIR }}';

        const driverField = document.getElementById('driver-field');
        const vehicleField = document.getElementById('vehicle-field');
        const seaField = document.getElementById('sea-field');
        const seaDateField = document.getElementById('sea-date-field');
        const airlineField = document.getElementById('airline-field');
        const airDateField = document.getElementById('air-date-field');

        if (driverField) driverField.style.display = (showLand ? 'block' : 'none');
        if (vehicleField) vehicleField.style.display = (showLand ? 'block' : 'none');
        if (seaField) seaField.style.display = (showSea ? 'block' : 'none');
        if (seaDateField) seaDateField.style.display = (showSea ? 'block' : 'none');
        if (airlineField) airlineField.style.display = (showAir ? 'block' : 'none');
        if (airDateField) airDateField.style.display = (showAir ? 'block' : 'none');
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleDriverVehicle();
    });
</script>
@endpush
@endsection
