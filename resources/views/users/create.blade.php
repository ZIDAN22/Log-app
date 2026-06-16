@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        {{-- Header --}}
        <div class="mb-5 flex items-end justify-between border-b border-slate-200 pb-5">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">USER MANAGEMENT</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Tambah User</h1>
                <p class="mt-2 text-sm leading-6 text-slate-600">Buat akun internal baru dan atur hak akses sesuai jabatan.</p>
            </div>
            <a href="{{ route('users.index') }}" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Kembali
            </a>
        </div>

        <div class="grid gap-6 xl:grid-cols-3">
            <div class="xl:col-span-2">
                <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 px-6 py-4">
                        <h2 class="text-base font-bold text-slate-950">Form User</h2>
                        <p class="mt-1 text-sm text-slate-500">Tambahkan pengguna baru dengan hak akses yang sesuai.</p>
                    </div>

                    <form action="{{ route('users.store') }}" method="POST" class="space-y-6 px-6 py-5">
                        @csrf

                        @if($errors->any())
                        <div class="rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">
                            Periksa kembali form, terdapat beberapa input yang belum valid.
                        </div>
                        @endif

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Full Name</label>
                                <input id="name" name="name" value="{{ old('name') }}" required class="h-11 w-full rounded-lg border border-slate-300 bg-slate-50 px-4 text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>
                            <div>
                                <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="h-11 w-full rounded-lg border border-slate-300 bg-slate-50 px-4 text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>
                            <div>
                                <label for="phone" class="mb-2 block text-sm font-semibold text-slate-700">Phone</label>
                                <input id="phone" name="phone" value="{{ old('phone') }}" required class="h-11 w-full rounded-lg border border-slate-300 bg-slate-50 px-4 text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>
                            <div>
                                <label for="role" class="mb-2 block text-sm font-semibold text-slate-700">Role</label>
                                <select id="role" name="role" required class="h-11 w-full rounded-lg border border-slate-300 bg-white px-4 text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                    @foreach($roles as $value => $label)
                                    <option value="{{ $value }}" @selected(old('role') === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                                <select id="status" name="status" required class="h-11 w-full rounded-lg border border-slate-300 bg-white px-4 text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                    @foreach($statuses as $value => $label)
                                    <option value="{{ $value }}" @selected(old('status') === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                                <input id="password" name="password" type="password" required class="h-11 w-full rounded-lg border border-slate-300 bg-slate-50 px-4 text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>
                            <div>
                                <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" required class="h-11 w-full rounded-lg border border-slate-300 bg-slate-50 px-4 text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
                            <a href="{{ route('users.index') }}" class="inline-flex h-11 items-center justify-center rounded-lg border border-slate-300 bg-white px-6 text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
                            <button type="submit" class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-6 text-sm font-semibold text-white hover:bg-blue-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan User
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div>
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="font-bold text-slate-950">Panduan</h3>
                    <div class="mt-4 space-y-3 text-sm text-slate-600">
                        <div>
                            <p class="font-semibold text-slate-900">1. Masukkan data lengkap</p>
                            <p>Lengkapi nama, email, telepon, dan peran pengguna.</p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">2. Tentukan status</p>
                            <p>Pilih status akun aktif atau nonaktif sesuai kebutuhan.</p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">3. Jaga keamanan password</p>
                            <p>Gunakan password yang kuat dan mudah diingat oleh user.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
