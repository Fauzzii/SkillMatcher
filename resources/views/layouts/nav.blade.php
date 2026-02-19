<nav class="w-full py-5 px-6 flex justify-between items-center relative z-50 h-[12vh] bg-white sticky top-0">
    <a href="{{ url('/') }}" class="text-2xl font-extrabold tracking-tighter text-gray-800 flex items-center gap-2">
        <div
            class="w-8 h-8 bg-gradient-to-br from-teal-400 to-teal-600 rounded-lg flex items-center justify-center text-white text-sm shadow-teal-500/30 shadow-lg">
            <i class="fas fa-layer-group"></i>
        </div>
        SkillMatcher
    </a>

    <div class="flex gap-8 text-sm font-semibold text-gray-500">
        <a href="/" class="hover:text-teal-600 transition">Home</a>
        @role('job_seeker')
            <a href="{{ route('jobs.index') }}" class="hover:text-teal-600 transition">Jobs</a>
            <a href="{{ route('chatbot.show') }}" class="hover:text-teal-600 transition">Consultation</a>
        @endrole
    </div>

    <div class="flex items-center gap-4">

        @guest
            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-teal-600 transition px-2">
                Masuk
            </a>

            <a href="{{ route('register') }}"
                class="px-5 py-2.5 bg-gray-900 text-white text-xs font-bold rounded-full hover:bg-gray-800 transition shadow-lg hover:-translate-y-0.5 transform duration-200">
                Daftar
            </a>
        @endguest

        @auth
            <span class="hidden md:block text-xs font-bold text-gray-500 mr-2">
                Hi, {{ Auth::user()->full_name }}
            </span>

            <div class="relative group">
                <a href="{{ route('profile') }}"> <button
                        class="bg-teal-600 rounded-full w-10 h-10 flex items-center justify-center hover:bg-teal-700 transition shadow-md border-2 border-white ring-2 ring-teal-100">
                        <span class="text-white font-bold text-sm">
                            {{ substr(Auth::user()->full_name, 0, 1) }}
                        </span>
                    </button>
                </a>
            </div>
        @endauth

    </div>
</nav>
