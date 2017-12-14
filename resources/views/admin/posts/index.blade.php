@extends('layouts.admin')

@section('content')
	<h1>All Posts </h1>

<table class="table">

<thead>
<tr>
<th>ID</th>
<th>Author</th>
<th>Category</th>
<th>Photo</th>
<th>Title</th>
<th>Body</th>
<th>Created At</th>
<th>Updated </th>
</tr>
<thead>
@if($posts)
@foreach($posts as $post)

<tr>
<td>{{ $post->id }}</td>
<td> {{$post->user->name}}</td>
<td> {{$post->category_id ? $post->category->name : 'Uncategorized'}}</td>
<td><img height=100 src="{{ $post->photo ? '/post_images/'.$post->photo->file : '/images/no_image.jpg' }}"/></td>
<td> {{$post->title }}</td>
<td> {{$post->body }} </td>
<td> {{$post->created_at }}</td>
<td> {{$post->updated_at->diffForHumans() }} </td>
</tr>
@endforeach

@endif
</table>
@stop
