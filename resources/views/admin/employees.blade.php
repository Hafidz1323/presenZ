@extends('layouts.app')

@section('header')
    <span>Manajemen Karyawan</span>
@endsection

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between w-full gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">Manajemen Karyawan</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola data kepegawaian, jabatan, departemen, dan shift kerja karyawan Anda.</p>
            </div>
            <button 
                onclick="openModal('create-employee-modal')" 
                class="inline-flex items-center gap-1.5 self-start sm:self-center px-4 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-750 hover:to-indigo-750 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-violet-500/10 transition active:scale-[0.98]"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Karyawan
            </button>
        </div>

        <!-- Search Control -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/50 shadow-sm flex items-center justify-between">
            <div class="relative w-full max-w-md">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input 
                    id="search-query"
                    oninput="filterEmployees()"
                    type="text" 
                    placeholder="Cari NIP, nama, departemen, jabatan..." 
                    class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition"
                />
            </div>
            
            <div id="total-counter" class="text-xs font-semibold text-slate-400">
                Total: {{ count($users) }} Karyawan
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-3xl border border-slate-200/50 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs font-bold text-slate-700 uppercase bg-slate-50 border-b border-slate-200/40">
                        <tr>
                            <th scope="col" class="px-6 py-4">NIP</th>
                            <th scope="col" class="px-6 py-4">Karyawan</th>
                            <th scope="col" class="px-6 py-4">Departemen</th>
                            <th scope="col" class="px-6 py-4">Jabatan</th>
                            <th scope="col" class="px-6 py-4">Shift Kerja</th>
                        </tr>
                    </thead>
                    <tbody id="employees-tbody" class="divide-y divide-slate-100">
                        @foreach ($users as $u)
                            <tr class="employee-row hover:bg-slate-50/80 transition-colors">
                                <!-- NIP -->
                                <td class="px-6 py-4 whitespace-nowrap font-mono font-bold text-slate-800">
                                    {{ $u->nip }}
                                </td>

                                <!-- Avatar, Name, Email -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <img 
                                            src="https://ui-avatars.com/api/?name={{ urlencode($u->name) }}&background=8B5CF6&color=fff&bold=true" 
                                            alt="Employee Avatar" 
                                            class="w-9.5 h-9.5 rounded-xl border border-slate-200/60 shadow-sm"
                                        />
                                        <div>
                                            <span class="block font-bold text-slate-800 leading-tight">{{ $u->name }}</span>
                                            <span class="block text-xxs text-slate-400 mt-0.5 font-medium">{{ $u->email }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Department -->
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-700">
                                    {{ $u->department ? $u->department->name : '-' }}
                                </td>

                                <!-- Position -->
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-500">
                                    {{ $u->position ? $u->position->name : '-' }}
                                </td>

                                <!-- Shift -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($u->shifts && count($u->shifts))
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xxs font-bold bg-slate-50 border border-slate-200/80 text-slate-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-violet-500"></span>
                                            {{ $u->shifts[0]->name }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 font-medium text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr id="empty-row" class="hidden">
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400 font-semibold">
                                Tidak ada data karyawan terdaftar yang cocok.
                            </td>
                        </tr>
                        @if(count($users) === 0)
                            <tr id="default-empty-row">
                                <td colspan="5" class="px-6 py-8 text-center text-slate-400 font-semibold">
                                    Belum ada data karyawan terdaftar.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination Container -->
            @if($users->hasPages())
                <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-xs font-semibold text-slate-500">
                        Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} Karyawan
                    </div>
                    <div class="flex gap-1.5 flex-wrap">
                        {{ $users->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div id="create-employee-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/85 backdrop-blur-sm transition duration-300">
        <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border border-slate-200/60 relative animate-in fade-in zoom-in-95 duration-200">
            <!-- Modal Close -->
            <button 
                onclick="closeModal('create-employee-modal')"
                class="absolute top-5 right-5 z-20 p-2 bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 rounded-xl transition shadow-sm"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-black text-slate-900 leading-tight">Tambah Karyawan Baru</h3>
                <p class="text-xs text-slate-400 font-semibold mt-0.5">Lengkapi formulir di bawah untuk mendaftarkan akun karyawan baru.</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.employees.store') }}" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">NIP Karyawan</label>
                        <input type="text" name="nip" value="{{ old('nip') }}" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition font-medium" required>
                        @error('nip')
                            <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition font-medium" required>
                        @error('name')
                            <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition font-medium" required>
                        @error('email')
                            <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Password</label>
                        <input type="password" name="password" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition font-medium" required>
                        @error('password')
                            <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="h-px bg-slate-100 my-4"></div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Departemen</label>
                    <select name="department_id" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition text-slate-700 font-semibold" required>
                        <option value="" disabled selected>Pilih Departemen...</option>
                        @foreach ($departments as $d)
                            <option value="{{ $d->id }}" {{ old('department_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Jabatan (Position)</label>
                    <select name="position_id" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition text-slate-700 font-semibold" required>
                        <option value="" disabled selected>Pilih Jabatan...</option>
                        @foreach ($positions as $p)
                            <option value="{{ $p->id }}" {{ old('position_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                    @error('position_id')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Shift Kerja Utama</label>
                    <select name="shift_id" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 transition text-slate-700 font-semibold" required>
                        <option value="" disabled selected>Pilih Shift Kerja...</option>
                        @foreach ($shifts as $s)
                            <option value="{{ $s->id }}" {{ old('shift_id') == $s->id ? 'selected' : '' }}>{{ $s->name }} ({{ substr($s->start_time, 0,5) }} - {{ substr($s->end_time, 0,5) }})</option>
                        @endforeach
                    </select>
                    @error('shift_id')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Modal Actions -->
                <div class="flex justify-end gap-3 pt-6 border-t border-slate-100 mt-6">
                    <button 
                        type="button" 
                        onclick="closeModal('create-employee-modal')" 
                        class="px-4 py-2.5 border border-slate-200 hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xl transition"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-750 hover:to-indigo-750 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-violet-500/10 transition"
                    >
                        Simpan Karyawan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Client-side filter script -->
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function filterEmployees() {
            const query = document.getElementById('search-query').value.toLowerCase();
            const rows = document.querySelectorAll('#employees-tbody tr.employee-row');
            let count = 0;
            
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                    count++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            document.getElementById('total-counter').innerText = `Total: ${count} Karyawan`;
            
            const emptyRow = document.getElementById('empty-row');
            if (count === 0) {
                emptyRow.classList.remove('hidden');
            } else {
                emptyRow.classList.add('hidden');
            }
        }

        // Auto open create modal if validation fails
        @if ($errors->has('nip') || $errors->has('name') || $errors->has('email') || $errors->has('password') || $errors->has('department_id') || $errors->has('position_id') || $errors->has('shift_id'))
            window.addEventListener('DOMContentLoaded', () => {
                openModal('create-employee-modal');
            });
        @endif
    </script>
@endsection
