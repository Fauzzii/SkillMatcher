@extends('layouts.app')

@include('layouts.head')

@include('layouts.nav')

@section('content')
    <div class="bg-[#fbf8ef] min-h-screen font-sans">

        <section class="relative pt-12 pb-20 lg:pt-24 lg:pb-32 overflow-hidden">
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse">
            </div>
            <div
                class="absolute bottom-0 left-0 w-96 h-96 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000">
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-orange-200 text-orange-600 text-xs font-bold shadow-sm mb-8">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    #1 AI-Powered Job Matching
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold text-gray-800 tracking-tight mb-6">
                    Karir Impian Menunggu.<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-teal-600">Cocokkan
                        Skillmu Sekarang.</span>
                </h1>

                <p class="text-lg text-gray-500 mb-10 max-w-2xl mx-auto leading-relaxed">
                    SkillMatcher membantu kamu menemukan pekerjaan yang pas dengan keahlian unikmu. Gunakan analisis AI
                    untuk hasil yang akurat.
                </p>

            </div>
        </section>

        <section class="border-y border-orange-100/50 bg-white/50 backdrop-blur-sm">
            <div class="container mx-auto px-4 grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200/50">
                <div class="py-8 text-center">
                    <div class="text-3xl font-bold text-teal-600">5K+</div>
                    <div class="text-xs text-gray-500 font-semibold uppercase tracking-wide mt-1">Lowongan</div>
                </div>
                <div class="py-8 text-center">
                    <div class="text-3xl font-bold text-orange-500">1.2K+</div>
                    <div class="text-xs text-gray-500 font-semibold uppercase tracking-wide mt-1">Perusahaan</div>
                </div>
                <div class="py-8 text-center">
                    <div class="text-3xl font-bold text-teal-600">85%</div>
                    <div class="text-xs text-gray-500 font-semibold uppercase tracking-wide mt-1">Match Rate</div>
                </div>
                <div class="py-8 text-center">
                    <div class="text-3xl font-bold text-orange-500">24h</div>
                    <div class="text-xs text-gray-500 font-semibold uppercase tracking-wide mt-1">Respon</div>
                </div>
            </div>
        </section>

        <section class="py-20">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Kategori Populer</h2>
                        <p class="text-gray-500 mt-2">Peluang di industri yang sedang berkembang</p>
                    </div>
                    <a href="#"
                        class="px-6 py-2 rounded-full border border-teal-500 text-teal-600 font-bold text-sm hover:bg-teal-50 transition">
                        Lihat Semua
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <a href="#"
                        class="group bg-orange-50/50 border border-orange-200 p-6 rounded-2xl hover:shadow-md transition duration-300 flex flex-col items-start">
                        <div
                            class="w-12 h-12 bg-white text-orange-500 rounded-xl flex items-center justify-center text-xl mb-4 border border-orange-100 shadow-sm group-hover:scale-110 transition">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg">Technology</h3>
                        <p class="text-sm text-gray-500 mt-1">1,204 Jobs Available</p>
                        <span class="mt-4 text-xs font-bold text-orange-500 group-hover:underline">Explore &rarr;</span>
                    </a>

                    <a href="#"
                        class="group bg-teal-50/50 border border-teal-200 p-6 rounded-2xl hover:shadow-md transition duration-300 flex flex-col items-start">
                        <div
                            class="w-12 h-12 bg-white text-teal-600 rounded-xl flex items-center justify-center text-xl mb-4 border border-teal-100 shadow-sm group-hover:scale-110 transition">
                            <i class="fas fa-pen-nib"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg">Design & Creative</h3>
                        <p class="text-sm text-gray-500 mt-1">840 Jobs Available</p>
                        <span class="mt-4 text-xs font-bold text-teal-600 group-hover:underline">Explore &rarr;</span>
                    </a>

                    <a href="#"
                        class="group bg-orange-50/50 border border-orange-200 p-6 rounded-2xl hover:shadow-md transition duration-300 flex flex-col items-start">
                        <div
                            class="w-12 h-12 bg-white text-orange-500 rounded-xl flex items-center justify-center text-xl mb-4 border border-orange-100 shadow-sm group-hover:scale-110 transition">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg">Marketing</h3>
                        <p class="text-sm text-gray-500 mt-1">560 Jobs Available</p>
                        <span class="mt-4 text-xs font-bold text-orange-500 group-hover:underline">Explore &rarr;</span>
                    </a>

                    <a href="#"
                        class="group bg-teal-50/50 border border-teal-200 p-6 rounded-2xl hover:shadow-md transition duration-300 flex flex-col items-start">
                        <div
                            class="w-12 h-12 bg-white text-teal-600 rounded-xl flex items-center justify-center text-xl mb-4 border border-teal-100 shadow-sm group-hover:scale-110 transition">
                            <i class="fas fa-coins"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg">Finance</h3>
                        <p class="text-sm text-gray-500 mt-1">320 Jobs Available</p>
                        <span class="mt-4 text-xs font-bold text-teal-600 group-hover:underline">Explore &rarr;</span>
                    </a>
                </div>
            </div>
        </section>

        <section class="py-24 relative overflow-hidden">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">

                    <div class="relative z-10">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                            Cara Kerja <span class="text-teal-600">SkillMatcher</span>
                        </h2>
                        <p class="text-gray-500 text-lg mb-8 leading-relaxed">
                            Analisis profilmu untuk menemukan kecocokan budaya dan teknis yang presisi menggunakan AI.
                        </p>

                        <div class="space-y-4">
                            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-start gap-4">
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold border-2 border-white shadow-sm">
                                    1
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm">Buat Profil Lengkap</h4>
                                    <p class="text-xs text-gray-500 mt-1">Isi pengalaman, portofolio, dan hard/soft skill
                                        kamu.</p>
                                </div>
                            </div>

                            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-start gap-4">
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center font-bold border-2 border-white shadow-sm">
                                    2
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm">Analisis Kecocokan AI</h4>
                                    <p class="text-xs text-gray-500 mt-1">Sistem mencocokkan skill dengan kriteria
                                        perusahaan.</p>
                                </div>
                            </div>

                            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-start gap-4">
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-50 text-teal-600 flex items-center justify-center font-bold border-2 border-white shadow-sm">
                                    3
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm">Lamar Instan</h4>
                                    <p class="text-xs text-gray-500 mt-1">Kirim lamaran langsung ke HR tanpa formulir
                                        berulang.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-orange-200 to-teal-200 rounded-[30px] transform rotate-3 scale-105 -z-10 opacity-60">
                        </div>

                        <div class="bg-white border border-gray-100 rounded-[20px] shadow-2xl p-6 relative">
                            <div class="flex items-center gap-4 mb-6 border-b border-gray-100 pb-4">
                                <img src="https://i.pravatar.cc/150?img=11"
                                    class="w-12 h-12 rounded-full border-2 border-white shadow-md" alt="User">
                                <div>
                                    <h5 class="font-bold text-gray-800">Match Found! 🎉</h5>
                                    <p class="text-xs text-gray-500">Based on your UI/UX skills</p>
                                </div>
                                <span
                                    class="ml-auto bg-teal-100 text-teal-700 text-xs font-bold px-3 py-1 rounded-full">98%</span>
                            </div>

                            <div class="space-y-3 mb-6">
                                <div class="h-3 bg-gray-100 rounded-full w-3/4"></div>
                                <div class="h-3 bg-gray-100 rounded-full w-1/2"></div>
                            </div>

                            <div class="flex gap-3">
                                <button
                                    class="flex-1 bg-teal-600 text-white text-sm font-bold py-2.5 rounded-xl hover:bg-teal-700 transition">Apply
                                    Now</button>
                                <button
                                    class="flex-1 bg-white border border-gray-300 text-gray-600 text-sm font-bold py-2.5 rounded-xl hover:bg-gray-50 transition">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @guest
            <section class="py-20 px-4">
                <div class="container mx-auto max-w-5xl">
                    <div class="bg-gray-800 rounded-[40px] p-10 md:p-16 text-center relative overflow-hidden group shadow-2xl">
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-teal-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20 group-hover:opacity-30 transition duration-1000">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-64 h-64 bg-orange-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20 group-hover:opacity-30 transition duration-1000">
                        </div>
                        <div class="relative z-10">
                            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap Memulai Karir?</h2>
                            <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
                                Bergabunglah dengan SkillMatcher. Platform karir yang mengerti skill kamu.
                            </p>
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <a href="{{ route('register') }}"
                                    class="px-8 py-4 bg-teal-500 hover:bg-teal-400 text-white font-bold rounded-xl transition transform hover:-translate-y-1 shadow-lg shadow-teal-500/25">
                                    Daftar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endguest
    </div>
@endsection
