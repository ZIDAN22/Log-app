@props([
    "backUrl",
    "backLabel" => 'Batal',
    "submitLabel" => 'Simpan',
    "submitIcon" => true,
    "cancelIcon" => true,
])

<div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
    <a href="{{ $backUrl }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
        @if($cancelIcon)
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4.5 w-4.5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
        @endif
        <span>{{ $backLabel }}</span>
    </a>

    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
        @if($submitIcon)
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4.5 w-4.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                <polyline points="7 3 7 8 15 8"></polyline>
            </svg>
        @endif
        <span>{{ $submitLabel }}</span>
    </button>
</div>
