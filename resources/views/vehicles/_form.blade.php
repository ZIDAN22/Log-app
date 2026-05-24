@php
$statusOptions = App\Models\Vehicle::statuses();
$vehicleTypes = App\Models\Vehicle::vehicleTypes();
$currentYear = date('Y');
@endphp

<div class="grid gap-6 lg:grid-cols-2">
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Kendaraan</label>
        <input type="text" name="name" value="{{ old('name', isset($vehicle) ? $vehicle->name : '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis Kendaraan</label>
        <select name="vehicle_type"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100">
            <option value="">Pilih Jenis Kendaraan</option>
            @foreach($vehicleTypes as $type)
            <option value="{{ $type }}" {{ old('vehicle_type', isset($vehicle) ? $vehicle->vehicle_type : '') === $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
        @error('vehicle_type')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Plat Nomor</label>
        <input type="text" name="license_plate" value="{{ old('license_plate', isset($vehicle) ? $vehicle->license_plate : '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('license_plate')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Warna Kendaraan</label>
        <input type="text" name="color" value="{{ old('color', isset($vehicle) ? $vehicle->color : '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('color')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Kapasitas Berat (Kg)</label>
        <input type="number" name="weight_capacity" step="0.01" value="{{ old('weight_capacity', isset($vehicle) ? $vehicle->weight_capacity : '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('weight_capacity')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Kapasitas Volume (M³)</label>
        <input type="number" name="volume_capacity" step="0.01" value="{{ old('volume_capacity', isset($vehicle) ? $vehicle->volume_capacity : '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('volume_capacity')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Tahun Kendaraan</label>
        <input type="number" name="year" value="{{ old('year', isset($vehicle) ? $vehicle->year : '') }}" min="1900" max="{{ $currentYear }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('year')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Status Kendaraan</label>
        <select name="status"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100">
            <option value="">Pilih Status</option>
            @foreach($statusOptions as $status)
            <option value="{{ $status }}" {{ old('status', isset($vehicle) ? $vehicle->status : '') === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
        @error('status')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Kendaraan</label>
        <input type="file" name="photo"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('photo')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror

        @if(isset($vehicle) && ! empty($vehicle->photo_path))
        <div class="mt-4 flex items-center gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <img src="{{ asset('storage/' . $vehicle->photo_path) }}" alt="Foto Kendaraan" class="h-20 w-20 rounded-2xl object-cover" />
            <div>
                <p class="font-semibold text-slate-900">Foto saat ini</p>
                <p class="text-sm text-slate-600">Unggah foto baru untuk menggantikan yang lama.</p>
            </div>
        </div>
        @endif
    </div>
</div>
