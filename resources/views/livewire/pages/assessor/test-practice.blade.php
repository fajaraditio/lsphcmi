<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Form Tugas Praktik / FR.IA.02 #:value', ['value' => $testSchedule->id]) }}
            </h2>
            <p>{{ __('Daftar pertanyaan tugas praktik demonstrasi') }}</p>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-sm overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-8">
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

                    @livewire('tables.test.test-practice-table', ['testSchedule' => $testSchedule])
                </div>
            </div>
        </div>
    </div>
</div>