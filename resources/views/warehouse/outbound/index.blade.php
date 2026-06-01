@extends('layouts.app')

@section('title', 'Outbound')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">
    <div class="mx-auto max-w-[1700px]">
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Riwayat Outbound</h1>
                <p class="mt-2 text-slate-600">Kelola outbound yang dibuat dari packing list dan cetak surat jalan.</p>
            </div>
            <a href="{{ route('warehouse.outbound.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Outbound
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid gap-5 lg:grid-cols-4">
            <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.18em] text-slate-400">Total Outbound</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['total'] }}</p>
            </div>
            <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.18em] text-slate-400">Ready to Ship</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['ready'] }}</p>
            </div>
            <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.18em] text-slate-400">In Transit</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['inTransit'] }}</p>
            </div>
            <div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.18em] text-slate-400">Delivered</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['delivered'] }}</p>
            </div>
        </div>

        <form id="outbound-filter-form" method="GET" action="{{ route('warehouse.outbound.index') }}" class="mt-7 rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6 flex flex-col gap-4 xl:flex-row xl:items-end xl:justify-between">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Filter Outbound</h2>
                    <p class="mt-1 text-sm text-slate-500">Cari dan saring outbound berdasarkan status, metode, atau nomor resi.</p>
                </div>
            </div>

            <div class="grid gap-5 xl:grid-cols-4">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Cari Resi / Customer</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nomor resi atau customer"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                    <select name="status"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                        <option value="">Semua Status</option>
                        @foreach(App\Models\Outbound::statuses() as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Metode Pengiriman</label>
                    <select name="method"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                        <option value="">Semua Metode</option>
                        @foreach(App\Models\Outbound::shippingMethods() as $method)
                        <option value="{{ $method }}" @selected(request('method') === $method)>{{ $method }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-3">
                    <a href="{{ route('warehouse.outbound.index') }}"
                        class="inline-flex h-12 items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                        Reset
                    </a>
                    <button type="submit"
                        class="inline-flex h-12 items-center justify-center rounded-2xl bg-blue-600 px-5 text-sm font-semibold text-white transition hover:bg-blue-700">
                        Terapkan
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-7 overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Data Outbound</h2>
                        <p class="mt-1 text-sm text-slate-500">Tabel outbound menyajikan status, resi, tujuan, dan total paket.</p>
                    </div>
                    <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">Total: {{ $outbounds->total() }}</div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-full border-collapse text-left text-sm">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="px-5 py-4 uppercase tracking-wider">No Resi</th>
                            <th class="px-5 py-4 uppercase tracking-wider">Customer</th>
                            <th class="px-5 py-4 uppercase tracking-wider">Tujuan</th>
                            <th class="px-5 py-4 uppercase tracking-wider">Metode</th>
                            <th class="px-5 py-4 uppercase tracking-wider">Driver</th>
                            <th class="px-5 py-4 uppercase tracking-wider">Kendaraan</th>
                            <th class="px-5 py-4 uppercase tracking-wider">Total Package</th>
                            <th class="px-5 py-4 uppercase tracking-wider">Total Berat</th>
                            <th class="px-5 py-4 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-4 uppercase tracking-wider">Tanggal Outbound</th>
                            <th class="px-5 py-4 text-center uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($outbounds as $outbound)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-5 py-4 text-slate-700">{{ $outbound->packingList->shipment->receipt_number }}</td>
                            <td class="px-5 py-4 text-slate-700">{{ $outbound->packingList->shipment->receiver_name }}</td>
                            <td class="px-5 py-4 text-slate-700">{{ $outbound->packingList->shipment->destination_city }}, {{ $outbound->packingList->shipment->destination_province }}</td>
                            <td class="px-5 py-4 text-slate-700">{{ $outbound->shipping_method }}</td>
                            <td class="px-5 py-4 text-slate-700">{{ $outbound->driver?->name ?? '-' }}</td>
                            <td class="px-5 py-4 text-slate-700">{{ $outbound->vehicle?->name ?? '-' }}</td>
                            <td class="px-5 py-4 text-slate-700">{{ $outbound->packingList->total_package }}</td>
                            <td class="px-5 py-4 text-slate-700">{{ number_format($outbound->packingList->total_weight, 2, ',', '.') }} kg</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $outbound->statusBadge() }}">
                                    {{ $outbound->status }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-slate-700">{{ $outbound->outbound_date->format('d M Y') }}</td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap items-center justify-center gap-2">
                                    <a href="{{ route('warehouse.outbound.show', $outbound) }}" class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700 transition hover:bg-slate-200" title="Detail">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('warehouse.outbound.edit', $outbound) }}" class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 transition hover:bg-amber-200" title="Edit">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <a href="{{ route('warehouse.outbound.print-pdf', $outbound) }}" target="_blank" class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 transition hover:bg-emerald-200" title="Cetak Surat Jalan">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 14h12v8H6v-8z"/></svg>
                                    </a>
                                    <form action="{{ route('warehouse.outbound.update-status', $outbound) }}" method="POST" class="inline-flex">
                                        @csrf
                                        <input type="hidden" name="status" value="{{ $outbound->status === App\Models\Outbound::STATUS_READY_TO_SHIP ? App\Models\Outbound::STATUS_IN_TRANSIT : App\Models\Outbound::STATUS_DELIVERED }}">
                                        <button type="submit" class="inline-flex h-10 items-center justify-center rounded-xl bg-cyan-100 px-4 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-200" title="Update Status">
                                            Update
                                        </button>
                                    </form>
                                    <form action="{{ route('warehouse.outbound.destroy', $outbound) }}" method="POST" onsubmit="return confirm('Hapus outbound ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-700 transition hover:bg-rose-200" title="Delete">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-slate-50">
                            <td colspan="11" class="px-6 py-16 text-center text-sm text-slate-500">
                                Belum ada data outbound. Mulai dengan membuat outbound dari packing list.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-200 px-6 py-5">
                {{ $outbounds->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
