<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\Participant;
use App\Models\TestSchedule;
use App\Models\TestAgreement as TestAgreementModel;
use Carbon\Carbon;
use Livewire\Component;

class TestAgreement extends Component
{
    public $participant;
    public $testAgreement;
    public $testSchedule;
    public $signature;

    public function mount()
    {
        $this->participant      = Participant::where('user_id', auth()->user()->id)->first();
        $this->testSchedule     = TestSchedule::where('participant_user_id', auth()->user()->id)->first();
        $this->testAgreement    = new TestAgreementModel();
    }

    public function accept()
    {
        $this->validate(['signature' => 'required']);

        $this->testSchedule->participant_signed_agreement_at = Carbon::now();
        $this->testSchedule->save();

        $this->testAgreement->test_schedule_id      = $this->testSchedule->id;
        $this->testAgreement->participant_signed_at = Carbon::now();
        $this->testAgreement->participant_signature = $this->signature;
        $this->testAgreement->save();

        return redirect()->route('participant.test.agreement');
    }

    public function next()
    {
        return redirect()->route('participant.test.practice');
    }

    public function render()
    {
        return view('livewire.pages.participant.test-agreement');
    }
}
