<?php

namespace App\Http\Livewire\Modals\Apl;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Apl\PaymentTable;
use App\Models\Participant;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class UpdatePaymentModal extends ModalComponent
{
    public Participant $participant;
    public $status;

    public function updateStatus($status)
    {
        if ($status === 'paid') {
            $this->participant->payment_status = 'paid';
            $this->participant->payment_verified_at = Carbon::now();
        } else if ($status === 'rejected') {
            $this->participant->payment_status = 'rejected';
            $this->participant->payment_verified_at = null;
        }

        $this->participant->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title      = 'Pembayaran dikonfirmasi!',
            $message    = 'Pembayaran asesmen ' . $this->participant->name . ' terkonfirmasi menjadi ' . __($status),
            $type       = 'success',
        );

        $this->emitTo(PaymentTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        $status = $this->status;
        return view('livewire.modals.apl.update-payment-modal', compact('status'));
    }
}
