@extends('layouts.admin')

@section('content')

<h1> Users </h1>

 <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
	<th>Display Picture </th>
        <th>Email</th>
	<th>Role</th>
	<th>Status</th>
	<th>Created at</th>
	<th>Updated at</th>
      </tr>
    </thead>
    <tbody>
	@foreach($users as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td><a href="{{ route('admin.users.edit', $user->id) }}">{{$user->name}}</a></td>
	<td><img height="50" src ="{{$user->photo ? $user->photo->file : '/images/male_user.jpg'}}" alt="{{ $user->name }}"/> </td>
        <td>{{$user->email}}</td>
	<td>{{$user->role->name}}</td>
	<td>{{$user->is_active ? "Active" : "Inactive" }} </td>
	<td>{{$user->created_at}}</td>
	<td>{{$user->updated_at->diffForHumans()}}</td>
      </tr>
	@endforeach
    </tbody>
  </table>

@stop
