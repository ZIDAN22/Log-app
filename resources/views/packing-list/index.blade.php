@extends('layouts.app')

@section('title', 'Riwayat Packing List')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Riwayat Packing List</h1>
                <p class="text-slate-600">Pantau semua packing list dan ringkasan isi shipment.</p>
            </div>
            <a href="{{ route('packing-list.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800 transition">
                + Buat Packing List
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900">
            {{ session('success') }}
        </div>
        @endif

        <form method="GET" action="{{ route('packing-list.index') }}" class="mb-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid gap-4 lg:grid-cols-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Cari Resi / Invoice</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="No Resi atau Invoice"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Dari Tanggal</label>
                    <input type="date" name="from" value="{{ request('from') }}"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Sampai Tanggal</label>
                    <input type="date" name="to" value="{{ request('to') }}"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                </div>
                <div class="flex items-end gap-3">
                    <button type="submit" class="w-full rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition">Terapkan</button>
                    <a href="{{ route('packing-list.index') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">Reset</a>
                </div>
            </div>
        </form>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1024px] border-collapse text-left text-sm">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="px-6 py-4 font-semibold">No Resi</th>
                            <th class="px-6 py-4 font-semibold">Invoice</th>
                            <th class="px-6 py-4 font-semibold">Pengirim</th>
                            <th class="px-6 py-4 font-semibold">Total Qty</th>
                            <th class="px-6 py-4 font-semibold">Total Berat</th>
                            <th class="px-6 py-4 font-semibold">Total Value</th>
                            <th class="px-6 py-4 font-semibold">Tanggal Packing</th>
                            <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($packingLists as $packingList)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-900">{{ $packingList->shipment->receipt_number }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ $packingList->shipment->invoice_number }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ $packingList->shipment->sender_name }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ $packingList->total_qty }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ number_format($packingList->total_weight, 2, ',', '.') }} kg</td>
                            <td class="px-6 py-4 text-slate-900 font-semibold">Rp {{ number_format($packingList->total_value, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ $packingList->packing_date->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-wrap items-center justify-center gap-2">
                                    <a href="{{ route('packing-list.show', $packingList) }}" class="rounded-2xl bg-blue-600 px-3 py-2 text-xs font-semibold text-white hover:bg-blue-700 transition">Detail</a>
                                    <a href="{{ route('packing-list.edit', $packingList) }}" class="rounded-2xl bg-amber-100 px-3 py-2 text-xs font-semibold text-amber-700 hover:bg-amber-200 transition">Edit</a>
                                    <a href="{{ route('packing-list.print-pdf', $packingList) }}" class="rounded-2xl bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-200 transition">PDF</a>
                                    <form action="{{ route('packing-list.destroy', $packingList) }}" method="POST" onsubmit="return confirm('Hapus packing list ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-2xl bg-red-100 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-200 transition">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-slate-50">
                            <td colspan="8" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada packing list. Buat packing list baru untuk mencatat detail isi shipment.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <p class="text-sm text-slate-600">Menampilkan <strong>{{ $packingLists->firstItem() ?? 0 }}</strong> sampai <strong>{{ $packingLists->lastItem() ?? 0 }}</strong> dari <strong>{{ $packingLists->total() }}</strong> hasil</p>
            <div>
                {{ $packingLists->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
