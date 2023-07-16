<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\Participant;
use App\Models\ParticipantDoc;
use Livewire\Component;

class RegisterStep4 extends Component
{
    public $participant;
    public $participantDoc;
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
        [
            'label'     => 'Selesai',
            'attr'      => 'Pendaftaran Selesai',
            'desc'      => 'Pendaftaran dalam proses pengecekan pembayaran dan berkas',
        ],
    ];
    public $currentStep = 4;

    public function mount()
    {
        $this->participant      = Participant::where('user_id', auth()->user()->id)->first();
        $this->participantDoc   = ParticipantDoc::where('participant_id', $this->participant->id)->first();

        if (empty($this->participant->first_apl_verified_at)) {
            return redirect()->route('participant.register.3');
        }
    }

    public function render()
    {
        return view('livewire.pages.participant.register-step4');
    }
}
