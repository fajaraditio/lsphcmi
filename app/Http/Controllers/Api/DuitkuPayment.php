<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Carbon\Carbon;
use Duitku\Config as DuitkuConfig;
use Duitku\Pop as DuitkuPop;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DuitkuPayment extends Controller
{
    public function return(Request $request)
    {
        if (!empty($request->merchantOrderId) && $request->resultCode == '00') {
            Participant::where('invoice', $request->merchantOrderId)->update([
                'payment_verified_at'   => Carbon::now(),
                'payment_status'        => 'paid',
            ]);
        }

        return redirect()->route('participant.register.5');
    }

    public function callback(Request $request)
    {
        return response([], 200);
    }
}
