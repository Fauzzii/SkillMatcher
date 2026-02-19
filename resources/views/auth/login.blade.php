@extends('layouts.app')

@include('layouts.head')

@section('content')
    <div class="h-screen w-full bg-[#fbf8ef] flex items-center justify-center p-4 relative overflow-hidden font-sans">

        <div
            class="absolute top-0 left-0 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 right-0 w-96 h-96 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse delay-1000 pointer-events-none">
        </div>

        <div
            class="w-full max-w-[400px] bg-white rounded-[2.5rem] shadow-2xl border border-white/50 relative z-10 flex flex-col overflow-hidden">

            <div class="pt-10 pb-2 text-center px-8">
                
                <h2 class="text-2xl font-extrabold text-gray-800">Welcome Back!</h2>
                <p class="text-gray-500 mt-1 text-sm">Masuk untuk mencocokkan skill impianmu.</p>
            </div>

            <div class="px-8 py-6">
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div class="group">
                        <label for="email"
                            class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5 ml-1">Email
                            Address</label>
                        <div class="relative flex items-center">
                            <i
                                class="fas fa-envelope absolute left-4 text-gray-400 group-focus-within:text-teal-500 transition-colors duration-300"></i>
                            <input id="email" type="email" name="email" required autofocus
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-100 text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 placeholder-gray-400 font-medium text-sm"
                                placeholder="name@example.com">
                        </div>
                        @error('email')
                            <span class="text-red-500 text-[10px] mt-1 ml-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="password"
                            class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1.5 ml-1">Password</label>
                        <div class="relative flex items-center">
                            <i
                                class="fas fa-lock absolute left-4 text-gray-400 group-focus-within:text-orange-500 transition-colors duration-300"></i>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-100 text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 placeholder-gray-400 font-medium text-sm"
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <span class="text-red-500 text-[10px] mt-1 ml-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full mt-2 py-3.5 bg-gradient-to-r from-orange-400 to-orange-600 text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:scale-[1.02] active:scale-95 transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                        Masuk Sekarang <i class="fas fa-arrow-right"></i>
                    </button>

                </form>
            </div>

            <div class="bg-gray-50/80 px-8 py-5 text-center border-t border-gray-100 mt-auto">
                <p class="text-gray-500 text-xs">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-bold text-teal-600 hover:text-teal-700 transition hover:underline">
                        Daftar Gratis
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
