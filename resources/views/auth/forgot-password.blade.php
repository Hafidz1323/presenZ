@extends('layouts.guest')

@section('content')
    <h2 class="text-xl font-black text-slate-800 text-center mb-1">Lupa Kata Sandi</h2>
    <p class="text-xs text-slate-400 text-center mb-6">Tuliskan email Anda di bawah. Kami akan mengirimkan tautan untuk setel ulang kata sandi.</p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm font-semibold text-emerald-600 bg-emerald-50 border border-emerald-100 px-4 py-2.5 rounded-xl text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Email</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
                class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('email') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
            >
            @error('email')
                <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="mt-6 space-y-4">
            <button type="submit" class="w-full py-3 px-6 rounded-2xl text-white font-extrabold text-sm tracking-wide bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 transition duration-150 shadow-lg shadow-teal-500/10 active:scale-[0.99]">
                KIRIM TAUTAN RESET
            </button>

            <div class="text-center pt-2">
                <a href="{{ route('login') }}" class="text-xs font-extrabold text-teal-600 hover:text-teal-700 transition">
                    &larr; Kembali ke Halaman Masuk
                </a>
            </div>
        </div>
    </form>
@endsection
