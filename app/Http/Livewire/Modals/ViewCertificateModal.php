<?php

namespace App\Http\Livewire\Modals;

use App\Models\TestReport;
use LivewireUI\Modal\ModalComponent;

class ViewCertificateModal extends ModalComponent
{
    public $testReport;

    public function mount(TestReport $testReport)
    {
        $this->testReport = $testReport;
    }

    public function render()
    {
        return view('livewire.modals.view-certificate-modal');
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }
}
