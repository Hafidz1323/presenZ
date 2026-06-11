@extends('layouts.app')

@section('header')
    <span>Laporan Kehadiran Karyawan</span>
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Advanced Filter Panel -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/50 shadow-sm">
            <form method="GET" action="{{ route('attendance.history') }}" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full md:w-auto flex-1">
                    <!-- Search input -->
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input 
                            name="search" 
                            type="text" 
                            value="{{ request('search') }}"
                            placeholder="Cari nama karyawan..." 
                            class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition"
                        />
                    </div>

                    <!-- Date Input -->
                    <div class="relative">
                        <input 
                            name="date" 
                            type="date" 
                            value="{{ request('date') }}"
                            class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition text-slate-600"
                        />
                    </div>

                    <!-- Status Dropdown -->
                    <div>
                        <select 
                            name="status" 
                            class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition text-slate-600"
                        >
                            <option value="">Semua Status</option>
                            <option value="Hadir" {{ request('status') === 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Terlambat" {{ request('status') === 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                            <option value="Sakit" {{ request('status') === 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Izin" {{ request('status') === 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Alpha" {{ request('status') === 'Alpha' ? 'selected' : '' }}>Alpha</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-2 w-full md:w-auto mt-4 md:mt-0">
                    <button type="submit" class="flex-1 md:flex-initial px-4 py-2 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-750 hover:to-indigo-750 text-white font-bold text-sm rounded-xl transition shadow-md shadow-violet-500/10">
                        Cari
                    </button>
                    @if(request('search') || request('date') || request('status'))
                        <a href="{{ route('attendance.history') }}" class="flex-1 md:flex-initial px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-800 font-semibold text-sm text-center rounded-xl transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-3xl border border-slate-200/50 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs font-bold text-slate-700 uppercase bg-slate-50 border-b border-slate-200/40">
                        <tr>
                            <th scope="col" class="px-6 py-4">Karyawan</th>
                            <th scope="col" class="px-6 py-4">Tanggal</th>
                            <th scope="col" class="px-6 py-4">Shift</th>
                            <th scope="col" class="px-6 py-4">Check In</th>
                            <th scope="col" class="px-6 py-4">Check Out</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4">Foto Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @php
                            $filtered = $attendances;
                            if (request('search')) {
                                $filtered = $filtered->filter(function($att) {
                                    return str_contains(strtolower($att->user->name), strtolower(request('search'))) || 
                                           str_contains(strtolower($att->user->nip), strtolower(request('search')));
                                });
                            }
                            if (request('date')) {
                                $filtered = $filtered->filter(function($att) {
                                    return Carbon\Carbon::parse($att->check_in_time)->toDateString() === request('date');
                                });
                            }
                            if (request('status')) {
                                $filtered = $filtered->filter(function($att) {
                                    return $att->status === request('status');
                                });
                            }
                        @endphp
                        @foreach ($filtered as $att)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <!-- Employee NIP & Name -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-violet-100 flex items-center justify-center text-violet-700 font-bold text-xs shadow-sm">
                                            @php
                                                $initials = '';
                                                if ($att->user && $att->user->name) {
                                                    $words = explode(' ', $att->user->name);
                                                    $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                                                }
                                            @endphp
                                            {{ $initials ?: 'KY' }}
                                        </div>
                                        <div>
                                            <span class="block font-bold text-slate-800 leading-tight">{{ $att->user ? $att->user->name : '-' }}</span>
                                            <span class="block text-xxs text-slate-400 font-semibold tracking-wider mt-0.5">{{ $att->user ? $att->user->nip : '-' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-700">
                                    {{ Carbon\Carbon::parse($att->check_in_time)->isoFormat('ddd, D MMM YYYY') }}
                                </td>

                                <!-- Shift -->
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-500">
                                    {{ $att->shift ? $att->shift->name : '-' }}
                                </td>

                                <!-- Check In Details -->
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800">{{ Carbon\Carbon::parse($att->check_in_time)->format('H:i') }}</span>
                                        @if($att->check_in_address)
                                            <span class="text-[10px] text-slate-500 mt-1 max-w-[220px] whitespace-normal leading-normal font-medium" title="{{ $att->check_in_address }}">
                                                {{ $att->check_in_address }}
                                            </span>
                                        @endif
                                        @if($att->check_in_lat)
                                            <div class="flex items-center gap-1 mt-1">
                                                <a 
                                                    href="https://www.openstreetmap.org/?mlat={{ $att->check_in_lat }}&mlon={{ $att->check_in_long }}#map=18/{{ $att->check_in_lat }}/{{ $att->check_in_long }}"
                                                    target="_blank"
                                                    class="inline-flex items-center gap-0.5 text-xxs text-violet-500 hover:text-violet-700 font-bold uppercase tracking-wider bg-violet-50 px-1.5 py-0.5 rounded transition"
                                                    title="Lihat peta GPS check-in"
                                                >
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    </svg>
                                                    PETA
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <!-- Check Out Details -->
                                <td class="px-6 py-4">
                                    @if($att->check_out_time)
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-800">{{ Carbon\Carbon::parse($att->check_out_time)->format('H:i') }}</span>
                                            @if($att->check_out_address)
                                                <span class="text-[10px] text-slate-500 mt-1 max-w-[220px] whitespace-normal leading-normal font-medium" title="{{ $att->check_out_address }}">
                                                    {{ $att->check_out_address }}
                                                </span>
                                            @endif
                                            @if($att->check_out_lat)
                                                <div class="flex items-center gap-1 mt-1">
                                                    <a 
                                                        href="https://www.openstreetmap.org/?mlat={{ $att->check_out_lat }}&mlon={{ $att->check_out_long }}#map=18/{{ $att->check_out_lat }}/{{ $att->check_out_long }}"
                                                        target="_blank"
                                                        class="inline-flex items-center gap-0.5 text-xxs text-violet-500 hover:text-violet-750 font-bold uppercase tracking-wider bg-violet-50 px-1.5 py-0.5 rounded transition"
                                                        title="Lihat peta GPS check-out"
                                                    >
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        </svg>
                                                        PETA
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-slate-400 font-medium">-</span>
                                    @endif
                                </td>

                                <!-- Status Badge -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span 
                                        class="px-2.5 py-1 text-xxs rounded-full font-black uppercase tracking-wider border {{ $att->status === 'Hadir' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}"
                                    >
                                        {{ $att->status }}
                                    </span>
                                </td>

                                <!-- Verification Photos -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <!-- Check in Thumbnail -->
                                        @if($att->check_in_photo)
                                            <div class="relative group cursor-pointer" onclick="openLightbox('{{ asset('storage/' . $att->check_in_photo) }}', 'Foto Check In', '{{ $att->user ? $att->user->name : 'Karyawan' }}', '{{ Carbon\Carbon::parse($att->check_in_time)->isoFormat('D MMMM YYYY, H:i') }}', '{{ $att->check_in_lat }}', '{{ $att->check_in_long }}', '{{ $att->check_in_address }}')">
                                                <img 
                                                    src="{{ asset('storage/' . $att->check_in_photo) }}" 
                                                    alt="In photo" 
                                                    class="w-10 h-10 rounded-xl object-cover border border-slate-200 hover:ring-2 hover:ring-violet-500 transition shadow-sm"
                                                />
                                                <span class="absolute -bottom-1 -right-1 bg-violet-600 text-white text-[8px] font-black px-1.5 py-0.5 rounded-md leading-none shadow">IN</span>
                                            </div>
                                        @endif
                                        
                                        <!-- Check out Thumbnail -->
                                        @if($att->check_out_photo)
                                            <div class="relative group cursor-pointer" onclick="openLightbox('{{ asset('storage/' . $att->check_out_photo) }}', 'Foto Check Out', '{{ $att->user ? $att->user->name : 'Karyawan' }}', '{{ Carbon\Carbon::parse($att->check_out_time)->isoFormat('D MMMM YYYY, H:i') }}', '{{ $att->check_out_lat }}', '{{ $att->check_out_long }}', '{{ $att->check_out_address }}')">
                                                <img 
                                                    src="{{ asset('storage/' . $att->check_out_photo) }}" 
                                                    alt="Out photo" 
                                                    class="w-10 h-10 rounded-xl object-cover border border-slate-200 hover:ring-2 hover:ring-violet-500 transition shadow-sm"
                                                />
                                                <span class="absolute -bottom-1 -right-1 bg-indigo-600 text-white text-[8px] font-black px-1.5 py-0.5 rounded-md leading-none shadow">OUT</span>
                                            </div>
                                        @endif

                                        @if(!$att->check_in_photo && !$att->check_out_photo)
                                            <span class="text-slate-400 font-medium text-xs">Tidak ada foto</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if(count($filtered) === 0)
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-slate-400 font-semibold">
                                    Tidak ada data riwayat absensi yang cocok dengan filter.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination Container -->
            @if($attendances->hasPages() && !request('search') && !request('date') && !request('status'))
                <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-xs font-semibold text-slate-500">
                        Menampilkan {{ $attendances->firstItem() ?? 0 }} sampai {{ $attendances->lastItem() ?? 0 }} dari {{ $attendances->total() }} Absensi
                    </div>
                    <div class="flex gap-1.5 flex-wrap">
                        {{ $attendances->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Photo Lightbox Modal with Backdrop Blur -->
    <div id="lightbox-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/85 backdrop-blur-sm transition duration-300 animate-in fade-in">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl border border-slate-200/60 relative animate-in fade-in zoom-in-95 duration-200">
            <!-- Modal Close -->
            <button 
                onclick="closeLightbox()"
                class="absolute top-4 right-4 z-20 p-2 bg-slate-900/65 text-white hover:bg-slate-950 rounded-full transition shadow-md"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Photo Preview -->
            <div class="relative aspect-square w-full bg-slate-950">
                <img id="modal-img" src="" alt="Absensi Preview" class="w-full h-full object-cover">
                <!-- Overlay Badge for Photo Type -->
                <div id="modal-title" class="absolute bottom-4 left-4 bg-gradient-to-r from-violet-600 to-indigo-600 text-white px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider shadow border border-white/10">
                    Foto Absensi
                </div>
            </div>

            <!-- Modal Info Details -->
            <div class="p-6">
                <h3 class="text-lg font-black text-slate-900 leading-snug" id="modal-employee-name">Nama Karyawan</h3>
                <p class="text-xs text-slate-500 font-medium mt-1">Absensi tercatat pada: <span class="font-semibold text-slate-800" id="modal-time">-</span></p>
                
                <!-- GPS Coordinates inside Modal -->
                <div id="modal-gps-details" class="mt-4 pt-4 border-t border-slate-100 space-y-3">
                    <div id="modal-address-container">
                        <span class="block text-slate-400 font-bold uppercase tracking-wider text-[9px]">Lokasi Detail</span>
                        <span class="text-xs font-semibold text-slate-700 leading-normal block mt-0.5" id="modal-address">-</span>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <span class="block text-slate-400 font-bold uppercase tracking-wider text-[9px]">Koordinat Terdeteksi</span>
                            <span class="font-mono text-[10px] font-bold text-slate-500 leading-none mt-0.5 block" id="modal-coords">Lat: -, Long: -</span>
                        </div>
                        <a 
                            id="modal-map-link"
                            href="#" 
                            target="_blank"
                            class="px-3.5 py-2 bg-slate-100 hover:bg-violet-50 text-slate-700 hover:text-violet-700 border border-slate-200 hover:border-violet-200 font-bold text-xs rounded-xl flex items-center gap-1.5 transition flex-shrink-0"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A2 2 0 013 15.382V6m18 14l-5.447-2.724a2 2 0 00-1.106 0L9 20M3 6l5.447 2.724m0 0a2 2 0 001.106 0L15 6m0 0l5.447 2.724a2 2 0 011 1.776V15.38"></path>
                            </svg>
                            Tampilkan Peta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox Script -->
    <script>
        function openLightbox(url, title, employeeName, time, lat, lng, address) {
            document.getElementById('modal-img').src = url;
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-employee-name').innerText = employeeName;
            document.getElementById('modal-time').innerText = time;
            
            if (lat && lng) {
                document.getElementById('modal-gps-details').classList.remove('hidden');
                document.getElementById('modal-coords').innerText = `Lat: ${parseFloat(lat).toFixed(6)}, Long: ${parseFloat(lng).toFixed(6)}`;
                document.getElementById('modal-map-link').href = `https://www.openstreetmap.org/?mlat=${lat}&mlon=${lng}#map=18/${lat}/${lng}`;
                
                if (address) {
                    document.getElementById('modal-address-container').classList.remove('hidden');
                    document.getElementById('modal-address').innerText = address;
                } else {
                    document.getElementById('modal-address-container').classList.add('hidden');
                }
            } else {
                document.getElementById('modal-gps-details').classList.add('hidden');
            }

            document.getElementById('lightbox-modal').classList.remove('hidden');
        }

        function closeLightbox() {
            document.getElementById('lightbox-modal').classList.add('hidden');
        }

        // Close on ESC
        window.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
@endsection
