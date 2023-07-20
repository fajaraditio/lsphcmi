<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Models\TestObservation;
use App\Http\Livewire\Tables\Test\TestObservationTable;
use LivewireUI\Modal\ModalComponent;

class DestroyTestObservationModal extends ModalComponent
{
    public TestObservation $testObservation;

    public function destroy()
    {
        $this->testObservation->delete();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Pertanyaan berhasil dihapus!',
            $message = 'Pertanyaan Tugas Praktik dengan ID ' . $this->testObservation->title . ' berhasil dihapus',
            $type = 'success'
        );

        $this->emitTo(TestObservationTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.modals.test.destroy-test-observation-modal');
    }
}
