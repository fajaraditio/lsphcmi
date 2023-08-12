<?php

namespace App\Http\Livewire\Modals\Scoring;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Scoring\ScoringComponentTable;
use App\Models\ScoringComponent;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditScoringComponentModal extends ModalComponent
{
    public $scoringComponent;
    public $title;
    public $weight;

    protected $rules = [
        'title' => 'required',
        'weight' => 'required|min:0.1',
    ];

    protected $validationAttributes = [
        'title' => 'Judul Komponen',
        'weight' => 'Bobot Penilaian',
    ];

    public function mount(ScoringComponent $scoringComponent)
    {
        $this->scoringComponent = $scoringComponent;
        $this->title            = $this->scoringComponent->title;
        $this->weight           = $this->scoringComponent->weight;
    }

    public function save()
    {
        $this->validate();

        $scoringComponent           = $this->scoringComponent;
        $scoringComponent->title    = $this->title;
        $scoringComponent->weight   = $this->weight;
        $scoringComponent->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Komponen Penilaian Berhasil Ditambahkan!',
            $message = 'Komponen penilaian #' . $scoringComponent->id . ' berhasil ditambahkan.',
            $type = 'success'
        );

        $this->emitTo(ScoringComponentTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.scoring.edit-scoring-component-modal');
    }
}
