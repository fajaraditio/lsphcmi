<?php

namespace App\Http\Livewire\Pages\Assessor;

use App\Models\Participant;
use App\Models\TestSchedule;
use Livewire\Component;

class CompetencyTestList extends Component
{
    public function render()
    {
        return view('livewire.pages.assessor.competency-test-list');
    }
}
