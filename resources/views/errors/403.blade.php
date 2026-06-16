<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen overflow-hidden bg-white">

<div class="relative flex min-h-screen items-center justify-center px-6">

    <!-- Bright Background -->
    <div class="absolute inset-0 bg-gradient-to-b from-white via-slate-50 to-white"></div>

    <!-- Soft Glow -->
    <div class="absolute left-1/2 top-[48%] h-[420px] w-[420px] -translate-x-1/2 rounded-full bg-sky-100/50 blur-[100px]">
    </div>

    <!-- Secondary Glow -->
    <div class="absolute left-1/2 top-[50%] h-[280px] w-[280px] -translate-x-1/2 rounded-full bg-blue-50 opacity-90 blur-[70px]">
    </div>

    <!-- Decorative Clouds -->
    <div class="absolute left-20 top-44 opacity-80">
        <div class="h-8 w-24 rounded-full bg-white shadow-sm blur-sm"></div>
    </div>

    <div class="absolute right-20 top-56 opacity-80">
        <div class="h-8 w-24 rounded-full bg-white shadow-sm blur-sm"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-3xl text-center">

        <!-- Error Code -->
        <h1 class="text-[90px] md:text-[120px] font-black leading-none tracking-tight text-slate-800">
            403
        </h1>

        <!-- Subtitle -->
        <div class="mt-3 flex items-center justify-center gap-3">

            <span class="h-2 w-2 rounded-full bg-blue-500"></span>

            <h2 class="text-[28px] font-semibold text-blue-600">
                Akses Ditolak
            </h2>

            <span class="h-2 w-2 rounded-full bg-blue-500"></span>

        </div>

        <!-- Description -->
        <p class="mx-auto mt-5 max-w-xl text-lg leading-8 text-slate-600">
            Anda tidak memiliki izin untuk mengakses halaman ini.
            Silakan kembali atau hubungi administrator jika diperlukan.
        </p>

        <!-- Image Section -->
        <div class="relative mt-14 flex justify-center">

            <!-- Circle Background -->
            <div class="absolute top-1/2 h-[290px] w-[290px] -translate-y-1/2 rounded-full border-[30px] border-sky-50 opacity-90">
            </div>

            <!-- Restriction Badge -->
            <div class="absolute top-0 z-20 flex h-16 w-16 items-center justify-center rounded-full bg-white shadow-lg ring-1 ring-slate-100">

                <span class="text-3xl">
                    🚫
                </span>

            </div>

            <!-- Truck Image -->
            <img
                src="{{ asset('images/403.png') }}"
                alt="403 Logistics"
                class="relative z-10 w-[340px] md:w-[440px] object-contain"
            >
        </div>

        <!-- Bottom Text -->
        <p class="mx-auto mt-8 max-w-lg text-slate-500 text-lg leading-8">
            Sepertinya kendaraan logistik kami sedang mengantarkan paket
            ke tujuan lain. Silakan coba lagi nanti.
        </p>

        <!-- Button -->
        <div class="mt-8 flex justify-center">

            <a href="{{ route('dashboard') }}"
                class="rounded-2xl bg-blue-600 px-10 py-4 text-base font-semibold text-white shadow-lg shadow-blue-100 transition hover:bg-blue-700">

                ⌂ Ke Dashboard
            </a>

        </div>

        <!-- Footer -->
        <p class="mt-14 text-sm text-slate-400">
            © {{ date('Y') }} Sistem Logistik. Semua hak dilindungi.
        </p>

    </div>
</div>

</body>
</html>