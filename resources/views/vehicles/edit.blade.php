@extends('layouts.app')

@section('title', 'Edit Kendaraan')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">
    <div class="mx-auto max-w-[1100px]">
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Edit Kendaraan</h1>
                <p class="mt-2 text-slate-600"></p>
            </div>
            <a href="{{ route('vehicles.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4.5 w-4.5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
                Kembali ke daftar
            </a>
        </div>

        @if($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-800 shadow-sm">
            Periksa kembali form, terdapat beberapa input yang belum valid.
        </div>
        @endif

        <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-6 text-xl font-bold text-slate-900">Form Edit Kendaraan</h2>
            <form action="{{ route('vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                @include('vehicles._form')
                @include('components.form-action-buttons', [
                    'backUrl' => route('vehicles.index'),
                    'backLabel' => 'Batal',
                    'submitLabel' => 'Perbarui Kendaraan',
                ])
            </form>
        </div>
    </div>
</div>
@endsection
