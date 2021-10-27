<?php

use App\Http\Controllers\Administrator\FamilyAppointmentsController;
use App\Http\Controllers\Administrator\CalendarController;
use App\Http\Controllers\EventDateController;
use App\Http\Controllers\Ajax\EventDateController as AjaxEventDateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('locked/account/', 'Auth\AuthController@locked')->name('auth.locked.account');

Route::middleware(['is_locked'])->namespace('Auth')->group(function(){
//    GET
    Route::get('verify/cell', 'OtpController@show')->name('auth.cell.verified')->middleware(['auth']);
    Route::get('lock/{user}/account/', 'AuthController@lock')->name('auth.lock.account');
//    POST
    Route::post('verify/cell/confirm', 'OtpController@confirm')->name('auth.cell.confirm')->middleware(['auth']);
    Route::post('unlock/account', 'AuthController@unlock')->name('auth.unlock.account');
    Route::post('verify/{user}/cell/request', 'OtpController@request')->name('auth.cell.request')->middleware(['auth']);
});

Route::middleware(['auth', 'verified', 'cell_number_verified', 'is_locked'])->group(function(){
//    GET
    Route::get('users/profile/change-password/{user}', 'Auth\ChangePasswordController@show')->name('profiles.change-password');
    Route::get('/', 'PagesController@index')->name('dashboard');
    Route::get('families/accept/{family}/{user}/{code}', 'FamilyController@accept')->name('families.accept');
    Route::get('users/profile/manage-family/{user}', 'UserController@manage_family')->name('profiles.manage-family');
    Route::get('users/profile/overview/{user}', 'UserController@overview')->name('profiles.overview');
    Route::get('users/profile/personal-information/{user}', 'UserController@personal_information')->name('profiles.personal-information');
    Route::get('users/profile/account-information/{user}', 'UserController@account_information')->name('profiles.account-information');
//    POST
    Route::post('users/profile/change-password/', 'Auth\ChangePasswordController@update')->name('auth.change-password.update');
    Route::post('families/{family}/invite', 'FamilyController@invite')->name('families.invite');
    Route::post('profiles/search/{profile}', 'ProfileController@search')->name('profiles.search');
//    PATCH
    Route::patch('appointments/{appointment}/cancel', 'AppointmentController@cancel')->name('appointments.cancel');
    Route::patch('users/profile/{user}/change-cell-number/', 'ProfileController@update_cell')->name('profile.update.cell');
    Route::patch('users/{user}/change-email/', 'UserController@update_email')->name('user.update.email');
//    RESOURCES
    Route::resource('appointments', 'AppointmentController');
    Route::resource('events', 'EventController')->middleware(['role:kingpin|administrator']);
    Route::resource('event-dates', 'EventDateController')->middleware(['role:kingpin|administrator']);
    Route::resource('families', 'FamilyController');
    Route::resource('profiles', 'ProfileController')->only('update', 'destroy', 'show');
    Route::resource('regions', 'RegionController')->middleware(['role:kingpin']);
    Route::resource('statuses', 'StatusController')->middleware(['role:kingpin']);
    Route::resource('users', 'UserController')->middleware(['role:kingpin|administrator']);


    //Administrator Prefixed Controllers
    Route::middleware(['role:kingpin|administrator'])->prefix('administrator')->namespace('Administrator')->group(function(){
        Route::apiResource('appointments', 'AppointmentController', ['as'=>'admin']);
        Route::resource('calendar', CalendarController::class, ['as' => 'admin']);
        Route::apiResource('family-appointments', FamilyAppointmentsController::class, ['as'=>'admin']);
//        Patch
        Route::patch('appointments/{appointment}/status', 'AppointmentController@status')->name('api.appointments.status');
    });

    //Ajax Controllers
    Route::prefix('ajax')->namespace('Ajax')->group(function(){
        Route::apiResource('appointments', 'AppointmentController', ['as'=>'api']);
        Route::apiResource('calendar', 'CalendarController', ['as'=>'api']);
        Route::apiResource('statuses', 'StatusController', ['as'=>'api']);
        Route::apiResource('users', 'UserController', ['as'=>'api']);
        Route::patch('users/toggle-lock/{user}', 'UserController@toggleLock')->name('api.users.toggle');
//        Get
        Route::get('event-dates', [AjaxEventDateController::class, 'index'])->name('ajax.event-dates.index');
        Route::get('families/{family}/members', 'FamilyController@members')->name('families.members');

    });

    Route::get('/print/appointments/today', 'PrintController@appointmentsTodayPdf')->name('print.appointments.today');
    Route::get('send-sms','PagesController@testSMS');
    Route::get('notify-me','PagesController@testNotifications');

    Route::get('/home', 'HomeController@index')->name('home');
});

Route::prefix('cronos')->group(function(){
    Route::get('public-holidays', 'CronController@getPublicHolidays');
});

Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
