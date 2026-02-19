@extends('layouts.app')

@include('layouts.head')

@include('layouts.nav')


@section('content')
    <div
        class="fixed top-0 w-full h-[350px] bg-gradient-to-b from-teal-50 via-orange-50/30 to-white -z-10 rounded-b-[3rem] md:rounded-b-[5rem]">
    </div>

    <main class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 md:pt-16 pb-24 relative">

        <div class="text-center max-w-3xl mx-auto mb-16">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-100/50 text-teal-700 text-[10px] font-bold uppercase tracking-widest mb-6">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-teal-500"></span>
                </span>
                Tersedia {{ $jobs->total() }} Peluang Baru
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                Temukan Karir <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-teal-400">Impianmu</span>
            </h1>
            <p class="text-gray-500 text-base md:text-lg mb-10 leading-relaxed max-w-2xl mx-auto">
                Platform pencarian kerja berbasis skill untuk menghubungkan talenta terbaik dengan perusahaan visioner.
            </p>

            <form action="{{ route('jobs.index') }}" method="GET" class="relative z-10 group">
                <div
                    class="bg-white p-2 md:p-3 rounded-[2.5rem] shadow-2xl shadow-teal-900/5 border border-white/50 flex flex-col md:flex-row gap-3">

                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 group-focus-within:text-teal-500 transition-colors"></i>
                        </div>
                        <input type="text" name="q" value="{{ request('q') }}"
                            class="block w-full pl-12 pr-4 py-4 border-none rounded-2xl bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:ring-0 focus:bg-white transition text-sm font-medium"
                            placeholder="Cari posisi atau perusahaan...">
                    </div>

                    <div class="relative min-w-[180px]">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                            <i class="fas fa-filter text-gray-400"></i>
                        </div>
                        <select name="sort" onchange="this.form.submit()"
                            class="block w-full pl-12 pr-10 py-4 border-none rounded-2xl bg-gray-50/50 text-gray-700 focus:ring-0 focus:bg-white appearance-none cursor-pointer transition text-sm font-bold tracking-tight">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="salary_high" {{ request('sort') == 'salary_high' ? 'selected' : '' }}>Gaji
                                Tertinggi</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>

                    <button type="submit"
                        class="px-8 py-4 bg-gray-900 text-white font-bold rounded-2xl hover:bg-teal-600 transition-all duration-300 shadow-lg shadow-gray-900/10 active:scale-95">
                        Cari Lowongan
                    </button>
                </div>
            </form>
        </div>

        @if (isset($recommendedJobs) && $recommendedJobs->count() > 0 && !request('q'))
            <div class="mb-20">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600 shadow-sm shadow-orange-200">
                            <i class="fas fa-magic"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Rekomendasi Pintar</h2>
                            <p class="text-xs text-gray-500 font-medium">Berdasarkan keahlian unik di profilmu</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($recommendedJobs as $job)
                        <a href="{{ route('jobs.show', $job->id) }}"
                            class="group block relative bg-white rounded-[2.5rem] p-8 border border-gray-100 hover:border-teal-200 hover:shadow-2xl hover:shadow-teal-900/5 transition-all duration-500">
                            <div class="absolute top-6 right-6">
                                <div class="flex flex-col items-end gap-2">
                                    <span
                                        class="px-3 py-1 bg-teal-50 text-teal-600 text-[10px] font-bold uppercase tracking-widest rounded-full border border-teal-100">
                                        98% Match
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-col h-full">
                                <div
                                    class="w-16 h-16 rounded-2xl bg-gray-50 text-gray-800 border border-gray-100 flex items-center justify-center text-2xl font-black shadow-sm group-hover:bg-teal-600 group-hover:text-white transition-all duration-300 mb-6">
                                    {{ substr($job->company->company_name ?? 'C', 0, 1) }}
                                </div>

                                <h3
                                    class="font-bold text-xl text-gray-900 group-hover:text-teal-600 transition-colors mb-2 line-clamp-1">
                                    {{ $job->title }}
                                </h3>
                                <p class="text-sm text-gray-500 font-medium mb-6">
                                    {{ $job->company->company_name ?? 'Confidential' }}
                                </p>

                                <div class="flex flex-wrap gap-2 mb-8">
                                    @foreach ($job->skills->take(2) as $skill)
                                        <span
                                            class="px-3 py-1 bg-gray-50 rounded-lg text-[10px] text-gray-600 font-bold uppercase tracking-tight border border-gray-100">
                                            {{ $skill->name }}
                                        </span>
                                    @endforeach
                                </div>

                                <div class="flex items-center justify-between mt-auto pt-5 border-t border-gray-50">
                                    <div class="text-teal-600 font-extrabold text-sm">
                                        Rp {{ number_format($job->salary, 0, ',', '.') }}
                                    </div>
                                    <div class="text-[10px] text-gray-400 font-medium">
                                        {{ $job->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- 3. ALL JOBS LIST (List Layout) --}}
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center justify-between mb-8 px-2">
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ request('q') ? 'Hasil Pencarian' : 'Semua Lowongan' }}
                </h2>
                <span
                    class="text-[10px] font-bold text-gray-500 bg-gray-100 px-3 py-1 rounded-full uppercase tracking-widest">
                    {{ $jobs->total() }} Posisi Tersedia
                </span>
            </div>

            <div class="space-y-4">
                @forelse($jobs as $job)
                    <a href="{{ route('jobs.show', $job->id) }}"
                        class="block bg-white rounded-[2rem] p-5 md:p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:border-teal-100 transition-all duration-300 group">

                        <div class="flex flex-col md:flex-row md:items-center gap-6">

                            <div class="flex items-start gap-5 flex-1">
                                <div
                                    class="w-14 h-14 md:w-16 md:h-16 shrink-0 rounded-2xl bg-gray-50 text-gray-900 flex items-center justify-center text-2xl font-black shadow-inner group-hover:bg-teal-600 group-hover:text-white transition-all duration-300">
                                    {{ substr($job->company->company_name ?? 'C', 0, 1) }}
                                </div>

                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <span
                                            class="px-2 py-0.5 rounded-md bg-orange-50 text-orange-600 text-[9px] font-bold uppercase tracking-widest border border-orange-100">
                                            {{ $job->category }}
                                        </span>
                                        @if ($job->created_at->diffInDays() <= 3)
                                            <span
                                                class="px-2 py-0.5 rounded-md bg-teal-50 text-teal-600 text-[9px] font-bold uppercase tracking-widest border border-teal-100">
                                                New
                                            </span>
                                        @endif
                                    </div>

                                    <h3
                                        class="text-lg md:text-xl font-bold text-gray-900 group-hover:text-teal-600 transition-colors mb-1">
                                        {{ $job->title }}
                                    </h3>

                                    <div class="flex flex-wrap items-center text-sm text-gray-500 gap-y-1 gap-x-4">
                                        <span
                                            class="font-semibold text-gray-700">{{ $job->company->company_name ?? 'Perusahaan' }}</span>
                                        <div class="flex items-center gap-1.5 text-teal-600 font-bold">
                                            <i class="fas fa-wallet text-[10px]"></i>
                                            Rp {{ number_format($job->salary, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex flex-row md:flex-col justify-between items-center md:items-end w-full md:w-auto mt-4 md:mt-0 pt-4 md:pt-0 border-t md:border-t-0 border-gray-50 gap-4">
                                <div class="text-left md:text-right">
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">
                                        Diposting</div>
                                    <div class="text-xs font-bold text-gray-600">
                                        {{ $job->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-50 text-gray-400 flex items-center justify-center group-hover:bg-gray-900 group-hover:text-white transition-all duration-300 transform group-hover:translate-x-1">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </div>
                            </div>

                        </div>
                    </a>
                @empty
                    <div class="text-center py-24 bg-white rounded-[3rem] border border-dashed border-gray-200">
                        <div
                            class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                            <i class="fas fa-search-minus text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pencarian tidak ditemukan</h3>
                        <p class="text-gray-500 max-w-xs mx-auto">Kami tidak dapat menemukan lowongan yang sesuai dengan
                            kata kunci tersebut.</p>
                        <a href="{{ route('jobs.index') }}"
                            class="mt-8 inline-flex items-center gap-2 px-8 py-3 bg-gray-900 text-white rounded-2xl text-sm font-bold hover:bg-teal-600 transition-all active:scale-95 shadow-xl shadow-gray-900/10">
                            <i class="fas fa-undo text-xs"></i>
                            Reset Pencarian
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-16 flex justify-center">
                {{ $jobs->withQueryString()->links() }}
            </div>
        </div>

    </main>
@endsection
