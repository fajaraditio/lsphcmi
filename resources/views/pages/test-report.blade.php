<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Laporan Hasil Asesmen - #' . $testReport->id) }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="p-8" id="page-1">
        <h1 class="font-bold text-xl">{{ __('FR.AK.05. Laporan Asesmen')}}</h1>
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
    </div>
</body>