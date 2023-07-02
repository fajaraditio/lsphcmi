<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Memilih Skema Sertifikasi') }}
    </h2>
    <p>{{ __('Memilih salah satu skema sertifikasi yang akan diujikan') }}</p>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm px-3">

            <div id="step-wizard" class="mb-5 py-3 border-b border-gray-100">
                <ol class="flex justify-between items-center w-full">
                    <li
                        class="flex w-1/4 items-center text-red-600 dark:text-red-500 after:content-[''] after:w-full after:h-1 after:border-b after:border-red-100 after:border-4 after:inline-block dark:after:border-red-800">
                        <span
                            class="flex items-center justify-center w-10 h-10 bg-red-100 rounded-full lg:h-12 lg:w-12 dark:bg-red-800 shrink-0">
                            <small>{{ __('Mulai') }}</small>
                        </span>
                    </li>
                    <li
                        class="flex w-1/2 items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700 before:content-[''] before:w-full before:h-1 before:border-b before:border-red-100 before:border-4 before:inline-block dark:before:border-red-800">
                        <span
                            class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                            {{ __('1') }}
                        </span>
                    </li>
                    <li
                        class="flex w-1/2 items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700 before:content-[''] before:w-full before:h-1 before:border-b before:border-gray-100 before:border-4 before:inline-block dark:before:border-gray-700">
                        <span
                            class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                            {{ __('2') }}
                        </span>
                    </li>
                    <li
                        class="flex w-1/2 items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700 before:content-[''] before:w-full before:h-1 before:border-b before:border-gray-100 before:border-4 before:inline-block dark:before:border-gray-700">
                        <span
                            class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                            {{ __('3') }}
                        </span>
                    </li>
                    <li
                        class="flex w-1/4 items-center before:content-[''] before:w-full before:h-1 before:border-b before:border-gray-100 before:border-4 before:inline-block dark:before:border-gray-700">
                        <span
                            class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                            {{ __('4') }}
                        </span>
                    </li>
                </ol>
                <ol class="flex justify-between items-center w-full text-sm text-center">
                    <li
                        class="flex w-1/4 items-center text-red-600 dark:text-red-500 after:content-[''] after:w-full after:h-1 after:inline-block">
                        {{ __('Memilih Skema') }}
                    </li>
                    <li
                        class="flex w-1/2 items-center after:content-[''] after:w-full after:h-1 before:content-[''] before:w-full before:h-1 before:inline-block">
                        {{ __('Rincian Data Pemohon') }}
                    </li>
                    <li
                        class="flex w-1/2 items-center after:content-[''] after:w-full after:h-1 before:content-[''] before:w-full before:h-1 before:inline-block">
                        {{ __('Informasi Pembayaran') }}
                    </li>
                    <li
                        class="flex w-1/2 items-center after:content-[''] after:w-full after:h-1 before:content-[''] before:w-full before:h-1 before:inline-block">
                        {{ __('Unggah Portfolio') }}
                    </li>
                    <li
                        class="flex w-1/4 items-center before:content-[''] before:w-full before:h-1 before:inline-block">
                        {{ __('Asesmen Mandiri') }}
                    </li>
                </ol>
            </div>

            <div id="form-wizard" class="pb-6">
                @csrf

                <div id="step-one" class="{{ $currentStep !== 1 ? 'hidden' : '' }}">
                    @foreach ($schemes as $scheme)
                    <ul>
                        <li class="border-1 border-b border-gray-100 py-2">
                            <button wire:click="firstStepSubmit({{ $scheme->id }})" class="hover:underline">
                                {{ $scheme->name }}
                            </button>
                        </li>
                    </ul>

                    @endforeach
                </div>

                <div id="step-two" class="{{ $currentStep !== 2 ? 'hidden' : '' }}">
                    <span class="rounded-full bg-gray-500 text-white text-sm p-2">{{ __('A. Data Pribadi') }}</span>

                    <div class="sm:flex w-full mt-5">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="name" :value="__('Nama Lengkap')"></x-input-label>
                            <x-text-input id="name" type="text" :value="old('name')" class="block mt-1 w-full"
                                placeholder="Masukkan Nama Lengkap sesuai Kartu Identitas" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="identity_number" :value="__('Nomor KTP / NIK / Paspor')">
                            </x-input-label>
                            <x-text-input id="identity_number" type="text" :value="old('identity_number')"
                                class="block mt-1 w-full"
                                placeholder="Masukkan Nomor KTP / NIK / Paspor, mis: 31200000001" required>
                            </x-text-input>

                            <x-input-error :messages="$errors->get('identity_number')" class="mt-2" />
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="birth_place" :value="__('Tempat Lahir')"></x-input-label>
                            <x-text-input id="birth_place" type="text" :value="old('birth_place')"
                                placeholder="Masukkan Tempat Lahir, mis: Jakarta" class="block mt-1 w-full" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('birth_place')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="birth_date" :value="__('Tanggal Lahir')">
                            </x-input-label>
                            <x-text-input id="birth_date" type="date" :value="old('birth_date')"
                                class="block mt-1 w-full" placeholder="Masukkan Tanggal Lahir" required>
                            </x-text-input>

                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="gender" :value="__('Jenis Kelamin')"></x-input-label>
                            <x-select-input id="gender" type="text" :value="old('gender')" class="block mt-1 w-full"
                                :options="$genders" required>
                            </x-select-input>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="nationality" :value="__('Kebangsaan')"></x-input-label>
                            <x-text-input id="nationality" type="text" :value="old('nationality')"
                                class="block mt-1 w-full" placeholder="Masukkan Kebangsaan, mis: Indonesia" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="address" :value="__('Alamat Lengkap')"></x-input-label>
                            <x-textarea-input id="address" class="block mt-1 w-full h-32"
                                placeholder="Masukkan Alamat Lengkap, mis: Jalan Rawajati" required>{{ old('address') }}
                            </x-textarea-input>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="city" :value="__('Kota')"></x-input-label>
                            <x-text-input id="city" type="text" :value="old('city')" class="block mt-1 w-full sm:w-1/2"
                                placeholder="Masukkan Kota, mis: Jakarta Barat" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />

                            <x-input-label for="zip_code" :value="__('Kode Pos')" class="my-2"></x-input-label>
                            <x-text-input id="zip_code" type="number" :value="old('zip_code')"
                                class="block mt-1 w-full sm:w-1/2" placeholder="Masukkan Kode Pos, mis: 14440" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="home_phone_number" :value="__('No Telp. Rumah')"></x-input-label>
                            <x-text-input id="home_phone_number" type="text" :value="old('home_phone_number')"
                                class="block mt-1 w-full" placeholder="Masukkan No Telp. Rumah">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('home_phone_number')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="office_phone_number" :value="__('No Telp. Kantor')"></x-input-label>
                            <x-text-input id="office_phone_number" type="text" :value="old('office_phone_number')"
                                class="block mt-1 w-full" placeholder="Masukkan No Telp. Kantor">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('office_phone_number')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="cell_phone_number" :value="__('No Handphone')"></x-input-label>
                            <x-text-input id="cell_phone_number" type="text" :value="old('cell_phone_number')"
                                class="block mt-1 w-full" placeholder="Masukkan No Handphone">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('cell_phone_number')" class="mt-2" />
                        </div>
                    </div>

                    <hr class="my-5">

                    <span class="rounded-full bg-gray-500 text-white text-sm p-2">{{ __('B. Data Pekerjaan Sekarang')
                        }}</span>

                    <div class="sm:flex w-full mt-5">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="company_name" :value="__('Nama Institusi / Perusahaan')">
                            </x-input-label>
                            <x-text-input id="company_name" type="text" :value="old('company_name')"
                                class="block mt-1 w-full" placeholder="Masukkan Nama Institusi / Perusahaan" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="working_position" :value="__('Jabatan')">
                            </x-input-label>
                            <x-text-input id="working_position" type="text" :value="old('working_position')"
                                class="block mt-1 w-full" placeholder="Masukkan Jabatan atau Posisi Pekerjaan" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('working_position')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="company_address" :value="__('Alamat Kantor')"></x-input-label>
                            <x-textarea-input id="company_address" class="block mt-1 w-full h-32"
                                placeholder="Masukkan Alamat Kantor, mis: Jalan Panjang No. 63" required>{{
                                old('address') }}
                            </x-textarea-input>
                            <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="company_city" :value="__('Kota')"></x-input-label>
                            <x-text-input id="company_city" type="text" :value="old('company_city')"
                                class="block mt-1 w-full sm:w-1/2" placeholder="Masukkan Kota, mis: Jakarta Barat"
                                required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('company_city')" class="mt-2" />

                            <x-input-label for="company_zip_code" :value="__('Kode Pos')" class="my-2"></x-input-label>
                            <x-text-input id="company_zip_code" type="number" :value="old('company_zip_code')"
                                class="block mt-1 w-full sm:w-1/2" placeholder="Masukkan Kode Pos, mis: 14440" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('company_zip_code')" class="mt-2" />
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="company_phone_number" :value="__('No Telp. Perusahaan')">
                            </x-input-label>
                            <x-text-input id="company_phone_number" type="text" :value="old('company_phone_number')"
                                class="block mt-1 w-full" placeholder="Masukkan No Telp. Perusahaan">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('company_phone_number')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="company_fax_number" :value="__('No Fax. Perusahaan')"></x-input-label>
                            <x-text-input id="company_fax_number" type="text" :value="old('company_fax_number')"
                                class="block mt-1 w-full" placeholder="Masukkan No Fax. Perusahaan">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('company_fax_number')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="company_cell_phone_number" :value="__('No HP Perusahaan')">
                            </x-input-label>
                            <x-text-input id="company_cell_phone_number" type="text"
                                :value="old('company_cell_phone_number')" class="block mt-1 w-full"
                                placeholder="Masukkan No HP Perusahaan">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('company_cell_phone_number')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>