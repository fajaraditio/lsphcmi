<div>
    <div>
        <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('Konfirmasi Pembayaran') }}
            </h3>
        </div>
        <div class="bg-white text-sm sm:p-6">

            <div class="sm:flex w-full">
                <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                    <x-input-label class="font-bold text-gray-700" for="name" :value="__('Nama Pemohon')">
                    </x-input-label>
                    <p>{{ $participant->name }}</p>
                </div>

                <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                </div>
            </div>

            <div class="sm:flex w-full">
                <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                    <x-input-label class="font-bold text-gray-700" for="name" :value="__('Tanggal Pendaftaran')">
                    </x-input-label>
                    <p>{{ \Carbon\Carbon::parse($participant->created_at)->format('d-m-Y G:i') }}</p>
                </div>

                <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                </div>
            </div>

            <div class="sm:flex w-full">
                <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                    <x-input-label class="font-bold text-gray-700" for="name" :value="__('Bukti Pembayaran')">
                    </x-input-label>
                    <img src="{{ url('storage/' . $participant->payment_receipt )}}"
                        alt="Payment Receipt - {{ $participant->id }}" class="w-48 h-48 object-contain">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 p-3 sm:flex justify-end">
        <button
            class="px-3 py-2 bg-green-500 hover:bg-green-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="updateStatus('paid')">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                {{ __('Konfirmasi') }}
            </span>
        </button>

        <button
            class="px-3 py-2 bg-red-500 hover:bg-red-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="updateStatus('rejected')">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
            <span>
                {{ __('Tolak') }}
            </span>
        </button>
    </div>
</div>