<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Test\TestObservationTable;
use App\Models\TestObservation;
use LivewireUI\Modal\ModalComponent;

class RespondTestObservationModal extends ModalComponent
{
    public TestObservation $testObservation;
    public $response;

    protected $rules = [
        'response' => 'required',
    ];

    protected $validationAttributes = [
        'response' => 'Jawaban',
    ];

    public function mount() {
        if (!empty($this->testObservation->response)) $this->response = $this->testObservation->response;
    }

    public function save()
    {
        if (empty($this->testPractice->response_file)) $this->validate();

        $this->testObservation->response = $this->response;
        $this->testObservation->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Jawaban berhasil disimpan!',
            $message = 'Jawaban sudah disimpan. Silakan lanjut menjawab soal lain yang tersisa.',
            $type = 'success'
        );

        $this->emitTo(TestObservationTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.respond-test-observation-modal');
    }
}
