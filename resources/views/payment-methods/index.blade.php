@extends('layouts.app')

@section('title', 'Metode Pembayaran')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        {{-- Header --}}
        <div
            class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">
                    PAYMENT METHOD
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Metode Pembayaran
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    Kelola rekening perusahaan dan metode pembayaran customer untuk transaksi invoice.
                </p>
            </div>

            <a href="{{ route('payment-methods.create') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">

                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Tambah Metode
            </a>
        </div>

        {{-- Success --}}
        @if(session('success'))
        <div role="alert"
            class="mb-5 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm">

            <div class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                ✓
            </div>

            <div class="flex-1">
                <p class="font-semibold">Berhasil</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        @endif

        {{-- Summary --}}
        <section class="mb-6 grid gap-5 xl:grid-cols-4">

            {{-- Total --}}
            <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">
                            Total Metode
                        </h2>

                        <p class="mt-3 text-2xl font-semibold text-slate-950">
                            {{ number_format($summary['total']) }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-md bg-blue-50 text-blue-600">
                        💳
                    </div>
                </div>
            </article>

            {{-- Bank Transfer --}}
            <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">
                            Bank Transfer
                        </h2>

                        <p class="mt-3 text-2xl font-semibold text-blue-600">
                            {{ number_format($summary['bank_transfer']) }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-md bg-blue-50 text-blue-600">
                        🏦
                    </div>
                </div>
            </article>

            {{-- Ewallet --}}
            <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">
                            E-Wallet
                        </h2>

                        <p class="mt-3 text-2xl font-semibold text-emerald-600">
                            {{ number_format($summary['ewallet']) }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-md bg-emerald-50 text-emerald-600">
                        📱
                    </div>
                </div>
            </article>

            {{-- Aktif --}}
            <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">
                            Aktif
                        </h2>

                        <p class="mt-3 text-2xl font-semibold text-amber-600">
                            {{ number_format($summary['active']) }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-md bg-amber-50 text-amber-600">
                        ✔
                    </div>
                </div>
            </article>
        </section>

        {{-- Filter --}}
        <section class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

            <form method="GET" action="{{ route('payment-methods.index') }}" class="space-y-5">

                <div
                    class="flex flex-col gap-3 border-b border-slate-200 pb-4 lg:flex-row lg:items-center lg:justify-between">

                    <div>
                        <h2 class="text-base font-bold text-slate-950">
                            Filter Metode Pembayaran
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Cari berdasarkan nama metode, bank, tipe, atau status.
                        </p>
                    </div>
                </div>

                <div class="grid gap-4 xl:grid-cols-4">

                    {{-- Search --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Cari
                        </label>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Nama metode / bank"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    </div>

                    {{-- Tipe --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Tipe Metode
                        </label>

                        <select name="method_type"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm">

                            <option value="">Semua</option>

                            @foreach(\App\Models\PaymentMethod::types() as $key => $value)
                            <option value="{{ $key }}" {{ request('method_type')==$key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Status
                        </label>

                        <select name="status"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm">

                            <option value="">Semua</option>

                            @foreach(\App\Models\PaymentMethod::statuses() as $key => $value)
                            <option value="{{ $key }}" {{ request('status')==$key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Action --}}
                    <div class="flex items-end gap-3">

                        <a href="{{ route('payment-methods.index') }}"
                            class="inline-flex h-11 flex-1 items-center justify-center rounded-lg border border-slate-300 bg-white text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Reset
                        </a>

                        <button type="submit"
                            class="inline-flex h-11 flex-1 items-center justify-center rounded-lg bg-blue-600 text-sm font-semibold text-white hover:bg-blue-700">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </section>
        {{-- Table --}}
        <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">
                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

                    <div>
                        <h2 class="text-base font-bold text-slate-950">
                            Data Metode Pembayaran
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Seluruh rekening dan metode pembayaran perusahaan.
                        </p>
                    </div>

                    <div
                        class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ $paymentMethods->total() }} metode
                    </div>

                </div>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1280px] border-collapse">

                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">
                                Kode
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">
                                Nama Metode
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">
                                Tipe
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">
                                Provider / Bank
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">
                                Rekening
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide">
                                Atas Nama
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wide">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wide">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white">

                        @forelse($paymentMethods as $paymentMethod)

                        <tr class="transition hover:bg-slate-50">

                            {{-- Kode --}}
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="font-semibold text-slate-950">
                                    {{ $paymentMethod->payment_code }}
                                </div>
                            </td>

                            {{-- Nama --}}
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="font-semibold text-slate-900">
                                    {{ $paymentMethod->method_name }}
                                </div>

                                @if($paymentMethod->is_default)
                                <span
                                    class="mt-1 inline-flex rounded-md bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-700">
                                    Default
                                </span>
                                @endif
                            </td>

                            {{-- Type --}}
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">
                                {{ \App\Models\PaymentMethod::types()[$paymentMethod->method_type] ?? '-' }}
                            </td>

                            {{-- Provider --}}
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">
                                {{ $paymentMethod->bank_name ?? '-' }}
                            </td>

                            {{-- Rekening --}}
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">
                                {{ $paymentMethod->account_number ?? '-' }}
                            </td>

                            {{-- Account Name --}}
                            <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-800">
                                {{ $paymentMethod->account_name ?? '-' }}
                            </td>



                            {{-- Status --}}
                            <td class="px-6 py-5 text-center">

                                <span
                                    class="inline-flex rounded-md px-2.5 py-1 text-xs font-semibold {{ $paymentMethod->getStatusBadge() }}">
                                    {{ \App\Models\PaymentMethod::statuses()[$paymentMethod->status] }}
                                </span>

                            </td>

                            {{-- Action --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('payment-methods.edit', $paymentMethod) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-700 transition hover:bg-amber-100"
                                        title="Edit">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.4-9.4a2 2 0 112.8 2.8L11.8 15H9v-2.8l8.6-8.6z" />
                                        </svg>
                                    </a>

                                    {{-- Delete --}}
                                    <button type="button" data-open-delete-modal
                                        data-delete-url="{{ route('payment-methods.destroy', $paymentMethod) }}"
                                        data-name="{{ $paymentMethod->method_name }}"
                                        data-bank="{{ $paymentMethod->bank_name }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-rose-50 text-rose-700 transition hover:bg-rose-100">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.9 12A2 2 0 0116.1 21H7.9a2 2 0 01-2-1.9L5 7m5 4v6m4-6v6M4 7h16" />
                                        </svg>
                                    </button>

                                </div>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="9" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div
                                        class="mb-4 flex h-14 w-14 items-center justify-center rounded-lg bg-slate-100 text-slate-400">
                                        💳
                                    </div>

                                    <h3 class="text-base font-bold text-slate-950">
                                        Belum Ada Metode Pembayaran
                                    </h3>

                                    <p class="mt-2 max-w-md text-sm text-slate-500">
                                        Tambahkan metode pembayaran perusahaan untuk transaksi invoice customer.
                                    </p>

                                    <a href="{{ route('payment-methods.create') }}"
                                        class="mt-5 inline-flex h-10 items-center justify-center rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                                        Tambah Metode
                                    </a>

                                </div>

                            </td>
                        </tr>

                        @endforelse

                    </tbody>
                </table>

            </div>
        </section>

        {{-- Pagination --}}
        <div class="mt-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <p class="text-sm text-slate-600">
                Menampilkan
                <strong>{{ $paymentMethods->firstItem() ?? 0 }}</strong>
                sampai
                <strong>{{ $paymentMethods->lastItem() ?? 0 }}</strong>
                dari
                <strong>{{ $paymentMethods->total() }}</strong>
                hasil
            </p>

            <div>
                {{ $paymentMethods->withQueryString()->links() }}
            </div>
        </div>

    </div>
</div>

{{-- Delete Modal --}}
<div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4">

    <div class="w-full max-w-md rounded-lg border border-slate-200 bg-white shadow-xl">

        <div class="border-b border-slate-200 p-5">

            <h2 class="text-base font-bold text-slate-950">
                Konfirmasi Hapus
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Metode pembayaran akan dihapus permanen.
            </p>

        </div>

        <div class="space-y-3 p-5 text-sm">

            <div class="rounded-lg bg-slate-50 p-4">

                <p>
                    <span class="text-slate-500">Metode:</span>
                    <strong id="modal-name"></strong>
                </p>

                <p class="mt-2">
                    <span class="text-slate-500">Bank:</span>
                    <strong id="modal-bank"></strong>
                </p>

            </div>

        </div>

        <form id="delete-form" method="POST" class="flex justify-end gap-3 border-t border-slate-200 p-5">

            @csrf
            @method('DELETE')

            <button type="button" data-close-delete-modal
                class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700">
                Batal
            </button>

            <button type="submit"
                class="inline-flex h-10 items-center justify-center rounded-lg bg-rose-600 px-4 text-sm font-semibold text-white hover:bg-rose-700">
                Hapus
            </button>

        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('delete-modal');
    const deleteForm = document.getElementById('delete-form');

    document.querySelectorAll('[data-open-delete-modal]')
        .forEach(button => {

            button.addEventListener('click', function () {

                deleteForm.action =
                    this.dataset.deleteUrl;

                document.getElementById('modal-name')
                    .textContent =
                    this.dataset.name;

                document.getElementById('modal-bank')
                    .textContent =
                    this.dataset.bank || '-';

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });

        });

    document.querySelectorAll(
        '[data-close-delete-modal]'
    ).forEach(button => {

        button.addEventListener('click', function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

    });

});
</script>

@endsection