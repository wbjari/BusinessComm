<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use App\Auth;
use App\Skills;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller;

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

      // $userid = \Auth::User()->id;

      // $data = Input::get('data');

      $data = [
        "firstname" => "Koen",
        "lastname" => "de Bont",
        "function" => "",
        "location" => "Wagenberg",
        "province" => "Noord-Brabant",
        "country" => "Nederland",
        "address" => "Heemraadsingel 34",
        "zipcode" => "4944VD",
        "telephone" => "0162 518143",
        "mobile" => "0681705516",
        "skill" => [
          0 => "html",
          1 => "css",
          2 => "php",
          3 => "javascript"
        ]
      ];
      

      $skillData = $data['skill'];
      unset($data['skill']);


      // Skills::update($skillData);

      // $skills = new Skills;

      // $skills->name = 

      // $skills->save();

      // $dbskills = Skills::where('name', 'html')->get();
      $dbSkills = Skills::where(function($query) use ($skillData) {
        collect($skillData)->each(function($skill) use ($query) {
          $query->orWhere('name', '!=', $skill);
        });
      });

      // $dbSkills->get()



      for ($i=0; $i < count($dbSkills->get()); $i++) {
        $test[$i] = $dbSkills->get(['id', 'name'])[$i];
      }

      dd($test);

      // dd($dbskills);

      // dd($data);

      // if( User::where('id', $userid)->update($data) ){
      //   $result['code'] = '200';
      //   $result['status'] = 'Uw account is successvol bijgewerkt.';
      // } else {
      //   $result['code'] = '500';
      //   $result['status'] = 'Oops! Er is iets fout gegaan.';
      // }


      $data = 'test';
      return json_encode($data);
    }

}
