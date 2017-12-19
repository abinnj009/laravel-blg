@extends('layouts.admin')

@section('content')

<h1> Media </h1>

<table class="table">
<tr>
<th>ID</th>
<th>Image</th>
<th>Owned By </th>
<th> Created At </th>
<th> Actions </th>
</tr>
<tbody>
@if($user_photos)
@foreach($user_photos as $photo)
<?php 
if(!$photo->file) continue;
?>
<tr>
<td>{{ $photo->id }}</td>
<td><img height="100" src="/user_dp/{{ $photo->file ? $photo->file : 'No image' }}"/></td>
<td> {{ "User" }}</td>
<td>{{ $photo->created_at ? $photo->created_at : 'No date'  }}</td>
<td>
<div class="form-group">
{!! Form::open(['method'=> 'DELETE', 'action'=>['AdminMediasController@destroy',$photo->id]]) !!}

{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}
</div>
</td>
</tr>

@endforeach
@endif
@if($post_photos)
@foreach($post_photos as $photo)
<tr>
<td>{{ $photo->id }}</td>
<td> <img height = "100" src="/post_images/{{ $photo->file ? $photo->file : 'No image' }}"/></td>
<td>{{ "Post" }}</td>
<td>{{ $photo->created_at ? $photo->created_at : 'No date'  }}</td>
<td>
<div class="form-group">
{!! Form::open(['method'=> 'DELETE', 'action'=>['AdminMediasController@destroy',$photo->id]]) !!}

{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}
</div>
</td>

</tr>

@endforeach
@endif

@if($other_photos)
@foreach($other_photos as $photo)
<tr>
<td>{{ $photo->id }}</td>
<td> <img height = "100" src="/post_images/{{ $photo->file ? $photo->file : 'No image' }}"/></td>
<td>{{ "Media" }}</td>
<td>{{ $photo->created_at ? $photo->created_at : 'No date'  }}</td>
<td>
<div class="form-group">
{!! Form::open(['method'=> 'DELETE', 'action'=>['AdminMediasController@destroy',$photo->id]]) !!}

{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}
</div>
</td>

</tr>

@endforeach
@endif

</tbody>

</table>

@stop	
