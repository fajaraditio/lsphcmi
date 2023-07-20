<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Test\TestPracticeTable;
use App\Models\TestSchedule;
use App\Models\TestPractice;
use LivewireUI\Modal\ModalComponent;

class SubmitTestPracticeModal extends ModalComponent
{
    public TestSchedule $testSchedule;

    public function submit()
    {
        $this->testSchedule->participant_status = 'respond_test_practice';
        $this->testSchedule->assessor_status    = 'input_test_observation';
        $this->testSchedule->save();

        TestPractice::where('test_schedule_id', $this->testSchedule->id)
            ->update([
                'status' => 'locked',
            ]);

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Tugas praktik berhasil disubmit!',
            $message = 'Tugas praktik sudah disubmit dan diberikan kepada asesi untuk diisikan',
            $type = 'success'
        );

        $this->emitTo(TestPracticeTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.submit-test-practice-modal');
    }
}
