<?php

namespace App\Http\Livewire\Pages\Assessor;

use App\Models\TestSchedule;
use Livewire\Component;

class TestPractice extends Component
{
    public TestSchedule $testSchedule;

    public function render()
    {
        return view('livewire.pages.assessor.test-practice');
    }
}
