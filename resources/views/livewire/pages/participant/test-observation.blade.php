<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Form Tugas Observasi / FR.IA.03 #:value', ['value' => $testSchedule->id]) }}
            </h2>
            <p>{{ __('Daftar pertanyaan untuk mendukung observasi') }}</p>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-sm overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-8">

                    @if (!empty($testSchedule->assessor_submitted_test_observation_at) &&
                    !empty($testSchedule->participant_responded_test_observation_at) &&
                    empty($testSchedule->assessor_reviewed_test_observation_at))
                    <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        <span class="mr-3">✅</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Form Tugas Observasi Berhasil Disubmit!') }}</span> {{
                            __('Form
                            tugas sudah disubmit dan sedang menunggu penilaian dari asesor') }}
                        </div>
                    </div>
                    @elseif (!empty($testSchedule->assessor_submitted_test_observation_at) &&
                    !empty($testSchedule->participant_responded_test_observation_at) &&
                    !empty($testSchedule->assessor_reviewed_test_observation_at))
                    <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-yellow-400"
                        role="alert">
                        <span class="mr-3">✅</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Form Tugas Observasi Selesai!') }}</span> {{ __('Seluruh
                            tahapan tugas observasi sudah selesai dan telah mendapatkan penilaian kompetensi') }}
                        </div>
                    </div>
                    @endif

                    <table class="table-auto border-collapse border border-slate-400 w-1/2 text-left mt-3">
                        <tbody>
                            <tr>
                                <th class="border border-slate-300 w-2/5 p-2">{{ __('Nama Asesi') }}</th>
                                <td class="border border-slate-300 w-3/5 p-2">{{ $testSchedule->participant->name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="border border-slate-300 w-2/5 p-2">{{ __('Nama Asesor') }}</th>
                                <td class="border border-slate-300 w-3/5 p-2">{{ $testSchedule->assessor->name }}</td>
                            </tr>
                            <tr>
                                <th class="border border-slate-300 w-2/5 p-2">{{ __('Tanggal Ujian') }}</th>
                                <td class="border border-slate-300 w-3/5 p-2">{{
                                    \Carbon\Carbon::parse($testSchedule->scheduled_at)->translatedFormat('l, j F Y') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr class="my-5">

                    @livewire('components.alert')

                    @livewire('tables.test.test-observation-table', ['testSchedule' => $testSchedule])

                    <hr class="my-5">

                    <div class="flex justify-between">
                        <x-secondary-button wire:click="back()">{{ __('Kembali ke Pengisian Tugas Praktik') }}
                        </x-secondary-button>
                        <x-primary-button wire:click="next()">{{ __('Lanjut ke Pengisian Feedback') }}</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>