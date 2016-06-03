<?php

namespace App\Http\Controllers;

use App\User;
use App\UserReports;
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

      $user = User::where('id', $user_id)->first();

      if($user->status === 1){
        $user_skills = ['html', 'css', 'php', 'javascript'];

        if(\Auth::User()->id === (int)$user_id){
          return view('profile_edit', [
            'user' => $user,
            'user_skills' => $user_skills
          ]);
        } else {
          return view('profile', [
            'user' => $user,
            'user_skills' => $user_skills
          ]);
        }

          //   $notifications = '';
          //
          // $companies = Company::all(['name','slogan','logo']);
          //
          //   return view('dashboard', [
          //    'user' => $user,
          //    'notifications' => $notifications,
          //  'companies' => $companies
          //   ]);
      } else {
        abort(404);
      }
        
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

    public function report_user()
    {
      $data = Input::get();

      if((int)$data['user'] === \Auth::User()->id){
        return redirect()->route('user', $data['user'])->with('notification', 'Je kan jezelf niet rapporteren.');
      } elseif(!userReports::insert(['user_id' => $data['user'], 'reason' => $data['reason'], 'reported_by' => \Auth::User()->id])){
        die('Er ging iets fout met het rapporteren van het bedrijf.');
      }
      
      return redirect()->route('user', $data['user'])->with('notification', 'De gebruiker is successvol gerapporteerd');
    }

}
