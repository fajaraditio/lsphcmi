<?php

namespace App\Http\Livewire;

use App\Models\Scheme;
use Livewire\Component;

class RegisterWizard extends Component
{
    protected $wizardViews = [
        '1' => 'step-one',
        '2' => 'step-two',
        '3' => 'step-three',
        '4' => 'step-four',
        '5' => 'step-five',
    ];

    public $schemeId;
    public $currentStep = 2;

    public function firstStepSubmit($schemeId)
    {
        $this->schemeId = $schemeId;

        $this->currentStep = 2;
    }

    public function render()
    {
        $schemes = Scheme::all();
        $genders = [
            [
                'attr' => 'Laki-laki',
                'value' => 'Male',
            ],
            [
                'attr' => 'Perempuan',
                'value' => 'Female',
            ]
        ];

        return view('auth.register', compact('schemes', 'genders'))
            ->layout('layouts.guest');
    }
}
