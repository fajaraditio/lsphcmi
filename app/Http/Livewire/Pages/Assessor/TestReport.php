<?php

namespace App\Http\Livewire\Pages\Assessor;

use App\Models\Participant;
use App\Models\TestReport as TestReportModel;
use App\Models\TestSchedule;
use Livewire\Component;

class TestReport extends Component
{
    public TestSchedule $testSchedule;
    public $testReport;
    public $participant;

    public function mount()
    {
        $this->participant  = Participant::where('user_id', $this->testSchedule->participant_user_id)->first();
        $this->testReport   = TestReportModel::where('test_schedule_id', $this->testSchedule->id)->first();
    }

    public function back()
    {
        return redirect()->route('assessor.test.feedback', ['testSchedule' => $this->testSchedule->id]);
    }

    public function render()
    {
        return view('livewire.pages.assessor.test-report');
    }
}
