@extends('main')

@section('title', '| Delete Comment?')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>DELETE THIS COMMENT?</h1>
			<p>
				<strong>Name:</strong> {{ $comment->name }}<br>
				<strong>Email:</strong> {{ $comment->email }}<br>
				<strong>Comment:</strong> {{ $comment->comment }}
			</p>

			{{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}

				{{ Form::submit('Delete', ['class' => 'btn btn-lg btn-block btn-danger ']) }}

			{{ Form::close() }}
		</div>
	</div>


@endsection