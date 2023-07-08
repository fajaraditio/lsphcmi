<?php

namespace App\Http\Livewire;

use App\Models\Scheme;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegisterWizard extends Component
{
    use WithFileUploads;

    protected $wizardViews = [
        'step-one',
        'step-two',
        'step-three',
        'step-four',
        'step-five',
    ];

    public $stepWizards = [
        [
            'label'     => 'Mulai',
            'attr'      => 'Memilih Skema',
        ],
        [
            'label'     => '2',
            'attr'      => 'Rincian Data Pemohon',
        ],
        [
            'label'     => '3',
            'attr'      => 'Informasi Pembayaran',
        ],
        [
            'label'     => '4',
            'attr'      => 'Unggah Portfolio',
        ],
        [
            'label'     => '5',
            'attr'      => 'Asesmen Mandiri',
        ],
    ];

    public $schemeId;
    public $selectedScheme;
    public $participant;
    public $participantDocs;
    public $currentStep = 4;

    protected $validationAttributes = [
        'participant.name'          => 'Nama Lengkap',
        'participant.identity_number' => 'Nomor KTP / NIK / Paspor',
        'participant.birth_place'   => 'Tempat Lahir',
        'participant.birth_date'    => 'Tanggal Lahir',
        'participant.gender'        => 'Jenis Kelamin',
        'participant.nationality'   => 'Kebangsaan',
        'participant.address'       => 'Alamat Lengkap',
        'participant.city'          => 'Kota',
        'participant.zip_code'      => 'Kode Pos',
        'participant.home_phone_number'     => 'No Telp. Rumah',
        'participant.office_phone_number'   => 'No Telp. Kantor',
        'participant.cell_phone_number'     => 'No Handphone',
        'participant.company_name'          => 'Nama Institusi / Perusahaan',
        'participant.position_at_work'      => 'Jabatan',
        'participant.company_address'       => 'Alamat kantor',
        'participant.company_city'          => 'Kota',
        'participant.company_zip_code'      => 'Kode pos',
        'participant.company_phone_number'  => 'No Telp. Perusahaan',
        'participant.company_fax_number'    => 'No Fax. Perusahaan',
        'participant.company_cell_phone_number' => 'No HP Perusahaan',
        'participant.payment_receipt' => 'Bukti Pembayaran',
        'participant_docs.identity_card'            => 'Scan atau Foto KTP / Paspor / Kartu Identitas Lainnya',
        'participant_docs.graduation_certificate'   => 'Scan atau Foto Ijazah',
        'participant_docs.training_certificate'     => 'Scan atau Foto Sertifikat Pelatihan',
        'participant_docs.references_letter'        => 'Scan atau Foto Surat Keterangan Bekerja',
    ];

    public function mount()
    {
        $this->participant = [];
    }

    public function firstStepSubmit($schemeId)
    {
        $this->schemeId = $schemeId;

        $this->currentStep += 1;

        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'participant.name'          => 'required',
            'participant.identity_number' => 'required',
            'participant.birth_place'   => 'required',
            'participant.birth_date'    => 'required',
            'participant.gender'        => 'required|in:Male,Female',
            'participant.nationality'   => 'required',
            'participant.address'       => 'required',
            'participant.city'          => 'required',
            'participant.zip_code'      => 'required',
            'participant.cell_phone_number'     => 'required',
            'participant.company_name'          => 'required',
            'participant.position_at_work'      => 'required',
            'participant.company_address'       => 'required',
            'participant.company_city'          => 'required',
            'participant.company_zip_code'      => 'required',
            'participant.company_phone_number'  => 'required',
        ]);

        $this->currentStep += 1;

        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function thirdStepSubmit()
    {
        $this->validate([
            'participant.payment_receipt'   => 'required',
        ]);

        $this->selectedScheme = Scheme::find(1);

        $this->currentStep += 1;

        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function fourthStepSubmit()
    {
        $this->currentStep += 1;

        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function fifthStepSubmit()
    {
        $this->currentStep += 1;

        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function backStepSubmit()
    {
        $this->currentStep -= 1;

        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function render()
    {
        $schemes = Scheme::all();
        $genders = [
            [
                'attr'  => __('-- Pilih Jenis Kelamin --'),
                'value' => '',
            ],
            [
                'attr'  => __('Laki-laki'),
                'value' => __('Male'),
            ],
            [
                'attr'  => __('Perempuan'),
                'value' => __('Female'),
            ]
        ];
        $purposes = [
            [
                'attr'  => __('-- Pilih Tujuan Sertifikasi --'),
                'value' => '',
            ],
            [
                'attr'  => __('Sertifikasi'),
                'value' => __('Sertifikasi'),
            ],
            [
                'attr'  => __('Sertifikasi Ulang'),
                'value' => __('Sertifikasi Ulang'),
            ],
            [
                'attr'  => __('Pengakuan Kompetensi Terkini (PKT)'),
                'value' => __('Pengakuan Kompetensi Terkini (PKT)'),
            ],
            [
                'attr'  => __('Rekognisi Pembelajaran Lampau'),
                'value' => __('Rekognisi Pembelajaran Lampau'),
            ],
            [
                'attr'  => __('Lainnya'),
                'value' => __('Lainnya'),
            ],
        ];

        return view('auth.register', compact('schemes', 'genders', 'purposes'))
            ->layout('layouts.guest');
    }
}
