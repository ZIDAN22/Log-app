@extends('layouts.app')

@section('title', 'Dashboard Warehouse')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-12 2xl:px-16">
    <div class="mx-auto w-full max-w-6xl">
        <section class="rounded-3xl bg-white p-8 shadow-lg shadow-slate-900/5">
            <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <span class="inline-flex rounded-full bg-orange-500/10 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-orange-500">Dashboard Warehouse</span>
                    <h1 class="mt-4 text-4xl font-bold tracking-tight text-slate-900">Selamat datang, {{ auth()->user()->name }}</h1>
                    <p class="mt-3 max-w-2xl text-slate-500">Kelola stok, inbound, outbound, dan aktivitas gudang secara efisien.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center">
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Role</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ auth()->user()->role_label }}</p>
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                <article class="rounded-3xl border border-slate-200 p-6">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Stok Barang</h2>
                    <p class="mt-4 text-lg font-semibold text-slate-900">Monitor jumlah dan status stok gudang.</p>
                    <a href="{{ route('inbound.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-orange-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-orange-400">Lihat Barang Masuk</a>
                </article>
                <article class="rounded-3xl border border-slate-200 p-6">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Packing List</h2>
                    <p class="mt-4 text-lg font-semibold text-slate-900">Kelola dokumen packing dan persiapan pengiriman.</p>
                    <a href="{{ route('packing-list.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-orange-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-orange-400">Lihat Packing List</a>
                </article>
                <article class="rounded-3xl border border-slate-200 p-6">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Outbound</h2>
                    <p class="mt-4 text-lg font-semibold text-slate-900">Track pengeluaran barang dari gudang dan jadwal keluar.</p>
                    <a href="{{ route('warehouse.outbound.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-orange-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-orange-400">Lihat Barang Keluar</a>
                </article>
            </div>
        </section>
    </div>
</div>
@endsection
