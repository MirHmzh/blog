<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Posts;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_posts($id)
    {
    	$posts = Posts::where('author_id', $id)->orderBy('created_at','desc')->paginate(5);

    	$title = User::find($id)->name;
    	return view('home')->withPosts($posts)->withTitle($title);
    }

    public function profil(Request $request, $id)
	{
		$data['user'] = User::find($id);
		if (!$data['user'])
			return redirect('/');

		if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
			$data['author'] = true;
		} else {
			$data['author'] = null;
		}
		$data['posts_count'] = $data['user'] -> posts -> count();
		$data['latest_posts'] = $data['user'] -> posts -> take(5);
		return view('admin.profil', $data);
	}
}
