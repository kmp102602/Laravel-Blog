@extends('main')

@section('title', ' | Edit Blog Post')

@section('stylesheet')
	
    {!! Html::style('css/select2.min.css') !!}

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=whjwdbwbwenyti5gl7d0j3jw9zn56gebb4t2ebe6g8uepkmw"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link lists code'            
        });
    </script>

@endsection

@section('content')

	<div class="row">
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
		<div class="col-md-8">

			{{ Form::label('title', "Title:")}}
			{{ Form::text('title', null, ["class" => 'form-control input-lg']) }}

			{{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
			{{ Form::text('slug', null, ['class' => 'form-control']) }}

			{{ Form::label('category_id', "Category:", ['class' => 'form-spacing-top']) }}
			{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

			{{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top'])}}
			{{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

			{{ Form::label('featured_image', 'Update Featured Image:', ['class' => 'form-spacing-top']) }}
			{{ Form::file('featured_image') }}

			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control']) }}

		</div>
		<div class="col-md-4">
			<div class="well">				
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{ date( 'M j, Y h:ia', strtotime($post->created_at)) }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Updated At:</dt>					
					<dd>{{ date( 'M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
				</dl>
			
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class'=>"btn btn-danger btn-block")) !!}
					</div>				
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class'=>"btn btn-success btn-block"]) }}	
					</div>				
				</div>
			</div>
			{!! Form::close() !!}			
		</div>  
	</div> <!--end of row (form) -->


@stop

@section('scripts')
	
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
    	$('.select2-multi').select2();
    	$('.select2-multi').select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');
    </script>

@endsection