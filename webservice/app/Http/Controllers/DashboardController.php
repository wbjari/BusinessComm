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
        $user = User::where('id', $userid)->first();

        // Percentage gevulde tabellen berekenen
        $rowCount = 0;
        $rowFilledCount = 0;
        $user = json_decode($user, true);

        foreach ($user as $key => $value) {
            if($value !== '' || $value === null){
                $rowFilledCount++;
            }
            $rowCount++;
        }

        $profileProgress = $rowFilledCount / $rowCount * 100;


        $notifications = '';

    	$companies = Company::all(['id','name','slogan','logo']);

        return view('dashboard', [
        	'id' => $userid,
        	'user' => json_decode(json_encode($user, true)),
            'profileProgress' => (int)$profileProgress,
        	'notifications' => $notifications,
    		'companies' => $companies
        ]);
    }

}
