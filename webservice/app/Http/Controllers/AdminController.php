<?php

namespace App\Http\Controllers;

use DB;
use Response;

use App\User;
use App\Company;
use App\UserReports;
use App\CompanyReports;

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

			$userReports = UserReports::where('id', '!=', 0)->with('reporter', 'reported')->orderBy('created_at', 'asc')->take(15)->get();
			$blockedUsers = User::where('status', 0)->get();
			$companyReports = CompanyReports::where('id', '!=', 0)->with('reporter', 'reported')->orderBy('created_at', 'asc')->take(15)->get();
			$blockedCompanies = Company::where('status', 0)->get();

			return view('admin', [
				'userReports' => $userReports,
				'blockedUsers' => $blockedUsers,
				'companyReports' => $companyReports,
				'blockedCompanies' => $blockedCompanies
			]);
		} else {
			abort(404);
		}
	}

	public function company_confirm_report($report_id)
	{
		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			$banningCompany = CompanyReports::where('id', $report_id)->with('reporter', 'reported')->first();

			if(!Company::where('id', $banningCompany->reported->id)->update(['status' => 0])){
				die('Er is een fout opgetreden bij het bevestigen van de melding.');
			}

			CompanyReports::where('company_id', $banningCompany->reported->id)->delete();

			return redirect('admin');
		} else {
			abort(404);
		}
	}

	public function company_delete_report($report_id)
	{
		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			if(!CompanyReports::where('id', $report_id)->delete()){
				die('Er is een fout opgetreden bij het verwijderen van de melding.');
			}

			return redirect('admin');
		} else {
			abort(404);
		}
	}

	public function company_activate($company_id)
	{
		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			if(!Company::where('id', $company_id)->update(['status' => 1])){
				die('Er is een fout opgetreden bij het actief zetten van het bedrijf.');
			}

			return redirect('admin');
		} else {
			abort(404);
		}
	}


	public function user_confirm_report($report_id)
	{
		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			$banningUser = UserReports::where('id', $report_id)->with('reporter', 'reported')->first();

			if(User::where('id', $banningUser->reported->id)->update(['status' => 0]) && UserReports::where('user_id', $banningUser->reported->id)->delete()){
				return redirect('admin');
			}else{
				die('Er is een fout opgetreden bij het bevestigen van de melding.');
			}
		} else {
			abort(404);
		}
	}

	public function user_delete_report($report_id)
	{
		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			if(!UserReports::where('id', $report_id)->delete()){
				die('Er is een fout opgetreden bij het verwijderen van de melding.');
			}

			return redirect('admin');
		} else {
			abort(404);
		}
	}

	public function user_activate($user_id)
	{
		$role = User::where('id', \Auth::id())->pluck('role')[0];

		if($role == 1) {
			if(!User::where('id', $user_id)->update(['status' => 1])){
				die('Er is een fout opgetreden bij het actief zetten van de gebruiker.');
			}

			return redirect('admin');
		} else {
			abort(404);
		}
	}

}