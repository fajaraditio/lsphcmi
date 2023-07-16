<?php

namespace App\Http\Livewire\Modals\Apl;

use App\Models\Participant;
use LivewireUI\Modal\ModalComponent;

class UpdateFirstAplModal extends ModalComponent
{
    public $participant;

    public function mount(Participant $participant)
    {
        $this->participant = $participant;
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.modals.apl.update-first-apl-modal');
    }
}
