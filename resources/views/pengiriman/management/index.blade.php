@extends('layouts.app') @section('content') <div class="min-h-screen bg-slate-50 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl"> {{-- Header --}} <div
            class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">DELIVERY MANAGEMENT</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Pengiriman Operasional
                </h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600"> Statistik pengiriman (ready to ship sampai
                    POD selesai) dan daftar pengiriman yang bisa dipantau dari satu halaman. </p>
            </div>
            <div class="flex gap-3"> <button type="button"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-slate-900 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg> Export Data </button> </div>
        </div> {{-- Statistics Cards (style Outbound: border kotak tegas + icon) --}} <section
            class="mb-6 grid gap-5 xl:grid-cols-5">
            <article class="rounded-none border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">Total Pengiriman</h2>
                        <p class="mt-3 text-2xl font-semibold text-slate-950">{{ $stats['total'] ?? 0 }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-sky-50 text-sky-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg> </div>
                </div>
            </article>
            <article class="rounded-none border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">Siap Dikirim</h2>
                        <p class="mt-3 text-2xl font-semibold text-slate-950">{{ $stats['ready_to_ship'] ?? 0 }}</p>
                    </div>
                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-violet-50 text-violet-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8" />
                        </svg> </div>
                </div>
            </article>
            <article class="rounded-none border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">Dalam Perjalanan</h2>
                        <p class="mt-3 text-2xl font-semibold text-slate-950">{{ $stats['in_transit'] ?? 0 }}</p>
                    </div>
                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-amber-50 text-amber-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg> </div>
                </div>
            </article>
            <article class="rounded-none border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">Sampai</h2>
                        <p class="mt-3 text-2xl font-semibold text-slate-950">{{ $stats['delivered'] ?? 0 }}</p>
                    </div>
                    <div
                        class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg> </div>
                </div>
            </article>
            <article class="rounded-none border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-slate-500">POD Selesai</h2>
                        <p class="mt-3 text-2xl font-semibold text-slate-950">{{ $stats['completed'] ?? 0 }}</p>
                    </div>
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-md bg-rose-50 text-rose-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg> </div>
                </div>
            </article>
        </section> {{-- Filters --}} <section class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <form method="GET" action="{{ route('delivery-management.index') }}" class="space-y-5">
                <div
                    class="flex flex-col gap-3 border-b border-slate-200 pb-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Filter & Cari</h2>
                        <p class="mt-1 text-sm text-slate-500">Cari pengiriman berdasarkan resi, customer, tujuan, atau
                            status.</p>
                    </div> <span
                        class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ $deliveries->total() ?? 0 }} data </span>
                </div>
                <div class="grid gap-4 xl:grid-cols-4">
                    <div class="xl:col-span-2"> <label class="mb-2 block text-sm font-semibold text-slate-700">Search
                            Delivery</label> <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari No Pengiriman, Customer, Resi..."
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" />
                    </div>
                    <div> <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label> <select
                            name="status"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                            <option value="">Semua Status</option>
                            <option value="ready_to_ship" {{ request('status')==='ready_to_ship' ? 'selected' : '' }}>
                                Siap Dikirim</option>
                            <option value="in_transit" {{ request('status')==='in_transit' ? 'selected' : '' }}>Dalam
                                Perjalanan</option>
                            <option value="delivered" {{ request('status')==='delivered' ? 'selected' : '' }}>Sampai
                            </option>
                        </select> </div>
                    <div> <label class="mb-2 block text-sm font-semibold text-slate-700">Metode</label> <select
                            name="method"
                            class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                            <option value="">Semua Metode</option>
                            <option value="DARAT" {{ request('method')==='DARAT' ? 'selected' : '' }}>Darat</option>
                            <option value="LAUT" {{ request('method')==='LAUT' ? 'selected' : '' }}>Laut</option>
                            <option value="UDARA" {{ request('method')==='UDARA' ? 'selected' : '' }}>Udara</option>
                        </select> </div>
                </div>
                <div
                    class="flex flex-col gap-3 border-t border-slate-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-500"> Total data: <span class="font-semibold text-slate-900">{{
                            $deliveries->total() }}</span> </p>
                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end"> <a
                            href="{{ route('delivery-management.index') }}"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v6h6M20 20v-6h-6M5 19A9 9 0 0019 5" />
                            </svg> Reset </a> <button type="submit"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                            </svg> Terapkan Filter </button> </div>
                </div>
            </form>
        </section> {{-- Table --}} <section
            class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4">
                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Daftar Pengiriman</h2>
                        <p class="mt-1 text-sm text-slate-500">Kelola status, POD, dan tindakan operasional untuk setiap
                            pengiriman.</p>
                    </div>
                    <div
                        class="inline-flex w-fit items-center rounded-md bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        {{ $deliveries->total() }} shipment </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1280px] border-collapse">
                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">
                                Resi</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">
                                Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">
                                Tujuan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">
                                Transportasi</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">
                                ETA</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">
                                Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide whitespace-nowrap">
                                POD</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wide whitespace-nowrap">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white"> @forelse($deliveries as $delivery) @php
                        $methodKey = $delivery->delivery_method; $methodLabel =
                        \App\Models\DeliveryManagement::METHODS[$methodKey] ?? ucfirst(strtolower($methodKey)); $current
                        = $delivery->delivery_status; @endphp <tr class="transition hover:bg-slate-50">
                            <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-slate-950"> {{
                                $delivery->shipment->receipt_number ?? '-' }} </td>
                            <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-800"> {{
                                substr($delivery->shipment->receiver_name ?? '-', 0, 22) }} </td>
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700"> {{
                                $delivery->outbound->destination_city ?? $delivery->shipment->destination_city ?? '-' }}
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700">
                                <div class="font-semibold text-slate-800">{{ $methodLabel }}</div> @if($methodKey ===
                                'LAUT') <div class="mt-1 text-xs text-slate-500"> {{ $delivery->shipment->sea_shipping
                                    ?? '-' }} @if(!empty($delivery->shipment->sea_departure_date)) · {{
                                    optional($delivery->shipment->sea_departure_date)->format('d M Y') }} @endif </div>
                                @elseif($methodKey === 'UDARA') <div class="mt-1 text-xs text-slate-500"> {{
                                    $delivery->shipment->air_shipping ?? '-' }}
                                    @if(!empty($delivery->shipment->air_departure_date)) · {{
                                    optional($delivery->shipment->air_departure_date)->format('d M Y') }} @endif </div>
                                @else <div class="mt-1 text-xs text-slate-500"> {{ substr($delivery->driver->name ??
                                    '-', 0, 18) }} · {{ $delivery->vehicle->license_plate ?? $delivery->vehicle->name ??
                                    '-' }} </div> @endif
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-700"> {{
                                optional($delivery->estimatedEta)->format('d M Y') ?? '-' }} </td>
                            <td class="px-6 py-5"> <span
                                    class="inline-flex items-center rounded-md px-2.5 py-1 text-xs font-semibold {{ $delivery->statusBadge() }}">
                                    {{ $delivery->statusLabel() }} </span> </td>
                            <td class="px-6 py-5"> <span
                                    class="inline-flex items-center rounded-md px-2.5 py-1 text-xs font-semibold {{ $delivery->podBadge() }}">
                                    {{ $delivery->podLabel() }} </span> </td>
                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center gap-2"> @if(in_array($current,
                                    ['ready_to_ship', 'picked_up'], true)) <form method="POST"
                                        action="{{ route('delivery-management.update-status', $delivery) }}"> @csrf
                                        <input type="hidden" name="delivery_status" value="in_transit" /> <button
                                            type="submit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-sky-50 text-sky-700 shadow-sm transition hover:bg-sky-100"
                                            title="Ubah status ke In Transit"> <svg class="h-4 w-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg> </button> </form> @endif @if(in_array($current, ['in_transit',
                                    'arrived_destination'], true)) <form method="POST"
                                        action="{{ route('delivery-management.update-status', $delivery) }}"> @csrf
                                        <input type="hidden" name="delivery_status" value="delivered" /> <button
                                            type="submit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700 shadow-sm transition hover:bg-emerald-100"
                                            title="Ubah status ke Delivered"> <svg class="h-4 w-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg> </button> </form> @endif <a
                                        href="{{ route('delivery-management.print-surat-jalan', $delivery) }}"
                                        target="_blank"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-700 shadow-sm transition hover:bg-slate-200"
                                        title="Cetak Surat Jalan" aria-label="Cetak Surat Jalan"> <svg class="h-4 w-4"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h10M7 16h6" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 4h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                        </svg> </a> <a
                                        href="{{ route('delivery-management.show', $delivery) }}#podUploadModal"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-700 shadow-sm transition hover:bg-amber-100"
                                        title="Upload POD" aria-label="Upload POD"> <svg class="h-4 w-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 16v-4m0 0l-3 3m3-3l3 3" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4h16v16H4z" />
                                        </svg> </a> <a href="{{ route('delivery-management.show', $delivery) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700 shadow-sm transition hover:bg-emerald-100"
                                        title="Detail" aria-label="Detail"> <svg class="h-4 w-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-2" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 3h5v5" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 3l-8 8" />
                                        </svg> </a> </div>
                            </td>
                        </tr> @empty <tr>
                            <td colspan="8" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="mb-4 flex h-14 w-14 items-center justify-center rounded-lg bg-slate-100 text-slate-400">
                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />
                                        </svg> </div>
                                    <h3 class="text-base font-bold text-slate-950">Tidak ada pengiriman</h3>
                                    <p class="mt-2 max-w-md text-sm text-slate-500">Belum ada data pengiriman. Pastikan
                                        outbound dengan status "Ready to Ship" telah dibuat.</p>
                                </div>
                            </td>
                        </tr> @endforelse </tbody>
                </table>
            </div>
        </section>
        <div class="mt-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <p class="text-sm text-slate-600"> Menampilkan <strong>{{ $deliveries->firstItem() ?? 0 }}</strong> sampai
                <strong>{{ $deliveries->lastItem() ?? 0 }}</strong> dari <strong>{{ $deliveries->total() }}</strong>
                hasil </p>
            <div> {{ $deliveries->links() }} </div>
        </div>
    </div>
</div> @endsection