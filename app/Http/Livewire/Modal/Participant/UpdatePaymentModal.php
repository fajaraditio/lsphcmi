<?php

namespace App\Http\Livewire\Modal\Participant;

use LivewireUI\Modal\ModalComponent;

class UpdatePaymentModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.modal.participant.update-payment-modal');
    }
}
