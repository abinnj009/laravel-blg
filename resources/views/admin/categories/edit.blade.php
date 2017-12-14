@extends('layouts.admin')

@section('content')

<h1> Edit Category </h1>

<div class="col-sm-6">
{!! Form::model($category, ['method'=>'PATCH', 'action'=> ['AdminCategoryController@update', $category->id]]) !!}
<div class="form-group">
{!! Form::label('name', 'Category Name:') !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}

</div>
<div class="form-group">
{!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-6'])!!}
</div>

{!! Form::close() !!}
<div class="form-group">
{!! Form::open(['method' => 'DELETE', 'action'=> ['AdminCategoryController@destroy', $category->id]]) !!}

{!! Form::submit('Delete Category', ['class' =>'btn btn-danger col-sm-6']) !!}

{!! Form::close() !!}
</div>
</div>
@stop
