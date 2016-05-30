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
        $data[$input[$i]['name']] = $input[$i]['variable'];
      }

      dd($data);

      // unset($data['skill']);

      // if( User::where('id', $userid)->update($data) ){
      //   $result['code'] = '200';
      //   $result['status'] = 'Uw account is successvol bijgewerkt.';
      // } else {
      //   $result['code'] = '500';
      //   $result['status'] = 'Oops! Er is iets fout gegaan.';
      // }

      // return json_encode($result);
    }

}