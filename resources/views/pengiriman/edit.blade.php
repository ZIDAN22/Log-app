@extends('layouts.app')

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

                        <!-- Berat -->
                        <div>

                            <label for="total_weight"
                                class="mb-2 block text-sm font-semibold text-slate-700">

                                Berat (KG)
                                <span class="text-red-500">*</span>

                            </label>

                            <input id="total_weight"
                                name="total_weight"
                                value="{{ old('total_weight', $shipment->total_weight) }}"
                                required
                                type="number"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                            @error('total_weight')
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
                <div class="flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                    <!-- Cancel -->
                    <a href="{{ route('pengiriman.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-7 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">

                        <svg class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>

                        </svg>

                        Batal

                    </a>

                    <!-- Submit -->
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-7 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                        <svg class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"></path>

                        </svg>

                        Update Pengiriman

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection