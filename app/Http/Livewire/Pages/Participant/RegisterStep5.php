<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\CompetenceCriteria;
use App\Models\CompetenceUnit;
use App\Models\Participant;
use App\Models\ParticipantCompetency;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegisterStep5 extends Component
{
    use WithFileUploads;

    public $participant;
    public $participantCompetencies;
    public $competenceUnits;
    public $competenceCriterias;
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

    protected $validationAttributes = [
        'participantCompetencies.*'                 => 'Kriteria',
        'participantCompetencies.*.status'          => 'Jawaban Kriteria',
        'participantCompetencies.*.relevant_proof'  => 'Bukti Relevan',
    ];

    public function mount()
    {
        $this->participant              = Participant::where('user_id', auth()->user()->id)->first();
        $this->competenceUnits          = CompetenceUnit::with('competence_elements.competence_criterias')->get();
        $this->competenceCriterias      = CompetenceCriteria::get();
        $this->participantCompetencies  = [];

        foreach ($this->competenceCriterias as $criteria) {
            $this->participantCompetencies[$criteria->id]['status']         = null;
            $this->participantCompetencies[$criteria->id]['relevant_proof'] = null;
            $this->participantCompetencies[$criteria->id]['relevant_proof_path'] = null;

            $participantCriteria = ParticipantCompetency::where('participant_id', $this->participant->id)
                ->where('competence_criteria_id', $criteria->id)
                ->first();

            if (!empty($participantCriteria)) {
                $this->participantCompetencies[$criteria->id]['status'] = $participantCriteria->status;
                $this->participantCompetencies[$criteria->id]['relevant_proof_path'] = $participantCriteria->relevant_proof;
            }
        }

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

    public function save()
    {
        $validateData = [];
        foreach ($this->competenceCriterias as $criteria) {
            $validateData = array_merge(
                $validateData,
                [
                    'participantCompetencies.' . $criteria->id                      => 'required',
                    'participantCompetencies.' . $criteria->id . '.status'          => 'required|in:K,BK',
                    'participantCompetencies.' . $criteria->id . '.relevant_proof'  => (empty($this->participantCompetencies[$criteria->id]['relevant_proof_path']) ? 'required_if:participantCompetencies.' . $criteria->id . '.status,K' : null) . '|nullable|mimes:pdf',
                ]
            );
        }

        $this->validate($validateData);

        foreach ($this->participantCompetencies as $criteriaId => $competency) {
            $competenceRelProof = null;

            // Submit Relevant Proof If Exists
            if (array_key_exists('relevant_proof', $competency) && $competency['status'] === 'K') {
                if (empty($competency['relevant_proof_path'])) {
                    $relProofFilename   = 'rproof_' . date('Ymd_Gis') . '_dark' . rand(100, 200) . '.' . $competency['relevant_proof']->getClientOriginalExtension();
                    $relProofUploaded   = $competency['relevant_proof']->storeAs('public/docs', $relProofFilename);
                    $competenceRelProof = str_replace('public/', '', $relProofUploaded);
                } else {
                    $competenceRelProof = $competency['relevant_proof_path'];
                }
            }

            // Create Participant's Competencies
            ParticipantCompetency::updateOrCreate(
                [
                    'participant_id'            => $this->participant->id,
                    'competence_criteria_id'    => $criteriaId,
                ],
                [
                    'status'                    => $competency['status'],
                    'relevant_proof'            => $competenceRelProof,
                ]
            );
        }

        $this->participant->step = 5;
        $this->participant->save();

        return redirect()->route('participant.register.5');
    }

    public function render()
    {
        return view('livewire.pages.participant.register-step5');
    }
}
