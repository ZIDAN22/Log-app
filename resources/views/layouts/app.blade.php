<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@hasSection('title')@yield('title') — {{ config('app.name', 'Log-app') }}@else{{ config('app.name', 'Log-app') }}@endif</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 overflow-x-hidden">
    <script>
        // Apply persisted sidebar state immediately to avoid visual flash on reload/navigation.
        try {
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                document.body.classList.add('sidebar-collapsed');
            }
        } catch (e) {
            // ignore (e.g., privacy mode where localStorage is unavailable)
            console.warn('Could not read sidebarCollapsed from localStorage', e);
        }
    </script>
    <div id="app" class="min-h-screen flex">
        @include('components.sidebar')

        <div class="flex-1 min-w-0">
            @include('components.topbar')

            <main class="p-4 sm:px-6 md:px-8">
                <div class="page-wrapper">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
