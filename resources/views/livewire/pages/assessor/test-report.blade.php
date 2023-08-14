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
                    <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
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

                    <hr class="border-dotted my-3">

                    @if (in_array(auth()->user()->role->slug, ['assessor', 'certification', 'chief']) &&
                    count($this->testSchedule->test_scores) > 0)

                    <div class="text-slate-500">
                        <h3 class="font-bold text-lg">Hasil Penilaian</h3>
                        <span class="underline">Bagian ini hanya bisa dilihat oleh yang berwenang</span> <br><br>

                        <table class="table-auto border border-collapse border-slate-400">
                            <thead>
                                <tr>
                                    <th class="border border-slate-400 py-3 px-2">Komponen</th>
                                    <th class="border border-slate-400 py-3 px-2">Skor</th>
                                    <th class="border border-slate-400 py-3 px-2">Bobot</th>
                                    <th class="border border-slate-400 py-3 px-2">Skor x Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $scorings = 0;
                                @endphp

                                @foreach ($this->testSchedule->test_scores as $testScore)

                                @php
                                $scoreXweight = (float) $testScore->score * (float) $testScore->weight;
                                $scorings += $scoreXweight;
                                @endphp

                                <tr>
                                    <td class="border border-slate-400 py-3 px-2">{{
                                        $testScore->scoring_component->title }}
                                    </td>
                                    <td class="border border-slate-400 py-3 px-2">
                                        {{ $testScore->score }}
                                    </td>
                                    <td class="border border-slate-400 py-3 px-2">
                                        {{ $testScore->weight }}
                                    </td>
                                    <td class="border border-slate-400 py-3 px-2">
                                        {{ $scoreXweight }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="font-bold border border-slate-400 py-3 px-2">Maksimal Skor:
                                        {{
                                        $maxScore
                                        }}</td>
                                    <td class="border border-slate-400 py-3 px-2">Total Skor</td>
                                    <td class="font-bold border border-slate-400 py-3 px-2">{{ $scorings }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="border border-slate-400 py-3 px-2">Persentase</td>
                                    <td class="font-bold border border-slate-400 py-3 px-2">{{ number_format($scorings /
                                        $maxScore *
                                        100, 2)
                                        }}%</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class=" border border-slate-400 py-3 px-2">Rekomendasi</td>
                                    <td class="font-bold border border-slate-400 py-3 px-2">{{ number_format($scorings /
                                        $maxScore *
                                        100, 2) >= $minPercentage ? 'Kompeten' : 'Belum Kompeten'
                                        }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @endif

                    @if (empty($this->testSchedule->assessor_submitted_report_at))
                    <div class="my-5">
                        <x-primary-button
                            wire:click="$emit('openModal', 'modals.test.submit-test-score-modal', {{ json_encode(['testSchedule' => $testSchedule->id ]) }})">
                            {{ __('Isi Form Penilaian') }}
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