<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Unggah Berkas Sertifikat BNSP') }}
        </h3>
    </div>

    <div class="bg-white text-sm sm:p-6">
        <div class="w-full">
            <p class="font-bold">{{ __('Nama Asesi') }}
            <p>
            <p>{{ $testReport->participant_user->name }}</p>
        </div>

        <div class="w-full mt-5">
            <p class="font-bold">{{ __('Nama Asesor') }}
            <p>
            <p>{{ $testReport->assessor_user->name }}</p>
        </div>

        <div class="w-full mt-5">
            <p class="font-bold">{{ __('Diverifikasi oleh yang berwenang pada') }}</p>
            <p>{{ \Carbon\Carbon::parse($testReport->chief_approved_report_at)->translatedFormat('l, j F Y') }}</p>
        </div>

        <hr class="my-5">

        <div class="w-full">
            <x-input-label for="bnsp_certificate" :value="__('Unggah Jawaban')">
            </x-input-label>
            <x-file-input id="bnsp_certificate" :value="old('bnspCertificateFile')" class="block mt-1 w-full text-sm"
                :error="$errors->has('bnspCertificateFile')" wire:model="bnspCertificateFile"
                accept="application/msword, application/pdf" :allowed-exts="['PDF']" required>
            </x-file-input>
            <x-input-error :messages="$errors->get('bnspCertificateFile')" class="mt-2" />
        </div>
    </div>

    <div class="bg-gray-50 p-3 sm:flex justify-end">
        <button
            class="px-3 py-2 bg-yellow-500 hover:bg-yellow-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="upload()">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                {{ __('Unggah Sertifikat BNSP') }}
            </span>
        </button>
    </div>
</div>