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
    	$userid = \Auth::User()->id;
        $user = User::where('id', $userid)->first(['firstname','lastname','profilepicture']);

        $notifications = '';

    	$companies = Company::all(['name','slogan','logo']);

        return view('dashboard', [
        	'user' => $user,
        	'notifications' => $notifications,
    		'companies' => $companies
        ]);
    }

}