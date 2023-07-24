<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\TestSchedule;
use Livewire\Component;

class TestObservation extends Component
{
    public TestSchedule $testSchedule;

    public function back()
    {
        return redirect()->route('participant.test.practice', ['testSchedule' => $this->testSchedule->id]);
    }

    public function next()
    {
        return redirect()->route('participant.test.feedback', ['testSchedule' => $this->testSchedule->id]);
    }

    public function render()
    {
        return view('livewire.pages.participant.test-observation');
    }
}
