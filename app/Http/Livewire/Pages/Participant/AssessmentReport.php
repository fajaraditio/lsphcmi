<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\TestReport;
use App\Models\Participant;
use App\Models\TestAgreement;
use App\Models\TestSchedule;
use Livewire\Component;

class AssessmentReport extends Component
{
    public $testSchedule;
    public $testReport;
    public $testAgreement;
    public $participant;

    public function mount()
    {
        $this->testSchedule     = TestSchedule::where('participant_user_id', auth()->user()->id)->first();
        $this->testReport       = TestReport::where('test_schedule_id', $this->testSchedule->id)->first();
        $this->testAgreement    = TestAgreement::where('test_schedule_id', $this->testSchedule->id)->first();
        $this->participant      = Participant::where('user_id', auth()->user()->id)->first();
    }

    public function back()
    {
        return redirect()->route('participant.test.agreement');
    }

    public function render()
    {
        return view('livewire.pages.participant.assessment-report');
    }
}
