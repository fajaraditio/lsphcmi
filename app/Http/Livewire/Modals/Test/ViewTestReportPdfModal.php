<?php

namespace App\Http\Livewire\Modals\Test;

use App\Models\TestReport;
use LivewireUI\Modal\ModalComponent;

class ViewTestReportPdfModal extends ModalComponent
{
    public TestReport $testReport;

    public function render()
    {
        return view('livewire.modals.test.view-test-report-pdf-modal');
    }
    
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }
}
