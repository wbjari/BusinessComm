<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use App\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    public function index($user_id)
    {
    	$userid = \Auth::User()->id;
      $user = User::where('id', $user_id)->first();
      echo '<pre>';
      echo $user;
      echo '</pre>';

      return view('profile', $user);

      //   $notifications = '';
      //
    	// $companies = Company::all(['name','slogan','logo']);
      //
      //   return view('dashboard', [
      //   	'user' => $user,
      //   	'notifications' => $notifications,
    	// 	'companies' => $companies
      //   ]);
    }

}
