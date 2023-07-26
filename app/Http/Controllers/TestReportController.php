<?php

namespace App\Http\Controllers;

use App\Models\TestAgreement;
use App\Models\Participant;
use App\Models\TestReport;
use App\Models\TestSchedule;
use Illuminate\Http\Request;

class TestReportController extends Controller
{
    public function viewPDF(TestReport $testReport)
    {
        $testSchedule     = TestSchedule::find($testReport->test_schedule_id);
        $testAgreement    = TestAgreement::where('test_schedule_id', $testSchedule->id)->first();
        $participant      = Participant::where('user_id', $testSchedule->participant->id)->first();

        return view('pages.test-report', compact('testReport', 'testSchedule', 'testAgreement', 'participant'));
    }
}
