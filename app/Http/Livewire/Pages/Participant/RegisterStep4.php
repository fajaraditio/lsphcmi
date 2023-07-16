<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\Participant;
use App\Models\ParticipantDoc;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegisterStep4 extends Component
{
    use WithFileUploads;

    public $participant;
    public $participantDoc;
    public $paymentReceiptFile;
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

    protected $rules = [
        'paymentReceiptFile' => 'required|mimes:jpg,png,bmp',
    ];

    protected $validationAttributes = [
        'paymentReceiptFile' => 'Bukti pembayaran',
    ];

    public function mount()
    {
        $this->participant      = Participant::where('user_id', auth()->user()->id)->first();
        $this->participantDoc   = ParticipantDoc::where('participant_id', $this->participant->id)->first();

        if (empty($this->participant->first_apl_verified_at)) {
            return redirect()->route('participant.register.3');
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

    public function save()
    {
        if (empty($this->participant->payment_receipt)) $this->validate();

        $midfix = date('Ymd_Gis') . '_dark' . auth()->user()->id;

        if ($this->paymentReceiptFile) {
            $paymentReceiptFilename  = 'pr_' . $midfix . '.' . $this->paymentReceiptFile->getClientOriginalExtension();
            $paymentReceiptUploaded  = $this->paymentReceiptFile->storeAs('public/docs', $paymentReceiptFilename);
            $this->participant->payment_receipt = str_replace('public/', '', $paymentReceiptUploaded);

            $this->participant->save();
        }

        return redirect()->route('participant.register.5');
    }

    public function render()
    {
        return view('livewire.pages.participant.register-step4');
    }
}
