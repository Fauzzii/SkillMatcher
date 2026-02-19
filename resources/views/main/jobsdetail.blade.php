@extends('layouts.app')

@include('layouts.nav')

@section('content')

    {{-- 1. BACKGROUND GRADIENT (Konsisten dengan Index) --}}
    <div class="fixed top-0 w-full h-[450px] bg-gradient-to-b from-teal-50 via-orange-50/20 to-white -z-10 rounded-b-[4rem]">
    </div>

    <main class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-24">

        {{-- NAVIGASI BALIK --}}
        <div class="mb-8">
            <a href="{{ route('jobs.index') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-gray-900 transition-colors bg-white/60 backdrop-blur-md px-5 py-2.5 rounded-full shadow-sm border border-white">
                <i class="fas fa-arrow-left"></i> Kembali ke Pencarian
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">

            {{-- === KOLOM KIRI: INFO UTAMA (8 Grid) === --}}
            <div class="lg:col-span-8 space-y-8">

                {{-- A. HEADER CARD --}}
                <div
                    class="bg-white rounded-[3rem] p-8 md:p-10 shadow-xl shadow-gray-200/50 border border-white relative overflow-hidden group">
                    {{-- Efek Hover Halus --}}
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-teal-50/50 rounded-bl-[100%] transition-transform duration-700 group-hover:scale-110 -mr-16 -mt-16 pointer-events-none">
                    </div>

                    <div class="relative z-10">
                        <div class="flex flex-col md:flex-row gap-6 items-start">

                            {{-- Logo Perusahaan --}}
                            <div
                                class="w-20 h-20 md:w-24 md:h-24 rounded-[2rem] bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center text-4xl font-black text-gray-800 shadow-inner border border-gray-100 shrink-0">
                                {{ substr($job->company->name ?? 'C', 0, 1) }}
                            </div>

                            <div class="flex-1 w-full">
                                {{-- Badges --}}
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <span
                                        class="px-4 py-1.5 bg-teal-50 text-teal-700 rounded-full text-[10px] font-bold uppercase tracking-widest border border-teal-100">
                                        {{ $job->category }}
                                    </span>
                                    @if ($job->created_at->diffInDays() <= 3)
                                        <span
                                            class="px-3 py-1.5 bg-orange-50 text-orange-600 rounded-full text-[10px] font-bold uppercase tracking-widest border border-orange-100 flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span> BARU
                                        </span>
                                    @endif
                                </div>

                                {{-- Judul --}}
                                <h1
                                    class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-2 leading-tight tracking-tight">
                                    {{ $job->title }}
                                </h1>

                                {{-- Info Perusahaan --}}
                                <div class="flex items-center gap-2 text-gray-500 font-medium text-base md:text-lg">
                                    <span class="text-gray-900 font-bold hover:underline cursor-pointer">
                                        {{ $job->company->name ?? 'Perusahaan' }}
                                    </span>
                                    <span class="text-gray-300">•</span>
                                    <span><i class="fas fa-map-marker-alt text-gray-400 mr-1"></i> Indonesia (Remote)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- B. DESKRIPSI & REQUIREMENTS --}}
                <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-sm border border-gray-100/50">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span
                            class="w-10 h-10 rounded-2xl bg-teal-50 flex items-center justify-center text-teal-600 shadow-sm">
                            <i class="fas fa-file-alt"></i>
                        </span>
                        Detail Pekerjaan
                    </h3>

                    <div class="prose prose-lg prose-teal max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

            </div>

            {{-- === KOLOM KANAN: SIDEBAR PELAMAR (4 Grid) === --}}
            <div class="lg:col-span-4 space-y-6">

                <div
                    class="bg-white rounded-[2.5rem] p-8 shadow-2xl shadow-gray-900/10 border border-teal-100/50 top-8 z-20">

                    <div class="text-center mb-8 pb-8 border-b border-gray-100">
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-2">Penawaran Gaji</p>
                        <div class="flex items-center justify-center gap-1 text-gray-900">
                            <span class="text-lg font-bold mt-1">Rp</span>
                            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tighter">
                                Rp {{ number_format($job->salary, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>

                    <div class="space-y-3">
                        @if (Auth::check() && Auth::id() == $job->company->owner_id)
                            {{-- Tombol Edit untuk Owner --}}
                            <button onclick="toggleModal('editJobModal{{ $job->id }}')"
                                class="w-full py-4 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-2xl font-bold transition-all active:scale-95 flex items-center justify-center gap-2">
                                <i class="fas fa-edit"></i> Edit Lowongan
                            </button>
                        @else
                            @php
                                $hasApplied = \App\Models\Applications::where('user_id', auth()->id())
                                    ->where('job_id', $job->id)
                                    ->exists();
                            @endphp

                            @if ($hasApplied)
                                <button disabled
                                    class="w-full py-4 bg-teal-600/20 text-teal-700 rounded-2xl font-bold text-lg cursor-not-allowed border border-teal-100">
                                    <i class="fas fa-check-circle mr-2"></i> Sudah Dilamar
                                </button>
                            @else
                                <form action="{{ route('jobs.apply', $job->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        onclick="return confirm('Apakah kamu yakin ingin melamar posisi ini?')"
                                        class="w-full py-4 bg-gray-900 text-white rounded-2xl font-bold text-lg hover:bg-teal-600 shadow-xl shadow-gray-900/20 hover:shadow-teal-600/30 transition-all duration-300 transform hover:-translate-y-1">
                                        Lamar Sekarang
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>

                    <div
                        class="mt-6 pt-6 border-t border-gray-50 flex items-center justify-center gap-2 text-xs text-gray-400 font-medium">
                        <i class="fas fa-shield-alt text-teal-500"></i> Terverifikasi & Aman
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Kualifikasi Skill</h3>

                    @php
                        $hardSkills = $job->skills->where('pivot.category', false);
                        $softSkills = $job->skills->where('pivot.category', true);
                    @endphp

                    {{-- Hard Skills --}}
                    @if ($hardSkills->count() > 0)
                        <div class="mb-6">
                            <p
                                class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <i class="fas fa-code text-teal-500"></i> Wajib Dikuasai
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($hardSkills as $skill)
                                    <span
                                        class="px-3 py-1.5 bg-teal-50 text-teal-800 rounded-xl text-xs font-bold border border-teal-100">
                                        {{ $skill->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Soft Skills --}}
                    @if ($softSkills->count() > 0)
                        <div>
                            <p
                                class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <i class="fas fa-star text-orange-400"></i> Nilai Plus
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($softSkills as $skill)
                                    <span
                                        class="px-3 py-1.5 bg-orange-50 text-orange-800 rounded-xl text-xs font-bold border border-orange-100">
                                        {{ $skill->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
