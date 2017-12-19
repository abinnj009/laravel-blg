<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Photo;
use App\Http\Requests;

use App\User;
use App\Post;

class AdminMediasController extends Controller
{
	public function index() {
		$user_photos = DB::table('users')
		->leftJoin('photos', 'photos.id', '=', 'users.photo_id' )
		->get();
		$post_photos = DB::table('posts')
		->leftJoin('photos', 'photos.id', '=', 'posts.photo_id')
		->get();
		$u_photos = User::pluck('photo_id')->all();
		$p_photos = Post::pluck('photo_id')->all();
		$other_photos = Photo::whereNotIn('id', $u_photos)
		->whereNotIn('id', $p_photos)->get();
		return view('admin.media.index',
			compact('user_photos','post_photos','other_photos')
		);
	}
	public function create() {
		return view('admin.media.create');
	}
	
	public function store(Request $request) {
		$file = $request->file('file');

		$name = time().mt_rand().$file->getClientOriginalName();
		$name = str_replace(" ","",$name);
		$file->move('post_images', $name);
		Photo::create(['file' => $name]);
	}

	public function destroy($id) {
		$photo = Photo::findOrFail($id);
		$path = public_path().'/post_images/'.$photo->file;
		if (file_exists($path))	{
			unlink($path);
			$photo->delete();
		} else {
			$path = public_path().'/user_dp/'.$photo->file;
			if(file_exists($path)) {
				unlink($path);
				$photo->delete();
			} else {
				die("Error in deleting file");
			}
		}
		return redirect('admin/media');
	}
}
