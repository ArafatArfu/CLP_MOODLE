<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\CenterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;

use App\Http\Controllers\DonateController;
use App\Http\Controllers\GeneralUpdateController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolInfoController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\DonationFormController;

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
require __DIR__ . '/auth.php';
// Route::get('/registration', [ParticipantController::class, 'index'])->name('registration.form');
// Route::post('/registration', [ParticipantController::class, 'store'])->name('registration.submit');
// Route::get('/registration-success', function () {
//     return view('auth.success');
// })->name('registration.success');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Geo Locaiton
    Route::resource('/divisions', DivisionController::class);
    Route::resource('/districts', DistrictController::class);
    Route::resource('/upazilas', UpazilaController::class);

    // Schools
    Route::resource('/schools', SchoolController::class);

    // School Info
    Route::resource('/school-infos', SchoolInfoController::class);

    // Center
    Route::resource('/centers', CenterController::class);

    // Subscribers
    Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('/subscribers/{subscriber}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');

    // Volunteer
    Route::get('/volunteers', [VolunteerController::class, 'index'])->name('admin.volunteers.index');
    Route::delete('/volunteers/{volunteer}', [VolunteerController::class, 'destroy'])->name('admin.volunteers.destroy');

    // Donate
    Route::get('/donates', [DonateController::class, 'index'])->name('donates.index');
    Route::delete('/donates/{donate}', [DonateController::class, 'destroy'])->name('donates.destroy');

    // Contact
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // General Update
    Route::get('/general-update', [GeneralUpdateController::class, 'index'])->name('general-updates.index');
    Route::put('/general-update', [GeneralUpdateController::class, 'update'])->name('general-updates.update');

    // News
    Route::post('/news/change-status/{news}', [NewsController::class, 'changeStatus'])->name('news.status');
    Route::resource('/news', NewsController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Roles
    Route::get('/users/{user}/roles/{role}', [RoleController::class, 'assignRole']);
    Route::delete('/users/{user}/roles/{role}', [RoleController::class, 'removeRole']);
    Route::resource('/roles', RoleController::class);

    // permission
    Route::resource('/permissions', PermissionController::class);
    Route::get('/add-permission/{permission}/roles/{role}', [PermissionController::class, 'givePermission']);
    Route::get('/revoke-permission/{permission}/roles/{role}', [PermissionController::class, 'revokePermission']);
});



