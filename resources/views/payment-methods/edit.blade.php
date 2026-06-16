@extends('layouts.app')

@section('title', 'Edit Metode Pembayaran')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">
                    Keuangan
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Edit Metode Pembayaran
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    Perbarui informasi rekening atau metode pembayaran untuk invoice.
                </p>
            </div>

            <a href="{{ route('payment-methods.index') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">

                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>

                Kembali
            </a>
        </div>

        @if ($errors->any())
        <div class="mb-5 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            <p class="font-semibold">Ada data yang perlu diperbaiki.</p>
            <p class="mt-1">Periksa kembali field metode pembayaran sebelum menyimpan.</p>
        </div>
        @endif

        <form action="{{ route('payment-methods.update', $paymentMethod) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-8 xl:grid-cols-[minmax(0,1fr)_360px]">
                <div class="space-y-6">
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">Informasi Metode Pembayaran</h2>
                            <p class="mt-1 text-sm text-slate-500">Ubah nama, tipe, bank, dan data rekening.</p>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nama Metode
                                    <span class="text-rose-500">*</span>
                                </label>

                                <input type="text" name="method_name" value="{{ old('method_name', $paymentMethod->method_name) }}" required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />

                                @error('method_name')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Tipe Metode
                                    <span class="text-rose-500">*</span>
                                </label>

                                <select name="method_type" required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100">
                                    @foreach(
                                        App\Models\PaymentMethod::types() as $value => $label)
                                        <option value="{{ $value }}" {{ old('method_type', $paymentMethod->method_type) === $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('method_type')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Bank / Provider</label>
                                <input type="text" name="bank_name" value="{{ old('bank_name', $paymentMethod->bank_name) }}"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                                @error('bank_name')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Nomor Rekening / Akun</label>
                                <input type="text" name="account_number" value="{{ old('account_number', $paymentMethod->account_number) }}"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                                @error('account_number')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Atas Nama</label>
                                <input type="text" name="account_name" value="{{ old('account_name', $paymentMethod->account_name) }}"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                                @error('account_name')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">Status</h2>
                            <p class="mt-1 text-sm text-slate-500">Pilih apakah metode ini aktif atau tidak.</p>
                        </div>
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                                <select name="status" required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100">
                                    @foreach(App\Models\PaymentMethod::statuses() as $value => $label)
                                    <option value="{{ $value }}" {{ old('status', $paymentMethod->status) === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('status')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Catatan</label>
                                <input type="text" name="notes" value="{{ old('notes', $paymentMethod->notes) }}"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                                @error('notes')
                                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>
                </div>

                <aside class="space-y-4 xl:sticky xl:top-6 xl:self-start">
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <h2 class="text-base font-bold text-slate-950">Ringkasan</h2>
                        <dl class="mt-4 space-y-4 text-sm">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">Nama</dt>
                                <dd class="font-semibold text-slate-900">{{ $paymentMethod->method_name }}</dd>
                            </div>
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">Tipe</dt>
                                <dd class="font-semibold text-slate-900">{{ App\Models\PaymentMethod::types()[$paymentMethod->method_type] ?? '-' }}</dd>
                            </div>
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">Bank</dt>
                                <dd class="font-semibold text-slate-900">{{ $paymentMethod->bank_name ?? '-' }}</dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt class="text-slate-500">Status</dt>
                                <dd class="font-semibold text-emerald-700">{{ App\Models\PaymentMethod::statuses()[$paymentMethod->status] ?? '-' }}</dd>
                            </div>
                        </dl>
                    </section>

                    <section class="rounded-lg border border-emerald-100 bg-emerald-50 p-5 text-sm text-emerald-900">
                        <p class="font-semibold">Informasi</p>
                        <p class="mt-2 leading-6">Metode pembayaran aktif akan tampil di saat pembuatan invoice.</p>
                    </section>
                </aside>
            </div>

            <div class="flex flex-col gap-3 rounded-lg border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-slate-500">Pastikan data metode pembayaran sudah benar sebelum menyimpan.</p>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('payment-methods.index') }}" class="inline-flex h-11 items-center justify-center rounded-lg border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>
                    <button type="submit" class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
