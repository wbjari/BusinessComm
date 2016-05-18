<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use App\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    public function __construct()
    {
       
    }

    public function index()
    {
    	// $userid = Auth::User()->id;
    	

    	// return Company::where('name', 'Facebook')->first();

    	// $users = DB::table('companies')->get();

        // return $users;

    	$companies = Company::all(['name','slogan','logo']);

    	$data = [
    		'companies' => $companies
        ];

        return view('dashboard')->with($data);
    }

}