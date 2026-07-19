@extends('layouts.app')

@section('title', 'Edit Driver')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        <!-- Header -->
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">DRIVER</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Edit Driver</h1>
            </div>

            <a href="{{ route('drivers.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 18l-6-6 6-6" />
                </svg>
                Kembali ke daftar
            </a>
        </div>

        @if($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-800 shadow-sm">
            Periksa kembali form, terdapat beberapa input yang belum valid.
        </div>
        @endif

        <!-- Form -->
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-xl font-bold text-slate-900">Form Update Driver</h2>
                <p class="mt-1 text-sm text-slate-500">Lengkapi data driver sebelum menyimpan perubahan.</p>
            </div>

            <div class="p-6">
                <form action="{{ route('drivers.update', $driver) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    @include('drivers._form')

                    @include('components.form-action-buttons', [
                        'backUrl' => route('drivers.index'),
                        'backLabel' => 'Batal',
                        'submitLabel' => 'Perbarui Driver',
                    ])
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

