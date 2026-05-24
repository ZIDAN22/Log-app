@php
$statusOptions = App\Models\Driver::statuses();
$licenseTypes = App\Models\Driver::licenseTypes();
@endphp

<div class="grid gap-6 lg:grid-cols-2">
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Driver</label>
        <input type="text" name="name" value="{{ old('name', isset($driver) ? $driver->name : '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">No HP</label>
        <input type="text" name="phone" value="{{ old('phone', isset($driver) ? $driver->phone : '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('phone')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">No SIM</label>
        <input type="text" name="license_number" value="{{ old('license_number', isset($driver) ? $driver->license_number : '') }}"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('license_number')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis SIM</label>
        <select name="license_type"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100">
            <option value="">Pilih Jenis SIM</option>
            @foreach($licenseTypes as $type)
            <option value="{{ $type }}" {{ old('license_type', isset($driver) ? $driver->license_type : '') === $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
        @error('license_type')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div class="lg:col-span-2">
        <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat</label>
        <textarea name="address" rows="4"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100">{{ old('address', isset($driver) ? $driver->address : '') }}</textarea>
        @error('address')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Status Driver</label>
        <select name="status"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100">
            <option value="">Pilih Status</option>
            @foreach($statusOptions as $status)
            <option value="{{ $status }}" {{ old('status', isset($driver) ? $driver->status : '') === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
        @error('status')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Driver</label>
        <input type="file" name="photo"
            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-100" />
        @error('photo')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror

        @if(isset($driver) && ! empty($driver->photo_path))
        <div class="mt-4 flex items-center gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <img src="{{ asset('storage/' . $driver->photo_path) }}" alt="Foto Driver" class="h-20 w-20 rounded-2xl object-cover" />
            <div>
                <p class="font-semibold text-slate-900">Foto saat ini</p>
                <p class="text-sm text-slate-600">Unggah foto baru untuk menggantikan yang lama.</p>
            </div>
        </div>
        @endif
    </div>
</div>
