<?php

namespace App\Http\Livewire\Modals\User;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\User\AssessorAssignmentTable;
use App\Models\TestSchedule;
use App\Models\Participant;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class AssignAssessorModal extends ModalComponent
{
    public $participant;
    public $assessorUserId;
    public $assessors;

    protected $rules = [
        'assessorUserId' => 'required|exists:users,id',
    ];

    protected $validationAttributes = [
        'assessorUserId' => 'Asesor',
    ];


    public function mount(Participant $participant)
    {
        $this->participant = $participant;
        $this->assessorUserId = null;

        $assessors = User::whereHas('role', fn ($role) => $role->where('slug', 'assessor'))->get();

        foreach ($assessors as $assessor) {
            $this->assessors[] = ['value' => $assessor->id, 'attr' => $assessor->name];
        }

        $this->assessors    = array_merge([['value' => '', 'attr' => '-- Pilih Asesor --']], $this->assessors);
    }

    public function assign()
    {
        $this->validate();

        $testSchedule = TestSchedule::firstOrCreate([
            'assessor_user_id'      => $this->assessorUserId,
            'participant_user_id'   => $this->participant->user_id,
        ]);

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Penugasan Asesor Berhasil!',
            $message = 'Asesor ' . $testSchedule->assessor->name . ' telah ditugaskan untuk melakukan asesmen untuk asesi ' . $this->participant->name,
            $type = 'success'
        );

        $this->emitTo(AssessorAssignmentTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.user.assign-assessor-modal');
    }
}
