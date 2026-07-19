@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">
    <div class="mx-auto max-w-[860px]">
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Tambah Pengguna</h1>
            </div>
            <a href="{{ route('users.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                Kembali ke daftar
            </a>
        </div>

        @if($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-800 shadow-sm">
            Periksa kembali form, terdapat beberapa input yang belum valid.
        </div>
        @endif

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6 flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Form Tambah User</h2>
                    <p class="mt-2 text-sm text-slate-600">Semua kolom wajib diisi.</p>
                </div>
            </div>

            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700">Full Name</label>
                        <input id="name" name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700">Phone</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}" required class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-slate-700">Role</label>
                        <select id="role" name="role" required class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100">
                            @foreach($roles as $value => $label)
                                <option value="{{ $value }}" @selected(old('role') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                        <select id="status" name="status" required class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100">
                            @foreach($statuses as $value => $label)
                                <option value="{{ $value }}" @selected(old('status') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <div class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-4">
                            <h3 class="mb-2 text-sm font-semibold text-slate-900">Konfirmasi Password</h3>
                            @include('users._password_fields', ['mode' => 'create'])
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    @include('components.form-action-buttons', [
                        'backUrl' => route('users.index'),
                        'backLabel' => 'Batal',
                        'submitLabel' => 'Simpan User',
                        'submitIcon' => true,
                        'cancelIcon' => true,
                    ])
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
