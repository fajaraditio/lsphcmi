<?php

namespace App\Http\Livewire\Modals\User;

use App\Http\Livewire\Tables\User\AssessorTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;

class CreateAssessorModal extends ModalComponent
{
    public $name;
    public $password;
    public $password_confirmation;
    public $email;

    protected $rules = [
        'name'              => 'required',
        'email'             => 'required|unique:users,email',
        'password'          => 'required',
        'password_confirmation' => 'required|same:password',
    ];

    protected $validationAttributes = [
        'name'          => 'Nama Lengkap',
        'email'         => 'Email',
        'password'      => 'Kata Sandi',
        'password_confirmation' => 'Konfirmasi Kata Sandi',
    ];

    public function save()
    {
        $this->validate();

        $user           = new User();
        $user->role_id  = Role::where('slug', 'assessor')->first()->id;
        $user->name     = $this->name;
        $user->email    = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Akun Asesor Berhasil Ditambahkan!',
            $message = 'Akun Asesor ' . $this->name . ' (' . $this->email . ') berhasil ditambahkan.',
            $type = 'success'
        );

        $this->emitTo(AssessorTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.user.create-assessor-modal');
    }
}
