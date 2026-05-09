@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Daftar Pengiriman</h1>
                <p class="text-slate-600">Kelola dan pantau semua shipment dengan mudah.</p>
            </div>
            <a href="{{ route('pengiriman.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-white shadow-sm transition hover:bg-blue-700">
                <span class="mr-2">+</span> Buat Pengiriman Baru
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900">
            {{ session('success') }}
        </div>
        @endif

        @php
        $statusOptions = \App\Models\Shipment::STATUSES;
        function formatRp($value) {
        return 'Rp ' . number_format($value, 0, ',', '.');
        }
        @endphp

        <form method="GET" action="{{ route('pengiriman.index') }}"
            class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm mb-6">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Invoice, Resi, Pengirim, Penerima"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                    <select name="status"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option value="">Semua Status</option>
                        @foreach($statusOptions as $status)
                        <option value="{{ $status }}" {{ request('status')===$status ? 'selected' : '' }}>{{ $status }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Dari Tanggal</label>
                    <input type="date" name="from" value="{{ request('from') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Sampai Tanggal</label>
                    <input type="date" name="to" value="{{ request('to') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <button type="submit"
                    class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Terapkan Filter
                </button>
            </div>
        </form>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1024px] border-collapse text-left">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold">No Invoice</th>
                            <th class="px-6 py-4 text-sm font-semibold">No Resi</th>
                            <th class="px-6 py-4 text-sm font-semibold">Pengirim</th>
                            <th class="px-6 py-4 text-sm font-semibold">Penerima</th>
                            <th class="px-6 py-4 text-sm font-semibold">Tujuan</th>
                            <th class="px-6 py-4 text-sm font-semibold">Transportasi</th>
                            <th class="px-6 py-4 text-sm font-semibold">Grand Total</th>
                            <th class="px-6 py-4 text-sm font-semibold">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($shipments as $shipment)
                        @php
                        $style = \App\Models\Shipment::statusStyles()[$shipment->shipment_status] ?? ['bg' =>
                        'bg-slate-100', 'text' => 'text-slate-800'];
                        @endphp
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $shipment->invoice_number }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $shipment->receipt_number }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $shipment->sender_name }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $shipment->receiver_name }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $shipment->destination_city }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span
                                    class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-800">
                                    {{ ucfirst($shipment->transportation_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-slate-900">{{
                                formatRp($shipment->grand_total) }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span
                                    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium {{ $style['bg'] }} {{ $style['text'] }}">
                                    {{ $shipment->shipment_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('pengiriman.show', $shipment) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200"
                                        title="Lihat Detail">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('pengiriman.edit', $shipment) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-100 text-amber-700 hover:bg-amber-200"
                                        title="Edit">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    @if($shipment->deliveryOrder)
                                    <a href="{{ route('delivery-orders.show', $shipment->deliveryOrder) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-green-100 text-green-700 hover:bg-green-200"
                                        title="Lihat Surat Jalan">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </a>
                                    @else
                                    <form action="{{ route('delivery-orders.generate', $shipment) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200"
                                            title="Generate Surat Jalan">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('pengiriman.destroy', $shipment) }}" method="POST"
                                        onsubmit="return confirm('Hapus shipment ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-100 text-red-700 hover:bg-red-200"
                                            title="Hapus">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-slate-50">
                            <td colspan="8" class="px-6 py-8 text-center text-sm text-slate-500">
                                Belum ada pengiriman. Mulai dengan membuat shipment baru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <p class="text-sm text-slate-600">
                Menampilkan <strong>{{ $shipments->firstItem() ?? 0 }}</strong> sampai <strong>{{ $shipments->lastItem()
                    ?? 0 }}</strong> dari <strong>{{ $shipments->total() }}</strong> hasil
            </p>
            <div>
                {{ $shipments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection