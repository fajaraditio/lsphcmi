<?php

namespace App\Http\Livewire\Modals\User;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\User\AssessorTable;
use App\Models\TestSchedule;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class DestroyAssessorModal extends ModalComponent
{
    public User $user;

    public function destroy()
    {
        $hasTestSchedules = (bool) TestSchedule::where('assessor_user_id', $this->user->id)->count();

        if ($hasTestSchedules) {
            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Akun Asesor Gagal Dihapus!',
                $message = 'Akun Asesor ' . $this->user->name . ' (' . $this->user->email . ') sudah disertakan dalam jadwal asesi.',
                $type = 'error'
            );
        } else {
            $this->user->delete();

            $this->emitTo(
                Alert::class,
                'sendAlert',
                $title = 'Akun Asesor Berhasil Dihapus!',
                $message = 'Akun Asesor ' . $this->user->name . ' (' . $this->user->email . ') berhasil dihapus.',
                $type = 'success'
            );
        }

        $this->emitTo(AssessorTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.user.destroy-assessor-modal');
    }
}
