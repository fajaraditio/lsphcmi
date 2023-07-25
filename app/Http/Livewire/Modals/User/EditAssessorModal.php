<?php

namespace App\Http\Livewire\Modals\User;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\User\AssessorTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;

class EditAssessorModal extends ModalComponent
{
    public User $user;

    public $name;
    public $password;
    public $email;

    protected $rules = [
        'name'              => 'required',
        'email'             => 'required|unique:users,email',
        'password'          => 'nullable',
    ];

    protected $validationAttributes = [
        'name'          => 'Nama Lengkap',
        'email'         => 'Email',
        'password'      => 'Kata Sandi',
    ];

    public function mount()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function save()
    {
        $this->validate([
            'email' => 'required|unique:users,email,' . $this->user->id . ',id',
        ]);

        $this->user->name     = $this->name;
        $this->user->email    = $this->email;
        $this->user->password = empty($this->password) ? $this->user->password : Hash::make($this->password);
        $this->user->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Akun Asesor Berhasil Diedit!',
            $message = 'Akun Asesor ' . $this->name . ' (' . $this->email . ') berhasil diedit.',
            $type = 'success'
        );

        $this->emitTo(AssessorTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.user.edit-assessor-modal');
    }
}
