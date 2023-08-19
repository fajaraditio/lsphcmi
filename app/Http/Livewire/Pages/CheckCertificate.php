<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class CheckCertificate extends Component
{
    public function render()
    {
        return view('livewire.pages.check-certificate')
            ->layout('layouts.guest');
    }
}
