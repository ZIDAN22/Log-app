@extends('layouts.app')

@section('title', 'Daftar Driver')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">

    <div class="mx-auto max-w-[1700px]">

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                    Daftar Driver
                </h1>

                <p class="mt-2 text-slate-600">
                    Kelola semua driver armada dengan cepat, lengkap, dan responsif.
                </p>
            </div>

            <a href="{{ route('drivers.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                </svg>

                Tambah Driver

            </a>

        </div>

        <!-- Success -->
        @if(session('success'))
        <div
            class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">

            {{ session('success') }}

        </div>
        @endif

        <!-- Filter -->
        <form method="GET" action="{{ route('drivers.index') }}"
            class="mb-7 rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6 flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">

                <div>
                    <h2 class="text-xl font-bold text-slate-900">
                        Filter Driver
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Cari driver berdasarkan kode, nama, atau status.
                    </p>
                </div>

            </div>

            <div class="grid gap-5 lg:grid-cols-3">

                <!-- Search -->
                <div class="lg:col-span-2">

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Cari Driver
                    </label>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Nama, Kode, No HP, No SIM"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />

                </div>

                <!-- Status -->
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Status
                    </label>

                    <select name="status"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">

                        <option value="">Semua Status</option>

                        @foreach(App\Models\Driver::statuses() as $status)

                        <option value="{{ $status }}" {{ request('status')===$status ? 'selected' : '' }}>

                            {{ $status }}

                        </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <!-- Action -->
            <div class="mt-6 flex flex-wrap justify-end gap-3">

                <a href="{{ route('drivers.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">

                    Reset

                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                    Terapkan Filter

                </button>

            </div>

        </form>

        <!-- Table -->
        <div class="overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h2 class="text-xl font-bold text-slate-900">
                            Data Driver
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Tabel driver dengan status, lisensi, dan aksi CRUD.
                        </p>

                    </div>

                    <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">

                        Total Driver: {{ $drivers->total() }}

                    </div>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1000px] border-collapse">

                    <thead class="bg-slate-900 text-white">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Foto
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Kode Driver
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Nama Driver
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                No HP
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Jenis SIM
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">

                        @forelse($drivers as $driver)

                        @php
                        $style = App\Models\Driver::statusStyles()[$driver->status]
                        ?? [
                        'bg' => 'bg-slate-100',
                        'text' => 'text-slate-700',
                        'dot' => 'bg-slate-400'
                        ];
                        @endphp

                        <tr class="transition hover:bg-slate-50">

                            <!-- Foto -->
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="h-12 w-12 overflow-hidden rounded-2xl bg-slate-100">

                                        @if($driver->photo_path)

                                        <img src="{{ asset('storage/' . $driver->photo_path) }}"
                                            alt="{{ $driver->name }}" class="h-full w-full object-cover" />

                                        @else

                                        <div
                                            class="flex h-full w-full items-center justify-center text-sm font-semibold text-slate-500">

                                            DR

                                        </div>

                                        @endif

                                    </div>

                                </div>

                            </td>

                            <!-- Code -->
                            <td class="px-6 py-5 text-sm font-semibold text-slate-900">
                                {{ $driver->code }}
                            </td>

                            <!-- Name -->
                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $driver->name }}
                            </td>

                            <!-- Phone -->
                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $driver->phone }}
                            </td>

                            <!-- License -->
                            <td class="px-6 py-5 text-sm text-slate-700">
                                {{ $driver->license_type }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-5">

                                <span
                                    class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ $style['bg'] }} {{ $style['text'] }}">

                                    <span class="h-2.5 w-2.5 rounded-full {{ $style['dot'] }}"></span>

                                    {{ $driver->status }}

                                </span>

                            </td>

                            <!-- Action -->
                            <td class="px-6 py-5 text-center">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- Detail -->
                                    <a href="{{ route('drivers.show', $driver) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700 transition hover:bg-slate-200"
                                        title="Detail Driver">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                        </svg>

                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('drivers.edit', $driver) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 transition hover:bg-amber-200"
                                        title="Edit Driver">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />

                                        </svg>

                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('drivers.destroy', $driver) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Hapus driver ini?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-700 transition hover:bg-red-200"
                                            title="Hapus Driver">

                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />

                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div
                                        class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">

                                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5V4H2v16h5m10 0v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4m10 0H7" />

                                        </svg>

                                    </div>

                                    <h3 class="text-lg font-semibold text-slate-900">
                                        Data Driver Tidak Ditemukan
                                    </h3>

                                    <p class="mt-2 text-sm text-slate-500">
                                        Tambahkan driver baru untuk mulai mengelola armada.
                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Pagination -->
        <div class="mt-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <p class="text-sm text-slate-600">

                Menampilkan
                <strong>{{ $drivers->firstItem() ?? 0 }}</strong>
                sampai
                <strong>{{ $drivers->lastItem() ?? 0 }}</strong>
                dari
                <strong>{{ $drivers->total() }}</strong>
                hasil

            </p>

            <div>
                {{ $drivers->links() }}
            </div>

        </div>

    </div>

</div>
@endsection