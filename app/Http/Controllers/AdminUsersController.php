<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use App\Http\Requests\UserRequest;
use App\Http\Requests\UsersEditRequest;

use App\Http\Requests;
use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

//	$this->middleware('auth');
   }
    public function index()
    {
	$users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

	$roles = Role::lists('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        
	if(trim($request->password) == '') {
		$input = $request->except('password');
	} else {

		$input = $request->all();	
		$input['password'] = bcrypt($request->password);
	}

	
	if($file = $request->file('photo_id')) {
		$name = time().mt_rand().$file->getClientOriginalName();
		$name = str_replace(" ","",$name);
		$file->move('user_dp', $name);
		$photo = Photo::create(['file' => $name]);

		$input['photo_id'] = $photo->id;
	}

	User::create($input);
	return redirect('admin/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	$user = User::findOrFail($id);
	$roles = Role::lists('name', 'id')->all();
	
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
	$user = User::findOrFail($id);
	
	if(trim($request->password) == '') {
		$input = $request->except('password');
	} else {
		$input = $request->all();
		$input['password'] = bcrypt( $request->password);
	}
	
	if($file = $request->file('photo_id')) {
		$name = time().mt_rand().$file->getClientOriginalName();
		$name = str_replace(" ","",$name);
		
		$file->move('user_dp', $name);
		$photo = Photo::create(['file' => $name]);
		$input['photo_id'] = $photo->id;
	}
	$user->update($input);
	return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  User::findOrFail($id);
	if(file_exists(public_path().'/user_dp/'.$user->photo->file)) {
	unlink(public_path().'/user_dp/'.$user->photo->file);
	}
	$user->delete();
	Session::flash('deleted_user', 'The user has been deleted');
	return redirect('/admin/users');
    }
}
