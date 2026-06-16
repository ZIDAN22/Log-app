@extends('layouts.app')

@section('title', 'Profile Saya')

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl bg-white p-6 shadow-lg ring-1 ring-slate-200">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-4">
                <div class="relative">
                    @if($user->profile_photo_url)
                        <img src="{{ $user->profile_photo_url }}" alt="Avatar" class="h-20 w-20 rounded-3xl object-cover" />
                    @else
                        <div class="flex h-20 w-20 items-center justify-center rounded-3xl bg-sky-500 text-3xl font-semibold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    @endif
                </div>
                <div>
                    <h2 class="text-2xl font-semibold text-slate-900">{{ $user->name }}</h2>
                    <p class="mt-1 text-sm uppercase tracking-[0.2em] text-slate-500">{{ $user->role_label }}</p>
                    <div class="mt-3 flex flex-wrap gap-3 text-sm text-slate-600">
                        <span class="rounded-2xl bg-slate-100 px-3 py-2">Status: <strong class="text-slate-900">{{ $user->status === 'active' ? 'Active' : 'Inactive' }}</strong></span>
                        <span class="rounded-2xl bg-slate-100 px-3 py-2">Email: {{ $user->email }}</span>
                        <span class="rounded-2xl bg-slate-100 px-3 py-2">Phone: {{ $user->phone ?? '-' }}</span>
                    </div>
                    <p class="mt-2 text-sm text-slate-500">Last login: {{ $user->last_login?->format('d M Y H:i') ?? '-' }}</p>
                </div>
            </div>
            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="#account-information" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Edit Profile</a>
                <a href="#change-password" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-50">Change Password</a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 px-4 py-4 text-sm text-emerald-800 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-3xl border border-rose-200 bg-rose-50 px-4 py-4 text-sm text-rose-800 shadow-sm">
            <ul class="list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid gap-6 xl:grid-cols-[1.4fr_1fr]">
        <section id="account-information" class="space-y-4 rounded-3xl bg-white p-6 shadow-lg ring-1 ring-slate-200">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Account Information</p>
                    <h3 class="mt-2 text-xl font-semibold text-slate-900">Data akun anda</h3>
                </div>
                <span class="rounded-2xl bg-slate-100 px-4 py-2 text-sm text-slate-600">Updated {{ now()->format('d M Y') }}</span>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700">Full Name</label>
                        <input id="name" name="name" value="{{ old('name', $user->name) }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                        @error('name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                        @error('email')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700">Phone Number</label>
                        <input id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                        @error('phone')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Role</label>
                        <div class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">{{ $user->role_label }}</div>
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Account Status</label>
                        <div class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">{{ $user->status === 'active' ? 'Active' : 'Inactive' }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Created At</label>
                        <div class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">{{ $user->created_at->format('d M Y H:i') }}</div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Simpan Perubahan</button>
                </div>
            </form>
        </section>

        <section class="space-y-6 rounded-3xl bg-white p-6 shadow-lg ring-1 ring-slate-200">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Security</p>
                <h3 class="mt-2 text-xl font-semibold text-slate-900">Change Password</h3>
            </div>

            <form id="change-password" action="{{ route('profile.change-password') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-slate-700">Current Password</label>
                    <input id="current_password" name="current_password" type="password" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                    @error('current_password')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700">New Password</label>
                        <input id="password" name="password" type="password" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                        @error('password')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                    </div>
                </div>

                <button type="submit" class="w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Update Password</button>
            </form>

            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
                <p class="font-semibold text-slate-900">Password security</p>
                <p class="mt-2">Gunakan password kuat dengan huruf besar, angka, dan simbol untuk menjaga akun PT Berlian Lintas Logistik tetap aman.</p>
            </div>
        </section>
    </div>

    <section class="rounded-3xl bg-white p-6 shadow-lg ring-1 ring-slate-200">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Recent Activity</p>
                <h3 class="mt-2 text-xl font-semibold text-slate-900">Latest user actions</h3>
            </div>
            <span class="rounded-2xl bg-slate-100 px-4 py-2 text-sm text-slate-600">Only the latest activity</span>
        </div>

        <div class="mt-6 space-y-4">
            @foreach($recentActivity as $index => $activity)
                <div class="flex items-start gap-4">
                    <div class="mt-1 h-3 w-3 rounded-full bg-sky-500"></div>
                    <div class="flex-1 rounded-3xl border border-slate-200 bg-slate-50 p-4 shadow-sm">
                        <p class="text-sm font-semibold text-slate-900">{{ $activity }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ now()->subMinutes($index * 12)->format('d M Y H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
