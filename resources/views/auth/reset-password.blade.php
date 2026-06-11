@extends('layouts.guest')

@section('content')
    <h2 class="text-xl font-black text-slate-800 text-center mb-1">Setel Ulang Kata Sandi</h2>
    <p class="text-xs text-slate-400 text-center mb-6">Buat kata sandi baru untuk akun Anda.</p>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Email</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email', $email) }}" 
                required 
                readonly
                class="w-full px-4 py-2.5 text-sm bg-slate-100 border border-slate-200 rounded-2xl focus:outline-none text-slate-500 cursor-not-allowed"
            >
            @error('email')
                <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kata Sandi Baru</label>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                autocomplete="new-password"
                autofocus
                class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('password') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
            >
            @error('password')
                <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Konfirmasi Kata Sandi Baru</label>
            <input 
                id="password_confirmation" 
                type="password" 
                name="password_confirmation" 
                required 
                class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 rounded-2xl focus:outline-none focus:ring-2 transition"
            >
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit" class="w-full py-3 px-6 rounded-2xl text-white font-extrabold text-sm tracking-wide bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 transition duration-150 shadow-lg shadow-teal-500/10 active:scale-[0.99]">
                SETEL ULANG KATA SANDI
            </button>
        </div>
    </form>
@endsection
