@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="space-y-6">
    {{-- Header Profil --}}
    <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-4">
                <div class="relative">
                    @if($user->profile_photo_url)
                        <img src="{{ $user->profile_photo_url }}" alt="Avatar" class="h-20 w-20 rounded-lg object-cover" />
                    @else
                        <div class="flex h-20 w-20 items-center justify-center rounded-lg bg-sky-500 text-3xl font-semibold text-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div>
                    <h2 class="text-2xl font-semibold text-slate-900">{{ $user->name }}</h2>
                    <p class="mt-1 text-sm uppercase text-slate-500">{{ $user->role_label }}</p>

                    <div class="mt-3 flex flex-wrap gap-3 text-sm text-slate-600">
                        <span class="rounded-lg bg-slate-100 px-3 py-2">
                            Status:
                            <strong class="text-slate-900">{{ $user->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}</strong>
                        </span>
                        <span class="rounded-lg bg-slate-100 px-3 py-2">Email: {{ $user->email }}</span>
                        <span class="rounded-lg bg-slate-100 px-3 py-2">No. HP: {{ $user->phone ?? '-' }}</span>
                    </div>

                    <p class="mt-2 text-sm text-slate-500">Login terakhir: {{ $user->last_login?->format('d M Y H:i') ?? '-' }}</p>
                </div>
            </div>

            {{-- <div class="flex flex-col gap-3 sm:flex-row">
                <a href="#account-information" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Edit Profil
                </a>
                <a href="#change-password" class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-50">
                    Ubah Password
                </a>
            </div> --}}
        </div>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-4 text-sm text-emerald-800 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-4 text-sm text-rose-800 shadow-sm">
            <ul class="list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Konten utama --}}
    <div class="grid gap-6 xl:grid-cols-[1.4fr_1fr]">
        {{-- Informasi akun --}}
        <section id="account-information" class="space-y-4 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm uppercase text-slate-400">Informasi Akun</p>
                    <h3 class="mt-2 text-xl font-semibold text-slate-900">Data akun Anda</h3>
                </div>
                <span class="rounded-lg bg-slate-100 px-4 py-2 text-sm text-slate-600">Diperbarui {{ now()->format('d M Y') }}</span>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                        <input id="name" name="name" value="{{ old('name', $user->name) }}" required class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                        @error('name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                        @error('email')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700">Nomor Telepon</label>
                        <input id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                        @error('phone')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Peran</label>
                        <div class="mt-2 rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">{{ $user->role_label }}</div>
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Status Akun</label>
                        <div class="mt-2 rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">{{ $user->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Dibuat Pada</label>
                        <div class="mt-2 rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">{{ $user->created_at->format('d M Y H:i') }}</div>
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </section>

        {{-- Keamanan --}}
        <section id="change-password" class="space-y-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div>
                <p class="text-sm uppercase text-slate-400">Keamanan</p>
                <h3 class="mt-2 text-xl font-semibold text-slate-900">Ubah Password</h3>
            </div>

            <form action="{{ route('profile.change-password') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-slate-700">Password Saat Ini</label>
                    <input id="current_password" name="current_password" type="password" required class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                    @error('current_password')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700">Password Baru</label>
                        <input id="password" name="password" type="password" required class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                        @error('password')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                    </div>
                </div>

                <button type="submit" class="w-full rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Perbarui Password
                </button>
            </form>

  
        </section>
    </div>

    {{-- Aktivitas terbaru --}}
    <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="mt-2 text-xl font-semibold text-slate-900">Tindakan pengguna terakhir</h3>
            </div>
            <span class="rounded-lg bg-slate-100 px-4 py-2 text-sm text-slate-600">Hanya aktivitas terbaru</span>
        </div>

        <div class="mt-6 space-y-4">
            @foreach($recentActivity as $index => $activity)
                <div class="flex items-start gap-4">
                    <div class="mt-1 h-3 w-3 rounded-[4px] bg-sky-500"></div>
                    <div class="flex-1 rounded-lg border border-slate-200 bg-slate-50 p-4 shadow-sm hover:bg-slate-100 transition">
                        <p class="text-sm font-semibold text-slate-900">{{ $activity }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ now()->subMinutes($index * 12)->format('d M Y H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection

