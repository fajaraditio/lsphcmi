<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Pages\Certification\Registration;
use App\Http\Livewire\Pages\Participant\RegisterStep1;
use App\Http\Livewire\Pages\Participant\RegisterStep2;
use App\Http\Livewire\Pages\Participant\RegisterStep3;
use App\Http\Livewire\Pages\Participant\RegisterStep4;
use App\Http\Livewire\Pages\Participant\RegisterStep5;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:participant')->group(function () {
        Route::get('/participant/register/step/1', RegisterStep1::class)->name('participant.register.1');
        Route::get('/participant/register/step/2', RegisterStep2::class)->name('participant.register.2');
        Route::get('/participant/register/step/3', RegisterStep3::class)->name('participant.register.3');
        Route::get('/participant/register/step/4', RegisterStep4::class)->name('participant.register.4');
        Route::get('/participant/register/step/5', RegisterStep5::class)->name('participant.register.5');
    });

    Route::middleware('role:certification')->group(function () {
        Route::get('/registration', Registration::class)->name('certification.registration');
    });
});

require __DIR__ . '/auth.php';
