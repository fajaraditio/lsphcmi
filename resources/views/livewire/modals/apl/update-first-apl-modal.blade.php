<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Verifikasi Form APL-01') }}
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

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="address" :value="__('Alamat Lengkap')">
                </x-input-label>
                <p>{{ $participant->address }}</p>
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="city" :value="__('Kota')"></x-input-label>
                <p>{{ $participant->city }}</p>
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="home_phone_number" :value="__('No Telp. Rumah')">
                </x-input-label>
                <p>{{ $participant->home_phone_number ?? '-' }}</p>
            </div>

            <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="office_phone_number" :value="__('No Telp. Kantor')">
                </x-input-label>
                <p>{{ $participant->office_phone_number ?? '-' }}</p>
            </div>

            <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="cell_phone_number" :value="__('No Handphone')">
                </x-input-label>
                <p>{{ $participant->cell_phone_number ?? '-' }}</p>
            </div>
        </div>

        <hr class="my-5">

        <span class="rounded-full bg-gray-500 text-white text-sm p-2">{{ __('B. Data Pekerjaan Sekarang') }}</span>

        <div class="sm:flex w-full mt-5">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="company_name"
                    :value="__('Nama Institusi / Perusahaan')">
                </x-input-label>
                <p>{{ $participant->company_name }}</p>
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="position_at_work" :value="__('Jabatan')">
                </x-input-label>
                <p>{{ $participant->position_at_work }}</p>
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="company_address" :value="__('Alamat Kantor')">
                </x-input-label>
                <p>{{ $participant->company_address }}</p>
            </div>

            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="company_city" :value="__('Kota')">
                </x-input-label>
                <p>{{ $participant->company_city }}</p>
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="company_phone_number"
                    :value="__('No Telp. Perusahaan')"></x-input-label>
                <p>{{ $participant->company_phone_number ?? '-' }}</p>
            </div>

            <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="company_fax_number"
                    :value="__('No Fax. Perusahaan')">
                </x-input-label>
                <p>{{ $participant->company_fax_number ?? '-' }}</p>
            </div>

            <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="company_cell_phone_number"
                    :value="__('No HP Perusahaan')">
                </x-input-label>
                <p>{{ $participant->company_cell_phone_number ?? '-' }}</p>
            </div>
        </div>

        <hr class="my-5">

        <span class="rounded-full bg-gray-500 text-white text-sm p-2">{{ __('C. Persyaratan Dasar') }}</span>

        <div class="sm:flex w-full mt-5">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="identity_card"
                    :value="__('Scan Foto KTP / Paspor / Identitas Lainnya')">
                </x-input-label>
                @if (!empty($participant->docs) && !empty($participant->docs->identity_card))
                <p>
                    Berkas:
                    <a href="{{ url('storage/' . $participant->docs->identity_card) }}"
                        class="text-red-500 underline hover:text-red-700" target="_blank">
                        {{ $participant->docs->identity_card }}
                    </a>
                </p>
                @else
                <p>-</p>
                @endif
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="graduation_certificate" :value="__('Scan Ijazah')">
                </x-input-label>
                @if (!empty($participant->docs) && !empty($participant->docs->graduation_certificate))
                <p>
                    Berkas:
                    <a href="{{ url('storage/' . $participant->docs->graduation_certificate) }}"
                        class="text-red-500 underline hover:text-red-700" target="_blank">
                        {{ $participant->docs->graduation_certificate }}
                    </a>
                </p>
                @else
                <p>-</p>
                @endif
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="training_certificate"
                    :value="__('Scan Sertifikat Pelatihan Kerja yang Relevan')">
                </x-input-label>
                @if (!empty($participant->docs) && !empty($participant->docs->training_certificate))
                <p>
                    Berkas:
                    <a href="{{ url('storage/' . $participant->docs->training_certificate) }}"
                        class="text-red-500 underline hover:text-red-700" target="_blank">
                        {{ $participant->docs->training_certificate }}
                    </a>
                </p>
                @else
                <p>-</p>
                @endif
            </div>
        </div>

        <div class="sm:flex w-full">
            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                <x-input-label class="font-bold text-gray-700" for="references_letter"
                    :value="__('Scan Surat Keterangan Bekerja')">
                </x-input-label>
                @if (!empty($participant->docs) && !empty($participant->docs->references_letter))
                <p>
                    Berkas:
                    <a href="{{ url('storage/' . $participant->docs->references_letter) }}"
                        class="text-red-500 underline hover:text-red-700" target="_blank">
                        {{ $participant->docs->references_letter }}
                    </a>
                </p>
                @else
                <p>-</p>
                @endif
            </div>
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