@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="bg-white rounded-3xl border border-slate-200/50 shadow-sm p-6 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">Pengajuan Cuti & Izin</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola dan ajukan permohonan cuti, izin khusus, atau dispensasi sakit Anda.</p>
            </div>
            <button 
                onclick="openModal('create-leave-modal')" 
                class="inline-flex items-center gap-1.5 self-start sm:self-center px-4 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-750 hover:to-indigo-750 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-violet-500/10 transition active:scale-[0.98]"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Pengajuan
            </button>
        </div>

        <!-- Table List of Leaves -->
        <div class="bg-white rounded-3xl border border-slate-200/50 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs font-bold text-slate-700 uppercase bg-slate-50 border-b border-slate-200/40">
                        <tr>
                            <th scope="col" class="px-6 py-4">Jenis Pengajuan</th>
                            <th scope="col" class="px-6 py-4">Mulai Tanggal</th>
                            <th scope="col" class="px-6 py-4">Selesai Tanggal</th>
                            <th scope="col" class="px-6 py-4">Alasan / Keterangan</th>
                            <th scope="col" class="px-6 py-4">Lampiran Dokumen</th>
                            <th scope="col" class="px-6 py-4">Status Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($leaves as $leave)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <!-- Type -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span 
                                        class="px-2.5 py-1 rounded-full text-xxs font-black uppercase tracking-wider border {{ $leave->leave_type === 'Cuti' ? 'bg-violet-50 text-violet-700 border-violet-200' : ($leave->leave_type === 'Izin' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-rose-50 text-rose-700 border-rose-200') }}"
                                    >
                                        {{ $leave->leave_type }}
                                    </span>
                                </td>

                                <!-- Start date -->
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-slate-800">
                                    {{ Carbon\Carbon::parse($leave->start_date)->isoFormat('ddd, D MMM YYYY') }}
                                </td>

                                <!-- End date -->
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-slate-800">
                                    {{ Carbon\Carbon::parse($leave->end_date)->isoFormat('ddd, D MMM YYYY') }}
                                </td>

                                <!-- Reason -->
                                <td class="px-6 py-4 font-semibold text-slate-600 max-w-xs truncate" title="{{ $leave->reason }}">
                                    {{ $leave->reason }}
                                </td>

                                <!-- Attachment Document -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($leave->attachment)
                                        <button 
                                            onclick="openAttachment('{{ asset('storage/' . $leave->attachment) }}', '{{ $leave->leave_type }}', '{{ $leave->reason }}')"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-violet-600 hover:text-white bg-violet-50 hover:bg-violet-600 border border-violet-100 rounded-xl transition duration-150 shadow-sm"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                            </svg>
                                            Lihat File
                                        </button>
                                    @else
                                        <span class="text-slate-400 font-medium text-xs">Tidak ada lampiran</span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span 
                                        class="px-2.5 py-1 text-xxs rounded-full font-black uppercase tracking-wider border {{ $leave->status === 'Pending' ? 'bg-yellow-50 text-yellow-800 border-yellow-250' : ($leave->status === 'Approved' ? 'bg-emerald-50 text-emerald-700 border-emerald-250' : 'bg-rose-50 text-rose-700 border-rose-250') }}"
                                    >
                                        {{ $leave->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        @if(count($leaves) === 0)
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-400 font-semibold">
                                    Belum ada data pengajuan izin atau cuti Anda.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination (If any) -->
            @if($leaves->hasPages())
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

    <!-- Add Leave Application Form Modal -->
    <div id="create-leave-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/85 backdrop-blur-sm transition duration-300">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl border border-slate-200/60 relative animate-in fade-in zoom-in-95 duration-200">
            <!-- Close Button -->
            <button 
                onclick="closeModal('create-leave-modal')"
                class="absolute top-5 right-5 z-20 p-2 bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 rounded-xl transition shadow-sm"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-black text-slate-900 leading-tight">Buat Pengajuan Baru</h3>
                <p class="text-xs text-slate-400 font-semibold mt-0.5">Silakan pilih jenis pengajuan dan isi tanggal serta alasan secara jelas.</p>
            </div>

            <!-- Form content -->
            <form method="POST" action="{{ route('leaves.store') }}" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Jenis Pengajuan</label>
                    <select name="leave_type" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition text-slate-700 font-semibold">
                        <option value="Cuti" {{ old('leave_type') === 'Cuti' ? 'selected' : '' }}>Cuti Kerja</option>
                        <option value="Izin" {{ old('leave_type') === 'Izin' ? 'selected' : '' }}>Izin Khusus / Dispensasi</option>
                        <option value="Sakit" {{ old('leave_type') === 'Sakit' ? 'selected' : '' }}>Surat Sakit Dokter</option>
                    </select>
                    @error('leave_type')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition font-medium" required>
                        @error('start_date')
                            <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition font-medium" required>
                        @error('end_date')
                            <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alasan / Keterangan Lengkap</label>
                    <textarea name="reason" rows="3" placeholder="Tuliskan keterangan detail pengajuan Anda di sini..." class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition font-medium" required>{{ old('reason') }}</textarea>
                    @error('reason')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Attachment -->
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Unggah Lampiran (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50/50 hover:bg-slate-50 transition duration-150">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-10 w-10 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-xs text-slate-600 justify-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-bold text-violet-600 hover:text-violet-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-violet-500">
                                    <span>Unggah berkas</span>
                                    <input type="file" name="attachment" id="file-input" onchange="fileSelected(this)" class="sr-only">
                                </label>
                                <p class="pl-1">atau seret dan taruh</p>
                            </div>
                            <p class="text-[10px] text-slate-400 font-semibold uppercase">PDF, PNG, JPG, JPEG (Max 2MB)</p>
                        </div>
                    </div>
                    <div id="file-display" class="hidden mt-2 text-xs font-bold text-emerald-600 flex items-center gap-1">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span id="file-name-span">Berkas terpilih</span>
                    </div>
                    @error('attachment')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Modal Actions -->
                <div class="flex justify-end gap-3 pt-6 border-t border-slate-100 mt-6">
                    <button 
                        type="button" 
                        onclick="closeModal('create-leave-modal')" 
                        class="px-4 py-2.5 border border-slate-200 hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xl transition"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-750 hover:to-indigo-750 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-violet-500/10 transition"
                    >
                        Simpan & Ajukan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Attachment Lightbox Modal -->
    <div id="attachment-lightbox" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/85 backdrop-blur-sm transition duration-300">
        <div class="bg-white rounded-3xl max-w-xl w-full overflow-hidden shadow-2xl border border-slate-200/60 relative animate-in fade-in zoom-in-95 duration-200">
            <!-- Close Button -->
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
                <h3 class="text-lg font-black text-slate-900 leading-tight mt-0.5">Berkas Pengajuan Cuti / Izin Anda</h3>
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
                    <p class="text-xs text-slate-400 max-w-xs mx-auto">Dokumen pengajuan Anda bertipe PDF. Klik tombol di bawah untuk membukanya secara penuh.</p>
                    
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
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function fileSelected(input) {
            const fileDisplay = document.getElementById('file-display');
            const fileNameSpan = document.getElementById('file-name-span');
            
            if (input.files && input.files.length) {
                fileDisplay.classList.remove('hidden');
                fileNameSpan.innerText = `Berkas terpilih: ${input.files[0].name}`;
            } else {
                fileDisplay.classList.add('hidden');
            }
        }

        function openAttachment(url, type, reason) {
            const isImage = /\.(jpeg|jpg|png|webp|gif)$/i.test(url);
            
            document.getElementById('light-label').innerText = `${type} Document`;
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

        // Auto open creation modal if validation fails
        @if ($errors->has('leave_type') || $errors->has('start_date') || $errors->has('end_date') || $errors->has('reason') || $errors->has('attachment'))
            window.addEventListener('DOMContentLoaded', () => {
                openModal('create-leave-modal');
            });
        @endif
    </script>
@endsection
