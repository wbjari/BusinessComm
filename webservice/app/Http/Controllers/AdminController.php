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

		// Check if user is admin
		$role = User::where('id', \Auth::id())->pluck('role')[0];
		if($role == 1) {

			// Get list of all admins
			$admins = User::where('role', 1)->get();

			// Get all reports from users
			$userReports = UserReports::where('id', '!=', 0)->with('reporter', 'reported')->orderBy('created_at', 'asc')->take(15)->get();

			// Get all blocked users
			$blockedUsers = User::where('status', 0)->get();

			// Get all reporst from companies
			$companyReports = CompanyReports::where('id', '!=', 0)->with('reporter', 'reported')->orderBy('created_at', 'asc')->take(15)->get();

			// Get all blocked companies
			$blockedCompanies = Company::where('status', 0)->get();

			return view('admin', [
				'admins' => $admins,
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
		// Check if user is admin
		$role = User::where('id', \Auth::id())->pluck('role')[0];
		if($role == 1) {

			// Get company report
			$banningCompany = CompanyReports::where('id', $report_id)->with('reporter', 'reported')->first();

			// Delete all reports from the company getting blocked
			if(Company::where('id', $banningCompany->reported->id)->where('status', 1)->exists()){
				Company::where('id', $banningCompany->reported->id)->update(['status' => 0]);
				CompanyReports::where('company_id', $banningCompany->reported->id)->delete();
				return redirect('admin')->with('notification', 'Het bedrijf is succesvol geblokkeerd.');
			}
		}
		return redirect('admin')->with('notification', 'Er is iets fout gegaan bij het blokkeren van het bedrijf.');
	}

	public function company_delete_report($report_id)
	{
		// Check if user is admin
		$role = User::where('id', \Auth::id())->pluck('role')[0];
		if($role == 1) {

			// delete rapport
			if(CompanyReports::where('id', $report_id)->exists()){
				CompanyReports::where('id', $report_id)->delete();
				return redirect('admin')->with('notification', 'Het rapport is succesvol verwijderd.');
			}
		}
		return redirect('admin')->with('notification', 'Er is iets fout gegaan bij het verwijderen van het rapport.');
	}

	public function company_activate($company_id)
	{
		// Check if user is admin
		$role = User::where('id', \Auth::id())->pluck('role')[0];
		if($role == 1) {

			// Active company
			if(Company::where('id', $company_id)->where('status', 0)->exists()){
				Company::where('id', $company_id)->update(['status' => 1]);
				return redirect('admin')->with('notification', 'Het bedrijf is succesvol geactiveerd.');
			}
		}
		return redirect('admin')->with('notification', 'Er is iets fout gegaan bij het activeren van het bedrijf.');

	}


	public function user_confirm_report($report_id)
	{
		// Check if user is admin
		$role = User::where('id', \Auth::id())->pluck('role')[0];
		if($role == 1) {

			// get user report
			$banningUser = UserReports::where('id', $report_id)->with('reporter', 'reported')->first();

			// Delete all reports from the user getting blocked
			if(User::where('id', $banningUser->reported->id)->update(['status' => 0]) && UserReports::where('user_id', $banningUser->reported->id)->delete()){
				return redirect('admin')->with('notification', 'Gebruiker is succesvol geblokkeerd.');
			}
		}
		return redirect('admin')->with('notification', 'Er is iets fout gegaan bij het blokkeren van de gebruiker.');
	}

	public function user_delete_report($report_id)
	{
		// Check if user is admin
		$role = User::where('id', \Auth::id())->pluck('role')[0];
		if($role == 1) {

			// Delete user report
			if(UserReports::where('id', $report_id)->exists()){
				UserReports::where('id', $report_id)->delete();
				return redirect('admin')->with('notification', 'Het rapport is succesvol verwijderd.');
			}
		}
		return redirect('admin')->with('notification', 'Er is iets fout gegaan bij het verwijderen van het rapport.');
	}

	public function user_activate($user_id)
	{
		// Check if user is admin
		$role = User::where('id', \Auth::id())->pluck('role')[0];
		if($role == 1) {

			// Activate user
			if(User::where('id', $user_id)->where('status', 0)->exists()){
				User::where('id', $user_id)->update(['status' => 1]);
				return redirect('admin')->with('notification', 'De gebruiker is succesvol geactiveerd.');
			}
		}
		return redirect('admin')->with('notification', 'Er is iets fout gegaan bij het activeren van de gebruiker.');
	}


	public function remove_administrator($user_id)
	{
		// Check if user is admin
		$role = User::where('id', \Auth::id())->pluck('role')[0];
		if($role == 1) {

			// get amount of admins (max. 2)
			$adminCount = User::where('role', 1)->take(2)->get(['id']);

			// If there is more than 1 admin
			if(count($adminCount) > 1){
				// Make administrator normal user
				if(!User::where('id', $user_id)->update(['role' => 0])){
					die('Er is een fout opgetreden bij het actief zetten van de gebruiker.');
				}

				return redirect('admin')->with('notification', 'De administrator is successvol verwijderd.');
			} else {
				return redirect('admin')->with('notification', 'Je moet minimaal 1 administrator hebben.');
			}
		} else if (\Auth::User()->id == $user_id) {
			return redirect('admin')->with('notification', 'Je kan jezelf niet verwijderen als administrator.');
		}
		return redirect('admin')->with('notification', 'Er is iets fout gegaan bij het verwijderen van de administrator.');
	}

	public function check_add_admin()
    {

      	// Check if user is admin
		$role = User::where('id', \Auth::id())->pluck('role')[0];
		if($role == 1) {

        $email = Input::get('user_email');

        // Get user
        $user = User::where('email', $email)->first(['email', 'role']);

        // If user is not an administrator
        if($user->role === 0){
        	// Make user administrator
          	$user = User::where('email', $email)->update(['role' => 1]);

          	return redirect('admin')->with('notification', 'De gebruiker is nu een administrator.');
        } else if ($user->role === 1) {
          	return redirect('admin')->with('notification', 'De gebruiker is al een administrator.');
        } else {
        	return redirect('admin')->with('notification', 'De gebruiker is niet gevonden.');
        }
      }
		return redirect('admin')->with('notification', 'Er is iets fout gegaan bij het controleren.');
    }
}
