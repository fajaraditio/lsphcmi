<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\CompetenceUnit;
use App\Models\Participant;
use Livewire\Component;

class RegisterStep5 extends Component
{
    public $participant;
    public $competenceUnits;
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
    public $currentStep = 5;

    public function mount()
    {
        $this->participant      = Participant::where('user_id', auth()->user()->id)->first();
        $this->competenceUnits  = CompetenceUnit::with('competence_elements.competence_criterias')->get();

        if (empty($this->participant->payment_verified_at)) {
            return redirect()->route('participant.register.4');
        }
    }

    public function back($step = null)
    {
        if (!empty($step)) {
            return redirect()->route('participant.register.' . $step);
        } else {
            return redirect()->route('participant.register.' . $this->currentStep - 1);
        }
    }


    public function render()
    {
        return view('livewire.pages.participant.register-step5');
    }
}
