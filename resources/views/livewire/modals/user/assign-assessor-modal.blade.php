<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Penugasan Asesor #:value', ['value' => $participant->id]) }}
        </h3>
    </div>

    <div class="bg-white text-sm sm:p-6">
        <div class="pb-3">
            <p>
                Penugasan asesor bagi asesi atas nama <b>{{ $participant->name }}</b>
            </p>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label for="assessorUserId" :value="__('Pilih Asesor')"></x-input-label>
                <x-select-input id="assessorUserId" :value="old('assessorUserId')" class="block mt-1 w-full text-sm"
                    :options="$assessors" wire:model="assessorUserId" required>
                </x-select-input>
                <x-input-error :messages="$errors->get('assessorUserId')" class="mt-2" />
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
            </div>
        </div>

    </div>

    <div class="bg-gray-50 p-3 sm:flex justify-end">
        <button
            class="px-3 py-2 bg-green-500 hover:bg-green-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="assign()">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                {{ __('Tugaskan') }}
            </span>
        </button>
    </div>
</div>