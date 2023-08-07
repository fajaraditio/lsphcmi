<?php

use App\Http\Controllers\MinutesPaperController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestReportController;
use App\Http\Livewire\Dashboard;

use App\Http\Livewire\Pages\Certification\Registration as CertificationRegistration;
use App\Http\Livewire\Pages\Certification\AssessmentList as CertificationAssessmentList;
use App\Http\Livewire\Pages\Certification\MinutesPaper as CertificationMinutesPaper;

use App\Http\Livewire\Pages\Certification\Assessor as AssessorList;
use App\Http\Livewire\Pages\Finance\Registration as FinanceRegistration;

use App\Http\Livewire\Pages\Chief\AssessmentList as ChiefAssessmentList;
use App\Http\Livewire\Pages\Chief\TestReport as ChiefTestReport;

use App\Http\Livewire\Pages\Manager\TestSchedule as ManagerTestSchedule;
use App\Http\Livewire\Pages\Manager\AssessorAssignment as ManagerAssessorAssignment;

use App\Http\Livewire\Pages\Participant\RegisterStep1;
use App\Http\Livewire\Pages\Participant\RegisterStep2;
use App\Http\Livewire\Pages\Participant\RegisterStep3;
use App\Http\Livewire\Pages\Participant\RegisterStep4;
use App\Http\Livewire\Pages\Participant\RegisterStep5;
use App\Http\Livewire\Pages\Participant\RegistrationVerified;
use App\Http\Livewire\Pages\Participant\TestAgreement as ParticipantTestAgreement;
use App\Http\Livewire\Pages\Participant\TestPractice as ParticipantTestPractice;
use App\Http\Livewire\Pages\Participant\TestObservation as ParticipantTestObservation;
use App\Http\Livewire\Pages\Participant\TestFeedback as ParticipantTestFeedback;
use App\Http\Livewire\Pages\Participant\AssessmentReport as ParticipantAssessmentReport;

use App\Http\Livewire\Pages\Assessor\Registration as AssessorRegistration;
use App\Http\Livewire\Pages\Assessor\CompetencyTestList as AssessorCompetencyTestList;
use App\Http\Livewire\Pages\Assessor\TestAgreement as AssessorTestAgreement;
use App\Http\Livewire\Pages\Assessor\TestScheduleDetail as AssessorTestScheduleDetail;
use App\Http\Livewire\Pages\Assessor\TestObservation as AssessorTestObservation;
use App\Http\Livewire\Pages\Assessor\TestPractice as AssessorTestPractice;
use App\Http\Livewire\Pages\Assessor\TestFeedback as AssessorTestFeedback;
use App\Http\Livewire\Pages\Assessor\TestReport as AssessorTestReport;
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
        Route::prefix('/participant')->group(function () {
            Route::get('/register/step/1', RegisterStep1::class)->name('participant.register.1');
            Route::get('/register/step/2', RegisterStep2::class)->name('participant.register.2');
            Route::get('/register/step/3', RegisterStep3::class)->name('participant.register.3');
            Route::get('/register/step/4', RegisterStep4::class)->name('participant.register.4');
            Route::get('/register/step/5', RegisterStep5::class)->name('participant.register.5');

            Route::get('/registration/verified', RegistrationVerified::class)->name('participant.registration.verified');

            Route::get('/test/agreement',           ParticipantTestAgreement::class)->name('participant.test.agreement');
            Route::get('/test/test-practice',       ParticipantTestPractice::class)->name('participant.test.practice');
            Route::get('/test/test-observation',    ParticipantTestObservation::class)->name('participant.test.observation');
            Route::get('/test/feedback',            ParticipantTestFeedback::class)->name('participant.test.feedback');

            Route::get('/assessment/report',        ParticipantAssessmentReport::class)->name('participant.assessment.report');
        });
    });

    Route::middleware('role:certification')->group(function () {
        Route::prefix('/certification')->group(function () {
            Route::get('/registration/apl/1', CertificationRegistration::class)->name('certification.registration');

            Route::get('/assessor', AssessorList::class)->name('certification.assessor.list');

            Route::get('/assessment', CertificationAssessmentList::class)->name('certification.assessment.list');

            Route::get('/minutes-paper', CertificationMinutesPaper::class)->name('certification.minutes.paper');
        });
    });

    Route::middleware('role:finance')->group(function () {
        Route::prefix('/finance')->group(function () {
            Route::get('/registration/payment', FinanceRegistration::class)->name('finance.registration');
        });
    });

    Route::middleware('role:manager')->group(function () {
        Route::prefix('/management')->group(function () {
            Route::get('/schedule',             ManagerTestSchedule::class)->name('manager.test.schedule');
            Route::get('/assessor-assignment',  ManagerAssessorAssignment::class)->name('manager.assessor.assignment');
        });
    });

    Route::middleware('role:chief')->group(function () {
        Route::prefix('/control')->group(function () {
            Route::get('/assessment',           ChiefAssessmentList::class)->name('chief.assessment.list');
            Route::get('/report/{testReport}',  ChiefTestReport::class)->name('chief.test.report');
        });
    });

    Route::middleware('role:assessor')->group(function () {
        Route::prefix('/assessor')->group(function () {
            Route::get('/registration/apl/2',               AssessorRegistration::class)->name('assessor.registration');

            Route::get('/test/list',                        AssessorCompetencyTestList::class)->name('assessor.test.list');
            Route::get('/test/{testSchedule}',              AssessorTestScheduleDetail::class)->name('assessor.test.schedule.detail');
            Route::get('/test/{testSchedule}/agreement',    AssessorTestAgreement::class)->name('assessor.test.agreement');
            Route::get('/test/{testSchedule}/ia/2',         AssessorTestPractice::class)->name('assessor.test.practice');
            Route::get('/test/{testSchedule}/ia/3',         AssessorTestObservation::class)->name('assessor.test.observation');
            Route::get('/test/{testSchedule}/feedback',     AssessorTestFeedback::class)->name('assessor.test.feedback');
            Route::get('/test/{testSchedule}/report',       AssessorTestReport::class)->name('assessor.test.report');
        });
    });
});

Route::get('report/{testReport}/view/pdf',  [TestReportController::class, 'viewPDF'])->name('report.pdf');
Route::get('minutes-paper/view/pdf',        [MinutesPaperController::class, 'viewPDF'])->name('minutes-paper.pdf');

require __DIR__ . '/auth.php';
