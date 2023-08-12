<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Tambah Komponen Penilaian') }}
        </h3>
    </div>

    <div class="bg-white text-sm sm:p-6">
        <div class="w-full">
            <x-input-label for="name" :value="__('Judul Komponen')">
            </x-input-label>
            <x-text-input type="text" id="title" class="block mt-1 w-2/3 text-sm" :error="$errors->has('title')"
                placeholder="Masukkan Judul Komponen" wire:model="title" required></x-text-input>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="w-full mt-3">
            <x-input-label for="weight" :value="__('Bobot Penilaian')">
            </x-input-label>
            <x-text-input type="number" min="0.1" id="weight" class="block mt-1 w-2/3 text-sm"
                :error="$errors->has('weight')" placeholder="Masukkan bobot penilaian" wire:model="weight" required>
            </x-text-input>
            <x-input-error :messages="$errors->get('weight')" class="mt-2" />
        </div>
    </div>

    <div class="bg-gray-50 p-3 sm:flex justify-end">
        <button
            class="px-3 py-2 bg-orange-500 hover:bg-orange-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="save()">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                {{ __('Tambahkan Komponen') }}
            </span>
        </button>
    </div>
</div>