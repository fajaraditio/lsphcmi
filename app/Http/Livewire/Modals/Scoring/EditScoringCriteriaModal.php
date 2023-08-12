<?php

namespace App\Http\Livewire\Modals\Scoring;

use App\Http\Livewire\Components\Alert;
use App\Models\ScoringCriteria;
use LivewireUI\Modal\ModalComponent;

class EditScoringCriteriaModal extends ModalComponent
{
    public $scoringCriteria;
    public $title;
    public $score;

    protected $rules = [
        'title' => 'required',
        'score' => 'required|min:0.1',
    ];

    protected $validationAttributes = [
        'title' => 'Judul Komponen',
        'score' => 'Bobot Penilaian',
    ];

    public function mount(ScoringCriteria $scoringCriteria)
    {
        $this->scoringCriteria  = $scoringCriteria;
        $this->title            = $this->scoringCriteria->title;
        $this->score            = $this->scoringCriteria->score;
    }

    public function save()
    {
        $this->validate();

        $scoringCriteria           = $this->scoringCriteria;
        $scoringCriteria->title    = $this->title;
        $scoringCriteria->score    = $this->score;
        $scoringCriteria->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Kriteria Penilaian Berhasil Diedit!',
            $message = 'Kriteria penilaian #' . $scoringCriteria->id . ' berhasil diedit.',
            $type = 'success'
        );

        $this->emitTo(ScoringComponentTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.scoring.edit-scoring-criteria-modal');
    }
}
