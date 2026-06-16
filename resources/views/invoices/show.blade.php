@extends('layouts.app')

@section('title', 'Detail Invoice')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Detail Invoice</h1>
                <p class="text-slate-600">Lihat ringkasan invoice yang diambil dari Packing List.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('invoices.print-pdf', $invoice) }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3M6 9h12v8H6V9zm3 7h6" />
                    </svg>
                    Print PDF
                </a>
                <a href="{{ route('invoices.edit', $invoice) }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232a2.062 2.062 0 0 1 2.916 2.916L7.75 18.646a.75.75 0 0 1-.338.197l-4 1a.75.75 0 0 1-.928-.928l1-4a.75.75 0 0 1 .197-.338l10.75-10.75Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 5l3 3" />
                    </svg>
                    Edit
                </a>
                <a href="{{ route('invoices.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <p class="text-sm text-slate-500">No Invoice</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $invoice->invoice_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Tanggal Invoice</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $invoice->invoice_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">No Resi</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $invoice->receipt_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Status Pembayaran</p>
                            <span class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold {{ $invoice->paymentStatusBadge() }}">{{ $invoice->payment_status }}</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Customer</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $invoice->customer_name }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Transportasi</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ ucfirst($invoice->transportation_type ?? '-') }}</p>
                            <p class="mt-3 text-sm text-slate-600">Metode: {{ $invoice->payment_method ?: 'Belum diisi' }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Detail Barang</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-50 text-slate-700">
                                <tr>
                                    <th class="px-4 py-3 text-left">Nama Barang</th>
                                    <th class="px-4 py-3 text-center">Qty</th>
                                    <th class="px-4 py-3 text-center">Packaging</th>
                                    <th class="px-4 py-3 text-center">Total Packaging</th>
                                    <th class="px-4 py-3 text-right">Berat</th>
                                    <th class="px-4 py-3 text-right">Harga Unit</th>
                                    <th class="px-4 py-3 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach($invoice->packingList->items as $item)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-4 py-4 text-slate-700">{{ $item->item_name }}</td>
                                        <td class="px-4 py-4 text-center text-slate-700">{{ $item->qty }}</td>
                                        <td class="px-4 py-4 text-center text-slate-700">{{ $item->packaging_type }}</td>
                                        <td class="px-4 py-4 text-center text-slate-700">{{ $item->total_packaging }}</td>
                                        <td class="px-4 py-4 text-right text-slate-700">{{ number_format($item->weight, 2, ',', '.') }}</td>
                                        <td class="px-4 py-4 text-right text-slate-700">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4 text-right text-slate-900 font-semibold">Rp {{ number_format($item->subtotal_price, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Ringkasan Pembayaran</h2>
                    <div class="space-y-4 text-slate-700">
                        <div class="flex justify-between gap-4">
                            <span>Total Qty</span>
                            <strong>{{ $invoice->total_qty }}</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Total Berat</span>
                            <strong>{{ number_format($invoice->total_weight, 2, ',', '.') }} kg</strong>
                        </div>
                        {{-- <div class="flex justify-between gap-4">
                            <span>Total Nilai</span>
                            <strong>Rp {{ number_format($invoice->total_value, 0, ',', '.') }}</strong>
                        </div> --}}
                        <div class="flex justify-between gap-4">
                            <span>Tarif / kg</span>
                            <strong>Rp {{ number_format($invoice->packingList->shipment->price_per_kg ?? 0, 0, ',', '.') }} / kg</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Transportasi (Tarif × Berat)</span>
                            <strong>Rp {{ number_format(($invoice->packingList->shipment->price_per_kg ?? 0) * $invoice->total_weight, 0, ',', '.') }}</strong>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span>PPN 1.1%</span>
                            <strong>Rp {{ number_format($invoice->ppn_amount, 0, ',', '.') }}</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>PPH 2%</span>
                            <strong>Rp {{ number_format($invoice->pph_amount, 0, ',', '.') }}</strong>
                        </div>
                        <div class="flex justify-between gap-4 border-t border-slate-200 pt-4">
                            <span class="text-slate-700">Grand Total</span>
                            <strong class="text-emerald-700">Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h3 class="text-lg font-semibold text-slate-900">Catatan</h3>
                    <p class="mt-3 text-sm text-slate-600 leading-relaxed">{{ $invoice->notes ?: 'Tidak ada catatan tambahan.' }}</p>
                </div>

                @if($invoice->proof_of_payment)
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Bukti Pembayaran</h3>
                        <a href="{{ asset('storage/' . $invoice->proof_of_payment) }}" target="_blank" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition">Lihat Bukti</a>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</div>
@endsection
