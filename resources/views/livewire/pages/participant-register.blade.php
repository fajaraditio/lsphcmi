<div>

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $titlePage }}
            </h2>
            <p>{{ $descriptionPage }}</p>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm px-3">

                <div id="form-wizard" class="pb-6">
                    @csrf

                    @livewire('components.step-wizard', ['stepWizards' => $stepWizards, 'currentStep' => $currentStep])

                    <div id="step-one" class="{{ $currentStep !== 0 ? 'hidden' : '' }}">
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

                    <div id="step-two" class="{{ $currentStep !== 1 ? 'hidden' : '' }}">
                        <span class="rounded-full bg-gray-500 text-white text-sm p-2">{{ __('A. Data Pribadi') }}</span>

                        <div class="sm:flex w-full mt-5">
                            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                                <x-input-label for="name" :value="__('Nama Lengkap')"></x-input-label>
                                <x-text-input id="name" type="text" :value="old('participant.name')"
                                    class="block mt-1 w-full" :error="$errors->has('participant.name')"
                                    placeholder="Masukkan Nama Lengkap sesuai Kartu Identitas"
                                    wire:model="participant.name" required>
                                </x-text-input>
                                <x-input-error :messages="$errors->get('participant.name')" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                                <x-input-label for="identity_number" :value="__('Nomor KTP / NIK / Paspor')">
                                </x-input-label>
                                <x-text-input id="identity_number" type="text"
                                    :value="old('participant.identity_number')" class="block mt-1 w-full"
                                    :error="$errors->has('participant.identity_number')"
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
                                <x-select-input id="gender" type="text" :value="old('participant.gender')"
                                    class="block mt-1 w-full" :options="$genders" wire:model="participant.gender"
                                    required>
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
                                    placeholder="Masukkan Kebangsaan, mis: Indonesia"
                                    wire:model="participant.nationality" required>
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
                                    placeholder="Masukkan Alamat Email" wire:model="participant.email" required>
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
                                    placeholder="Masukkan Kota, mis: Jakarta Barat" wire:model="participant.city"
                                    required>
                                </x-text-input>
                                <x-input-error :messages="$errors->get('participant.city')" class="mt-2" />

                                <x-input-label for="zip_code" :value="__('Kode Pos')" class="my-2"></x-input-label>
                                <x-text-input id="zip_code" type="number" :value="old('participant.zip_code')"
                                    class="block mt-1 w-full sm:w-1/2" :error="$errors->has('participant.zip_code')"
                                    placeholder="Masukkan Kode Pos, mis: 14440" wire:model="participant.zip_code"
                                    required>
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
                                <x-input-error :messages="$errors->get('participant.office_phone_number')"
                                    class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                                <x-input-label for="cell_phone_number" :value="__('No Handphone')"></x-input-label>
                                <x-text-input id="cell_phone_number" type="text"
                                    :value="old('participant.cell_phone_number')" class="block mt-1 w-full"
                                    :error="$errors->has('participant.cell_phone_number')"
                                    placeholder="Masukkan No Handphone" wire:model="participant.cell_phone_number"
                                    required>
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
                                    placeholder="Masukkan Nama Institusi / Perusahaan"
                                    wire:model="participant.company_name" required>
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
                                <x-text-input id="position_at_work" type="text"
                                    :value="old('participant.position_at_work')" class="block mt-1 w-full"
                                    :error="$errors->has('participant.position_at_work')"
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
                                    placeholder="Masukkan Kota, mis: Jakarta Barat"
                                    wire:model="participant.company_city" required>
                                </x-text-input>
                                <x-input-error :messages="$errors->get('participant.company_city')" class="mt-2" />

                                <x-input-label for="company_zip_code" :value="__('Kode Pos')" class="my-2">
                                </x-input-label>
                                <x-text-input id="company_zip_code" type="number"
                                    :value="old('participant.company_zip_code')" class="block mt-1 w-full sm:w-1/2"
                                    :error="$errors->has('participant.company_zip_code')"
                                    placeholder="Masukkan Kode Pos, mis: 14440"
                                    wire:model="participant.company_zip_code" required>
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
                                    placeholder="Masukkan No Telp. Perusahaan"
                                    wire:model="participant.company_phone_number" required>
                                </x-text-input>
                                <x-input-error :messages="$errors->get('participant.company_phone_number')"
                                    class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/3 my-2 sm:mr-2">
                                <x-input-label for="company_fax_number" :value="__('No Fax. Perusahaan')">
                                </x-input-label>
                                <x-text-input id="company_fax_number" type="text"
                                    :value="old('participant.company_fax_number')" class="block mt-1 w-full"
                                    :error="$errors->has('participant.company_fax_number')"
                                    placeholder="Masukkan No Fax. Perusahaan"
                                    wire:model="participant.company_fax_number">
                                </x-text-input>
                                <x-input-error :messages="$errors->get('participant.company_fax_number')"
                                    class="mt-2" />
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
                            <x-secondary-button wire:click="backStepSubmit()">Sebelumnya</x-secondary-button>
                            <x-primary-button wire:click="secondStepSubmit()">Selanjutnya</x-primary-button>
                        </div>
                    </div>

                    <div id="step-three" class="{{ $currentStep !== 2 ? 'hidden' : '' }}">
                        <div class="p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                            role="alert">
                            <span class="font-medium">💡 Informasi Pembayaran</span>
                            <p>
                                Silakan lakukan pembayaran ke rekening BRI a/n LSP HCMI
                                dengan nomor rekening 1167.0100.0254.305 lalu unggah melalui form di bawah ini
                            </p>
                        </div>

                        <div class="sm:flex w-full mt-5">
                            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                                <x-input-label for="payment_receipt" :value="__('Unggah Bukti Pembayaran')">
                                </x-input-label>
                                <x-file-input id="payment_receipt" :value="old('participant.payment_receipt_file')"
                                    class="block mt-1 w-full" :error="$errors->has('participant.payment_receipt_file')"
                                    placeholder="Masukkan Nama Lengkap sesuai Kartu Identitas"
                                    wire:model="participant.payment_receipt_file" accept="image/*"
                                    :allowed-exts="['PNG', 'BMP', 'JPG']" required>
                                </x-file-input>
                                <x-input-error :messages="$errors->get('participant.payment_receipt_file')"
                                    class="mt-2" />
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="sm:flex w-full mt-5">
                            @if ($participant && array_key_exists('payment_receipt_file', $participant))
                            <img src="{{ ($participant['payment_receipt_file'])->temporaryUrl() }}" class="w-48 h-auto"
                                alt="Temporary Preview Image">
                            @endif
                        </div>

                        <hr class="my-5">

                        <div class="flex justify-between">
                            <x-secondary-button wire:click="backStepSubmit()">Sebelumnya</x-secondary-button>
                            <x-primary-button wire:click="thirdStepSubmit()">Selanjutnya</x-primary-button>
                        </div>
                    </div>

                    <div id="step-four" class="{{ $currentStep !== 3 ? 'hidden' : '' }}">

                        <div class="sm:flex w-full mt-5">
                            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                                <x-input-label for="name" :value="__('Judul Skema Asesmen')"></x-input-label>
                                <x-text-input id="name" type="text" class="block mt-1 w-full"
                                    :value="$selectedScheme ? $selectedScheme->name : ''" disabled>
                                </x-text-input>
                            </div>
                        </div>

                        <div class="sm:flex w-full mt-3">
                            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                                <x-input-label for="assessment_purpose" :value="__('Tujuan Asesmen')"></x-input-label>
                                <x-select-input id="assessment_purpose" type="text"
                                    :value="old('participant.assessment_purpose')" class="block mt-1 w-full"
                                    :options="$purposes" wire:model="participant.assessment_purpose" required>
                                </x-select-input>
                                <x-input-error :messages="$errors->get('participant.assessment_purpose')"
                                    class="mt-2" />
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="sm:flex w-full mt-3">
                            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                                <x-input-label for="identity_card"
                                    :value="__('Scan KTP / Paspor / Kartu Identitas Lainnya')">
                                </x-input-label>
                                <x-file-input id="identity_card" :value="old('participantDocs.identity_card')"
                                    class="block mt-1 w-full" :error="$errors->has('participantDocs.identity_card')"
                                    placeholder="Masukkan Scan Kartu Identitas"
                                    wire:model="participantDocs.identity_card" accept="application/pdf"
                                    :allowed-exts="['PDF']" required>
                                </x-file-input>
                                <x-input-error :messages="$errors->get('participantDocs.identity_card')" class="mt-2" />
                            </div>
                        </div>

                        <div class="sm:flex w-full mt-3">
                            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                                <x-input-label for="graduation_certificate"
                                    :value="__('Scan Ijazah Minimal D3 Sederajat')">
                                </x-input-label>
                                <x-file-input id="graduation_certificate"
                                    :value="old('participantDocs.graduation_certificate')" class="block mt-1 w-full"
                                    :error="$errors->has('participantDocs.graduation_certificate')"
                                    placeholder="Masukkan Scan Ijazah"
                                    wire:model="participantDocs.graduation_certificate" accept="application/pdf"
                                    :allowed-exts="['PDF']" required>
                                </x-file-input>
                                <x-input-error :messages="$errors->get('participantDocs.graduation_certificate')"
                                    class="mt-2" />
                            </div>
                        </div>

                        <div class="sm:flex w-full mt-3">
                            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                                <x-input-label for="training_certificate"
                                    :value="__('Scan Sertifikat Pelatihan Kerja (jika ada)')">
                                </x-input-label>
                                <x-file-input id="training_certificate"
                                    :value="old('participantDocs.training_certificate')" class="block mt-1 w-full"
                                    :error="$errors->has('participantDocs.training_certificate')"
                                    placeholder="Masukkan Scan Sertifikat Pelatihan Kerja"
                                    wire:model="participantDocs.training_certificate" accept="application/pdf"
                                    :allowed-exts="['PDF']">
                                </x-file-input>
                                <x-input-error :messages="$errors->get('participantDocs.training_certificate')"
                                    class="mt-2" />
                            </div>
                        </div>

                        <div class="sm:flex w-full mt-3">
                            <div class="w-full sm:w-1/2 my-2 sm:mr-2">
                                <x-input-label for="references_letter"
                                    :value="__('Scan Surat Keterangan Bekerja di bidang yang relevan dengan skema (jika ada)')">
                                </x-input-label>
                                <x-file-input id="references_letter" :value="old('participantDocs.references_letter')"
                                    class="block mt-1 w-full" :error="$errors->has('participantDocs.references_letter')"
                                    placeholder="Masukkan Scan Sertifikat Pelatihan Kerja"
                                    wire:model="participantDocs.references_letter" accept="application/pdf"
                                    :allowed-exts="['PDF']">
                                </x-file-input>
                                <x-input-error :messages="$errors->get('participantDocs.references_letter')"
                                    class="mt-2" />
                            </div>
                        </div>

                        <hr class="my-5">

                        <div class="flex justify-between">
                            <x-secondary-button wire:click="backStepSubmit()">Sebelumnya</x-secondary-button>
                            <x-primary-button wire:click="fourthStepSubmit()">Selanjutnya</x-primary-button>
                        </div>
                    </div>

                    <div id="step-five" class="{{ $currentStep !== 4 ? 'hidden' : '' }}">

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
                                    <tr>
                                        <td class="border border-slate-300 p-2">{{ $competenceElement->no . '.' .
                                            $competenceCriteria->no }}</td>
                                        <td class="border border-slate-300 w-2/5 p-2">{{ $competenceCriteria->title }}
                                        </td>
                                        <td class="border border-slate-300 p-2">
                                            <input type="radio"
                                                name="participantCompetencies[{{ $competenceCriteria->id }}][status]"
                                                wire:model="participantCompetencies.{{ $competenceCriteria->id }}.status"
                                                class="appearance-none default:ring text-red-500 checked:bg-red-500 focus:ring-red-400"
                                                value="K">
                                        </td>
                                        <td class="border border-slate-300 p-2">
                                            <input type="radio"
                                                name="participantCompetencies[{{ $competenceCriteria->id }}][status]"
                                                wire:model="participantCompetencies.{{ $competenceCriteria->id }}.status"
                                                class="appearance-none default:ring text-red-500 checked:bg-red-500 focus:ring-red-400"
                                                value="BK">
                                        </td>
                                        <td class="border border-slate-300 p-2">
                                            <x-file-input id="relevant_proof" class="block mt-1 w-full" :error="$errors->has('participantCompetencies.' .
                                                $competenceCriteria->id . '.relevant_proof')"
                                                wire:model="participantCompetencies.{{ $competenceCriteria->id }}.relevant_proof"
                                                placeholder="Masukkan Bukti yang Relevan" accept="application/pdf"
                                                :allowed-exts="['PDF']" :disabled="empty($participantCompetencies[$competenceCriteria->
                                                id]['status']) ||
                                                $participantCompetencies[$competenceCriteria->id]['status'] ==
                                                'BK'">
                                            </x-file-input>
                                            <x-input-error :messages="$errors->get('participantCompetencies.' .
                                                $competenceCriteria->id . '.relevant_proof')" class="mt-2" />
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>

                            @endforeach
                        </div>

                        <hr class="my-5">

                        <div class="flex justify-between">
                            <x-secondary-button wire:click="backStepSubmit()">Sebelumnya</x-secondary-button>
                            <x-primary-button wire:click="fifthStepSubmit()">Selesai</x-primary-button>
                        </div>
                    </div>


                    <div id="finish" class="{{ $currentStep !== 5 ? 'hidden' : '' }}">

                        <div class="w-full mt-5">
                            <div class="p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400"
                                role="alert">
                                <span class="font-medium">⌛️ Pendaftaran Anda sedang kami tinjau</span>
                                <p>
                                    Mohon menunggu 1 x 24 jam untuk kami meninjau berkas dan bukti pembayaran Anda. Jika
                                    telah melewati proses peninjauan akan kami kirimkan email berisikan detail akun
                                    asesmen Anda.
                                </p>
                            </div>
                        </div>

                        <hr class="my-5">

                        <div class="flex justify-center">
                            <x-primary-button onclick="window.location.href='{{ url('/') }}'">Kembali ke Halaman Depan
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>