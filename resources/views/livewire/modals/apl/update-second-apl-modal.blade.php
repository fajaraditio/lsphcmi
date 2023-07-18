<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Verifikasi Form APL-02') }}
        </h3>
    </div>

    <div class="bg-white text-sm sm:p-6">
        <span class="rounded-full bg-gray-500 text-white text-sm p-2">{{ __('A. Data Pribadi') }}</span>

        <div class="sm:flex w-full mt-5">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="name" :value="__('Skema Pilihan')">
                </x-input-label>
                <p class="font-bold">{{ $participant->scheme->name }}</p>
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="name" :value="__('Tujuan Asesmen')">
                </x-input-label>
                <p>{{ $participant->assessment_purpose }}</p>
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="name" :value="__('Nama Lengkap')">
                </x-input-label>
                <p>{{ $participant->name }}</p>
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="identity_number"
                    :value="__('Nomor KTP / NIK / Paspor')">
                </x-input-label>
                <p>{{ $participant->identity_number }}</p>
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="birth_place" :value="__('Tempat Lahir')">
                </x-input-label>
                <p>{{ $participant->birth_place }}</p>
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="birth_date" :value="__('Tanggal Lahir')">
                </x-input-label>
                <p>{{ $participant->birth_date }}</p>
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="gender" :value="__('Jenis Kelamin')">
                </x-input-label>
                <p>{{ $participant->gender === 'Female' ? 'Perempuan' : 'Laki-laki'}}</p>
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="nationality" :value="__('Kebangsaan')">
                </x-input-label>
                <p>{{ $participant->nationality }}</p>
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="email" :value="__('Email')"></x-input-label>
                <p>{{ $participant->email }}</p>
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
            </div>
        </div>

        <hr class="my-5">

        <span class="rounded-full bg-gray-500 text-white text-sm p-2">{{ __('B. Asesmen Mandiri / Form APL-02') }}</span>

        <div class="w-full mt-5">
            @foreach ($competenceUnits as $competenceUnit)
            <table class="table-auto border-collapse border border-slate-400 w-full text-left mt-3">
                <tbody>
                    <tr>
                        <th class="border border-slate-300 w-1/5 p-2">Kode</th>
                        <td class="border border-slate-300 w-4/5 p-2" colspan="4">{{
                            $competenceUnit->code
                            }}</td>
                    </tr>
                    <tr>
                        <th class="border border-slate-300 w-1/5 p-2">Judul</th>
                        <td class="border border-slate-300 w-4/5 p-2" colspan="4">{{
                            $competenceUnit->title
                            }}</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-300 p-2" colspan="2">Dapatkah saya ...?</td>
                        <td class="border border-slate-300 p-2 text-center">K</td>
                        <td class="border border-slate-300 p-2 text-center">BK</td>
                        <td class="border border-slate-300 p-2 text-center">Bukti Relevan</td>
                    </tr>
                    @foreach ($competenceUnit->competence_elements as $competenceElement)
                    <tr>
                        <th class="border border-slate-300 p-2">Elemen {{ $competenceElement->no }}</th>
                        <td class="border border-slate-300 p-2" colspan="4">{{ $competenceElement->title
                            }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-slate-300 p-2" colspan="5">Kriteria Untuk Kerja</td>
                    </tr>
                    @foreach ($competenceElement->competence_criterias as $competenceCriteria)
                    @php
                    $participantCompetency = $participantCompetency
                    ->where('participant_id', $this->participant->id)
                    ->where('competence_criteria_id', $competenceCriteria->id)
                    ->first()
                    @endphp

                    <tr>
                        <td class="border border-slate-300 p-2">{{ $competenceElement->no . '.' .
                            $competenceCriteria->no }}</td>
                        <td class="border border-slate-300 w-2/5 p-2">{{ $competenceCriteria->title }}
                        </td>
                        <td class="border border-slate-300 p-2 text-center">
                            {{ $participantCompetency->status === 'K' ? 'V' : null }}
                        </td>
                        <td class="border border-slate-300 p-2 text-center">
                            {{ $participantCompetency->status === 'BK' ? 'V' : null }}
                        </td>
                        <td class=" border border-slate-300 p-2">
                            @if(!empty($participantCompetency->relevant_proof))
                            <span class="text-sm">
                                Lihat Berkas:
                                <a href="{{ url('storage/' . $participantCompetency->relevant_proof) }}"
                                    class="text-red-500 underline hover:text-red-700" target="_blank">
                                    {{ $participantCompetency->relevant_proof }}
                                </a>
                            </span>
                            @else
                            <p>-</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
            @endforeach
        </div>
    </div>
    
    <div class="bg-gray-50 p-3 sm:flex justify-end">
        <button
            class="px-3 py-2 bg-green-500 hover:bg-green-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="updateStatus('verified')">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                {{ __('Konfirmasi') }}
            </span>
        </button>

        <button
            class="px-3 py-2 bg-red-500 hover:bg-red-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="updateStatus('rejected')">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
            <span>
                {{ __('Tolak') }}
            </span>
        </button>
    </div>
</div>