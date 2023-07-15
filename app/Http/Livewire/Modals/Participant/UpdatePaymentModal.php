<?php

namespace App\Http\Livewire\Modal\Participant;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Table\ParticipantTable;
use App\Models\Participant;
use LivewireUI\Modal\ModalComponent;

class UpdatePaymentModal extends ModalComponent
{
    public Participant $participant;
    public $status;

    protected $rules = [
        'status' => 'required|in:paid,unpaid,rejected',
    ];

    protected $validationAttributes = [
        'status' => 'Status Konfirmasi',
    ];

    public function save()
    {
        $this->validate();

        $this->participant->update(['status' => $this->status]);

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title      = 'Pembayaran dikonfirmasi!',
            $message    = 'Pembayaran calon asesi ' . $this->participant->name . ' terkonfirmasi menjadi ' . __('messages.' . $this->status),
            $type       = 'success',
        );

        $this->emitTo(ParticipantTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        $confirmOps = [
            [
                'value' => '',
                'attr'  => '-- Pilih Status Konfirmasi --',
            ],
            [
                'value' => 'unpaid',
                'attr'  => 'Belum Lunas',
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

        return view('livewire.modal.participant.update-payment-modal', compact('confirmOps'));
    }
}
