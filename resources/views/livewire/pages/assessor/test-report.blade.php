<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Form Laporan Kompetensi / FR.AK.05 #:value', ['value' => $testSchedule->id]) }}
            </h2>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-sm overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-8">

                    @if (!empty($this->testSchedule->assessor_submitted_report_at))
                    <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-yellow-400"
                        role="alert">
                        <span class="mr-3">✅</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Hasil Laporan Kompetensi Berhasil Disubmit!') }}</span> {{
                            __('Hasil laporan kompetensi sudah dilaporkan ke bagian pengesahan untuk selanjutnya
                            diverifikasi ke pihak yang berwenang') }}
                        </div>
                    </div>
                    @endif

                    <table class="table-auto border-collapse border border-slate-400 w-full text-left mt-3">
                        <tbody>
                            <tr>
                                <td class="border border-slate-300 w-1/5 p-2" rowspan="2">
                                    {{ __('Skema Sertifikasi') }} <br>
                                    (<s>KKNI</s> / Okupasi / <s>Klaster</s>)
                                </td>
                                <th class="border border-slate-300 w-1/5 p-2">{{ __('Judul') }}</th>
                                <td class="border border-slate-300 w-3/5 p-2" colspan="4">{{ $participant->scheme->name
                                    }}</td>
                            </tr>
                            <tr>
                                <th class="border border-slate-300 w-1/5 p-2">{{ __('Nomor') }}</th>
                                <td class="border border-slate-300 w-4/5 p-2" colspan="4">{{ __('01/SKM/LSPHCMI/' .
                                    date('Y'))
                                    }}</td>
                            </tr>
                            <tr>
                                <th class="border border-slate-300 w-1/5 p-2">{{ __('TUK') }}</th>
                                <td class="border border-slate-300 w-4/5 p-2" colspan="4">{{ __('Sewaktu / Tempat Kerja
                                    / Mandiri') }}</td>
                            </tr>
                            <tr>
                                <th class="border border-slate-300 w-1/5 p-2">{{ __('Nama Asesor') }}</th>
                                <td class="border border-slate-300 w-4/5 p-2" colspan="4">{{
                                    $testSchedule->assessor->name }}</td>
                            </tr>
                            <tr>
                                <th class="border border-slate-300 w-1/5 p-2">{{ __('Nama Asesi') }}</th>
                                <td class="border border-slate-300 w-4/5 p-2" colspan="4">{{
                                    $testSchedule->participant->name }}</td>
                            </tr>
                            <tr>
                                <th class="border border-slate-300 w-1/5 p-2">{{ __('Tanggal') }}</th>
                                <td class="border border-slate-300 w-4/5 p-2" colspan="4">{{
                                    \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <br>

                    <table class="table-auto border-collapse border border-slate-400 w-full text-left mt-3">
                        <thead>
                            <tr>
                                <th class="border border-slate-300 w-2/5 p-2" rowspan="2">{{ __('Nama Asesi') }}</td>
                                <th class="border border-slate-300 w-1/5 p-2 text-center" colspan="2">{{
                                    __('Rekomendasi') }}</th>
                                <th class="border border-slate-300 w-2/5 p-2 text-center" rowspan="2">{{
                                    __('Keterangan') }}</th>
                            </tr>
                            <tr>
                                <th class="border border-slate-300 p-2 text-center">K</th>
                                <th class="border border-slate-300 p-2 text-center">BK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-slate-300 p-2">{{ $testSchedule->participant->name }}</td>
                                <td class="border border-slate-300 p-2 text-center">
                                    {{ !empty($testReport) ? ($testReport['result'] === 'K' ? '✅' : '') : ''}}
                                </td>
                                <td class="border border-slate-300 p-2 text-center">
                                    {{ !empty($testReport) ? ($testReport['result'] === 'BK' ? '✅' : '') : ''}}
                                </td>
                                <td class="border border-slate-300 p-2">
                                    {{ !empty($testReport) ? (!empty($testReport['note']) ? $testReport['note'] : '') :
                                    ''}}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @if (empty($this->testSchedule->assessor_submitted_report_at))
                    <div class="my-5">
                        <x-primary-button
                            wire:click="$emit('openModal', 'modals.test.submit-test-report-modal', {{ json_encode(['testSchedule' => $testSchedule->id ]) }})">
                            {{ __('Isi Hasil Laporan Kompetensi') }}
                        </x-primary-button>
                    </div>
                    @endif

                    <hr class="my-5">

                    <div class="flex justify-between">
                        <x-secondary-button wire:click="back()">{{ __('Kembali ke ') . __('Competency Test List') }}
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>