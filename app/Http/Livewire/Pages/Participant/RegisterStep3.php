<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\Participant;
use App\Models\ParticipantDoc;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegisterStep3 extends Component
{
    use WithFileUploads;

    public $participant;
    public $participantDocs;
    public $purposes = [
        [
            'attr'  => '-- Pilih Tujuan Sertifikasi --',
            'value' => '',
        ],
        [
            'attr'  => 'Sertifikasi',
            'value' => 'Sertifikasi',
        ],
        [
            'attr'  => 'Sertifikasi Ulang',
            'value' => 'Sertifikasi Ulang',
        ],
        [
            'attr'  => 'Pengakuan Kompetensi Terkini (PKT)',
            'value' => 'Pengakuan Kompetensi Terkini (PKT)',
        ],
        [
            'attr'  => 'Rekognisi Pembelajaran Lampau',
            'value' => 'Rekognisi Pembelajaran Lampau',
        ],
        [
            'attr'  => 'Lainnya',
            'value' => 'Lainnya',
        ],
    ];
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
    public $currentStep = 3;

    protected $rules = [
        'participant.assessment_purpose'            => 'required',
        'participantDocs.identity_card'             => 'required|mimes:pdf',
        'participantDocs.graduation_certificate'    => 'required|mimes:pdf',
        'participantDocs.training_certificate'      => 'nullable|mimes:pdf',
        'participantDocs.references_letter'         => 'nullable|mimes:pdf',
    ];

    protected $validationAttributes = [
        'participant.assessment_purpose'            => 'Tujuan Asesmen',
        'participantDocs.identity_card'             => 'Scan KTP / Paspor / Kartu Identitas Lainnya',
        'participantDocs.graduation_certificate'    => 'Scan Ijazah Minimal D3 Sederajat',
        'participantDocs.training_certificate'      => 'Scan Sertifikat Pelatihan Kerja',
        'participantDocs.references_letter'         => 'Scan Surat Keterangan Bekerja',
    ];


    public function mount()
    {
        $this->participant      = Participant::where('user_id', auth()->user()->id)->first();
        $this->participantDocs  = [];
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
        $this->validate();

        $midfix = date('Ymd_Gis') . '_dark' . auth()->user()->id;

        $idCardFilename  = 'idc_' . $midfix . '.' . $this->participantDocs['identity_card']->getClientOriginalExtension();
        $idCardUploaded  = $this->participantDocs['identity_card']->storeAs('public/docs', $idCardFilename);
        $this->participantDocs['identity_card'] = str_replace('public/', '', $idCardUploaded);

        $gradCertFilename  = 'gcrt_' . $midfix . '.' . $this->participantDocs['graduation_certificate']->getClientOriginalExtension();
        $gradCertUploaded  = $this->participantDocs['graduation_certificate']->storeAs('public/docs', $gradCertFilename);
        $this->participantDocs['graduation_certificate'] = str_replace('public/', '', $gradCertUploaded);

        if (array_key_exists('training_certificate', $this->participantDocs)) {
            $trainingCertFilename  = 'tcrt_' . $midfix . '.' . $this->participantDocs['training_certificate']->getClientOriginalExtension();
            $trainingCertUploaded  = $this->participantDocs['training_certificate']->storeAs('public/docs', $trainingCertFilename);
            $this->participantDocs['training_certificate'] = str_replace('public/', '', $trainingCertUploaded);
        }
        if (array_key_exists('references_letter', $this->participantDocs)) {
            $refLetterFilename  = 'refl_' . $midfix . '.' . $this->participantDocs['references_letter']->getClientOriginalExtension();
            $refLetterUploaded  = $this->participantDocs['references_letter']->storeAs('public/docs', $refLetterFilename);
            $this->participantDocs['references_letter'] = str_replace('public/', '', $refLetterUploaded);
        }

        $this->participant->step = 4;
        $this->participant->save();

        ParticipantDoc::updateOrCreate(['participant_id' => $this->participant->id], $this->participantDocs);

        return redirect()->route('participant.register.4');
    }

    public function render()
    {
        return view('livewire.pages.participant.register-step3');
    }
}
