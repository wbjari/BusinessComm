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

class UserController extends Controller
{

    public function index($user_id)
    {

      // Get user data
      $user = User::where('id', $user_id)->first();

      // if userstatus is 1 (allowed)
      if($user->status === 1){

        // Get user skills
        $user_skills = UserSkill::
        where('user_skills.user_id', $user_id)
        ->join('skills', 'skills.id', '=', 'user_skills.skills_id')
        ->get([
          'skills.id',
          'skills.name'
        ]);
        
          return view('profile', [
            'user' => $user,
            'user_skills' => $user_skills
          ]);

      } else {
        abort(404);
      }

    }

    public function edit()
    {

      $user_id = \Auth::User()->id;
      $data = Input::get('data');

      // if skill array exists in data array
      if (array_key_exists('skill', $data)) {

        $skill_ids = [];

        foreach ($data['skill'] as $skill) {
          // foreach skill
          $query = Skill::where('name', $skill);

          // If skill exists in database
          if ($query->exists()) {

            // get skill id
            $id = $query->pluck('id')[0];
          } else {

            // Create new skill
            $new_skill = new Skill;

            $new_skill->name = $skill;
            $new_skill->description = 'Geen beschrijving';

            $new_skill->save();

            $id = DB::getPdo()->lastInsertId();

          }

          // if skill is not added to user, add to user
          if (!UserSkill::where('user_id', $user_id)->where('skills_id', $id)->exists()) {

            $user_skill = new UserSkill;

            $user_skill->user_id = $user_id;
            $user_skill->skills_id = $id;

            $user_skill->save();

          }
        }

        unset($data['skill']);
      }

      // Update user data
      User::where('id', $user_id)->update($data);

      return Response::json('Profiel succesvol bewerkt.');

    }

    public function report_user()
    {
      $data = Input::get();

      // if user id is logged in id, report user
      if((int)$data['user'] === \Auth::User()->id){
        return redirect()->route('user', $data['user'])->with('notification', 'Je kan jezelf niet rapporteren.');
      } elseif(!userReports::insert(['user_id' => $data['user'], 'reason' => $data['reason'], 'reported_by' => \Auth::User()->id])){
        return redirect('user/'.$data['user'])->with('notification', 'Er is iets fout gegaan bij het rapporteren.');
      }

      return redirect()->route('user', $data['user'])->with('notification', 'De gebruiker is succesvol gerapporteerd.');
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

          // Remove special characters from name
          $original_name = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());

          // add date and random number to filename
          $filename = date('d_m_Y_h_i_s') . '_' . rand(1000, 9999) . '_' . $original_name;
          $file_path = public_path() . '/storage/users';
          $database_path = '/storage/users';
          $database_path = $database_path.'/'.$filename;

          $file->move($file_path, $filename);

          User::where('id', $user_id)->update(['profilepicture' => $database_path]);

          return redirect('user/'.$user_id)->with('notification', 'Profielfoto is succesvol gewijzigd.');
        }
      }
      return redirect('user/'.$user_id)->with('notification', 'Er is iets fout gegaan bij het wijzigen van uw profielfoto.');
    }

    public function remove_skill() {
      $skill_id = Input::get('data');
      $query = UserSkill::where('user_id', \Auth::id())->where('skills_id', $skill_id);

      if ($query->exists()) {
        $query->delete();
        return Response::json("Vaardigheid succesvol verwijderd.");
      }
      return Response::json("Er is iets fout gegaan bij het verwijderen van de vaardigheid.");
    }

    public function search_skill()
    {

      $text = Input::get('text');
      $limit = Input::get('limit');

      $query = Skill::where('name', 'LIKE', '%'.$text.'%')->take($limit)->get(['name']);

      return $query;
    }

    public function search_user()
    {

      $text = Input::get('text');
      $limit = Input::get('limit');

      $query = User::where('email', 'LIKE', '%'.$text.'%')->where('role', 0)->take(3)->get(['email']);

      return $query;
    }

}
