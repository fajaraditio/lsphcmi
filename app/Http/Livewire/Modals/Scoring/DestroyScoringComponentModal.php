<?php

namespace App\Http\Livewire\Modals\Scoring;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Scoring\ScoringComponentTable;
use App\Models\ScoringComponent;
use LivewireUI\Modal\ModalComponent;

class DestroyScoringComponentModal extends ModalComponent
{
    public $scoringComponent;

    public function mount(ScoringComponent $scoringComponent)
    {
        $this->scoringComponent = $scoringComponent;
    }

    public function destroy()
    {
        $this->scoringComponent->scoring_criterias()->delete();
        $this->scoringComponent->delete();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Komponen Penilaian Berhasil Dihapus!',
            $message = 'Komponen Penilaian #' . $this->scoringComponent->id . ' berhasil dihapus.',
            $type = 'success'
        );

        $this->emitTo(ScoringComponentTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }
    
    public function render()
    {
        return view('livewire.modals.scoring.destroy-scoring-component-modal');
    }
}
