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

                    @if (!empty($participantDoc) && (empty($participant->first_apl_status) || $participant->first_apl_status === 'rejected'))
                    <div class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400"
                        role="alert">
                        <span class="mr-3">⌛️</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Proses Verifikasi Form APL-01') }}</span> {{ __('Langkah 1
                            sampai 3 merupakan bagian dari Form APL-01 dan sedang dilakukan verifikasi pada data diri
                            dan berkas. Mohon mengecek secara berkala proses verifikasi form agar dapat melanjutkan ke
                            tahap pembayaran.') }}
                        </div>
                    </div>
                    @endif

                    <div class="sm:flex w-full mt-3">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="assessment_purpose" :value="__('Tujuan Asesmen')"></x-input-label>
                            <x-select-input id="assessment_purpose" type="text"
                                :value="old('participant.assessment_purpose')" class="block mt-1 w-full"
                                :options="$purposes" wire:model="participant.assessment_purpose" required>
                            </x-select-input>
                            <x-input-error :messages="$errors->get('participant.assessment_purpose')" class="mt-2" />
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="sm:flex w-full mt-3">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="identity_card"
                                :value="__('Scan KTP / Paspor / Kartu Identitas Lainnya')">
                            </x-input-label>
                            <x-file-input id="identity_card" :value="old('participantDocs.identity_card')"
                                class="block mt-1 w-full" :error="$errors->has('participantDocs.identity_card')"
                                placeholder="Masukkan Scan Kartu Identitas" wire:model="participantDocs.identity_card"
                                accept="application/pdf" :allowed-exts="['PDF']" required>
                            </x-file-input>
                            <x-input-error :messages="$errors->get('participantDocs.identity_card')" class="mt-2" />

                            @if (!empty($participantDoc) && !empty($participantDoc->identity_card))
                            <span class="text-sm">
                                Berkas:
                                <a href="{{ url('storage/' . $participantDoc->identity_card) }}"
                                    class="text-red-500 underline hover:text-red-700" target="_blank">
                                    {{ $participantDoc->identity_card }}
                                </a>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="sm:flex w-full mt-3">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="graduation_certificate" :value="__('Scan Ijazah Minimal D3 Sederajat')">
                            </x-input-label>
                            <x-file-input id="graduation_certificate"
                                :value="old('participantDocs.graduation_certificate')" class="block mt-1 w-full"
                                :error="$errors->has('participantDocs.graduation_certificate')"
                                placeholder="Masukkan Scan Ijazah" wire:model="participantDocs.graduation_certificate"
                                accept="application/pdf" :allowed-exts="['PDF']" required>
                            </x-file-input>
                            <x-input-error :messages="$errors->get('participantDocs.graduation_certificate')"
                                class="mt-2" />

                            @if (!empty($participantDoc) && !empty($participantDoc->graduation_certificate))
                            <span class="text-sm">
                                Berkas:
                                <a href="{{ url('storage/' . $participantDoc->graduation_certificate) }}"
                                    class="text-red-500 underline hover:text-red-700" target="_blank">
                                    {{ $participantDoc->graduation_certificate }}
                                </a>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="sm:flex w-full mt-3">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="training_certificate"
                                :value="__('Scan Sertifikat Pelatihan Kerja (jika ada)')">
                            </x-input-label>
                            <x-file-input id="training_certificate" :value="old('participantDocs.training_certificate')"
                                class="block mt-1 w-full" :error="$errors->has('participantDocs.training_certificate')"
                                placeholder="Masukkan Scan Sertifikat Pelatihan Kerja"
                                wire:model="participantDocs.training_certificate" accept="application/pdf"
                                :allowed-exts="['PDF']">
                            </x-file-input>
                            <x-input-error :messages="$errors->get('participantDocs.training_certificate')"
                                class="mt-2" />

                            @if (!empty($participantDoc) && !empty($participantDoc->training_certificate))
                            <span class="text-sm">
                                Berkas:
                                <a href="{{ url('storage/' . $participantDoc->training_certificate) }}"
                                    class="text-red-500 underline hover:text-red-700" target="_blank">
                                    {{ $participantDoc->training_certificate }}
                                </a>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="sm:flex w-full mt-3">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="references_letter"
                                :value="__('Scan Surat Keterangan Bekerja di bidang yang relevan dengan skema (jika ada)')">
                            </x-input-label>
                            <x-file-input id="references_letter" :value="old('participantDocs.references_letter')"
                                class="block mt-1 w-full" :error="$errors->has('participantDocs.references_letter')"
                                placeholder="Masukkan Scan Sertifikat Pelatihan Kerja"
                                wire:model="participantDocs.references_letter" accept="application/pdf"
                                :allowed-exts="['PDF']">
                            </x-file-input>
                            <x-input-error :messages="$errors->get('participantDocs.references_letter')" class="mt-2" />

                            @if (!empty($participantDoc) && !empty($participantDoc->references_letter))
                            <span class="text-sm">
                                Berkas:
                                <a href="{{ url('storage/' . $participantDoc->references_letter) }}"
                                    class="text-red-500 underline hover:text-red-700" target="_blank">
                                    {{ $participantDoc->references_letter }}
                                </a>
                            </span>
                            @endif
                        </div>
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