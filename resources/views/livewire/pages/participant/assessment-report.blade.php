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

                    @if (empty($testSchedule->assessor_submitted_report_at))
                    <div class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400"
                        role="alert">
                        <span class="mr-3">⌛️</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Tidak Ada Laporan Hasil Asesmen') }}</span> <br> {{
                            __('Silakan mengerjakan terlebih dahulu uji kompetensi yang ada di laman Uji Kompetensi') }}
                        </div>
                    </div>

                    <button
                        class="px-3 py-2 bg-green-500 hover:bg-green-600 border rounded text-white text-sm font-bold inline-flex items-center"
                        wire:click="back()">
                        Kembali ke Laman Uji Kompetensi
                    </button>

                    @elseif (
                    !empty($testSchedule->assessor_submitted_report_at) &&
                    empty($testSchedule->chief_approved_report_at)
                    )
                    <div class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400"
                        role="alert">
                        <span class="mr-3">⌛️</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Laporan Hasil Kompetensi Belum Ada') }}</span> <br> {{
                            __('Harap menunggu untuk mendapatkan hasil laporan kompetensi, silakan mengecek berkala
                            laman Laporan Hasil Asesmen') }}
                        </div>
                    </div>

                    <button
                        class="px-3 py-2 bg-green-500 hover:bg-green-600 border rounded text-white text-sm font-bold inline-flex items-center"
                        wire:click="back()">
                        Kembali ke Laman Uji Kompetensi
                    </button>

                    @elseif (
                    !empty($testSchedule->assessor_submitted_report_at) &&
                    !empty($testSchedule->chief_approved_report_at))
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
                    <p>Seluruh tahapan pelaksanaan sudah dilaksanan dan dengan ini kami sebagai Lembaga Sertifikasi
                        Profesi (LSP) HCMI menyatakan bahwa asesi:</p>
                    <br>
                    <h1 class="text-2xl font-bold uppercase">{{ $testReport->result === 'K' ? 'Kompeten' : 'Belum
                        Kompeten' }}</h1>
                    <br>

                    <p>Dengan catatan:</p>

                    <p class="underline decoration-dotted">{{ empty($testReport->note) ? 'NIHIL' : $testReport->note }}
                    </p>
                    <br>

                    <p>Demikianlah, laporan hasil kompetensi yang sudah diverifikasi oleh Lembaga Sertifikasi Profesi
                        (LSP) HCMI. <br> Dokumen ini merupakan bukti elektronik keikutsertaan dan hasil asesmen dan
                        bukan merupakan
                        lembar sertifikat.
                    </p>
                    <br><br>

                    {{ \Carbon\Carbon::parse($testSchedule->assessor_submitted_report_at)->translatedFormat('l, j F
                    Y')
                    }}

                    <br><br>
                    <img src="{{ $testAgreement->assessor_signature }}" alt="Asesor Signature"
                        class="border border-slate-300" style="width: 250px; height: 100%; object-fit: cover;">
                    <br>
                    <p>{{ $testSchedule->assessor->name }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>