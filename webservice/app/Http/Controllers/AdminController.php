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

class AdminController extends Controller
{

    public function index()
    {

      $role = User::where('id', \Auth::id())->pluck('role')[0];

      if($role == 1) {

      } else {

        abort(404);

      }

      return view('admin');
      
    }

}
