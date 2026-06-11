<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'presenZ') }}</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%231E40AF%22/><text x=%2250%22 y=%2270%22 font-family=%22sans-serif%22 font-weight=%22bold%22 font-size=%2260%22 text-anchor=%22middle%22 fill=%22white%22>Z</text></svg>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 relative min-h-screen flex flex-col items-center justify-center overflow-hidden px-4 py-12">
    <!-- Abstract Colorful Background Blobs (No purple dominance) -->
    <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-cyan-400/20 blur-[100px] animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[55vw] h-[55vw] rounded-full bg-emerald-400/20 blur-[120px] animate-pulse pointer-events-none" style="animation-delay: 2s; animation-duration: 6s;"></div>
    <div class="absolute top-[30%] right-[10%] w-[35vw] h-[35vw] rounded-full bg-amber-400/15 blur-[90px] animate-pulse pointer-events-none" style="animation-delay: 4s; animation-duration: 8s;"></div>

    <!-- Grid Pattern Overlay -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-40 pointer-events-none"></div>

    <div class="relative z-10 w-full sm:max-w-md">
        <!-- Logo Section -->
        <div class="flex flex-col items-center mb-8">
            <a href="/" class="flex items-center gap-2 group transition-transform duration-200 hover:scale-[1.02]">
                <span class="text-3xl font-black bg-gradient-to-r from-teal-600 via-cyan-600 to-amber-500 bg-clip-text text-transparent tracking-widest uppercase">
                    Presen<span class="text-slate-800">Z</span>
                </span>
            </a>
            <p class="text-xs text-slate-400 font-semibold tracking-wider uppercase mt-1">Smart Attendance System</p>
        </div>

        <!-- Glassmorphic Card -->
        <div class="w-full bg-white/80 backdrop-blur-xl border border-white/60 shadow-2xl shadow-slate-200/50 rounded-3xl px-8 py-10">
            @yield('content')
        </div>
    </div>
</body>
</html>
