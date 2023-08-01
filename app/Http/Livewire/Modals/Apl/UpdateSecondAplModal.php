<?php

namespace App\Http\Livewire\Modals\Apl;

use App\Http\Livewire\Tables\Apl\SecondAplTable;
use App\Models\CompetenceUnit;
use App\Models\Participant;
use App\Models\ParticipantCompetency;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class UpdateSecondAplModal extends ModalComponent
{
    public Participant $participant;
    public $competenceUnits;
    public $participantCompetency;

    public function mount()
    {
        $this->competenceUnits          = CompetenceUnit::with('competence_elements.competence_criterias')->get();
        $this->participantCompetency    = new ParticipantCompetency();
    }

    public function updateStatus($status)
    {
        $this->participant->step = 5;

        if ($status === 'verified') {
            $this->participant->second_apl_status       = 'verified';
            $this->participant->second_apl_verified_at  = Carbon::now();
        } else if ($status === 'rejected') {
            $this->participant->second_apl_status       = 'rejected';
            $this->participant->second_apl_verified_at  = null;
        }

        $this->participant->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Berkas asesi berhasil diverifikasi!',
            $message = 'Berkas asesi ' . $this->participant->name . ' terkonfirmasi menjadi ' . __($status),
            $type = 'success'
        );

        $this->emitTo(SecondAplTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }


    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        $competenceUnits          = CompetenceUnit::with('competence_elements.competence_criterias')->get();
        $participantCompetency    = new ParticipantCompetency();

        return view('livewire.modals.apl.update-second-apl-modal', compact('competenceUnits', 'participantCompetency'));
    }
}
