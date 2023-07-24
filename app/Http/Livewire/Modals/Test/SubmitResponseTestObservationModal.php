<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Models\TestSchedule;
use App\Http\Livewire\Tables\Test\TestObservationTable;
use App\Models\TestObservation;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class SubmitResponseTestObservationModal extends ModalComponent
{
    public TestSchedule $testSchedule;

    public function submit()
    {
        $testPractice = TestObservation::where('test_schedule_id', $this->testSchedule->id)
            ->whereNotNull('response');

        if ($testPractice->count() < 1) {
            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Tugas praktik gagal disubmit!',
                $message = 'Tidak ada jawaban observasi yang disubmit',
                $type = 'error'
            );
        } else {
            $this->testSchedule->participant_status = 'respond_feedback_observation';
            $this->testSchedule->participant_responded_test_observation_at = Carbon::now();
            $this->testSchedule->save();

            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Jawaban observasi berhasil disubmit!',
                $message = 'Jawaban observasis sudah disubmit dan diberikan kepada asesor untuk penilaian',
                $type = 'success'
            );
        }

        $this->emitTo(TestObservationTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.submit-response-test-observation-modal');
    }
}
