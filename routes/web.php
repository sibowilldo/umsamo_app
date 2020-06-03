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
Route::middleware(['auth'])->group(function(){
    Route::get('/', 'PagesController@index')->name('dashboard');
    Route::resource('appointments', 'AppointmentController');
    Route::patch('appointments/{appointment}/cancel', 'AppointmentController@cancel')->name('appointments.cancel');
    Route::resource('regions', 'RegionController')->middleware(['role:kingpin']);
    Route::resource('statuses', 'StatusController')->middleware(['role:kingpin']);



// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

Route::get('/home', 'HomeController@index')->name('home');
});
