@extends('layouts.app')

@section('title', 'Dashboard Finance')

@section('content')
{{-- =========================
HEADER DASHBOARD
========================== --}}
<section class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

    {{-- Background --}}
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 via-white to-cyan-50 opacity-80">
    </div>

    <div class="relative p-8 lg:p-10">

        <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

            {{-- Left --}}
            <div>

                <span
                    class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-emerald-700">

                    Finance Dashboard

                </span>

                <h1 class="mt-5 text-3xl font-bold text-slate-900 lg:text-4xl">

                    {{ $greeting }},
                    {{ auth()->user()->name }}

                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">

                    Selamat datang di dashboard Finance.
                    Pantau invoice pelanggan, pembayaran,
                    outstanding balance, dan aktivitas keuangan
                    perusahaan melalui satu dashboard.

                </p>

            </div>

            {{-- Right --}}
            <div class="min-w-[250px] rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">

                            Login Sebagai

                        </p>

                        <h3 class="mt-2 text-2xl font-bold text-slate-900">

                            {{ auth()->user()->role_label }}

                        </h3>

                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 12c2.761 0 5-2.239 5-5S14.761 2 12 2 7 4.239 7 7s2.239 5 5 5zm0 2c-4.418 0-8 1.79-8 4v2h16v-2c0-2.21-3.582-4-8-4z" />

                        </svg>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================
SUMMARY CARD
========================== --}}

<section class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

    {{-- Card 1 --}}
    <article
        class="group rounded-3xl border border-slate-200 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Total Invoice

                </p>

                <h2 class="mt-3 text-3xl font-bold text-slate-900">

                    {{ number_format($totalInvoices,0,',','.') }}

                </h2>

                <p class="mt-3 text-sm text-emerald-600">

                    Seluruh invoice yang telah dibuat

                </p>

            </div>

            <div class="rounded-2xl bg-emerald-100 p-3">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6M7 4h10l2 2v14H5V4h2z" />

                </svg>

            </div>

        </div>

    </article>

    {{-- Card 2 --}}
    <article
        class="group rounded-3xl border border-slate-200 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Pembayaran Diterima

                </p>

                <h2 class="mt-3 text-3xl font-bold text-slate-900">

                    Rp {{ number_format($totalPaymentsReceived,0,',','.') }}

                </h2>

                <p class="mt-3 text-sm text-emerald-600">

                    Total pembayaran berhasil diterima

                </p>

            </div>

            <div class="rounded-2xl bg-sky-100 p-3">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8" />

                </svg>

            </div>

        </div>

    </article>

    {{-- Card 3 --}}
    <article
        class="group rounded-3xl border border-slate-200 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Pending Payment

                </p>

                <h2 class="mt-3 text-3xl font-bold text-amber-600">

                    {{ number_format($pendingPayments,0,',','.') }}

                </h2>

                <p class="mt-3 text-sm text-amber-500">

                    Menunggu proses verifikasi

                </p>

            </div>

            <div class="rounded-2xl bg-amber-100 p-3">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />

                </svg>

            </div>

        </div>

    </article>

    {{-- Card 4 --}}
    <article
        class="group rounded-3xl border border-slate-200 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Outstanding Balance

                </p>

                <h2 class="mt-3 text-3xl font-bold text-rose-600">

                    Rp {{ number_format($outstandingBalance,0,',','.') }}

                </h2>

                <p class="mt-3 text-sm text-rose-500">

                    Total piutang yang belum dilunasi

                </p>

            </div>

            <div class="rounded-2xl bg-rose-100 p-3">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-2 0-4 1-4 4s2 4 4 4 4-1 4-4-2-4-4-4z" />

                </svg>

            </div>

        </div>

    </article>

</section>
{{-- =======================================================
REVENUE OVERVIEW
======================================================= --}}

