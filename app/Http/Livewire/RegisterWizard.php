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
            'participant.date_place'    => 'required',
            'participant.date_birth'    => 'required',
            'participant.gender'        => 'required|in:Male,Female',
            'participant.nationality'   => 'required',
            'participant.address'       => 'required',
            'participant.city'          => 'required',
            'participant.zip_code'      => 'required',
            'participant.home_phone_number'     => 'required',
            'participant.office_phone_number'   => 'required',
            'participant.cell_phone_number'     => 'required',
            'participant.company_name'          => 'required',
            'participant.company_address'       => 'required',
            'participant.company_city'          => 'required',
            'participant.company_zip_code'      => 'required',
            'participant.company_phone_number'  => 'required',
            'participant.company_fax_number'    => 'required',
            'participant.company_cell_phone_number' => 'required',
        ]);

        $this->currentStep += 1;

        $this->emit('updateCurrentStep', $this->currentStep);
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
                'attr'  => 'Laki-laki',
                'value' => 'Male',
            ],
            [
                'attr'  => 'Perempuan',
                'value' => 'Female',
            ]
        ];

        return view('auth.register', compact('schemes', 'genders'))
            ->layout('layouts.guest');
    }
}
