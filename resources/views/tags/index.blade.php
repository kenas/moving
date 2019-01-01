@extends('layout')

@section('content')

<div class="container pt-4">
	
	@if($tag->name)
		<h2>Tag: {{$tag->name}}</h2>

			<div class="col-md-12 col-lg-12">

				@foreach($tag->articles as $tag)
					<h1><a href="{{route('articles.show', ['kategorie' => strtolower($tag->category->name), 'clanek' => strtolower($tag->slug)])}}">{{$tag->title}}</a></h1>
					{!!str_limit($tag->content, 300)!!}
				@endforeach
			</div>
	@endif
</div>

@endsection