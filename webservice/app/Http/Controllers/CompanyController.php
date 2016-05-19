<?php

namespace App\Http\Controllers;

use DB;
use Response;
use App\User;
use App\Company;
use App\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CompanyController extends Controller
{
    public function index_create()
    {

      return view('create_company');

    }

    public function create()
    {

      $input = Input::all();

      $company = new Company;

      $company->name        =   $input["name"];
      $company->slogan      =   $input["slogan"];
      $company->logo        =   $input["logo"];
      $company->email       =   $input["email"];
      $company->telephone   =   $input["telephone"];
      $company->biography   =   $input["biography"];
      $company->address     =   $input["address"];
      $company->zipcode     =   $input["zipcode"];
      $company->location    =   $input["location"];
      $company->province    =   $input["province"];
      $company->country     =   $input["country"];

      $company->save();

      $current_company_id = DB::getPdo()->lastInsertId();
      $url = '/company/' . $current_company_id;
      return redirect(url($url));

    }

    public function index()
    {
      return view('company');
    }

}
