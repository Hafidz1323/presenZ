@extends('layouts.guest')

@section('content')
    <h2 class="text-xl font-black text-slate-800 text-center mb-1">Pendaftaran Mandiri</h2>
    <p class="text-xs text-slate-400 text-center mb-6">Daftarkan akun karyawan Anda ke dalam sistem presensi.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Grid for Name & NIP -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus 
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('name') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
                >
                @error('name')
                    <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nip" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">NIP Karyawan</label>
                <input 
                    id="nip" 
                    type="text" 
                    name="nip" 
                    value="{{ old('nip') }}" 
                    required 
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('nip') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
                >
                @error('nip')
                    <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Grid for Email & Phone -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Email</label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('email') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
                >
                @error('email')
                    <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">No. Telepon (Opsional)</label>
                <input 
                    id="phone" 
                    type="text" 
                    name="phone" 
                    value="{{ old('phone') }}" 
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('phone') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
                >
                @error('phone')
                    <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="h-px bg-slate-100/60 my-2"></div>

        <!-- Department -->
        <div>
            <label for="department_id" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Departemen</label>
            <select 
                id="department_id" 
                name="department_id" 
                required 
                class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('department_id') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition text-slate-700 font-semibold"
            >
                <option value="" disabled selected>Pilih Departemen...</option>
                @foreach($departments as $d)
                    <option value="{{ $d->id }}" {{ old('department_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
            @error('department_id')
                <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Position -->
        <div>
            <label for="position_id" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Jabatan (Position)</label>
            <select 
                id="position_id" 
                name="position_id" 
                required 
                class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('position_id') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition text-slate-700 font-semibold"
            >
                <option value="" disabled selected>Pilih Jabatan...</option>
                @foreach($positions as $p)
                    <option value="{{ $p->id }}" {{ old('position_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                @endforeach
            </select>
            @error('position_id')
                <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Shift -->
        <div>
            <label for="shift_id" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Shift Kerja Utama</label>
            <select 
                id="shift_id" 
                name="shift_id" 
                required 
                class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('shift_id') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition text-slate-700 font-semibold"
            >
                <option value="" disabled selected>Pilih Shift Kerja...</option>
                @foreach($shifts as $s)
                    <option value="{{ $s->id }}" {{ old('shift_id') == $s->id ? 'selected' : '' }}>{{ $s->name }} ({{ substr($s->start_time, 0, 5) }} - {{ substr($s->end_time, 0, 5) }})</option>
                @endforeach
            </select>
            @error('shift_id')
                <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="h-px bg-slate-100/60 my-2"></div>

        <!-- Password & Confirm Password -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kata Sandi</label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="new-password"
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('password') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
                >
                @error('password')
                    <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Konfirmasi Sandi</label>
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 rounded-2xl focus:outline-none focus:ring-2 transition"
                >
            </div>
        </div>

        <!-- Submit -->
        <div class="mt-6 space-y-4">
            <button type="submit" class="w-full py-3 px-6 rounded-2xl text-white font-extrabold text-sm tracking-wide bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 transition duration-150 shadow-lg shadow-teal-500/10 active:scale-[0.99]">
                DAFTARKAN AKUN SAYA
            </button>

            <div class="text-center pt-2">
                <span class="text-xs text-slate-400 font-medium">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="text-xs font-extrabold text-teal-600 hover:text-teal-700 transition ml-1">
                    Masuk ke Sistem &rarr;
                </a>
            </div>
        </div>
    </form>
@endsection
