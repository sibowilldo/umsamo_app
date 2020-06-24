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
//, 'verified'
Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/', 'PagesController@index')->name('dashboard');
    Route::resource('appointments', 'AppointmentController');
    Route::patch('appointments/{appointment}/cancel', 'AppointmentController@cancel')->name('appointments.cancel');
    Route::resource('events', 'EventController')->middleware(['role:kingpin|administrator']);
    Route::resource('event-dates', 'EventDateController')->middleware(['role:kingpin|administrator']);
    Route::resource('families', 'FamilyController');
    Route::get('profile/overview/{user}', 'ProfileController@overview')->name('profiles.overview');
    Route::resource('profiles', 'ProfileController');
    Route::resource('regions', 'RegionController')->middleware(['role:kingpin']);
    Route::resource('statuses', 'StatusController')->middleware(['role:kingpin']);

    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('ajax')->group(function(){
        Route::get('event-dates', 'Ajax\EventDateController@index')->name('ajax.event-dates.index');
    });

});

Route::prefix('cronos')->group(function(){
    Route::get('public-holidays', 'CronController@getPublicHolidays');
});

// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
