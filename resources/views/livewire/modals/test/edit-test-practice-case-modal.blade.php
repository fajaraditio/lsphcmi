<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Edit Kasus #') }}
        </h3>
    </div>

    <div class="bg-white text-sm sm:p-6">
        <div class="w-full">
            <x-input-label for="competenceElementId" :value="__('Unit Kompetensi')"></x-input-label>
            <select id="competenceElementId" wire:model="competenceUnitId"
                class="block mt-2 text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm @error('competenceUnitId') border-red-500 @enderror">
                <option value="">-- Pilih Unit Kompetensi --</option>
                @foreach ($competenceUnits as $competenceUnit)
                <option value="{{ $competenceUnit->id }}">{{ $competenceUnit->title }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('competenceUnitId')" class="mt-2" />
        </div>

        <div class="w-full mt-5">
            <x-input-label for="competenceElementId" :value="__('Elemen')"></x-input-label>
            <select @if (empty($competenceElements)) disabled @endif id="competenceElementId"
                wire:model="competenceElementId"
                class="block mt-2 text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm @error('competenceUnitId') border-red-500 @enderror">
                <option value="">-- Pilih Elemen --</option>
                @foreach ($competenceElements as $competenceElement)
                <option value="{{ $competenceElement->id }}">{{ $competenceElement->title }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('competenceElementId')" class="mt-2" />
        </div>

        <div class="w-full mt-5">
            <x-input-label for="competenceCriteriaId" :value="__('Kriteria untuk Kerja')"></x-input-label>
            <select @if (empty($competenceCriterias)) disabled @endif id="competenceCriteriaId"
                wire:model="competenceCriteriaId"
                class="block mt-2 text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm @error('competenceUnitId') border-red-500 @enderror">
                <option value="">-- Pilih Elemen --</option>
                @foreach ($competenceCriterias as $competenceCriteria)
                <option value="{{ $competenceCriteria->id }}">{{ $competenceCriteria->title }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('competenceCriteriaId')" class="mt-2" />
        </div>

        <div class="w-full mt-5">
            <x-input-label for="case" :value="__('Kasus')"></x-input-label>
            <textarea id="case" wire:model="case"
                class="w-full h-48 text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm @error('competenceUnitId') border-red-500 @enderror"></textarea>
        </div>
    </div>

    <div class="bg-gray-50 p-3 sm:flex justify-end">
        <button
            class="px-3 py-2 bg-green-500 hover:bg-green-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="save()">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                {{ __('Buat Kasus') }}
            </span>
        </button>
    </div>
</div>