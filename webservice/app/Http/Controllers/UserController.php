<?php

namespace App\Http\Controllers;

use DB;
use Response;

use App\User;
use App\UserSkill;
use App\UserReports;
use App\Company;
use App\Auth;
use App\Skill;
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

      $user_id = \Auth::User()->id;

      $data = Input::get('data');

      if (array_key_exists('skill', $data)) {
        $skill_data = $data['skill'];
        $skill_ids = [];

        foreach ($skill_data as $skill) {

          $query = Skill::where('name', $skill);

          if ($query->exists()) {

            $id = $query->pluck('id')[0];

          } else {

            $new_skill = new Skill;

            $new_skill->name = $skill;
            $new_skill->description = 'Geen beschrijving';

            $new_skill->save();

            $id = DB::getPdo()->lastInsertId();

          }

          if (!UserSkill::where('user_id', $user_id)->where('skills_id', $id)->exists()) {

            $user_skill = new UserSkill;

            $user_skill->user_id = $user_id;
            $user_skill->skills_id = $id;

            $user_skill->save();

          }

        }

      }

      User::where('id', $user_id)->update([
        'firstname' => $data['firstname'],
        'lastname' => $data['lastname'],
        'email' => $data['email'],
        'address' => $data['address'],
        'zipcode' => $data['zipcode'],
        'location' => $data['location'],
        'province' => $data['province'],
        'country' => $data['country'],
        'telephone' => $data['telephone'],
        'mobile' => $data['mobile'],
        'biography' => $data['biography']
      ]);

      return Response::json(true);

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

    public function change_profile_picture()
    {

      $user_id = \Auth::id();

      if (Input::hasFile('changePic')) {

        $file = Input::file('changePic');

        $type = $file->getclientoriginalextension();

        $file_status = false;

        if($type == 'jpg' || $type == 'jpeg' || $type == 'png') {

          $file_status = true;

          $old_logo = User::where('id', $user_id)->pluck('profilepicture')[0];
          if ($old_logo) {
            $image_path = public_path() . '' . $old_logo;
            if (file_exists($image_path)) {
              unlink($image_path);
            }
          }

          $original_name = $file->getClientOriginalName();

          $filename = date('d_m_Y_h_i_s') . '_' . rand(1000, 9999) . '_' . $original_name;
          $file_path = public_path() . '/storage/users';
          $database_path = '/storage/users';
          $database_path = $database_path.'/'.$filename;

          $file->move($file_path, $filename);

          User::where('id', $user_id)->update(['profilepicture' => $database_path]);

        }

      }

      $url = '/user/' . $user_id;
      return redirect(url($url));

    }
}
