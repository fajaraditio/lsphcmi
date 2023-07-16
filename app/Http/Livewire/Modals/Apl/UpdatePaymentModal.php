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
    public $confirmOps = [
        [
            'value' => '',
            'attr'  => '-- Pilih Status Konfirmasi --',
        ],
        [
            'value' => 'paid',
            'attr'  => 'Lunas',
        ],
        [
            'value' => 'rejected',
            'attr'  => 'Ditolak',
        ]
    ];

    protected $rules = [
        'status' => 'required|in:paid,unpaid,rejected',
    ];

    protected $validationAttributes = [
        'status' => 'Status Konfirmasi',
    ];

    public function updateStatus($status)
    {
        $this->validate();

        if ($status === 'paid') {
            $this->participant->payment_status = 'paid';
            $this->participant->payment_verified_at = Carbon::now();
        } else if ($status === 'rejected') {
            $this->participant->payment_status = 'rejected';
            $this->participant->paymet_verified_at = null;
        }

        // $this->participant->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title      = 'Pembayaran dikonfirmasi!',
            $message    = 'Pembayaran asesmen ' . $this->participant->name . ' terkonfirmasi menjadi ' . __($this->status),
            $type       = 'success',
        );

        $this->emitTo(PaymentTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.apl.update-payment-modal');
    }
}
