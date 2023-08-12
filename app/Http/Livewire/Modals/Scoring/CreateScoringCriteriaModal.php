<?php

namespace App\Http\Livewire\Modals\Scoring;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Scoring\ScoringCriteriaTable;
use App\Models\ScoringComponent;
use App\Models\ScoringCriteria;
use LivewireUI\Modal\ModalComponent;

class CreateScoringCriteriaModal extends ModalComponent
{
    public $scoringComponent;
    public $title;
    public $score;

    protected $rules = [
        'title' => 'required',
        'score' => 'required|min:0.1',
    ];

    protected $validationAttributes = [
        'title' => 'Judul Komponen',
        'score' => 'Skor Penilaian',
    ];

    public function mount(ScoringComponent $scoringComponent)
    {
        $this->scoringComponent = $scoringComponent;
    }

    public function save()
    {
        $this->validate();

        $scoringCriteria           = new ScoringCriteria();
        $scoringCriteria->scoring_component_id = $this->scoringComponent->id;
        $scoringCriteria->title    = $this->title;
        $scoringCriteria->score    = $this->score;
        $scoringCriteria->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Kriteria Penilaian Berhasil Ditambahkan!',
            $message = 'Kriteria penilaian #' . $scoringCriteria->id . ' berhasil ditambahkan.',
            $type = 'success'
        );

        $this->emitTo(ScoringCriteriaTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.scoring.create-scoring-criteria-modal');
    }
}
