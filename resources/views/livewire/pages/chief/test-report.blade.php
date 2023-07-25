<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Hasil Asesmen') }}
            </h2>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-sm overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-8">
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

                    <p>
                        Pada hari
                        <span class="underline decoration-dotted uppercase">{{
                            \Carbon\Carbon::parse($testSchedule->assessor_submitted_report_at)->translatedFormat('l')
                            }}</span>
                        tanggal
                        <span class="underline decoration-dotted">{{
                            \Carbon\Carbon::parse($testSchedule->assessor_submitted_report_at)->translatedFormat('j')
                            }}</span>
                        bulan
                        <span
                            class="underline decoration-dotted uppercase">{{\Carbon\Carbon::parse($testSchedule->assessor_submitted_report_at)->translatedFormat('F')
                            }}</span>
                        tahun
                        <span class="underline decoration-dotted">
                            {{\Carbon\Carbon::parse($testSchedule->assessor_submitted_report_at)->translatedFormat('Y')
                            }}
                        </span>
                        telah dilakukan asesmen dan penilaian oleh
                        <span class="underline decoration-dotted uppercase">{{ $testSchedule->assessor->name }}</span>
                        selaku
                        <b>yang menilai (asesor)</b> dan
                        <span class="underline decoration-dotted uppercase">{{ $testSchedule->participant->name
                            }}</span> selaku
                        <b>yang dinilai (asesi)</b>.
                    </p>
                    <p>Seluruh tahapan pelaksanaan sudah dilaksanakan dan dengan ini asesor membuat rekomendasi hasil
                        asesmen
                        bagi asesi, yaitu:</p>
                    <br>
                    <h1 class="text-2xl font-bold uppercase">{{ $testReport->result === 'K' ? 'Kompeten' : 'Belum
                        Kompeten' }}</h1>
                    <br>

                    <p>Dengan catatan:</p>

                    <p class="underline decoration-dotted">{{ empty($testReport->note) ? 'NIHIL' : $testReport->note }}
                    </p>
                    <br>

                    <hr class="my-5">

                    <h1 class="text-lg font-bold uppercase">{{ __('Arsip Lembar Verifikasi dan Pengesahan ') }}</h1>
                    <br>

                    <p>
                        Dengan mencentang pernyataan di bawah ini, maka hasil rekomendasi dinyatakan sah dan
                        terverifikasi.
                    </p>

                    <div class="my-2">
                        <label for="verifyAgreement" class="inline-flex items-center">

                            @if (empty($this->testSchedule->chief_approved_report_at))
                            <input id="verifyAgreement" type="checkbox"
                                class="rounded text-red-600 shadow-sm focus:ring-red-500 @error('verifyAgreement') border-red-600 @enderror"
                                name="verifyAgreement" wire:model="verifyAgreement">
                            @else
                            <input type="checkbox" class="rounded text-red-600 shadow-sm focus:ring-red-500" checked
                                disabled>
                            @endif

                            <span class="ml-2 text-sm underline @error('verifyAgreement') decoration-red-600 @enderror">
                                Saya sebagai yang berwenang memverfikasi dan mengesahkan hasil laporan asesmen secara
                                sadar dan bertanggung jawab menyatakan hasil rekomendasi layak dan sesuai.
                            </span>
                        </label>
                        <label for="verifyPublication" class="inline-flex items-center">
                            @if (empty($this->testSchedule->chief_approved_report_at))
                            <input id="verifyPublication" type="checkbox"
                                class="rounded text-red-600 shadow-sm focus:ring-red-500 @error('verifyPublication') border-red-600 @enderror"
                                name="verifyPublication" wire:model="verifyPublication">
                            @else
                            <input type="checkbox" class="rounded text-red-600 shadow-sm focus:ring-red-500" checked
                                disabled>
                            @endif
                            
                            <span
                                class="ml-2 text-sm underline @error('verifyPublication') decoration-red-600 @enderror">
                                Laporan hasil asesmen akan dipublikasikan langsung kepada asesi secara elektronik
                                melalui dasbor asesi.
                            </span>
                        </label>

                        <br><br>

                        @if (empty($this->testSchedule->chief_approved_report_at))
                        <x-primary-button wire:click="verify()">Verifikasi Laporan</x-primary-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>