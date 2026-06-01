@extends('layouts.app')

@section('title', 'Edit Outbound')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-[1800px]">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Edit Outbound</h1>
                <p class="mt-2 text-slate-600">Perbarui detail outbound yang sudah dibuat.</p>
            </div>
            <a href="{{ route('warehouse.outbound.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">Kembali ke Outbound</a>
        </div>

        @if($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-800 shadow-sm">Silakan perbaiki data berikut.</div>
        @endif

        <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-xl font-bold text-slate-900">Informasi Packing List</h2>
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">No Resi</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $outbound->packingList->shipment->receipt_number }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Customer</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $outbound->packingList->shipment->receiver_name }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Tujuan</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $outbound->packingList->shipment->destination_city }}, {{ $outbound->packingList->shipment->destination_province }}</p>
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
                            @foreach($outbound->packingList->items as $item)
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
                    <p class="mt-3 text-2xl font-semibold text-slate-900">{{ $outbound->packingList->total_qty }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Total Berat</p>
                    <p class="mt-3 text-2xl font-semibold text-slate-900">{{ number_format($outbound->packingList->total_weight, 2, ',', '.') }} kg</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Total Paket</p>
                    <p class="mt-3 text-2xl font-semibold text-slate-900">{{ $outbound->packingList->total_package }}</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('warehouse.outbound.update', $outbound) }}" class="mt-8 rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Metode Pengiriman</label>
                    <select id="shipping-method" name="shipping_method" onchange="toggleDriverVehicle()" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                        @foreach(App\Models\Outbound::shippingMethods() as $method)
                        <option value="{{ $method }}" @selected(old('shipping_method', $outbound->shipping_method) === $method)>{{ $method }}</option>
                        @endforeach
                    </select>
                    @error('shipping_method')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div id="driver-field" class="transition duration-200">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Driver</label>
                    <select name="driver_id" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                        <option value="">Pilih driver</option>
                        @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" @selected(old('driver_id', $outbound->driver_id) == $driver->id)>{{ $driver->name }}</option>
                        @endforeach
                    </select>
                    @error('driver_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div id="vehicle-field" class="transition duration-200">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Kendaraan</label>
                    <select name="vehicle_id" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                        <option value="">Pilih kendaraan</option>
                        @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" @selected(old('vehicle_id', $outbound->vehicle_id) == $vehicle->id)>{{ $vehicle->name }} ({{ $vehicle->license_plate }})</option>
                        @endforeach
                    </select>
                    @error('vehicle_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Outbound</label>
                    <input type="date" name="outbound_date" value="{{ old('outbound_date', $outbound->outbound_date->format('Y-m-d')) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                    @error('outbound_date')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Status Pengiriman</label>
                    <select name="status" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                        @foreach(App\Models\Outbound::statuses() as $status)
                        <option value="{{ $status }}" @selected(old('status', $outbound->status) === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('status')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="mb-2 block text-sm font-semibold text-slate-700">Catatan Pengiriman</label>
                <textarea name="delivery_notes" rows="4" class="w-full rounded-3xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ old('delivery_notes', $outbound->delivery_notes) }}</textarea>
                @error('delivery_notes')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan Perubahan</button>
                <a href="{{ route('warehouse.outbound.show', $outbound) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function toggleDriverVehicle() {
        const method = document.getElementById('shipping-method').value;
        const showLand = method === '{{ App\Models\Outbound::SHIPPING_METHOD_LAND }}';

        document.getElementById('driver-field').style.display = showLand ? 'block' : 'none';
        document.getElementById('vehicle-field').style.display = showLand ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleDriverVehicle();
    });
</script>
@endpush
@endsection
