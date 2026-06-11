@extends('layouts.guest')

@section('content')
    <h2 class="text-xl font-black text-slate-800 text-center mb-1">Konfirmasi Kata Sandi</h2>
    <p class="text-xs text-slate-400 text-center mb-6 leading-relaxed">
        Ini adalah area aplikasi yang aman. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kata Sandi</label>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                autocomplete="current-password"
                autofocus
                class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('password') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
            >
            @error('password')
                <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit" class="w-full py-3 px-6 rounded-2xl text-white font-extrabold text-sm tracking-wide bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 transition duration-150 shadow-lg shadow-teal-500/10 active:scale-[0.99]">
                KONFIRMASI SANDI
            </button>
        </div>
    </form>
@endsection
