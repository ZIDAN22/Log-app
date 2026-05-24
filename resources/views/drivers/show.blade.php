@extends('layouts.app')

@section('title', 'Detail Driver')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Detail Driver</h1>
                <p class="mt-2 text-slate-600">Informasi lengkap driver dengan tampilan detail yang rapi dan responsif.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('drivers.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <a href="{{ route('drivers.edit', $driver) }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
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
                    <div class="h-44 w-44 overflow-hidden rounded-[32px] bg-slate-100 shadow-sm">
                        @if($driver->photo_path)
                        <img src="{{ asset('storage/' . $driver->photo_path) }}" alt="{{ $driver->name }}" class="h-full w-full object-cover" />
                        @else
                        <div class="flex h-full w-full items-center justify-center text-3xl font-semibold text-slate-500">DR</div>
                        @endif
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">{{ $driver->name }}</h2>
                        <p class="text-sm text-slate-500">{{ $driver->code }}</p>
                    </div>

                    @php $style = App\Models\Driver::statusStyles()[$driver->status] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-700']; @endphp
                    <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold {{ $style['bg'] }} {{ $style['text'] }}">
                        <span class="h-2.5 w-2.5 rounded-full {{ $style['dot'] ?? 'bg-slate-400' }}"></span>
                        {{ $driver->status }}
                    </span>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-5 text-xl font-bold text-slate-900">Informasi Driver</h2>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">Kode Driver</p>
                            <p class="text-base font-semibold text-slate-900">{{ $driver->code }}</p>
                        </div>
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">No HP</p>
                            <p class="text-base font-semibold text-slate-900">{{ $driver->phone }}</p>
                        </div>
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">No SIM</p>
                            <p class="text-base font-semibold text-slate-900">{{ $driver->license_number }}</p>
                        </div>
                        <div class="space-y-2 rounded-3xl border border-slate-100 bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-600">Jenis SIM</p>
                            <p class="text-base font-semibold text-slate-900">{{ $driver->license_type }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-5 text-xl font-bold text-slate-900">Alamat</h2>
                    <p class="text-sm leading-7 text-slate-700">{{ $driver->address ?? 'Belum ada alamat yang ditambahkan.' }}</p>
                </div>

                <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Histori Outbound</h2>
                            <p class="mt-1 text-sm text-slate-500">Catatan tugas keluar dan pengiriman driver.</p>
                        </div>
                    </div>
                    <div class="mt-5 rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center text-sm text-slate-500">
                        Belum ada riwayat outbound untuk driver ini.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
