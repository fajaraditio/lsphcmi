<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Beri Penilaian Asesmen #:value', ['value' => $testPractice->id]) }}
        </h3>
    </div>

    <div class="bg-white text-sm sm:p-6">
        <div class="w-full">
            <p class="font-bold">{{ __('Unit Kompetensi') }}
            <p>
            <p>{{ $testPractice->competence_criteria->competence_element->competence_unit->title }}</p>
        </div>

        <div class="w-full mt-5">
            <p class="font-bold">{{ __('Elemen') }}
            <p>
            <p>{{ $testPractice->competence_criteria->competence_element->title }}</p>
        </div>

        <div class="w-full mt-5">
            <p class="font-bold">{{ __('Kriteria untuk Kerja (KUK)') }}</p>
            <p>{{ $testPractice->competence_criteria->competence_element->title }}</p>
        </div>

        <div class="w-full mt-5">
            <p class="font-bold">{{ __('Kasus') }}</p>
            <p>{{ $testPractice->case }}</p>
        </div>

        <div class="w-full mt-5">
            <p class="font-bold">{{ __('Berkas Jawaban') }}</p>
            <p>
                <a href="{{ url('storage/' . $testPractice->response_file) }}" class="text-blue-500 hover:underline"
                    target="_blank">[Lihat Berkas Jawaban]</a>
            </p>
        </div>

        <hr class="my-5">

        <div class="w-full">
            <x-input-label for="review" :value="__('Penilaian Jawaban')"></x-input-label>

            <div class="flex items-center my-2">
                <input name="review" wire:model="review" id="competent" type="radio" value="K" name="disabled-radio"
                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="competent" class="ml-2 text-sm font-medium">Kompeten</label>
            </div>

            <div class="flex items-center my-2">
                <input name="review" wire:model="review" id="incompetent" type="radio" value="BK" name="disabled-radio"
                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="incompetent" class="ml-2 text-sm font-medium">Belum Kompeten</label>
            </div>

            <x-input-error :messages="$errors->get('review')" class="mt-2" />
        </div>
    </div>

    <div class="bg-gray-50 p-3 sm:flex justify-end">
        <button
            class="px-3 py-2 bg-red-500 hover:bg-red-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="save()">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                {{ __('Beri Penilaian') }}
            </span>
        </button>
    </div>
</div>