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
  if (Auth::guest()) {
    return view('home');
  } else {
    return redirect('/dashboard');
  }
});

Route::auth();

// Everything below the following route is only accessable when logged in.
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/company/{company_id}', 'CompanyController@index');

    Route::get('/create-company', 'CompanyController@index_create');
    Route::post('/create-company', 'CompanyController@create');
    Route::any('/change-logo', 'CompanyController@change_logo');

    Route::post('/request', 'CompanyController@request');
    Route::post('/cancel-request', 'CompanyController@cancel_request');
    Route::post('/accept-request', 'CompanyController@accept_request');

    Route::post('/create-post', 'PostController@create');
    Route::post('/remove-post', 'PostController@remove');


    Route::get('/user/edit', 'UserController@edit');
    Route::get('/user/{user_id}', 'UserController@index');
});
