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

    Route::get('/admin_add_rrequest','App\Http\Controllers\AdminController@add_resource_request')->name('add_resource_request');
    Route::post('/admin_add_rrequest','App\Http\Controllers\ReqListController@rstore')->name('resource_request');

    Route::get('/admin_add_trequest','App\Http\Controllers\AdminController@add_tutorial_request')->name('add_tutorial_request');
    Route::post('/admin_add_trequest','App\Http\Controllers\ReqListController@tstore')->name('tutorial_request');

    Route::get('/admin_view_request','App\Http\Controllers\AdminController@view_request')->name('view_request_history');

    Route::get('/admin_view_offer', 'App\Http\Controllers\AdminController@view_offer')->name('view_offer_list');
    Route::post('/admin_view_offer', 'App\Http\Controllers\AdminController@approve_offer')->name('approve_offer');

    //* Volunteer Dashboard *//
    Route::get('/volunteer_dashboard', 'App\Http\Controllers\VolunteerController@dashboard')->name('volunteer_dashboard');

    Route::get('/volunteer_profile', 'App\Http\Controllers\VolunteerController@profile')->name('profile');
    Route::post('/volunteer_profile', 'App\Http\Controllers\VolunteerController@update')->name('update_volunteer_profile');

    Route::get('/volunteer_view_request', 'App\Http\Controllers\VolunteerController@view_request')->name('view_request_list');
    Route::post('/volunteer_view_request', 'App\Http\Controllers\OfferController@store')->name('create_offer');

    Route::get('/volunteer_offer_history', 'App\Http\Controllers\VolunteerController@view_offer')->name('view_offer_history');

});