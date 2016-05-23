<?php

namespace App\Http\Controllers;

use DB;
use Response;
use App\User;
use App\Company;
use App\Post;
use App\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CompanyController extends Controller
{

    public function index($company_id)
    {

      $company = Company::where('id', $company_id)->first();
      $posts = Post::where('company_id', $company_id)->get();

      if ($company) {
        return view('company', [
          'company' => $company,
          'posts' => $posts
        ]);
      } else {
        abort(404);
      }

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
        $database_path = url('/storage/companies');

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
      $url = '/company/' . $current_company_id;
      return redirect(url($url));

    }

    public function change_logo()
    {
      $data = Input::get();
      dd($data);
      return Response::json(['hello']);

    }

}
