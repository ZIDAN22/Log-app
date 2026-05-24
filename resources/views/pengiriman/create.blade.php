@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-4 lg:px-6">
    <div class="mx-auto w-full max-w-[1700px]">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Buat Pengiriman Baru
            </h1>
            <p class="mt-2 text-slate-600">
                Isi data pengiriman untuk membuat shipment baru.
            </p>
        </div>

        <!-- Card -->
        <div class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-sm">
            <form method="POST" action="{{ route('pengiriman.store') }}" class="space-y-8 p-5 sm:p-7 lg:p-8">
                @csrf

                <!-- Auto Generate -->
                <div class="rounded-[28px] border border-slate-200 bg-slate-50 p-6">
                    <div class="grid gap-5 lg:grid-cols-2">
                        
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                No Invoice
                            </label>

                            <input 
                                type="text"
                                disabled
                                placeholder="Auto generated on save"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3.5 text-sm text-slate-500"
                            />
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                No Resi
                            </label>

                            <input 
                                type="text"
                                disabled
                                placeholder="Auto generated on save"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3.5 text-sm text-slate-500"
                            />
                        </div>

                    </div>
                </div>

                <!-- Informasi Pengiriman -->
                <div class="rounded-[28px] border border-slate-200 bg-white p-6 lg:p-7">
                    
                    <div class="mb-6 flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">
                                Informasi Pengiriman
                            </h2>
                            <p class="mt-1 text-sm text-slate-500">
                                Lengkapi data pengirim dan penerima barang.
                            </p>
                        </div>
                    </div>

                    <!-- Sender Receiver -->
                    <div class="grid gap-7 xl:grid-cols-2">

                        <!-- LEFT -->
                        <div class="space-y-6">

                            <div class="rounded-[28px] border border-slate-200 bg-slate-50 p-6">
                                <label for="sender_name" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Pengirim
                                    <span class="text-red-500">*</span>
                                </label>

                                <input 
                                    id="sender_name"
                                    name="sender_name"
                                    value="{{ old('sender_name') }}"
                                    required
                                    type="text"
                                    placeholder="Nama Pengirim"
                                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                                />

                                @error('sender_name')
                                    <p class="mt-2 text-sm text-rose-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            @include('pengiriman._destination-region-fields', [
                                'prefix' => 'pickup',
                                'title' => 'Alamat Pickup',
                                'shipment' => null
                            ])

                        </div>

                        <!-- RIGHT -->
                        <div class="space-y-6">

                            <div class="rounded-[28px] border border-slate-200 bg-slate-50 p-6">
                                <label for="receiver_name" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Penerima
                                    <span class="text-red-500">*</span>
                                </label>

                                <input 
                                    id="receiver_name"
                                    name="receiver_name"
                                    value="{{ old('receiver_name') }}"
                                    required
                                    type="text"
                                    placeholder="Nama Penerima"
                                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                                />

                                @error('receiver_name')
                                    <p class="mt-2 text-sm text-rose-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            @include('pengiriman._destination-region-fields', [
                                'prefix' => 'destination',
                                'title' => 'Alamat Tujuan Pengiriman',
                                'shipment' => null
                            ])

                        </div>

                    </div>

                    <!-- Shipment Detail -->
                    <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                        <!-- Jenis Barang -->
                        <div>
                            <label for="item_type" class="mb-2 block text-sm font-semibold text-slate-700">
                                Jenis Barang
                                <span class="text-red-500">*</span>
                            </label>

                            <input 
                                id="item_type"
                                name="item_type"
                                value="{{ old('item_type') }}"
                                required
                                type="text"
                                placeholder="Contoh: Elektronik"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            />

                            @error('item_type')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Berat -->
                        <div>
                            <label for="total_weight" class="mb-2 block text-sm font-semibold text-slate-700">
                                Berat (KG)
                                <span class="text-red-500">*</span>
                            </label>

                            <input 
                                id="total_weight"
                                name="total_weight"
                                value="{{ old('total_weight') }}"
                                required
                                type="number"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            />

                            @error('total_weight')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div>
                            <label for="price_per_kg" class="mb-2 block text-sm font-semibold text-slate-700">
                                Harga per KG (Rp)
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-500">
                                    Rp
                                </span>

                                <input 
                                    id="price_per_kg"
                                    name="price_per_kg"
                                    value="{{ old('price_per_kg') }}"
                                    required
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    placeholder="0.00"
                                    class="w-full rounded-2xl border border-slate-300 bg-white py-3.5 pl-12 pr-4 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                                />
                            </div>

                            @error('price_per_kg')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Transport -->
                        <div>
                            <label for="transportation_type" class="mb-2 block text-sm font-semibold text-slate-700">
                                Transportasi
                                <span class="text-red-500">*</span>
                            </label>

                            <select 
                                id="transportation_type"
                                name="transportation_type"
                                required
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            >
                                <option value="">Pilih transportasi</option>
                                <option value="darat" {{ old('transportation_type') === 'darat' ? 'selected' : '' }}>
                                    Darat
                                </option>
                                <option value="laut" {{ old('transportation_type') === 'laut' ? 'selected' : '' }}>
                                    Laut
                                </option>
                                <option value="udara" {{ old('transportation_type') === 'udara' ? 'selected' : '' }}>
                                    Udara
                                </option>
                            </select>

                            @error('transportation_type')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Shipping Day -->
                        <div>
                            <label for="shipping_day" class="mb-2 block text-sm font-semibold text-slate-700">
                                Hari Pengiriman
                            </label>

                            <input
                                id="shipping_day"
                                name="shipping_day"
                                value="{{ old('shipping_day') }}"
                                type="text"
                                placeholder="Contoh: 3"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            />

                            @error('shipping_day')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div id="transport-detail-darat" style="display: none;">
                            <label for="vehicle_id" class="mb-2 block text-sm font-semibold text-slate-700">
                                Kendaraan Darat
                            </label>

                            <select
                                id="vehicle_id"
                                name="vehicle_id"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            >
                                <option value="">Pilih kendaraan</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->name }} - {{ $vehicle->license_plate }}
                                    </option>
                                @endforeach
                            </select>

                            @error('vehicle_id')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <label for="land_departure_date" class="mb-2 block text-sm font-semibold text-slate-700 mt-4">
                                Tgl Berangkat (Darat)
                            </label>

                            <input
                                id="land_departure_date"
                                name="land_departure_date"
                                value="{{ old('land_departure_date') }}"
                                type="date"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            />

                            @error('land_departure_date')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div id="transport-detail-laut" style="display: none;">
                            <label for="sea_shipping" class="mb-2 block text-sm font-semibold text-slate-700">
                                Pelayaran Laut
                            </label>

                            <input
                                id="sea_shipping"
                                name="sea_shipping"
                                value="{{ old('sea_shipping') }}"
                                type="text"
                                placeholder="Contoh: Dharma Kartika 8"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            />

                            @error('sea_shipping')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <label for="sea_departure_date" class="mb-2 block text-sm font-semibold text-slate-700 mt-4">
                                Tgl Berangkat (Laut)
                            </label>

                            <input
                                id="sea_departure_date"
                                name="sea_departure_date"
                                value="{{ old('sea_departure_date') }}"
                                type="date"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            />

                            @error('sea_departure_date')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div id="transport-detail-udara" style="display: none;">
                            <label for="air_shipping" class="mb-2 block text-sm font-semibold text-slate-700">
                                Pengiriman Udara
                            </label>

                            <input
                                id="air_shipping"
                                name="air_shipping"
                                value="{{ old('air_shipping') }}"
                                type="text"
                                placeholder="Contoh: Lion Air Cargo"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            />

                            @error('air_shipping')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <label for="air_departure_date" class="mb-2 block text-sm font-semibold text-slate-700 mt-4">
                                Tgl Berangkat (Udara)
                            </label>

                            <input
                                id="air_departure_date"
                                name="air_departure_date"
                                value="{{ old('air_departure_date') }}"
                                type="date"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            />

                            @error('air_departure_date')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Pickup Date -->
                        <div>
                            <label for="pickup_date" class="mb-2 block text-sm font-semibold text-slate-700">
                                Pickup Date
                                <span class="text-red-500">*</span>
                            </label>

                            <input 
                                id="pickup_date"
                                name="pickup_date"
                                value="{{ old('pickup_date', now()->toDateString()) }}"
                                required
                                type="date"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                            />

                            @error('pickup_date')
                                <p class="mt-2 text-sm text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Notes -->
                <div class="rounded-[28px] border border-slate-200 bg-slate-50 p-6">
                    
                    <h2 class="mb-4 text-xl font-bold text-slate-900">
                        Catatan Pengiriman
                    </h2>

                    <label for="notes" class="mb-2 block text-sm font-semibold text-slate-700">
                        Notes
                    </label>

                    <textarea 
                        id="notes"
                        name="notes"
                        rows="5"
                        placeholder="Catatan khusus untuk pengiriman"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100"
                    >{{ old('notes') }}</textarea>

                    @error('notes')
                        <p class="mt-2 text-sm text-rose-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Action -->
                <div class="flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                    <a 
                        href="{{ route('pengiriman.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-7 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>

                        Batal
                    </a>

                    <button 
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-7 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>

                        Simpan Pengiriman
                    </button>

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
    }

    document.getElementById('transportation_type').addEventListener('change', updateTransportDetails);
    document.addEventListener('DOMContentLoaded', updateTransportDetails);
</script>
@endsection