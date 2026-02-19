@extends('layouts.app')

@include('layouts.head')

@section('content')
    <div
        class="absolute top-0 w-full h-[300px] bg-gradient-to-b from-teal-50 via-orange-50 to-white -z-10 rounded-b-[3rem] md:rounded-b-[4rem]">
    </div>

    <main class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-24 md:pb-12 relative">

        <div class="absolute top-4 left-4 md:top-8 md:left-0 z-20">
            <a href="/"
                class="w-10 h-10 bg-white rounded-full shadow-sm border border-gray-200 flex items-center justify-center text-gray-500 hover:text-teal-600 hover:border-teal-200 transition"
                title="Kembali ke Dashboard">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <div class="absolute top-4 right-4 md:top-8 md:right-8 flex gap-2 z-20">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-10 h-10 bg-white rounded-full shadow-sm border border-gray-200 flex items-center justify-center text-red-400 hover:text-red-600 hover:border-red-200 transition"
                    title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>

        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10 gap-6">
            <div class="flex flex-col md:flex-row items-center md:items-end gap-6">
                <div class="relative group">
                    <div
                        class="w-28 h-28 md:w-36 md:h-36 rounded-full overflow-hidden border-4 border-white shadow-xl ring-1 ring-gray-100 transition transform group-hover:scale-105 duration-300 flex items-center justify-center bg-teal-100 text-teal-600 text-4xl md:text-5xl font-bold">
                        {{ substr($user->full_name, 0, 1) }}
                    </div>
                    <div
                        class="absolute -bottom-2 -right-2 md:bottom-1 md:right-0 transform rotate-3 hover:rotate-0 transition duration-300">
                        <div class="w-12 h-14 rounded-xl flex flex-col items-center justify-center">
                            @if (auth()->user() && auth()->user()->is_verified)
                                <img src="{{ asset('assets/Industryready.png') }}" class="w-full drop-shadow-lg"
                                    alt="Badge">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-center md:text-left mb-2">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                        {{ $user->full_name }}
                    </h1>
                    <p class="text-base text-gray-500 font-medium mt-1">
                        {{ $user->bio ?? 'Belum ada bio.' }}
                    </p>
                    <div class="flex items-center justify-center md:justify-start gap-2 mt-2 text-sm text-gray-400">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $user->address ?? 'Indonesia' }}, {{ $user->region ?? '' }}</span>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 w-full md:w-auto justify-center">
                <button onclick="toggleModal('edProfModal')"
                    class="flex-1 bg-white border border-gray-200 px-6 py-3 rounded-2xl shadow-sm text-gray-700 font-semibold hover:bg-gray-50 flex items-center justify-center gap-2">
                    <span>Edit</span>
                    <i class="fas fa-pen text-xs"></i>
                </button>

                @role('job_seeker')
                    <button onclick="toggleModal('resumeModal')"
                        class="flex-1 md:flex-none bg-gray-900 text-white border border-transparent px-6 py-3 rounded-2xl shadow-lg hover:bg-gray-800 hover:shadow-xl transition duration-200 flex items-center justify-center gap-2">
                        <span>Resume</span>
                        <i class="fas fa-folder-open"></i>
                    </button>
                @endrole
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            @role('job_seeker')
                <div class="lg:col-span-4 space-y-6">

                    <div
                        class="bg-orange-50/50 border border-orange-100 rounded-3xl p-6 hover:shadow-lg transition duration-300 h-[30vh] flex flex-col">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-orange-700 font-bold text-lg">Soft Skills</h3>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @forelse ($mySkills->where('category', 1) as $item)
                                <span
                                    class="px-3 py-1 bg-white border border-orange-200 text-orange-600 rounded-full text-xs font-semibold shadow-sm">
                                    {{ $item->skill->name }}
                                </span>
                            @empty
                                <span class="text-gray-400 text-xs italic py-1">Data belum ada</span>
                            @endforelse
                        </div>
                        <button onclick="toggleModal('softSkillsModal')"
                            class="mt-auto w-full py-2.5 rounded-xl bg-orange-500 text-white text-sm font-bold hover:bg-orange-600 active:scale-95 transition">
                            View Soft Skills
                        </button>
                    </div>

                    <div
                        class="bg-orange-50/50 border border-orange-100 rounded-3xl p-6 hover:shadow-lg transition duration-300 h-[30vh] flex flex-col">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-orange-700 font-bold text-lg">Hard Skills</h3>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @forelse ($mySkills->where('category', 0) as $item)
                                <span
                                    class="px-3 py-1 bg-white border border-orange-200 text-orange-600 rounded-full text-xs font-semibold shadow-sm">
                                    {{ $item->skill->name }}
                                </span>
                            @empty
                                <span class="text-gray-400 text-xs italic py-1">Data belum ada</span>
                            @endforelse
                        </div>
                        <button onclick="toggleModal('hardSkillsModal')"
                            class="mt-auto w-full py-2.5 rounded-xl bg-orange-500 text-white text-sm font-bold hover:bg-orange-600 active:scale-95 transition">
                            View Hard Skills
                        </button>
                    </div>
                </div>
            @endrole

            <div class="lg:col-span-8 space-y-10">
                @role('job_seeker')
                    <section>
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-gray-900 font-bold text-xl flex items-center gap-2">
                                <span class="w-1 h-6 bg-blue-500 rounded-full"></span>
                                Edukasi
                            </h2>
                            <button onclick="toggleModal('addCertModal')"
                                class="group flex items-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-full transition text-sm font-bold">
                                <i class="fas fa-plus"></i> <span class="hidden md:inline">Tambah</span>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            @forelse ($educations as $edu)
                                <div
                                    class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-100 transition group cursor-pointer relative">
                                    <div class="flex gap-4 items-start">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shadow-inner flex-shrink-0 group-hover:scale-110 transition duration-300">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>

                                        <div>
                                            <h4 class="font-bold text-gray-800 text-sm line-clamp-1"
                                                title="{{ $edu->institution_name }}">
                                                {{ $edu->institution_name }}
                                            </h4>

                                            <p class="text-xs text-gray-500 font-medium">
                                                {{ $edu->level }}
                                            </p>

                                            <p class="text-[10px] text-gray-400 mt-1.5 flex items-center gap-1">
                                                <i class="far fa-calendar-alt"></i>
                                                Lulus: {{ $edu->graduation_year ?? 'Sekarang' }}
                                            </p>
                                        </div>

                                        <div
                                            class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition duration-200">
                                            <form action="{{ route('educations.destroy', $edu->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Hapus riwayat pendidikan ini?')"
                                                    class="w-6 h-6 bg-red-50 text-red-500 rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition shadow-sm"
                                                    title="Hapus">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="col-span-1 md:col-span-2 text-center py-8 border border-dashed border-gray-200 rounded-2xl bg-gray-50/50">
                                    <div class="text-gray-300 text-4xl mb-2">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <p class="text-gray-400 text-sm italic">Belum ada riwayat pendidikan ditambahkan.</p>
                                </div>
                            @endforelse

                        </div>
                    </section>

                    <section class="mb-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-gray-900 font-bold text-xl flex items-center gap-2">
                                <span class="w-1 h-6 bg-purple-600 rounded-full"></span>
                                Status Lamaran
                            </h2>
                        </div>

                        {{-- BAGIAN 1: KOTAK STATISTIK (2 Grid: Melamar & Ditolak) --}}
                        <div class="grid grid-cols-2 gap-4 mb-6">

                            {{-- Kotak 1: Total Melamar --}}
                            <div
                                class="bg-white p-5 rounded-[2rem] border border-gray-100 shadow-sm flex flex-col items-center justify-center text-center hover:shadow-md transition group">
                                <div
                                    class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-paper-plane text-xl"></i>
                                </div>
                                <div class="text-3xl font-black text-gray-800">{{ $totalMelamar }}</div>
                                <div class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mt-1">Total Melamar
                                </div>
                            </div>

                            {{-- Kotak 2: Ditolak --}}
                            <div
                                class="bg-white p-5 rounded-[2rem] border border-gray-100 shadow-sm flex flex-col items-center justify-center text-center hover:shadow-md transition group">
                                <div
                                    class="w-12 h-12 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </div>
                                <div class="text-3xl font-black text-gray-800">{{ $totalDitolak }}</div>
                                <div class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mt-1">Ditolak</div>
                            </div>

                        </div>

                        {{-- BAGIAN 2: SECTION DITERIMA (Notification Style) --}}
                        @if ($acceptedApplications->count() > 0)
                            <div class="space-y-4">
                                @foreach ($acceptedApplications as $app)
                                    <div
                                        class="relative w-full bg-gradient-to-r from-teal-500 to-emerald-600 rounded-[2rem] p-6 shadow-lg shadow-teal-500/20 text-white overflow-hidden transform hover:-translate-y-1 transition-all duration-300">

                                        {{-- Dekorasi Background --}}
                                        <div
                                            class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-10 -mt-10 blur-2xl">
                                        </div>
                                        <div
                                            class="absolute bottom-0 left-0 w-24 h-24 bg-black/5 rounded-full -ml-10 -mb-10 blur-xl">
                                        </div>

                                        <div class="relative z-10 flex items-center gap-5">
                                            {{-- Icon Lonceng/Sukses --}}
                                            <div
                                                class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shrink-0 border border-white/30">
                                                <i class="fas fa-party-horn text-2xl animate-pulse"></i> {{-- Atau fa-check-circle --}}
                                            </div>

                                            <div class="flex-1">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <p
                                                            class="text-teal-100 text-[10px] font-bold uppercase tracking-widest mb-1">
                                                            Lamaran Diterima! 🎉
                                                        </p>
                                                        <h3 class="text-xl font-bold leading-tight">
                                                            {{ $app->job->title }}
                                                        </h3>
                                                        <p class="text-sm text-teal-50 font-medium mt-1">
                                                            {{ $app->job->company->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </section>
                @endrole
            </div>
        </div>
        @role('employer')
            <div class="space-y-10 animate-fade-in-up">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-3 flex flex-col md:flex-row justify-between items-end mb-4 gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Dashboard Perusahaan</h2>
                            <p class="text-gray-500">Pantau pelamar dan kelola lowongan pekerjaan Anda.</p>
                        </div>
                        <div class="flex gap-3">
                            @if ($company)
                                <button onclick="toggleModal('edCompanyModal')"
                                    class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                                    <i class="far fa-edit"></i> <span>Edit Perusahaan</span>
                                </button>
                            @else
                                <button onclick="toggleModal('addCompanyModal')"
                                    class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                                    <i class="far fa-add"></i> <span>Tambah Perusahaan</span>
                                </button>
                            @endif

                            <button onclick="toggleModal('addJobsModal')"
                                class="px-5 py-2.5 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition shadow-lg shadow-teal-600/20 flex items-center gap-2">
                                <i class="fas fa-plus"></i> <span>Pasang Lowongan</span>
                            </button>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Lowongan Aktif</p>
                            <h3 class="text-2xl font-extrabold text-gray-900">{{ $myJobs->count() }}</h3>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4">
                        <div
                            class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Pelamar</p>
                            <h3 class="text-2xl font-extrabold text-gray-900">{{ $totalPelamar }}</h3>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4">
                        <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="far fa-bell"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Perlu Review</p>
                            <h3 class="text-2xl font-extrabold text-gray-900">{{ $perluReview }}</h3>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                <span class="w-1 h-6 bg-teal-500 rounded-full"></span>
                                Kelola Lowongan
                            </h3>
                        </div>

                        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                            @forelse ($myJobs as $job)
                                <div
                                    class="p-5 border-b border-gray-50 hover:bg-gray-50 transition flex flex-col sm:flex-row items-center justify-between gap-4">
                                    <div class="flex items-center gap-4 w-full sm:w-auto">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl shadow-sm">
                                            <i class="fas fa-briefcase"></i>
                                        </div>

                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $job->title }}</h4>
                                            <div class="flex flex-wrap items-center gap-2 mt-1">
                                                <span
                                                    class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded text-[10px] font-bold uppercase">
                                                    {{ $job->category }}
                                                </span>
                                                <span class="text-[11px] text-teal-600 font-semibold">
                                                    Rp {{ number_format($job->salary, 0, ',', '.') }}
                                                </span>
                                            </div>

                                            <div class="flex flex-wrap gap-1 mt-2">
                                                @foreach ($job->skills as $skill)
                                                    <span
                                                        class="text-[9px] bg-blue-50 text-blue-500 px-2 py-0.5 rounded-full border border-blue-100">
                                                        {{ $skill->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                                        <a href="{{ route('jobs.applicants', $job->id) }}"
                                            class="px-4 py-2 rounded-xl bg-gray-900 text-white text-xs font-bold hover:bg-gray-800 transition shadow-md inline-block text-center">
                                            Lihat Pelamar
                                        </a>
                                        <button onclick="toggleModal('editJobModal{{ $job->id }}')"
                                            class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition flex items-center justify-center"
                                            title="Edit Lowongan">
                                            <i class="far fa-edit text-xs"></i>
                                        </button>

                                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus lowongan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition flex items-center justify-center"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="p-10 text-center">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png"
                                        class="w-16 h-16 mx-auto opacity-20 mb-4" alt="Empty">
                                    <p class="text-gray-400 text-sm italic">Belum ada lowongan yang dipasang.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2 mb-4">
                                <span class="w-1 h-6 bg-purple-500 rounded-full"></span>
                                Perusahaan Anda
                            </h3>

                            @if ($company)
                                {{-- Tampilan Jika Sudah Ada Data --}}
                                <div
                                    class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden group">
                                    <div
                                        class="absolute top-0 right-0 w-24 h-24 bg-purple-500 rounded-full mix-blend-multiply filter blur-2xl opacity-10">
                                    </div>

                                    <div class="flex items-center gap-4 mb-4">
                                        <div
                                            class="w-14 h-14 bg-white border border-gray-100 rounded-xl shadow-sm flex items-center justify-center">
                                            <i class="fas fa-building text-2xl text-purple-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-lg">{{ $company->company_name }}</h4>
                                            <p class="text-xs text-gray-500">{{ $company->location }}</p>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Email</span>
                                            <span class="text-gray-900 font-semibold">{{ $company->email }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Website</span>
                                            <a href="{{ $company->website }}" target="_blank"
                                                class="text-teal-600 font-semibold hover:underline">
                                                {{ str_replace(['http://', 'https://'], '', $company->website) }}
                                            </a>
                                        </div>
                                        <div class="pt-2">
                                            <p class="text-xs text-gray-500 line-clamp-2 italic">"{{ $company->description }}"
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Tampilan Jika Belum Ada Data --}}
                                <div
                                    class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-3xl p-8 text-center group hover:border-purple-300 transition-all duration-300">
                                    <div
                                        class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-4 text-gray-300 group-hover:text-purple-500 transition-colors">
                                        <i class="fas fa-plus-circle text-3xl"></i>
                                    </div>
                                    <p class="text-gray-500 text-sm mb-4">Anda belum melengkapi profil perusahaan.</p>
                                    <button onclick="toggleModal('addCompanyModal')"
                                        class="px-6 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-bold hover:bg-gray-800 shadow-lg transition">
                                        + Buat Profil Sekarang
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endrole
        @role('admin')
            <div class="space-y-10 animate-fade-in-up">
                <div class="flex flex-col md:flex-row justify-between items-end gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Admin Dashboard</h2>
                        <p class="text-gray-500">Pusat kontrol untuk mengelola seluruh aktivitas platform.</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Users</p>
                            <h3 class="text-2xl font-extrabold text-gray-900">2,450</h3>
                        </div>
                    </div>
                    <div
                        class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                        <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Lowongan Aktif</p>
                            <h3 class="text-2xl font-extrabold text-gray-900">86</h3>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2 mb-6">
                        <span class="w-1 h-6 bg-gray-800 rounded-full"></span>
                        Menu Manajemen
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div
                            class="group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden relative">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110">
                            </div>

                            <div class="p-8 relative z-10">
                                <div
                                    class="w-16 h-16 bg-white border border-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-3xl shadow-sm mb-6 group-hover:bg-blue-600 group-hover:text-white transition duration-300">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Manage User</h4>
                                <p class="text-gray-500 text-sm mb-6 line-clamp-2">
                                    Kelola akun pelamar dan perusahaan. Verifikasi akun baru atau blokir akun bermasalah.
                                </p>
                                <a href="#"
                                    class="inline-flex items-center gap-2 text-blue-600 font-bold text-sm group-hover:gap-3 transition-all">
                                    Kelola Sekarang <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        {{-- Card Manage Jobs --}}
                        <div
                            class="group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden relative">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110">
                            </div>

                            <div class="p-8 relative z-10">
                                <div
                                    class="w-16 h-16 bg-white border border-teal-100 text-teal-600 rounded-2xl flex items-center justify-center text-3xl shadow-sm mb-6 group-hover:bg-teal-600 group-hover:text-white transition duration-300">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Manage Pekerjaan</h4>
                                <p class="text-gray-500 text-sm mb-6 line-clamp-2">
                                    Monitoring lowongan yang tayang. Hapus lowongan yang melanggar aturan atau spam.
                                </p>
                                <a href="#"
                                    class="inline-flex items-center gap-2 text-teal-600 font-bold text-sm group-hover:gap-3 transition-all">
                                    Lihat Lowongan <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="font-bold text-gray-900">User Terbaru</h4>
                            <button class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3 pb-3 border-b border-gray-50 last:border-0 last:pb-0">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold text-sm">
                                    JD
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">John Doe</p>
                                    <p class="text-xs text-gray-400">Job Seeker • Bergabung 2 jam lalu</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 pb-3 border-b border-gray-50 last:border-0 last:pb-0">
                                <div
                                    class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold text-sm">
                                    PT
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">PT Maju Mundur</p>
                                    <p class="text-xs text-gray-400">Employer • Bergabung 5 jam lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endrole
    </main>

    <div id="softSkillsModal" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
            onclick="toggleModal('softSkillsModal')"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg p-6">
                    <div class="flex justify-between items-center mb-4 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900">Soft Skills</h3>
                        <button onclick="toggleModal('softSkillsModal')" class="text-gray-400 hover:text-gray-600"><i
                                class="fas fa-times text-xl"></i></button>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @forelse ($mySkills->where('category', 1) as $item)
                            <div
                                class="pl-4 pr-2 py-2 bg-gray-50 border border-gray-200 text-gray-700 rounded-xl text-sm font-semibold shadow-sm flex items-center gap-2 group hover:border-red-200 hover:bg-red-50/30 transition duration-200">
                                <span>{{ $item->skill->name }}</span>

                                <form action="{{ route('skills.destroy', $item->skill->id) }}" method="POST"
                                    class="flex items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Hapus skill {{ $item->skill->name }}?')"
                                        class="w-6 h-6 rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-100 transition focus:outline-none"
                                        title="Hapus Skill">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <span class="text-gray-400 text-xs italic py-1">Data belum ada</span>
                        @endforelse

                    </div>

                    <form id="addSoftSkillsForm" method="POST" action="{{ route('skills.store') }}"
                        class="mt-6 border-t border-gray-100 pt-4 space-y-4">
                        @csrf
                        @method('POST')
                        <input value="1" class="hidden" type="number" name="category" />
                    </form>

                    <div class="flex gap-4">
                        <button id="addSoftSkillBtn"
                            class="mt-6 w-full py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition shadow-lg shadow-teal-600/20 flex items-center justify-center gap-2">
                            <i class="fas fa-plus"></i> Tambah Soft Skill
                        </button>
                        <button id="saveSoftSkillsBtn"
                            class="hidden mt-6 w-full py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition shadow-lg shadow-teal-600/20 flex items-center justify-center gap-2">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="hardSkillsModal" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
            onclick="toggleModal('hardSkillsModal')"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg p-6">
                    <div class="flex justify-between items-center mb-4 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900">Hard Skills</h3>
                        <button onclick="toggleModal('hardSkillsModal')" class="text-gray-400 hover:text-gray-600"><i
                                class="fas fa-times text-xl"></i></button>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <div class="flex flex-wrap gap-2">
                            @forelse ($mySkills->where('category', 0) as $item)
                                <div
                                    class="pl-4 pr-2 py-2 bg-gray-50 border border-gray-200 text-gray-700 rounded-xl text-sm font-semibold shadow-sm flex items-center gap-2 group hover:border-red-200 hover:bg-red-50/30 transition duration-200">
                                    <span>{{ $item->skill->name }}</span>

                                    <form action="{{ route('skills.destroy', $item->skill->id) }}" method="POST"
                                        class="flex items-center">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Hapus skill {{ $item->skill->name }}?')"
                                            class="w-6 h-6 rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-100 transition focus:outline-none"
                                            title="Hapus Skill">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <span class="text-gray-400 text-xs italic py-1">Data belum ada</span>
                            @endforelse
                        </div>
                    </div>

                    <form id="addHardSkillsForm" method="POST" action="{{ route('skills.store') }}"
                        class="mt-6 border-t border-gray-100 pt-4 space-y-4">
                        @csrf
                        @method('POST')
                        <input value="0" class="hidden" type="number" name="category" />
                    </form>

                    <div class="flex gap-4">
                        <button id="addHardSkillBtn"
                            class="mt-6 w-full py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition shadow-lg shadow-teal-600/20 flex items-center justify-center gap-2">
                            <i class="fas fa-plus"></i> Tambah Hard Skill
                        </button>
                        <button id="saveHardSkillsBtn"
                            class="hidden mt-6 w-full py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition shadow-lg shadow-teal-600/20 flex items-center justify-center gap-2">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addCompanyModal" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
            onclick="toggleModal('addCompanyModal')"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="bg-white p-6 rounded-3xl w-full max-w-lg shadow-2xl transform transition-all relative">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Tambah Profil Perusahaan</h3>
                        <button onclick="toggleModal('addCompanyModal')"
                            class="text-gray-400 hover:text-gray-600 transition">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <form action="{{ route('companies.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 tracking-wide">Nama
                                Perusahaan</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-building text-sm"></i>
                                </div>
                                <input type="text" name="company_name" required
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all duration-200 text-sm placeholder-gray-400"
                                    placeholder="Masukkan nama resmi perusahaan">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 tracking-wide">Email</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                        <i class="fas fa-envelope text-sm"></i>
                                    </div>
                                    <input type="email" name="email" required
                                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all duration-200 text-sm"
                                        placeholder="hrd@perusahaan.com">
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 tracking-wide">Lokasi</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                        <i class="fas fa-map-marker-alt text-sm"></i>
                                    </div>
                                    <input type="text" name="location" required
                                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all duration-200 text-sm"
                                        placeholder="Kota, Negara">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 tracking-wide">Website
                                Resmi</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-globe text-sm"></i>
                                </div>
                                <input type="url" name="website"
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all duration-200 text-sm"
                                    placeholder="https://www.company.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 tracking-wide">Tentang
                                Perusahaan</label>
                            <textarea name="description" rows="4" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 transition-all duration-200 text-sm placeholder-gray-400 resize-none"
                                placeholder="Gambarkan visi, misi, atau bidang usaha perusahaan Anda..."></textarea>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" onclick="toggleModal('addCompanyModal')"
                                class="flex-1 py-3 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition duration-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="flex-[2] py-3 bg-teal-600 text-white rounded-2xl font-bold hover:bg-teal-700 shadow-lg shadow-teal-600/30 transition-all duration-200 active:scale-[0.98]">
                                Daftarkan Perusahaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="addJobsModal" class="fixed inset-0 z-[100] hidden">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
            onclick="toggleModal('addJobsModal')"></div>

        {{-- Modal Content --}}
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                {{-- Lebar modal diperlebar sedikit (max-w-2xl) agar 2 kolom skill muat dengan nyaman --}}
                <div class="bg-white p-6 rounded-3xl w-full max-w-2xl shadow-2xl transform transition-all relative">

                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Pasang Lowongan Pekerjaan</h3>
                        <button onclick="toggleModal('addJobsModal')"
                            class="text-gray-400 hover:text-gray-600 transition">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    {{-- Form --}}
                    <form id="addJobsForm" action="{{ route('jobs.store') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Row 1: Judul & Kategori --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Judul
                                    Pekerjaan</label>
                                <input type="text" name="title" required
                                    class="w-full p-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-500/20 transition"
                                    placeholder="Contoh: Web Developer">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Kategori</label>
                                <input type="text" name="category" required
                                    class="w-full p-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-500/20 transition"
                                    placeholder="Contoh: Freelance">
                            </div>
                        </div>

                        {{-- Row 2: SKILLS (SPLIT SECTION) --}}
                        <div class="p-4 bg-gray-50 border border-gray-100 rounded-2xl">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                {{-- Kolom 1: Hard Skills --}}
                                <div>
                                    <label
                                        class="block text-xs font-bold text-teal-700 uppercase mb-2 flex items-center gap-2">
                                        <i class="fas fa-code"></i> Hard Skills (Teknis)
                                    </label>
                                    <div id="hardSkillsContainer" class="space-y-2 mb-2">
                                        {{-- Input default pertama --}}
                                        <input type="text" name="hard_skills[]" placeholder="Ex: PHP, Python"
                                            class="w-full p-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-teal-500 transition">
                                    </div>
                                    <button type="button"
                                        onclick="addSkillInput('hardSkillsContainer', 'hard_skills[]', 'Ex: HTML, CSS')"
                                        class="text-xs font-bold text-teal-600 hover:text-teal-800 flex items-center gap-1 py-1">
                                        <i class="fas fa-plus"></i> Tambah Hard Skill
                                    </button>
                                </div>

                                {{-- Kolom 2: Soft Skills --}}
                                <div>
                                    <label
                                        class="block text-xs font-bold text-orange-600 uppercase mb-2 flex items-center gap-2">
                                        <i class="fas fa-users"></i> Soft Skills (Personal)
                                    </label>
                                    <div id="softSkillsContainer" class="space-y-2 mb-2">
                                        {{-- Input default pertama --}}
                                        <input type="text" name="soft_skills[]" placeholder="Ex: Komunikasi, Teamwork"
                                            class="w-full p-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-orange-400 transition">
                                    </div>
                                    <button type="button"
                                        onclick="addSkillInput('softSkillsContainer', 'soft_skills[]', 'Ex: Kepemimpinan')"
                                        class="text-xs font-bold text-orange-500 hover:text-orange-700 flex items-center gap-1 py-1">
                                        <i class="fas fa-plus"></i> Tambah Soft Skill
                                    </button>
                                </div>

                            </div>
                        </div>

                        {{-- Row 3: Gaji --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 tracking-wide">Gaji /
                                Bulan</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <span class="text-xs font-bold">Rp</span>
                                </div>
                                <input type="number" name="salary" required
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition text-sm"
                                    placeholder="5000000">
                            </div>
                        </div>

                        {{-- Row 4: Deskripsi --}}
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 tracking-wide">Deskripsi
                                Pekerjaan</label>
                            <textarea name="description" rows="3" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 transition text-sm resize-none"
                                placeholder="Tuliskan detail pekerjaan..."></textarea>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex gap-3 pt-2">
                            <button type="button" onclick="toggleModal('addJobsModal')"
                                class="flex-1 py-3 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition">Batal</button>
                            <button type="submit"
                                class="flex-[2] py-3 bg-teal-600 text-white rounded-2xl font-bold hover:bg-teal-700 shadow-lg shadow-teal-600/30 transition transform hover:-translate-y-0.5">
                                Tayangkan Lowongan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @forelse ($myJobs as $job)
        <div id="editJobModal{{ $job->id }}" class="fixed inset-0 z-[100] hidden">
            {{-- Backdrop --}}
            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                onclick="toggleModal('editJobModal{{ $job->id }}')"></div>

            {{-- Modal Content --}}
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4">
                    <div class="bg-white p-6 rounded-3xl w-full max-w-2xl shadow-2xl transform transition-all relative">

                        {{-- Header --}}
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Edit Lowongan: {{ $job->title }}</h3>
                            <button onclick="toggleModal('editJobModal{{ $job->id }}')"
                                class="text-gray-400 hover:text-gray-600 transition">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>

                        {{-- Form --}}
                        <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')

                            {{-- Row 1: Judul & Kategori --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Judul
                                        Pekerjaan</label>
                                    <input type="text" name="title" value="{{ $job->title }}" required
                                        class="w-full p-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:border-teal-500 focus:bg-white outline-none transition">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Kategori</label>
                                    <input type="text" name="category" value="{{ $job->category }}" required
                                        class="w-full p-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:border-teal-500 focus:bg-white outline-none transition">
                                </div>
                            </div>

                            {{-- Row 2: SKILLS (Pre-filled Data) --}}
                            <div class="p-4 bg-gray-50 border border-gray-100 rounded-2xl">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    {{-- Kolom 1: Hard Skills --}}
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-teal-700 uppercase mb-2 flex items-center gap-2">
                                            <i class="fas fa-code"></i> Hard Skills
                                        </label>
                                        {{-- Perhatikan ID unik: hardSkillsContainer_{{ $job->id }} --}}
                                        <div id="hardSkillsContainer_{{ $job->id }}" class="space-y-2 mb-2">
                                            {{-- Loop Hard Skills yang sudah ada (Category False/0) --}}
                                            @foreach ($job->skills->where('pivot.category', false) as $skill)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="hard_skills[]"
                                                        value="{{ $skill->name }}"
                                                        class="w-full p-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-teal-500 transition">
                                                    <button type="button"
                                                        class="text-gray-400 hover:text-red-500 transition px-1"
                                                        onclick="this.parentElement.remove()">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button"
                                            onclick="addSkillInput('hardSkillsContainer_{{ $job->id }}', 'hard_skills[]', 'Ex: HTML')"
                                            class="text-xs font-bold text-teal-600 hover:text-teal-800 flex items-center gap-1 py-1">
                                            <i class="fas fa-plus"></i> Tambah Hard Skill
                                        </button>
                                    </div>

                                    {{-- Kolom 2: Soft Skills --}}
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-orange-600 uppercase mb-2 flex items-center gap-2">
                                            <i class="fas fa-users"></i> Soft Skills
                                        </label>
                                        <div id="softSkillsContainer_{{ $job->id }}" class="space-y-2 mb-2">
                                            {{-- Loop Soft Skills yang sudah ada (Category True/1) --}}
                                            @foreach ($job->skills->where('pivot.category', true) as $skill)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="soft_skills[]"
                                                        value="{{ $skill->name }}"
                                                        class="w-full p-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-orange-400 transition">
                                                    <button type="button"
                                                        class="text-gray-400 hover:text-red-500 transition px-1"
                                                        onclick="this.parentElement.remove()">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button"
                                            onclick="addSkillInput('softSkillsContainer_{{ $job->id }}', 'soft_skills[]', 'Ex: Komunikasi')"
                                            class="text-xs font-bold text-orange-500 hover:text-orange-700 flex items-center gap-1 py-1">
                                            <i class="fas fa-plus"></i> Tambah Soft Skill
                                        </button>
                                    </div>

                                </div>
                            </div>

                            {{-- Row 3: Gaji --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Gaji /
                                    Bulan</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                        <span class="text-xs font-bold">Rp</span>
                                    </div>
                                    <input type="number" name="salary" value="{{ $job->salary }}" required
                                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:border-teal-500 focus:bg-white outline-none transition">
                                </div>
                            </div>

                            {{-- Row 4: Deskripsi --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Deskripsi</label>
                                <textarea name="description" rows="4" required
                                    class="w-full p-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:border-teal-500 focus:bg-white outline-none resize-none">{{ $job->description }}</textarea>
                            </div>

                            {{-- Footer --}}
                            <div class="flex gap-3 pt-2">
                                <button type="button" onclick="toggleModal('editJobModal{{ $job->id }}')"
                                    class="flex-1 py-3 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition">Batal</button>
                                <button type="submit"
                                    class="flex-[2] py-3 bg-teal-600 text-white rounded-2xl font-bold hover:bg-teal-700 shadow-lg transition">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        {{-- Handle jika tidak ada job --}}
    @endforelse

    {{-- Pastikan Javascript ini ada di luar loop --}}
    <script>
        function addSkillInput(containerId, inputName, placeholderText) {
            const container = document.getElementById(containerId);
            const wrapper = document.createElement('div');
            wrapper.className = 'flex items-center gap-2 animate-fadeIn mt-2';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = inputName;
            input.placeholder = placeholderText;
            input.className =
                'w-full p-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-teal-500 transition';

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'text-gray-400 hover:text-red-500 transition px-1';
            removeBtn.innerHTML = '<i class="fas fa-times"></i>';
            removeBtn.onclick = function() {
                wrapper.remove();
            };

            wrapper.appendChild(input);
            wrapper.appendChild(removeBtn);
            container.appendChild(wrapper);
        }
    </script>
    </div>
    </div>

    <div id="edCompanyModal" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
            onclick="toggleModal('edCompanyModal')"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="bg-white p-6 rounded-3xl w-full max-w-lg shadow-2xl transform transition-all relative">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Edit Profil Perusahaan</h3>
                        <button onclick="toggleModal('edCompanyModal')"
                            class="text-gray-400 hover:text-gray-600 transition">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <form action="{{ route('companies.update', $company->id ?? 0) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Nama
                                Perusahaan</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-building text-sm"></i>
                                </div>
                                <input type="text" name="company_name" value="{{ $company->company_name ?? '' }}"
                                    required
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 transition text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Email</label>
                                <input type="email" name="email" value="{{ $company->email ?? '' }}" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 transition text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Lokasi</label>
                                <input type="text" name="location" value="{{ $company->location ?? '' }}" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 transition text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Website</label>
                            <input type="url" name="website" value="{{ $company->website ?? '' }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 transition text-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Deskripsi</label>
                            <textarea name="description" rows="4" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:border-teal-500 transition text-sm resize-none">{{ $company->description ?? '' }}</textarea>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 shadow-lg transition">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="certModal" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" onclick="toggleModal('certModal')">
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-lg p-6">
                    <button onclick="toggleModal('certModal')"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><i
                            class="fas fa-times text-xl"></i></button>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Certifications</h3>
                    @for ($i = 0; $i < 3; $i++)
                        <div class="p-2 border-b">Cert Content {{ $i }}</div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <div id="addCertModal" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
            onclick="toggleModal('addCertModal')"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="bg-white p-6 rounded-3xl w-full max-w-lg shadow-2xl transform transition-all">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Tambah Riwayat Edukasi</h3>
                        <button onclick="toggleModal('addCertModal')"
                            class="text-gray-400 hover:text-gray-600 transition">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <form action="{{ route('educations.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Jenjang Pendidikan</label>
                            <div class="relative">
                                <select name="level" required
                                    class="w-full appearance-none rounded-xl border-gray-200 focus:border-teal-500 focus:ring-teal-500 p-3 bg-gray-50 text-gray-800 text-sm transition">
                                    <option value="" disabled selected>Pilih Jenjang</option>
                                    <option value="SMA/SMK">SMA / SMK</option>
                                    <option value="D3">D3 (Diploma)</option>
                                    <option value="S1">S1 (Sarjana)</option>
                                    <option value="S2">S2 (Magister)</option>
                                    <option value="S3">S3 (Doktor)</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Institusi /
                                Sekolah</label>
                            <input type="text" name="institution_name" required maxlength="150"
                                class="w-full rounded-xl border-gray-200 focus:border-teal-500 focus:ring-teal-500 p-3 bg-gray-50 text-gray-800 text-sm transition placeholder-gray-400"
                                placeholder="Contoh: Universitas Indonesia">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Tahun Lulus
                                (Opsional)</label>
                            <input type="number" name="graduation_year" min="1900" max="{{ date('Y') + 5 }}"
                                class="w-full rounded-xl border-gray-200 focus:border-teal-500 focus:ring-teal-500 p-3 bg-gray-50 text-gray-800 text-sm transition placeholder-gray-400"
                                placeholder="Contoh: 2024">
                        </div>
                        <div class="pt-2">
                            <button type="submit"
                                class="w-full py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition shadow-lg shadow-teal-600/20 flex items-center justify-center gap-2">
                                <i class="fas fa-save"></i> Simpan Pendidikan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="edProfModal" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
            onclick="toggleModal('edProfModal')"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-lg p-6">
                    <div class="flex justify-between items-center mb-4 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900">Edit Profile</h3>
                        <button onclick="toggleModal('edProfModal')" class="text-gray-400 hover:text-gray-600"><i
                                class="fas fa-times text-xl"></i></button>
                    </div>
                    <div class="space-y-3 max-h-[60vh] overflow-y-auto pr-2">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-col gap-4 items-center p-3">
                                <input type="text" value="{{ $user->full_name }}" name="full_name"
                                    class="w-full focus:border-blue-200 focus:ring-0 focus:outline-none p-4 bg-transparent text-gray-800 bg-gray-50 rounded-xl border border-gray-100 group hover:border-blue-200 transition"
                                    placeholder="Nama Lengkap">
                                <input type="text" value="{{ $user->bio }}" name="bio"
                                    class="w-full focus:border-blue-200 focus:ring-0 focus:outline-none p-4 bg-transparent text-gray-800 bg-gray-50 rounded-xl border border-gray-100 group hover:border-blue-200 transition"
                                    placeholder="Biodata">
                                <div class="flex gap-4">
                                    <input type="text" value="{{ $user->address }}" name="address"
                                        class="w-full focus:border-blue-200 focus:ring-0 focus:outline-none p-4 bg-transparent text-gray-800 bg-gray-50 rounded-xl border border-gray-100 group hover:border-blue-200 transition"
                                        placeholder="Kota">
                                    <input type="text" value="{{ $user->region }}" name="region"
                                        class="w-full focus:border-blue-200 focus:ring-0 focus:outline-none p-4 bg-transparent text-gray-800 bg-gray-50 rounded-xl border border-gray-100 group hover:border-blue-200 transition"
                                        placeholder="Negara">
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full mt-6 py-3 bg-teal-600 text-white rounded-xl font-bold hover:bg-teal-700 transition shadow-lg shadow-teal-600/20 flex items-center justify-center gap-2">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="resumeModal" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
            onclick="toggleModal('resumeModal')"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="bg-white p-8 rounded-3xl w-full max-w-lg shadow-2xl transform transition-all relative">

                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Upload Resume</h3>
                            <p class="text-sm text-gray-500 mt-1">Format PDF, DOC, atau DOCX (Max 2MB)</p>
                        </div>
                        <button onclick="toggleModal('resumeModal')" class="text-gray-400 hover:text-gray-600 transition">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <form action="{{ route('resume.store') }}" method="POST" enctype="multipart/form-data"
                        id="resumeForm">
                        @csrf

                        <div id="dropZone"
                            class="w-full h-64 border-2 border-dashed border-gray-300 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 hover:border-teal-500 transition duration-300 group relative overflow-hidden">

                            <input type="file" name="resume" id="fileInput"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.doc,.docx">

                            <div id="dropContent" class="text-center p-6 transition-all duration-300">
                                <div
                                    class="w-16 h-16 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition duration-300">
                                    <i class="fas fa-cloud-upload-alt text-3xl"></i>
                                </div>
                                <h4 class="text-gray-700 font-bold mb-1">Click to upload</h4>
                                <p class="text-gray-400 text-sm">or drag and drop your file here</p>
                            </div>

                            <div id="fileSuccess" class="hidden text-center p-6">
                                <div
                                    class="w-16 h-16 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-check text-3xl"></i>
                                </div>
                                <h4 class="text-gray-800 font-bold mb-1 break-all" id="fileNameDisplay">filename.pdf</h4>
                                <p class="text-green-600 text-sm font-semibold">File Selected</p>
                                <button type="button" id="removeFileBtn"
                                    class="mt-3 text-red-500 text-xs font-bold hover:underline z-20 relative">
                                    Ganti File
                                </button>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                class="w-full py-3.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition shadow-lg flex items-center justify-center gap-2">
                                <span>Simpan Resume</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script>
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const dropContent = document.getElementById('dropContent');
        const fileSuccess = document.getElementById('fileSuccess');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const removeFileBtn = document.getElementById('removeFileBtn');

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.add('bg-teal-50', 'border-teal-500');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.remove('bg-teal-50', 'border-teal-500');
            }, false);
        });

        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                fileInput.files = files;
                updateFileDisplay(files[0].name);
            }
        });

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                updateFileDisplay(this.files[0].name);
            }
        });

        function updateFileDisplay(name) {
            dropContent.classList.add('hidden');
            fileSuccess.classList.remove('hidden');
            fileNameDisplay.textContent = name;
        }

        if (removeFileBtn) {
            removeFileBtn.addEventListener('click', function(e) {
                e.preventDefault();
                fileInput.value = '';
                dropContent.classList.remove('hidden');
                fileSuccess.classList.add('hidden');
            });
        }
    </script>

    <script>
        function toggleModal(modalID) {
            document.getElementById(modalID).classList.toggle("hidden");
        }

        function setupSkillForm(btnId, saveBtnId, formId) {
            const button = document.getElementById(btnId);
            const saveButton = document.getElementById(saveBtnId);
            const form = document.getElementById(formId);

            if (button && form && saveButton) {
                button.addEventListener('click', function() {
                    saveButton.classList.remove('hidden');

                    const wrapper = document.createElement('div');
                    wrapper.className = "flex items-center gap-2 mb-3 animate-fade-in-up";

                    const input = document.createElement('input');
                    input.type = "text";
                    input.name = "new_skills[]";
                    input.placeholder = "Tulis nama skill...";
                    input.className =
                        "flex-1 focus:border-teal-500 focus:ring-teal-500 p-3 bg-gray-50 rounded-xl border border-gray-200 text-gray-800 text-sm transition placeholder-gray-400";

                    const removeBtn = document.createElement('button');
                    removeBtn.type = "button";
                    removeBtn.className =
                        "w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 flex items-center justify-center transition border border-red-100";
                    removeBtn.innerHTML = '<i class="fas fa-trash-alt text-sm"></i>';

                    removeBtn.addEventListener('click', function() {
                        wrapper.remove();

                        if (form.childElementCount === 1) {
                            saveButton.classList.add('hidden');
                        }
                    });

                    wrapper.appendChild(input);
                    wrapper.appendChild(removeBtn);
                    form.appendChild(wrapper);

                    input.focus();
                });

                saveButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    form.submit();
                });
            }
        }

        setupSkillForm('addSoftSkillBtn', 'saveSoftSkillsBtn', 'addSoftSkillsForm');

        setupSkillForm('addHardSkillBtn', 'saveHardSkillsBtn', 'addHardSkillsForm');

        function setupJobRequirements() {
            const btn = document.getElementById('addRequirementBtn');
            const container = document.getElementById('skillInputsContainer');

            if (btn && container) {
                btn.addEventListener('click', function() {
                    const wrapper = document.createElement('div');
                    wrapper.className = "flex items-center gap-2 animate-fade-in-up";

                    const input = document.createElement('input');
                    input.type = "text";
                    input.name = "requirements[]";
                    input.placeholder = "Contoh: Laravel, React, atau Figma...";
                    input.className =
                        "flex-1 focus:border-teal-500 focus:ring-teal-500 p-3 bg-gray-50 rounded-xl border border-gray-200 text-gray-800 text-sm transition";

                    const removeBtn = document.createElement('button');
                    removeBtn.type = "button";
                    removeBtn.className =
                        "w-11 h-11 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition border border-red-100";
                    removeBtn.innerHTML = '<i class="fas fa-trash-alt text-sm"></i>';

                    removeBtn.addEventListener('click', function() {
                        wrapper.remove();
                    });

                    wrapper.appendChild(input);
                    wrapper.appendChild(removeBtn);
                    container.appendChild(wrapper);

                    input.focus();
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            setupJobRequirements();
        });
    </script>

    <script>
        function addSkillInput(containerId, inputName, placeholderText) {
            const container = document.getElementById(containerId);

            const wrapper = document.createElement('div');
            wrapper.className = 'flex items-center gap-2 animate-fadeIn';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = inputName;
            input.placeholder = placeholderText;
            input.className =
                'w-full p-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-teal-500 transition';

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'text-gray-400 hover:text-red-500 transition px-1';
            removeBtn.innerHTML = '<i class="fas fa-times"></i>';
            removeBtn.onclick = function() {
                wrapper.remove();
            };

            wrapper.appendChild(input);
            wrapper.appendChild(removeBtn);
            container.appendChild(wrapper);
        }
    </script>
@endsection
