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

Route::get('locked/account/', 'Auth\AuthController@locked')->name('auth.locked.account');

Route::middleware(['is_locked'])->namespace('Auth')->group(function(){
    Route::get('verify/cell', 'OtpController@show')->name('auth.cell.verified');
    Route::post('verify/cell/confirm', 'OtpController@confirm')->name('auth.cell.confirm')->middleware(['auth']);
    Route::post('verify/{user}/cell/request', 'OtpController@request')->name('auth.cell.request')->middleware(['auth']);
    Route::get('lock/{user}/account/', 'AuthController@lock')->name('auth.lock.account');
    Route::post('unlock/account', 'AuthController@unlock')->name('auth.unlock.account');
});

Route::middleware(['auth', 'verified', 'cell_number_verified', 'is_locked'])->group(function(){
    Route::get('users/profile/change-password/{user}', 'Auth\ChangePasswordController@show')->name('profiles.change-password');
    Route::post('users/profile/change-password/', 'Auth\ChangePasswordController@update')->name('auth.change-password.update');

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
    Route::post('profiles/search/{profile}', 'ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ProfileController')->only('update', 'destroy', 'show');
    Route::resource('regions', 'RegionController')->middleware(['role:kingpin']);
    Route::resource('statuses', 'StatusController')->middleware(['role:kingpin']);


    //Administrator Prefixed Controllers
    Route::middleware(['role:kingpin|administrator'])->prefix('administrator')->namespace('Administrator')->group(function(){
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

    Route::get('/home', 'HomeController@index')->name('home');
});

Route::prefix('cronos')->group(function(){
    Route::get('public-holidays', 'CronController@getPublicHolidays');
});

Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
