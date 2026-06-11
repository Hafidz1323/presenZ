@extends('layouts.app')

@section('header')
    <span>Profile</span>
@endsection

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto">
        <!-- 1. Update Profile Info Form -->
        <div class="bg-white p-6 sm:p-8 shadow-sm border border-slate-200/50 rounded-3xl">
            <header class="mb-6">
                <h2 class="text-lg font-bold text-slate-900">Informasi Profil</h2>
                <p class="mt-1 text-sm text-slate-500 font-medium">Perbarui informasi akun, email, dan foto profil Anda.</p>
            </header>

            <!-- Profile Photo Section with its own forms -->
            <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100 mb-6">
                <div class="relative group">
                    <img 
                        id="photo-preview"
                        src="{{ auth()->user()->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=0ea5e9&color=fff&bold=true&size=128' }}" 
                        alt="Profile Photo" 
                        class="w-24 h-24 object-cover rounded-2xl border-4 border-white shadow-md transition group-hover:scale-[1.02]"
                    >
                </div>
                <div class="space-y-2 text-center sm:text-left">
                    <h3 class="text-sm font-semibold text-slate-800">Foto Profil</h3>
                    <p class="text-xs text-slate-500 max-w-xs">Pilih foto terbaik Anda. Format PNG, JPG maksimal 2MB.</p>
                    
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                        <!-- Upload Form -->
                        <form id="photo-upload-form" method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input 
                                type="file" 
                                id="photo-input" 
                                name="photo" 
                                accept="image/*" 
                                class="hidden" 
                                onchange="submitPhotoForm()"
                            />
                            <button
                                type="button"
                                onclick="document.getElementById('photo-input').click()"
                                class="px-3.5 py-1.5 bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white text-xs font-bold rounded-xl transition shadow-sm"
                            >
                                Unggah Foto
                            </button>
                        </form>

                        <!-- Delete Form -->
                        @if(auth()->user()->photo)
                            <form method="POST" action="{{ route('profile.photo.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus foto profil ini?')"
                                    class="px-3.5 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-xl transition"
                                >
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Profile Info Form -->
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6 max-w-xl">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name', auth()->user()->name) }}" 
                        required 
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('name') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
                    >
                    @error('name')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email', auth()->user()->email) }}" 
                        required 
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('email') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
                    >
                    @error('email')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-extrabold text-xs rounded-xl shadow-md transition active:scale-[0.98]">
                        Simpan
                    </button>
                    @if (session('status') === 'profile-updated')
                        <p class="text-xs font-semibold text-emerald-600">Disimpan.</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- 2. Update Password Form -->
        <div class="bg-white p-6 sm:p-8 shadow-sm border border-slate-200/50 rounded-3xl">
            <header class="mb-6">
                <h2 class="text-lg font-bold text-slate-900">Perbarui Kata Sandi</h2>
                <p class="mt-1 text-sm text-slate-500 font-medium">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
            </header>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6 max-w-xl">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kata Sandi Saat Ini</label>
                    <input 
                        id="current_password" 
                        type="password" 
                        name="current_password" 
                        required 
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('current_password', 'updatePassword') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
                    >
                    @error('current_password', 'updatePassword')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kata Sandi Baru</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('password', 'updatePassword') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
                    >
                    @error('password', 'updatePassword')
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

                <div class="flex items-center gap-4">
                    <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-extrabold text-xs rounded-xl shadow-md transition active:scale-[0.98]">
                        Simpan Sandi
                    </button>
                    @if (session('status') === 'password-updated')
                        <p class="text-xs font-semibold text-emerald-600">Kata sandi berhasil diperbarui.</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- 3. Delete Account Form -->
        <div class="bg-white p-6 sm:p-8 shadow-sm border border-slate-200/50 rounded-3xl">
            <header class="mb-6">
                <h2 class="text-lg font-bold text-slate-900">Hapus Akun</h2>
                <p class="mt-1 text-sm text-slate-500 font-medium">Setelah akun Anda dihapus, semua data dan riwayat presensi akan dihapus secara permanen.</p>
            </header>

            <button 
                onclick="openModal('delete-account-modal')"
                class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs rounded-xl shadow-md transition active:scale-[0.98]"
            >
                Hapus Akun Saya
            </button>
        </div>
    </div>

    <!-- Delete Account Confirmation Modal -->
    <div id="delete-account-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/85 backdrop-blur-sm transition duration-300">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl border border-slate-200/60 relative animate-in fade-in zoom-in-95 duration-200">
            <!-- Modal Close -->
            <button 
                onclick="closeModal('delete-account-modal')"
                class="absolute top-5 right-5 z-20 p-2 bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 rounded-xl transition shadow-sm"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-black text-rose-600 leading-tight">Konfirmasi Penghapusan Akun</h3>
                <p class="text-xs text-slate-400 font-semibold mt-0.5">Tindakan ini tidak dapat dibatalkan. Silakan masukkan kata sandi Anda untuk mengonfirmasi.</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
                @csrf
                @method('DELETE')

                <div>
                    <label for="delete_password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kata Sandi Konfirmasi</label>
                    <input 
                        id="delete_password" 
                        type="password" 
                        name="password" 
                        required 
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('password', 'userDeletion') border-rose-350 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-teal-500/20 focus:border-teal-500 @enderror rounded-2xl focus:outline-none focus:ring-2 transition"
                    >
                    @error('password', 'userDeletion')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Modal Actions -->
                <div class="flex justify-end gap-3 pt-6 border-t border-slate-100 mt-6">
                    <button 
                        type="button" 
                        onclick="closeModal('delete-account-modal')" 
                        class="px-4 py-2.5 border border-slate-200 hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xl transition"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-rose-500/10 transition"
                    >
                        Hapus Akun Secara Permanen
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal trigger scripts -->
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        document.getElementById('photo-input').addEventListener('change', function(e) {
            if (this.files && this.files.length) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview').src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function submitPhotoForm() {
            document.getElementById('photo-upload-form').submit();
        }

        // Auto open delete modal if deletion fails
        @if ($errors->userDeletion->has('password'))
            window.addEventListener('DOMContentLoaded', () => {
                openModal('delete-account-modal');
            });
        @endif
    </script>
@endsection