<section>

    <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="flex flex-col gap-6 border-b border-slate-100 p-7 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <span
                    class="inline-flex rounded-full bg-emerald-50 px-4 py-2 text-xs font-semibold tracking-wide text-emerald-700">

                    Revenue Overview

                </span>

                <h2 class="mt-4 text-2xl font-bold text-slate-900">

                    Tren Pembayaran Bulanan

                </h2>

                <p class="mt-2 text-sm text-slate-500">

                    Grafik pembayaran yang diterima setiap bulan untuk membantu
                    memantau pertumbuhan pendapatan perusahaan.

                </p>

            </div>

            <div class="grid grid-cols-2 gap-4">

                <div class="rounded-2xl border border-slate-200 bg-slate-50 px-6 py-4">

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">

                        Invoice Bulan Ini

                    </p>

                    <h3 class="mt-2 text-2xl font-bold text-slate-900">

                        {{ number_format($currentMonthInvoices,0,',','.') }}

                    </h3>

                </div>

                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-6 py-4">

                    <p class="text-xs font-medium uppercase tracking-wide text-emerald-700">

                        Status

                    </p>

                    <h3 class="mt-2 text-xl font-bold text-emerald-700">

                        Aktif

                    </h3>

                </div>

            </div>

        </div>

        {{-- Chart --}}
        <div class="p-8">

            <div class="h-[430px] w-full">

                <canvas id="monthlyPaymentTrendChart">
                </canvas>

            </div>

        </div>

    </article>

</section>

<section class="mt-8 grid gap-6 xl:grid-cols-2">

<article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

    {{-- Header --}}
    <div class="flex flex-col gap-4 border-b border-slate-100 p-6 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">

                Invoice Analytics

            </span>

            <h2 class="mt-3 text-xl font-bold text-slate-900">

                Distribusi Status Invoice

            </h2>

            <p class="mt-1 text-sm text-slate-500">

                Perbandingan invoice berdasarkan status pembayaran.

            </p>

        </div>

        <div class="rounded-2xl bg-slate-100 px-5 py-3">

            <p class="text-xs uppercase text-slate-500">

                Total

            </p>

            <p class="mt-1 text-xl font-bold text-slate-900">

                {{ number_format($totalInvoices,0,',','.') }}

            </p>

        </div>

    </div>

    {{-- Content --}}
    <div class="grid gap-8 p-6 xl:grid-cols-[360px_minmax(0,1fr)]">

        {{-- Chart --}}
        <div class="h-[300px] w-full sm:h-[340px]">

            <canvas id="invoiceStatusChart">
            </canvas>

        </div>

        {{-- Statistik --}}
        <div class="space-y-4">

            @foreach($invoiceStatusCounts as $status => $count)

            <div
                class="flex items-center justify-between rounded-2xl border border-slate-200 p-4 transition hover:border-emerald-300 hover:bg-emerald-50">

                <div>

                    <p class="text-sm font-semibold text-slate-800">

                        {{ $status }}

                    </p>

                    <p class="text-xs text-slate-500">

                        Jumlah Invoice

                    </p>

                </div>

                <span class="rounded-xl bg-slate-100 px-4 py-2 text-lg font-bold text-slate-900">

                    {{ number_format($count,0,',','.') }}

                </span>

            </div>

            @endforeach

        </div>

    </div>

</article>
<article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

    {{-- Header --}}
    <div class="flex flex-col gap-4 border-b border-slate-100 p-6 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <span class="inline-flex rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700">

                Payment Analytics

            </span>

            <h2 class="mt-3 text-xl font-bold text-slate-900">

                Metode Pembayaran

            </h2>

            <p class="mt-1 text-sm text-slate-500">

                Distribusi penggunaan metode pembayaran pelanggan.

            </p>

        </div>

        <a href="{{ route('payment-methods.index') }}"
            class="rounded-xl border border-slate-200 bg-white px-5 py-2 text-sm font-semibold text-slate-700 transition hover:border-emerald-300 hover:text-emerald-600">

            Kelola

        </a>

    </div>

    {{-- Content --}}
    <div class="grid gap-8 p-6 lg:grid-cols-[320px_minmax(0,1fr)]">

        {{-- Chart --}}
        <div class="h-[300px] w-full sm:h-[340px]">

            <canvas id="paymentMethodChart">
            </canvas>

        </div>

        {{-- List --}}
        <div class="space-y-4">

            @foreach($paymentMethodUsage as $method => $count)

            <div
                class="rounded-2xl border border-slate-200 p-4 transition duration-300 hover:border-emerald-300 hover:bg-emerald-50">

                <div class="flex items-center justify-between">

                    <div>

                        <h4 class="font-semibold text-slate-900">

                            {{ $method }}

                        </h4>

                        <p class="mt-1 text-sm text-slate-500">

                            Digunakan pada transaksi invoice

                        </p>

                    </div>

                    <span class="rounded-xl bg-slate-100 px-4 py-2 text-lg font-bold text-slate-900">

                        {{ number_format($count,0,',','.') }}

                    </span>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</article>

