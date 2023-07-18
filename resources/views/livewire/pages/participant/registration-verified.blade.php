<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permohonan Asesi Selesai') }}
            </h2>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2">

                <div class="p-8">
                    <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        <span class="mr-3">✅</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Permohonan Asesmen Diterima') }}</span> {{ __('Selamat,
                            permohonan asesmen Anda
                            diterima dan sudah diverifikasi. Silakan melanjutkan ke tahap Uji Kompetensi dengan mengklik
                            tombol di bawah
                            ini.') }}
                        </div>
                    </div>
                    <button
                        class="px-3 py-2 bg-green-500 hover:bg-green-600 border rounded text-white text-sm font-bold inline-flex items-center"
                        wire:click="continue()">
                        Lanjut ke Uji Kompetensi
                        <span class="ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-4 h-4">
                                <path fill-rule="evenodd"
                                    d="M12.97 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06l6.22-6.22H3a.75.75 0 010-1.5h16.19l-6.22-6.22a.75.75 0 010-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>