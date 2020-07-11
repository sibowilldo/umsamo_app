<?php

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
Route::get('verify/cell', 'Auth\OtpController@show')->name('auth.cell.verified');
//, 'verified'
Route::post('verify/cell/confirm', 'Auth\OtpController@confirm')->name('auth.cell.confirm')->middleware(['auth']);
Route::post('verify/{user}/cell/request', 'Auth\OtpController@request')->name('auth.cell.request')->middleware(['auth']);

Route::middleware(['auth', 'verified', 'cell_number_verified'])->group(function(){

    Route::get('/', 'PagesController@index')->name('dashboard');
    Route::patch('appointments/{appointment}/cancel', 'AppointmentController@cancel')->name('appointments.cancel');
    Route::resource('appointments', 'AppointmentController');
    Route::resource('events', 'EventController')->middleware(['role:kingpin|administrator']);
    Route::resource('event-dates', 'EventDateController')->middleware(['role:kingpin|administrator']);
    Route::post('families/{family}/invite', 'FamilyController@invite')->name('families.invite');
    Route::get('families/accept/{family}/{user}/{code}', 'FamilyController@accept')->name('families.accept');
    Route::resource('families', 'FamilyController');
    Route::get('users/profile/manage-family/{user}', 'UserController@manage_family')->name('profiles.manage-family');
    Route::get('users/profile/overview/{user}', 'UserController@overview')->name('profiles.overview');
    Route::get('users/profile/personal-information/{user}', 'UserController@personal_information')->name('profiles.personal-information');
    Route::get('users/profile/account-information/{user}', 'UserController@account_information')->name('profiles.account-information');
    Route::get('users/profile/change-password/{user}', 'UserController@change_password')->name('profiles.change-password');
    Route::get('profiles/search/{profile}', 'ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ProfileController')->only('update', 'destroy', 'show');
    Route::resource('regions', 'RegionController')->middleware(['role:kingpin']);
    Route::resource('statuses', 'StatusController')->middleware(['role:kingpin']);

    Route::get('/home', 'HomeController@index')->name('home');

    //Administrator Prefixed Controllers
    Route::prefix('administrator')->namespace('Administrator')->group(function(){
        Route::get('appointments/today', 'AppointmentController@today')->name('appointments.today');
        Route::get('appointments/upcoming', 'AppointmentController@upcoming')->name('appointments.upcoming');
        Route::get('appointments/historical', 'AppointmentController@historical')->name('appointments.historical');
    });
    //Ajax Controllers
    Route::prefix('ajax')->namespace('Ajax')->group(function(){
        Route::get('event-dates', 'EventDateController@index')->name('ajax.event-dates.index');
        Route::get('families/{family}/members', 'FamilyController@members')->name('families.members');
    });

    Route::get('/print/appointments/today', 'PrintController@appointmentsTodayPdf')->name('print.appointments.today');
    Route::get('send-sms','PagesController@testSMS');
    Route::get('notify-me','PagesController@testNotifications');
});

Route::prefix('cronos')->group(function(){
    Route::get('public-holidays', 'CronController@getPublicHolidays');
});


//
//Route::get('viewmail', function () {
//    $appointment = \App\Appointment::first();
//    $user = \App\User::findOrFail(1);
//    return $user->notify(new \App\Notifications\AppointmentCreated($appointment));
//});
// Demo routes
//Route::get('/datatables', 'PagesController@datatables');
//Route::get('/ktdatatables', 'PagesController@ktDatatables');
//Route::get('/select2', 'PagesController@select2');
// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
