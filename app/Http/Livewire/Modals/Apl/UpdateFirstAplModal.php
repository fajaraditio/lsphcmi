<?php

namespace App\Http\Livewire\Modals\Apl;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Apl\FirstAplTable;
use App\Models\Participant;
use App\Models\TestSchedule;
use App\Models\User;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class UpdateFirstAplModal extends ModalComponent
{
    public Participant $participant;
    public TestSchedule $testSchedule;
    public $assessors;
    public $assessorUserId;
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

    protected $validationAttributes = [
        'assessorUserId' => 'Asesor',
    ];

    public function mount()
    {
        $assessors = User::whereHas('role', fn ($role) => $role->where('slug', 'assessor'))->get();

        foreach ($assessors as $assessor) {
            $this->assessors[] = ['value' => $assessor->id, 'attr' => $assessor->name];
        }

        $this->assessors    = array_merge([['value' => '', 'attr' => '-- Pilih Asesor --']], $this->assessors);

        $this->testSchedule = new TestSchedule();
    }

    public function updateStatus($status)
    {
        $this->participant->step = 5;

        if ($status === 'verified') {
            $this->validate(['assessorUserId' => 'required']);

            $this->participant->first_apl_status = 'verified';
            $this->participant->first_apl_verified_at = Carbon::now();

            $this->testSchedule->assessor_user_id       = $this->assessorUserId;
            $this->testSchedule->participant_user_id    = $this->participant->user_id;
            $this->testSchedule->save();
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
