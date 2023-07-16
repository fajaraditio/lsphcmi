<?php

namespace App\Http\Livewire\Modals\Apl;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Apl\FirstAplTable;
use App\Models\Participant;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class UpdateFirstAplModal extends ModalComponent
{
    public $participant;
    public $confirmOps = [
        [
            'value' => '',
            'attr'  => '-- Pilih Status Verifikasi --',
        ],
        [
            'value' => 'verified',
            'attr'  => 'Lolos',
        ],
        [
            'value' => 'rejected',
            'attr'  => 'Ditolak',
        ]
    ];


    public function mount(Participant $participant)
    {
        $this->participant = $participant;
    }

    public function updateStatus($status)
    {
        $this->participant->step = 5;

        if ($status === 'verified') {
            $this->participant->first_apl_status = 'verified';
            $this->participant->first_apl_verified_at = Carbon::now();
        } else if ($status === 'rejected') {
            $this->participant->first_apl_status = 'rejected';
            $this->participant->first_apl_verified_at = null;
        }

        $this->participant->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Berkas asesi berhasil diverifikasi!',
            $message = 'Berkas asesi ' . $this->participant->name . ' terkonfirmasi menjadi ' . __($status),
            $type = 'success'
        );

        $this->emitTo(FirstAplTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
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
