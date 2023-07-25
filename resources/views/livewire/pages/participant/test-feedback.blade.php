<div>
    <div>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Umpan Balik Asesmen') }}
                </h2>
                <p>{{ __('Pengisian umpan balik asesmen untuk saran dan perbaikan selanjutnya.') }}</p>
            </div>
        </header>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 text-sm">

                    <div id="form-wizard" class="p-8">
                        @if (!empty($testSchedule->assessor_submitted_test_practice_at) &&
                        !empty($testSchedule->participant_responded_test_practice_at) &&
                        !empty($testSchedule->participant_responded_feedback_at))
                        <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <span class="mr-3">✅</span>
                            <span class="sr-only"></span>
                            <div>
                                <span class="font-bold">{{ __('Form Umpan Balik Selesai') }}</span> {{
                                __('Form umpan balik selesai diisikan. Silakan menunggu hasil kompetensi di halaman
                                Hasil Kompetensi') }}
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
                                    <td class="border border-slate-300 w-3/5 p-2">{{ $testSchedule->assessor->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border border-slate-300 w-2/5 p-2">{{ __('Tanggal Ujian') }}</th>
                                    <td class="border border-slate-300 w-3/5 p-2">{{
                                        \Carbon\Carbon::parse($testSchedule->scheduled_at)->translatedFormat('l, j F Y')
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <hr class="my-5">

                        <div class="w-full mt-5">
                            <table
                                class="table-auto border-collapse border border-slate-300 w-full text-left text-slate-900 mt-3">
                                <thead>
                                    <tr>
                                        <th class="border border-slate-300 w-2/5 p-3 text-slate-900" rowspan="2">
                                            Komponen</th>
                                        <th class="border border-slate-300 w-1/5 p-3 text-slate-900 text-center"
                                            colspan="2">Hasil</th>
                                        <th class="border border-slate-300 w-2/5 p-3 text-slate-900 text-center"
                                            rowspan="2">Catatan /
                                            Komentar Asesi</th>
                                    </tr>
                                    <tr>
                                        <th class="border border-slate-300 p-3 text-slate-900 text-center">Ya</th>
                                        <th class="border border-slate-300 p-3 text-slate-900 text-center">Tidak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedbackComponents as $component)
                                    <tr>
                                        @php $testFeedbackResult = 'testFeedback.' . $component->id . '.result' @endphp

                                        <td class="border p-3">{{ $component->component }}</td>
                                        <td
                                            class="border p-3 text-center @error($testFeedbackResult) border-2 border-red-300 @enderror">
                                            @if (empty($testFeedback[$component->id]['result']))
                                            <input type="radio" name="testFeedback[{{ $component->id }}][result]"
                                                wire:model="{{ $testFeedbackResult }}"
                                                class="appearance-none text-red-500 checked:ring-red-400 focus:ring-red-400"
                                                value="Y">
                                            @else
                                            {{ $testFeedback[$component->id]['result'] === 'Y' ? '✅' : '' }}
                                            @endif
                                        </td>
                                        <td
                                            class="border p-3 text-center @error($testFeedbackResult) border-2 border-red-300 @enderror">
                                            @if (empty($testFeedback[$component->id]['result']))
                                            <input type="radio" name="testFeedback[{{ $component->id }}][result]"
                                                wire:model="{{ $testFeedbackResult }}"
                                                class="appearance-none text-red-500 checked:ring-red-400 focus:ring-red-400"
                                                value="T">
                                            @else
                                            {{ $testFeedback[$component->id]['result'] === 'T' ? '✅' : '' }}
                                            @endif
                                        </td>
                                        <td class="border p-3">
                                            @php $testFeedbackNote = 'testFeedback.' . $component->id . '.note' @endphp

                                            @if (empty($testFeedback[$component->id]['note']))
                                            <x-textarea-input class="block mt-1 w-full h-32"
                                                :error="$errors->has($testFeedbackNote)"
                                                placeholder="Masukkan catatan atau komentar"
                                                wire:model="{{ $testFeedbackNote }}" required>
                                                {{ old($testFeedbackNote) }}
                                            </x-textarea-input>
                                            @else
                                            <p>{{ $testFeedback[$component->id]['note'] }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if (!empty($testSchedule->assessor_submitted_test_practice_at) &&
                        !empty($testSchedule->participant_responded_test_practice_at) &&
                        empty($testSchedule->participant_responded_feedback_at))
                        <div class="my-5">
                            <x-primary-button wire:click="submit()">{{ __('Kirim Umpan Balik') }}
                            </x-primary-button>
                        </div>
                        @endif

                        <hr class="my-5">

                        <div class="flex justify-between">
                            <x-secondary-button wire:click="back()">{{ __('Kembali ke Tugas Observasi') }}
                            </x-secondary-button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>