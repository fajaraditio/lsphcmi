<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Test\TestPracticeTable;
use App\Models\TestSchedule;
use App\Models\TestPractice;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class SubmitTestPracticeModal extends ModalComponent
{
    public TestSchedule $testSchedule;

    public function submit()
    {
        $testPractice = TestPractice::where('test_schedule_id', $this->testSchedule->id);

        if ($testPractice->count() < 1) {
            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Tugas praktik gagal disubmit!',
                $message = 'Tidak ada kasus yang disubmit',
                $type = 'error'
            );
        } else {
            $this->testSchedule->participant_status = 'respond_test_practice';
            $this->testSchedule->assessor_status    = 'input_test_observation';
            $this->testSchedule->assessor_submitted_test_practice_at = Carbon::now();
            $this->testSchedule->save();

            $testPractice->update([
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

        $this->emitTo(TestPracticeTable::class, 'pg:eventRefresh-default');

        redirect()->route('assessor.test.practice', ['testSchedule' => $this->testSchedule->id]);
    }

    public function render()
    {
        return view('livewire.modals.test.submit-test-practice-modal');
    }
}
