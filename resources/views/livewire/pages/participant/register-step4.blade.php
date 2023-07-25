<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $stepWizards[$currentStep - 1]['attr'] }}
            </h2>
            <p>{{ $stepWizards[$currentStep - 1]['desc'] }}</p>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 text-sm">

                <div id="form-wizard" class="p-8">
                    @livewire('components.step-wizard', ['stepWizards' => $stepWizards, 'currentStep' => $currentStep])

                    <div class="pb-5">
                        <b>Skema Pilihan:</b> <span
                            class="rounded-full bg-red-500 hover:bg-red-600 text-white text-sm p-2 cursor-pointer"
                            wire:click="back(1)">{{
                            $participant->scheme->name }}</span>
                    </div>

                    <hr class="mb-5">

                    @if (empty($participant->payment_status) || $participant->payment_status !== 'paid')
                    <div class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400"
                        role="alert">
                        <span class="mr-3">⌛️</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Proses Verifikasi Pembayaran') }}</span> {{ __('Mohon
                            mengecek secara berkala proses verifikasi pembayaran agar dapat lanjut ke tahap Asesmen
                            Mandiri.') }}
                        </div>
                    </div>
                    @endif

                    <div class="p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                        role="alert">
                        <span class="font-medium">💡 Informasi Pembayaran</span>
                        <p>
                            Silakan lakukan pembayaran dengan mengklik tombol di bawah ini. Batas waktu pembayaran
                            adalah 1 x 24 jam. Pembayaran otomatis terverifikasi dan akan dialihkan ke halaman
                            berikutnya.
                        </p>
                    </div>

                    <div class="w-full mt-5">
                        <button
                            class="px-3 py-2 bg-blue-500 hover:bg-blue-600 border rounded text-white text-sm font-bold inline-flex items-center"
                            wire:click="payWithDuitku()">Klik Di sini untuk Pembayaran</button>
                    </div>

                    <hr class="my-5">

                    <div class="flex justify-between">
                        <x-secondary-button wire:click="back()">Sebelumnya</x-secondary-button>
                        <x-primary-button wire:click="next()">Selanjutnya</x-primary-button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>