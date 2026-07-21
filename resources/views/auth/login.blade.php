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
                            Login
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

                            <div class="relative">
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    required
                                    placeholder="Masukkan password"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 pr-12 text-slate-900 transition focus:border-cyan-500 focus:outline-none focus:ring-4 focus:ring-cyan-100"
                                >
                                <button type="button" id="togglePassword"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 transition"
                                    aria-label="Toggle password visibility">
                                    <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const toggleBtn = document.getElementById('togglePassword');
                                const passwordInput = document.getElementById('password');
                                const eyeIcon = document.getElementById('eyeIcon');

                                toggleBtn.addEventListener('click', function () {
                                    const isPassword = passwordInput.type === 'password';
                                    passwordInput.type = isPassword ? 'text' : 'password';

                                    if (isPassword) {
                                        eyeIcon.innerHTML =
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />';
                                    } else {
                                        eyeIcon.innerHTML =
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                                    }
                                });
                            });
                        </script>


                        {{-- Button --}}
                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-slate-950 px-5 py-4 text-sm font-semibold text-white transition duration-300 hover:bg-slate-800"
                        >
                            Masuk
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
