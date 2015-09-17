<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showHome');

Route::get('/about', 'HomeController@showAbout');

Route::get('/careers', 'HomeController@showCareers');

Route::get('/login', 'UsersController@login');

Route::post('/login', 'UsersController@doLogin');

Route::get('/logout', 'UsersController@doLogout');

Route::resource('/users', 'UsersController');

Route::get('/events/manage', 'CalendarEventsController@getManage');

Route::resource('/events', 'CalendarEventsController');

Route::get('/update_password', 'UsersController@updatePassword');

Route::put('/update_password', 'UsersController@saveNewPassword');
