<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Verifikasi Form APL-01') }}
        </h3>
    </div>

    <form wire:submit.prevent="save">
        <div class="bg-white text-sm sm:p-6">

            <span class="rounded-full bg-gray-500 text-white text-sm p-2">{{ __('A. Data Pribadi') }}</span>

            <div class="sm:flex w-full mt-5">
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
                    <x-input-label class="font-bold text-gray-700" for="home_phone_number"
                        :value="__('No Telp. Rumah')"></x-input-label>
                    <p>{{ $participant->home_phone_number ?? '-' }}</p>
                </div>

                <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                    <x-input-label class="font-bold text-gray-700" for="office_phone_number"
                        :value="__('No Telp. Kantor')"></x-input-label>
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
        </div>
    </form>
</div>