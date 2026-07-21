@extends('layouts.app')

@section('title', 'Buat Pengiriman Baru')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Pengiriman</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Buat Pengiriman Baru
                </h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    Catat data pengirim, penerima, detail barang, dan jadwal pickup dalam satu formulir operasional.
                </p>
            </div>

            <a
                href="{{ route('pengiriman.index') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
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
                        <div class="mb-5 flex flex-col gap-3 border-b border-slate-200 pb-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-base font-bold text-slate-950">Nomor Dokumen</h2>
                                <p class="mt-1 text-sm text-slate-500">Nomor akan diterbitkan setelah pengiriman tersimpan.</p>
                            </div>
                            <span class="inline-flex w-fit items-center rounded-md bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                Otomatis
                            </span>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">No Invoice</label>
                                <input
                                    type="text"
                                    disabled
                                    placeholder="Dibuat otomatis saat disimpan"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500"
                                />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">No Resi</label>
                                <input
                                    type="text"
                                    disabled
                                    placeholder="Dibuat otomatis saat disimpan"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500"
                                />
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
                                <input
                                    id="sender_name"
                                    name="sender_name"
                                    value="{{ old('sender_name') }}"
                                    required
                                    type="text"
                                    placeholder="Nama lengkap pengirim"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                />

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
                                <input
                                    id="receiver_name"
                                    name="receiver_name"
                                    value="{{ old('receiver_name') }}"
                                    required
                                    type="text"
                                    placeholder="Nama lengkap penerima"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                />

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
                            <p class="mt-1 text-sm text-slate-500">Rincian muatan, biaya, transportasi, dan tanggal pickup.</p>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                            <div>
                                <label for="item_type" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Jenis Barang
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input
                                    id="item_type"
                                    name="item_type"
                                    value="{{ old('item_type') }}"
                                    required
                                    type="text"
                                    placeholder="Contoh: Elektronik"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                />
                                @error('item_type')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="total_weight" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Berat Total (KG)
                                    <span class="text-rose-500">*</span>
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
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                />
                                @error('total_weight')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price_per_kg" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Harga per KG
                                    <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-500">Rp</span>
                                    <input
                                        id="price_per_kg"
                                        name="price_per_kg"
                                        value="{{ old('price_per_kg') }}"
                                        required
                                        type="number"
                                        min="0"
                                        step="0.01"
                                        placeholder="0.00"
                                        class="h-11 w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                    />
                                </div>
                                @error('price_per_kg')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="transportation_type" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Transportasi
                                    <span class="text-rose-500">*</span>
                                </label>
                                <select
                                    id="transportation_type"
                                    name="transportation_type"
                                    required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                >
                                    <option value="">Pilih transportasi</option>
                                    <option value="darat" {{ old('transportation_type') === 'darat' ? 'selected' : '' }}>Darat</option>
                                    <option value="laut" {{ old('transportation_type') === 'laut' ? 'selected' : '' }}>Laut</option>
                                    <option value="udara" {{ old('transportation_type') === 'udara' ? 'selected' : '' }}>Udara</option>
                                </select>
                                @error('transportation_type')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_day" class="mb-2 block text-sm font-semibold text-slate-700">Hari Pengiriman</label>
                                <input
                                    id="shipping_day"
                                    name="shipping_day"
                                    value="{{ old('shipping_day') }}"
                                    type="text"
                                    placeholder="Contoh: 3 hari"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                />
                                @error('shipping_day')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="pickup_date" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Tanggal Pickup
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input
                                    id="pickup_date"
                                    name="pickup_date"
                                    value="{{ old('pickup_date', now()->toDateString()) }}"
                                    required
                                    type="date"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                />
                                @error('pickup_date')
                                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="transport-detail-darat" class="rounded-lg border border-slate-200 bg-slate-50 p-4 md:col-span-2 xl:col-span-3" style="display: none;">
                                <div class="grid gap-6 md:grid-cols-2">
                                    <div>
                                        <label for="vehicle_id" class="mb-2 block text-sm font-semibold text-slate-700">Kendaraan Darat</label>
                                        <select
                                            id="vehicle_id"
                                            name="vehicle_id"
                                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                        >
                                            <option value="">Pilih kendaraan</option>
                                            @foreach($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                                    {{ $vehicle->name }} - {{ $vehicle->license_plate }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_id')
                                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="land_departure_date" class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Berangkat Darat</label>
                                        <input
                                            id="land_departure_date"
                                            name="land_departure_date"
                                            value="{{ old('land_departure_date') }}"
                                            type="date"
                                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                        />
                                        @error('land_departure_date')
                                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="transport-detail-laut" class="rounded-lg border border-slate-200 bg-slate-50 p-4 md:col-span-2 xl:col-span-3" style="display: none;">
                                <div class="grid gap-6 md:grid-cols-2">
                                    <div>
                                        <label for="sea_shipping" class="mb-2 block text-sm font-semibold text-slate-700">Pelayaran Laut</label>
                                        <input
                                            id="sea_shipping"
                                            name="sea_shipping"
                                            value="{{ old('sea_shipping') }}"
                                            type="text"
                                            placeholder="Contoh: Dharma Kartika 8"
                                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                        />
                                        @error('sea_shipping')
                                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="sea_departure_date" class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Berangkat Laut</label>
                                        <input
                                            id="sea_departure_date"
                                            name="sea_departure_date"
                                            value="{{ old('sea_departure_date') }}"
                                            type="date"
                                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                        />
                                        @error('sea_departure_date')
                                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="transport-detail-udara" class="rounded-lg border border-slate-200 bg-slate-50 p-4 md:col-span-2 xl:col-span-3" style="display: none;">
                                <div class="grid gap-6 md:grid-cols-2">
                                    <div>
                                        <label for="air_shipping" class="mb-2 block text-sm font-semibold text-slate-700">Pengiriman Udara</label>
                                        <input
                                            id="air_shipping"
                                            name="air_shipping"
                                            value="{{ old('air_shipping') }}"
                                            type="text"
                                            placeholder="Contoh: Lion Air Cargo"
                                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                        />
                                        @error('air_shipping')
                                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="air_departure_date" class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Berangkat Udara</label>
                                        <input
                                            id="air_departure_date"
                                            name="air_departure_date"
                                            value="{{ old('air_departure_date') }}"
                                            type="date"
                                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                        />
                                        @error('air_departure_date')
                                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                        @enderror
                                    </div>
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
                        <textarea
                            id="notes"
                            name="notes"
                            rows="4"
                            placeholder="Catatan khusus untuk pengiriman"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        >{{ old('notes') }}</textarea>

                        @error('notes')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </section>
                </div>

                <aside class="space-y-4 xl:sticky xl:top-6 xl:self-start">
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <h2 class="text-base font-bold text-slate-950">Ringkasan</h2>
                        <dl class="mt-4 space-y-4 text-sm">
                            <div class="flex items-center justify-between gap-4 border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">Status awal</dt>
                                <dd class="font-semibold text-slate-900">Pending Pickup</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4 border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">Tanggal pickup</dt>
                                <dd id="pickup-date-preview" class="font-semibold text-slate-900">{{ old('pickup_date', now()->toDateString()) }}</dd>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <dt class="text-slate-500">Transportasi</dt>
                                <dd id="transport-preview" class="font-semibold text-slate-900">Belum dipilih</dd>
                            </div>
                        </dl>
                    </section>

                    <section class="rounded-lg border border-blue-100 bg-blue-50 p-5 text-sm text-blue-900">
                        <p class="font-semibold">Dokumen otomatis</p>
                        <p class="mt-2 leading-6">
                            No invoice dan no resi dibuat ketika data pengiriman berhasil disimpan.
                        </p>
                    </section>
                </aside>
            </div>

            <div class="flex flex-col gap-3 rounded-lg border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-slate-500">
                    Field bertanda <span class="font-semibold text-rose-500">*</span> wajib diisi.
                </p>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a
                        href="{{ route('pengiriman.index') }}"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>

                    <button
                        id="submit-shipment-button"
                        type="submit"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200 disabled:cursor-not-allowed disabled:bg-blue-400"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Simpan Pengiriman</span>
                    </button>
                </div>
            </div>
        </form>
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
        const labels = {
            darat: 'Darat',
            laut: 'Laut',
            udara: 'Udara',
        };

        Object.keys(sections).forEach(key => {
            sections[key].style.display = key === type ? 'block' : 'none';
        });

        const transportPreview = document.getElementById('transport-preview');
        if (transportPreview) {
            transportPreview.textContent = labels[type] || 'Belum dipilih';
        }
    }

    function updatePickupPreview() {
        const pickupDate = document.getElementById('pickup_date');
        const pickupPreview = document.getElementById('pickup-date-preview');

        if (pickupDate && pickupPreview) {
            pickupPreview.textContent = pickupDate.value || '-';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const transportationType = document.getElementById('transportation_type');
        const pickupDate = document.getElementById('pickup_date');
        const form = document.getElementById('shipment-create-form');
        const submitButton = document.getElementById('submit-shipment-button');

        if (transportationType) {
            transportationType.addEventListener('change', updateTransportDetails);
        }

        if (pickupDate) {
            pickupDate.addEventListener('change', updatePickupPreview);
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

        updateTransportDetails();
        updatePickupPreview();
    });
</script>
@endsection
