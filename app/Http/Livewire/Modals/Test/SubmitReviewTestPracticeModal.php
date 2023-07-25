<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Test\TestPracticeTable;
use App\Models\TestPractice;
use App\Models\TestSchedule;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class SubmitReviewTestPracticeModal extends ModalComponent
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
                $message = 'Tidak ada jawaban praktik yang disubmit',
                $type = 'error'
            );
        } else {
            $emptyReviewTestPractice = $testPractice->whereNull('result')->first();

            if (!empty($emptyReviewTestPractice)) {
                $emptyReviewTestPractice->result = 'BK';
                $emptyReviewTestPractice->save();
            }

            $this->testSchedule->assessor_reviewed_test_practice_at = Carbon::now();
            $this->testSchedule->save();

            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Penilaian praktik berhasil disubmit!',
                $message = 'Penilaian praktik sudah disubmit dan tersimpan',
                $type = 'success'
            );
        }

        $this->emitTo(TestPracticeTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.submit-review-test-practice-modal');
    }
}
