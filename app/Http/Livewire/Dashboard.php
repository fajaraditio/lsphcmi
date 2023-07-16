<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $role;

    public function mount()
    {
        $this->role = auth()->user()->role->slug;
    }
    
    public function render()
    {
        return view('livewire.dashboard');
    }
}
