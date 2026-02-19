@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#fbf8ef] font-sans py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">

        {{-- Background Hiasan --}}
        <div
            class="fixed top-0 right-0 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse pointer-events-none">
        </div>
        <div
            class="fixed bottom-0 left-0 w-96 h-96 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000 pointer-events-none">
        </div>

        <div class="max-w-6xl mx-auto relative z-10">

            {{-- Header Halaman --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">

                <div class="flex items-center gap-4">
                    <a href="{{ route('profile') }}"
                        class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 text-gray-400 hover:text-teal-600 transition">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pelamar Masuk</h1>
                        {{-- Judul Lowongan Dinamis --}}
                        <p class="text-gray-500 text-sm">Posisi: <span
                                class="font-bold text-teal-600">{{ $job->title }}</span></p>
                    </div>
                </div>

                <div class="bg-white px-5 py-2 rounded-xl border border-gray-100 shadow-sm flex items-center gap-3">
                    <div class="bg-orange-100 p-2 rounded-lg text-orange-600">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-wider">Total
                            Kandidat</span>
                        {{-- Hitung Jumlah Pelamar --}}
                        <span class="font-bold text-gray-900 text-lg">{{ $job->applications->count() }} Orang</span>
                    </div>
                </div>
            </div>

            {{-- Grid Daftar Pelamar --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- LOOPING DATA PELAMAR --}}
                @forelse ($job->applications as $application)
                    @php $user = $application->user; @endphp

                    <div
                        class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group">
                        <div class="flex items-center gap-4 mb-6">
                            {{-- Foto Profil --}}
                            @if ($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                    class="w-16 h-16 rounded-2xl object-cover border-2 border-white shadow-md">
                            @else
                                <div
                                    class="w-16 h-16 rounded-2xl bg-gray-200 flex items-center justify-center font-bold text-gray-500 border-2 border-white shadow-md">
                                    {{ substr($user->full_name, 0, 1) }}
                                </div>
                            @endif

                            <div>
                                <h3 class="text-lg font-bold text-gray-900 leading-tight">{{ $user->full_name }}</h3>
                                <p class="text-xs text-gray-500 font-medium">{{ $user->email }}</p>
                                <span
                                    class="inline-block mt-2 px-2 py-0.5 rounded bg-teal-50 text-teal-600 text-[10px] font-bold">
                                    {{ $application->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach ($user->skills->take(3) as $s)
                                <span
                                    class="px-3 py-1 bg-gray-50 text-gray-600 text-[10px] font-bold rounded-lg border border-gray-100">
                                    {{ $s->name }}
                                </span>
                            @endforeach
                        </div>

                        <button onclick="openModal('modal-{{ $user->id }}')"
                            class="w-full py-3 rounded-xl bg-gray-900 text-white text-sm font-bold hover:bg-gray-800 transition shadow-lg shadow-gray-900/20">
                            Lihat Profil & Aksi
                        </button>
                    </div>
                    <div id="modal-{{ $user->id }}" class="fixed inset-0 z-50 hidden">
                        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                            onclick="closeModal('modal-{{ $user->id }}')"></div>

                        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
                            <div
                                class="bg-[#fbf8ef] w-full max-w-[400px] h-[85vh] rounded-[2.5rem] shadow-2xl relative overflow-hidden pointer-events-auto border-[6px] border-white animate-slide-up flex flex-col">

                                {{-- Tombol Close --}}
                                <button onclick="closeModal('modal-{{ $user->id }}')"
                                    class="absolute top-4 right-4 z-30 w-8 h-8 bg-white/50 hover:bg-white backdrop-blur rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition shadow-sm">
                                    <i class="fas fa-times text-sm"></i>
                                </button>

                                <div class="flex-1 overflow-y-auto hide-scrollbar pb-24">

                                    {{-- Header Profile Modal --}}
                                    <div class="pt-10 px-6 flex flex-col items-center">
                                        <div
                                            class="w-24 h-24 rounded-full p-1 bg-gradient-to-b from-gray-100 to-white shadow-lg mb-[-15px] relative z-10">
                                            @if ($user->profile_photo_path)
                                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                    class="w-full h-full rounded-full object-cover">
                                            @else
                                                <div
                                                    class="w-full h-full rounded-full bg-gray-300 flex items-center justify-center text-2xl font-bold text-gray-600">
                                                    {{ substr($user->full_name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="relative z-0 mb-4">
                                            <div
                                                class="w-12 h-14 bg-gradient-to-b from-gray-700 to-gray-900 rounded-b-full rounded-t-lg flex items-center justify-center text-orange-300 text-xl border-2 border-orange-400 shadow-md">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                        </div>

                                        <h2 class="text-xl font-extrabold text-gray-800 text-center">{{ $user->full_name }}
                                        </h2>
                                        <p class="text-xs text-gray-500 font-bold tracking-wide mt-1">{{ $user->email }}
                                        </p>
                                    </div>

                                    <div class="px-5 mt-8 grid grid-cols-2 gap-3">

                                        {{-- 1. HARD SKILL (Biasanya disimpan sebagai 0) --}}
                                        <div class="bg-[#fff8f0] rounded-2xl p-3 border border-orange-100 h-full">
                                            <h4 class="text-orange-500 font-bold text-xs mb-3">Hard Skill</h4>
                                            <div class="flex flex-col gap-2">
                                                {{-- GANTI 'false' MENJADI '0' --}}
                                                @forelse ($user->skills->where('category', 0)->take(3) as $s)
                                                    <span
                                                        class="px-3 py-1 bg-white text-gray-600 text-[10px] font-bold rounded-lg border border-orange-100 shadow-sm">
                                                        {{ $s->name }}
                                                    </span>
                                                @empty
                                                    <span class="text-[9px] text-gray-400 italic">Data Kosong</span>
                                                @endforelse
                                            </div>
                                        </div>

                                        {{-- 2. SOFT SKILL (Biasanya disimpan sebagai 1) --}}
                                        <div class="bg-[#f0fbf9] rounded-2xl p-3 border border-teal-100 h-full">
                                            <h4 class="text-teal-600 font-bold text-xs mb-3">Soft Skill</h4>
                                            <div class="flex flex-col gap-2">
                                                {{-- GANTI 'true' MENJADI '1' --}}
                                                @forelse ($user->skills->where('category', 1)->take(3) as $s)
                                                    <span
                                                        class="px-3 py-1 bg-white text-teal-600 text-[10px] font-bold rounded-lg border border-teal-100 shadow-sm">
                                                        {{ $s->name }}
                                                    </span>
                                                @empty
                                                    <span class="text-[9px] text-gray-400 italic">Data Kosong</span>
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Resume --}}
                                    <div class="px-5 mt-4 space-y-2">
                                        @if ($user->resume)
                                            <a href="{{ asset('storage/' . $user->resume) }}" target="_blank"
                                                class="bg-[#e8f3e8] rounded-xl p-1 flex items-center justify-between pl-4 pr-1 py-1.5 border border-green-100 shadow-sm cursor-pointer hover:bg-[#dff0df] transition">
                                                <span class="text-gray-700 font-bold text-sm">Download Resume</span>
                                                <div
                                                    class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-gray-700 border border-gray-200 shadow-sm">
                                                    <i class="far fa-file-alt text-sm"></i>
                                                </div>
                                            </a>
                                        @else
                                            <div class="bg-gray-50 rounded-xl p-3 text-center text-xs text-gray-400">Resume
                                                tidak tersedia</div>
                                        @endif
                                    </div>

                                    {{-- Education --}}
                                    <div class="px-5 mt-6 pb-4">
                                        <h3 class="font-extrabold text-gray-700 text-sm mb-3">Education</h3>
                                        <div class="space-y-3">
                                            @forelse($user->educations as $edu)
                                                <div
                                                    class="bg-white p-3 rounded-2xl border border-gray-100 shadow-sm flex gap-3 items-start">
                                                    <div
                                                        class="w-8 h-8 rounded-full border border-blue-100 flex items-center justify-center p-1">
                                                        <i class="fas fa-graduation-cap text-blue-500 text-xs"></i>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-xs font-bold text-gray-800 leading-tight">
                                                            {{ $edu->institution_name }}</h4>
                                                        <p class="text-[10px] text-gray-500">{{ $edu->level }} •
                                                            {{ $edu->graduation_year }}</p>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-xs text-gray-400 italic">Data pendidikan kosong</p>
                                            @endforelse
                                        </div>
                                    </div>

                                </div>

                                <div
                                    class="absolute bottom-0 w-full bg-[#fbf8ef]/90 backdrop-blur-md border-t border-orange-100 p-4 flex gap-3 z-30">

                                    <form action="{{ route('applications.updateStatus', $application->id) }}"
                                        method="POST" class="flex-1">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="status" value="denied">

                                        <button type="submit" onclick="return confirm('Yakin ingin menolak pelamar ini?')"
                                            class="w-full flex-1 py-3 rounded-2xl bg-gray-200 text-gray-600 font-bold text-xs hover:bg-gray-300 hover:text-red-600 transition flex flex-col items-center justify-center gap-1 group">
                                            <i class="fas fa-times text-sm group-hover:scale-110 transition-transform"></i>
                                            <span>Tolak</span>
                                        </button>
                                    </form>

                                    <form action="{{ route('applications.updateStatus', $application->id) }}"
                                        method="POST" class="flex-1">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="status" value="accepted">

                                        <button type="submit" onclick="return confirm('Yakin ingin menerima pelamar ini?')"
                                            class="w-full flex-1 py-3 rounded-2xl bg-teal-600 text-white font-bold text-xs hover:bg-teal-700 shadow-lg shadow-teal-600/20 transition flex flex-col items-center justify-center gap-1 hover:-translate-y-1">
                                            <i class="fas fa-check text-sm"></i>
                                            <span>Terima</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-span-full py-20 text-center">
                        <div
                            class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                            <i class="fas fa-ghost text-4xl"></i>
                        </div>
                        <h3 class="text-gray-900 font-bold text-lg">Belum Ada Pelamar</h3>
                        <p class="text-gray-500 text-sm mt-1">Lowongan ini masih sepi.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>

    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .animate-slide-up {
            animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
@endsection
