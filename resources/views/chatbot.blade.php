@extends('layouts.app')

@section('content')
    <div class="fixed inset-0 bg-[#F0F4F8] z-50 flex flex-col font-sans">
        <div class="bg-white h-16 shadow-sm border-b border-gray-200 px-6 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-4">
                <a href="/" class="group flex items-center gap-2 text-gray-500 hover:text-[#2D9B91] transition-colors duration-200">
                    <div class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-[#E0F7F9] flex items-center justify-center transition-colors">
                        <i class="fas fa-arrow-left text-sm"></i>
                    </div>
                    <span class="font-medium text-sm hidden sm:block">Kembali</span>
                </a>

                <div class="h-6 w-px bg-gray-300 mx-2"></div>

                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#2D9B91] to-[#1A7F76] rounded-full flex items-center justify-center text-white shadow-md">
                            <i class="fas fa-robot text-lg"></i>
                        </div>
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-800 text-lg leading-tight">Career Buddy</h1>
                        <p class="text-xs text-[#2D9B91] font-medium">Asisten Karir Cerdas AI</p>
                    </div>
                </div>
            </div>

            <div>
                <button onclick="location.reload()" class="text-gray-400 hover:text-[#2D9B91] p-2 transition" title="Refresh Sesi">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>

        <div id="chat-content" class="flex-1 overflow-y-auto p-6 scroll-smooth">
            <div class="max-w-4xl mx-auto space-y-6">
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-[#2D9B91] flex-shrink-0 flex items-center justify-center text-white mt-1 shadow-sm">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="bg-white p-5 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 max-w-[85%] text-gray-700 leading-relaxed">
                        <h3 class="font-bold text-[#2D9B91] text-sm mb-1">Career Buddy</h3>
                        <p>Halo! 👋 Saya siap membantu mencocokkan skill kamu dengan lowongan kerja yang tersedia.</p>
                        <p class="mt-2 text-sm text-gray-500">Coba tanya: <em>"Ada lowongan yang cocok buat aku ga?"</em></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 border-t border-gray-200 shrink-0">
            <div class="max-w-4xl mx-auto">
                <div class="relative flex items-center gap-3 bg-gray-50 border border-gray-300 rounded-full px-2 py-2 shadow-sm focus-within:ring-2 focus-within:ring-[#2D9B91] focus-within:border-[#2D9B91] transition-all duration-300">
                    <div class="pl-3 text-gray-400">
                        <i class="fas fa-keyboard"></i>
                    </div>
                    <input type="text" id="user-input" 
                        class="w-full bg-transparent border-none focus:ring-0 text-gray-700 placeholder-gray-400 h-10"
                        placeholder="Ketik pertanyaan karirmu di sini..." 
                        autocomplete="off">
                    <button onclick="sendMessage()" id="send-btn" class="bg-[#2D9B91] hover:bg-[#237a72] text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md transition-transform transform active:scale-95 duration-200">
                        <i class="fas fa-paper-plane text-sm ml-0.5"></i>
                    </button>
                </div>
                <div class="text-center mt-2">
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Powered by Gemini AI • Confidential Chat</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <script>
        const inputField = document.getElementById('user-input');
        const chatContent = document.getElementById('chat-content');
        const chatContainer = chatContent.querySelector('.max-w-4xl');

        document.addEventListener('DOMContentLoaded', () => {
            inputField.focus();
        });

        function scrollToBottom() {
            chatContent.scrollTo({
                top: chatContent.scrollHeight,
                behavior: 'smooth'
            });
        }

        async function sendMessage() {
            const userMsg = inputField.value.trim();
            if (!userMsg) return;

            inputField.value = '';
            
            const userHtml = `
            <div class="flex justify-end gap-4 animate-fade-in-up">
                <div class="bg-[#2D9B91] p-4 rounded-2xl rounded-tr-none shadow-md max-w-[85%] text-white leading-relaxed text-sm md:text-base">
                    ${userMsg.replace(/</g, "&lt;").replace(/>/g, "&gt;")}
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center text-gray-500 mt-1">
                    <i class="fas fa-user"></i>
                </div>
            </div>`;
            
            chatContainer.insertAdjacentHTML('beforeend', userHtml);
            scrollToBottom();

            const loadingId = 'loading-' + Date.now();
            const loadingHtml = `
            <div id="${loadingId}" class="flex gap-4 animate-pulse">
                <div class="w-10 h-10 rounded-full bg-[#2D9B91] flex-shrink-0 flex items-center justify-center text-white mt-1 shadow-sm">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 flex items-center gap-2">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                    <span class="text-xs text-gray-400 font-medium">Sedang berpikir...</span>
                </div>
            </div>`;

            chatContainer.insertAdjacentHTML('beforeend', loadingHtml);
            scrollToBottom();

            try {
                const response = await fetch("{{ route('chatbot.consult') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: userMsg })
                });

                document.getElementById(loadingId)?.remove();

                if (!response.ok) throw new Error("Gagal menghubungi server");

                const data = await response.json();
                
                const replyText = typeof marked !== 'undefined' ? marked.parse(data.reply) : data.reply;

                const aiHtml = `
                <div class="flex gap-4 animate-fade-in">
                    <div class="w-10 h-10 rounded-full bg-[#2D9B91] flex-shrink-0 flex items-center justify-center text-white mt-1 shadow-sm">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="bg-white p-5 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 max-w-[85%] text-gray-800 leading-relaxed prose prose-sm prose-teal">
                        <h3 class="font-bold text-[#2D9B91] text-sm mb-2">Career Buddy</h3>
                        ${replyText}
                    </div>
                </div>`;
                
                chatContainer.insertAdjacentHTML('beforeend', aiHtml);

            } catch (error) {
                document.getElementById(loadingId)?.remove();
                
                const errorHtml = `
                <div class="flex justify-center w-full my-4">
                    <div class="bg-red-50 text-red-600 px-4 py-2 rounded-full text-xs border border-red-200 flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        Maaf, koneksi terputus. Silakan coba lagi.
                    </div>
                </div>`;
                chatContainer.insertAdjacentHTML('beforeend', errorHtml);
            }

            scrollToBottom();
        }

        inputField.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s ease-in forwards;
        }

        #chat-content::-webkit-scrollbar {
            width: 8px;
        }
        #chat-content::-webkit-scrollbar-track {
            background: transparent;
        }
        #chat-content::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
            border: 3px solid transparent;
            background-clip: content-box;
        }
        #chat-content::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }
    </style>
@endsection