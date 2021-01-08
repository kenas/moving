@extends('layouts.app')

{{-- @section('head')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
@endsection --}}

@section('content')
<div class="container">

	@if($errors->any())
	@include('messages.errors')
	@endif

	{!! Form::open(['route' => 'articles.store', 'files' => true]) !!}

	<div class="field">
		<div class="control">
			{!! Form::label('title', 'Title:')!!}
			{{ Form::text('title', null, ['class' => 'input']) }}
		</div>
	</div>

	<div class="field">
		{{ Form::label('category_id', 'Category:')}}
		<div class="control">
			<div class="select">
				{{ Form::select('category_id', $categories, null, ['placeholder' => 'Please select ...']) }}
			</div>
		</div>
	</div>

	<div class="field">
		<div class="control">
			<label>
				<input type="file" name="cover_picture" multiple>
			</label>
		</div>
		<div class="control">
			{{ Form::label('cover_picture', 'Description for cover picture:') }}
			{{ Form::text('des_cover_picture', null, ['class' => 'input']) }}
		</div>
	</div>

	<div class="filed">
		{{ Form::label('publish', 'Publish:')}}
		<div class="control">
			<div class="select">
				{{ Form::select('publish', ['0' => 'No', '1' => 'Yes'], null, ['placeholder' => 'Please select ...']) }}
			</div>
		</div>
	</div>

	<div class="field">
		{{ Form::label('tags', 'Tags:') }}
		<div class="control">
			<div class="select is-multiple">
				{{-- {{ Form::select('tags[]', $tags, null, ['multiple' => 'multiple', 'class' => 'form-control tagsMultipleSelect'])}}
				--}}
				<select multiple="multiple" multiple size="4" name="tags[]" style="width:1250px;">
					@foreach($tags as $tag)
					<option value="{{$tag->id}}">{{$tag->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="field">
		<div class="control">
			{{ Form::label('content', 'Content:') }}
			{{--   <div id="summernote"> --}}
			{{ Form::textarea('content', null, ['class' => 'textarea']) }}
			{{-- </div> --}}
		</div>
	</div>

	{{ Form::hidden('author',  Auth::user()->name) }}

	<div class="field">
		<div class="control">
			{{ Form::submit('Save it', ['class' => 'button is-medium is-fullwidth is-primary']) }}
		</div>
	</div>

	{!! Form::close() !!}
</div>
@endsection