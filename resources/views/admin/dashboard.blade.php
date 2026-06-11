@extends('layouts.app')

@section('header')
    <span>Dashboard Admin & HR</span>
@endsection

@section('content')
    <div class="space-y-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/50 shadow-sm hover:shadow-md transition relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-20 h-20 bg-blue-500/5 rounded-bl-full group-hover:scale-110 transition-transform"></div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Karyawan</span>
                    <span class="p-2 rounded-xl bg-blue-50 text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-2 text-3xl font-black text-slate-800">{{ $stats->total_karyawan }}</div>
                <span class="text-[10px] text-slate-400 font-semibold block mt-1">Terdaftar Aktif</span>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/50 shadow-sm hover:shadow-md transition relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-20 h-20 bg-emerald-500/5 rounded-bl-full group-hover:scale-110 transition-transform"></div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Hadir Hari Ini</span>
                    <span class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-2 text-3xl font-black text-emerald-600">{{ $stats->total_hadir_today }}</div>
                <span class="text-[10px] text-slate-400 font-semibold block mt-1">Sudah Check-in</span>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/50 shadow-sm hover:shadow-md transition relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-20 h-20 bg-rose-500/5 rounded-bl-full group-hover:scale-110 transition-transform"></div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Alpha / Belum Hadir</span>
                    <span class="p-2 rounded-xl bg-rose-50 text-rose-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-2 text-3xl font-black text-rose-600">{{ $stats->total_alpha_today }}</div>
                <span class="text-[10px] text-slate-400 font-semibold block mt-1">Belum Absen</span>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/50 shadow-sm hover:shadow-md transition relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-20 h-20 bg-amber-500/5 rounded-bl-full group-hover:scale-110 transition-transform"></div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Pengajuan Pending</span>
                    <span class="p-2 rounded-xl bg-amber-50 text-amber-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-2 text-3xl font-black text-amber-600">{{ $stats->total_pending_leaves }}</div>
                <span class="text-[10px] text-slate-400 font-semibold block mt-1">Butuh Approval</span>
            </div>
        </div>

        <!-- 7-Day Attendance Chart -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/50 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-2.5 h-6 bg-teal-500 rounded-full"></div>
                <h3 class="text-lg font-extrabold text-slate-900">Grafik Kehadiran (7 Hari Terakhir)</h3>
            </div>
            <div class="h-[280px] w-full relative">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>

        <!-- Recent Activity & Quick Links -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Table -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-200/50 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-2.5 h-6 bg-emerald-500 rounded-full"></div>
                    <h3 class="text-lg font-extrabold text-slate-900">Absensi Terbaru Hari Ini</h3>
                </div>
                
                <div class="overflow-x-auto rounded-2xl border border-slate-100">
                    <table class="w-full text-sm text-left text-slate-600">
                        <thead class="text-xs font-bold text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th scope="col" class="px-6 py-4">Nama</th>
                                <th scope="col" class="px-6 py-4">Waktu Check In</th>
                                <th scope="col" class="px-6 py-4">Shift</th>
                                <th scope="col" class="px-6 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($recentAttendances as $att)
                                <tr class="bg-white hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-bold text-slate-800">{{ $att->user ? $att->user->name : '-' }}</td>
                                    <td class="px-6 py-4 font-medium text-slate-500">{{ Carbon\Carbon::parse($att->check_in_time)->format('H:i') }}</td>
                                    <td class="px-6 py-4 font-medium text-slate-500">{{ $att->shift ? $att->shift->name : '-' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-0.5 bg-emerald-50 border border-emerald-100 text-emerald-600 text-[10px] font-black uppercase tracking-wider rounded-full">
                                            {{ $att->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            @if(count($recentAttendances) === 0)
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-400 font-medium">Belum ada data absensi hari ini.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 pt-2">
                    <a href="{{ route('attendance.history') }}" class="text-sm font-bold text-teal-600 hover:text-teal-700 transition inline-flex items-center gap-1">
                        Lihat Semua Absensi &rarr;
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/50 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2.5 h-6 bg-amber-500 rounded-full"></div>
                        <h3 class="text-lg font-extrabold text-slate-900">Menu Navigasi Cepat</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <a href="{{ route('admin.employees') }}" class="flex items-center justify-between w-full px-5 py-4 rounded-2xl text-white font-extrabold text-sm tracking-wide bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 transition duration-150 shadow-md shadow-teal-500/10 active:scale-[0.99]">
                            <span>Kelola Karyawan</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        
                        <a href="{{ route('admin.master-data') }}" class="flex items-center justify-between w-full px-5 py-4 border border-slate-200 hover:border-slate-300 rounded-2xl text-slate-700 font-bold text-sm tracking-wide bg-white hover:bg-slate-50 transition duration-150 active:scale-[0.99]">
                            <span>Kelola Master Data</span>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        
                        <a href="{{ route('leaves.index') }}" class="flex items-center justify-between w-full px-5 py-4 border border-slate-200 hover:border-slate-300 rounded-2xl text-slate-700 font-bold text-sm tracking-wide bg-white hover:bg-slate-50 transition duration-150 relative active:scale-[0.99]">
                            <span class="flex items-center gap-2">
                                Approval Pengajuan
                                @if($stats->total_pending_leaves > 0)
                                    <span class="px-2 py-0.5 bg-rose-500 text-white text-[10px] font-black rounded-full shadow-sm">{{ $stats->total_pending_leaves }}</span>
                                @endif
                            </span>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-slate-100 text-center text-xs text-slate-400 font-medium">
                    PresenZ v1.0.0 &bull; Sistem Presensi Karyawan
                </div>
            </div>
        </div>
    </div>

    <!-- Chart JS CDN & Setup -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            
            const rawChartData = @json($chartData);
            
            if (rawChartData && rawChartData.labels) {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: rawChartData.labels,
                        datasets: [{
                            label: rawChartData.datasets[0].label,
                            data: rawChartData.datasets[0].data,
                            backgroundColor: '#0EA5E9',
                            borderColor: '#0284C7',
                            borderWidth: 1,
                            borderRadius: 12,
                            borderSkipped: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.9)',
                                titleFont: { size: 12, weight: 'bold' },
                                bodyFont: { size: 12 },
                                padding: 12,
                                cornerRadius: 12
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        weight: '600',
                                        family: 'Figtree'
                                    },
                                    color: '#94A3B8'
                                }
                            },
                            y: {
                                grid: {
                                    color: '#F1F5F9'
                                },
                                ticks: {
                                    font: {
                                        weight: '600',
                                        family: 'Figtree'
                                    },
                                    color: '#94A3B8',
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
