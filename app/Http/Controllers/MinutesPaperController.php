<?php

namespace App\Http\Controllers;

use App\Models\TestReport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MinutesPaperController extends Controller
{
    public function viewPDF(Request $request)
    {
        $date = empty($request->date) ? Carbon::now()->format('Y-m-d') : Carbon::parse($request->date)->format('Y-m-d');
        $testReports = TestReport::whereDate('created_at', $date)->get();

        return view('pages.minutes-paper', compact('date', 'testReports'));
    }
}
