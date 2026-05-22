@extends('layouts.app')

@section('title', 'Buat Invoice Baru')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Buat Invoice Baru</h1>
                <p class="text-slate-600">Buat invoice secara otomatis dari Packing List yang sudah selesai.</p>
            </div>
            <a href="{{ route('invoices.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">Kembali ke Daftar</a>
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
                <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-slate-900">Informasi Invoice</h2>
                                <p class="text-slate-600">Pilih Packing List lalu periksa data otomatis.</p>
                            </div>
                        </div>

                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Packing List</label>
                                <select id="packing_list_id" name="packing_list_id" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                                    <option value="">Pilih Packing List</option>
                                    @foreach($packingLists as $packingList)
                                        <option value="{{ $packingList->id }}" {{ old('packing_list_id') == $packingList->id ? 'selected' : '' }}>
                                            {{ $packingList->shipment->invoice_number ?? 'PL-' . $packingList->id }} • {{ $packingList->shipment->receiver_name ?? 'Pelanggan' }} • {{ $packingList->packing_date->format('d M Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700">No Invoice</label>
                                <input id="invoice_number" type="text" name="invoice_number" readonly value="{{ old('invoice_number') }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-900" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700">Tanggal Invoice</label>
                                <input type="date" name="invoice_date" value="{{ old('invoice_date', now()->format('Y-m-d')) }}" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700">Customer</label>
                                <input id="customer_name" type="text" readonly class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-900" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700">No Resi</label>
                                <input id="receipt_number" type="text" readonly class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-900" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700">Transportasi</label>
                                <input id="transportation_type" type="text" readonly class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-900" />
                            </div>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-900">Detail Barang</h2>
                        <p class="text-slate-600">Item diambil langsung dari Packing List. Tidak ada input manual.</p>

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
                                <tbody id="invoice-items-body" class="divide-y divide-slate-200 bg-white">
                                    <tr>
                                        <td colspan="7" class="px-4 py-6 text-center text-slate-500">Pilih Packing List untuk menampilkan daftar barang.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-900">Perhitungan Biaya</h2>
                        <p class="text-slate-600">Gunakan biaya pengiriman untuk menghitung total invoice secara otomatis.</p>

                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">Total Barang</p>
                                <p id="summary-total-value" class="mt-2 text-xl font-semibold text-slate-900">Rp 0</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">Total Qty</p>
                                <p id="summary-total-qty" class="mt-2 text-xl font-semibold text-slate-900">0</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-sm text-slate-500">Total Berat</p>
                                <p id="summary-total-weight" class="mt-2 text-xl font-semibold text-slate-900">0 kg</p>
                            </div>
                            <div class="grid gap-4 sm:col-span-2">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Biaya Tambahan (opsional)</label>
                                    <input id="delivery_fee" name="delivery_fee" type="number" min="0" step="0.01" value="{{ old('delivery_fee', 0) }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" />
                                </div>
                                <div class="grid gap-4 sm:grid-cols-3">
                                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                        <p class="text-sm text-slate-500">PPN 1.1%</p>
                                        <p id="ppn_amount" class="mt-2 text-lg font-semibold text-slate-900">Rp 0</p>
                                    </div>
                                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                        <p class="text-sm text-slate-500">PPH 2%</p>
                                        <p id="pph_amount" class="mt-2 text-lg font-semibold text-slate-900">Rp 0</p>
                                    </div>
                                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                        <p class="text-sm text-slate-500">Grand Total</p>
                                        <p id="grand_total" class="mt-2 text-lg font-semibold text-emerald-700">Rp 0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-900">Pembayaran</h2>
                        <p class="text-slate-600">Lengkapi status pembayaran dan upload bukti jika tersedia.</p>

                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Status Pembayaran</label>
                                <select name="payment_status" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                                    <option value="">Pilih Status</option>
                                    @foreach(
                                        [\App\Models\Invoice::STATUS_UNPAID => 'Belum Bayar', \App\Models\Invoice::STATUS_DP => 'DP', \App\Models\Invoice::STATUS_PAID => 'Lunas'] as $value => $label
                                    )
                                        <option value="{{ $value }}" {{ old('payment_status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Metode Pembayaran</label>
                                <input name="payment_method" type="text" value="{{ old('payment_method') }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" />
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700">Catatan Invoice</label>
                                <textarea name="notes" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">{{ old('notes') }}</textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700">Upload Bukti Pembayaran</label>
                                <input name="proof_of_payment" type="file" accept="image/*,.pdf" class="mt-2 w-full text-slate-900" />
                            </div>
                        </div>
                    </section>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <a href="{{ route('invoices.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">Batal</a>
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-700 transition">Simpan Invoice</button>
                    </div>
                </form>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Ringkasan Invoice</h2>
                    <div class="space-y-4 text-slate-700">
                        <div class="flex justify-between gap-4">
                            <span>Total Qty</span>
                            <strong id="card-total-qty">0</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Total Berat</span>
                            <strong id="card-total-weight">0 kg</strong>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span>Total Nilai</span>
                            <strong id="card-total-value">Rp 0</strong>
                        </div>
                        <div class="flex justify-between gap-4 border-t border-slate-200 pt-4">
                            <span>Grand Total</span>
                            <strong id="card-grand-total" class="text-emerald-700">Rp 0</strong>
                        </div>
                    </div>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h3 class="text-lg font-semibold text-slate-900">Petunjuk Singkat</h3>
                    <p class="mt-3 text-sm text-slate-600 leading-relaxed">Invoice dibuat otomatis dari Packing List. Hanya isi biaya pengiriman dan status pembayaran. Semua item, qty, berat, dan subtotal akan terisi otomatis.</p>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const packingLists = @json($packingLists->keyBy('id'));

    function formatCurrency(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
        }).format(value || 0);
    }

    function updateInvoicePreview() {
        const select = document.getElementById('packing_list_id');
        const deliveryFeeInput = document.getElementById('delivery_fee');
        const invoiceNumberInput = document.getElementById('invoice_number');
        const customerInput = document.getElementById('customer_name');
        const receiptInput = document.getElementById('receipt_number');
        const transportInput = document.getElementById('transportation_type');
        const itemsBody = document.getElementById('invoice-items-body');

        const selectedId = select.value;
        const deliveryFee = parseFloat(deliveryFeeInput.value) || 0;

        if (!selectedId || !packingLists[selectedId]) {
            invoiceNumberInput.value = '';
            customerInput.value = '';
            receiptInput.value = '';
            transportInput.value = '';
            itemsBody.innerHTML = '<tr><td colspan="7" class="px-4 py-6 text-center text-slate-500">Pilih Packing List untuk menampilkan daftar barang.</td></tr>';
            document.getElementById('summary-total-qty').textContent = '0';
            document.getElementById('summary-total-weight').textContent = '0 kg';
            document.getElementById('summary-total-value').textContent = 'Rp 0';
            document.getElementById('card-total-qty').textContent = '0';
            document.getElementById('card-total-weight').textContent = '0 kg';
            document.getElementById('card-total-value').textContent = 'Rp 0';
            document.getElementById('ppn_amount').textContent = 'Rp 0';
            document.getElementById('pph_amount').textContent = 'Rp 0';
            document.getElementById('grand_total').textContent = 'Rp 0';
            document.getElementById('card-grand-total').textContent = 'Rp 0';
            return;
        }

        const packingList = packingLists[selectedId];
        const shipment = packingList.shipment || {};
        const totalQty = packingList.total_qty || 0;
        const totalWeight = parseFloat(packingList.total_weight) || 0;
        const packingTotalValue = parseFloat(packingList.total_value) || 0;

        const transportPrice = parseFloat(shipment.price_per_kg) || 0;
        const baseTransport = transportPrice * totalWeight;
        const baseTotal = baseTransport + deliveryFee;
        const ppnAmount = baseTotal * 0.011;
        const pphAmount = baseTotal * 0.02;
        const grandTotal = baseTotal + ppnAmount - pphAmount;

        invoiceNumberInput.value = shipment.invoice_number || '';
        customerInput.value = shipment.sender_name || shipment.receiver_name || '';
        receiptInput.value = shipment.receipt_number || '';
        transportInput.value = shipment.transportation_type || '';

        const rows = packingList.items && packingList.items.length > 0
            ? packingList.items.map(item => `
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-4 py-4 text-slate-700">${item.item_name}</td>
                    <td class="px-4 py-4 text-center text-slate-700">${item.qty}</td>
                    <td class="px-4 py-4 text-center text-slate-700">${item.packaging_type}</td>
                    <td class="px-4 py-4 text-center text-slate-700">${item.total_packaging}</td>
                    <td class="px-4 py-4 text-right text-slate-700">${parseFloat(item.weight || 0).toFixed(2)}</td>
                    <td class="px-4 py-4 text-right text-slate-700">${formatCurrency(item.unit_price)}</td>
                    <td class="px-4 py-4 text-right text-slate-900 font-semibold">${formatCurrency(item.subtotal_price)}</td>
                </tr>`)
            : ['<tr><td colspan="7" class="px-4 py-6 text-center text-slate-500">Tidak ada item pada Packing List ini.</td></tr>'];

        itemsBody.innerHTML = rows.join('');
        document.getElementById('summary-total-qty').textContent = totalQty;
        document.getElementById('summary-total-weight').textContent = `${totalWeight.toFixed(2)} kg`;
        document.getElementById('summary-total-value').textContent = formatCurrency(packingTotalValue);
        document.getElementById('card-total-qty').textContent = totalQty;
        document.getElementById('card-total-weight').textContent = `${totalWeight.toFixed(2)} kg`;
        document.getElementById('card-total-value').textContent = formatCurrency(baseTransport);
        document.getElementById('ppn_amount').textContent = formatCurrency(ppnAmount);
        document.getElementById('pph_amount').textContent = formatCurrency(pphAmount);
        document.getElementById('grand_total').textContent = formatCurrency(grandTotal);
        document.getElementById('card-grand-total').textContent = formatCurrency(grandTotal);
    }

    document.getElementById('packing_list_id').addEventListener('change', updateInvoicePreview);
    document.getElementById('delivery_fee').addEventListener('input', updateInvoicePreview);
    document.addEventListener('DOMContentLoaded', updateInvoicePreview);
</script>
@endpush
