<?php

namespace App\Http\Controllers;

use DB;
use Response;
use App\User;
use App\Company;
use App\CompanyUser;
use App\Post;
use App\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{

  public function create()
  {

    $input = Input::all();
    $user_id = \Auth::id();
    $company_id = $input['company_id'];

    if (Input::hasFile('file')) {

      $file = Input::file('file');
      $original_name = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());

      $filename = date('d_m_Y_h_i_s') . '_' . rand(1000, 9999) . '_' . $original_name;
      $file_path = public_path() . '/storage/posts/'. $company_id;
      $database_path = '/storage/posts/' . $company_id;

      $file->move($file_path, $filename);

    }

    $post = new Post;

    $post->title        =   $input["title"];
    $post->content      =   $input["message"];
    $post->user_id      =   $user_id;
    $post->company_id   =   $company_id;

    if (Input::hasFile('file')) {
      $post->image        =   $database_path.'/'.$filename;
    }

    $post->save();

    return redirect('company/'.$company_id)->with('notification', 'Bericht is succesvol aan de tijdlijn toegevoegd.');

  }

  public function remove()
  {

    $role = CompanyUser::where('user_id', \Auth::id())->pluck('role')[0];

    $post_id = Input::get('data');
    $query = Post::where('id', $post_id);

    if ($role == 2 || $role == 3 || $query->where('user_id', \Auth::id())->exists()) {

      $image_url = $query->first(['image'])['image'];

      $query->delete();

      if ($image_url) {
        $image_path = public_path() . '' . parse_url($image_url)['path'];
        if (file_exists($image_path)) {
          unlink($image_path);
        }
      }

      return Response::json('Het bericht is succesvol verwijderd.');

    }
    return Response::json('Er is iets fout gegaan bij het verwijderen van het bericht.');
  }

  public function edit()
  {

    $role = CompanyUser::where('user_id', \Auth::id())->pluck('role')[0];

    $data = Input::get();
    $post_id = $data['post_id'];
    $company_id = $data['company'];
    $user_id = \Auth::id();
    $query = Post::where('id', $post_id)->where('company_id', $company_id);

    if ($role == 2 || $role == 3 || $query->where('user_id', \Auth::id())->exists()) {

        $query->update([
          'title' => $data['title'],
          'content' => $data['message'],
          'edited_by' => $user_id
        ]);

        return redirect('company/'.$company_id)->with('notification', 'Het bericht is succesvol bewerkt.');
      }

      return redirect('company/'.$company_id)->with('notification', 'Er is iets fout gegaan bij het bewerken van het bericht.');

  }

}
