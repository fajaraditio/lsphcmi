<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Alert extends Component
{
    public $title;
    public $message;
    public $type;
    public $icon;
    public $color = 'green';

    protected $listeners = ['sendAlert'];

    public function sendAlert($title, $message, $type)
    {
        $colors = ['success' => 'green', 'error' => 'red', 'warning' => 'yellow', 'info' => 'blue'];

        $this->title    = $title;
        $this->message  = $message;
        $this->color    = $colors[$type];
        $this->icon     = '💡';
    }

    public function render()
    {
        return view('livewire.components.alert');
    }
}
