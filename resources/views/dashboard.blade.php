@extends('layouts.app')

@section('content')
    <div class="space-y-8">
        <!-- Clock Widget & User Greeting -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Clock Widget Card (Tosca Gradient) -->
            <div class="lg:col-span-2 bg-gradient-to-r from-teal-600 via-teal-500 to-emerald-400 text-white rounded-3xl p-6 sm:p-8 shadow-xl shadow-teal-500/10 relative overflow-hidden group">
                <div class="absolute -right-16 -top-16 w-48 h-48 rounded-full bg-white/5 blur-2xl group-hover:scale-125 transition-transform duration-700"></div>
                <div class="absolute right-12 bottom-0 w-32 h-32 rounded-full bg-teal-400/10 blur-xl"></div>
                
                <div class="relative z-10 flex flex-col justify-between h-full min-h-[160px]">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 text-xs font-semibold backdrop-blur-md mb-4 uppercase tracking-wider text-white">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Live Attendance
                        </span>
                        <h3 class="text-2xl sm:text-3xl font-black tracking-tight" id="greeting-text">Selamat Pagi, {{ auth()->user()->name }}!</h3>
                        <p class="text-sm text-slate-100 mt-1 font-medium" id="date-text">Hari ini</p>
                    </div>
                    
                    <!-- Pulsing Time -->
                    <div class="mt-6 flex items-baseline gap-2">
                        <span class="text-4xl sm:text-6xl font-black font-mono tracking-tight tabular-nums drop-shadow-md select-none text-white" id="clock-text">
                            00:00:00
                        </span>
                        <span class="text-xs uppercase font-bold tracking-widest text-slate-200 bg-white/20 px-2 py-0.5 rounded-md select-none">WIB</span>
                    </div>
                </div>
            </div>
            
            <!-- Shift Info Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/50 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Shift Hari Ini</span>
                        <span class="p-2 rounded-xl bg-teal-50 text-teal-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                    </div>
                    @if($shift)
                        <div>
                            <h4 class="text-xl font-extrabold text-slate-800 leading-snug">{{ $shift->name }}</h4>
                            <p class="text-sm text-slate-500 mt-1">
                                Jam Kerja: <span class="font-semibold text-slate-700">{{ substr($shift->start_time, 0, 5) }} - {{ substr($shift->end_time, 0, 5) }}</span>
                            </p>
                        </div>
                    @else
                        <div class="py-2 text-slate-400 font-medium text-sm">
                            Tidak ada jadwal shift terdaftar untuk hari ini.
                        </div>
                    @endif
                </div>
                
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
                    <span class="text-slate-400">Status Kehadiran:</span>
                    <span 
                        class="px-2.5 py-1 rounded-full uppercase tracking-wider text-[10px] font-black {{ $attendanceToday ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-100 text-slate-500' }}"
                    >
                        {{ $attendanceToday ? 'SUDAH HADIR' : 'BELUM ABSEN' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Stats Rows -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Stat Card 1 -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/50 flex items-center gap-4 transition hover:shadow-md">
                <div class="p-3 bg-teal-50 text-teal-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Jadwal Aktif</span>
                    <span class="block text-lg font-black text-slate-800 mt-0.5">{{ $shift ? $shift->name : 'Libur / Tidak Ada' }}</span>
                </div>
            </div>

            <!-- Stat Card 2 -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/50 flex items-center gap-4 transition hover:shadow-md">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Status Absensi Hari Ini</span>
                    <span class="block text-lg font-black text-emerald-600 mt-0.5" id="attendance-status-display">
                        @if($attendanceToday)
                            Hadir ({{ Carbon\Carbon::parse($attendanceToday->check_in_time)->format('H:i') }})
                        @else
                            Belum Check-in
                        @endif
                    </span>
                </div>
            </div>

            <!-- Stat Card 3 -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/50 flex items-center gap-4 transition hover:shadow-md">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Pengajuan Izin Pending</span>
                    <span class="block text-lg font-black text-slate-800 mt-0.5">{{ $leavesPending }} Pengajuan</span>
                </div>
            </div>
        </div>

        <!-- Attendance Camera & Map Area -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/50">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-2.5 h-6 bg-teal-500 rounded-full"></div>
                <h3 class="text-lg font-extrabold text-slate-900">Live Attendance Panel</h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                <!-- Left: Camera Preview Container with Glowing Border & Pulsing REC -->
                <div class="w-full bg-slate-50 rounded-2xl p-2.5 border border-slate-200/60 shadow-inner relative aspect-video flex items-center justify-center overflow-hidden">
                    <video id="webcam" autoplay playsinline class="w-full h-full object-cover rounded-xl shadow-sm bg-black"></video>
                    
                    <!-- Pulse Overlay "REC" -->
                    <div class="absolute top-5 left-5 z-10 flex items-center gap-2 bg-slate-950/60 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10 select-none">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></span>
                        <span class="text-white text-[10px] font-black tracking-widest uppercase">REC / LIVE</span>
                    </div>

                    <!-- User Avatars Silhouette in center when no camera -->
                    <div id="camera-fallback" class="hidden absolute inset-0 bg-slate-900/90 flex flex-col items-center justify-center text-center p-6 text-slate-200">
                        <svg class="w-12 h-12 text-rose-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <h4 class="font-bold text-sm">Kamera Tidak Tersedia</h4>
                        <p class="text-xs text-slate-400 max-w-xs mt-1" id="camera-error-text">Akses kamera gagal.</p>
                    </div>
                </div>
                
                <!-- Right: Actions, Coordinates & Verification Status -->
                <div class="space-y-6">
                    <!-- Location details panel -->
                    <div class="bg-slate-50 border border-slate-200/60 rounded-2xl p-5 shadow-sm">
                        <h4 class="font-bold text-slate-700 text-sm mb-3 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Posisi Geografis GPS Anda
                        </h4>
                        
                        <div class="text-sm">
                            <div id="gps-status-loading" class="text-slate-500 font-medium flex items-center gap-2">
                                <svg class="w-4 h-4 animate-spin text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Mencari koordinat presisi...</span>
                            </div>

                            <div id="gps-status-error" class="hidden text-rose-500 font-medium flex items-start gap-2">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <span id="gps-error-text">GPS tidak aktif.</span>
                            </div>

                            <div id="gps-coords-box" class="hidden space-y-3">
                                <div class="flex items-center gap-2 text-emerald-600 font-extrabold">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Sinyal GPS Terdeteksi & Terverifikasi
                                </div>
                                <div class="grid grid-cols-2 gap-4 bg-white rounded-xl p-3 border border-slate-200/40 text-xs">
                                    <div>
                                        <span class="block text-slate-400 uppercase font-bold text-[9px] tracking-wider">Latitude</span>
                                        <span class="font-mono font-bold text-slate-700" id="lat-display">-</span>
                                    </div>
                                    <div>
                                        <span class="block text-slate-400 uppercase font-bold text-[9px] tracking-wider">Longitude</span>
                                        <span class="font-mono font-bold text-slate-700" id="lng-display">-</span>
                                    </div>
                                </div>

                                <!-- Structured Address Details -->
                                <div id="address-loading" class="text-xs text-slate-400 pt-2 flex items-center gap-1.5 font-medium">
                                    <svg class="w-3.5 h-3.5 animate-spin text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Menerjemahkan koordinat lokasi ke alamat...
                                </div>

                                <div id="address-details" class="hidden space-y-3 pt-3 border-t border-slate-100 text-xs">
                                    <div>
                                        <span class="block text-slate-400 font-bold uppercase tracking-wider text-[9px]">Alamat Lengkap</span>
                                        <span class="text-slate-800 font-bold leading-relaxed block mt-0.5" id="display-name">-</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3 mt-1 text-[11px] leading-snug">
                                        <div class="bg-white rounded-xl p-2.5 border border-slate-200/40 shadow-xxs">
                                            <span class="block text-slate-400 font-bold uppercase tracking-wider text-[8px]">Jalan</span>
                                            <span class="font-bold text-slate-700 block mt-0.5" id="road-val">-</span>
                                        </div>
                                        <div class="bg-white rounded-xl p-2.5 border border-slate-200/40 shadow-xxs">
                                            <span class="block text-slate-400 font-bold uppercase tracking-wider text-[8px]">Kelurahan</span>
                                            <span class="font-bold text-slate-700 block mt-0.5" id="kel-val">-</span>
                                        </div>
                                        <div class="bg-white rounded-xl p-2.5 border border-slate-200/40 shadow-xxs">
                                            <span class="block text-slate-400 font-bold uppercase tracking-wider text-[8px]">Kecamatan</span>
                                            <span class="font-bold text-slate-700 block mt-0.5" id="kec-val">-</span>
                                        </div>
                                        <div class="bg-white rounded-xl p-2.5 border border-slate-200/40 shadow-xxs">
                                            <span class="block text-slate-400 font-bold uppercase tracking-wider text-[8px]">Kota</span>
                                            <span class="font-bold text-slate-700 block mt-0.5" id="kota-val">-</span>
                                        </div>
                                        <div class="bg-white rounded-xl p-2.5 border border-slate-200/40 shadow-xxs">
                                            <span class="block text-slate-400 font-bold uppercase tracking-wider text-[8px]">Provinsi</span>
                                            <span class="font-bold text-slate-700 block mt-0.5" id="prov-val">-</span>
                                        </div>
                                        <div class="bg-white rounded-xl p-2.5 border border-slate-200/40 shadow-xxs">
                                            <span class="block text-slate-400 font-bold uppercase tracking-wider text-[8px]">Negara</span>
                                            <span class="font-bold text-slate-700 block mt-0.5" id="neg-val">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hidden Canvas & Form for Photo capture -->
                    <canvas id="photo-canvas" style="display: none;"></canvas>
                    
                    <form id="attendance-form" method="POST" action="">
                        @csrf
                        <input type="hidden" name="shift_id" value="{{ $shift ? $shift->id : '' }}">
                        <input type="hidden" name="latitude" id="lat-input">
                        <input type="hidden" name="longitude" id="lng-input">
                        <input type="hidden" name="photo" id="photo-input">
                    </form>

                    <!-- Action Submit Buttons -->
                    <div class="flex flex-col gap-4">
                        <button 
                            id="check-in-btn"
                            onclick="submitAttendance('check-in')"
                            disabled
                            class="w-full py-4 px-6 rounded-2xl text-white font-extrabold text-base tracking-wide bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 transition duration-150 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:from-emerald-500 disabled:hover:to-emerald-600 shadow-lg shadow-emerald-500/10 active:scale-[0.99]"
                        >
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                CHECK IN MASUK
                            </span>
                        </button>

                        <button 
                            id="check-out-btn"
                            onclick="submitAttendance('check-out')"
                            disabled
                            class="w-full py-4 px-6 rounded-2xl text-white font-extrabold text-base tracking-wide bg-gradient-to-r from-rose-500 via-red-500 to-rose-600 hover:from-rose-600 hover:to-red-700 transition duration-150 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:from-rose-500 disabled:hover:to-rose-600 shadow-lg shadow-rose-500/10 active:scale-[0.99]"
                        >
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                CHECK OUT KELUAR
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Summary Cards -->
        <div>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-2.5 h-6 bg-cyan-500 rounded-full"></div>
                <h3 class="text-lg font-extrabold text-slate-900">Ringkasan Absensi Bulan Ini</h3>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Present -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/50 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Hadir</span>
                        <span class="p-2 rounded-xl bg-blue-50 text-blue-600 text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="mt-4">
                        <span class="text-2xl font-black text-slate-800">{{ $monthlySummary->total_present }}</span>
                        <span class="text-[10px] text-slate-400 block mt-1">Hari Kerja</span>
                    </div>
                </div>

                <!-- On Time -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/50 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tepat Waktu</span>
                        <span class="p-2 rounded-xl bg-emerald-50 text-emerald-600 text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="mt-4">
                        <span class="text-2xl font-black text-emerald-600">{{ $monthlySummary->total_ontime }}</span>
                        <span class="text-[10px] text-slate-400 block mt-1">Hari Kerja</span>
                    </div>
                </div>

                <!-- Late -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/50 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Terlambat</span>
                        <span class="p-2 rounded-xl bg-amber-50 text-amber-600 text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="mt-4">
                        <span class="text-2xl font-black text-amber-600">{{ $monthlySummary->total_late }}</span>
                        <span class="text-[10px] text-slate-400 block mt-1">Hari Kerja</span>
                    </div>
                </div>

                <!-- Leaves -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/50 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Cuti / Izin</span>
                        <span class="p-2 rounded-xl bg-cyan-50 text-cyan-600 text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="mt-4">
                        <span class="text-2xl font-black text-slate-800">{{ $monthlySummary->total_leaves }}</span>
                        <span class="text-[10px] text-slate-400 block mt-1">Hari Cuti/Izin</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Timeline -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/50">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-2.5 h-6 bg-emerald-500 rounded-full"></div>
                <h3 class="text-lg font-extrabold text-slate-900">Aktivitas Presensi Terbaru</h3>
            </div>

            <div class="relative pl-6 border-l border-slate-200 space-y-8">
                @foreach ($recentAttendances as $att)
                    <div class="relative">
                        <!-- Bullet Dot -->
                        <div class="absolute -left-[32px] top-1.5 w-4 h-4 rounded-full border-4 border-white shadow-sm flex items-center justify-center {{ $att->status === 'Hadir' ? 'bg-emerald-500' : ($att->status === 'Terlambat' ? 'bg-amber-500' : 'bg-rose-500') }}">
                        </div>

                        <!-- Activity Card Content -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50 hover:bg-slate-100/70 p-5 rounded-2xl border border-slate-200/40 transition duration-150">
                            <div class="space-y-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-bold text-slate-800">
                                        {{ Carbon\Carbon::parse($att->check_in_time)->isoFormat('dddd, D MMMM YYYY') }}
                                    </span>
                                    <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-full {{ $att->status === 'Hadir' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ $att->status }}
                                    </span>
                                </div>
                                <div class="text-xs text-slate-500 flex flex-wrap items-center gap-x-4 gap-y-1 font-medium">
                                    <span>Shift: <strong class="text-slate-700">{{ $att->shift ? $att->shift->name : 'Standard' }}</strong></span>
                                    @if($att->check_in_lat)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            </svg>
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ $att->check_in_lat }},{{ $att->check_in_long }}" target="_blank" class="text-teal-600 hover:underline">Lokasi Check-in Map</a>
                                        </span>
                                    @endif
                                </div>
                                @if($att->check_in_address || $att->check_out_address)
                                    <div class="text-xxs text-slate-400 font-medium space-y-0.5 mt-1">
                                        @if($att->check_in_address)
                                            <span class="block leading-relaxed">
                                                <strong>Masuk:</strong> {{ $att->check_in_address }}
                                            </span>
                                        @endif
                                        @if($att->check_out_address)
                                            <span class="block leading-relaxed">
                                                <strong>Keluar:</strong> {{ $att->check_out_address }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                <div class="grid grid-cols-2 gap-4 pt-2">
                                    <div>
                                        <span class="block text-[9px] uppercase font-bold text-slate-400">Jam Masuk</span>
                                        <span class="text-sm font-extrabold text-slate-700">
                                            {{ Carbon\Carbon::parse($att->check_in_time)->format('H:i') }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="block text-[9px] uppercase font-bold text-slate-400">Jam Pulang</span>
                                        <span class="text-sm font-extrabold text-slate-700">
                                            {{ $att->check_out_time ? Carbon\Carbon::parse($att->check_out_time)->format('H:i') : '--:--' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Proof Photos Snapshots -->
                            <div class="flex items-center gap-3">
                                @if($att->check_in_photo)
                                    <div class="text-center">
                                        <span class="block text-[9px] font-bold text-slate-400 mb-1">Foto Masuk</span>
                                        <div class="relative group/photo overflow-hidden rounded-xl border border-slate-200 w-16 h-16 shadow-sm">
                                            <img src="{{ asset('storage/' . $att->check_in_photo) }}" alt="Check In Photo" class="w-full h-full object-cover transition duration-200 group-hover/photo:scale-125">
                                        </div>
                                    </div>
                                @endif
                                @if($att->check_out_photo)
                                    <div class="text-center">
                                        <span class="block text-[9px] font-bold text-slate-400 mb-1">Foto Keluar</span>
                                        <div class="relative group/photo overflow-hidden rounded-xl border border-slate-200 w-16 h-16 shadow-sm">
                                            <img src="{{ asset('storage/' . $att->check_out_photo) }}" alt="Check Out Photo" class="w-full h-full object-cover transition duration-200 group-hover/photo:scale-125">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                @if(count($recentAttendances) === 0)
                    <div class="text-center py-6 text-slate-400 text-sm font-medium">
                        Belum ada riwayat presensi tercatat.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Live Script logic -->
    <script>
        const video = document.getElementById('webcam');
        const canvas = document.getElementById('photo-canvas');
        const cameraFallback = document.getElementById('camera-fallback');
        const cameraErrorText = document.getElementById('camera-error-text');
        
        let webcamStream = null;
        let clockInterval = null;

        // Clock & smart greetings
        function updateClock() {
            const now = new Date();
            
            // Format time (HH:mm:ss)
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock-text').innerText = `${hours}:${minutes}:${seconds}`;

            // Format Date
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('date-text').innerText = now.toLocaleDateString('id-ID', options);

            // Greeting Logic
            const hour = now.getHours();
            let greeting = 'Selamat Pagi';
            if (hour >= 11 && hour < 15) {
                greeting = 'Selamat Siang';
            } else if (hour >= 15 && hour < 18) {
                greeting = 'Selamat Sore';
            } else if (hour >= 18 || hour < 4) {
                greeting = 'Selamat Malam';
            }
            document.getElementById('greeting-text').innerText = `${greeting}, {{ auth()->user()->name }}!`;
        }

        // Camera init
        async function initCamera() {
            try {
                webcamStream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'user',
                        width: { ideal: 640 },
                        height: { ideal: 480 }
                    }
                });
                if (video) {
                    video.srcObject = webcamStream;
                }
            } catch (err) {
                console.error('Webcam error:', err);
                if (cameraFallback) {
                    cameraFallback.classList.remove('hidden');
                }
                if (cameraErrorText) {
                    cameraErrorText.innerText = 'Akses kamera gagal. Silakan izinkan izin penggunaan kamera.';
                }
            }
        }

        // Geolocation tracking
        function initLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    async (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        
                        document.getElementById('lat-input').value = lat;
                        document.getElementById('lng-input').value = lng;
                        document.getElementById('lat-display').innerText = lat.toFixed(6);
                        document.getElementById('lng-display').innerText = lng.toFixed(6);

                        document.getElementById('gps-status-loading').classList.add('hidden');
                        document.getElementById('gps-coords-box').classList.remove('hidden');

                        // Enable action buttons if appropriate
                        const attendanceToday = @json($attendanceToday);
                        const shift = @json($shift);
                        
                        if (shift) {
                            if (!attendanceToday) {
                                document.getElementById('check-in-btn').disabled = false;
                            } else if (attendanceToday && !attendanceToday.check_out_time) {
                                document.getElementById('check-out-btn').disabled = false;
                            }
                        }

                        // Fetch reverse geocoded address details
                        fetchAddressDetails(lat, lng);
                    },
                    (error) => {
                        console.error('Location error:', error);
                        document.getElementById('gps-status-loading').classList.add('hidden');
                        document.getElementById('gps-status-error').classList.remove('hidden');
                        document.getElementById('gps-error-text').innerText = 'Akses lokasi gagal. Silakan aktifkan GPS dan izinkan lokasi.';
                    },
                    { enableHighAccuracy: true, timeout: 10000 }
                );
            } else {
                document.getElementById('gps-status-loading').classList.add('hidden');
                document.getElementById('gps-status-error').classList.remove('hidden');
                document.getElementById('gps-error-text').innerText = 'Geolocation tidak didukung oleh browser Anda.';
            }
        }

        // Reverse geocoding AJAX details fetch
        async function fetchAddressDetails(lat, lng) {
            try {
                const response = await fetch(`/attendance/reverse-geocode?latitude=${lat}&longitude=${lng}`);
                if (response.ok) {
                    const data = await response.json();
                    
                    document.getElementById('address-loading').classList.add('hidden');
                    document.getElementById('address-details').classList.remove('hidden');
                    
                    document.getElementById('display-name').innerText = data.display_name;
                    document.getElementById('road-val').innerText = data.road || '-';
                    document.getElementById('kel-val').innerText = data.kelurahan || '-';
                    document.getElementById('kec-val').innerText = data.kecamatan || '-';
                    document.getElementById('kota-val').innerText = data.kota || '-';
                    document.getElementById('prov-val').innerText = data.provinsi || '-';
                    document.getElementById('neg-val').innerText = data.negara || '-';
                } else {
                    document.getElementById('address-loading').innerText = 'Gagal memuat detail alamat dari server.';
                }
            } catch (err) {
                console.error('Geocoding fetch error:', err);
                document.getElementById('address-loading').innerText = 'Gagal menghubungi server untuk memuat detail alamat.';
            }
        }

        // Take photo & submit form
        function submitAttendance(type) {
            if (!video || !canvas) return;

            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth || 640;
            canvas.height = video.videoHeight || 480;
            
            // Capture snapshot
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataURL = canvas.toDataURL('image/jpeg', 0.85);
            
            // Assign values to inputs
            document.getElementById('photo-input').value = dataURL;
            const form = document.getElementById('attendance-form');
            
            if (type === 'check-in') {
                form.action = "{{ route('attendance.check-in') }}";
                document.getElementById('check-in-btn').disabled = true;
                document.getElementById('check-in-btn').innerHTML = 'MEMPROSES...';
            } else {
                form.action = "{{ route('attendance.check-out') }}";
                document.getElementById('check-out-btn').disabled = true;
                document.getElementById('check-out-btn').innerHTML = 'MEMPROSES...';
            }
            
            form.submit();
        }

        // Initialize clock, webcam & location on page mount
        window.addEventListener('DOMContentLoaded', () => {
            updateClock();
            clockInterval = setInterval(updateClock, 1000);
            initCamera();
            initLocation();
        });

        // Clean up stream on unload
        window.addEventListener('beforeunload', () => {
            if (clockInterval) {
                clearInterval(clockInterval);
            }
            if (webcamStream) {
                webcamStream.getTracks().forEach(track => track.stop());
            }
        });
    </script>
@endsection
