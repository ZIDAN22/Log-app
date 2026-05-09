@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Detail Pengiriman</h1>
                <p class="text-slate-600">Informasi lengkap shipment dan timeline status.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('pengiriman.edit', $shipment) }}" class="inline-flex items-center justify-center rounded-xl bg-amber-100 px-5 py-3 text-sm font-semibold text-amber-800 hover:bg-amber-200">Edit</a>
                <a href="{{ route('pengiriman.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Kembali</a>
            </div>
        </div>

        @php
            $badge = \App\Models\Shipment::statusStyles()[$shipment->shipment_status] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-800'];
            function formatRp($value) { return 'Rp ' . number_format($value, 0, ',', '.'); }
        @endphp

        <div class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">
            <div class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
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

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Rincian Shipment</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Pengirim</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->sender_name }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ $shipment->pickup_address }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Penerima</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->receiver_name }}</p>
                            <p class="mt-3 text-sm text-slate-600">{{ $shipment->destination_city }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Tipe Barang</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->item_type }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Transportasi</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ ucfirst($shipment->transportation_type) }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Berat</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ number_format($shipment->total_weight, 2, ',', '.') }} KG</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Pickup Date</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $shipment->pickup_date->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Biaya Pengiriman</h2>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Subtotal</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ formatRp($shipment->subtotal) }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">PPN (1.1%)</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ formatRp($shipment->ppn) }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">PPH (2%)</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ formatRp($shipment->pph) }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm text-slate-500">Grand Total</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ formatRp($shipment->grand_total) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Ringkasan</h2>
                    <dl class="space-y-4 text-sm text-slate-600">
                        <div class="flex justify-between gap-3">
                            <dt>Invoice</dt>
                            <dd class="font-semibold text-slate-900">{{ $shipment->invoice_number }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt>No Resi</dt>
                            <dd class="font-semibold text-slate-900">{{ $shipment->receipt_number }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt>Status</dt>
                            <dd class="font-semibold text-slate-900">{{ $shipment->shipment_status }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt>Dibuat</dt>
                            <dd class="font-semibold text-slate-900">{{ $shipment->created_at->format('d M Y') }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xl font-semibold text-slate-900 mb-5">Timeline Status</h2>
                    @php
                        $statusSteps = [
                            ['label' => 'Pending Pickup', 'statusKey' => 'Pending Pickup'],
                            ['label' => 'Pickup Process', 'statusKey' => 'Diproses'],
                            ['label' => 'Barang Diterima Gudang', 'statusKey' => 'Barang Diterima Gudang'],
                            ['label' => 'Packing Completed', 'statusKey' => 'Packing Completed'],
                            ['label' => 'Dikirim', 'statusKey' => 'Dikirim'],
                            ['label' => 'Dalam Perjalanan', 'statusKey' => 'Dalam Perjalanan'],
                            ['label' => 'Sampai', 'statusKey' => 'Sampai'],
                        ];
                        $currentStepIndex = collect($statusSteps)->pluck('statusKey')->search($shipment->shipment_status);
                        $currentStep = $currentStepIndex !== false ? $currentStepIndex + 1 : 1;
                    @endphp

                    <div class="relative pl-10">
                        <span class="pointer-events-none absolute left-4 top-5 h-full w-px bg-slate-200"></span>

                        @foreach($statusSteps as $index => $step)
                            @php
                                $stepPosition = $index + 1;
                                $isCurrent = $stepPosition === $currentStep;
                                $isCompleted = $stepPosition < $currentStep;
                                $isUpcoming = $stepPosition > $currentStep;
                            @endphp

                            <div class="relative mb-8 last:mb-0">
                                <div class="absolute -left-1.5 top-0 flex h-9 w-9 items-center justify-center rounded-full ring-1 ring-inset {{ $isCompleted ? 'bg-emerald-500 text-white ring-emerald-500' : ($isCurrent ? 'bg-blue-600 text-white ring-blue-600' : 'bg-slate-200 text-slate-600 ring-slate-200') }}">
                                    @if($isCompleted)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                            <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.386 7.386a1 1 0 01-1.42 0L3.296 8.094a1 1 0 011.42-1.42l4.096 4.096 6.674-6.674a1 1 0 011.418 0z" clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <span class="text-sm font-semibold">{{ $stepPosition }}</span>
                                    @endif
                                </div>

                                <div class="rounded-3xl border px-4 py-4 {{ $isCurrent ? 'border-blue-200 bg-blue-50' : 'border-slate-200 bg-slate-50' }}">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm font-semibold {{ $isCompleted ? 'text-slate-900' : ($isCurrent ? 'text-slate-900' : 'text-slate-700') }}">{{ $step['label'] }}</p>
                                            @if($isCurrent)
                                                <p class="mt-1 text-xs text-slate-500">Status saat ini berada pada tahap ini.</p>
                                            @endif
                                        </div>
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $isCompleted ? 'bg-emerald-100 text-emerald-800' : ($isCurrent ? 'bg-blue-100 text-blue-800' : 'bg-slate-100 text-slate-600') }}">
                                            {{ $isCompleted ? 'Completed' : ($isCurrent ? 'Current' : 'Upcoming') }}
                                        </span>
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
