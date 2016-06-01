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

			$blocked_users = User::where('status', 0)->get();

			return view('admin', [
				'reports' => $reports,
				'blocked_users' => $blocked_users
			]);
		} else {
			abort(404);
		}
	}

	public function confirm_report($report_id)
	{

		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			$banningUser = Reports::where('id', $report_id)->with('reporter', 'reported')->first();

			if(User::where('id', $banningUser->reporter->id)->update(['status' => 0]) && Reports::where('user_id', $banningUser->reported->id)->delete()){
				return redirect('admin');
			}else{
				die('Er is een fout opgetreden bij het bevestigen van de melding.');
			}
		} else {
			abort(404);
		}
	}

	public function delete_report($report_id)
	{

		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			if(Reports::where('id', $report_id)->delete()){
				return redirect('admin');
			}else{
				die('Er is een fout opgetreden bij het verwijderen van de melding.');
			}
		} else {
			abort(404);
		}
	}

	public function set_active($user_id)
	{

		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			if(User::where('id', $user_id)->update(['status' => 1])){
				return redirect('admin');
			}else{
				die('Er is een fout opgetreden bij het actief zetten van de gebruiker.');
			}
		} else {
			abort(404);
		}
	}

}