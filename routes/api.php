<?php

use App\Http\Controllers\Api\DuitkuPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/payment/duitku/callback', [    DuitkuPayment::class, 'callback'])->name('payment.duitku.callback');
Route::get('/payment/duitku/return',    [DuitkuPayment::class, 'return'])->name('payment.duitku.return');
