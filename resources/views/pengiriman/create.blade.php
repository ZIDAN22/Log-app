@extends('layouts.app')

@section('title', 'Buat Pengiriman Baru')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">
        <div
            class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Pengiriman</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Buat Pengiriman Baru
                </h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    Catat data pengirim, penerima, detail barang, dan jadwal pickup dalam satu formulir operasional.
                </p>
            </div>

            <a href="{{ route('pengiriman.index') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        @if ($errors->any())
        <div class="mb-5 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            <p class="font-semibold">Ada data yang perlu diperbaiki.</p>
            <p class="mt-1">Periksa kembali field bertanda merah sebelum menyimpan pengiriman.</p>
        </div>
        @endif

        <form id="shipment-create-form" method="POST" action="{{ route('pengiriman.store') }}" class="space-y-6">
            @csrf

            <div class="grid gap-8 xl:grid-cols-[minmax(0,1fr)_360px]">
                <div class="space-y-6">
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <div
                            class="mb-5 flex flex-col gap-3 border-b border-slate-200 pb-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-base font-bold text-slate-950">Nomor Dokumen</h2>
                                <p class="mt-1 text-sm text-slate-500">Nomor akan diterbitkan setelah pengiriman
                                    tersimpan.</p>
                            </div>
                            <span
                                class="inline-flex w-fit items-center rounded-md bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                Otomatis
                            </span>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">No Invoice</label>
                                <input type="text" disabled placeholder="Dibuat otomatis saat disimpan"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">No Resi</label>
                                <input type="text" disabled placeholder="Dibuat otomatis saat disimpan"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>
                        </div>
                    </section>

                    <div class="grid gap-6 xl:grid-cols-2">
                        <div class="space-y-6">
                            <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                                <div class="mb-5 border-b border-slate-200 pb-4">
                                    <h2 class="text-base font-bold text-slate-950">Data Pengirim</h2>
                                    <p class="mt-1 text-sm text-slate-500">Identitas pihak yang menyerahkan barang.</p>
                                </div>

                                <label for="sender_name" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nama Pengirim
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input id="sender_name" name="sender_name" value="{{ old('sender_name') }}" required
                                    type="text" placeholder="Nama lengkap pengirim"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />

                                @error('sender_name')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </section>

                            @include('pengiriman._destination-region-fields', [
                            'prefix' => 'pickup',
                            'title' => 'Alamat Pickup',
                            'shipment' => null
                            ])
                        </div>

                        <div class="space-y-6">
                            <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                                <div class="mb-5 border-b border-slate-200 pb-4">
                                    <h2 class="text-base font-bold text-slate-950">Data Penerima</h2>
                                    <p class="mt-1 text-sm text-slate-500">Identitas pihak tujuan pengiriman.</p>
                                </div>

                                <label for="receiver_name" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nama Penerima
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input id="receiver_name" name="receiver_name" value="{{ old('receiver_name') }}"
                                    required type="text" placeholder="Nama lengkap penerima"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />

                                @error('receiver_name')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </section>

                            @include('pengiriman._destination-region-fields', [
                            'prefix' => 'destination',
                            'title' => 'Alamat Tujuan Pengiriman',
                            'shipment' => null
                            ])
                        </div>
                    </div>

                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">Detail Barang dan Pengiriman</h2>
                            <p class="mt-1 text-sm text-slate-500">Rincian muatan, biaya, transportasi, dan tanggal
                                pickup.</p>
                        </div>

                        {{-- BARIS 1: Jenis Barang, Berat Aktual, Transportasi --}}
                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3 mb-6">
                            <div>
                                <label for="item_type" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Jenis Barang
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input id="item_type" name="item_type" value="{{ old('item_type') }}" required
                                    type="text" placeholder="Contoh: Elektronik"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                @error('item_type')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="actual_weight" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Berat Aktual (KG)
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input id="actual_weight" name="actual_weight" value="{{ old('actual_weight') }}" required
                                    type="number" min="0" step="0.01" placeholder="0.00"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                @error('actual_weight')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="transportation_type"
                                    class="mb-2 block text-sm font-semibold text-slate-700">
                                    Transportasi
                                    <span class="text-rose-500">*</span>
                                </label>
                                <select id="transportation_type" name="transportation_type" required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                    <option value="">Pilih transportasi</option>
                                    <option value="darat" {{ old('transportation_type')==='darat' ? 'selected' : '' }}>
                                        Darat</option>
                                    <option value="laut" {{ old('transportation_type')==='laut' ? 'selected' : '' }}>
                                        Laut</option>
                                    <option value="udara" {{ old('transportation_type')==='udara' ? 'selected' : '' }}>
                                        Udara</option>
                                </select>
                                @error('transportation_type')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- BARIS 2: Jenis Layanan, Harga per KG, Hari Pengiriman, Tanggal Pickup --}}
                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4 mb-6">
                            <div>
                                <label for="service_type" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Jenis Layanan
                                    <span class="text-rose-500">*</span>
                                </label>
                                <select id="service_type" name="service_type" required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                    <option value="">Pilih jenis layanan</option>
                                    <option value="PTP" {{ old('service_type')==='PTP' ? 'selected' : '' }}>PTP (Port to Port)</option>
                                    <option value="DTD" {{ old('service_type')==='DTD' ? 'selected' : '' }}>DTD (Door to Door)</option>
                                </select>
                                @error('service_type')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price_per_kg" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Harga per KG
                                    <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <span
                                        class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-500">Rp</span>
                                    <input id="price_per_kg" name="price_per_kg" value="{{ old('price_per_kg') }}"
                                        required type="number" min="0" step="0.01" placeholder="0.00"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                </div>
                                @error('price_per_kg')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_day" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Hari Pengiriman
                                </label>
                                <input id="shipping_day" name="shipping_day" value="{{ old('shipping_day') }}"
                                    type="text" placeholder="Contoh: 3 hari"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                @error('shipping_day')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="pickup_date" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Tanggal Pickup
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input id="pickup_date" name="pickup_date"
                                    value="{{ old('pickup_date', now()->toDateString()) }}" required type="date"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                @error('pickup_date')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Volumetrik Section --}}
                        <div class="mb-6 rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" id="use_volumetric" name="use_volumetric" value="1" 
                                    {{ old('use_volumetric') ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-100" />
                                <label for="use_volumetric" class="text-sm font-semibold text-slate-700">
                                    Gunakan Perhitungan Volumetrik
                                </label>
                            </div>

                            <div id="volumetric-fields" class="mt-4 grid gap-6 md:grid-cols-2 xl:grid-cols-4" style="display: none;">
                                <div>
                                    <label for="length_cm" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Panjang (cm)
                                        <span class="text-rose-500" id="length-required">*</span>
                                    </label>
                                    <input id="length_cm" name="length_cm" value="{{ old('length_cm') }}"
                                        type="number" min="0" step="0.01" placeholder="0.00"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                    @error('length_cm')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="width_cm" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Lebar (cm)
                                        <span class="text-rose-500" id="width-required">*</span>
                                    </label>
                                    <input id="width_cm" name="width_cm" value="{{ old('width_cm') }}"
                                        type="number" min="0" step="0.01" placeholder="0.00"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                    @error('width_cm')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="height_cm" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Tinggi (cm)
                                        <span class="text-rose-500" id="height-required">*</span>
                                    </label>
                                    <input id="height_cm" name="height_cm" value="{{ old('height_cm') }}"
                                        type="number" min="0" step="0.01" placeholder="0.00"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                    @error('height_cm')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="volumetric_weight" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Berat Volumetrik (KG)
                                    </label>
                                    <input id="volumetric_weight" name="volumetric_weight" value="{{ old('volumetric_weight') }}"
                                        type="number" min="0" step="0.01" placeholder="0.00" readonly
                                        class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                                </div>
                            </div>
                        </div>

                        {{-- Berat Dikenakan (Readonly) --}}
                        <div class="mb-6 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                            <div>
                                <label for="chargeable_weight" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Berat Dikenakan (Chargeable Weight)
                                </label>
                                <input id="chargeable_weight" name="chargeable_weight" value="{{ old('chargeable_weight') }}"
                                    type="number" min="0" step="0.01" placeholder="0.00" readonly
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                                <p class="mt-2 text-xs text-slate-500">Nilai terbesar antara Berat Aktual dan Berat Volumetrik</p>
                            </div>
                        </div>

                        {{-- BARIS 3: Transport-specific sections (dinamis) --}}

                        {{-- Transport Detail Darat --}}
                        <div id="transport-detail-darat"
                            class="rounded-lg border border-slate-200 bg-slate-50 p-4 md:col-span-2 xl:col-span-4 mb-6"
                            style="display: none;">
                            <h3 class="mb-4 text-sm font-semibold text-slate-900">Informasi Pengiriman Darat</h3>
                            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                                <div>
                                    <label for="vehicle_id"
                                        class="mb-2 block text-sm font-semibold text-slate-700">Kendaraan</label>
                                    <select id="vehicle_id" name="vehicle_id"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                        <option value="">-- Pilih Kendaraan --</option>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->name }} ({{ $vehicle->license_plate }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_id')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="driver_id"
                                        class="mb-2 block text-sm font-semibold text-slate-700">Pengemudi</label>
                                    <select id="driver_id" name="driver_id"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                        <option value="">-- Pilih Pengemudi --</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('driver_id')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="land_departure_date"
                                        class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Berangkat</label>
                                    <input id="land_departure_date" name="land_departure_date"
                                        value="{{ old('land_departure_date') }}" type="date"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                    @error('land_departure_date')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Transport Detail Laut --}}
                        <div id="transport-detail-laut"
                            class="rounded-lg border border-slate-200 bg-slate-50 p-4 md:col-span-2 xl:col-span-4 mb-6"
                            style="display: none;">
                            <h3 class="mb-4 text-sm font-semibold text-slate-900">Informasi Pengiriman Laut</h3>
                            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                                <div>
                                    <label for="sea_fleet"
                                        class="mb-2 block text-sm font-semibold text-slate-700">Pengiriman/Armada Laut</label>
                                    <input id="sea_fleet" name="sea_fleet" value="{{ old('sea_fleet') }}"
                                        type="text" placeholder="Contoh: Dharma Kartika"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                    @error('sea_fleet')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="ship_name"
                                        class="mb-2 block text-sm font-semibold text-slate-700">Nama Kapal</label>
                                    <input id="ship_name" name="ship_name" value="{{ old('ship_name') }}"
                                        type="text" placeholder="Nama kapal (opsional)"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                    @error('ship_name')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="sea_departure_date"
                                        class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Berangkat</label>
                                    <input id="sea_departure_date" name="sea_departure_date"
                                        value="{{ old('sea_departure_date') }}" type="date"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                    @error('sea_departure_date')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Transport Detail Udara --}}
                        <div id="transport-detail-udara"
                            class="rounded-lg border border-slate-200 bg-slate-50 p-4 md:col-span-2 xl:col-span-4 mb-6"
                            style="display: none;">
                            <h3 class="mb-4 text-sm font-semibold text-slate-900">Informasi Pengiriman Udara</h3>
                            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                                <div>
                                    <label for="air_carrier"
                                        class="mb-2 block text-sm font-semibold text-slate-700">Pengiriman Udara</label>
                                    <input id="air_carrier" name="air_carrier" value="{{ old('air_carrier') }}"
                                        type="text" placeholder="Contoh: Lion Air Cargo"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                    @error('air_carrier')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="air_departure_date"
                                        class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Berangkat Udara</label>
                                    <input id="air_departure_date" name="air_departure_date"
                                        value="{{ old('air_departure_date') }}" type="date"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                    @error('air_departure_date')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">Catatan Pengiriman</h2>
                            <p class="mt-1 text-sm text-slate-500">Informasi tambahan untuk operasional lapangan.</p>
                        </div>

                        <label for="notes" class="mb-2 block text-sm font-semibold text-slate-700">Catatan</label>
                        <textarea id="notes" name="notes" rows="4" placeholder="Catatan khusus untuk pengiriman"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ old('notes') }}</textarea>

                        @error('notes')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </section>
                </div>

                {{-- SIDEBAR --}}
                <aside class="space-y-4 xl:sticky xl:top-6 xl:self-start">
                    <section class="rounded-lg border border-blue-100 bg-blue-50 p-5 text-sm text-blue-900">
                        <p class="font-semibold">Dokumen otomatis</p>
                        <p class="mt-2 leading-6">
                            No invoice dan no resi dibuat ketika data pengiriman berhasil disimpan.
                        </p>
                    </section>

                    <section class="rounded-lg border border-slate-200 bg-white p-5 text-sm text-slate-600 shadow-sm">
                        <h3 class="text-sm font-semibold text-slate-900">Informasi Layanan & Tarif</h3>

                        <div class="mt-4 space-y-3">
                            <div>
                                <p class="font-semibold text-slate-800">Jenis Layanan</p>
                                <div class="mt-2 rounded-lg border border-slate-200 bg-slate-50 p-3">
                                    <p class="font-semibold text-slate-900">PTP (Port to Port)</p>
                                    <p class="mt-1 leading-6">Pengiriman dari titik/port asal sampai titik/port tujuan.
                                    </p>
                                </div>
                                <div class="mt-2 rounded-lg border border-slate-200 bg-slate-50 p-3">
                                    <p class="font-semibold text-slate-900">DTD (Door to Door)</p>
                                    <p class="mt-1 leading-6">Pengiriman dari lokasi pengirim sampai alamat penerima
                                        sesuai cakupan wilayah layanan.</p>
                                </div>
                                <p class="mt-2 italic text-slate-500">Tarif menyesuaikan destination dan jenis layanan.
                                </p>
                            </div>

                            <div class="border-t border-slate-200 pt-3">
                                <p class="font-semibold text-slate-700">Volumetrik</p>
                                <p class="mt-2 leading-6 text-slate-600">
                                    Berlaku untuk barang besar tetapi ringan, dengan perhitungan <span
                                        class="font-semibold">(Panjang × Lebar × Tinggi) / 4.000</span>.
                                </p>
                            </div>

                            {{-- Info Transportasi yang Dinamis --}}
                            <div id="transport-info-container" class="border-t border-slate-200 pt-3">
                                {{-- Konten akan di-update oleh JavaScript --}}
                            </div>

                            <div class="border-t border-slate-200 pt-3">
                                <p class="font-semibold text-slate-700">Surcharge Berdasarkan Berat</p>
                                <ul class="mt-2 list-disc space-y-1 pl-5">
                                    <li>71–100 Kg: 50%</li>
                                    <li>101–150 Kg: 100%</li>
                                    <li>151–200 Kg: 200%</li>
                                </ul>
                                <p class="mt-2 text-xs italic text-slate-500">
                                    PPN dan PPh dihitung pada proses Invoice oleh Finance.
                                </p>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>

            <div
                class="flex flex-col gap-3 rounded-lg border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-slate-500">
                    Field bertanda <span class="font-semibold text-rose-500">*</span> wajib diisi.
                </p>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('pengiriman.index') }}"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>

                    <button id="submit-shipment-button" type="submit"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200 disabled:cursor-not-allowed disabled:bg-blue-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Simpan Pengiriman</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Format currency
    function formatCurrency(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
    }

    // Update transport details visibility
    function updateTransportDetails() {
        const type = document.getElementById('transportation_type').value;
        const sections = {
            darat: document.getElementById('transport-detail-darat'),
            laut: document.getElementById('transport-detail-laut'),
            udara: document.getElementById('transport-detail-udara'),
        };

        Object.keys(sections).forEach(key => {
            sections[key].style.display = key === type ? 'block' : 'none';
            // Clear fields from hidden sections
            if (key !== type) {
                const inputs = sections[key].querySelectorAll('input[type="text"], input[type="date"]');
                inputs.forEach(input => input.value = '');
            }
        });

        updateTransportInfo();
    }

    // Update transport info in sidebar
    function updateTransportInfo() {
        const container = document.getElementById('transport-info-container');
        const type = document.getElementById('transportation_type').value;

        let html = '';

        if (type === 'udara') {
            html = `
                <p class="font-semibold text-slate-700">Ketentuan Tarif Udara</p>
                <p class="mt-2 font-semibold text-slate-700 text-xs">Harga belum termasuk:</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    <li>Administrasi SMU: Rp15.000</li>
                    <li>Administrasi SG: Rp500</li>
                </ul>
            `;
        } else if (type === 'darat') {
            html = `
                <p class="font-semibold text-slate-700">Ketentuan Tarif Darat</p>
                <p class="mt-2 text-xs text-slate-600">Harga mengikuti master tarif darat yang tersedia.</p>
            `;
        } else if (type === 'laut') {
            html = `
                <p class="font-semibold text-slate-700">Ketentuan Tarif Laut</p>
                <p class="mt-2 text-xs text-slate-600">Harga mengikuti master tarif laut yang tersedia.</p>
            `;
        }

        container.innerHTML = html;
    }

    // Handle volumetric toggle
    function handleVolumetricToggle() {
        const useVolumetric = document.getElementById('use_volumetric').checked;
        const volumetricFields = document.getElementById('volumetric-fields');
        const fields = ['length_cm', 'width_cm', 'height_cm'];

        volumetricFields.style.display = useVolumetric ? 'grid' : 'none';

        // Update required attributes
        fields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (useVolumetric) {
                field.setAttribute('required', 'required');
            } else {
                field.removeAttribute('required');
                field.value = '';
            }
        });

        calculateWeights();
    }

    // Calculate volumetric weight and chargeable weight
    function calculateWeights() {
        const actualWeight = parseFloat(document.getElementById('actual_weight').value) || 0;
        const useVolumetric = document.getElementById('use_volumetric').checked;
        const lengthCm = parseFloat(document.getElementById('length_cm').value) || 0;
        const widthCm = parseFloat(document.getElementById('width_cm').value) || 0;
        const heightCm = parseFloat(document.getElementById('height_cm').value) || 0;

        let volumetricWeight = 0;
        let chargeableWeight = actualWeight;

        if (useVolumetric && lengthCm > 0 && widthCm > 0 && heightCm > 0) {
            volumetricWeight = (lengthCm * widthCm * heightCm) / 4000;
            document.getElementById('volumetric_weight').value = volumetricWeight.toFixed(2);
            chargeableWeight = Math.max(actualWeight, volumetricWeight);
        } else {
            document.getElementById('volumetric_weight').value = '';
        }

        document.getElementById('chargeable_weight').value = chargeableWeight.toFixed(2);
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function () {
        const transportationType = document.getElementById('transportation_type');
        const useVolumetric = document.getElementById('use_volumetric');
        const actualWeight = document.getElementById('actual_weight');
        const lengthCm = document.getElementById('length_cm');
        const widthCm = document.getElementById('width_cm');
        const heightCm = document.getElementById('height_cm');
        const form = document.getElementById('shipment-create-form');
        const submitButton = document.getElementById('submit-shipment-button');

        if (transportationType) {
            transportationType.addEventListener('change', updateTransportDetails);
            updateTransportDetails();
        }

        if (useVolumetric) {
            useVolumetric.addEventListener('change', handleVolumetricToggle);
        }

        if (actualWeight || lengthCm || widthCm || heightCm) {
            [actualWeight, lengthCm, widthCm, heightCm].forEach(el => {
                if (el) {
                    el.addEventListener('input', calculateWeights);
                }
            });
        }

        if (form && submitButton) {
            form.addEventListener('submit', function () {
                if (!form.checkValidity()) {
                    return;
                }

                submitButton.disabled = true;
                submitButton.querySelector('span').textContent = 'Menyimpan...';
            });
        }

        // Initial calculations
        handleVolumetricToggle();
        calculateWeights();
    });
</script>
@endsection
