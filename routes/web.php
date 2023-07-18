<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Pages\Certification\Registration as CertificationRegistration;
use App\Http\Livewire\Pages\Finance\Registration as FinanceRegistration;
use App\Http\Livewire\Pages\Assessor\Registration as AssessorRegistration;
use App\Http\Livewire\Pages\Participant\RegisterStep1;
use App\Http\Livewire\Pages\Participant\RegisterStep2;
use App\Http\Livewire\Pages\Participant\RegisterStep3;
use App\Http\Livewire\Pages\Participant\RegisterStep4;
use App\Http\Livewire\Pages\Participant\RegisterStep5;
use App\Http\Livewire\Pages\Participant\RegistrationVerified;
use App\Http\Livewire\Pages\Participant\TestAgreement;
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

        Route::get('/participant/registration/verified', RegistrationVerified::class)->name('participant.registration.verified');

        Route::get('/participant/test/agreement', TestAgreement::class)->name('participant.test.agreement');
    });

    Route::middleware('role:certification')->group(function () {
        Route::get('/registration/apl/1', CertificationRegistration::class)->name('certification.registration');
    });

    Route::middleware('role:finance')->group(function () {
        Route::get('/registration/payment', FinanceRegistration::class)->name('finance.registration');
    });

    Route::middleware('role:assessor')->group(function () {
        Route::get('/registration/apl/2', AssessorRegistration::class)->name('assessor.registration');
    });
});

require __DIR__ . '/auth.php';
