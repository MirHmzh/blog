<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Posts;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;

use Illuminate\Http\Request;
class PostController extends Controller
{
    public function index()
    {
    	$posts = Posts::orderBy('created_at','desc')->paginate(5);
    	$title = 'Artikel Terakhir';
    	return view('home')->withPosts($posts)->withTitle($title);
    }

    public function buat(Request $request)
    {
    	if ($request->user()->can_post()) {
    		return view('post.create');
    	}else{
    		return redirect('/')->withErrors('Anda tidak memiliki ijin untuk menulis artikel');
    	}
    }

    public function tambah(PostFormRequest $request)
    {
    	$post = new Posts();
    	$post->title = $request->get('title');
    	$post->body = $request->get('body');
    	$post->slug = $post->title;
    	$post->author_id = $request->user()->id;
    	$message = 'Artikel sukses diterbitkan';
    	$post->save();
    	return redirect('edit/'.$post->slug)->withMessage($message);
    }

    public function tampil($slug)
    {
    	$post = Posts::where('slug', $slug)->first();
    	if (!$post) {
    		return redirect('/')->withErrors('Halaman yang Anda minta tidak ditemukan');
    	}
    	return view('post.show')->withPost($post);
    }

    public function edit(Request $request, $slug)
    {
    	$post = Posts::where('slug', $slug)->first();
    	if ($post && ($request->user()->id == $post->author_id|| $request->user()->is_admin())) {
    		return view('post.edit')->with('post', $post);
    		return redirect('/')->withErrors('Anda tidak memiliki ijin akses');
    	}
    }

    public function perbarui(Request $request)
    {
    	$post_id = $request->input('post_id');
    	$post = Posts::find($post_id);
    	if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
    		$title = $request->input('title');
    		$slug = str_slug($title);
    		$duplicate = Posts::where('slug', $slug)->first();
    		if ($duplicate) {
    			if ($duplicate->id != $post_id) {
    				return redirect('edit/'.$post->slug)->withErrors('Judul sudah ada')->withInput();
    			}else{
    				$post->slug = $slug;
    			}
    		}
    		$post->title = $title;
    		$post->body = $request->input('body');
				$message = 'Artikel diperbarui';
				$landing = $post->slug;
    		$post->save();
    		return redirect($landing)->withMessage($message);
		}else{
			return redirect('/')->withErrors('Anda tidak mempunyai ijin');
    	}
    }

    public function hapus(Request $request, $id)
    {
    	$post = Posts::find($id);
    	if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
    		$post->delete();
    		$data['message'] = 'Artikel dihapus';
    	}else{
    		$data['errors'] = 'Anda tidak mempunyai ijin';
    	}
    	return redirect('/')->with($data);
    }
}
