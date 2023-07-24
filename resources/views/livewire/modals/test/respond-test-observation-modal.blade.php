<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Kirim Jawaban') }}
        </h3>
    </div>

    <div class="bg-white text-sm sm:p-6">
        <div class="w-full">
            <p class="font-bold">{{ __('Unit Kompetensi') }}
            <p>
            <p>{{ $testObservation->competence_criteria->competence_element->competence_unit->title }}</p>
        </div>

        <div class="w-full mt-5">
            <p class="font-bold">{{ __('Elemen') }}
            <p>
            <p>{{ $testObservation->competence_criteria->competence_element->title }}</p>
        </div>

        <div class="w-full mt-5">
            <p class="font-bold">{{ __('Kriteria untuk Kerja (KUK)') }}</p>
            <p>{{ $testObservation->competence_criteria->competence_element->title }}</p>
        </div>

        <div class="w-full mt-5">
            <p class="font-bold">{{ __('Pertanyaan') }}</p>
            <p>{{ $testObservation->question }}</p>
        </div>

        <hr class="my-5">

        <div class="w-full">
            <x-input-label for="response" :value="__('Jawaban')">
            </x-input-label>
            <x-textarea-input id="response" class="block mt-1 w-full h-32" :error="$errors->has('response')"
                placeholder="Masukkan Jawaban Anda" wire:model="response" required>{{
                old('response') }}
            </x-textarea-input>
            <x-input-error :messages="$errors->get('response')" class="mt-2" />
        </div>
    </div>

    <div class="bg-gray-50 p-3 sm:flex justify-end">
        <button
            class="px-3 py-2 bg-purple-500 hover:bg-purple-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="save()">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                {{ __('Simpan Jawaban') }}
            </span>
        </button>
    </div>
</div>