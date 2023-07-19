<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Form Persetujuan AK-01') }}
            </h2>
            <p>Persetujuan Asesmen ini untuk menjamin bahwa Asesi telah diberi arahan secara rinci tentang perencanaan
                dan proses asesmen</p>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-8">
                    @if (empty($testSchedule->agreement) || (!empty($testSchedule->agreement) &&
                    empty($testSchedule->agreement->assessor_signed_at)))
                    <div class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400"
                        role="alert">
                        <span class="mr-3">⌛️</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Menunggu Persetujuan Asesor') }}</span> {{ __('Harap tunggu
                            karena sistem sedang
                            menunggu persetujuan asesor untuk dapat dilaksanakan asesmen.
                            Mohon mengecek secara berkala proses verifikasi form agar dapat melanjutkan ke tahapan Uji
                            Kompetensi.') }}
                        </div>
                    </div>
                    @else
                    <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        <span class="mr-3">✅</span>
                        <span class="sr-only"></span>
                        <div>
                            <span class="font-bold">{{ __('Form sudah disetujui') }}</span> {{ __('Form Persetujuan
                            sudah disetujui oleh asesi dan asesor, harap melanjutkan ke tahap berikutnya.') }}
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
                                <td class="border border-slate-300 w-4/5 p-2" colspan="3">
                                    <p>{{ __('Asesi') }}: <br> {{ __('Bahwa Saya Sudah Mendapatkan Penjelasan Hak dan
                                        Prosedur Banding oleh Asesor.')}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-slate-300 w-4/5 p-2" colspan="3">
                                    <p>{{ __('Asesor') }}: <br> {{ __('Menyatakan tidak akan membuka hasil pekerjaan
                                        yang saya peroleh karena penugasan saya sebagai Asesor dalam pekerjaan Asesmen
                                        kepada siapapun atau organisasi apapun selain kepada pihak yang berwenang
                                        sehubungan dengan kewajiban saya sebagai Asesor yang ditugaskan oleh LSP. ')}}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr class="my-5">

                    <div class="flex justify-between">
                        <div class="signature-pad">
                            <p>{{ __('Tanggal: ') . Carbon\Carbon::now()->translatedFormat('j F Y') }}</p>

                            @if (empty($testSchedule->agreement) || (!empty($testSchedule->agreement) &&
                            empty($testSchedule->agreement->participant_signed_at)))
                            <canvas class="border border-slate-400" id="signature-pad-canvas"></canvas>
                            <x-input-error :messages="$errors->get('signature')" class="mt-2" />
                            @else
                            <img src="{{ $testSchedule->agreement->participant_signature }}" alt="Signature"
                                style="width: 200px; height: 100px;">
                            @endif

                            <p>{{ $testSchedule->participant->name }}</p>
                        </div>

                        <div class="signature-pad">
                            @if (!empty($testSchedule->agreement) &&
                            !empty($testSchedule->agreement->assessor_signed_at))
                            <p>{{ __('Tanggal: ') . Carbon\Carbon::now()->translatedFormat('j F Y') }}</p>

                            <img src="{{ $testSchedule->agreement->assessor_signature }}" alt="Signature"
                                style="width: 200px; height: 100px;">
                            @endif

                            <p>{{ $testSchedule->assessor->name }}</p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="flex justify-between">
                        @if (empty($testSchedule->agreement) || (!empty($testSchedule->agreement) &&
                        empty($testSchedule->agreement->participant_signed_at)))
                        <x-secondary-button id="clear-signature">Ulangi Tandatangan</x-secondary-button>
                        @else
                        <div></div>
                        @endif

                        <x-primary-button id="accept">Setuju dan Tandatangani
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    document.addEventListener('livewire:load', function () {
        let canvas = document.getElementById('signature-pad-canvas')

        let signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)'
        })

        function resizeCanvas() {
            let ratio = Math.max(window.devicePixelRatio || 1, 1)
            canvas.style.width ='300px';
            canvas.style.height='200px';
            canvas.width = canvas.offsetWidth * ratio  
            canvas.height = canvas.offsetHeight * ratio
            canvas.getContext('2d').scale(ratio, ratio)

            signaturePad.clear()
        }

        window.onresize = resizeCanvas
        resizeCanvas()

        document.getElementById('accept')
            .addEventListener('click', function () {
                @this.signature = signaturePad.isEmpty() ? null : signaturePad.toDataURL('image/svg+xml')
                @this.accept()
            })

        document.getElementById('clear-signature')
            .addEventListener('click', function () {
                signaturePad.clear()
            })
    })
</script>