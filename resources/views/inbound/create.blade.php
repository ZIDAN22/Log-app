@extends('layouts.app')

@section('title', 'Buat Inbound')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">

    <div class="mx-auto w-full max-w-screen-2xl">

        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
<h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">
                    BARANG MASUK
                </h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    Buat penerimaan barang masuk dari shipment dan isi detail barang yang diterima.
                </p>
            </div>

            <a
                href="{{ route('inbound.index') }}"
                class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
                Kembali ke Daftar
            </a>
        </div>

        @if($errors->any())
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 text-sm text-red-700">
            <p class="font-semibold">
                Periksa kembali data berikut:
            </p>

            <ul class="mt-3 list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form
            method="POST"
            action="{{ route('inbound.store') }}"
            class="space-y-8 rounded-lg border border-slate-200 bg-white p-8 shadow-sm"
        >
            @csrf

            <div class="grid items-start gap-8 xl:grid-cols-3">

                <!-- Shipment -->
                <div class="xl:col-span-2">

                    <label class="mb-3 block text-sm font-semibold text-slate-700">
                        Pilih Shipment
                    </label>

                    <input
                        type="hidden"
                        name="shipment_id"
                        id="shipment_id"
                        value="{{ old('shipment_id') }}"
                        required
                    >

                    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-200 bg-slate-50 p-5">

                            <div class="relative">
                                <input
                                    type="text"
                                    id="shipmentSearch"
                                    placeholder="Cari receipt, invoice, pengirim, penerima..."
                                    class="w-full rounded-2xl border border-slate-300 bg-white py-4 pl-12 pr-4 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                >

                                <svg
                                    class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"
                                    />
                                </svg>
                            </div>
                        </div>

                        <div
                            id="shipmentList"
                            class="max-h-[420px] space-y-3 overflow-y-auto p-4"
                        >

                            @foreach($shipments as $shipment)

                            <div
                                class="shipment-card cursor-pointer rounded-[1.5rem] border border-slate-200 bg-white p-5 transition duration-200 hover:border-sky-400 hover:bg-sky-50"
                                data-id="{{ $shipment->id }}"
                                data-search="{{ strtolower(
                                    $shipment->receipt_number . ' ' .
                                    $shipment->invoice_number . ' ' .
                                    $shipment->sender_name . ' ' .
                                    $shipment->receiver_name
                                ) }}"
                            >

                                <div class="flex items-start justify-between">

                                    <div>
                                        <p class="text-xs uppercase tracking-wider text-slate-500">
                                            Receipt Number
                                        </p>

                                        <h3 class="text-lg font-bold text-slate-900">
                                            {{ $shipment->receipt_number }}
                                        </h3>
                                    </div>

                                    <span class="rounded-full bg-sky-100 px-4 py-1 text-xs font-semibold text-sky-700">
                                        {{ $shipment->invoice_number }}
                                    </span>
                                </div>

                                <div class="mt-4 grid grid-cols-2 gap-4">

                                    <div>
                                        <p class="text-xs text-slate-500">
                                            Pengirim
                                        </p>

                                        <p class="font-semibold text-slate-800">
                                            {{ $shipment->sender_name }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-slate-500">
                                            Penerima
                                        </p>

                                        <p class="font-semibold text-slate-800">
                                            {{ $shipment->receiver_name }}
                                        </p>
                                    </div>

                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>

                    <div
                        id="selectedShipment"
                        class="mt-5 hidden rounded-[2rem] border border-sky-200 bg-sky-50 p-5"
                    >
                        <h3 class="mb-4 font-bold text-slate-900">
                            Shipment Dipilih
                        </h3>

                        <div id="shipmentPreview"></div>
                    </div>

                </div>

                <!-- Right Side -->
                <div class="space-y-6">

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Inbound
                        </label>

                        <input
                            type="date"
                            name="inbound_date"
                            value="{{ old('inbound_date', now()->toDateString()) }}"
                            required
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-4 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Catatan Ringkas
                        </label>

                        <textarea
                            name="notes"
                            rows="7"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-4 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                        >{{ old('notes') }}</textarea>
                    </div>

                </div>

            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6">

                <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                    <div>
                        <h2 class="text-xl font-semibold text-slate-900">
                            Detail Barang
                        </h2>

                        <p class="text-sm text-slate-600">
                            Tambahkan semua item yang diterima dalam inbound.
                        </p>
                    </div>

                    <button
                        type="button"
                        id="add-item"
                        class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                    >
                        + Tambah Item
                    </button>
                </div>

                <div class="overflow-x-auto rounded-[2rem] border border-slate-200 bg-white">

                    <table
                        id="inbound-items"
                        class="min-w-[1400px] w-full divide-y divide-slate-200 text-sm"
                    >
                        <thead class="bg-slate-100 text-slate-700">
                            <tr>
                                <th class="px-4 py-4 text-left">Nama Barang</th>
                                <th class="px-4 py-4 text-left">Jenis Kemasan</th>
                                <th class="px-4 py-4 text-center">Jumlah Kemasan</th>
                                <th class="px-4 py-4 text-center">Qty</th>
                                <th class="px-4 py-4 text-center">Berat (kg)</th>
                                <th class="px-4 py-4 text-right">Harga per Unit</th>
                                <th class="px-4 py-4 text-right">Subtotal</th>
                                <th class="px-4 py-4 text-left">Catatan</th>
                                <th class="px-4 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200">

                            @php
                            $oldItems = old('items', []);
                            @endphp

                            @if(count($oldItems) === 0)
                            @php
                            $oldItems = [[
                                'item_name' => '',
                                'packaging_type' => 'Dus',
                                'total_packaging' => 1,
                                'qty' => 1,
                                'weight' => 0,
                                'item_notes' => ''
                            ]];
                            @endphp
                            @endif

                            @foreach($oldItems as $index => $item)

                            <tr>
                                <td class="px-4 py-4">
                                    <input
                                        type="text"
                                        data-name="item_name"
                                        name="items[{{ $index }}][item_name]"
                                        value="{{ $item['item_name'] ?? '' }}"
                                        class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                        required
                                    />
                                </td>

                                <td class="px-4 py-4">
                                    <select
                                        data-name="packaging_type"
                                        name="items[{{ $index }}][packaging_type]"
                                        class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                        required
                                    >
                                        @foreach(['Dus','Pallet','Drum','Karung','Krat','Unit','Lainnya'] as $type)
                                        <option
                                            value="{{ $type }}"
                                            {{ ($item['packaging_type'] ?? '') === $type ? 'selected' : '' }}
                                        >
                                            {{ $type }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td class="px-4 py-4">
                                    <input
                                        type="number"
                                        min="1"
                                        step="1"
                                        data-name="total_packaging"
                                        name="items[{{ $index }}][total_packaging]"
                                        value="{{ $item['total_packaging'] ?? 1 }}"
                                        class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-center text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                        required
                                    />
                                </td>

                                <td class="px-4 py-4">
                                    <input
                                        type="number"
                                        min="1"
                                        step="1"
                                        data-name="qty"
                                        name="items[{{ $index }}][qty]"
                                        value="{{ $item['qty'] ?? 1 }}"
                                        class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-center text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                        required
                                    />
                                </td>

                                <td class="px-4 py-4">
                                    <input
                                        type="number"
                                        min="0"
                                        step="0.01"
                                        data-name="weight"
                                        name="items[{{ $index }}][weight]"
                                        value="{{ $item['weight'] ?? 0 }}"
                                        class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-center text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                        required
                                    />
                                </td>

                                <td class="px-4 py-4">
                                    <input
                                        type="number"
                                        min="0"
                                        step="0.01"
                                        data-name="unit_price"
                                        name="items[{{ $index }}][unit_price]"
                                        value="{{ $item['unit_price'] ?? 0 }}"
                                        class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-right text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                        required
                                    />
                                </td>

                                <td class="px-4 py-4">
                                    <input
                                        type="text"
                                        readonly
                                        data-name="subtotal_price"
                                        name="items[{{ $index }}][subtotal_price]"
                                        value="{{ number_format(($item['qty'] ?? 0) * ($item['unit_price'] ?? 0), 2, '.', '') }}"
                                        class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-3 py-3 text-right text-slate-900"
                                    />
                                </td>

                                <td class="px-4 py-4">
                                    <input
                                        type="text"
                                        data-name="item_notes"
                                        name="items[{{ $index }}][item_notes]"
                                        value="{{ $item['item_notes'] ?? '' }}"
                                        class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                    />
                                </td>

                                <td class="px-4 py-4 text-center">
                                    <button
                                        type="button"
                                        class="remove-item inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-red-100 text-red-700 transition hover:bg-red-200"
                                        title="Hapus Item"
                                    >
                                        &times;
                                    </button>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-4">

                <div class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">
                        Total Qty
                    </p>

                    <p id="summary-qty" class="mt-3 text-2xl font-bold text-slate-900">
                        0
                    </p>
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">
                        Total Berat
                    </p>

                    <p id="summary-weight" class="mt-3 text-2xl font-bold text-slate-900">
                        0.00 kg
                    </p>
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">
                        Total Kemasan
                    </p>

                    <p id="summary-package" class="mt-3 text-2xl font-bold text-slate-900">
                        0
                    </p>
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">
                        Total Nilai
                    </p>

                    <p id="summary-value" class="mt-3 text-2xl font-bold text-slate-900">
                        Rp 0
                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('inbound.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3 font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 font-semibold text-white transition hover:bg-slate-800"
                >
                    Simpan Inbound
                </button>
            </div>

        </form>
    </div>
</div>

@push('scripts')
<script>
const itemTable = document.querySelector('#inbound-items tbody');
const addItemButton = document.querySelector('#add-item');

// Shipment Search
const shipmentSearch = document.getElementById('shipmentSearch');
const shipmentCards = document.querySelectorAll('.shipment-card');
const shipmentIdInput = document.getElementById('shipment_id');
const shipmentPreview = document.getElementById('shipmentPreview');
const selectedShipment = document.getElementById('selectedShipment');

shipmentSearch?.addEventListener('input', function () {

    const keyword = this.value.toLowerCase();

    shipmentCards.forEach(card => {
        const text = card.dataset.search;

        card.style.display =
            text.includes(keyword)
                ? 'block'
                : 'none';
    });
});

shipmentCards.forEach(card => {

    card.addEventListener('click', function () {

        shipmentCards.forEach(c => {
            c.classList.remove(
                'border-sky-500',
                'bg-sky-100',
                'ring-4',
                'ring-sky-100'
            );
        });

        this.classList.add(
            'border-sky-500',
            'bg-sky-100',
            'ring-4',
            'ring-sky-100'
        );

        shipmentIdInput.value = this.dataset.id;

        selectedShipment.classList.remove('hidden');
        shipmentPreview.innerHTML = this.innerHTML;
    });
});

function updateSummary() {

    const rows = Array.from(itemTable.querySelectorAll('tr'));

    let totalQty = 0;
    let totalWeight = 0;
    let totalPackaging = 0;
    let totalValue = 0;

    rows.forEach(row => {

        const qty =
            parseFloat(
                row.querySelector('[data-name="qty"]').value
            ) || 0;

        const weight =
            parseFloat(
                row.querySelector('[data-name="weight"]').value
            ) || 0;

        const packaging =
            parseInt(
                row.querySelector('[data-name="total_packaging"]').value
            ) || 0;

        const value =
            parseFloat(
                row.querySelector('[data-name="subtotal_price"]').value
            ) || 0;

        totalQty += qty;
        totalWeight += weight;
        totalPackaging += packaging;
        totalValue += value;
    });

    document.querySelector('#summary-qty').textContent = totalQty;
    document.querySelector('#summary-weight').textContent = totalWeight.toFixed(2) + ' kg';
    document.querySelector('#summary-package').textContent = totalPackaging;

    document.querySelector('#summary-value').textContent =
        new Intl.NumberFormat(
            'id-ID',
            {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }
        ).format(totalValue);
}

function reindexRows() {

    Array.from(
        itemTable.querySelectorAll('tr')
    ).forEach((row, index) => {

        row.querySelectorAll('input, select')
        .forEach(field => {

            const key = field.dataset.name;

            if (!key) return;

            field.name = `items[${index}][${key}]`;
        });
    });
}

function bindRowEvents(row) {

    row.querySelectorAll(
        '[data-name="qty"], [data-name="weight"], [data-name="total_packaging"], [data-name="unit_price"]'
    ).forEach(input => {

        input.addEventListener('input', () => {

            const qty =
                parseFloat(
                    row.querySelector('[data-name="qty"]').value
                ) || 0;

            const unitPrice =
                parseFloat(
                    row.querySelector('[data-name="unit_price"]').value
                ) || 0;

            row.querySelector('[data-name="subtotal_price"]').value =
                (qty * unitPrice).toFixed(2);

            updateSummary();
        });
    });

    row.querySelector('.remove-item')
        .addEventListener('click', () => {

        if (
            itemTable.querySelectorAll('tr').length <= 1
        ) return;

        row.remove();

        reindexRows();
        updateSummary();
    });
}

function createRow(data = {}) {
    const row = document.createElement('tr');

    row.innerHTML = `
        <td class="px-4 py-4">
            <input
                type="text"
                data-name="item_name"
                name=""
                value="${data.item_name || ''}"
                class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                required
            />
        </td>

        <td class="px-4 py-4">
            <select
                data-name="packaging_type"
                name=""
                class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                required
            >
                ${['Dus','Pallet','Drum','Karung','Krat','Unit','Lainnya']
                .map(type => `
                    <option value="${type}" ${data.packaging_type === type ? 'selected' : ''}>
                        ${type}
                    </option>
                `).join('')}
            </select>
        </td>

        <td class="px-4 py-4">
            <input
                type="number"
                min="1"
                step="1"
                data-name="total_packaging"
                name=""
                value="${data.total_packaging ?? 1}"
                class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-center text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                required
            />
        </td>

        <td class="px-4 py-4">
            <input
                type="number"
                min="1"
                step="1"
                data-name="qty"
                name=""
                value="${data.qty ?? 1}"
                class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-center text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                required
            />
        </td>

        <td class="px-4 py-4">
            <input
                type="number"
                min="0"
                step="0.01"
                data-name="weight"
                name=""
                value="${data.weight ?? 0}"
                class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-center text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                required
            />
        </td>

        <td class="px-4 py-4">
            <input
                type="number"
                min="0"
                step="0.01"
                data-name="unit_price"
                name=""
                value="${data.unit_price ?? 0}"
                class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-right text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                required
            />
        </td>

        <td class="px-4 py-4">
            <input
                type="text"
                readonly
                data-name="subtotal_price"
                name=""
                value="${((data.qty || 0) * (data.unit_price || 0)).toFixed(2)}"
                class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-3 py-3 text-right text-slate-900"
            />
        </td>

        <td class="px-4 py-4">
            <input
                type="text"
                data-name="item_notes"
                name=""
                value="${data.item_notes || ''}"
                class="w-full rounded-2xl border border-slate-300 bg-white px-3 py-3 text-slate-900 focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
            />
        </td>

        <td class="px-4 py-4 text-center">
            <button
                type="button"
                class="remove-item inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-red-100 text-red-700 transition hover:bg-red-200"
                title="Hapus Item"
            >
                &times;
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

document.querySelectorAll(
    '#inbound-items tbody tr'
).forEach(row => {
    bindRowEvents(row);
});

updateSummary();

// Prevent Double Submit
document.querySelector('form')
.addEventListener('submit', function () {

    const submitButtons =
        this.querySelectorAll(
            'button[type="submit"], input[type="submit"]'
        );

    submitButtons.forEach(btn => {
        btn.disabled = true;
    });
});
</script>
@endpush
@endsection
