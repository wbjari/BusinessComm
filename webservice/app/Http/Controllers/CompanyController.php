<?php

namespace App\Http\Controllers;

use DB;
use Response;

use App\User;
use App\Company;
use App\CompanyUser;
use App\Post;
use App\Inquiry;
use App\CompanyReports;

use App\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CompanyController extends Controller
{

    public function index($company_id)
    {

      // Get values of company by ID.
      $company = Company::where('id', $company_id)->first();

      // User ID and company ID.
      $user_id = \Auth::id();
      $company_id = $company['id'];

      // Check if current user is member of the company.
      $is_member = CompanyUser::where('user_id', $user_id)->where('company_id', $company_id)->first();

      $requested = false;
      $requests = false;

      // If user is a member of the company set $member to true.
      if ($is_member) {

        //Check if member is member/co-manager/manager.
        $role = CompanyUser::where('user_id', $user_id)->where('company_id', $company_id)->pluck('role')[0];

        if ($role == 2 || $role == 3) {
          $requests = Inquiry::
          where('company_id', $company_id)
          ->join('users', 'requests.user_id', '=', 'users.id')
          ->get(['requests.*', 'users.firstname', 'users.lastname']);
        }

      } else {

        // If user is not a member of the company set $role to 0.
        $role = 0;

        // Check if user has already sent a request to become a member of the company.
        if (Inquiry::where('user_id', '=', $user_id)->where('company_id', '=', $company_id)->exists()) {
          $requested = true;
        }

      }

      // Get posts that are placed on the timeline of the company.
      $posts = Post::where('posts.company_id', $company_id)
                    ->orderBy('created_at', 'DESC')
                    ->join('users', 'posts.user_id', '=', 'users.id')
                    ->join('company_users', function($join) {
                      $join->on('posts.user_id', '=', 'company_users.user_id')
                      ->on('posts.company_id', '=', 'company_users.company_id');
                    })
                    ->get([
                      'posts.*',

                      'company_users.role',

                      'users.firstname',
                      'users.lastname'
                    ]);

      if (!$company) {
        abort(404);
      }

      $members = CompanyUser::where('company_id', $company_id)->join('users', 'users.id', '=', 'company_users.user_id')->get(['users.id', 'users.firstname', 'users.lastname', 'users.email', 'company_users.role']);

      foreach ($members as $member) {
        switch ($member->role) {
          case 1:
            $member->role = 'Lid';
            break;
          case 2:
            $member->role = 'Mede-beheerder';
            break;
          case 3:
            $member->role = 'Beheerder';
            break;

          default:
            $member->role = NULL;
            break;
        }
      }

      if($is_member && $role == 3){
        return view('company_edit', [
          'company' => $company,
          'posts' => $posts,
          'requested' => $requested,
          'role' => $role,
          'requests' => $requests,
          'members' => $members
        ]);
      } else {
        return view('company', [
          'company' => $company,
          'posts' => $posts,
          'requested' => $requested,
          'role' => $role,
          'requests' => $requests,
          'members' => $members
        ]);
      }
    }

    public function index_create()
    {

      return view('create_company');

    }

    public function create(Request $request)
    {

      $this->validate($request, [
        'name' => 'required',
        'address' => 'required',
        'zipcode' => 'required',
        'location' => 'required',
        'province' => 'required',
        'country' => 'required'
      ]);

      if ($request->hasFile('logo')) {

        $file = $request->file('logo');

        $type = $file->getclientoriginalextension();

        $file_status = false;

        if($type == 'jpg' || $type == 'jpeg' || $type == 'png') {

          $file_status = true;

          $original_name = $file->getClientOriginalName();

          $filename = date('d_m_Y_h_i_s') . '_' . rand(1000, 9999) . '_' . $original_name;
          $file_path = public_path() . '/storage/companies';
          $database_path = '/storage/companies';

          $file->move($file_path, $filename);

        }


      }


      $company = new Company;

      $company->name        =   $request["name"];
      $company->slogan      =   $request["slogan"];
      $company->email       =   $request["email"];
      $company->telephone   =   $request["telephone"];
      $company->biography   =   $request["biography"];
      $company->address     =   $request["address"];
      $company->zipcode     =   $request["zipcode"];
      $company->location    =   $request["location"];
      $company->province    =   $request["province"];
      $company->country     =   $request["country"];

      if (Input::hasFile('logo') && $file_status == true) {
        $company->logo        =   $database_path.'/'.$filename;
      }

      $company->save();

      $current_company_id = DB::getPdo()->lastInsertId();

      $company_user = new CompanyUser;

      $company_user->user_id = \Auth::id();
      $company_user->company_id = $current_company_id;
      $company_user->role = 3;

      $company_user->save();

      $url = '/company/' . $current_company_id;
      return redirect(url($url));

    }

    public function change_logo()
    {

      $company_id = Input::get('company');

      if (Input::hasFile('changeLogo')) {

        $file = Input::file('changeLogo');

        $type = $file->getclientoriginalextension();

        $file_status = false;

        if($type == 'jpg' || $type == 'jpeg' || $type == 'png') {

          $file_status = true;

          $old_logo = Company::where('id', $company_id)->pluck('logo')[0];
          if ($old_logo) {
            $image_path = public_path() . '' . $old_logo;
            if (file_exists($image_path)) {
              unlink($image_path);
            }
          }

          $original_name = $file->getClientOriginalName();

          $filename = date('d_m_Y_h_i_s') . '_' . rand(1000, 9999) . '_' . $original_name;
          $file_path = public_path() . '/storage/companies';
          $database_path = '/storage/companies';
          $database_path = $database_path.'/'.$filename;

          $file->move($file_path, $filename);

          Company::where('id', $company_id)->update(['logo' => $database_path]);

        }

      }

      $url = '/company/' . $company_id;
      return redirect(url($url));

    }

    public function request()
    {

      $data = Input::get('data');

      if (!Inquiry::where('user_id', '=', \Auth::id())->where('company_id', '=', $data)->exists()) {

        $inquiry = new Inquiry;

        $inquiry->user_id = \Auth::id();
        $inquiry->company_id = $data;

        $inquiry->save();

        return Response::json(true);

      }

    }

    public function cancel_request()
    {

      $data = Input::get('data');

      Inquiry::where('user_id', '=', \Auth::id())->where('company_id', '=', $data)->delete();

      return Response::json(true);

    }

    public function accept_request()
    {

      $data = Input::get('data');
      $user_id = $data['user'];
      $company_id = $data['company'];

      $inquiry_query = Inquiry::where('user_id', '=', $user_id)->where('company_id', '=', $company_id);

      if ($inquiry_query->exists()) {

        $company_user = new CompanyUser;

        $company_user->user_id = $user_id;
        $company_user->company_id = $company_id;
        $company_user->role = 1;

        $company_user->save();

        $inquiry_query->delete();

        return Response::json(true);

      }

    }

    public function deny_request()
    {

      $data = Input::get('data');
      $user_id = $data['user'];
      $company_id = $data['company'];

      $inquiry_query = Inquiry::where('user_id', '=', $user_id)->where('company_id', '=', $company_id);

      if ($inquiry_query->exists()) {

        $inquiry_query->delete();

        return Response::json(true);

      }

    }

    public function report_company()
    {
      $data = Input::get();

      if(!CompanyReports::insert(['company_id' => $data['company'], 'reason' => $data['reason'], 'reported_by' => \Auth::User()->id])){
        die('Er ging iets fout met het rapporteren van het bedrijf.');
      }

      return redirect()->route('company', $data['company'])->with('notification', 'Het bedrijf is successvol gerapporteerd');
    }

    public function edit($company_id)
    {

      $confirm_admin = CompanyUser::where('company_id', $company_id)
      ->where('user_id', \Auth::User()->id)
      ->where('role', 3)
      ->first();

      if(count($confirm_admin) > 0){
        $data = Input::get('data');


        if(Company::where('id', $company_id)->update($data)){
          $result['code'] = '200';
          $result['status'] = 'Het bedrijf is successvol bijgewerkt.';
        } else {
          $result['code'] = '500';
          $result['status'] = 'Oops! Er is iets fout gegaan.';
        }
      }

      return json_encode($result);
    }

    public function users_edit($company_id) {

      $data = Input::get();

      switch ($data['userRole']) {
        case 'Mede-beheerder':
          if(!CompanyUser::where('user_id', $data['id'])->where('company_id', $company_id)->update(['role' => 2])){
            die('Er is een fout opgetreden. Er zijn niet de juiste waardes meegegeven.');
          }
          return redirect(url('/company/'.$company_id));
          break;

        case 'Lid':
          if(!CompanyUser::where('user_id', $data['id'])->where('company_id', $company_id)->update(['role' => 1])){
            die('Er is een fout opgetreden. Er zijn niet de juiste waardes meegegeven.');
          }
          return redirect(url('/company/'.$company_id));
          break;

        case 'Verwijderen':
          if(!CompanyUser::where('user_id', $data['id'])->where('company_id', $company_id)->delete()){
            die('Er is een fout opgetreden. Er zijn niet de juiste waardes meegegeven.');
          }
          return redirect(url('/company/'.$company_id));
          break;
        
        default:
          die('onbekende fout');
          break;
      }

      

    }
}
