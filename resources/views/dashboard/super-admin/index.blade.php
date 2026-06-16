@extends('layouts.app')

@section('title', 'Dashboard Manajer')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-12 2xl:px-16">
    <div class="mx-auto w-full max-w-6xl">
        <section class="overflow-hidden rounded-3xl bg-slate-950 p-8 shadow-xl shadow-slate-900/20">
            <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <span class="inline-flex rounded-full bg-emerald-500/10 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-emerald-300">Dashboard Manajer</span>
                    <h1 class="mt-4 text-4xl font-bold tracking-tight text-white">Selamat datang, {{ auth()->user()->name }}</h1>
                    <p class="mt-3 max-w-2xl text-slate-300">Kelola pengguna internal, tinjau aktivitas operasional, dan awasi kinerja semua tim logistik dari satu pusat kontrol.</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-6 text-center">
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Role saat ini</p>
                    <p class="mt-3 text-3xl font-semibold text-white">{{ auth()->user()->role_label }}</p>
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                <article class="rounded-3xl bg-slate-900 p-6 ring-1 ring-white/10">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Manajemen Pengguna</h2>
                    <p class="mt-4 text-lg font-semibold text-white">Buat, edit, dan kelola akses internal.</p>
                    <a href="{{ route('users.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-emerald-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-400">Buka User Management</a>
                </article>

                <article class="rounded-3xl bg-slate-900 p-6 ring-1 ring-white/10">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Laporan Keuangan</h2>
                    <p class="mt-4 text-lg font-semibold text-white">Lihat status invoice, pembayaran, dan arus kas.</p>
                    <a href="{{ route('finance.reports.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-cyan-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-cyan-400">Buka Laporan</a>
                </article>

                <article class="rounded-3xl bg-slate-900 p-6 ring-1 ring-white/10">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Operasional</h2>
                    <p class="mt-4 text-lg font-semibold text-white">Monitor pengiriman, armada, gudang, dan proses logistik.</p>
<a href="{{ route('dashboard') }}" class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-12 py-3 text-sm font-semibold text-white transition hover:bg-sky-400">Buka Dashboard Operasional</a>
                </article>
            </div>
        </section>
    </div>
</div>
@endsection
