<?php

namespace App\Http\Livewire\Pages\Assessor;

use App\Models\TestSchedule;
use Livewire\Component;

class TestScheduleDetail extends Component
{
    public TestSchedule $testSchedule;

    public function back()
    {
        return redirect()->route('assessor.test.list');
    }

    public function render()
    {
        return view('livewire.pages.assessor.test-schedule-detail');
    }
}
