<?php

namespace App\Http\Livewire\Modals\Test;

use App\Models\Participant;
use App\Models\TestReport;
use App\Models\TestSchedule;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class SubmitTestReportModal extends ModalComponent
{
    public TestSchedule $testSchedule;
    public $participant;
    public $result;
    public $note;

    protected $rules = [
        'result'    => 'required|in:K,BK',
        'note'      => 'nullable',
    ];

    protected $validationAttributes = [
        'result'    => 'Hasil Kompetensi',
        'note'      => 'Catatan',
    ];

    public function mount()
    {
        $this->participant  = Participant::where('user_id', $this->testSchedule->participant_user_id)->first();
    }

    public function submit()
    {
        $this->validate();

        TestReport::updateOrCreate(
            [
                'test_schedule_id'      => $this->testSchedule->id,
                'participant_user_id'   => $this->testSchedule->participant->id,
                'assessor_user_id'      => $this->testSchedule->assessor->id,
            ],
            [
                'result'    => $this->result,
                'note'      => $this->note,
            ]
        );

        $this->testSchedule->assessor_submitted_report_at = Carbon::now();
        $this->testSchedule->save();

        return redirect()->route('assessor.test.report', ['testSchedule' => $this->testSchedule->id]);
    }

    public function render()
    {
        return view('livewire.modals.test.submit-test-report-modal');
    }
}
