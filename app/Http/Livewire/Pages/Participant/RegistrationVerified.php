<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\Participant;
use Livewire\Component;

class RegistrationVerified extends Component
{
    public $participant;

    public function mount()
    {
        $this->participant = Participant::where('user_id', auth()->user()->id)->first();
    }

    public function continue()
    {
        return redirect()->route('participant.test.agreement');
    }

    public function render()
    {
        return view('livewire.pages.participant.registration-verified');
    }
}
