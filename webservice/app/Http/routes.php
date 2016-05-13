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
Route::post('/createUser', 'Auth\AuthController@postRegister');

Route::get('/register', 'RegisterController@index');

Route::auth();

Route::get('/login', 'LoginController@index');

Route::get('/dashboard', function () {
    return view('dashboard');
});