//Website Routes
Route::middleware(['track.visitors'])->group(function () {
    Route::get('/', [WebsiteController::class, 'index'])->name('website.home');
    Route::get('/our-team', [WebsiteController::class, 'team'])->name('website.team');
    Route::get('/history', [WebsiteController::class, 'history'])->name('website.history');
    Route::get('/mission', [WebsiteController::class, 'mission'])->name('website.mission');
    Route::get('/impact', [WebsiteController::class, 'impact'])->name('website.impact');
    Route::get('/our-partners', [WebsiteController::class, 'partners'])->name('website.partners');
    Route::get('/faq', [WebsiteController::class, 'faq'])->name('website.faq');
    Route::get('/smart-class-room', [WebsiteController::class, 'smartClassRoom'])->name('website.smartClassRoom');
    Route::get('/tokai', [WebsiteController::class, 'tokai'])->name('website.tokai');
    Route::get('/curriculum-development', [WebsiteController::class, 'curriculumDevelopment'])->name('website.curriculumDevelopment');
    Route::get('/teacher-training-program', [WebsiteController::class, 'teacherTrainingProgram'])->name('website.teacherTrainingProgram');
    Route::get('/success-stories', [WebsiteController::class, 'successStories'])->name('website.successStories');
    Route::get('/connect-students-around', [WebsiteController::class, 'connectStudents'])->name('website.connectStudents');
    Route::get('/clc-teaching', [WebsiteController::class, 'clcTeaching'])->name('website.clcTeaching');
    Route::get('/connect-parents-school', [WebsiteController::class, 'connectParentsSchool'])->name('website.connectParentsSchool');
    Route::get('/education-through-entertainment', [WebsiteController::class, 'educationThroughEntertainment'])->name('website.educationThroughEntertainment');
    Route::get('/amazon-smile', [WebsiteController::class, 'amazonSmile'])->name('website.amazonSmile');
    Route::get('/sponsor_a_scr.htm', [WebsiteController::class, 'sponsorScr'])->name('website.sponsorScr');
    Route::get('/sponsor_a_clc.htm', [WebsiteController::class, 'sponsorClc'])->name('website.sponsorClc');
    Route::get('/sponsor_a_tokai.htm', [WebsiteController::class, 'sponsorTokai'])->name('website.sponsorTokai');
    Route::get('/independent-evaluation-report', [WebsiteController::class, 'independentEvaluationReport'])->name('website.independentEvaluationReport');
    Route::get('/formative-reports', [WebsiteController::class, 'formativeReports'])->name('website.formativeReports');
    Route::get('/annual-report', [WebsiteController::class, 'annualReport'])->name('website.annualReport');
    Route::get('/magazines', [WebsiteController::class, 'magazines'])->name('website.magazines');
    Route::get('/brochure', [WebsiteController::class, 'brochure'])->name('website.brochure');
    Route::get('/remote-volunteer', [WebsiteController::class, 'remoteVolunteer'])->name('website.remoteVolunteer');
    Route::get('/develop-training-material', [WebsiteController::class, 'trainingMaterial'])->name('website.trainingMaterial');
    Route::get('/all-purpose', [WebsiteController::class, 'allPurpose'])->name('website.allPurpose');
    Route::get('/2nd-batch-training-program', [WebsiteController::class, 'secondBatchTrainingProgram'])->name('website.secondBatchTrainingProgram');
    Route::get('/teacher_training', [WebsiteController::class, 'teacherTraining'])->name('website.teacherTraining');
    Route::get('/contact-us', [WebsiteController::class, 'contactUs'])->name('website.contactUs');
    Route::get('/volunteer', [WebsiteController::class, 'volunteer'])->name('website.volunteer');
    Route::post('/volunteer', [WebsiteController::class, 'volunteerStore'])->name('website.volunteerStore');
    Route::post('/5_dollar_graduate.htm', [WebsiteController::class, 'fiveDollarGraduate'])->name('website.fiveDollarGraduate');
    Route::get('/sherpur_pr', [WebsiteController::class, 'sherpurPr'])->name('website.sherpurpr');
    Route::get('/schoolinfo', [WebsiteController::class, 'schoolInfo'])->name('website.schoolInfo');
    Route::get('/school-details', [WebsiteController::class, 'schoolDetails'])->name('website.schoolDetails');
    Route::get('/search-center', [WebsiteController::class, 'searchCenter'])->name('website.searchCenter');
    Route::get('/independent-evaluation-report', [WebsiteController::class, 'evaluationReport'])->name('website.evaluationReport');
    //Website Routes

    //Donate Routes
    Route::get('/donate-online', [DonationController::class, 'index'])->name('donation.index');
    Route::get('/donate-mail', [DonationController::class, 'mail'])->name('donation.mail');
    Route::get('/amazon-smile', [DonationController::class, 'amazonSmile'])->name('donation.amazonSmile');
    Route::get('/sponsor-computer', [DonationController::class, 'sponsorComputer'])->name('donation.sponsorComputer');
    Route::post('/donate-online', [DonationController::class, 'store'])->name('donation.store');
    //Donate Routes
    
    //Donation Routes
    Route::get('/donation', [DonationFormController::class, 'index'])->name('donation.form');
    Route::post('/donation', [DonationFormController::class, 'store'])->name('donation.submit');
    Route::get('/donation-success', function () {
     return view('website.donation.success');
    })->name('donation.success');
    //Donation Routes



    //News
    Route::get('/news-coverage', [NewsController::class, 'newsCoverage'])->name('news.newsCoverage');
    Route::get('/latest-news', [NewsController::class, 'latestNews'])->name('news.latestNews');
    Route::get('/news/{slug}', [NewsController::class, 'single'])->name('news.single');
});

//News

//Ajax API
Route::get('/districts', [AjaxController::class, 'districts'])->name('ajax.districts');
Route::get('/upazilas', [AjaxController::class, 'upazilas'])->name('ajax.upazilas');
Route::get('/schools', [AjaxController::class, 'schools'])->name('ajax.schools');
//Ajax API

//volunteer
Route::resource('volunteers', VolunteerController::class); // for admin panel
//Admin Panel

//email controller
Route::post('/sendemail/send', [SendEmailController::class, 'send'])->name('mail.send');
// Route::post('/sendemail/tokaipledge', [SendEmailController::class, 'sendPledgeForm'])->name('mail.tokaiPledge');
// Route::post('/sendemail/pledge', [SendEmailController::class, 'sendPledgeForm'])->name('mail.pledge');
// Route::post('/sendemail/pledge2', [SendEmailController::class, 'sendPledgeFormTwo'])->name('mail.pledgeTwo');
// Route::post('/sendemail/clcpledge', [SendEmailController::class, 'sendPledgeForm']);

Route::post('/sendemail/sponsor', [SendEmailController::class, 'sendPledgeForm'])->name('sponsor.mail');



//Dhunat Project
Route::get('/dhunat-project', function () {
    return view('website.dhunat_project.first');
});

//Essential Office Skills
Route::get('/eos-evaluation-report-01', function () {
    return view('website.eos-evaluation-report-01');
});




Route::get('/run-config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache has been cleared and rebuilt!';
});

Route::get('/run-cache-clear', function () {
    Artisan::call('cache:clear');
    return 'Cache has been cleared!';
});

Route::get('/run-optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Cache has been cleared!';
});

