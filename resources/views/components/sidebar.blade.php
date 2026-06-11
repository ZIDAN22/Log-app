<aside id="sidebar" class="sidebar bg-slate-900 text-slate-100 w-20 md:w-72 transition-all duration-300 shrink-0 overflow-y-auto">
    <!-- Brand Section -->
    <div class="sidebar-brand flex items-center gap-3 px-4 py-5 border-b border-slate-800 sticky top-0 bg-slate-900">
        <div class="brand-image hidden md:block">
            <img src="{{ asset('images/bll.png') }}" alt="LogistikPro Logo" class="h-12 w-auto">
        </div>
    </div>

    <!-- Navigation Sections -->
    <nav class="space-y-6 px-2 py-4">
        
        <!-- DASHBOARD SECTION -->
        <div class="space-y-2">
            <div class="md:inline hidden px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                Dashboard
            </div>
            <a href="{{ route('dashboard') }}" 
               class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-100 hover:bg-slate-800 transition duration-200 group">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-slate-800 text-sky-400 group-hover:bg-sky-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Dashboard</span>
            </a>
        </div>
        
        <!-- OPERASIONAL SECTION -->
        <div class="space-y-2">
            <div class="md:inline hidden px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                Operasional
            </div>
            <a href="{{ route('pengiriman.index') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-emerald-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h5l2 5h6l2-5h5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7v12h14V7" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Daftar Pengiriman</span>
            </a>
            <a href="{{ route('delivery-management.index') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-sky-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6v12" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Manajemen Pengiriman</span>
            </a>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-emerald-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Tracking Status</span>
            </a>
            <a href="{{ route('invoices.index') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-emerald-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Invoice</span>
            </a>
        </div>

        <!-- WAREHOUSE SECTION -->
        <div class="space-y-2">
            <div class="md:inline hidden px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                Warehouse
            </div>
            <a href="{{ route('warehouse.index') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-orange-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Data Gudang</span>
            </a>
            <a href="{{ route('inbound.index') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-orange-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Barang Masuk</span>
            </a>
            <a href="{{ route('packing-list.index') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-amber-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 16V8a2 2 0 00-2-2h-3.5a2 2 0 00-1.789 1.106l-1.105 2.211a2 2 0 01-1.789 1.106H9.5a2 2 0 00-1.789 1.106L6.606 13.11A2 2 0 015 14.216V18a2 2 0 002 2h12a2 2 0 002-2v-2z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Packing List</span>
            </a>
            <a href="{{ route('warehouse.outbound.index') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-orange-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Barang Keluar</span>
            </a>
            <a href="{{ route('warehouse.history') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-orange-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Riwayat Barang</span>
            </a>
        </div>

        <!-- ARMADA SECTION -->
        <div class="space-y-2">
            <div class="md:inline hidden px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                Armada
            </div>
            <a href="{{ route('vehicles.index') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-violet-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414A1 1 0 0121 12v4a1 1 0 01-1 1h-1" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Kendaraan</span>
            </a>
            <a href="{{ route('drivers.index') }}" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-violet-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Driver</span>
            </a>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-violet-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Transportasi</span>
            </a>
        </div>

        <!-- KEUANGAN SECTION -->
        <div class="space-y-2">
            <div class="md:inline hidden px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                Keuangan
            </div>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-green-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Pembayaran</span>
            </a>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-green-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Laporan Keuangan</span>
            </a>
        </div>

        <!-- MASTER DATA SECTION -->
        <div class="space-y-2">
            <div class="md:inline hidden px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                Master Data
            </div>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-blue-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Pelanggan</span>
            </a>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-blue-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Kota / Tujuan</span>
            </a>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-blue-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Tarif Pengiriman</span>
            </a>
        </div>

        <!-- REPORTING SECTION -->
        <div class="space-y-2">
            <div class="md:inline hidden px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                Reporting
            </div>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-amber-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Laporan Pengiriman</span>
            </a>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-amber-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Laporan Status</span>
            </a>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-amber-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Laporan Pendapatan</span>
            </a>
        </div>

        <!-- SETTINGS SECTION -->
        <div class="space-y-2 pb-4">
            <div class="md:inline hidden px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                Settings
            </div>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-gray-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">User Management</span>
            </a>
            <a href="#" class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-slate-100 hover:bg-slate-800 transition group">
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-gray-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>
                <span class="sidebar-label hidden md:inline font-medium text-sm">Role & Permission</span>
            </a>
        </div>
    </nav>
</aside>
