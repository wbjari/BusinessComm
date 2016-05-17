<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::auth();

Route::get('/home', 'HomeController@index');


// Everything below the following route is only accessable when logged in.
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/user/{id}', function ($id) {
	    return 'User: '. $id;
	});
});
