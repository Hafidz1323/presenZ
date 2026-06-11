@extends('layouts.app')

@section('header')
    <span>Approval Cuti, Izin & Sakit</span>
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Filter Bar -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/50 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
            <form id="filter-form" method="GET" action="{{ route('leaves.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full md:w-auto flex-1">
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
                        placeholder="Cari nama atau alasan..." 
                        class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition"
                    />
                </div>

                <!-- Type Filter -->
                <div>
                    <select 
                        name="type" 
                        onchange="document.getElementById('filter-form').submit()"
                        class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition text-slate-600 font-semibold"
                    >
                        <option value="">Semua Tipe Pengajuan</option>
                        <option value="Cuti" {{ request('type') === 'Cuti' ? 'selected' : '' }}>Cuti Kerja</option>
                        <option value="Izin" {{ request('type') === 'Izin' ? 'selected' : '' }}>Izin Khusus</option>
                        <option value="Sakit" {{ request('type') === 'Sakit' ? 'selected' : '' }}>Sakit</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <select 
                        name="status" 
                        onchange="document.getElementById('filter-form').submit()"
                        class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition text-slate-600 font-semibold"
                    >
                        <option value="">Semua Status</option>
                        <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                        <option value="Approved" {{ request('status') === 'Approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
            </form>

            @if(request('search') || request('type') || request('status'))
                <a 
                    href="{{ route('leaves.index') }}"
                    class="w-full md:w-auto px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-800 font-semibold text-sm text-center rounded-xl transition"
                >
                    Reset Filter
                </a>
            @endif
        </div>

        <!-- Leaves Table -->
        <div class="bg-white rounded-3xl border border-slate-200/50 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs font-bold text-slate-700 uppercase bg-slate-50 border-b border-slate-200/40">
                        <tr>
                            <th scope="col" class="px-6 py-4">Karyawan</th>
                            <th scope="col" class="px-6 py-4">Jenis</th>
                            <th scope="col" class="px-6 py-4">Periode</th>
                            <th scope="col" class="px-6 py-4">Alasan</th>
                            <th scope="col" class="px-6 py-4">Lampiran</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4">Aksi / Verifikator</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @php
                            $filtered = $leaves;
                            if (request('search')) {
                                $filtered = $filtered->filter(function($l) {
                                    return str_contains(strtolower($l->user->name), strtolower(request('search'))) || 
                                           str_contains(strtolower($l->reason), strtolower(request('search')));
                                });
                            }
                            if (request('type')) {
                                $filtered = $filtered->filter(function($l) {
                                    return $l->leave_type === request('type');
                                });
                            }
                            if (request('status')) {
                                $filtered = $filtered->filter(function($l) {
                                    return $l->status === request('status');
                                });
                            }
                        @endphp
                        @foreach ($filtered as $leave)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <!-- User -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-violet-100 flex items-center justify-center text-violet-700 font-bold text-xs shadow-sm">
                                            @php
                                                $initials = '';
                                                if ($leave->user && $leave->user->name) {
                                                    $words = explode(' ', $leave->user->name);
                                                    $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                                                }
                                            @endphp
                                            {{ $initials ?: 'KY' }}
                                        </div>
                                        <div>
                                            <span class="block font-bold text-slate-800 leading-tight">{{ $leave->user ? $leave->user->name : '-' }}</span>
                                            <span class="block text-xxs text-slate-400 font-semibold mt-0.5">Karyawan</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Leave Type -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span 
                                        class="px-2.5 py-1 rounded-full text-xxs font-black uppercase tracking-wider border {{ $leave->leave_type === 'Cuti' ? 'bg-violet-50 text-violet-700 border border-violet-100' : ($leave->leave_type === 'Izin' ? 'bg-amber-50 text-amber-700 border border-amber-100' : 'bg-rose-50 text-rose-700 border border-rose-100') }}"
                                    >
                                        {{ $leave->leave_type }}
                                    </span>
                                </td>

                                <!-- Dates -->
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-700">
                                    <div class="flex flex-col text-xs font-bold leading-tight">
                                        <span>{{ Carbon\Carbon::parse($leave->start_date)->isoFormat('D MMM YYYY') }}</span>
                                        <span class="text-slate-400 font-medium text-[10px] mt-0.5">s/d {{ Carbon\Carbon::parse($leave->end_date)->isoFormat('D MMM YYYY') }}</span>
                                    </div>
                                </td>

                                <!-- Reason -->
                                <td class="px-6 py-4 font-semibold text-slate-700 max-w-xs truncate" title="{{ $leave->reason }}">
                                    {{ $leave->reason }}
                                </td>

                                <!-- Attachment View Document button -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($leave->attachment)
                                        <button 
                                            onclick="openAttachment('{{ asset('storage/' . $leave->attachment) }}', '{{ $leave->user ? $leave->user->name : 'Karyawan' }}', '{{ $leave->leave_type }}', '{{ $leave->reason }}')"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-violet-600 hover:text-white bg-violet-50 hover:bg-violet-600 border border-violet-100 rounded-xl transition duration-150 shadow-sm"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                            </svg>
                                            Lihat Surat
                                        </button>
                                    @else
                                        <span class="text-slate-400 font-medium text-xs">Tanpa lampiran</span>
                                    @endif
                                </td>

                                <!-- Status Badge -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span 
                                        class="px-2.5 py-1 text-xxs rounded-full font-black uppercase tracking-wider border {{ $leave->status === 'Pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-250' : ($leave->status === 'Approved' ? 'bg-emerald-50 text-emerald-700 border-emerald-250' : 'bg-rose-50 text-rose-700 border-rose-250') }}"
                                    >
                                        {{ $leave->status }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($leave->status === 'Pending')
                                        <div class="flex gap-2">
                                            <form method="POST" action="{{ route('leaves.approve', $leave->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="Approved">
                                                <button 
                                                    type="submit" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui pengajuan ini?')"
                                                    class="text-xxs px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold rounded-xl transition shadow-md shadow-emerald-500/10 active:scale-[0.98]"
                                                >
                                                    Setujui
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('leaves.approve', $leave->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="Rejected">
                                                <button 
                                                    type="submit" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?')"
                                                    class="text-xxs px-3 py-1.5 bg-rose-500 hover:bg-rose-600 text-white font-extrabold rounded-xl transition shadow-md shadow-rose-500/10 active:scale-[0.98]"
                                                >
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="flex flex-col text-slate-400 text-xs font-semibold">
                                            <span class="text-xxs text-slate-400 leading-none">Diverifikasi oleh:</span>
                                            <span class="text-slate-700 mt-1 font-bold">{{ $leave->approver ? $leave->approver->name : 'Sistem' }}</span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if(count($filtered) === 0)
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-slate-400 font-semibold">
                                    Tidak ada data pengajuan yang cocok dengan filter.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($leaves->hasPages() && !request('search') && !request('type') && !request('status'))
                <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-xs font-semibold text-slate-500">
                        Menampilkan {{ $leaves->firstItem() ?? 0 }} sampai {{ $leaves->lastItem() ?? 0 }} dari {{ $leaves->total() }} Pengajuan
                    </div>
                    <div class="flex gap-1.5 flex-wrap">
                        {{ $leaves->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Attachment Lightbox Modal -->
    <div id="attachment-lightbox" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/85 backdrop-blur-sm transition duration-300 animate-in fade-in">
        <div class="bg-white rounded-3xl max-w-xl w-full overflow-hidden shadow-2xl border border-slate-200/60 relative animate-in fade-in zoom-in-95 duration-200">
            <!-- Modal Close -->
            <button 
                onclick="closeAttachmentLightbox()"
                class="absolute top-4 right-4 z-20 p-2 bg-slate-900/65 text-white hover:bg-slate-950 rounded-full transition shadow-md"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Header Info -->
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <span id="light-label" class="text-xxs font-black text-violet-600 uppercase tracking-widest">Document</span>
                <h3 class="text-lg font-black text-slate-900 leading-tight mt-0.5" id="light-employee-name">Surat Keterangan Karyawan</h3>
                <p class="text-xs text-slate-500 font-medium mt-1">Alasan: <span class="text-slate-800 font-semibold" id="light-reason">"-"</span></p>
            </div>

            <!-- Document Body -->
            <div class="p-6 bg-slate-950 flex items-center justify-center min-h-[300px] max-h-[50vh] overflow-y-auto">
                <img 
                    id="light-img"
                    src="" 
                    alt="Surat Keterangan Izin" 
                    class="max-w-full max-h-full object-contain rounded-lg hidden"
                />
                
                <div id="light-pdf" class="text-center text-white py-12 space-y-4 w-full hidden">
                    <div class="p-4 bg-slate-900 text-slate-400 rounded-full inline-block">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-sm">Dokumen Format PDF / File Lainnya</h4>
                    <p class="text-xs text-slate-400 max-w-xs mx-auto">Dokumen ini bertipe PDF. Klik tombol di bawah untuk mengunduh atau melihat dokumen secara penuh.</p>
                    
                    <a 
                        id="light-pdf-btn"
                        href="#" 
                        target="_blank"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-violet-600 hover:bg-violet-750 text-white font-extrabold text-xs rounded-xl shadow-lg transition"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        BUKA FILE DOKUMEN
                    </a>
                </div>
            </div>

            <!-- Footer Action Buttons -->
            <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                <a 
                    id="light-new-tab"
                    href="#" 
                    target="_blank"
                    class="px-4 py-2 border border-slate-200 hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xl inline-flex items-center gap-1.5 transition"
                >
                    Buka di Tab Baru
                </a>
                <button 
                    onclick="closeAttachmentLightbox()"
                    class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs rounded-xl transition"
                >
                    Tutup Pratinjau
                </button>
            </div>
        </div>
    </div>

    <!-- Modal trigger scripts -->
    <script>
        function openAttachment(url, employeeName, type, reason) {
            const isImage = /\.(jpeg|jpg|png|webp|gif)$/i.test(url);
            
            document.getElementById('light-label').innerText = `${type} Certificate`;
            document.getElementById('light-employee-name').innerText = `Surat Keterangan: ${employeeName}`;
            document.getElementById('light-reason').innerText = `"${reason}"`;
            document.getElementById('light-new-tab').href = url;
            
            const lightImg = document.getElementById('light-img');
            const lightPdf = document.getElementById('light-pdf');
            
            if (isImage) {
                lightImg.src = url;
                lightImg.classList.remove('hidden');
                lightPdf.classList.add('hidden');
            } else {
                lightImg.classList.add('hidden');
                lightPdf.classList.remove('hidden');
                document.getElementById('light-pdf-btn').href = url;
            }

            document.getElementById('attachment-lightbox').classList.remove('hidden');
        }

        function closeAttachmentLightbox() {
            document.getElementById('attachment-lightbox').classList.add('hidden');
        }

        // Close on ESC
        window.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAttachmentLightbox();
            }
        });
    </script>
@endsection