</section>

<article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

    {{-- Header --}}
    <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

        <div>

            <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">

                Invoice

            </span>

            <h2 class="mt-3 text-xl font-bold text-slate-900">

                Invoice Terbaru

            </h2>

            <p class="mt-1 text-sm text-slate-500">

                Daftar invoice terbaru yang telah dibuat.

            </p>

        </div>

        <a href="{{ route('invoices.index') }}"
            class="rounded-xl border border-slate-200 bg-white px-5 py-2 text-sm font-semibold text-slate-700 transition hover:border-emerald-300 hover:text-emerald-600">

            Lihat Semua

        </a>

    </div>

    {{-- Table --}}
    <div class="max-h-[500px] overflow-auto">

        <table class="min-w-full">

            <thead class="sticky top-0 bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Invoice

                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Customer

                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Tanggal

                    </th>

                    <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Status

                    </th>

                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Total

                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($recentInvoices as $invoice)

                <tr class="transition hover:bg-slate-50">

                    <td class="px-6 py-4">

                        <a href="{{ route('invoices.show',$invoice) }}"
                            class="font-semibold text-slate-900 hover:text-emerald-600">

                            {{ $invoice->invoice_number }}

                        </a>

                    </td>

                    <td class="px-6 py-4 text-slate-600">

                        {{ $invoice->customer_name }}

                    </td>

                    <td class="px-6 py-4 text-slate-500">

                        {{ $invoice->invoice_date?->format('d M Y') }}

                    </td>

                    <td class="px-6 py-4 text-center">

                        <span
                            class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $invoice->paymentStatusBadge() }}">

                            {{ $invoice->payment_status }}

                        </span>

                    </td>

                    <td class="px-6 py-4 text-right font-semibold text-slate-900">

                        Rp {{ number_format($invoice->grand_total,0,',','.') }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">

                        Belum ada data invoice.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</article>
<article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

    {{-- Header --}}
    <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

        <div>

            <span class="inline-flex rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700">

                Payment

            </span>

            <h2 class="mt-3 text-xl font-bold text-slate-900">

                Pembayaran Terbaru

            </h2>

            <p class="mt-1 text-sm text-slate-500">

                Histori pembayaran yang baru diterima.

            </p>

        </div>

        <a href="{{ route('payments.index') }}"
            class="rounded-xl border border-slate-200 bg-white px-5 py-2 text-sm font-semibold text-slate-700 transition hover:border-sky-300 hover:text-sky-600">

            Lihat Semua

        </a>

    </div>

    <div class="max-h-[500px] overflow-auto">

        <table class="min-w-full">

            <thead class="sticky top-0 bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Payment

                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Invoice

                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Tanggal

                    </th>

                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Nominal

                    </th>

                    <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Status

                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($recentPayments as $payment)

                <tr class="transition hover:bg-slate-50">

                    <td class="px-6 py-4">

                        <a href="{{ route('payments.show',$payment) }}"
                            class="font-semibold text-slate-900 hover:text-sky-600">

                            {{ $payment->payment_code }}

                        </a>

                    </td>

                    <td class="px-6 py-4 text-slate-600">

                        {{ $payment->invoice?->invoice_number ?? '-' }}

                    </td>

                    <td class="px-6 py-4 text-slate-500">

                        {{ $payment->payment_date?->format('d M Y') }}

                    </td>

                    <td class="px-6 py-4 text-right font-semibold text-slate-900">

                        Rp {{ number_format($payment->amount_paid,0,',','.') }}

                    </td>

                    <td class="px-6 py-4 text-center">

                        <span
                            class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $payment->getStatusBadge() }}">

                            {{ $payment->getStatusLabel() }}

                        </span>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">

                        Belum ada pembayaran.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</article>

</div>
@endsection

@push('scripts')
<script>
    // ======================================================
