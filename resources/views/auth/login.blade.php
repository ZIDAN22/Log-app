@extends('layouts.auth')

@section('title', 'Masuk | PT Berlian Lintas Logistik')

@section('content')
<div
    class="relative min-h-screen overflow-hidden bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('images/bg.png') }}');"
>

    {{-- Overlay Background --}}
    <div class="absolute inset-0 bg-slate-950/65"></div>

    {{-- Main Container --}}
    <div class="relative z-10 flex min-h-screen items-center justify-center px-6">

        <div class="grid w-full max-w-6xl overflow-hidden rounded-[36px] bg-white/10 shadow-[0_25px_80px_rgba(0,0,0,0.4)] backdrop-blur-xl md:grid-cols-2">

            {{-- LEFT IMAGE --}}
            <div class="relative hidden md:block">

                <img
                    src="{{ asset('images/bll.png') }}"
                    alt="PT Berlian Lintas Logistik"
                    class="h-full w-full object-cover"
                >

                {{-- overlay image --}}
                <div class="absolute inset-0 bg-slate-950/30"></div>

                {{-- company title --}}
                <div class="absolute bottom-10 left-10 text-white">
                    <h1 class="text-4xl font-bold">
                        PT Berlian Lintas Logistik
                    </h1>

                    <p class="mt-2 text-slate-200">
                        Sistem Internal Perusahaan
                    </p>
                </div>
            </div>

            {{-- RIGHT LOGIN FORM --}}
            <div class="flex items-center justify-center bg-white p-10 lg:p-14">

                <div class="w-full max-w-md">

                    {{-- Header --}}
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-slate-900">
                            Sign In
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Silakan login ke akun Anda
                        </p>
                    </div>

                    {{-- Error --}}
                    @if($errors->any())
                        <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- Login Form --}}
                    <form method="POST" action="{{ route('login.process') }}" class="space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="Masukkan email"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-900 transition focus:border-cyan-500 focus:outline-none focus:ring-4 focus:ring-cyan-100"
                            >
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                placeholder="Masukkan password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-900 transition focus:border-cyan-500 focus:outline-none focus:ring-4 focus:ring-cyan-100"
                            >
                        </div>

                        {{-- Remember --}}
                        <div class="flex items-center">
                            <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"
                                >
                                Remember me
                            </label>
                        </div>

                        {{-- Button --}}
                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-slate-950 px-5 py-4 text-sm font-semibold text-white transition duration-300 hover:bg-slate-800"
                        >
                            Sign In
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
