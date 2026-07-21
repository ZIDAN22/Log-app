@extends('layouts.app')

@section('title', 'Detail Pengiriman')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-5 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-screen-2xl">
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase text-slate-500">Pengiriman</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Detail Pengiriman</h1>
                <p class="mt-1 text-sm text-slate-500">Informasi lengkap shipment dan timeline status.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('pengiriman.edit', $shipment) }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232a2.062 2.062 0 0 1 2.916 2.916L7.75 18.646a.75.75 0 0 1-.338.197l-4 1a.75.75 0 0 1-.928-.928l1-4a.75.75 0 0 1 .197-.338l10.75-10.75Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 5l3 3" />
                    </svg>
                    Edit
                </a>
                <a href="{{ route('pengiriman.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        @php
            $badge = \App\Models\Shipment::statusStyles()[$shipment->shipment_status] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-800'];
            function formatRp($value) { return 'Rp ' . number_format($value, 0, ',', '.'); }
        @endphp

        <div class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">
            <div class="space-y-6">
                <!-- Invoice & Resi Header -->
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Invoice</p>
                            <p class="text-xl font-semibold text-slate-900">{{ $shipment->invoice_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">No Resi</p>
                            <p class="text-xl font-semibold text-slate-900">{{ $shipment->receipt_number }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold {{ $badge['bg'] }} {{ $badge['text'] }}">{{ $shipment->shipment_status }}</span>
                        </div>
                    </div>
                </div>

                <!-- Rincian Shipment -->
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-5 border-b border-slate-200 pb-4">
                        <h2 class="text-base font-bold text-slate-950">Rincian Shipment</h2>
                        <p class="mt-1 text-sm text-slate-500">Detail pengirim, penerima, dan data utama pengiriman.</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Pengirim</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->sender_name }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ $shipment->pickup_address }}</p>
                            <p class="mt-2 text-sm text-slate-500">
                                {{ collect([
                                    $shipment->pickup_village,
                                    $shipment->pickup_district,
                                    $shipment->pickup_city,
                                    $shipment->pickup_province
                                ])->filter()->implode(', ') }}
                            </p>
                            @if($shipment->pickup_postal_code)
                                <p class="mt-2 text-sm text-slate-500">Kode Pos: {{ $shipment->pickup_postal_code }}</p>
                            @endif
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Penerima</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->receiver_name }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ $shipment->destination_address }}</p>
                            <p class="mt-2 text-sm text-slate-500">
                                {{ collect([
                                    $shipment->destination_village,
                                    $shipment->destination_district,
                                    $shipment->destination_city,
                                    $shipment->destination_province
                                ])->filter()->implode(', ') }}
                            </p>
                            @if($shipment->destination_postal_code)
                                <p class="mt-2 text-sm text-slate-500">Kode Pos: {{ $shipment->destination_postal_code }}</p>
                            @endif
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Tipe Barang</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->item_type }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Transportasi</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ ucfirst($shipment->transportation_type) }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Berat</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ number_format($shipment->total_weight, 2, ',', '.') }} KG</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Pickup Date</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->pickup_date->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Biaya Pengiriman (Operasional) -->
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-5 border-b border-slate-200 pb-4">
                        <h2 class="text-base font-bold text-slate-950">Biaya Pengiriman (Operasional)</h2>
                        <p class="mt-1 text-sm text-slate-500">Biaya pengiriman tanpa PPN dan PPh (akan dihitung di Invoice oleh Finance).</p>
                    </div>
                    <div class="grid gap-4 md:grid-cols-1">
                        <div class="rounded-lg border border-blue-200 bg-blue-50 p-4">
                            <p class="text-sm font-semibold text-blue-900">Total Biaya Pengiriman (Shipping Subtotal)</p>
                            <p class="mt-2 text-lg font-bold text-blue-950">{{ formatRp($shipment->shipping_subtotal) }}</p>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 mt-3">
                            <p class="text-xs text-slate-600">Catatan: PPN dan PPh akan dihitung pada proses pembuatan Invoice oleh bagian Finance.</p>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <!-- Ringkasan -->
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-bold text-slate-950">Ringkasan</h2>
                    <dl class="mt-4 space-y-3 text-sm text-slate-700">
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-500">Invoice</dt>
                            <dd class="font-semibold text-slate-950">{{ $shipment->invoice_number }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-500">No Resi</dt>
                            <dd class="font-semibold text-slate-950">{{ $shipment->receipt_number }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-500">Status</dt>
                            <dd class="font-semibold text-slate-950">{{ $shipment->shipment_status }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-500">Dibuat</dt>
                            <dd class="font-semibold text-slate-950">{{ $shipment->created_at->format('d M Y') }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Timeline Status -->
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-bold text-slate-950">Timeline Status</h2>
                    @php
                        $statusSteps = [
                            ['label' => 'Menunggu Pickup', 'statusKey' => 'Menunggu Pickup'],
                            ['label' => 'Proses Pickup', 'statusKey' => 'Proses Pickup'],
                            ['label' => 'Barang Diterima Gudang', 'statusKey' => 'Barang Diterima Gudang'],
                            ['label' => 'Pengemasan Selesai', 'statusKey' => 'Pengemasan Selesai'],
                            ['label' => 'Dikirim', 'statusKey' => 'Dikirim'],
                            ['label' => 'Dalam Perjalanan', 'statusKey' => 'Dalam Perjalanan'],
                            ['label' => 'Sampai', 'statusKey' => 'Sampai'],
                        ];
                        $currentStepIndex = collect($statusSteps)->pluck('statusKey')->search($shipment->shipment_status);
                        $currentStep = $currentStepIndex !== false ? $currentStepIndex + 1 : 1;
                    @endphp

                    <div class="mt-4 space-y-0">
                        @foreach($statusSteps as $index => $step)
                            @php
                                $stepPosition = $index + 1;
                                $isCurrent = $stepPosition === $currentStep;
                                $isCompleted = $stepPosition < $currentStep;
                            @endphp
                            <div class="flex gap-6">
                                <!-- Kolom kiri: lingkaran + garis -->
                                <div class="flex flex-col items-center">
                                    <div class="h-9 w-9 rounded-full flex items-center justify-center shadow-sm flex-shrink-0 z-10 @if($isCompleted) bg-emerald-500 @elseif($isCurrent) bg-blue-600 @else bg-slate-200 @endif">
                                        @if($isCompleted)
                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        @else
                                        <span class="text-sm font-bold text-white">{{ $stepPosition }}</span>
                                        @endif
                                    </div>
                                    @if(!$loop->last)
                                    <div class="w-0.5 flex-1 @if($isCompleted) bg-emerald-500 @else bg-slate-200 @endif"></div>
                                    @endif
                                </div>

                                <!-- Kolom kanan: konten -->
                                <div class="pb-8 flex-1">
                                    <div class="rounded-lg border px-4 py-3 @if($isCurrent) border-blue-200 bg-blue-50 @else border-slate-200 bg-slate-50 @endif">
                                        <div class="flex flex-wrap items-center justify-between gap-2">
                                            <div>
                                                <p class="text-sm font-semibold text-slate-900">{{ $step['label'] }}</p>
                                                @if($isCurrent)
                                                <p class="mt-0.5 text-xs text-slate-500">Status saat ini berada pada tahap ini.</p>
                                                @endif
                                            </div>
                                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold @if($isCompleted) bg-emerald-100 text-emerald-800 @elseif($isCurrent) bg-blue-100 text-blue-800 @else bg-slate-100 text-slate-600 @endif">
                                                {{ $isCompleted ? 'Completed' : ($isCurrent ? 'Current' : 'Upcoming') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