// GLOBAL CHART STYLE
// ======================================================

Chart.defaults.font.family =
    "'Inter','Plus Jakarta Sans','Segoe UI',sans-serif";

Chart.defaults.font.size = 12;

Chart.defaults.font.weight = "500";

Chart.defaults.color = "#64748B";

Chart.defaults.animation = {
    duration: 1200,
    easing: 'easeOutQuart'
};

Chart.defaults.plugins.legend.labels.usePointStyle = true;
Chart.defaults.plugins.legend.labels.pointStyle = 'circle';
Chart.defaults.plugins.legend.labels.boxWidth = 10;
Chart.defaults.plugins.legend.labels.padding = 18;

// ======================================================
// DATA
// ======================================================

const monthlyPaymentLabels = @json($monthlyPaymentTrend->pluck('label'));
const monthlyPaymentData = @json($monthlyPaymentTrend->pluck('value'));

const invoiceStatusLabels = @json(array_keys($invoiceStatusCounts));
const invoiceStatusData = @json(array_values($invoiceStatusCounts));

const paymentMethodLabels = @json(array_keys($paymentMethodUsage));
const paymentMethodData = @json(array_values($paymentMethodUsage));

const outstandingCustomerLabels =
    @json($outstandingCustomerBalances->keys());

const outstandingCustomerData =
    @json($outstandingCustomerBalances->values());


// ======================================================
// MONTHLY PAYMENT TREND
// ======================================================

const lineCtx =
    document.getElementById('monthlyPaymentTrendChart');

