<div>
    <div>
        <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('Konfirmasi Pembayaran') }}
            </h3>
        </div>
        <form wire:submit.prevent="save">
            <div class="bg-white text-sm sm:p-6">

                <p class="font-bold my-2">Nama Calon Asesi</p>
                <div class="my-2">
                    {{ $participant->name }}
                </div>

                <p class="font-bold my-2">Tanggal Pendaftaran</p>
                <div class="my-2">
                    {{ \Carbon\Carbon::parse($participant->created_at)->format('d-m-Y G:i') }}
                </div>

                <p class="font-bold my-2">Bukti Pembayaran</p>
                <div class="my-2">
                    <img src="{{ url('storage/' . $participant->payment_receipt )}}"
                        alt="Payment Receipt - {{ $participant->id }}" class="w-48 h-48 object-contain">
                </div>

                <x-input-label for="status" class="font-bold my-2" :value="__('Status Konfirmasi')"></x-input-label>
                <div class="my-2">
                    <x-select-input id="status" class="block text-sm mt-1" :options="$confirmOps"
                        :error="$errors->has('status')" wire:model="status"></x-select-input>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>
            <div class="bg-gray-50 p-3 sm:flex justify-end">
                <button
                    class="px-3 py-2 bg-green-500 border rounded text-white text-sm font-bold inline-flex items-center"
                    type="submit">
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
            </div>
        </form>
    </div>
</div>