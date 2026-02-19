@extends('layouts.app')

@include('layouts.head')

@section('content')
    <div class="min-h-screen w-full bg-[#fbf8ef] flex items-center justify-center p-4 relative overflow-hidden font-sans">

        {{-- Background Blobs --}}
        <div class="absolute top-0 left-0 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse delay-1000 pointer-events-none"></div>

        <div class="w-full max-w-[450px] bg-white rounded-[2rem] shadow-2xl border border-white/50 relative z-10 flex flex-col max-h-[90vh] overflow-y-auto hide-scrollbar">

            <div class="pt-8 pb-2 text-center px-8">
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Buat Akun</h2>
                <p class="text-gray-500 mt-2 text-sm">Pilih peranmu dan mulai perjalanan karirmu.</p>
            </div>

            <div class="px-8 py-6">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Role Selection (Fixed) --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider ml-1">Daftar Sebagai</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="job_seeker" class="peer sr-only" {{ old('role', 'job_seeker') == 'job_seeker' ? 'checked' : '' }}>
                                <div class="rounded-xl border-2 border-gray-100 bg-gray-50 p-3 text-center transition-all hover:border-teal-200 peer-checked:border-teal-500 peer-checked:bg-teal-50 peer-checked:text-teal-700">
                                    <i class="fas fa-user mb-1 text-lg"></i>
                                    <div class="text-xs font-bold">Pencari Kerja</div>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="employer" class="peer sr-only" {{ old('role') == 'employer' ? 'checked' : '' }}>
                                <div class="rounded-xl border-2 border-gray-100 bg-gray-50 p-3 text-center transition-all hover:border-orange-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-700">
                                    <i class="fas fa-briefcase mb-1 text-lg"></i>
                                    <div class="text-xs font-bold">Perusahaan</div>
                                </div>
                            </label>
                        </div>
                        @error('role')
                            <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Full Name --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 ml-1">Nama Lengkap</label>
                        <div class="relative flex items-center">
                            <i class="fas fa-user absolute left-4 text-gray-400 group-focus-within:text-teal-500 transition-colors duration-300"></i>
                            <input type="text" name="full_name" required value="{{ old('full_name') }}"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all placeholder-gray-400 text-sm font-medium"
                                placeholder="John Doe">
                        </div>
                        @error('full_name')
                            <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 ml-1">Email Address</label>
                        <div class="relative flex items-center">
                            <i class="fas fa-envelope absolute left-4 text-gray-400 group-focus-within:text-teal-500 transition-colors duration-300"></i>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all placeholder-gray-400 text-sm font-medium"
                                placeholder="name@example.com">
                        </div>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 ml-1">Password</label>
                        <div class="relative flex items-center">
                            <i class="fas fa-lock absolute left-4 text-gray-400 group-focus-within:text-orange-500 transition-colors duration-300"></i>
                            <input type="password" name="password" required
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all placeholder-gray-400 text-sm font-medium"
                                placeholder="Min. 8 karakter">
                        </div>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 ml-1">Konfirmasi Password</label>
                        <div class="relative flex items-center">
                            <i class="fas fa-check-circle absolute left-4 text-gray-400 group-focus-within:text-orange-500 transition-colors duration-300"></i>
                            <input type="password" name="password_confirmation" required
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all placeholder-gray-400 text-sm font-medium"
                                placeholder="Ulangi password">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full mt-6 py-4 bg-gradient-to-r from-teal-500 to-teal-700 text-white font-bold rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 hover:scale-[1.01] active:scale-95 transition-all duration-200 flex items-center justify-center gap-2 text-sm tracking-wide">
                        DAFTAR SEKARANG <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </form>
            </div>

            <div class="bg-gray-50 px-8 py-5 text-center border-t border-gray-100 mt-auto rounded-b-[2rem]">
                <p class="text-gray-500 text-xs">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-bold text-orange-500 hover:text-orange-600 transition hover:underline ml-1">
                        Masuk disini
                    </a>
                </p>
            </div>
        </div>
    </div>

    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
@endsection