@extends('main')

@section('title', "| Edit Category")

@section('content')
	{{ Form::model($category, ['route' => ['categories.update', $category->id], 'method' => "PUT"]) }} <!--use model for model binding -->

		{{ Form::label('name', "Category:") }}
		{{ Form::text('name', null, ['class' => 'form-control']) }}

		{{ Form::submit('Save Changes', ['class' => 'btn btn-success form-spacing-top']) }}

	{{ Form::close() }}


@endsection