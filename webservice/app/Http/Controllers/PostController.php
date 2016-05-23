<?php

namespace App\Http\Controllers;

use DB;
use Response;
use App\User;
use App\Company;
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
      $original_name = $file->getClientOriginalName();

      $filename = date('d_m_Y_h_i_s') . '_' . rand(1000, 9999) . '_' . $original_name;
      $file_path = public_path() . '/storage/posts/'. $company_id;
      $database_path = url('/storage/posts/' . $company_id);

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

    return redirect(url('/company/' . $company_id));

  }

}
