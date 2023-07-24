<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\TestSchedule;
use Livewire\Component;

class TestObservation extends Component
{
    public $testSchedule;

    public function mount()
    {
        $this->testSchedule = TestSchedule::where('participant_user_id', auth()->user()->id)->first();
    }

    public function back()
    {
        return redirect()->route('participant.test.practice');
    }

    public function next()
    {
        return redirect()->route('participant.test.feedback');
    }

    public function render()
    {
        return view('livewire.pages.participant.test-observation');
    }
}
