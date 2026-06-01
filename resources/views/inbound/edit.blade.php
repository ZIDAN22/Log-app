@extends('layouts.app')

@section('title', 'Ubah Inbound')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">

    <div class="max-w-[1800px] mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Ubah Inbound</h1>
                <p class="text-slate-600">
                    Perbarui informasi inbound untuk shipment {{ $inbound->shipment->invoice_number }}.
                </p>
            </div>

            <a href="{{ route('inbound.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">

                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>

                Kembali
            </a>
        </div>

        @if($errors->any())
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 text-sm text-red-700">
            <p class="font-semibold">Periksa kembali data berikut:</p>

            <ul class="mt-3 list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-[2.4fr_0.8fr]">

            {{-- FORM --}}
            <div class="space-y-6">

                <form method="POST" action="{{ route('inbound.update', $inbound) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="shipment_id" value="{{ $inbound->shipment->id }}" />

                    {{-- INFORMASI --}}
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

                        <div class="grid gap-6 lg:grid-cols-3">

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">
                                    Shipment
                                </label>

                                <div class="rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900">
                                    {{ $inbound->shipment->receipt_number }}
                                    •
                                    {{ $inbound->shipment->invoice_number }}
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">
                                    Tanggal Inbound
                                </label>

                                <input
                                    type="date"
                                    name="inbound_date"
                                    value="{{ old('inbound_date', $inbound->inbound_date?->toDateString()) }}"
                                    required
                                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" />
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">
                                    Catatan Ringkas
                                </label>

                                <textarea
                                    name="notes"
                                    rows="3"
                                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">{{ old('notes', $inbound->notes) }}</textarea>
                            </div>

                        </div>

                    </section>

                    {{-- DETAIL BARANG --}}
                    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">

                        <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                            <div>
                                <h2 class="text-xl font-semibold text-slate-900">
                                    Detail Barang
                                </h2>

                                <p class="text-sm text-slate-600">
                                    Perbarui daftar barang yang diterima.
                                </p>
                            </div>

                            <button
                                type="button"
                                id="add-item"
                                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>

                                Tambah Item
                            </button>

                        </div>

                        <div class="overflow-x-auto">

                            <table id="inbound-items" class="min-w-[1400px] w-full divide-y divide-slate-200 text-sm">

                                <thead class="bg-slate-100 text-slate-700">
                                    <tr>
                                        <th class="w-[260px] px-4 py-3 text-left">Nama Barang</th>
                                        <th class="w-[170px] px-4 py-3 text-left">Packaging</th>
                                        <th class="w-[140px] px-4 py-3 text-center">Total Packaging</th>
                                        <th class="w-[120px] px-4 py-3 text-center">Qty</th>
                                        <th class="w-[140px] px-4 py-3 text-center">Berat (kg)</th>
                                        <th class="w-[180px] px-4 py-3 text-right">Harga / Unit</th>
                                        <th class="w-[180px] px-4 py-3 text-right">Subtotal</th>
                                        <th class="w-[260px] px-4 py-3 text-left">Catatan</th>
                                        <th class="w-[100px] px-4 py-3 text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-slate-200 bg-white">

                                    @php
                                    $oldItems = old('items', $inbound->items->toArray());
                                    @endphp

                                    @if(count($oldItems) === 0)
                                    @php
                                    $oldItems = [[
                                    'item_name' => '',
                                    'packaging_type' => 'Box',
                                    'total_packaging' => 1,
                                    'qty' => 1,
                                    'weight' => 0,
                                    'unit_price' => 0,
                                    'item_notes' => ''
                                    ]];
                                    @endphp
                                    @endif

                                    @foreach($oldItems as $index => $item)

                                    <tr class="hover:bg-slate-50 transition">

                                        <td class="px-4 py-3">
                                            <input
                                                type="text"
                                                data-name="item_name"
                                                name="items[{{ $index }}][item_name]"
                                                value="{{ $item['item_name'] ?? '' }}"
                                                required
                                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" />
                                        </td>

                                        <td class="px-4 py-3">
                                            <select
                                                data-name="packaging_type"
                                                name="items[{{ $index }}][packaging_type]"
                                                required
                                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100">

                                                @foreach(['Box','Pallet','Drum','Sack','Crate','Unit','Lainnya'] as $type)
                                                <option value="{{ $type }}"
                                                    {{ ($item['packaging_type'] ?? '') === $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="px-4 py-3">
                                            <input
                                                type="number"
                                                min="1"
                                                step="1"
                                                data-name="total_packaging"
                                                name="items[{{ $index }}][total_packaging]"
                                                value="{{ $item['total_packaging'] ?? 1 }}"
                                                required
                                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-center text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                                        </td>

                                        <td class="px-4 py-3">
                                            <input
                                                type="number"
                                                min="1"
                                                step="1"
                                                data-name="qty"
                                                name="items[{{ $index }}][qty]"
                                                value="{{ $item['qty'] ?? 1 }}"
                                                required
                                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-center text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                                        </td>

                                        <td class="px-4 py-3">
                                            <input
                                                type="number"
                                                min="0"
                                                step="0.01"
                                                data-name="weight"
                                                name="items[{{ $index }}][weight]"
                                                value="{{ $item['weight'] ?? 0 }}"
                                                required
                                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-center text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                                        </td>

                                        <td class="px-4 py-3">
                                            <input
                                                type="number"
                                                min="0"
                                                step="0.01"
                                                data-name="unit_price"
                                                name="items[{{ $index }}][unit_price]"
                                                value="{{ $item['unit_price'] ?? 0 }}"
                                                required
                                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-right text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" />
                                        </td>

                                        <td class="px-4 py-3">
                                            <input
                                                type="text"
                                                readonly
                                                data-name="subtotal_price"
                                                name="items[{{ $index }}][subtotal_price]"
                                                value="{{ number_format(($item['qty'] ?? 0) * ($item['unit_price'] ?? 0), 2, '.', '') }}"
                                                class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-right text-slate-900" />
                                        </td>

                                        <td class="px-4 py-3">
                                            <input
                                                type="text"
                                                data-name="item_notes"
                                                name="items[{{ $index }}][item_notes]"
                                                value="{{ $item['item_notes'] ?? '' }}"
                                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" />
                                        </td>

                                        <td class="px-4 py-3 text-center">
                                            <button
                                                type="button"
                                                class="remove-item inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-red-100 text-red-700 transition hover:bg-red-200"
                                                title="Hapus Item">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>

                                            </button>
                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </section>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

                        <h2 class="mb-5 text-xl font-semibold text-slate-900">
                            Ringkasan Inbound
                        </h2>

                        <div class="space-y-4 text-slate-700">

                            <div class="flex items-center justify-between">
                                <span>Total Qty</span>
                                <strong id="summary-qty">0</strong>
                            </div>

                            <div class="flex items-center justify-between">
                                <span>Total Berat</span>
                                <strong id="summary-weight">0.00 kg</strong>
                            </div>

                            <div class="flex items-center justify-between">
                                <span>Total Package</span>
                                <strong id="summary-package">0</strong>
                            </div>

                            <div class="flex items-center justify-between">
                                <span>Total Nilai</span>
                                <strong id="summary-value" class="text-emerald-700">
                                    Rp 0
                                </strong>
                            </div>

                        </div>

                    </div>

                    @include('components.form-action-buttons', [
                    'backUrl' => route('inbound.index'),
                    'backLabel' => 'Batal',
                    'submitLabel' => 'Simpan Perubahan',
                    ])

                </form>

            </div>



        </div>

    </div>

</div>

@push('scripts')
<script>
    const itemTable = document.querySelector('#inbound-items tbody');
    const addItemButton = document.querySelector('#add-item');

    function updateSummary() {
        const rows = Array.from(itemTable.querySelectorAll('tr'));
        let totalQty = 0;
        let totalWeight = 0;
        let totalPackaging = 0;
        let totalValue = 0;

        rows.forEach(row => {
            const qty = parseFloat(row.querySelector('[data-name="qty"]').value) || 0;
            const weight = parseFloat(row.querySelector('[data-name="weight"]').value) || 0;
            const packaging = parseInt(row.querySelector('[data-name="total_packaging"]').value) || 0;
            const value = parseFloat(row.querySelector('[data-name="subtotal_price"]').value) || 0;

            totalQty += qty;
            totalWeight += weight;
            totalPackaging += packaging;
            totalValue += value;
        });

        document.querySelector('#summary-qty').textContent = totalQty;
        document.querySelector('#summary-weight').textContent = totalWeight.toFixed(2) + ' kg';
        document.querySelector('#summary-package').textContent = totalPackaging;
        document.querySelector('#summary-value').textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(totalValue);
    }

    function reindexRows() {
        Array.from(itemTable.querySelectorAll('tr')).forEach((row, index) => {
            row.querySelectorAll('input, select').forEach(field => {
                const key = field.dataset.name;
                if (!key) return;
                field.name = `items[${index}][${key}]`;
            });
        });
    }

    function bindRowEvents(row) {
        row.querySelectorAll('[data-name="qty"], [data-name="weight"], [data-name="total_packaging"], [data-name="unit_price"]').forEach(input => {
            input.addEventListener('input', () => {
                const rowQty = row.querySelector('[data-name="qty"]');
                const rowPrice = row.querySelector('[data-name="unit_price"]');
                const rowSubtotal = row.querySelector('[data-name="subtotal_price"]');

                const qty = parseFloat(rowQty.value) || 0;
                const unitPrice = parseFloat(rowPrice.value) || 0;
                rowSubtotal.value = (qty * unitPrice).toFixed(2);
                updateSummary();
            });
        });

        row.querySelector('.remove-item').addEventListener('click', () => {
            if (itemTable.querySelectorAll('tr').length <= 1) {
                return;
            }
            row.remove();
            reindexRows();
            updateSummary();
        });
    }

    function createRow(data = {}) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-4 py-3">
                <input type="text" data-name="item_name" name="" value="${data.item_name || ''}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" required />
            </td>
            <td class="px-4 py-3">
                <select data-name="packaging_type" name="" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required>
                    ${['Box','Pallet','Drum','Sack','Crate','Unit','Lainnya'].map(type => `<option value="${type}" ${data.packaging_type === type ? 'selected' : ''}>${type}</option>`).join('')}
                </select>
            </td>
            <td class="px-4 py-3">
                <input type="number" min="1" step="1" data-name="total_packaging" name="" value="${data.total_packaging ?? 1}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-center text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required />
            </td>
            <td class="px-4 py-3">
                <input type="number" min="1" step="1" data-name="qty" name="" value="${data.qty ?? 1}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-center text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required />
            </td>
            <td class="px-4 py-3">
                <input type="number" min="0" step="0.01" data-name="weight" name="" value="${data.weight ?? 0}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-center text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required />
            </td>
            <td class="px-4 py-3">
                <input type="number" min="0" step="0.01" data-name="unit_price" name="" value="${data.unit_price ?? 0}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-right text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required />
            </td>
            <td class="px-4 py-3">
                <input type="text" readonly data-name="subtotal_price" name="" value="${((data.qty || 0) * (data.unit_price || 0)).toFixed(2)}" class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-right text-slate-900" />
            </td>
            <td class="px-4 py-3">
                <input type="text" data-name="item_notes" name="" value="${data.item_notes || ''}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100" />
            </td>
            <td class="px-4 py-3 text-center">
                <button type="button" class="remove-item inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-red-100 text-red-700 transition hover:bg-red-200" title="Hapus Item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </td>
        `;
        itemTable.appendChild(row);
        reindexRows();
        bindRowEvents(row);
    }

    addItemButton.addEventListener('click', () => {
        createRow();
        updateSummary();
    });

    document.querySelectorAll('#inbound-items tbody tr').forEach(row => {
        bindRowEvents(row);
    });

    updateSummary();

    document.querySelector('form').addEventListener('submit', function () {
        const submitButtons = this.querySelectorAll('button[type="submit"], input[type="submit"]');
        submitButtons.forEach(btn => btn.disabled = true);
    });
</script>
@endpush
@endsection