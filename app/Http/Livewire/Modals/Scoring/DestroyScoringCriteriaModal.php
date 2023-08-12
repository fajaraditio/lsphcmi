<?php

namespace App\Http\Livewire\Modals\Scoring;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Scoring\ScoringCriteriaTable;
use App\Models\ScoringCriteria;
use LivewireUI\Modal\ModalComponent;

class DestroyScoringCriteriaModal extends ModalComponent
{
    public $scoringCriteria;

    public function mount(ScoringCriteria $scoringCriteria)
    {
        $this->scoringCriteria = $scoringCriteria;
    }

    public function destroy()
    {
        $this->scoringCriteria->delete();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Komponen Penilaian Berhasil Dihapus!',
            $message = 'Komponen Penilaian #' . $this->scoringCriteria->id . ' berhasil dihapus.',
            $type = 'success'
        );

        $this->emitTo(ScoringCriteriaTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.scoring.destroy-scoring-criteria-modal');
    }
}
