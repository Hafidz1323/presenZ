@extends('layouts.guest')

@section('content')
    <h2 class="text-xl font-black text-slate-800 text-center mb-1">Verifikasi Email Anda</h2>
    <p class="text-xs text-slate-400 text-center mb-6 leading-relaxed">
        Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang kami kirimkan. Jika tidak menerimanya, kami akan mengirimkan yang baru.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 text-xs font-semibold text-emerald-600 bg-emerald-50 border border-emerald-100 px-4 py-2.5 rounded-xl text-center leading-normal">
            Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda daftarkan.
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full py-3 px-6 rounded-2xl text-white font-extrabold text-sm tracking-wide bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 transition duration-150 shadow-lg shadow-teal-500/10 active:scale-[0.99]">
                KIRIM ULANG EMAIL VERIFIKASI
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center pt-2">
            @csrf
            <button type="submit" class="text-xs font-extrabold text-slate-400 hover:text-slate-600 transition tracking-wide uppercase">
                LOG OUT / KELUAR
            </button>
        </form>
    </div>
@endsection
