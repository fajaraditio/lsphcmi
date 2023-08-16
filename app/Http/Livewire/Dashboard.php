<?php

namespace App\Http\Livewire;

use App\Models\TestSchedule;
use App\Models\Participant;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $role;
    public $participantCount;
    public $assessorCount;
    public $scheduledParticipantCount;
    public $certifiedParticipantCount;

    public function mount()
    {
        $this->role             = auth()->user()->role->slug;
        $this->participantCount = Participant::count();
        $this->assessorCount    = User::whereHas('role', fn ($model) => $model->where('slug', 'assessor'))->count();
        $this->scheduledParticipantCount = TestSchedule::whereNotNull('scheduled_at')->count();
        $this->certifiedParticipantCount = TestSchedule::whereNotNull('chief_approved_report_at')->count();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
