<?php

namespace App\Http\Controllers;

use DB;
use Response;

use App\User;
use App\Reports;

use App\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{

	//!!!!!!!! Gebruiker rapporteren
	// $report = \Auth::user()->reports()->create([
	// 	'user_id' => 1,
	// 	'reason' => 'He did something I didn\'t like!!!'
	// ]);

	public function index()
	{

		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {

			$reports = Reports::where('id', '!=', 0)->with('reporter', 'reported')->orderBy('created_at', 'asc')->take(30)->get();

			return view('admin', [
				'reports' => $reports
			]);
		} else {
			abort(404);
		}
	}

	public function confirm_report()
	{
		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			echo 'yse';
		} else {
			abort(404);
		}
	}

	public function delete_report()
	{
		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			echo 'yse';
		} else {
			abort(404);
		}
	}

}