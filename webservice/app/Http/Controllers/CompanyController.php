<?php

namespace App\Http\Controllers;

use DB;
use Response;

use App\User;
use App\Company;
use App\CompanyUser;
use App\Post;
use App\Inquiry;

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
        $role = CompanyUser::where('user_id', $user_id)->where('company_id', $company_id)->pluck('role');

        if ($role = 2 | $role = 3) {
          $requests = Inquiry::where('company_id', $company_id)->get();
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
      $posts = Post::
      where('company_id', $company_id)
      ->leftJoin('users', 'posts.user_id', '=', 'users.id')
      ->get([
        'posts.*',

        'users.firstname',
        'users.lastname'
      ]);

      if (!$company) {
        abort(404);
      }

      return view('company', [
        'company' => $company,
        'posts' => $posts,
        'requested' => $requested,
        'role' => $role,
        'requests' => $requests
      ]);

    }

    public function index_create()
    {

      return view('create_company');

    }

    public function create()
    {

      $input = Input::all();

      if (Input::hasFile('logo')) {

        $file = Input::file('logo');
        $original_name = $file->getClientOriginalName();

        $filename = date('d_m_Y_h_i_s') . '_' . rand(1000, 9999) . '_' . $original_name;
        $file_path = public_path() . '/storage/companies';
        $database_path = '/storage/companies';

        $file->move($file_path, $filename);

      }


      $company = new Company;

      $company->name        =   $input["name"];
      $company->slogan      =   $input["slogan"];
      $company->email       =   $input["email"];
      $company->telephone   =   $input["telephone"];
      $company->biography   =   $input["biography"];
      $company->address     =   $input["address"];
      $company->zipcode     =   $input["zipcode"];
      $company->location    =   $input["location"];
      $company->province    =   $input["province"];
      $company->country     =   $input["country"];

      if (Input::hasFile('logo')) {
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
      $data = Input::get();
      dd($data);
      return Response::json(['hello']);

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

}
