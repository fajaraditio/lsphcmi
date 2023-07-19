<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Test Schedule #:value', ['value' => $testSchedule->id]) }}
            </h2>
            <p>{{ __('Berikut ini merupakan detail dan menu uji kompetensi') }}</p>
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
                            <tr>
                                <th class="border border-slate-300 w-2/5 p-2">{{ __('Status Terakhir Asesi') }}</th>
                                <td class="border border-slate-300 w-3/5 p-2">{{__($testSchedule->participant_status )
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <th class="border border-slate-300 w-2/5 p-2">{{ __('Status Terakhir Asesor') }}</th>
                                <td class="border border-slate-300 w-3/5 p-2">{{ __($testSchedule->assessor_status) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr class="my-5">

                    <div class="flex flex-1 items-stretch">
                        <div
                            class="basis-1/5 flex flex-col justify-center items-center border border-slate-200 rounded p-3 mr-3 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>

                            <br>

                            <a href="{{ route('assessor.test.agreement', ['testSchedule' => $testSchedule->id ])}}">
                                <span class="underline hover:text-red-500 hover:no-underline">{{ __('Form Persetujuan
                                    (AK.01)')}}</span>
                            </a>
                        </div>
                        <div
                            class="basis-1/5 flex flex-col justify-center items-center border border-slate-200 rounded p-3 mr-3 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>

                            <br>

                            <a href="{{ route('assessor.test.practice', ['testSchedule' => $testSchedule->id ])}}">
                                <span class="underline hover:text-red-500 hover:no-underline">{{ __('Form Praktik
                                    (AK.02)')}}</span>
                            </a>
                        </div>
                        <div
                            class="basis-1/5 flex flex-col justify-center items-center border border-slate-200 rounded p-3 mr-3 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>

                            <br>

                            <a href="{{ route('assessor.test.observation', ['testSchedule' => $testSchedule->id ])}}">
                                <span class="underline hover:text-red-500 hover:no-underline">{{ __('Form Observasi
                                    (AK.02)')}}</span>
                            </a>
                        </div>
                        <div
                            class="basis-1/5 flex flex-col justify-center items-center border border-slate-200 rounded p-3 mr-3 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>

                            <br>

                            <a href="{{ route('assessor.test.feedback', ['testSchedule' => $testSchedule->id ])}}">
                                <span class="underline hover:text-red-500 hover:no-underline">{{ __('Form
                                    Feedback')}}</span>
                            </a>
                        </div>
                        <div
                            class="basis-1/5 flex flex-col justify-center items-center border border-slate-200 rounded p-3 mr-3 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>

                            <br>

                            <a href="{{ route('assessor.test.report', ['testSchedule' => $testSchedule->id ])}}">
                                <span class="underline hover:text-red-500 hover:no-underline">{{ __('Form Laporan')}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>