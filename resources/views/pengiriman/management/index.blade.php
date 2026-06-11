@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
                    <span>Dashboard</span>
                    <span class="text-slate-300">/</span>
                    <span class="font-semibold text-slate-900">Manajemen Pengiriman</span>
                </div>
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Manajemen Pengiriman</h1>
                    <p class="mt-2 max-w-2xl text-sm text-slate-500">Kelola proses pengiriman, POD, dan status pengiriman secara real-time dari warehouse hingga delivered.</p>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="button" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Export Data
                </button>
            </div>
        </div>
    </section>

    <!-- Statistics Cards -->
    <section class="grid gap-4 xl:grid-cols-5">
        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium text-slate-500">Total Pengiriman</h2>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $stats['total'] ?? 0 }}</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
        </article>

        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium text-slate-500">Siap Dikirim</h2>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $stats['ready_to_ship'] ?? 0 }}</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8" />
                    </svg>
                </div>
            </div>
        </article>

        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium text-slate-500">Dalam Perjalanan</h2>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $stats['in_transit'] ?? 0 }}</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
        </article>

        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium text-slate-500">SAMPAI</h2>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $stats['delivered'] ?? 0 }}</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </article>

        <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium text-slate-500">POD SELESAI</h2>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $stats['completed'] ?? 0 }}</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </article>
    </section>

    <!-- Filters -->
    <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
        <div class="space-y-6">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Filter & Search</h2>
                <p class="mt-2 text-sm text-slate-500">Cari pengiriman berdasarkan nomor, customer, atau status pengiriman.</p>
            </div>

            <form method="GET" class="space-y-4">
                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <label class="block">
                        <span class="text-sm font-medium text-slate-700">Search Delivery</span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No Pengiriman, Customer, Resi..." class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100" />
                    </label>

                    <label class="block">
                        <span class="text-sm font-medium text-slate-700">Status Pengiriman</span>
                        <select name="status" class="mt-2 w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                            <option value="">Semua Status</option>
                            <option value="ready_to_ship" @selected(request('status') === 'ready_to_ship')>Siap Dikirim</option>
                            <option value="in_transit" @selected(request('status') === 'in_transit')>Dalam Perjalanan</option>
                            <option value="delivered" @selected(request('status') === 'delivered')>Sampai</option>
                        </select>
                    </label>

                    <label class="block">
                        <span class="text-sm font-medium text-slate-700">Metode Pengiriman</span>
                        <select name="method" class="mt-2 w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                            <option value="">Semua Metode</option>
                            <option value="DARAT" @selected(request('method') === 'DARAT')>Darat</option>
                            <option value="LAUT" @selected(request('method') === 'LAUT')>Laut</option>
                            <option value="UDARA" @selected(request('method') === 'UDARA')>Udara</option>
                        </select>
                    </label>

                    <div class="flex items-end gap-3">
                        <button type="submit" class="flex-1 rounded-3xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Filter</button>
                        <a href="{{ route('delivery-management.index') }}" class="rounded-3xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Table -->
    <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Daftar Pengiriman</h2>
                <p class="mt-1 text-sm text-slate-500">Kelola status, POD, dan tindakan operasional untuk setiap pengiriman.</p>
            </div>
            <div class="text-sm text-slate-500">Total: <span class="font-semibold text-slate-900">{{ $deliveries->total() }}</span></div>
        </div>

        @if($deliveries->count() > 0)
        <div class="overflow-x-auto rounded-3xl border border-slate-200">
            <table class="min-w-full border-collapse text-left text-sm">
                <thead class="bg-slate-50 text-slate-700 sticky top-0">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-4 font-semibold">Resi</th>
                        <th class="whitespace-nowrap px-4 py-4 font-semibold">Customer</th>
                        <th class="whitespace-nowrap px-4 py-4 font-semibold">Tujuan</th>
                        <th class="whitespace-nowrap px-4 py-4 font-semibold">Transportasi</th>
                        <th class="whitespace-nowrap px-4 py-4 font-semibold">ETA</th>
                        <th class="whitespace-nowrap px-4 py-4 font-semibold">Status</th>
                        <th class="whitespace-nowrap px-4 py-4 font-semibold">POD</th>
                        <th class="whitespace-nowrap px-4 py-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                    @foreach($deliveries as $delivery)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-4 font-medium text-slate-900">
                            {{ $delivery->shipment->receipt_number ?? '-' }}
                        </td>
                        <td class="px-4 py-4 text-sm">{{ substr($delivery->shipment->receiver_name ?? '-', 0, 18) }}</td>
                        <td class="px-4 py-4 text-sm">{{ $delivery->outbound->destination_city ?? $delivery->shipment->destination_city ?? '-' }}</td>

                        <td class="px-4 py-4 text-sm">
                            @php
                                $methodKey = $delivery->delivery_method;
                                $methodLabel = \App\Models\DeliveryManagement::METHODS[$methodKey] ?? ucfirst(strtolower($methodKey));
                            @endphp

                            <div class="font-medium text-slate-900">
                                {{ $methodLabel }}
                            </div>

                            @if($methodKey === 'LAUT')
                                <div class="mt-1 text-xs text-slate-500">
                                    {{ $delivery->shipment->sea_shipping ?? '-' }}
                                    @if(!empty($delivery->shipment->sea_departure_date))
                                        · {{ optional($delivery->shipment->sea_departure_date)->format('d M Y') }}
                                    @endif
                                </div>
                            @elseif($methodKey === 'UDARA')
                                <div class="mt-1 text-xs text-slate-500">
                                    {{ $delivery->shipment->air_shipping ?? '-' }}
                                    @if(!empty($delivery->shipment->air_departure_date))
                                        · {{ optional($delivery->shipment->air_departure_date)->format('d M Y') }}
                                    @endif
                                </div>
                            @else
                                <div class="mt-1 text-xs text-slate-500">
                                    {{ substr($delivery->driver->name ?? '-', 0, 15) }} · {{ $delivery->vehicle->license_plate ?? $delivery->vehicle->name ?? '-' }}
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-sm">{{ optional($delivery->estimatedEta)->format('d M Y') ?? '-' }}</td>
                        <td class="px-4 py-4">
                            <span class="{{ $delivery->statusBadge() }}">
                                {{ $delivery->statusLabel() }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="{{ $delivery->podBadge() }}">
                                {{ $delivery->podLabel() }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex flex-col gap-2">
                                <div class="flex flex-wrap items-center gap-2">
                                    @php
                                        $current = $delivery->delivery_status;
                                    @endphp

                                    @if(in_array($current, ['ready_to_ship', 'picked_up'], true))
                                        <form method="POST" action="{{ route('delivery-management.update-status', $delivery) }}">
                                            @csrf
                                            <input type="hidden" name="delivery_status" value="in_transit" />
                                            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-sky-50 p-2 text-xs font-semibold text-sky-700 hover:bg-sky-100 transition" title="Ubah status ke In Transit">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    @if(in_array($current, ['in_transit', 'arrived_destination'], true))
                                        <form method="POST" action="{{ route('delivery-management.update-status', $delivery) }}">
                                            @csrf
                                            <input type="hidden" name="delivery_status" value="delivered" />
                                            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-emerald-50 p-2 text-xs font-semibold text-emerald-700 hover:bg-emerald-100 transition" title="Ubah status ke Delivered">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('delivery-management.print-surat-jalan', $delivery) }}" class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white p-2 text-xs font-medium text-slate-700 hover:bg-slate-50 transition" title="Cetak Surat Jalan">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h6" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('delivery-management.show', $delivery) }}#podUploadModal" class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white p-2 text-xs font-medium text-slate-700 hover:bg-slate-50 transition" title="Upload POD">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16v-4m0 0l-3 3m3-3l3 3" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v16H4z" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('delivery-management.show', $delivery) }}" class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white p-2 text-xs font-medium text-slate-700 hover:bg-slate-50 transition" title="Detail">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-2" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3h5v5" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 3l-8 8" />
                                        </svg>
                                    </a>
                                </div>

                                @if($delivery->pod_status !== 'pending')
                                    <div class="text-xs text-slate-500">
                                        POD: {{ $delivery->podLabel() }}
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-slate-500">
                Showing <span class="font-semibold text-slate-900">{{ $deliveries->firstItem() ?? 0 }}</span> to <span class="font-semibold text-slate-900">{{ $deliveries->lastItem() ?? 0 }}</span> of <span class="font-semibold text-slate-900">{{ $deliveries->total() }}</span>
            </div>
            <div class="flex gap-2">
                {{ $deliveries->links('pagination::tailwind') }}
            </div>
        </div>
        @else
        <div class="rounded-3xl border border-dashed border-slate-200 bg-slate-50 py-12 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <h3 class="mt-4 text-lg font-semibold text-slate-900">Tidak ada pengiriman</h3>
            <p class="mt-2 text-sm text-slate-500">Belum ada data pengiriman. Pastikan outbound dengan status "Ready to Ship" telah dibuat.</p>
        </div>
        @endif
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                if (this.value.length > 0) {
                    this.classList.add('ring-2', 'ring-sky-100');
                }
            });
        }
    });
</script>
@endsection
