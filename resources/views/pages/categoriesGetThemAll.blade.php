@extends('layout')

@section('title')

	@section('content')
		
	<div class="container">
		<div class="row">

			<ul class="list-group">
			{{-- Show number of each category how many articles are the in category a bit of text of each--}}
			@if($getAllCategories)
				@foreach($getAllCategories as $category)

					  <li class="list-group-item d-flex justify-content-between align-items-center">
					    	<a href="{{route('category.index', strtolower($category->name))}}" title="{{$category->name}}">{{$category->name}}</a>
					    <span class="badge badge-primary badge-pill">{{$category->articles->count()}}</span>
					  </li>

				@endforeach

			</ul>
			@endif
		</div>
	</div>
@endsection