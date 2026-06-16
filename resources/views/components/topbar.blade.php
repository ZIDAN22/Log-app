<header class="border-b border-slate-200 bg-slate-50 px-4 py-4 sm:px-6 md:px-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="flex items-center gap-4">
            <button id="sidebarToggle" class="flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-100 text-slate-700 transition hover:bg-slate-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M4 6h16M4 18h16" />
                </svg>
            </button>
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">PT. Berlian Lintas Logistik</h1>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative hidden md:block">
                <input type="search" placeholder="Cari pengiriman, rute, atau gudang" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
            </div>
            <button class="hidden rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm transition hover:bg-slate-50 md:inline-flex">Notifikasi</button>
            @auth
            <div class="relative">
                <button id="profileDropdownButton" type="button" class="flex items-center gap-3 rounded-2xl bg-white px-3 py-2 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-500" aria-haspopup="true" aria-expanded="false">
                    @if(auth()->user()->profile_photo_url)
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="Avatar" class="h-9 w-9 rounded-full object-cover" />
                    @else
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-sky-500 text-sm font-semibold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    @endif
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ auth()->user()->role_label }}</p>
                    </div>
                    <svg class="h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.13.992l-4.25 4.656a.75.75 0 01-1.08 0L5.21 8.22a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="profileDropdownMenu" class="absolute right-0 z-50 mt-3 w-56 origin-top-right rounded-2xl border border-slate-200 bg-white p-2 shadow-lg opacity-0 scale-95 pointer-events-none transition-all duration-200" role="menu" aria-label="Profile menu">
                    <a href="{{ route('profile.index') }}" class="block rounded-2xl px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-50" role="menuitem">My Profile</a>
                    <a href="{{ route('profile.index') }}" class="block rounded-2xl px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-50" role="menuitem">Account Settings</a>
                    <a href="{{ route('profile.index') }}#change-password" class="block rounded-2xl px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-50" role="menuitem">Change Password</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2 rounded-2xl bg-slate-50 p-2">
                        @csrf
                        <button type="submit" class="w-full rounded-2xl bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100" role="menuitem">Logout</button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Masuk</a>
            @endauth
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const button = document.getElementById('profileDropdownButton');
                    const menu = document.getElementById('profileDropdownMenu');

                    if (!button || !menu) return;

                    button.addEventListener('click', function (event) {
                        event.stopPropagation();
                        const isOpen = !menu.classList.contains('pointer-events-none');

                        if (isOpen) {
                            menu.classList.add('pointer-events-none', 'opacity-0', 'scale-95');
                            menu.classList.remove('opacity-100', 'scale-100');
                            button.setAttribute('aria-expanded', 'false');
                        } else {
                            menu.classList.remove('pointer-events-none', 'opacity-0', 'scale-95');
                            menu.classList.add('opacity-100', 'scale-100');
                            button.setAttribute('aria-expanded', 'true');
                        }
                    });

                    document.addEventListener('click', function () {
                        if (!menu.classList.contains('pointer-events-none')) {
                            menu.classList.add('pointer-events-none', 'opacity-0', 'scale-95');
                            menu.classList.remove('opacity-100', 'scale-100');
                            button.setAttribute('aria-expanded', 'false');
                        }
                    });

                    menu.addEventListener('click', function (event) {
                        event.stopPropagation();
                    });
                });
            </script>
        </div>
    </div>
</header>
