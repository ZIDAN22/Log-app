@extends('layouts.app')

@section('title', 'Edit Invoice')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Edit Invoice</h1>
                <p class="text-slate-600">Perbarui informasi pembayaran dan biaya invoice.</p>
            </div>
            <a href="{{ route('invoices.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4.5 w-4.5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                <strong>Periksa kembali form Anda:</strong>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-[1.8fr_1fr]">
            <div class="space-y-6">
                <form action="{{ route('invoices.update', $invoice) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-slate-900">Informasi Invoice</h2>
                                <p class="text-slate-600">Periksa kembali data invoice yang sudah terhubung dengan Packing List.</p>
                            </div>
                        </div>

                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Packing List</label>
                                <input type="text" readonly value="Packing List #{{ $invoice->packing_list_id }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-900" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700">No Invoice</label>
                                <input type="text" readonly value="{{ $invoice->invoice_number }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-900" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700">Tanggal Invoice</label>
                                <input type="date" name="invoice_date" value="{{ old('invoice_date', $invoice->invoice_date->format('Y-m-d')) }}" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700">Customer</label>
                                <input type="text" readonly value="{{ $invoice->customer_name }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-900" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700">No Resi</label>
                                <input type="text" readonly value="{{ $invoice->receipt_number }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-900" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700">Transportasi</label>
                                <input type="text" readonly value="{{ ucfirst($invoice->transportation_type ?? '-') }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-900" />
                            </div>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-900">Detail Barang</h2>
                        <p class="text-slate-600">Jumlah dan nilai barang berasal dari Packing List.</p>

                        <div class="mt-6 overflow-x-auto rounded-3xl border border-slate-200">
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
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-900">Perhitungan Biaya</h2>
                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">Total Barang (Packing List)</p>
                                <p class="mt-2 text-xl font-semibold text-slate-900">Rp {{ number_format($invoice->total_value, 0, ',', '.') }}</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">Total Berat</p>
                                <p class="mt-2 text-xl font-semibold text-slate-900">{{ number_format($invoice->total_weight, 2, ',', '.') }} kg</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">Tarif / kg</p>
                                <p class="mt-2 text-lg font-semibold text-slate-900">Rp {{ number_format($invoice->packingList->shipment->price_per_kg ?? 0, 0, ',', '.') }} / kg</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Biaya Tambahan (opsional)</label>
                                <input id="delivery_fee" name="delivery_fee" type="number" min="0" step="0.01" value="{{ old('delivery_fee', $invoice->delivery_fee) }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" />
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">Biaya Transport (Tarif × Berat)</p>
                                <p id="transport_base_display" class="mt-2 text-xl font-semibold text-slate-900">Rp {{ number_format(($invoice->packingList->shipment->price_per_kg ?? 0) * $invoice->total_weight, 0, ',', '.') }}</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">Grand Total</p>
                                <p id="grand_total" class="mt-2 text-xl font-semibold text-emerald-700">Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">PPN 1.1%</p>
                                <p id="ppn_amount" class="mt-2 text-lg font-semibold text-slate-900">Rp {{ number_format($invoice->ppn_amount, 0, ',', '.') }}</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">PPH 2%</p>
                                <p id="pph_amount" class="mt-2 text-lg font-semibold text-slate-900">Rp {{ number_format($invoice->pph_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-900">Pembayaran</h2>
                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Status Pembayaran</label>
                                <select name="payment_status" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                                    @foreach(\App\Models\Invoice::PAYMENT_STATUSES as $value)
                                        <option value="{{ $value }}" {{ old('payment_status', $invoice->payment_status) === $value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Metode Pembayaran</label>
                                <input name="payment_method" type="text" value="{{ old('payment_method', $invoice->payment_method) }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" />
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700">Catatan Invoice</label>
                                <textarea name="notes" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">{{ old('notes', $invoice->notes) }}</textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700">Upload Bukti Pembayaran</label>
                                <input name="proof_of_payment" type="file" accept="image/*,.pdf" class="mt-2 w-full text-slate-900" />
                                @if($invoice->proof_of_payment)
                                    <p class="mt-2 text-sm text-slate-600">File saat ini: <a href="{{ asset('storage/' . $invoice->proof_of_payment) }}" target="_blank" class="font-semibold text-emerald-700 hover:text-emerald-900">Lihat Bukti</a></p>
                                @endif
                            </div>
                        </div>
                    </section>

                    @include('components.form-action-buttons', [
                        'backUrl' => route('invoices.index'),
                        'backLabel' => 'Batal',
                        'submitLabel' => 'Perbarui Invoice',
                    ])
                </form>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Ringkasan Invoice</h2>
                    <div class="space-y-4 text-slate-700">
                        <div class="flex justify-between gap-4">
                            <span>Total Qty</span>
                            <strong>{{ $invoice->total_qty }}</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Total Berat</span>
                            <strong>{{ number_format($invoice->total_weight, 2, ',', '.') }} kg</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Total Nilai</span>
                            <strong>Rp {{ number_format($invoice->total_value, 0, ',', '.') }}</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Grand Total</span>
                            <strong id="card-grand-total" class="text-emerald-700">Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h3 class="text-lg font-semibold text-slate-900">Petunjuk</h3>
                    <p class="mt-3 text-sm text-slate-600 leading-relaxed">Update biaya pengiriman, status pembayaran, dan upload bukti bayar jika sudah tersedia.</p>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function formatCurrency(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
        }).format(value || 0);
    }

    function recalculate() {
        const deliveryFee = parseFloat(document.getElementById('delivery_fee').value) || 0;
        const totalWeight = parseFloat({{ $invoice->total_weight }});
        const transportPrice = parseFloat({{ $invoice->packingList->shipment->price_per_kg ?? 0 }});
        const baseTransport = transportPrice * totalWeight;
        const baseTotal = baseTransport + deliveryFee;
        const ppnAmount = baseTotal * 0.011;
        const pphAmount = baseTotal * 0.02;
        const grandTotal = baseTotal + ppnAmount - pphAmount;

        document.getElementById('ppn_amount').textContent = formatCurrency(ppnAmount);
        document.getElementById('pph_amount').textContent = formatCurrency(pphAmount);
        document.getElementById('grand_total').textContent = formatCurrency(grandTotal);
        document.getElementById('card-grand-total').textContent = formatCurrency(grandTotal);
        document.getElementById('transport_base_display').textContent = formatCurrency(baseTransport);
    }

    document.getElementById('delivery_fee').addEventListener('input', recalculate);
    document.addEventListener('DOMContentLoaded', recalculate);
</script>
@endpush
