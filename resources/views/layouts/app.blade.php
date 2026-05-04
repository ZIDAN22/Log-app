<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LogistikPro')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div id="app" class="min-h-screen flex">
        @include('components.sidebar')

        <div class="flex-1">
            @include('components.topbar')

            <main class="p-4 sm:px-6 md:px-8">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
