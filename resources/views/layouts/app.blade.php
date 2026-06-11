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
    
    <style>
        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .text-xxs {
            font-size: 0.65rem;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-800 bg-dashboard-gradient min-h-screen">
    <!-- Top decorative gradient bar -->
    <div class="h-1 bg-gradient-to-r from-teal-400 via-emerald-400 via-amber-400 via-cyan-400 to-indigo-500 w-full"></div>

    @if(auth()->user()->role === 'karyawan')
        <!-- ========================================== -->
        <!-- EMPLOYEE LAYOUT (Top Nav Bar)              -->
        <!-- ========================================== -->
        <div class="min-h-screen flex flex-col">
            <nav class="border-b border-slate-200/60 bg-white/80 backdrop-blur-md sticky top-0 z-30 shadow-sm">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between items-center">
                        <div class="flex items-center gap-8">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <a href="{{ route('dashboard') }}" class="flex items-center">
                                    <span class="text-xl font-black bg-gradient-to-r from-teal-600 via-cyan-600 to-amber-500 bg-clip-text text-transparent tracking-wider uppercase">Presen<span class="text-slate-800">Z</span></span>
                                </a>
                            </div>

                            <!-- Links (Desktop) -->
                            <div class="hidden space-x-1 sm:-my-px sm:flex h-16">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 pt-1 border-b-2 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'border-teal-500 text-teal-600 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('attendance.history') }}" class="inline-flex items-center px-3 pt-1 border-b-2 text-sm font-medium transition {{ request()->routeIs('attendance.history') ? 'border-teal-500 text-teal-600 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }}">
                                    Riwayat Absensi
                                </a>
                                <a href="{{ route('leaves.index') }}" class="inline-flex items-center px-3 pt-1 border-b-2 text-sm font-medium transition {{ request()->routeIs('leaves.*') ? 'border-teal-500 text-teal-600 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }}">
                                    Pengajuan Cuti / Izin
                                </a>
                            </div>
                        </div>

                        <!-- User Profile Dropdown (Desktop) -->
                        <div class="hidden sm:flex sm:items-center gap-4">
                            <div class="h-5 w-px bg-slate-200"></div>
                            
                            <!-- Custom Profile Dropdown HTML/JS -->
                            <div class="relative" id="profile-dropdown">
                                <button onclick="toggleDropdown('profile-menu')" class="flex items-center gap-2.5 focus:outline-none group">
                                    <img 
                                        src="{{ auth()->user()->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=0ea5e9&color=fff&bold=true' }}" 
                                        alt="User" 
                                        class="w-9 h-9 object-cover rounded-xl border border-slate-200 shadow-sm transition group-hover:scale-105"
                                    >
                                    <div class="text-left">
                                        <span class="block text-xs font-semibold text-slate-800 leading-none">{{ auth()->user()->name }}</span>
                                        <span class="block text-[10px] text-slate-400 uppercase mt-0.5 font-bold tracking-wider">{{ auth()->user()->role }}</span>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <!-- Dropdown Content -->
                                <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white/95 backdrop-blur-md rounded-2xl border border-slate-200/60 shadow-xl py-2 z-50">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Profile</a>
                                    <div class="border-t border-slate-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition">Log Out</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Hamburger Menu Button (Mobile) -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button onclick="toggleDropdown('mobile-nav')" class="inline-flex items-center justify-center rounded-xl p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 focus:outline-none">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Menu (Mobile) -->
                <div id="mobile-nav" class="hidden sm:hidden bg-white border-b border-slate-200/80">
                    <div class="space-y-1 pb-3 pt-2 px-4">
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-xl text-base font-semibold {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">Dashboard</a>
                        <a href="{{ route('attendance.history') }}" class="block px-3 py-2 rounded-xl text-base font-semibold {{ request()->routeIs('attendance.history') ? 'bg-teal-50 text-teal-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">Riwayat Absensi</a>
                        <a href="{{ route('leaves.index') }}" class="block px-3 py-2 rounded-xl text-base font-semibold {{ request()->routeIs('leaves.*') ? 'bg-teal-50 text-teal-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">Pengajuan Cuti / Izin</a>
                    </div>
                    <div class="border-t border-slate-200 pb-3 pt-4 px-4 bg-slate-50/50">
                        <div class="flex items-center gap-3">
                            <img 
                                src="{{ auth()->user()->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=0ea5e9&color=fff&bold=true' }}" 
                                alt="Avatar" 
                                class="w-10 h-10 object-cover rounded-xl"
                            >
                            <div>
                                <div class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-slate-500">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-3 py-2 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            @if (isset($header))
                <header class="bg-white border-b border-slate-200/40">
                    <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="mx-auto max-w-7xl w-full px-4 py-8 sm:px-6 lg:px-8 flex-1">
                @yield('content')
            </main>
        </div>
    @else
        <!-- ========================================== -->
        <!-- ADMIN / HRD LAYOUT (Sidebar + Top Bar)      -->
        <!-- ========================================== -->
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside id="admin-sidebar" class="w-64 bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-slate-100 transition-all duration-300 min-h-screen flex flex-col shadow-2xl z-20 border-r border-slate-800/40">
                <div class="h-16 flex items-center justify-between px-4 border-b border-slate-800/40 bg-slate-950/40">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2" id="sidebar-logo-container">
                        <span class="text-xl font-black bg-gradient-to-r from-teal-400 via-cyan-400 to-emerald-400 bg-clip-text text-transparent tracking-wider uppercase">Presen<span class="text-white">Z</span></span>
                    </a>
                    <button onclick="toggleSidebar()" class="text-slate-400 hover:text-white p-1.5 rounded-lg hover:bg-slate-800/50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <nav class="flex-1 px-3 py-6 space-y-1.5 overflow-y-auto scrollbar-thin">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition group relative {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-teal-600 to-emerald-600 text-white shadow-lg shadow-teal-500/25' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="sidebar-text font-medium text-sm">Dashboard</span>
                        @if(request()->routeIs('dashboard'))
                            <span class="absolute left-0 w-1 h-6 bg-teal-400 rounded-r-full"></span>
                        @endif
                    </a>

                    <div class="sidebar-header px-3 pt-5 pb-1.5 text-xxs font-semibold text-slate-500 uppercase tracking-widest">Management</div>

                    <a href="{{ route('admin.employees') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition group relative {{ request()->routeIs('admin.employees') ? 'bg-gradient-to-r from-teal-600 to-emerald-600 text-white shadow-lg shadow-teal-500/25' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="sidebar-text font-medium text-sm">Karyawan</span>
                        @if(request()->routeIs('admin.employees'))
                            <span class="absolute left-0 w-1 h-6 bg-teal-400 rounded-r-full"></span>
                        @endif
                    </a>

                    <a href="{{ route('admin.master-data') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition group relative {{ request()->routeIs('admin.master-data') ? 'bg-gradient-to-r from-teal-600 to-emerald-600 text-white shadow-lg shadow-teal-500/25' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span class="sidebar-text font-medium text-sm">Master Data</span>
                        @if(request()->routeIs('admin.master-data'))
                            <span class="absolute left-0 w-1 h-6 bg-teal-400 rounded-r-full"></span>
                        @endif
                    </a>

                    <div class="sidebar-header px-3 pt-5 pb-1.5 text-xxs font-semibold text-slate-500 uppercase tracking-widest">Reports</div>

                    <a href="{{ route('attendance.history') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition group relative {{ request()->routeIs('attendance.history') ? 'bg-gradient-to-r from-teal-600 to-emerald-600 text-white shadow-lg shadow-teal-500/25' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span class="sidebar-text font-medium text-sm">Absensi Semua</span>
                        @if(request()->routeIs('attendance.history'))
                            <span class="absolute left-0 w-1 h-6 bg-teal-400 rounded-r-full"></span>
                        @endif
                    </a>

                    <a href="{{ route('leaves.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition group relative {{ request()->routeIs('leaves.index') ? 'bg-gradient-to-r from-teal-600 to-emerald-600 text-white shadow-lg shadow-teal-500/25' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="sidebar-text font-medium text-sm">Approval Cuti</span>
                        @if(request()->routeIs('leaves.index'))
                            <span class="absolute left-0 w-1 h-6 bg-teal-400 rounded-r-full"></span>
                        @endif
                    </a>
                </nav>
            </aside>

            <!-- Content Area -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Topbar -->
                <header class="h-16 bg-white/85 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-6 z-10 sticky top-0">
                    <div class="flex items-center">
                        <button onclick="toggleSidebar()" class="text-slate-500 hover:text-slate-800 p-1.5 rounded-lg hover:bg-slate-100 sm:hidden transition-colors mr-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h1 class="text-lg font-bold text-slate-900 flex items-center">
                            @yield('header')
                        </h1>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="h-5 w-px bg-slate-200"></div>

                        <!-- Dropdown -->
                        <div class="relative" id="profile-dropdown-admin">
                            <button onclick="toggleDropdown('profile-menu-admin')" class="flex items-center gap-2.5 focus:outline-none group">
                                <img 
                                    src="{{ auth()->user()->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=0ea5e9&color=fff&bold=true' }}" 
                                    alt="Admin" 
                                    class="w-9 h-9 object-cover rounded-xl border border-slate-200 shadow-sm transition group-hover:scale-105"
                                >
                                <div class="text-left hidden sm:block">
                                    <span class="block text-xs font-semibold text-slate-800 leading-none">{{ auth()->user()->name }}</span>
                                    <span class="block text-[10px] text-slate-400 uppercase mt-0.5 font-bold tracking-wider">{{ auth()->user()->role }}</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div id="profile-menu-admin" class="hidden absolute right-0 mt-2 w-48 bg-white/95 backdrop-blur-md rounded-2xl border border-slate-200/60 shadow-xl py-2 z-50">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Profile</a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-transparent p-6 sm:p-8">
                    @yield('content')
                </main>
            </div>
        </div>
    @endif

    <!-- ========================================== -->
    <!-- PREMIUM GLOBAL TOAST NOTIFICATIONS         -->
    <!-- ========================================== -->
    @if(session('success') || session('error'))
        <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-3">
            @if(session('success'))
                <div class="toast bg-emerald-550 text-white px-5 py-3.5 rounded-2xl shadow-2xl flex items-center gap-2.5 border border-emerald-400/20 transition-all duration-300 transform translate-y-0 opacity-100" style="background-color: #10B981;">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-xs font-bold tracking-wide">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="toast bg-rose-550 text-white px-5 py-3.5 rounded-2xl shadow-2xl flex items-center gap-2.5 border border-rose-400/20 transition-all duration-300 transform translate-y-0 opacity-100" style="background-color: #EF4444;">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="text-xs font-bold tracking-wide">{{ session('error') }}</span>
                </div>
            @endif
        </div>
        <script>
            setTimeout(() => {
                const toasts = document.querySelectorAll('.toast');
                toasts.forEach(toast => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(20px)';
                    setTimeout(() => toast.remove(), 300);
                });
            }, 4000);
        </script>
    @endif

    <!-- Dropdown & Sidebar Script -->
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }

        // Close dropdowns when clicking outside
        window.addEventListener('click', function(e) {
            const profileDropdown = document.getElementById('profile-dropdown');
            const profileMenu = document.getElementById('profile-menu');
            if (profileDropdown && profileMenu && !profileDropdown.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
            
            const profileDropdownAdmin = document.getElementById('profile-dropdown-admin');
            const profileMenuAdmin = document.getElementById('profile-menu-admin');
            if (profileDropdownAdmin && profileMenuAdmin && !profileDropdownAdmin.contains(e.target)) {
                profileMenuAdmin.classList.add('hidden');
            }
        });

        // Sidebar Collapse Logic
        let sidebarCollapsed = false;
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const logoContainer = document.getElementById('sidebar-logo-container');
            const texts = document.querySelectorAll('.sidebar-text');
            const headers = document.querySelectorAll('.sidebar-header');

            if (!sidebar) return;

            if (sidebarCollapsed) {
                sidebar.className = sidebar.className.replace('w-20', 'w-64');
                if (logoContainer) {
                    logoContainer.innerHTML = '<span class="text-xl font-black bg-gradient-to-r from-teal-400 via-cyan-400 to-emerald-400 bg-clip-text text-transparent tracking-wider uppercase">Presen<span class="text-white">Z</span></span>';
                }
                texts.forEach(el => el.classList.remove('hidden'));
                headers.forEach(el => el.classList.remove('hidden'));
                sidebarCollapsed = false;
            } else {
                sidebar.className = sidebar.className.replace('w-64', 'w-20');
                if (logoContainer) {
                    logoContainer.innerHTML = '<span class="text-xl font-black text-teal-400">P</span>';
                }
                texts.forEach(el => el.classList.add('hidden'));
                headers.forEach(el => el.classList.add('hidden'));
                sidebarCollapsed = true;
            }
        }
    </script>
</body>
</html>
