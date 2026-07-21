@extends('layouts.app')

@section('title', isset($shipment) ? 'Edit Pengiriman — ' . ($shipment->invoice_number ?? $shipment->id) : 'Edit Pengiriman')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">

    <div class="mx-auto w-full max-w-[1700px]">

        <!-- HEADER -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Edit Pengiriman
            </h1>

            <p class="mt-2 text-slate-600">
                Perbarui detail shipment dan status pengiriman.
            </p>

        </div>

        <!-- CARD -->
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <form method="POST"
                action="{{ route('pengiriman.update', $shipment) }}"
                class="space-y-8 p-5 sm:p-7 lg:p-8">

                @csrf
                @method('PUT')

                <!-- INVOICE -->
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-6">

                    <div class="grid gap-6 lg:grid-cols-2">

                        <!-- Invoice -->
                        <div>

                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                No Invoice
                            </label>

                            <input type="text"
                                disabled
                                value="{{ $shipment->invoice_number }}"
                                class="w-full rounded-lg border border-slate-300 bg-slate-100 px-4 py-3 text-slate-600" />

                        </div>

                        <!-- Resi -->
                        <div>

                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                No Resi
                            </label>

                            <input type="text"
                                disabled
                                value="{{ $shipment->receipt_number }}"
                                class="w-full rounded-lg border border-slate-300 bg-slate-100 px-4 py-3 text-slate-600" />

                        </div>

                    </div>

                </div>

                <!-- INFORMASI -->
                <div class="rounded-xl border border-slate-200 bg-white p-6 lg:p-7">

                    <div class="mb-6">

                        <h2 class="text-2xl font-bold text-slate-900">
                            Informasi Shipment
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Lengkapi informasi pengirim dan penerima.
                        </p>

                    </div>

                    <div class="grid gap-7 xl:grid-cols-2">

                        <!-- LEFT -->
                        <div class="space-y-6">

                            <!-- Sender -->
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-6">

                                <label for="sender_name"
                                    class="mb-2 block text-sm font-semibold text-slate-700">

                                    Pengirim
                                    <span class="text-red-500">*</span>

                                </label>

                                <input id="sender_name"
                                    name="sender_name"
                                    value="{{ old('sender_name', $shipment->sender_name) }}"
                                    required
                                    type="text"
                                    placeholder="Nama Pengirim"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                                @error('sender_name')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>

                            @include('pengiriman._destination-region-fields', [
                                'prefix' => 'pickup',
                                'title' => 'Alamat Pickup',
                                'shipment' => $shipment
                            ])

                        </div>

                        <!-- RIGHT -->
                        <div class="space-y-6">

                            <!-- Receiver -->
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-6">

                                <label for="receiver_name"
                                    class="mb-2 block text-sm font-semibold text-slate-700">

                                    Penerima
                                    <span class="text-red-500">*</span>

                                </label>

                                <input id="receiver_name"
                                    name="receiver_name"
                                    value="{{ old('receiver_name', $shipment->receiver_name) }}"
                                    required
                                    type="text"
                                    placeholder="Nama Penerima"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                                @error('receiver_name')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>

                            @include('pengiriman._destination-region-fields', [
                                'prefix' => 'destination',
                                'title' => 'Alamat Tujuan Pengiriman',
                                'shipment' => $shipment
                            ])

                        </div>

                    </div>

                    <!-- DETAIL -->
                    <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                        <!-- Jenis Barang -->
                        <div>

                            <label for="item_type"
                                class="mb-2 block text-sm font-semibold text-slate-700">

                                Jenis Barang
                                <span class="text-red-500">*</span>

                            </label>

                            <input id="item_type"
                                name="item_type"
                                value="{{ old('item_type', $shipment->item_type) }}"
                                required
                                type="text"
                                placeholder="Contoh: Elektronik"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            @error('item_type')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        <!-- Berat Aktual -->
                        <div>

                            <label for="actual_weight"
                                class="mb-2 block text-sm font-semibold text-slate-700">

                                Berat Aktual (KG)
                                <span class="text-red-500">*</span>

                            </label>

                            <input id="actual_weight"
                                name="actual_weight"
                                value="{{ old('actual_weight', $shipment->actual_weight ?? $shipment->total_weight) }}"
                                required
                                type="number"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            @error('actual_weight')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        <!-- Harga -->
                        <div>

                            <label for="price_per_kg"
                                class="mb-2 block text-sm font-semibold text-slate-700">

                                Harga per KG (Rp)
                                <span class="text-red-500">*</span>

                            </label>

                            <div class="relative">

                                <span
                                    class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                                    Rp
                                </span>

                                <input id="price_per_kg"
                                    name="price_per_kg"
                                    value="{{ old('price_per_kg', $shipment->price_per_kg) }}"
                                    required
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    placeholder="0.00"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-12 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            </div>

                            @error('price_per_kg')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        <!-- Transport -->
                        <div>

                            <label for="transportation_type"
                                class="mb-2 block text-sm font-semibold text-slate-700">

                                Transportasi
                                <span class="text-red-500">*</span>

                            </label>

                            <select id="transportation_type"
                                name="transportation_type"
                                required
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">

                                <option value="">Pilih transportasi</option>

                                <option value="darat"
                                    {{ old('transportation_type', $shipment->transportation_type) === 'darat' ? 'selected' : '' }}>
                                    Darat
                                </option>

                                <option value="laut"
                                    {{ old('transportation_type', $shipment->transportation_type) === 'laut' ? 'selected' : '' }}>
                                    Laut
                                </option>

                                <option value="udara"
                                    {{ old('transportation_type', $shipment->transportation_type) === 'udara' ? 'selected' : '' }}>
                                    Udara
                                </option>

                            </select>

                            @error('transportation_type')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        <!-- Jenis Layanan -->
                        <div>

                            <label for="service_type"
                                class="mb-2 block text-sm font-semibold text-slate-700">

                                Jenis Layanan
                                <span class="text-red-500">*</span>

                            </label>

                            <select id="service_type"
                                name="service_type"
                                required
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">

                                <option value="">Pilih jenis layanan</option>

                                <option value="PTP"
                                    {{ old('service_type', $shipment->service_type) === 'PTP' ? 'selected' : '' }}>
                                    PTP (Port to Port)
                                </option>

                                <option value="DTD"
                                    {{ old('service_type', $shipment->service_type) === 'DTD' ? 'selected' : '' }}>
                                    DTD (Door to Door)
                                </option>

                            </select>

                            @error('service_type')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        <div>
                            <label for="shipping_day" class="mb-2 block text-sm font-semibold text-slate-700">
                                Hari Pengiriman
                            </label>

                            <input
                                id="shipping_day"
                                name="shipping_day"
                                value="{{ old('shipping_day', $shipment->shipping_day) }}"
                                type="text"
                                placeholder="Contoh: 3"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            />

                            @error('shipping_day')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Volumetrik Toggle -->
                        <div class="rounded-lg border border-slate-300 bg-slate-50 p-4">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" id="use_volumetric" name="use_volumetric" value="1" 
                                    {{ old('use_volumetric', $shipment->use_volumetric) ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-100" />
                                <label for="use_volumetric" class="text-sm font-semibold text-slate-700">
                                    Gunakan Perhitungan Volumetrik
                                </label>
                            </div>

                            <div id="volumetric-fields" class="mt-4 grid gap-4 lg:grid-cols-4" style="display: none;">
                                <div>
                                    <label for="length_cm" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Panjang (cm)
                                    </label>
                                    <input id="length_cm" name="length_cm" value="{{ old('length_cm', $shipment->length_cm) }}"
                                        type="number" min="0" step="0.01" placeholder="0.00"
                                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                                    @error('length_cm')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="width_cm" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Lebar (cm)
                                    </label>
                                    <input id="width_cm" name="width_cm" value="{{ old('width_cm', $shipment->width_cm) }}"
                                        type="number" min="0" step="0.01" placeholder="0.00"
                                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                                    @error('width_cm')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="height_cm" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Tinggi (cm)
                                    </label>
                                    <input id="height_cm" name="height_cm" value="{{ old('height_cm', $shipment->height_cm) }}"
                                        type="number" min="0" step="0.01" placeholder="0.00"
                                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                                    @error('height_cm')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="volumetric_weight" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Berat Volumetrik (KG)
                                    </label>
                                    <input id="volumetric_weight" name="volumetric_weight" value="{{ old('volumetric_weight', $shipment->volumetric_weight) }}"
                                        type="number" min="0" step="0.01" placeholder="0.00" readonly
                                        class="w-full rounded-lg border border-slate-200 bg-slate-100 px-4 py-3 text-sm text-slate-500" />
                                </div>
                            </div>
                        </div>

                        <!-- Berat Dikenakan -->
                        <div>
                            <label for="chargeable_weight" class="mb-2 block text-sm font-semibold text-slate-700">
                                Berat Dikenakan (Chargeable Weight)
                            </label>
                            <input id="chargeable_weight" name="chargeable_weight" value="{{ old('chargeable_weight', $shipment->chargeable_weight) }}"
                                type="number" min="0" step="0.01" placeholder="0.00" readonly
                                class="w-full rounded-lg border border-slate-200 bg-slate-100 px-4 py-3 text-sm text-slate-500" />
                            <p class="mt-2 text-xs text-slate-500">Nilai terbesar antara Berat Aktual dan Berat Volumetrik</p>
                        </div>

                        <div id="transport-detail-darat" style="display: none;">
                            <label class="mb-3 block text-sm font-semibold text-slate-900">Informasi Pengiriman Darat</label>
                            
                            <label for="vehicle_id" class="mb-2 block text-sm font-semibold text-slate-700">
                                Kendaraan
                            </label>

                            <select
                                id="vehicle_id"
                                name="vehicle_id"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                                <option value="">-- Pilih Kendaraan --</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}"
                                        {{ old('vehicle_id', $shipment->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->name }} ({{ $vehicle->license_plate }})
                                    </option>
                                @endforeach
                            </select>

                            @error('vehicle_id')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                            <label for="driver_id" class="mb-2 block text-sm font-semibold text-slate-700 mt-4">
                                Pengemudi
                            </label>

                            <select
                                id="driver_id"
                                name="driver_id"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                                <option value="">-- Pilih Pengemudi --</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}"
                                        {{ old('driver_id', $shipment->driver_id) == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('driver_id')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                            <label for="land_departure_date" class="mb-2 block text-sm font-semibold text-slate-700 mt-4">
                                Tanggal Berangkat Darat
                            </label>

                            <input
                                id="land_departure_date"
                                name="land_departure_date"
                                value="{{ old('land_departure_date', $shipment->land_departure_date?->toDateString()) }}"
                                type="date"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            @error('land_departure_date')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div id="transport-detail-laut" style="display: none;">
                            <label class="mb-3 block text-sm font-semibold text-slate-900">Informasi Pengiriman Laut</label>
                            
                            <label for="sea_fleet" class="mb-2 block text-sm font-semibold text-slate-700">
                                Pengiriman/Armada Laut
                            </label>

                            <input
                                id="sea_fleet"
                                name="sea_fleet"
                                value="{{ old('sea_fleet', $shipment->sea_fleet) }}"
                                type="text"
                                placeholder="Contoh: Dharma Kartika"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            @error('sea_fleet')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                            <label for="ship_name" class="mb-2 block text-sm font-semibold text-slate-700 mt-4">
                                Nama Kapal
                            </label>

                            <input
                                id="ship_name"
                                name="ship_name"
                                value="{{ old('ship_name', $shipment->ship_name) }}"
                                type="text"
                                placeholder="Nama kapal (opsional)"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            @error('ship_name')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                            <label for="sea_departure_date" class="mb-2 block text-sm font-semibold text-slate-700 mt-4">
                                Tanggal Berangkat Laut
                            </label>

                            <input
                                id="sea_departure_date"
                                name="sea_departure_date"
                                value="{{ old('sea_departure_date', $shipment->sea_departure_date?->toDateString()) }}"
                                type="date"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            @error('sea_departure_date')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div id="transport-detail-udara" style="display: none;">
                            <label class="mb-3 block text-sm font-semibold text-slate-900">Informasi Pengiriman Udara</label>
                            
                            <label for="air_carrier" class="mb-2 block text-sm font-semibold text-slate-700">
                                Maskapai Penerbangan
                            </label>

                            <input
                                id="air_carrier"
                                name="air_carrier"
                                value="{{ old('air_carrier', $shipment->air_carrier) }}"
                                type="text"
                                placeholder="Contoh: Garuda Indonesia, Lion Air, dll"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            @error('air_carrier')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                            <label for="air_departure_date" class="mb-2 block text-sm font-semibold text-slate-700 mt-4">
                                Tanggal Berangkat Penerbangan
                            </label>

                            <input
                                id="air_departure_date"
                                name="air_departure_date"
                                value="{{ old('air_departure_date', $shipment->air_departure_date?->toDateString()) }}"
                                type="date"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            @error('air_departure_date')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Pickup Date -->
                        <div>

                            <label for="pickup_date"
                                class="mb-2 block text-sm font-semibold text-slate-700">

                                Pickup Date
                                <span class="text-red-500">*</span>

                            </label>

                            <input id="pickup_date"
                                name="pickup_date"
                                value="{{ old('pickup_date', $shipment->pickup_date->toDateString()) }}"
                                required
                                type="date"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            @error('pickup_date')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        <!-- STATUS -->
                        <div>

                            <label for="shipment_status"
                                class="mb-2 block text-sm font-semibold text-slate-700">

                                Status Pengiriman

                            </label>

                            <select id="shipment_status"
                                name="shipment_status"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">

                                @foreach(\App\Models\Shipment::STATUSES as $status)

                                <option value="{{ $status }}"
                                    {{ old('shipment_status', $shipment->shipment_status) === $status ? 'selected' : '' }}>

                                    {{ $status }}

                                </option>

                                @endforeach

                            </select>

                            @error('shipment_status')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                    </div>

                </div>

                <!-- NOTES -->
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-6">

                    <h2 class="mb-4 text-xl font-bold text-slate-900">
                        Catatan Pengiriman
                    </h2>

                    <label for="notes"
                        class="mb-2 block text-sm font-semibold text-slate-700">

                        Notes

                    </label>

                    <textarea id="notes"
                        name="notes"
                        rows="5"
                        placeholder="Catatan khusus untuk pengiriman"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ old('notes', $shipment->notes) }}</textarea>

                    @error('notes')
                    <p class="mt-2 text-sm text-rose-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <!-- ACTION -->
                <div class="border-t border-slate-200 pt-6">
                    @include('components.form-action-buttons', [
                        'backUrl' => route('pengiriman.index'),
                        'backLabel' => 'Batal',
                        'submitLabel' => 'Update Pengiriman',
                    ])
                </div>

            </form>

        </div>

    </div>

</div>

<script>
    function updateTransportDetails() {
        const type = document.getElementById('transportation_type').value;
        const sections = {
            darat: document.getElementById('transport-detail-darat'),
            laut: document.getElementById('transport-detail-laut'),
            udara: document.getElementById('transport-detail-udara'),
        };

        Object.keys(sections).forEach(key => {
            sections[key].style.display = key === type ? 'block' : 'none';
        });

        // Clear hidden field values
        if (type !== 'darat') {
            document.getElementById('vehicle_id').value = '';
            document.getElementById('driver_id').value = '';
            document.getElementById('land_departure_date').value = '';
        }
        if (type !== 'laut') {
            document.getElementById('sea_fleet').value = '';
            document.getElementById('ship_name').value = '';
            document.getElementById('sea_departure_date').value = '';
        }
        if (type !== 'udara') {
            document.getElementById('air_carrier').value = '';
            document.getElementById('air_departure_date').value = '';
        }
    }

    function handleVolumetricToggle() {
        const checkbox = document.getElementById('use_volumetric');
        const fields = document.getElementById('volumetric-fields');
        const lengthInput = document.getElementById('length_cm');
        const widthInput = document.getElementById('width_cm');
        const heightInput = document.getElementById('height_cm');

        if (checkbox.checked) {
            fields.style.display = 'grid';
            lengthInput.required = true;
            widthInput.required = true;
            heightInput.required = true;
        } else {
            fields.style.display = 'none';
            lengthInput.required = false;
            widthInput.required = false;
            heightInput.required = false;
            lengthInput.value = '';
            widthInput.value = '';
            heightInput.value = '';
            document.getElementById('volumetric_weight').value = '';
            calculateWeights();
        }
    }

    function calculateWeights() {
        const actualWeight = parseFloat(document.getElementById('actual_weight').value) || 0;
        const useVolumetric = document.getElementById('use_volumetric').checked;
        
        let volumetricWeight = 0;
        if (useVolumetric) {
            const length = parseFloat(document.getElementById('length_cm').value) || 0;
            const width = parseFloat(document.getElementById('width_cm').value) || 0;
            const height = parseFloat(document.getElementById('height_cm').value) || 0;
            
            volumetricWeight = length && width && height ? (length * width * height) / 4000 : 0;
            document.getElementById('volumetric_weight').value = volumetricWeight.toFixed(2);
        } else {
            document.getElementById('volumetric_weight').value = '';
        }

        const chargeableWeight = Math.max(actualWeight, volumetricWeight);
        document.getElementById('chargeable_weight').value = chargeableWeight.toFixed(2);
    }

    // Event listeners
    document.getElementById('transportation_type').addEventListener('change', updateTransportDetails);
    document.getElementById('use_volumetric').addEventListener('change', handleVolumetricToggle);
    document.getElementById('actual_weight').addEventListener('input', calculateWeights);
    document.getElementById('length_cm').addEventListener('input', calculateWeights);
    document.getElementById('width_cm').addEventListener('input', calculateWeights);
    document.getElementById('height_cm').addEventListener('input', calculateWeights);

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateTransportDetails();
        handleVolumetricToggle();
        calculateWeights();
    });
</script>
@endsection