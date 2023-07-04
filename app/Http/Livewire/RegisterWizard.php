<?php

namespace App\Http\Livewire;

use App\Models\Scheme;
use Livewire\Component;

class RegisterWizard extends Component
{
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
    public $participant;
    public $currentStep = 0;

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

        // $this->currentStep += 1;

        dd($this->participant);

        // $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function thirdStepSubmit()
    {
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

        return view('auth.register', compact('schemes', 'genders'))
            ->layout('layouts.guest');
    }
}
