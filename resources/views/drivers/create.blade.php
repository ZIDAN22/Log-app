@extends('layouts.app')

@section('title', 'Tambah Driver')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">
    <div class="mx-auto max-w-[1100px]">
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Tambah Driver</h1>
            </div>
            <a href="{{ route('drivers.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                Kembali ke daftar
            </a>
        </div>

        @if($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-800 shadow-sm">
            Periksa kembali form, terdapat beberapa input yang belum valid.
        </div>
        @endif

        <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-6 text-xl font-bold text-slate-900">Form Driver</h2>
            <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @include('drivers._form')
                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('drivers.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Batal</a>
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">Simpan Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
