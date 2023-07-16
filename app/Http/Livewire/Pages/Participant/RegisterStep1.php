<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\Participant;
use App\Models\Scheme;
use Livewire\Component;

class RegisterStep1 extends Component
{
    public $participant;
    public $schemes;
    public $stepWizards = [
        [
            'label'     => 'Mulai',
            'attr'      => 'Memilih Skema',
            'desc'      => 'Memilih salah satu skema sertifikasi yang akan diujikan',
        ],
        [
            'label'     => '2',
            'attr'      => 'Rincian Data Pemohon',
            'desc'      => 'Mengisi rincian data pemohon',
        ],
        [
            'label'     => '3',
            'attr'      => 'Isi Persyaratan Dasar',
            'desc'      => 'Mengisi persyaratan dasar',
        ],
        [
            'label'     => '4',
            'attr'      => 'Informasi Pembayaran',
            'desc'      => 'Mengunggah bukti pembayaran sertifikasi',
        ],
        [
            'label'     => '5',
            'attr'      => 'Asesmen Mandiri',
            'desc'      => 'Mengisi asesmen mandiri',
        ],
    ];
    public $currentStep = 1;

    public function mount()
    {
        $this->schemes = Scheme::all();

        $this->participant = Participant::where('user_id', auth()->user()->id)->first();
    }

    public function save($schemeId)
    {
        Participant::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
            ],
            [
                'name'      => auth()->user()->name,
                'email'     => auth()->user()->email,
                'scheme_id' => $schemeId,
                'step'      => 2,
            ]
        );

        return redirect()->route('participant.register.2');
    }

    public function render()
    {
        return view('livewire.pages.participant.register-step1');
    }
}
