<?php

namespace App\Http\Livewire\Pages\Chief;

use App\Models\TestSchedule;
use App\Models\TestAgreement;
use App\Models\Participant;
use App\Models\TestReport as TestReportModel;
use Carbon\Carbon;
use Livewire\Component;

class TestReport extends Component
{
    public $testSchedule;
    public TestReportModel $testReport;
    public $testAgreement;
    public $participant;
    public $verifyAgreement;
    public $verifyPublication;

    protected $rules = [
        'verifyAgreement'   => 'required',
        'verifyPublication' => 'required',
    ];

    public function mount()
    {
        $this->testSchedule     = TestSchedule::find($this->testReport->test_schedule_id);
        $this->testAgreement    = TestAgreement::where('test_schedule_id', $this->testSchedule->id)->first();
        $this->participant      = Participant::where('user_id', $this->testSchedule->participant->id)->first();
    }

    public function verify()
    {
        $this->validate();

        $this->testReport->approval_status = 'approved';
        $this->testReport->save();

        $this->testSchedule->chief_approved_report_at = Carbon::now();
        $this->testSchedule->save();

        session()->flash('message', 'Berhasil memverifikasi laporan asesmen ' . $this->testSchedule->participant->name);

        return redirect()->route('chief.assessment.list');
    }

    public function render()
    {
        return view('livewire.pages.chief.test-report');
    }
}
