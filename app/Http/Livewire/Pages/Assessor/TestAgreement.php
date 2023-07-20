<?php

namespace App\Http\Livewire\Pages\Assessor;

use App\Models\Participant;
use App\Models\TestSchedule;
use App\Models\TestAgreement as TestAgreementModel;
use Carbon\Carbon;
use Livewire\Component;

class TestAgreement extends Component
{
    public TestSchedule $testSchedule;
    public $participant;
    public $signature;
    public $testAgreement;

    public function mount()
    {
        $this->participant      = Participant::where('user_id', $this->testSchedule->participant_user_id)->first();
        $this->testAgreement    = TestAgreementModel::where('test_schedule_id', $this->testSchedule->id)->first();
    }

    public function accept()
    {
        $this->validate(['signature' => 'required']);

        $this->testAgreement->test_schedule_id   = $this->testSchedule->id;
        $this->testAgreement->assessor_signed_at = Carbon::now();
        $this->testAgreement->assessor_signature = $this->signature;
        $this->testAgreement->save();

        return redirect()->route('assessor.test.agreement');
    }

    public function back() {
        return redirect()->route('assessor.test.schedule.detail', ['testSchedule' => $this->testSchedule->id]);
    }

    public function render()
    {
        return view('livewire.pages.assessor.test-agreement');
    }
}
