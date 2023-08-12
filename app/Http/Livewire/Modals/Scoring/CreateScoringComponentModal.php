<?php

namespace App\Http\Livewire\Modals\Scoring;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Scoring\ScoringComponentTable;
use App\Models\ScoringComponent;
use LivewireUI\Modal\ModalComponent;

class CreateScoringComponentModal extends ModalComponent
{
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

    public function save()
    {
        $this->validate();

        $scoringComponent           = new ScoringComponent();
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
        return view('livewire.modals.scoring.create-scoring-component-modal');
    }
}
