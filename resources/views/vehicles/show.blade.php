@extends('layouts.app')

@section('title', 'Detail Kendaraan')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Detail Kendaraan</h1>
                <p class="mt-2 text-slate-600">Informasi lengkap kendaraan dengan tampilan detail yang rapi dan responsif.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('vehicles.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <a href="{{ route('vehicles.edit', $vehicle) }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232a2.062 2.062 0 0 1 2.916 2.916L7.75 18.646a.75.75 0 0 1-.338.197l-4 1a.75.75 0 0 1-.928-.928l1-4a.75.75 0 0 1 .197-.338l10.75-10.75Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 5l3 3" />
                    </svg>
                    Edit
                </a>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[420px_1fr]">
            <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col items-center gap-5 text-center">
                    <div class="h-48 w-48 overflow-hidden rounded-[32px] bg-slate-100 shadow-sm">
                        @if($vehicle->photo_path)
                        <img src="{{ asset('storage/' . $vehicle->photo_path) }}" alt="{{ $vehicle->name }}" class="h-full w-full object-cover" />
                        @else
                        <div class="flex h-full w-full items-center justify-center text-3xl font-semibold text-slate-500">VEH</div>
                        @endif
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">{{ $vehicle->name }}</h2>
                        <p class="text-sm text-slate-500">{{ $vehicle->code }}</p>
                    </div>

                    @php $style = App\Models\Vehicle::statusStyles()[$vehicle->status] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-700']; @endphp
                    <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold {{ $style['bg'] }} {{ $style['text'] }}">
                        <span class="h-2.5 w-2.5 rounded-full {{ $style['dot'] ?? 'bg-slate-400' }}"></span>
                        {{ $vehicle->status }}
                    </span>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-5 text-xl font-bold text-slate-900">Informasi Kendaraan</h2>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">Kode Kendaraan</p>
                            <p class="text-base font-semibold text-slate-900">{{ $vehicle->code }}</p>
                        </div>
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">Jenis Kendaraan</p>
                            <p class="text-base font-semibold text-slate-900">{{ $vehicle->vehicle_type }}</p>
                        </div>
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">Plat Nomor</p>
                            <p class="text-base font-semibold text-slate-900">{{ $vehicle->license_plate }}</p>
                        </div>
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">Warna</p>
                            <p class="text-base font-semibold text-slate-900">{{ $vehicle->color }}</p>
                        </div>
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">Tahun Kendaraan</p>
                            <p class="text-base font-semibold text-slate-900">{{ $vehicle->year }}</p>
                        </div>
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">Kapasitas Berat</p>
                            <p class="text-base font-semibold text-slate-900">{{ number_format($vehicle->weight_capacity, 0) }} Kg</p>
                        </div>
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">Kapasitas Volume</p>
                            <p class="text-base font-semibold text-slate-900">{{ number_format($vehicle->volume_capacity, 2) }} M³</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-5 text-xl font-bold text-slate-900">Histori Outbound</h2>
                    <div class="rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center text-sm text-slate-500">
                        Belum ada riwayat outbound untuk kendaraan ini.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
