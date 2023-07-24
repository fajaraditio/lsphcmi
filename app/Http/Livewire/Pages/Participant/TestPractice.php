<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\TestSchedule;
use Livewire\Component;

class TestPractice extends Component
{
    public $testSchedule;

    public function mount()
    {
        $this->testSchedule = TestSchedule::where('participant_user_id', auth()->user()->id)->first();
    }

    public function back()
    {
        return redirect()->route('participant.test.agreement');
    }

    public function next()
    {
        return redirect()->route('participant.test.observation');
    }

    public function render()
    {
        return view('livewire.pages.participant.test-practice');
    }
}
