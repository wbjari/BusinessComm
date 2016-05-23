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
      // echo '<pre>';
      // echo $user;
      // echo '</pre>';

      $user_skills = ['html', 'css', 'php', 'javascript'];

      return view('profile', [
        'user' => $user,
        'user_skills' => $user_skills
        ]);

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

    public function edit()
    {

      $userid = \Auth::User()->id;

      $input = Input::get('data');

      for ($i=0; $i < count($input); $i++) { 
        $result[$input[$i]['name']] = $input[$i]['variable'];
      }

      // address

      // country

      // email

      // firstname

      // function

      // languages

      // lastname

      // location

      // phone

      // province

      // skill

      // telephone

      // zipcode


      dB::table('users')->where('id', $userid)->update($result);

      // echo $result['data'][1]['name'];

      // return json_encode($result['data']);
      // return 'test';
    }

}