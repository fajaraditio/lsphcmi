<?php

namespace App\Http\Livewire\Pages\Assessor;

use App\Models\Participant;
use App\Models\TestSchedule;
use Livewire\Component;

class TestAgreement extends Component
{
    public TestSchedule $testSchedule;
    public $participant;

    public function mount()
    {
        $this->participant = Participant::where('user_id', $this->testSchedule->participant_user_id)->first();
    }

    public function render()
    {
        return view('livewire.pages.assessor.test-agreement');
    }
}
