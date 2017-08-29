@extends('main')

@section('title', "| $category->name Category")

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $category->name }}</h1>
		</div>
		<div class="col-md-2 col-md-offset-2">
			<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-block btn-h1-spacing">Edit</a>
		</div>
		
	</div>

@endsection()