<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Authentication System
Auth::routes();

//Home Page
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('about');

//* Dashboard *//
Route::group(['middleware' => 'auth'], function() {

    //* Admin Dashboard *//
    Route::get('/admin_dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('dashboard');

    Route::get('/admin_profile', 'App\Http\Controllers\AdminController@profile')->name('profile');
    Route::post('/admin_profile', 'App\Http\Controllers\AdminController@update')->name('update_profile');
    Route::post('/add_school', 'App\Http\Controllers\SchoolController@store')->name('add_school');

    //* Volunteer Dashboard *//
    Route::get('/volunteer_dashboard', 'App\Http\Controllers\VolunteerController@dashboard')->name('volunteer_dashboard');

    Route::get('/volunteer_profile', 'App\Http\Controllers\VolunteerController@profile')->name('profile');
    Route::post('/volunteer_profile', 'App\Http\Controllers\VolunteerController@update')->name('update_volunteer_profile');

});