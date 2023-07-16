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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2">

                <div id="form-wizard" class="p-8">
                    @livewire('components.step-wizard', ['stepWizards' => $stepWizards, 'currentStep' => $currentStep])

                    <div class="pb-5">
                        <b>Skema Pilihan:</b> <span
                            class="rounded-full bg-red-500 hover:bg-red-600 text-white text-sm p-2 cursor-pointer"
                            wire:click="back(1)">{{
                            $participant->scheme->name }}</span>
                    </div>

                    <hr class="mb-5">

                    <div class="p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                        role="alert">
                        <span class="font-medium">💡 Informasi Pembayaran</span>
                        <p>
                            Silakan lakukan pembayaran ke rekening BRI a/n LSP HCMI
                            dengan nomor rekening 1167.0100.0254.305 lalu unggah melalui form di bawah ini
                        </p>
                    </div>

                    <div class="sm:flex w-full mt-5">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="payment_receipt" :value="__('Unggah Bukti Pembayaran')">
                            </x-input-label>
                            <x-file-input id="payment_receipt" :value="old('paymentReceiptFile')"
                                class="block mt-1 w-full" :error="$errors->has('paymentReceiptFile')"
                                placeholder="Masukkan Nama Lengkap sesuai Kartu Identitas"
                                wire:model="paymentReceiptFile" accept="image/*" :allowed-exts="['PNG', 'BMP', 'JPG']"
                                required>
                            </x-file-input>
                            <x-input-error :messages="$errors->get('paymentReceiptFile')" class="mt-2" />
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="sm:flex w-full mt-5">
                        @if (!empty($paymentReceiptFile))
                        <img src="{{ $paymentReceiptFile->temporaryUrl() }}" class="w-48 h-auto"
                            alt="Temporary Preview Image">
                        @elseif (!empty($participant->payment_receipt))
                        <img src="{{ url('storage/' . $participant->payment_receipt) }}" class="w-48 h-auto"
                            alt="Payment Receipt">
                        @endif
                    </div>

                    <hr class="my-5">

                    <div class="flex justify-between">
                        <x-secondary-button wire:click="back()">Sebelumnya</x-secondary-button>
                        <x-primary-button wire:click="save()">Selanjutnya</x-primary-button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>