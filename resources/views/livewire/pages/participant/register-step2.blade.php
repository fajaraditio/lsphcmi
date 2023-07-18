<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $stepWizards[$currentStep - 1]['attr'] }}
            </h2>
            <p>{{ $stepWizards[$currentStep - 1]['desc'] }}</p>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2">

                <div id="form-wizard" class="p-8">
                    @livewire('components.step-wizard', ['stepWizards' => $stepWizards, 'currentStep' => $currentStep])

                    <div class="pb-5">
                        <b>Skema Pilihan:</b> <span
                            class="rounded-full bg-red-500 hover:bg-red-600 text-white text-sm p-2 cursor-pointer"
                            wire:click="back(1)">{{
                            $participant->scheme->name }}</span>
                    </div>

                    <hr class="mb-5">

                    <span class="rounded-full bg-gray-500 text-white text-sm p-2">{{ __('A. Data Pribadi') }}</span>

                    <div class="sm:flex w-full mt-5">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="name" :value="__('Nama Lengkap')"></x-input-label>
                            <x-text-input id="name" type="text" :value="old('participant.name')"
                                class="block mt-1 w-full" :error="$errors->has('participant.name')"
                                placeholder="Masukkan Nama Lengkap sesuai Kartu Identitas" wire:model="participant.name"
                                required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.name')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="identity_number" :value="__('Nomor KTP / NIK / Paspor')">
                            </x-input-label>
                            <x-text-input id="identity_number" type="text" :value="old('participant.identity_number')"
                                class="block mt-1 w-full" :error="$errors->has('participant.identity_number')"
                                placeholder="Masukkan Nomor KTP / NIK / Paspor, mis: 31200000001"
                                wire:model="participant.identity_number" required>
                            </x-text-input>

                            <x-input-error :messages="$errors->get('participant.identity_number')" class="mt-2" />
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="birth_place" :value="__('Tempat Lahir')"></x-input-label>
                            <x-text-input id="birth_place" type="text" :value="old('participant.birth_place')"
                                :error="$errors->has('participant.birth_place')"
                                placeholder="Masukkan Tempat Lahir, mis: Jakarta" class="block mt-1 w-full"
                                wire:model="participant.birth_place" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.birth_place')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="birth_date" :value="__('Tanggal Lahir')">
                            </x-input-label>
                            <x-text-input id="birth_date" type="date" :value="old('participant.birth_date')"
                                class="block mt-1 w-full" :error="$errors->has('participant.birth_date')"
                                placeholder="Masukkan Tanggal Lahir" wire:model="participant.birth_date" required>
                            </x-text-input>

                            <x-input-error :messages="$errors->get('participant.birth_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="gender" :value="__('Jenis Kelamin')"></x-input-label>
                            <x-select-input id="gender" :value="old('participant.gender')" class="block mt-1 w-full"
                                :options="$genders" wire:model="participant.gender" required>
                            </x-select-input>
                            <x-input-error :messages="$errors->get('participant.gender')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="nationality" :value="__('Kebangsaan')"></x-input-label>
                            <x-text-input id="nationality" type="text" :value="old('participant.nationality')"
                                class="block mt-1 w-full" :error="$errors->has('participant.nationality')"
                                placeholder="Masukkan Kebangsaan, mis: Indonesia" wire:model="participant.nationality"
                                required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.nationality')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="email" :value="__('Email')"></x-input-label>
                            <x-text-input id="email" type="email" :value="old('participant.email')"
                                class="block mt-1 w-full" :error="$errors->has('participant.email')"
                                placeholder="Masukkan Alamat Email" wire:model="participant.email" disabled required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.email')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="address" :value="__('Alamat Lengkap')"></x-input-label>
                            <x-textarea-input id="address" class="block mt-1 w-full h-32"
                                :error="$errors->has('participant.address')"
                                placeholder="Masukkan Alamat Lengkap, mis: Jalan Rawajati"
                                wire:model="participant.address" required>{{
                                old('participant.address') }}
                            </x-textarea-input>
                            <x-input-error :messages="$errors->get('participant.address')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="city" :value="__('Kota')"></x-input-label>
                            <x-text-input id="city" type="text" :value="old('participant.city')"
                                class="block mt-1 w-full sm:w-1/2" :error="$errors->has('participant.city')"
                                placeholder="Masukkan Kota, mis: Jakarta Barat" wire:model="participant.city" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.city')" class="mt-2" />

                            <x-input-label for="zip_code" :value="__('Kode Pos')" class="my-2"></x-input-label>
                            <x-text-input id="zip_code" type="number" :value="old('participant.zip_code')"
                                class="block mt-1 w-full sm:w-1/2" :error="$errors->has('participant.zip_code')"
                                placeholder="Masukkan Kode Pos, mis: 14440" wire:model="participant.zip_code" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.zip_code')" class="mt-2" />
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="home_phone_number" :value="__('No Telp. Rumah')"></x-input-label>
                            <x-text-input id="home_phone_number" type="text"
                                :value="old('participant.home_phone_number')" class="block mt-1 w-full"
                                :error="$errors->has('participant.home_phone_number')"
                                placeholder="Masukkan No Telp. Rumah" wire:model="participant.home_phone_number">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.home_phone_number')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="office_phone_number" :value="__('No Telp. Kantor')"></x-input-label>
                            <x-text-input id="office_phone_number" type="text"
                                :value="old('participant.office_phone_number')" class="block mt-1 w-full"
                                :error="$errors->has('participant.office_phone_number')"
                                placeholder="Masukkan No Telp. Kantor" wire:model="participant.office_phone_number">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.office_phone_number')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="cell_phone_number" :value="__('No Handphone')"></x-input-label>
                            <x-text-input id="cell_phone_number" type="text"
                                :value="old('participant.cell_phone_number')" class="block mt-1 w-full"
                                :error="$errors->has('participant.cell_phone_number')"
                                placeholder="Masukkan No Handphone" wire:model="participant.cell_phone_number" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.cell_phone_number')" class="mt-2" />
                        </div>
                    </div>

                    <hr class="my-5">

                    <span class="rounded-full bg-gray-500 text-white text-sm p-2">{{ __('B. Data Pekerjaan
                        Sekarang')
                        }}</span>

                    <div class="sm:flex w-full mt-5">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="company_name" :value="__('Nama Institusi / Perusahaan')">
                            </x-input-label>
                            <x-text-input id="company_name" type="text" :value="old('participant.company_name')"
                                class="block mt-1 w-full" :error="$errors->has('participant.company_name')"
                                placeholder="Masukkan Nama Institusi / Perusahaan" wire:model="participant.company_name"
                                required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.company_name')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="position_at_work" :value="__('Jabatan')">
                            </x-input-label>
                            <x-text-input id="position_at_work" type="text" :value="old('participant.position_at_work')"
                                class="block mt-1 w-full" :error="$errors->has('participant.position_at_work')"
                                placeholder="Masukkan Jabatan atau Posisi Pekerjaan"
                                wire:model="participant.position_at_work" required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.position_at_work')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="company_address" :value="__('Alamat Kantor')"></x-input-label>
                            <x-textarea-input id="company_address" class="block mt-1 w-full h-32"
                                :error="$errors->has('participant.company_address')"
                                placeholder="Masukkan Alamat Kantor, mis: Jalan Panjang No. 63"
                                wire:model="participant.company_address" required>{{
                                old('participant.company_address') }}
                            </x-textarea-input>
                            <x-input-error :messages="$errors->get('participant.company_address')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                            <x-input-label for="company_city" :value="__('Kota')"></x-input-label>
                            <x-text-input id="company_city" type="text" :value="old('participant.company_city')"
                                class="block mt-1 w-full sm:w-1/2" :error="$errors->has('participant.company_city')"
                                placeholder="Masukkan Kota, mis: Jakarta Barat" wire:model="participant.company_city"
                                required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.company_city')" class="mt-2" />

                            <x-input-label for="company_zip_code" :value="__('Kode Pos')" class="my-2">
                            </x-input-label>
                            <x-text-input id="company_zip_code" type="number"
                                :value="old('participant.company_zip_code')" class="block mt-1 w-full sm:w-1/2"
                                :error="$errors->has('participant.company_zip_code')"
                                placeholder="Masukkan Kode Pos, mis: 14440" wire:model="participant.company_zip_code"
                                required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.company_zip_code')" class="mt-2" />
                        </div>
                    </div>

                    <div class="sm:flex w-full">
                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="company_phone_number" :value="__('No Telp. Perusahaan')">
                            </x-input-label>
                            <x-text-input id="company_phone_number" type="text"
                                :value="old('participant.company_phone_number')" class="block mt-1 w-full"
                                :error="$errors->has('participant.company_phone_number')"
                                placeholder="Masukkan No Telp. Perusahaan" wire:model="participant.company_phone_number"
                                required>
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.company_phone_number')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="company_fax_number" :value="__('No Fax. Perusahaan')">
                            </x-input-label>
                            <x-text-input id="company_fax_number" type="text"
                                :value="old('participant.company_fax_number')" class="block mt-1 w-full"
                                :error="$errors->has('participant.company_fax_number')"
                                placeholder="Masukkan No Fax. Perusahaan" wire:model="participant.company_fax_number">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.company_fax_number')" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                            <x-input-label for="company_cell_phone_number" :value="__('No HP Perusahaan')">
                            </x-input-label>
                            <x-text-input id="company_cell_phone_number" type="text"
                                :value="old('participant.company_cell_phone_number')" class="block mt-1 w-full"
                                :error="$errors->has('participant.company_cell_phone_number')"
                                placeholder="Masukkan No HP Perusahaan"
                                wire:model="participant.company_cell_phone_number">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('participant.company_cell_phone_number')"
                                class="mt-2" />
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="flex justify-between">
                        <x-secondary-button wire:click="back()">Sebelumnya</x-secondary-button>
                        <x-primary-button wire:click="save()">Selanjutnya</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>