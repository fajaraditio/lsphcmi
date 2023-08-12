<?php

namespace App\Http\Livewire\Modals\Scoring;

use App\Models\ScoringComponent;
use LivewireUI\Modal\ModalComponent;

class DetailScoringComponentModal extends ModalComponent
{
    public $scoringComponent;

    public function mount(ScoringComponent $scoringComponent)
    {
        $this->scoringComponent = $scoringComponent;
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }


    public function render()
    {
        return view('livewire.modals.scoring.detail-scoring-component-modal');
    }
}
