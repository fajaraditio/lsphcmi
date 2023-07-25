<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Test Schedule #:value', ['value' => $testSchedule->id]) }}
            </h2>
            <p>{{ __('Detail dan menu uji kompetensi') }}</p>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-sm overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-8">
                    @livewire('components.alert')

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

                    <table class="border-collapse border border-slate-200 text-sm text-left w-2/3">
                        <thead>
                            <tr>
                                <th class="bg-slate-200 border border-slate-200 p-2">Tahapan</th>
                                <th class="bg-slate-200 border border-slate-200 p-2">Status</th>
                                <th class="bg-slate-200 border border-slate-200 p-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-{{ $forms['test_agreement']['color'] }}-50">
                                <td class="border border-slate-200 p-2">
                                    <a href="{{ route('assessor.test.agreement', ['testSchedule' => $testSchedule->id] )}}"
                                        class="text-blue-500 underline hover:text-indigo-500">
                                        {{ __('Penandatanganan Form Persetujuan / FR.AK.01') }}
                                    </a>
                                </td>
                                <td class="border border-slate-200 p-2">
                                    {{ __($forms['test_agreement']['status']) }}
                                </td>
                                <td class="border border-slate-200 p-2 text-center">{{
                                    $forms['test_agreement']['status'] === 'done' ? '✅' : '🕘' }}</td>
                            </tr>

                            <tr class="bg-{{ $forms['test_practice']['color'] }}-50">
                                <td class="border border-slate-200 p-2">
                                    <a href="{{ route('assessor.test.practice', ['testSchedule' => $testSchedule->id] )}}"
                                        class="text-blue-500 underline hover:text-indigo-500">
                                        {{ __('Pengisian Form Tugas Praktik / FR.IA.02') }}
                                    </a>
                                </td>
                                <td class="border border-slate-200 p-2">
                                    {{ __($forms['test_practice']['status']) }}
                                </td>
                                <td class="border border-slate-200 p-2 text-center">{{
                                    $forms['test_practice']['status'] === 'done' ? '✅' : '🕘' }}</td>
                            </tr>

                            <tr class="bg-{{ $forms['test_observation']['color'] }}-50">
                                <td class="border border-slate-200 p-2">
                                    <a href="{{ route('assessor.test.observation', ['testSchedule' => $testSchedule->id] )}}"
                                        class="text-blue-500 underline hover:text-indigo-500">
                                        {{ __('Pengisian Form Tugas Observasi / FR.IA.03') }}
                                    </a>
                                </td>
                                <td class="border border-slate-200 p-2">
                                    {{ __($forms['test_observation']['status']) }}
                                </td>
                                <td class="border border-slate-200 p-2 text-center">{{
                                    $forms['test_observation']['status'] === 'done' ? '✅' : '🕘' }}</td>
                            </tr>

                            <tr class="bg-{{ $forms['feedback']['color'] }}-50">
                                <td class="border border-slate-200 p-2">
                                    <a href="{{ route('assessor.test.feedback', ['testSchedule' => $testSchedule->id] )}}"
                                        class="text-blue-500 underline hover:text-indigo-500">
                                        {{ __('Pengisian Form Feedback / FR.AK.03') }}
                                    </a>
                                </td>
                                <td class="border border-slate-200 p-2">
                                    {{ __($forms['feedback']['status']) }}
                                </td>
                                <td class="border border-slate-200 p-2 text-center">{{
                                    $forms['feedback']['status'] === 'done' ? '✅' : '🕘' }}</td>
                            </tr>

                            <tr class="bg-{{ $forms['report']['color'] }}-50">
                                <td class="border border-slate-200 p-2">
                                    <a href="{{ route('assessor.test.report', ['testSchedule' => $testSchedule->id] )}}"
                                        class="text-blue-500 underline hover:text-indigo-500">
                                        {{ __('Pengisian Form Laporan / FR.AK.03') }}
                                    </a>
                                </td>
                                <td class="border border-slate-200 p-2">
                                    {{ __($forms['report']['status']) }}
                                </td>
                                <td class="border border-slate-200 p-2 text-center">{{
                                    $forms['report']['status'] === 'done' ? '✅' : '🕘' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <hr class="my-5">

                    <x-secondary-button wire:click="back()">Kembali ke {{ __('Competency Test List')}}
                    </x-secondary-button>
                </div>
            </div>
        </div>
    </div>
</div>