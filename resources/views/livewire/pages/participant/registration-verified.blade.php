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
                        Lanjut ke Laman Uji Kompetensi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>