if (lineCtx) {

    new Chart(lineCtx, {

        type: 'line',

        data: {

            labels: monthlyPaymentLabels,

            datasets: [{

                label: 'Pembayaran',

                data: monthlyPaymentData,

                borderColor: '#10B981',

                backgroundColor: 'rgba(16,185,129,.10)',

                fill: true,

                borderWidth: 3,

                tension: .45,

                pointRadius: 4,

                pointHoverRadius: 7,

                pointBorderWidth: 2,

                pointBorderColor: '#ffffff',

                pointBackgroundColor: '#10B981'

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {

                intersect: false,

                mode: 'index'

            },

            layout: {

                padding: {
                    left: 8,
                    right: 20,
                    top: 15,
                    bottom: 0
                }

            },

            plugins: {

                legend: {

                    display: false

                },

                tooltip: {

                    backgroundColor: '#0F172A',

                    titleColor: '#fff',

                    bodyColor: '#fff',

                    displayColors: false,

                    cornerRadius: 12,

                    padding: 14,

                    callbacks: {

                        label: function (context) {

                            return new Intl.NumberFormat(
                                'id-ID',
                                {
                                    style: 'currency',
                                    currency: 'IDR',
                                    maximumFractionDigits: 0
                                }
                            ).format(context.parsed.y);

                        }

                    }

                }

            },

            scales: {

                x: {

                    grid: {

                        display: false

                    },

                    ticks: {

                        color: '#64748B'

                    }

                },

                y: {

                    beginAtZero: true,

                    grid: {

                        color: 'rgba(148,163,184,.08)',

                        drawBorder: false

                    },

                    ticks: {

                        padding: 10,

                        color: '#64748B',

                        callback: function(value){

                            return new Intl.NumberFormat(

                                'id-ID',

                                {
                                    style:'currency',
                                    currency:'IDR',
                                    notation:'compact',
                                    maximumFractionDigits:1

                                }

                            ).format(value);

                        }

                    }

                }

            }

        }

    });

}
// ======================================================
// INVOICE STATUS (DOUGHNUT)
// ======================================================

const doughnutCtx = document.getElementById('invoiceStatusChart');

if (doughnutCtx) {

    new Chart(doughnutCtx, {

        type: 'doughnut',

        data: {

            labels: invoiceStatusLabels,

            datasets: [{

                data: invoiceStatusData,

                backgroundColor: [

                    '#22C55E',
                    '#F59E0B',
                    '#EF4444',
                    '#3B82F6',
                    '#8B5CF6'

                ],

                borderWidth: 0,

                hoverOffset: 18,

                cutout: '72%'

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {

                intersect: false

            },

            plugins: {

                legend: {

                    position: 'right',

                    align: 'center',

                    labels: {

                        padding: 20,

                        font: {

                            size: 13,

                            weight: '600'

                        }

                    }

                },

                tooltip: {

                    backgroundColor: '#111827',

                    titleColor: '#fff',

                    bodyColor: '#fff',

                    displayColors: true,

                    cornerRadius: 12,

                    padding: 14,

                    callbacks: {

                        label(context) {

                            return `${context.label} : ${context.parsed}`;

                        }

                    }

                }

            }

        }

    });

}



// ======================================================
// OUTSTANDING CUSTOMER (BAR)
// ======================================================

const barCtx = document.getElementById('outstandingCustomerChart');

if (barCtx) {

    new Chart(barCtx, {

        type: 'bar',

        data: {

            labels: outstandingCustomerLabels,

            datasets: [{

                label: 'Outstanding',

                data: outstandingCustomerData,

                backgroundColor: '#F97316',

                borderRadius: 12,

                borderSkipped: false,

                maxBarThickness: 42

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {

                intersect: false,

                mode: 'index'

            },

            plugins: {

                legend: {

                    display: false

                },

                tooltip: {

                    backgroundColor: '#111827',

                    titleColor: '#ffffff',

                    bodyColor: '#ffffff',

                    displayColors: false,

                    cornerRadius: 12,

                    padding: 14,

                    callbacks: {

                        label(context) {

                            return new Intl.NumberFormat(

                                'id-ID',

                                {

                                    style: 'currency',

                                    currency: 'IDR',

                                    maximumFractionDigits: 0

                                }

                            ).format(context.parsed.y);

                        }

                    }

                }

            },

            scales: {

                x: {

                    grid: {

                        display: false

                    },

                    ticks: {

                        color: '#64748B',

                        font: {

                            size: 12,

                            weight: '600'

                        }

                    }

                },

                y: {

                    beginAtZero: true,

                    grid: {

                        color: 'rgba(148,163,184,.08)',

                        drawBorder: false

                    },

                    ticks: {

                        color: '#64748B',

                        padding: 8,

                        callback(value) {

                            return new Intl.NumberFormat(

                                'id-ID',

                                {

                                    style: 'currency',

                                    currency: 'IDR',

                                    notation: 'compact',

                                    maximumFractionDigits: 1

                                }

                            ).format(value);

                        }

                    }

                }

            }

        }

    });

}

// ======================================================
// PAYMENT METHOD (PIE CHART)
// ======================================================

const pieCtx = document.getElementById('paymentMethodChart');

if (pieCtx) {

    new Chart(pieCtx, {

        type: 'pie',

        data: {

            labels: paymentMethodLabels,

            datasets: [{

                data: paymentMethodData,

                backgroundColor: [

                    '#10B981',
                    '#3B82F6',
                    '#F59E0B',
                    '#EF4444',
                    '#8B5CF6',
                    '#06B6D4',
                    '#14B8A6',
                    '#6366F1'

                ],

                borderWidth: 0,

                hoverOffset: 20

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {

                intersect: false

            },

            layout: {

                padding: 20

            },

            plugins: {

                legend: {

                    position: 'right',

                    align: 'center',

                    labels: {

                        padding: 18,

                        font: {

                            size: 13,

                            weight: '600'

                        }

                    }

                },

                tooltip: {

                    backgroundColor: '#0F172A',

                    titleColor: '#FFFFFF',

                    bodyColor: '#FFFFFF',

                    displayColors: true,

                    cornerRadius: 12,

                    padding: 14,

                    callbacks: {

                        label(context) {

                            const total = context.dataset.data.reduce(
                                (a, b) => a + b,
                                0
                            );

                            const value = context.parsed;

                            const percent = total
                                ? ((value / total) * 100).toFixed(1)
                                : 0;

                            return `${context.label} : ${value} (${percent}%)`;

                        }

                    }

                }

            }

        }

    });

}



// ======================================================
// RESIZE CHART WHEN WINDOW RESIZED
// ======================================================

window.addEventListener('resize', () => {

    Object.values(Chart.instances).forEach(chart => {

        chart.resize();

    });

});



// ======================================================
// PAYMENT METHOD
// (LANJUT KE BAGIAN 3)
// ======================================================
</script>
@endpush