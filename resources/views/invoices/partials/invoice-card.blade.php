<!-- Invoice Preview Card Component -->
<div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-6 border-l-4 {{ $statusColor ?? 'border-slate-400' }}">
    <div class="flex justify-between items-start mb-4">
        <div>
            <h3 class="text-lg font-bold text-slate-900">{{ $invoiceNumber ?? 'INV-2026-0001' }}</h3>
            <p class="text-sm text-slate-600 mt-1">{{ $customerName ?? 'PT Mitra Logistik' }}</p>
        </div>
        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusBadge ?? 'bg-red-100 text-red-800' }}">
            {{ $status ?? 'Belum Dibayar' }}
        </span>
    </div>

    <div class="space-y-2 mb-4 pb-4 border-b border-slate-200">
        <div class="flex justify-between text-sm">
            <span class="text-slate-600">Tanggal Invoice</span>
            <span class="text-slate-900 font-semibold">{{ $invoiceDate ?? '05 May 2026' }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-600">Jatuh Tempo</span>
            <span class="text-slate-900 font-semibold">{{ $dueDate ?? '19 May 2026' }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-600">Terbayar</span>
            <span class="text-slate-900 font-semibold">{{ $paidAmount ?? 'Rp 0' }}</span>
        </div>
    </div>

    <div class="bg-slate-50 p-3 rounded mb-4">
        <p class="text-xs text-slate-600 mb-1">TOTAL</p>
        <p class="text-2xl font-bold text-slate-900">{{ $total ?? 'Rp 150,000' }}</p>
    </div>

    <div class="flex gap-2">
        <a href="{{ $viewLink ?? '#' }}" class="flex-1 px-3 py-2 bg-blue-500 text-white text-center rounded text-sm hover:bg-blue-600 transition">
            Lihat Detail
        </a>
        <button class="flex-1 px-3 py-2 bg-green-500 text-white rounded text-sm hover:bg-green-600 transition" title="Download PDF">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            PDF
        </button>
        <button class="flex-1 px-3 py-2 bg-purple-500 text-white rounded text-sm hover:bg-purple-600 transition" title="Print">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Print
        </button>
    </div>
</div>
