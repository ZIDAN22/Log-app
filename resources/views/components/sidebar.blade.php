<aside id="sidebar" class="sidebar bg-slate-900 text-slate-100 w-20 md:w-72 transition-all duration-300 shrink-0">
    <div class="sidebar-brand flex items-center gap-3 px-4 py-5 border-b border-slate-800">
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-sky-500 text-white shadow-lg shadow-sky-500/20">
            <span class="text-lg font-semibold">L</span>
        </div>
        <div class="brand-text hidden md:block">
            <p class="text-sm font-semibold tracking-wide">LogistikPro</p>
            <p class="text-xs text-slate-400">Sistem Ekspedisi</p>
        </div>
    </div>
    <button id="sidebarToggle" class="mx-4 mt-4 flex h-11 w-[calc(100%-2rem)] items-center justify-center gap-2 rounded-2xl bg-slate-800 text-slate-200 transition hover:bg-slate-700">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M4 6h16M4 18h16" />
        </svg>
        {{-- <span class="text-sm font-semibold">Toggle</span> --}}
    </button>
    <nav class="mt-6 space-y-1 px-2">
        <a href="{{ route('dashboard') }}" class="sidebar-item group flex items-center gap-3 rounded-2xl px-3 py-3 text-slate-100 transition hover:bg-slate-800">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800 text-sky-400 group-hover:bg-sky-500">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                </svg>
            </span>
            <span class="sidebar-label hidden md:inline font-medium">Dashboard</span>
        </a>
        <a href="#" class="sidebar-item group flex items-center gap-3 rounded-2xl px-3 py-3 text-slate-100 transition hover:bg-slate-800">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800 text-emerald-400 group-hover:bg-emerald-500">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
            </span>
            <span class="sidebar-label hidden md:inline font-medium">Pengiriman</span>
        </a>
        <a href="#" class="sidebar-item group flex items-center gap-3 rounded-2xl px-3 py-3 text-slate-100 transition hover:bg-slate-800">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800 text-orange-400 group-hover:bg-orange-500">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4-4 4 4m0-6l-4 4-4-4" />
                </svg>
            </span>
            <span class="sidebar-label hidden md:inline font-medium">Inventaris</span>
        </a>
        <a href="#" class="sidebar-item group flex items-center gap-3 rounded-2xl px-3 py-3 text-slate-100 transition hover:bg-slate-800">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800 text-violet-400 group-hover:bg-violet-500">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zm0 2c-3.314 0-6 2.686-6 6v1h12v-1c0-3.314-2.686-6-6-6z" />
                </svg>
            </span>
            <span class="sidebar-label hidden md:inline font-medium">Tim</span>
        </a>
        <a href="#" class="sidebar-item group flex items-center gap-3 rounded-2xl px-3 py-3 text-slate-100 transition hover:bg-slate-800">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800 text-amber-400 group-hover:bg-amber-500">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h6l2 2h4a2 2 0 012 2v10a2 2 0 01-2 2z" />
                </svg>
            </span>
            <span class="sidebar-label hidden md:inline font-medium">Laporan</span>
        </a>
    </nav>

</aside>
