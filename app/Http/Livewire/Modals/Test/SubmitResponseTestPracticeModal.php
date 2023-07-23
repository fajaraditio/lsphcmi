<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Tables\Test\TestPracticeTable;
use App\Models\TestPractice;
use App\Models\TestSchedule;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use LivewireUI\Modal\ModalComponent;

class SubmitResponseTestPracticeModal extends ModalComponent
{
    public TestSchedule $testSchedule;

    public function submit()
    {
        $testPractice = TestPractice::where('test_schedule_id', $this->testSchedule->id)
            ->whereNotNull('response_file');

        if ($testPractice->count() < 1) {
            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Tugas praktik gagal disubmit!',
                $message = 'Tidak ada jawaban observasi yang disubmit',
                $type = 'error'
            );
        } else {
            $this->testSchedule->participant_status = 'respond_test_observation';
            $this->testSchedule->participant_responded_test_practice_at = Carbon::now();
            $this->testSchedule->save();

            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Jawaban praktik berhasil disubmit!',
                $message = 'Jawaban praktik sudah disubmit dan diberikan kepada asesor untuk penilaian',
                $type = 'success'
            );
        }

        $this->emitTo(TestPracticeTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.submit-response-test-practice-modal');
    }
}
