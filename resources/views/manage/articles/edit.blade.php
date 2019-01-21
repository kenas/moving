@extends('layouts.app')

@section('content')
	<div class="container">
				

		@if($errors->any())
			@include('messages.errors')
		@endif
		
		{!! Form::open(['route' => ['update.article', $edit->id], 'method' => 'PATCH', 'files' => true]) !!}
			<div class="field">
				<div class="control">
					{{ Form::label('title', 'Title:') }}
					{{ Form::text('title', $edit->title, ['class' => 'input']) }}
				</div>
			</div>

			<div class="field">
				{{ Form::label('category_id', 'Category:')}}
					<div class="control">
						<div class="select">
							{{ Form::select('category_id', $categories, $selected) }}
						</div>
					</div>
			</div>

			<div class="field">
				<div class="control">
					<label>
						<input type="file" name="coverImage">
						{{-- {{ Form::file('coverImage', ['class' => 'file-input'])}}
							<span class="file-cta">
						      	<span class="file-icon">
						        	<i class="fas fa-upload"></i>
						      	</span>
						      	<span class="file-label">
						        	Choose a file…
						      	</span>
						    </span> --}}
					</label>
				</div>
			</div>

			<div class="field">
				{{ Form::label('publish', 'Publish:')}}
				<div class="control">
					<div class="select">
						{{ Form::select('publish', ['0' => 'No', '1' => 'Yes'], $publish) }}
					</div>
				</div>
			</div>

			<div class="field">
				<label>Tags:</label>
					<div class="control">
						<div class="select is-multiple">
							<select multiple="multiple" multiple size="4" name="tags[]" style="width:1250px;">
								@foreach($tagsInArray as $key => $tag)
									
										<option value="{{$key}}" 
											@foreach($edit->tags()->allRelatedIds() as $index => $id)
												@if($key === $id) selected="selected"
												@endif
											@endforeach
										>{{$tag}}</option>
									
								@endforeach
							</select>
						</div>
					</div>
			</div>
{{-- 					{{ Form::label('tags', 'Tags:') }}
			{{ Form::select('tags[]', $tagsInArray, null, ['class' => 'form-control', 'multiple' => 'multiple'])}} --}}
			<div class="field">
				<div class="control">
					{{ Form::label('content', 'Content:') }}
					{{ Form::textarea('content', $edit->content, ['class' => 'textarea']) }}
				</div>
			</div>

			{{ Form::hidden('author',  Auth::user()->name) }}

			<div class="field">
				<div class="control">
					{{ Form::submit('Update', ['class' => 'button is-medium is-fullwidth is-primary']) }}
				</div>
			</div>

			
		{!! Form::close() !!}

		
</div>

	 <script type="text/javascript">
        $(document).ready(function() {
            $('.tagsMultipleSelect').select2();
          	$('.tagsMultipleSelect').select2().val({{ $edit->tags()->allRelatedIds() }}).trigger('change');
            $('.tagsMultipleSelect').html("DisplayWidth: " + result["imagesizes"][0]["DisplayWidth"] 
            + ", DisplayWidth: " + result["imagesizes"][0]["DisplayWidth"]).show();
            console.log(result);
        });
    </script>

@endsection