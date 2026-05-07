@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Buat Pengiriman Baru</h1>
            <p class="text-slate-600">Isi data pengiriman untuk membuat shipment baru.</p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('pengiriman.store') }}" class="space-y-8 p-6 sm:p-8">
                @csrf

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <div class="grid gap-6 lg:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">No Invoice</label>
                            <input type="text" disabled placeholder="Auto generated on save" class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-600" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">No Resi</label>
                            <input type="text" disabled placeholder="Auto generated on save" class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-600" />
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Informasi Pengiriman</h2>
                    <div class="grid gap-6 lg:grid-cols-2">
                        <div>
                            <label for="sender_name" class="block text-sm font-medium text-slate-700 mb-2">Pengirim <span class="text-red-500">*</span></label>
                            <input id="sender_name" name="sender_name" value="{{ old('sender_name') }}" required type="text" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Nama Pengirim" />
                            @error('sender_name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="receiver_name" class="block text-sm font-medium text-slate-700 mb-2">Penerima <span class="text-red-500">*</span></label>
                            <input id="receiver_name" name="receiver_name" value="{{ old('receiver_name') }}" required type="text" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Nama Penerima" />
                            @error('receiver_name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="lg:col-span-2">
                            <label for="pickup_address" class="block text-sm font-medium text-slate-700 mb-2">Alamat Pickup <span class="text-red-500">*</span></label>
                            <textarea id="pickup_address" name="pickup_address" rows="3" required class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Alamat lengkap pengambilan barang">{{ old('pickup_address') }}</textarea>
                            @error('pickup_address')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="lg:col-span-2">
                            <label for="destination_city" class="block text-sm font-medium text-slate-700 mb-2">Tujuan <span class="text-red-500">*</span></label>
                            <input id="destination_city" name="destination_city" value="{{ old('destination_city') }}" required type="text" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Kota tujuan" />
                            @error('destination_city')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="item_type" class="block text-sm font-medium text-slate-700 mb-2">Jenis Barang <span class="text-red-500">*</span></label>
                            <input id="item_type" name="item_type" value="{{ old('item_type') }}" required type="text" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Contoh: Elektronik" />
                            @error('item_type')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="total_weight" class="block text-sm font-medium text-slate-700 mb-2">Berat (KG) <span class="text-red-500">*</span></label>
                            <input id="total_weight" name="total_weight" value="{{ old('total_weight') }}" required type="number" min="0" step="0.01" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="0.00" />
                            @error('total_weight')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="price_per_kg" class="block text-sm font-medium text-slate-700 mb-2">Harga per KG (Rp) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">Rp</span>
                                <input id="price_per_kg" name="price_per_kg" value="{{ old('price_per_kg') }}" required type="number" min="0" step="0.01" class="w-full rounded-2xl border border-slate-300 bg-white px-12 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="0.00" />
                            </div>
                            @error('price_per_kg')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="transportation_type" class="block text-sm font-medium text-slate-700 mb-2">Transportasi <span class="text-red-500">*</span></label>
                            <select id="transportation_type" name="transportation_type" required class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                <option value="">Pilih transportasi</option>
                                <option value="darat" {{ old('transportation_type') === 'darat' ? 'selected' : '' }}>Darat</option>
                                <option value="laut" {{ old('transportation_type') === 'laut' ? 'selected' : '' }}>Laut</option>
                                <option value="udara" {{ old('transportation_type') === 'udara' ? 'selected' : '' }}>Udara</option>
                            </select>
                            @error('transportation_type')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="pickup_date" class="block text-sm font-medium text-slate-700 mb-2">Pickup Date <span class="text-red-500">*</span></label>
                            <input id="pickup_date" name="pickup_date" value="{{ old('pickup_date', now()->toDateString()) }}" required type="date" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            @error('pickup_date')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Catatan Pengiriman</h2>
                    <label for="notes" class="block text-sm font-medium text-slate-700 mb-2">Notes</label>
                    <textarea id="notes" name="notes" rows="4" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Catatan khusus untuk pengiriman">{{ old('notes') }}</textarea>
                    @error('notes')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('pengiriman.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100">Batal</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Simpan Pengiriman</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
