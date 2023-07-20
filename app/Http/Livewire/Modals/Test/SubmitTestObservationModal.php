<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Test\TestObservationTable;
use App\Models\TestObservation;
use App\Models\TestSchedule;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class SubmitTestObservationModal extends ModalComponent
{
    public TestSchedule $testSchedule;

    public function submit()
    {
        $testObservation = TestObservation::where('test_schedule_id', $this->testSchedule->id);

        if ($testObservation->count() < 1) {
            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Tugas observasi gagal disubmit!',
                $message = 'Tidak ada pertanyaan observasi yang disubmit',
                $type = 'error'
            );
        } else {
            $this->testSchedule->participant_status = 'respond_test_observation';
            $this->testSchedule->assessor_status    = 'input_report';
            $this->testSchedule->assessor_submitted_test_observation_at = Carbon::now();
            $this->testSchedule->save();

            $testObservation->update([
                'status' => 'locked',
            ]);

            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Tugas praktik berhasil disubmit!',
                $message = 'Tugas praktik sudah disubmit dan diberikan kepada asesi untuk diisikan',
                $type = 'success'
            );
        }


        $this->emitTo(TestObservationTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.modals.test.submit-test-observation-modal');
    }
}
