@extends('layouts.app')

@section('title', 'Buat Invoice Baru')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">

        {{-- Header --}}
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">
                    Invoice
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    Buat Invoice Baru
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    Buat invoice otomatis berdasarkan packing list atau shipment,
                    lengkap dengan perhitungan biaya pengiriman.
                </p>
            </div>

            <a href="{{ route('invoices.index') }}"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>

                Kembali
            </a>
        </div>

        @if ($errors->any())
        <div class="mb-5 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            <p class="font-semibold">
                Ada data yang perlu diperbaiki.
            </p>

            <p class="mt-1">
                Periksa kembali field invoice sebelum menyimpan.
            </p>
        </div>
        @endif

        <form id="invoice-create-form" method="POST" action="{{ route('invoices.store') }}" class="space-y-6">
            @csrf

            <div class="grid gap-8 xl:grid-cols-[minmax(0,1fr)_360px]">

                {{-- LEFT CONTENT --}}
                <div class="space-y-6">

                    {{-- Nomor Dokumen --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="mb-5 flex flex-col gap-3 border-b border-slate-200 pb-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-base font-bold text-slate-950">
                                    Nomor Dokumen
                                </h2>

                                <p class="mt-1 text-sm text-slate-500">
                                    Nomor invoice dibuat otomatis ketika data disimpan.
                                </p>
                            </div>

                            <span class="inline-flex w-fit items-center rounded-md bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                Otomatis
                            </span>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nomor Invoice
                                </label>

                                <input type="text" disabled placeholder="Dibuat otomatis"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Tanggal Invoice
                                </label>

                                <input type="date" name="invoice_date" value="{{ old('invoice_date', now()->toDateString()) }}"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>

                        </div>
                    </section>

                    {{-- Packing List / Shipment --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">
                                Data Shipment / Packing List
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Pilih packing list untuk mengambil data customer dan berat otomatis.
                            </p>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Pilih Packing List
                                    <span class="text-rose-500">*</span>
                                </label>

                                <select id="packing_list_id" name="packing_list_id" required
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                    <option value="">Pilih packing list</option>
                                    @foreach($packingLists as $packingList)
                                        <option value="{{ $packingList->id }}" {{ old('packing_list_id') == $packingList->id ? 'selected' : '' }}>
                                            {{ $packingList->shipment->receipt_number ?? $packingList->shipment->receipt_number ?? 'PL-' . $packingList->id }}
                                            - {{ $packingList->shipment->receiver_name ?? 'Pelanggan' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    No Resi
                                </label>

                                <input type="text" id="receipt_number" readonly placeholder="Terisi otomatis"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Customer
                                </label>

                                <input type="text" id="customer_name" readonly placeholder="Terisi otomatis"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                        </div>

                        <div class="mt-5 rounded-lg border border-slate-200 bg-white p-4">
                            <h3 class="text-sm font-bold text-slate-900">Detail Barang (otomatis)</h3>
                            <p class="mt-1 text-sm text-slate-500">Item diambil langsung dari Packing List. Tidak ada input manual.</p>

                            <div class="mt-4 overflow-x-auto rounded-lg border border-slate-200">
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
                                            <td colspan="7" class="px-4 py-6 text-center text-slate-500">Pilih packing list untuk menampilkan daftar barang.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    {{-- Perhitungan Invoice --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">
                                Detail Perhitungan Invoice
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Sistem menghitung total invoice otomatis berdasarkan berat dan biaya pengiriman.
                            </p>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Berat Total (KG)
                                </label>

                                <input type="number" id="total_weight" name="total_weight" step="0.01" readonly placeholder="0.00"
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Harga per KG
                                    <span class="text-rose-500">*</span>
                                </label>

                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-500">Rp</span>

                                    <input type="number" id="price_per_kg" name="price_per_kg" readonly placeholder="0.00" value="0"
                                        class="h-11 w-full rounded-lg border border-slate-300 border-slate-200 bg-slate-100 pl-10 pr-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                                </div>
                            </div>



                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">PPN</label>
                                <input type="text" id="tax" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-50 px-3 text-sm" />
                                <input type="hidden" id="ppn_amount" name="ppn_amount" value="{{ old('ppn_amount', 0) }}" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">PPH</label>
                                <input type="text" id="discount" readonly
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-slate-50 px-3 text-sm" />
                                <input type="hidden" id="pph_amount" name="pph_amount" value="{{ old('pph_amount', 0) }}" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Grand Total</label>

                                <div class="flex h-11 items-center rounded-lg border border-emerald-200 bg-emerald-50 px-4">
                                    <span id="grand-total-preview" class="text-lg font-bold text-emerald-700">Rp 0</span>
                                </div>

                                <input type="hidden" id="grand_total" name="grand_total" value="0" />
                            </div>

                            {{-- hidden ringkasan untuk tetap kompatibel backend yang sebelumnya menghitung grand_total --}}
                            <input type="hidden" id="summary-total-qty" value="0" />
                        </div>
                    </section>

                    {{-- Termin Pembayaran --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="mb-5 border-b border-slate-200 pb-4">
                            <h2 class="text-base font-bold text-slate-950">Pembayaran</h2>

                            <p class="mt-1 text-sm text-slate-500">Lengkapi status pembayaran dan catatan invoice.</p>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Status Pembayaran</label>
                                <select name="payment_status"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                                    <option value="">Pilih Status</option>
                                    @foreach(
                                        [\App\Models\Invoice::STATUS_UNPAID => 'Belum Bayar', \App\Models\Invoice::STATUS_DP => 'DP', \App\Models\Invoice::STATUS_PAID => 'Lunas'] as $value => $label
                                    )
                                        <option value="{{ $value }}" {{ old('payment_status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Metode Pembayaran</label>
                                <select id="payment_method_id" name="payment_method_id"
                                    class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                    <option value="">Pilih metode (atau ketik manual)</option>
                                    @foreach($paymentMethods as $method)
                                        <option value="{{ $method->id }}" {{ old('payment_method_id') == $method->id ? 'selected' : '' }}>
                                            {{ $method->method_name }}@if($method->bank_name) - {{ $method->bank_name }}@endif
                                        </option>
                                    @endforeach
                                </select>

                                <input name="payment_method" id="payment_method_input" type="text" value="{{ old('payment_method') }}"
                                    placeholder="Ketik metode pembayaran jika tidak ada dalam daftar"
                                    class="mt-2 h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Catatan Invoice</label>
                                <textarea name="notes" rows="4" class="mt-0 w-full rounded-lg border border-slate-300 bg-white px-3 py-3 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ old('notes') }}</textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Bank</label>
                                <input name="bank_name" type="text" value="{{ old('bank_name') }}"
                                    readonly
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">No Rek</label>
                                <input name="bank_account_number" type="text" value="{{ old('bank_account_number') }}"
                                    readonly
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Atas Nama (AN)</label>
                                <input name="bank_account_name" type="text" value="{{ old('bank_account_name') }}"
                                    readonly
                                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-100 px-3 text-sm text-slate-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                            </div>


                        </div>
                    </section>

                </div>

                {{-- RIGHT SIDEBAR --}}
                <aside class="space-y-4 xl:sticky xl:top-6 xl:self-start">

                    {{-- Ringkasan --}}
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

                        <h2 class="text-base font-bold text-slate-950">
                            Ringkasan Invoice
                        </h2>

                        <dl class="mt-4 space-y-4 text-sm">

                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">Customer</dt>

                                <dd id="summary-customer" class="font-semibold text-slate-900">-</dd>
                            </div>

                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">No Resi</dt>

                                <dd id="summary-receipt" class="font-semibold text-slate-900">-</dd>
                            </div>

                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <dt class="text-slate-500">Berat</dt>

                                <dd id="summary-weight" class="font-semibold text-slate-900">0 KG</dd>
                            </div>



                            <div class="flex items-center justify-between">
                                <dt class="text-slate-500">Grand Total</dt>

                                <dd id="summary-grand-total" class="text-lg font-bold text-emerald-600">Rp 0</dd>
                            </div>

                        </dl>
                    </section>

                    {{-- Info --}}
                    <section class="rounded-lg border border-blue-100 bg-blue-50 p-5 text-sm text-blue-900">
                        <p class="font-semibold">Invoice otomatis</p>

                        <p class="mt-2 leading-6">
                            Sistem mengambil data packing list dan menghitung biaya pengiriman secara otomatis.
                        </p>
                    </section>

                </aside>

            </div>

            {{-- Footer Action --}}
            <div class="flex flex-col gap-3 rounded-lg border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">

                <p class="text-sm text-slate-500">
                    Pastikan seluruh biaya invoice telah diperiksa sebelum menyimpan.
                </p>

                <div class="flex flex-col gap-3 sm:flex-row">

                    <a href="{{ route('invoices.index') }}"
                        class="inline-flex h-11 items-center justify-center rounded-lg border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>

                    <button id="submit-invoice-button" type="submit"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>

                        <span>Simpan Invoice</span>
                    </button>

                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const packingLists = @json($packingLists->keyBy('id'));
    const paymentMethods = @json($paymentMethods->keyBy('id'));

    function formatRupiah(num) {
        return 'Rp ' + Number(num).toLocaleString('id-ID');
    }

    const invoiceItemsBody = document.getElementById('invoice-items-body');
    const packingListSelect = document.getElementById('packing_list_id');
    const paymentMethodSelect = document.getElementById('payment_method_id');
    const paymentMethodInput = document.getElementById('payment_method_input');

    const receiptInput = document.getElementById('receipt_number');
    const customerInput = document.getElementById('customer_name');

    const totalWeightInput = document.getElementById('total_weight');
    const pricePerKgInput = document.getElementById('price_per_kg');

    // delivery fee dihapus dari form, jadi tidak dipakai di perhitungan.


    const taxInput = document.getElementById('tax');
    const pphInput = document.getElementById('discount');

    const grandTotalHidden = document.getElementById('grand_total');
    const grandTotalPreview = document.getElementById('grand-total-preview');

    const summaryCustomer = document.getElementById('summary-customer');
    const summaryReceipt = document.getElementById('summary-receipt');
    const summaryWeight = document.getElementById('summary-weight');
    const summaryGrandTotal = document.getElementById('summary-grand-total');

    const bankNameInput = document.querySelector('input[name="bank_name"]');
    const bankAccountNumberInput = document.querySelector('input[name="bank_account_number"]');
    const bankAccountNameInput = document.querySelector('input[name="bank_account_name"]');

    function resetUI() {
        receiptInput.value = '';
        customerInput.value = '';
        totalWeightInput.value = 0;

        pricePerKgInput.value = 0;
        invoiceItemsBody.innerHTML = '<tr><td colspan="7" class="px-4 py-6 text-center text-slate-500">Pilih packing list untuk menampilkan daftar barang.</td></tr>';

        grandTotalHidden.value = 0;
        grandTotalPreview.textContent = formatRupiah(0);
        summaryGrandTotal.textContent = formatRupiah(0);

        // reset tax/pph display and hidden values
        if (taxInput) taxInput.value = formatRupiah(0);
        if (pphInput) pphInput.value = formatRupiah(0);
        const ppnHidden = document.getElementById('ppn_amount');
        const pphHidden = document.getElementById('pph_amount');
        if (ppnHidden) ppnHidden.value = 0;
        if (pphHidden) pphHidden.value = 0;

        summaryCustomer.textContent = '-';
        summaryReceipt.textContent = '-';
        summaryWeight.textContent = '0 KG';
    }

    function updateInvoicePreview() {
        const selectedId = packingListSelect.value;
        const deliveryFee = 0;

        // taxInput/pphInput sekarang menampilkan nominal (format Rupiah),
        // ambil nominal PPN/PPH dari shipment jika ada.

        if (!selectedId || !packingLists[selectedId]) {
            resetUI();
            return;
        }

        const packingList = packingLists[selectedId];
        const shipment = packingList.shipment || {};

        const totalWeight = parseFloat(packingList.total_weight) || 0;
        const totalQty = packingList.total_qty || 0;

        // Ambil harga per kg dari shipment (transport price per kg)
        const pricePerKg = parseFloat(shipment.price_per_kg) || 0;

        receiptInput.value = shipment.receipt_number || '';
        customerInput.value = shipment.sender_name || shipment.receiver_name || '';

        summaryCustomer.textContent = customerInput.value || '-';
        summaryReceipt.textContent = receiptInput.value || '-';
        summaryWeight.textContent = totalWeight + ' KG';

        totalWeightInput.value = totalWeight;
        pricePerKgInput.value = pricePerKg;

        // Hitung: PPn dan PPH di-*invoice* sebagai nominal (bukan persentase)
        // Sesuai permintaan: nominal PPn/PPH dihitung dari total harga (harga per kg * berat).
        // Tax & pph input di halaman ini dianggap sebagai nilai nominal, sehingga:
        // ppnAmount = baseTransport * (tax/100)
        // pphAmount = baseTransport * (pph/100)
        const baseTransport = pricePerKg * totalWeight;
        const baseTotal = baseTransport + deliveryFee;

        const shipmentPpn = parseFloat(shipment.ppn) || 0;
        const shipmentPph = parseFloat(shipment.pph) || 0;

        // Jika shipment memberikan nilai nominal PPN/PPH, gunakan itu.
        // Jika tidak tersedia, fallback ke perhitungan persentase (1.1% dan 2%) dari baseTransport.
        const ppnAmount = shipmentPpn || (baseTransport * 0.011);
        const pphAmount = shipmentPph || (baseTransport * 0.02);

        const grandTotal = baseTotal + ppnAmount - pphAmount;

        // Tampilkan nominal sebagai Rupiah di field readonly, dan simpan nominal di hidden inputs.
        taxInput.value = formatRupiah(ppnAmount);
        pphInput.value = formatRupiah(pphAmount);
        const ppnHidden = document.getElementById('ppn_amount');
        const pphHidden = document.getElementById('pph_amount');
        if (ppnHidden) ppnHidden.value = Number(ppnAmount).toFixed(2);
        if (pphHidden) pphHidden.value = Number(pphAmount).toFixed(2);


        grandTotalHidden.value = grandTotal;
        grandTotalPreview.textContent = formatRupiah(grandTotal);
        summaryGrandTotal.textContent = formatRupiah(grandTotal);

        // Render items
        const rows = (packingList.items && packingList.items.length > 0)
            ? packingList.items.map(item => `
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-4 py-4 text-slate-700">${item.item_name}</td>
                    <td class="px-4 py-4 text-center text-slate-700">${item.qty}</td>
                    <td class="px-4 py-4 text-center text-slate-700">${item.packaging_type}</td>
                    <td class="px-4 py-4 text-center text-slate-700">${item.total_packaging}</td>
                    <td class="px-4 py-4 text-right text-slate-700">${parseFloat(item.weight || 0).toFixed(2)}</td>
                    <td class="px-4 py-4 text-right text-slate-700">${formatRupiah(parseFloat(item.unit_price || 0))}</td>
                    <td class="px-4 py-4 text-right text-slate-900 font-semibold">${formatRupiah(parseFloat(item.subtotal_price || 0))}</td>
                </tr>
            `)
            : ['<tr><td colspan="7" class="px-4 py-6 text-center text-slate-500">Tidak ada item pada Packing List ini.</td></tr>'];

        invoiceItemsBody.innerHTML = rows.join('');
    }

    // Event listeners
    if (packingListSelect) packingListSelect.addEventListener('change', updateInvoicePreview);
    if (paymentMethodSelect) paymentMethodSelect.addEventListener('change', onPaymentMethodChange);


    // Saat load awal
    document.addEventListener('DOMContentLoaded', function () {
        resetUI();
        updateInvoicePreview();
        // initialize payment method fields based on selection (if any)
        onPaymentMethodChange();
    });

    function onPaymentMethodChange() {
        if (!paymentMethodSelect) return;

        const id = paymentMethodSelect.value;

        if (!id) {
            if (paymentMethodInput) paymentMethodInput.readOnly = false;
            if (bankNameInput) bankNameInput.readOnly = false;
            if (bankAccountNumberInput) bankAccountNumberInput.readOnly = false;
            if (bankAccountNameInput) bankAccountNameInput.readOnly = false;
            return;
        }

        const method = paymentMethods[id] || {};

        if (paymentMethodInput) {
            paymentMethodInput.value = method.method_name || '';
            paymentMethodInput.readOnly = true;
        }

        if (bankNameInput) {
            bankNameInput.value = method.bank_name || '';
            bankNameInput.readOnly = true;
        }

        if (bankAccountNumberInput) {
            bankAccountNumberInput.value = method.account_number || '';
            bankAccountNumberInput.readOnly = true;
        }

        if (bankAccountNameInput) {
            bankAccountNameInput.value = method.account_name || '';
            bankAccountNameInput.readOnly = true;
        }
    }
</script>
@endpush

