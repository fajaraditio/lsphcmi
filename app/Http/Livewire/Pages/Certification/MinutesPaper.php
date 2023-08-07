<?php

namespace App\Http\Livewire\Pages\Certification;

use Carbon\Carbon;
use Livewire\Component;

class MinutesPaper extends Component
{
    public $date;

    protected $queryString = ['date'];

    public function mount()
    {
        $this->date = !empty($this->date) ? Carbon::parse($this->date)->format('Y-m-d') : $this->date;
    }

    public function render()
    {
        return view('livewire.pages.certification.minutes-paper');
    }
}
