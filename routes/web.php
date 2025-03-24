<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MentorLearnerController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\AppointController;
use Illuminate\Support\Facades\DB;
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

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function (): void {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');  
    
    Route::get('/messages', function () {
        return view('pages/messages');
    })->name('messages');

    Route::get('/tutor-list', function () {
        return view('pages/tutor-list');
    })->name('tutor-list')->middleware('mentorlearner');
    
    Route::get('/view-schedule-appointment/{user}', [AppointController::class, 'viewScheduleAppointment'])->name('view-schedule-appointment');
    Route::get('/systemadmin/systemadmin-card-02', [AppointController::class, 'viewScheduleSysadmin'])->name('systemadmin-card-02'); 
    Route::get('/set-schedule-appointment/{user}', [AppointController::class, 'setScheduleAppointment'])->name('set-schedule-appointment');
    Route::post('/save-appointment', [AppointController::class, 'saveAppointment'])->name('save.appointment');
    Route::get('/check-email', function (Illuminate\Http\Request $request) {
        $email = $request->query('email');
        $exists = DB::table('users')->where('email', $email)->exists();
        return response()->json(['exists' => $exists]);
    })->name('check.email');

    
    Route::get('/settings/account', function () {
        return view('pages/settings/account');
    })->name('account');  
    Route::get('/settings/notifications', function () {
        return view('pages/settings/notifications');
    })->name('notifications');  
    Route::get('/settings/systemadmin', function () {
        return view('pages/settings/systemadmin');
    })->name('systemadmin');

    Route::get('/component/button', function () {
        return view('pages/component/button-page');
    })->name('button-page');
    Route::get('/component/form', function () {
        return view('pages/component/form-page');
    })->name('form-page');
    Route::get('/component/dropdown', function () {
        return view('pages/component/dropdown-page');
    })->name('dropdown-page');
    Route::get('/component/alert', function () {
        return view('pages/component/alert-page');
    })->name('alert-page');
    Route::get('/component/modal', function () {
        return view('pages/component/modal-page');
    })->name('modal-page'); 
    Route::get('/component/pagination', function () {
        return view('pages/component/pagination-page');
    })->name('pagination-page');
    Route::get('/component/tabs', function () {
        return view('pages/component/tabs-page');
    })->name('tabs-page');
    Route::get('/component/breadcrumb', function () {
        return view('pages/component/breadcrumb-page');
    })->name('breadcrumb-page');
    Route::get('/component/badge', function () {
        return view('pages/component/badge-page');
    })->name('badge-page'); 
    Route::get('/component/avatar', function () {
        return view('pages/component/avatar-page');
    })->name('avatar-page');
    Route::get('/component/tooltip', function () {
        return view('pages/component/tooltip-page');
    })->name('tooltip-page');
    Route::get('/component/accordion', function () {
        return view('pages/component/accordion-page');
    })->name('accordion-page');
    Route::get('/component/icons', function () {
        return view('pages/component/icons-page');
    })->name('icons-page');
    Route::fallback(function() {
        return view('pages/utility/404');
    });    

    Route::get('/user/image/{id}', [UserController::class, 'getUserImage'])->name('user.image');

    Route::post('/layouts/mentorlearner', [MentorLearnerController::class, 'store'])->name('layouts.mentorlearner');

    Route::post('/save-major', [MajorController::class, 'store'])->name('save.major');

    Route::get('/majors', [MajorController::class, 'index'])->name('majors.index');
    Route::post('/check-major', [MajorController::class, 'checkMajor']);

   
    
});
