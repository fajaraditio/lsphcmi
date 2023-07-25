<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Models\TestObservation;
use App\Http\Livewire\Tables\Test\TestObservationTable;
use LivewireUI\Modal\ModalComponent;

class ReviewTestObservationModal extends ModalComponent
{
    public TestObservation $testObservation;
    public $review;

    protected $rules = [
        'review' => 'required|in:K,BK',
    ];

    protected $validationAttributes = [
        'review' => 'Penilaian',
    ];

    public function mount()
    {
        if (!empty($this->testObservation->result)) $this->review = $this->testObservation->result;
    }

    public function save()
    {
        $this->validate();

        $this->testObservation->result = $this->review;
        $this->testObservation->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Penilaian berhasil diberikan!',
            $message = 'Penilaian untuk asesmen #' . $this->testObservation->id . ' berhasil disimpan.',
            $type = 'success'
        );

        $this->emitTo(TestObservationTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.review-test-observation-modal');
    }
}
