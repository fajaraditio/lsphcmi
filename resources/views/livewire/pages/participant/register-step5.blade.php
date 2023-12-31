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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 text-sm">

                <div id="form-wizard" class="p-8">
                    @livewire('components.step-wizard', ['stepWizards' => $stepWizards, 'currentStep' => $currentStep])

                    <div class="pb-5">
                        <b>Skema Pilihan:</b> <span
                            class="rounded-full bg-red-500 hover:bg-red-600 text-white text-sm p-2 cursor-pointer"
                            wire:click="back(1)">{{
                            $participant->scheme->name }}</span>
                    </div>

                    <hr class="mb-5">

                    @if ($hasParticipantCompetencies)
                    <div class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400"
                        role="alert">
                        <span class="mr-3">⌛️</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Proses Verifikasi Form APL-02') }}</span> {{ __('Langkah 5
                            merupakan bagian dari Form APL-02 dan sedang dilakukan verifikasi pada asesmen mandiri.
                            Mohon mengecek secara berkala proses verifikasi form agar dapat melanjutkan ke tahapan Uji
                            Kompetensi.') }}
                        </div>
                    </div>
                    @endif

                    <div class="w-full mt-5">
                        @foreach ($competenceUnits as $competenceUnit)
                        <table class="table-auto border-collapse border border-slate-400 w-full text-left mt-3">
                            <tbody>
                                <tr>
                                    <th class="border w-1/5 p-2">Kode</th>
                                    <td class="border w-4/5 p-2" colspan="4">{{
                                        $competenceUnit->code
                                        }}</td>
                                </tr>
                                <tr>
                                    <th class="border w-1/5 p-2">Judul</th>
                                    <td class="border w-4/5 p-2" colspan="4">{{
                                        $competenceUnit->title
                                        }}</td>
                                </tr>
                                <tr>
                                    <td class="border p-2" colspan="2">Dapatkah saya ...?</td>
                                    <td class="border p-2 text-center">K</td>
                                    <td class="border p-2 text-center">BK</td>
                                    <td class="border p-2 text-center">Bukti Relevan</td>
                                </tr>
                                @foreach ($competenceUnit->competence_elements as $competenceElement)
                                <tr>
                                    <th class="border p-2">Elemen {{ $competenceElement->no }}</th>
                                    <td class="border p-2" colspan="4">{{ $competenceElement->title
                                        }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border p-2" colspan="5">Kriteria Untuk Kerja</td>
                                </tr>
                                @foreach ($competenceElement->competence_criterias as $competenceCriteria)
                                <tr>
                                    <td class="border p-2">{{ $competenceElement->no . '.' .
                                        $competenceCriteria->no }}</td>
                                    <td class="border p-2 w-2/5">{{ $competenceCriteria->title }}
                                    </td>
                                    <td
                                        class="border p-2 @error('participantCompetencies.' . $competenceCriteria->id . '.status') border-2 border-red-300 @enderror">
                                        <input type="radio"
                                            name="participantCompetencies[{{ $competenceCriteria->id }}][status]"
                                            wire:model="participantCompetencies.{{ $competenceCriteria->id }}.status"
                                            class="appearance-none text-red-500 checked:ring-red-400 focus:ring-red-400"
                                            value="K" @if($hasParticipantCompetencies) disabled @endif>
                                    </td>
                                    <td
                                        class="border p-2 @error('participantCompetencies.' . $competenceCriteria->id . '.status') border-2 border-red-300 @enderror">
                                        <input type="radio"
                                            name="participantCompetencies[{{ $competenceCriteria->id }}][status]"
                                            wire:model="participantCompetencies.{{ $competenceCriteria->id }}.status"
                                            class="appearance-none text-red-500 checked:ring-red-400 focus:ring-red-400"
                                            value="BK" @if($hasParticipantCompetencies) disabled @endif>
                                    </td>
                                    <td class="border p-2">
                                        <x-file-input id="relevant_proof" class="block mt-1 w-full text-sm" :error="$errors->has('participantCompetencies.' .
                                        $competenceCriteria->id . '.relevant_proof')"
                                            wire:model="participantCompetencies.{{ $competenceCriteria->id }}.relevant_proof"
                                            placeholder="Masukkan Bukti yang Relevan" accept="application/pdf"
                                            :allowed-exts="['PDF']" :disabled="empty($participantCompetencies[$competenceCriteria->
                                        id]['status']) ||
                                        $participantCompetencies[$competenceCriteria->id]['status'] ==
                                        'BK' || $hasParticipantCompetencies">
                                        </x-file-input>
                                        <x-input-error :messages="$errors->get('participantCompetencies.' .
                                        $competenceCriteria->id . '.relevant_proof')" class="mt-2" />

                                        @if(!empty($participantCompetencies[$competenceCriteria->id]['relevant_proof_path']))
                                        <span class="text-sm">
                                            Berkas:
                                            <a href="{{ url('storage/' . $participantCompetencies[$competenceCriteria->id]['relevant_proof_path']) }}"
                                                class="text-red-500 underline hover:text-red-700" target="_blank">
                                                {{
                                                $participantCompetencies[$competenceCriteria->id]['relevant_proof_path']
                                                }}
                                            </a>
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        @endforeach
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