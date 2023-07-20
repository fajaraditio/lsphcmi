<?php

namespace App\Http\Livewire\Pages\Assessor;

use App\Models\TestSchedule;
use Livewire\Component;

class TestObservation extends Component
{
    public TestSchedule $testSchedule;

    public function back()
    {
        return redirect()->route('assessor.test.schedule.detail', ['testSchedule' => $this->testSchedule->id]);
    }

    public function next()
    {
        return redirect()->route('assessor.test.feedback', ['testSchedule' => $this->testSchedule->id]);
    }

    public function render()
    {
        return view('livewire.pages.assessor.test-observation');
    }
}
