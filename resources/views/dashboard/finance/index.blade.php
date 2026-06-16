@extends('layouts.app')

@section('title', 'Dashboard Finance')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-12 2xl:px-16">
    <div class="mx-auto w-full max-w-7xl space-y-6">
        <section class="rounded-[32px] bg-white p-8 shadow-xl shadow-slate-900/5 border border-slate-200">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <span class="inline-flex rounded-full bg-emerald-500/10 px-4 py-2 text-sm font-semibold uppercase tracking-[0.25em] text-emerald-500">Finance Dashboard</span>
                    <h1 class="mt-4 text-4xl font-bold tracking-tight text-slate-900">{{ $greeting }}, {{ auth()->user()->name }}</h1>
                    <p class="mt-3 max-w-2xl text-slate-500">Ringkas performa keuangan, pembayaran, dan invoice pelanggan dalam satu tampilan profesional.</p>
                </div>
                <div class="rounded-[28px] border border-slate-200 bg-slate-50 px-6 py-5 text-center shadow-sm">
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Role saat ini</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ auth()->user()->role_label }}</p>
                </div>
            </div>
        </section>

        <section class="grid gap-5 xl:grid-cols-4">
            <article class="rounded-[28px] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Total Invoice</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ number_format($totalInvoices, 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-slate-500">Invoice aktif dan tertagih</p>
            </article>
            <article class="rounded-[28px] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Pembayaran Diterima</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">Rp {{ number_format($totalPaymentsReceived, 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-slate-500">Total penerimaan hingga sekarang</p>
            </article>
            <article class="rounded-[28px] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Pembayaran Tertunda</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ number_format($pendingPayments, 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-slate-500">Rekam pembayaran belum diverifikasi</p>
            </article>
            <article class="rounded-[28px] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Outstanding Balance</p>
                <p class="mt-4 text-3xl font-semibold text-emerald-700">Rp {{ number_format($outstandingBalance, 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-slate-500">Saldo piutang tertunggak</p>
            </article>
        </section>

        <section class="grid gap-5 xl:grid-cols-[1.3fr_0.7fr]">
            <article class="rounded-[32px] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Tren Pembayaran Bulanan</p>
                        <h2 class="mt-3 text-2xl font-semibold text-slate-900">Arus kas keuangan</h2>
                    </div>
                    <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">{{ number_format($currentMonthInvoices, 0, ',', '.') }} Invoice Bulan Ini</div>
                </div>
                <div class="mt-8">
                    <canvas id="monthlyPaymentTrendChart" class="w-full h-[320px]"></canvas>
                </div>
            </article>

            <div class="space-y-5">
                <article class="rounded-[32px] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Status Invoice</p>
                            <h2 class="mt-3 text-xl font-semibold text-slate-900">Distribusi pembayaran</h2>
                        </div>
                        <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">{{ number_format($totalInvoices, 0, ',', '.') }} Invoice</div>
                    </div>
                    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-[auto_1fr] lg:items-center">
                        <div class="grid gap-3">
                            @foreach($invoiceStatusCounts as $status => $count)
                                <div class="flex items-center justify-between rounded-3xl bg-slate-50 px-4 py-3 text-sm">
                                    <span class="text-slate-600">{{ $status }}</span>
                                    <span class="font-semibold text-slate-900">{{ number_format($count, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="min-h-[280px]">
                            <canvas id="invoiceStatusChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </article>

                <article class="rounded-[32px] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Outstanding Customer</p>
                            <h2 class="mt-3 text-xl font-semibold text-slate-900">Saldo pelanggan tertinggi</h2>
                        </div>
                        <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">{{ number_format($outstandingInvoiceCount, 0, ',', '.') }} Pelanggan</div>
                    </div>
                    <div class="mt-8">
                        <canvas id="outstandingCustomerChart" class="w-full h-[280px]"></canvas>
                    </div>
                </article>
            </div>
        </section>

        <section class="grid gap-5 xl:grid-cols-[0.9fr_0.65fr]">
            <article class="rounded-[32px] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Metode Pembayaran</p>
                        <h2 class="mt-3 text-xl font-semibold text-slate-900">Pilih pembayaran populer</h2>
                    </div>
                    <a href="{{ route('payment-methods.index') }}" class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200">Kelola Metode</a>
                </div>
                <div class="mt-8 grid gap-6 lg:grid-cols-[0.9fr_0.6fr] lg:items-center">
                    <div class="min-h-[280px]">
                        <canvas id="paymentMethodChart" class="w-full h-full"></canvas>
                    </div>
                    <div class="space-y-3">
                        @foreach($paymentMethodUsage as $method => $count)
                            <div class="rounded-3xl bg-slate-50 px-4 py-4">
                                <div class="flex items-center justify-between gap-3 text-sm font-medium text-slate-700">
                                    <span>{{ $method }}</span>
                                    <span>{{ number_format($count, 0, ',', '.') }} invoice</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </article>

            <article class="rounded-[32px] bg-rose-50 p-6 shadow-sm ring-1 ring-rose-200">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-rose-600">Outstanding Invoice Alert</p>
                        <h2 class="mt-3 text-2xl font-semibold text-slate-950">Tindak lanjut piutang</h2>
                        <p class="mt-2 text-sm text-slate-700">{{ $outstandingInvoiceCount }} invoice belum lunas dengan total saldo Rp {{ number_format($outstandingBalance, 0, ',', '.') }}.</p>
                    </div>
                    <span class="inline-flex rounded-3xl bg-rose-100 px-4 py-2 text-sm font-semibold text-rose-700">Prioritas Tinggi</span>
                </div>
                <div class="mt-8 space-y-4">
                    @if($topOutstandingInvoices->isEmpty())
                        <div class="rounded-3xl bg-white p-4 text-sm text-slate-600">Tidak ada invoice tertunggak saat ini.</div>
                    @else
                        @foreach($topOutstandingInvoices as $invoice)
                            @php
                                $paid = $invoice->payment_sum_amount_paid ?? 0;
                                $remaining = max(0, $invoice->grand_total - $paid);
                            @endphp
                            <div class="rounded-3xl bg-white p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $invoice->invoice_number }}</p>
                                        <p class="text-sm text-slate-500">{{ $invoice->customer_name }} • {{ $invoice->payment_status }}</p>
                                    </div>
                                    <span class="rounded-full bg-rose-100 px-3 py-1 text-sm font-semibold text-rose-700">Rp {{ number_format($remaining, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </article>
        </section>

        <section class="grid gap-5 xl:grid-cols-2">
            <article class="rounded-[32px] bg-white p-6 shadow-sm ring-1 ring-slate-200 overflow-hidden">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Recent Invoices</p>
                        <h2 class="mt-3 text-xl font-semibold text-slate-900">Invoice terbaru</h2>
                    </div>
                    <a href="{{ route('invoices.index') }}" class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200">Lihat Semua</a>
                </div>
                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 font-semibold text-slate-500">Invoice</th>
                                <th class="px-4 py-3 font-semibold text-slate-500">Customer</th>
                                <th class="px-4 py-3 font-semibold text-slate-500">Tanggal</th>
                                <th class="px-4 py-3 font-semibold text-slate-500">Status</th>
                                <th class="px-4 py-3 font-semibold text-slate-500">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($recentInvoices as $invoice)
                                @php
                                    $paid = $invoice->payment_sum_amount_paid ?? 0;
                                @endphp
                                <tr>
                                    <td class="px-4 py-4 text-slate-700"><a href="{{ route('invoices.show', $invoice) }}" class="font-semibold text-slate-900 hover:text-emerald-600">{{ $invoice->invoice_number }}</a></td>
                                    <td class="px-4 py-4 text-slate-600">{{ $invoice->customer_name }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $invoice->invoice_date?->format('d M Y') }}</td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $invoice->paymentStatusBadge() }}">{{ $invoice->payment_status }}</span>
                                    </td>
                                    <td class="px-4 py-4 text-slate-900">Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada invoice terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </article>

            <article class="rounded-[32px] bg-white p-6 shadow-sm ring-1 ring-slate-200 overflow-hidden">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Recent Payments</p>
                        <h2 class="mt-3 text-xl font-semibold text-slate-900">Pembayaran terbaru</h2>
                    </div>
                    <a href="{{ route('payments.index') }}" class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200">Lihat Semua</a>
                </div>
                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 font-semibold text-slate-500">Pembayaran</th>
                                <th class="px-4 py-3 font-semibold text-slate-500">Invoice</th>
                                <th class="px-4 py-3 font-semibold text-slate-500">Tanggal</th>
                                <th class="px-4 py-3 font-semibold text-slate-500">Jumlah</th>
                                <th class="px-4 py-3 font-semibold text-slate-500">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($recentPayments as $payment)
                                <tr>
                                    <td class="px-4 py-4 text-slate-700"><a href="{{ route('payments.show', $payment) }}" class="font-semibold text-slate-900 hover:text-emerald-600">{{ $payment->payment_code }}</a></td>
                                    <td class="px-4 py-4 text-slate-600">{{ $payment->invoice?->invoice_number ?? '—' }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $payment->payment_date?->format('d M Y') }}</td>
                                    <td class="px-4 py-4 text-slate-900">Rp {{ number_format($payment->amount_paid, 0, ',', '.') }}</td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $payment->getStatusBadge() }}">{{ $payment->getStatusLabel() }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada pembayaran terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </article>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const monthlyPaymentLabels = @json($monthlyPaymentTrend->pluck('label'));
    const monthlyPaymentData = @json($monthlyPaymentTrend->pluck('value'));
    const invoiceStatusLabels = @json(array_keys($invoiceStatusCounts));
    const invoiceStatusData = @json(array_values($invoiceStatusCounts));
    const paymentMethodLabels = @json(array_keys($paymentMethodUsage));
    const paymentMethodData = @json(array_values($paymentMethodUsage));
    const outstandingCustomerLabels = @json($outstandingCustomerBalances->keys());
    const outstandingCustomerData = @json($outstandingCustomerBalances->values());

    const lineCtx = document.getElementById('monthlyPaymentTrendChart');
    if (lineCtx) {
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: monthlyPaymentLabels,
                datasets: [{
                    label: 'Pembayaran Bulanan',
                    data: monthlyPaymentData,
                    borderColor: '#059669',
                    backgroundColor: 'rgba(16, 185, 129, 0.12)',
                    pointBackgroundColor: '#10B981',
                    pointBorderColor: '#10B981',
                    fill: true,
                    tension: 0.35,
                    borderWidth: 3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#475569' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(148, 163, 184, 0.18)' },
                        ticks: { color: '#475569', callback: value => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value) }
                    }
                }
            }
        });
    }

    const doughnutCtx = document.getElementById('invoiceStatusChart');
    if (doughnutCtx) {
        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: invoiceStatusLabels,
                datasets: [{
                    data: invoiceStatusData,
                    backgroundColor: ['#84CC16', '#F59E0B', '#EF4444'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { color: '#334155' } },
                    tooltip: { callbacks: { label: context => `${context.label}: ${context.parsed}` } }
                }
            }
        });
    }

    const barCtx = document.getElementById('outstandingCustomerChart');
    if (barCtx) {
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: outstandingCustomerLabels,
                datasets: [{
                    label: 'Saldo Outstanding',
                    data: outstandingCustomerData,
                    backgroundColor: '#F97316',
                    borderRadius: 12,
                    maxBarThickness: 30
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: context => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.parsed.y) } }
                },
                scales: {
                    x: { ticks: { color: '#475569' }, grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#475569', callback: value => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value) },
                        grid: { color: 'rgba(148, 163, 184, 0.18)' }
                    }
                }
            }
        });
    }

    const pieCtx = document.getElementById('paymentMethodChart');
    if (pieCtx) {
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: paymentMethodLabels,
                datasets: [{
                    data: paymentMethodData,
                    backgroundColor: ['#22C55E', '#3B82F6', '#EF4444', '#F59E0B', '#8B5CF6', '#0EA5E9'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { color: '#334155' } },
                    tooltip: { callbacks: { label: context => `${context.label}: ${context.parsed}` } }
                }
            }
        });
    }
</script>
@endpush
