<?php

namespace App\Http\Livewire;

use App\Models\CompetenceUnit;
use App\Models\Participant;
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
            'desc'      => 'Memilih salah satu skema sertifikasi yang akan diujikan',
        ],
        [
            'label'     => '2',
            'attr'      => 'Rincian Data Pemohon',
            'desc'      => 'Mengisi rincian data pemohon',
        ],
        [
            'label'     => '3',
            'attr'      => 'Informasi Pembayaran',
            'desc'      => 'Mengunggah bukti pembayaran sertifikasi',
        ],
        [
            'label'     => '4',
            'attr'      => 'Unggah Portfolio',
            'desc'      => 'Mengunggah portfolio dan persyaratan dasar',
        ],
        [
            'label'     => '5',
            'attr'      => 'Asesmen Mandiri',
            'desc'      => 'Mengisi asesmen mandiri',
        ],
    ];

    public $titlePage;
    public $descriptionPage;
    public $schemeId;
    public $selectedScheme;
    public $participant;
    public $participantDocs;
    public $participantCompetencies;
    public $currentStep = 3;

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
        'participant.assignment_purpose'    => 'Tujuan Asesmen',
        'participant.payment_receipt'       => 'Bukti Pembayaran',
        'participantDocs.identity_card'            => 'Scan atau Foto KTP / Paspor / Kartu Identitas Lainnya',
        'participantDocs.graduation_certificate'   => 'Scan atau Foto Ijazah',
        'participantDocs.training_certificate'     => 'Scan atau Foto Sertifikat Pelatihan',
        'participantDocs.references_letter'        => 'Scan atau Foto Surat Keterangan Bekerja',
        'participantCompetencies.*.status'         => 'Status Kompetensi',
        'participantCompetencies.*.relevant_proof' => 'Bukti yang Relevan',
    ];

    public function mount()
    {
        $this->titlePage            = $this->stepWizards[$this->currentStep]['attr'];
        $this->descriptionPage      = $this->stepWizards[$this->currentStep]['desc'];

        $this->participant              = [];
        $this->participantDocs          = [];
        $this->participantCompetencies  = [];
    }

    public function updatePage()
    {
        $this->titlePage            = $this->stepWizards[$this->currentStep]['attr'];
        $this->descriptionPage      = $this->stepWizards[$this->currentStep]['desc'];
    }

    public function firstStepSubmit($schemeId)
    {
        $this->schemeId = $schemeId;

        $this->currentStep += 1;

        $this->updatePage();
        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'participant.name'          => 'required',
            'participant.identity_number' => 'required|numeric',
            'participant.email'         => 'required|email',
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

        $this->updatePage();
        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function thirdStepSubmit()
    {
        $this->validate([
            'participant.payment_receipt'   => 'required',
        ]);

        $filename  = 'pr_' . date('Ymd_Gis') . '_dark' . rand(100, 200) . '.' . $this->participant['payment_receipt']->getClientOriginalExtension();
        $uploaded  = $this->participant['payment_receipt']->storeAs('public/payment_receipt', $filename);

        $this->participant['payment_receipt'] = url('storage/' . str_replace('public/', '', $uploaded));

        $this->selectedScheme = Scheme::find($this->schemeId);

        $this->currentStep += 1;

        $this->updatePage();
        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function fourthStepSubmit()
    {
        $this->validate([
            'participant.assessment_purpose'           => 'required',
            'participantDocs.identity_card'            => 'required',
            'participantDocs.graduation_certificate'   => 'required',
        ]);

        $idCardFilename  = 'idc_' . date('Ymd_Gis') . '_dark' . rand(100, 200) . '.' . $this->participantDocs['identity_card']->getClientOriginalExtension();
        $idCardUploaded  = $this->participantDocs['identity_card']->storeAs('public/docs', $idCardFilename);

        $this->participantDocs['identity_card'] = url('storage/' . str_replace('public/', '', $idCardUploaded));

        $gradCertFilename  = 'gcrt_' . date('Ymd_Gis') . '_dark' . rand(100, 200) . '.' . $this->participantDocs['graduation_certificate']->getClientOriginalExtension();
        $gradCertUploaded  = $this->participantDocs['graduation_certificate']->storeAs('public/docs', $gradCertFilename);

        $this->participantDocs['graduation_certificate'] = url('storage/' . str_replace('public/', '', $gradCertUploaded));

        if ($this->participantDocs['training_certificate']) {
            $trainingCertFilename  = 'tcrt_' . date('Ymd_Gis') . '_dark' . rand(100, 200) . '.' . $this->participantDocs['training_certificate']->getClientOriginalExtension();
            $trainingCertUploaded  = $this->participantDocs['training_certificate']->storeAs('public/docs', $trainingCertFilename);

            $this->participantDocs['training_certificate'] = url('storage/' . str_replace('public/', '', $trainingCertUploaded));
        }

        if ($this->participantDocs['references_letter']) {
            $refLetterFilename  = 'refl_' . date('Ymd_Gis') . '_dark' . rand(100, 200) . '.' . $this->participantDocs['references_letter']->getClientOriginalExtension();
            $refLetterUploaded  = $this->participantDocs['references_letter']->storeAs('public/docs', $refLetterFilename);

            $this->participantDocs['references_letter'] = url('storage/' . str_replace('public/', '', $refLetterUploaded));
        }

        dd($this->participantDocs);

        $this->currentStep += 1;

        $this->updatePage();
        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function fifthStepSubmit()
    {
        $this->validate([
            'participantCompetencies.*.status'          => 'required|in:K,BK',
            'participantCompetencies.*.relevant_proof'  => 'required_if:participantCompetencies.*.status,K',
        ]);

        $participant = Participant::create($this->participant);

        $this->updatePage();
    }

    public function backStepSubmit()
    {
        $this->currentStep -= 1;

        $this->updatePage();
        $this->emit('updateCurrentStep', $this->currentStep);
    }

    public function render()
    {
        $schemes = Scheme::all();
        $competenceUnits = CompetenceUnit::with('competence_elements.competence_criterias')->get();
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

        return view('auth.register', compact('schemes', 'genders', 'purposes', 'competenceUnits'))
            ->layout('layouts.guest');
    }
}
