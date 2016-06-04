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
Route::group(['middleware' => 'web'], function () {

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

      Route::get('/admin', 'AdminController@index');
      Route::get('/admin/company/report/confirm/{report_id}', 'AdminController@company_confirm_report');
      Route::get('/admin/company/report/delete/{report_id}', 'AdminController@company_delete_report');
      Route::get('/admin/company/activate/{company_id}', 'AdminController@company_activate');
      Route::get('/admin/user/report/confirm/{report_id}', 'AdminController@user_confirm_report');
      Route::get('/admin/user/report/delete/{report_id}', 'AdminController@user_delete_report');
      Route::get('/admin/user/activate/{user_id}', 'AdminController@user_activate');

      Route::post('/company/report', 'CompanyController@report_company');
      Route::any('/company/{company_id}/edit', 'CompanyController@edit');
      Route::get('/company/{company_id}', [ 'as' => 'company', 'uses' => 'CompanyController@index']);

      Route::get('/create-company', 'CompanyController@index_create');
      Route::post('/create-company', 'CompanyController@create');
      Route::post('/change-logo', 'CompanyController@change_logo');

      Route::post('/request', 'CompanyController@request');
      Route::post('/cancel-request', 'CompanyController@cancel_request');
      Route::post('/accept-request', 'CompanyController@accept_request');
      Route::post('/deny-request', 'CompanyController@deny_request');

      Route::post('/create-post', 'PostController@create');
      Route::post('/remove-post', 'PostController@remove');

      Route::post('/change-profile-picture', 'UserController@change_profile_picture');
      Route::post('/user/report', 'UserController@report_user');
      Route::any('/user/{user_id}/edit', 'UserController@edit');
      Route::get('/user/{user_id}', [ 'as' => 'user', 'uses' => 'UserController@index']);

  });

});
