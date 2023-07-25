<?php

namespace App\Http\Livewire\Pages\Assessor;

use App\Models\TestSchedule;
use Livewire\Component;

class TestPractice extends Component
{
    public TestSchedule $testSchedule;

    public function back()
    {
        return redirect()->route('assessor.test.agreement', ['testSchedule' => $this->testSchedule->id]);
    }

    public function next()
    {
        return redirect()->route('assessor.test.observation', ['testSchedule' => $this->testSchedule->id]);
    }

    public function render()
    {
        return view('livewire.pages.assessor.test-practice');
    }
}
