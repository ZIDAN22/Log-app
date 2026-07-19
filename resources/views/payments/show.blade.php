@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        {{-- Header --}}
        <div class="mb-5 flex items-end justify-between border-b border-slate-200 pb-5">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">
                    KEUANGAN
                </p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Detail Pembayaran
                </h1>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('payments.edit', $payment) }}"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-slate-600 px-4 text-sm font-semibold text-white hover:bg-slate-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <a href="{{ route('payments.index') }}"
                    class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Kembali
                </a>
            </div>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
        <div class="mb-5 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm">
            <div class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div>
                <p class="font-semibold">Berhasil</p>
                <p class="mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        {{-- Content --}}
        <div class="grid gap-6 xl:grid-cols-3">

            {{-- Main Content --}}
            <div class="xl:col-span-2 space-y-6">

                {{-- Payment Information Card --}}
                <div class="rounded-lg border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                        <div>
                            <h2 class="text-base font-bold text-slate-950">Informasi Pembayaran</h2>
                            <p class="mt-1 text-sm text-slate-500">{{ $payment->payment_code }}</p>
                        </div>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $payment->getStatusBadge() }}">
                            {{ $payment->getStatusLabel() }}
                        </span>
                    </div>

                    <div class="px-6 py-5">
                        <div class="grid gap-6 md:grid-cols-2">

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Kode Pembayaran</p>
                                <p class="mt-2 text-lg font-bold text-slate-950">{{ $payment->payment_code }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tanggal Pembayaran</p>
                                <p class="mt-2 text-lg font-bold text-slate-950">{{ $payment->payment_date->format('d F Y') }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Nominal Pembayaran</p>
                                <p class="mt-2 text-lg font-bold text-emerald-600">
                                    Rp {{ number_format($payment->amount_paid, 0, ',', '.') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status Verifikasi</p>
                                <p class="mt-2 text-sm font-semibold text-slate-950">
                                    {{ $payment->status == 'pending' ? 'Menunggu Verifikasi' : 'Terverifikasi' }}
                                </p>
                            </div>

                        </div>

                        {{-- Catatan --}}
                        @if($payment->notes)
                        <div class="mt-5 border-t border-slate-200 pt-5">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Catatan</p>
                            <p class="mt-2 text-sm text-slate-700">{{ $payment->notes }}</p>
                        </div>
                        @endif

                    </div>
                </div>

                {{-- Invoice Information Card --}}
                <div class="rounded-lg border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-4">
                        <h2 class="text-base font-bold text-slate-950">Data Invoice</h2>
                    </div>

                    <div class="px-6 py-5">
                        <div class="grid gap-6 md:grid-cols-2">

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Nomor Invoice</p>
                                <p class="mt-2 text-sm font-bold text-slate-950">{{ $payment->invoice->invoice_number }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Nomor Resi</p>
                                <p class="mt-2 text-sm font-bold text-slate-950">{{ $payment->invoice->receipt_number }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pelanggan</p>
                                <p class="mt-2 text-sm font-bold text-slate-950">{{ $payment->invoice->customer_name }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tanggal Invoice</p>
                                <p class="mt-2 text-sm font-bold text-slate-950">{{ $payment->invoice->invoice_date->format('d F Y') }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Metode Pembayaran</p>
                                <p class="mt-2 text-sm font-bold text-slate-950">{{ $payment->invoice->payment_method ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status Invoice</p>
                                <p class="mt-2">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $payment->invoice->paymentStatusBadge() }}">
                                        {{ $payment->invoice->payment_status }}
                                    </span>
                                </p>
                            </div>

                        </div>

                        {{-- Invoice Amount Summary --}}
                        <div class="mt-5 border-t border-slate-200 pt-5">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-600">Harga Pengiriman:</span>
                                    <span class="text-sm font-semibold text-slate-900">
                                        Rp {{ number_format($payment->invoice->shipping_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-600">Biaya Pengiriman:</span>
                                    <span class="text-sm font-semibold text-slate-900">
                                        Rp {{ number_format($payment->invoice->shipping_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-600">PPN (1.1%):</span>
                                    <span class="text-sm font-semibold text-slate-900">
                                        Rp {{ number_format($payment->invoice->ppn_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-600">PPh (2%):</span>
                                    <span class="text-sm font-semibold text-slate-900">
                                        -Rp {{ number_format($payment->invoice->pph_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="border-t border-slate-200 pt-2 flex items-center justify-between">
                                    <span class="text-sm font-bold text-slate-900">Total:</span>
                                    <span class="text-lg font-bold text-slate-950">
                                        Rp {{ number_format($payment->invoice->grand_total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Proof of Payment --}}
                @if($payment->proof_payment)
                <div class="rounded-lg border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-4">
                        <h2 class="text-base font-bold text-slate-950">Bukti Pembayaran</h2>
                    </div>

                    <div class="px-6 py-5">
                        <div class="flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-center gap-3">
                                <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">{{ basename($payment->proof_payment) }}</p>
                                    <p class="text-xs text-slate-500">Dokumen pendukung pembayaran</p>
                                </div>
                            </div>
                            <a href="{{ Storage::url($payment->proof_payment) }}" target="_blank"
                                class="inline-flex items-center justify-center rounded-md bg-blue-50 px-3 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-100">
                                Lihat File
                            </a>
                        </div>
                    </div>
                </div>
                @endif

            </div>

            {{-- Sidebar --}}
            <div class="space-y-5">

                {{-- Action Buttons --}}
                @if($payment->status === 'pending')
                <form action="{{ route('payments.verify', $payment) }}" method="POST" onsubmit="return confirm('Verifikasi pembayaran ini?')">
                    @csrf
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-3 text-sm font-semibold text-white hover:bg-emerald-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Verifikasi Pembayaran
                    </button>
                </form>
                @endif

                {{-- Info Card --}}
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="font-bold text-slate-950">Riwayat</h3>

                    <div class="mt-4 space-y-3 text-xs text-slate-600">
                        <div>
                            <p class="text-slate-500">Dibuat pada:</p>
                            <p class="mt-1 font-semibold text-slate-900">{{ $payment->created_at->format('d M Y H:i') }}</p>
                        </div>

                        <div>
                            <p class="text-slate-500">Terakhir diubah:</p>
                            <p class="mt-1 font-semibold text-slate-900">{{ $payment->updated_at->format('d M Y H:i') }}</p>
                        </div>

                        @if($payment->verified_by)
                        <div class="border-t border-slate-200 pt-3">
                            <p class="text-slate-500">Diverifikasi oleh:</p>
                            <p class="mt-1 font-semibold text-slate-900">{{ $payment->verifiedBy->name ?? 'Sistem' }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Payment Status Card --}}
                <div class="rounded-lg border {{ $payment->isFullyPaid() ? 'border-emerald-200 bg-emerald-50' : ($payment->isPartialPayment() ? 'border-yellow-200 bg-yellow-50' : 'border-red-200 bg-red-50') }} p-5">

                    <div class="flex gap-3">
                        <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full {{ $payment->isFullyPaid() ? 'bg-emerald-100 text-emerald-700' : ($payment->isPartialPayment() ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                            @if($payment->isFullyPaid())
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            @elseif($payment->isPartialPayment())
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                            @else
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            @endif
                        </div>
                        <div class="text-sm {{ $payment->isFullyPaid() ? 'text-emerald-900' : ($payment->isPartialPayment() ? 'text-yellow-900' : 'text-red-900') }}">
                            <p class="font-semibold">
                                @if($payment->isFullyPaid())
                                Pembayaran Lunas
                                @elseif($payment->isPartialPayment())
                                Pembayaran Parsial
                                @else
                                Belum Ada Pembayaran
                                @endif
                            </p>
                            <p class="mt-0.5 text-xs">
                                @if($payment->isFullyPaid())
                                Invoice telah dibayar penuh.
                                @elseif($payment->isPartialPayment())
                                Sisa: Rp {{ number_format($payment->getRemainingBalance(), 0, ',', '.') }}
                                @else
                                Belum ada pembayaran yang dicatat.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Delete Action --}}
                <form action="{{ route('payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('Hapus pembayaran ini? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-lg border border-red-300 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus Pembayaran
                    </button>
                </form>

            </div>

        </div>

    </div>
</div>

@endsection
