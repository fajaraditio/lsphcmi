<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Models\TestSchedule;
use App\Models\TestObservation;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class SubmitReviewTestObservationModal extends ModalComponent
{
    public TestSchedule $testSchedule;

    public function submit()
    {
        $testObservation = TestObservation::where('test_schedule_id', $this->testSchedule->id)
            ->whereNotNull('response');

        if ($testObservation->count() < 1) {
            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Tugas observasi gagal disubmit!',
                $message = 'Tidak ada jawaban observasi yang disubmit',
                $type = 'error'
            );
        } else {
            $emptyReviewTestObservation = $testObservation->whereNull('result')->first();

            if (!empty($emptyReviewTestObservation)) {
                $emptyReviewTestObservation->result = 'BK';
                $emptyReviewTestObservation->save();
            }

            $this->testSchedule->assessor_reviewed_test_observation_at = Carbon::now();
            $this->testSchedule->save();

            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Penilaian praktik berhasil disubmit!',
                $message = 'Penilaian praktik sudah disubmit dan tersimpan',
                $type = 'success'
            );
        }

        $this->emitTo(TestObservationTable::class, 'pg:eventRefresh-default');
        
        redirect()->route('assessor.test.observation', ['testSchedule' => $this->testSchedule->id]);
    }


    public function render()
    {
        return view('livewire.modals.test.submit-review-test-observation-modal');
    }
}
