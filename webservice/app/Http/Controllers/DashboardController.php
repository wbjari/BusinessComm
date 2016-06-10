<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use App\CompanyUser;
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

        $myCompanies = CompanyUser::where('user_id', $userid)->join('companies', 'company_users.company_id', '=', 'companies.id')->get(['company_id', 'name', 'slogan', 'logo']);
    	  $companies = Company::all(['id','name','slogan','logo']);

        $notifications = '';


        // Companies close to you
        $user_location = User::where('id', $userid)->pluck('location')[0];
        if ($user_location) {
          $user_haslocation = true;
        } else {
          $user_haslocation = false;
        }

        $query = Company::where('location', $user_location);

        if ($query->exists()) {
          $nearby_companies = $query->get();
          $is_nearby = true;
        } else {
          $nearby_companies = Company::orderByRaw('RAND()')->take(5)->get();
          $is_nearby = false;
        }

        $nearby = ['user_haslocation' => $user_haslocation, 'nearby' => $is_nearby, 'companies' => $nearby_companies];

        return view('dashboard', [
        	'id' => $userid,
        	'user' => json_decode(json_encode($user, true)),
          'myCompanies' => $myCompanies,
          'profileProgress' => (int)$profileProgress,
        	'notifications' => $notifications,
    		  'companies' => $companies,
          'nearby' => $nearby
        ]);
    }

    public function search_company()
    {

        $name = Input::get('name');

        $query = Company::where('name', 'LIKE', '%'.$name.'%')->take(5)->get(['id', 'name']);

        return $query;

    }

}
