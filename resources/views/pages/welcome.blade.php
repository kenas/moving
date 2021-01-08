@extends('layout')

@section('content')

<div class="container">
	<div class="pt-4"></div>
	<div class="row">

		@if($articles)

		<div class="col-sm-8 col-md-8 col-lg-8">
			@foreach($articles->take(3) as $article)

			<div class="pt-4"></div>
			<h1><a
					href="{{ route('articles.show', ['kategorie' => strtolower($article->category->slug), 'clanek' => $article->slug])}}">{{$article->title}}</a>
			</h1>

			{{$article->author}}
			<i class="far fa-clock"></i> <small class="text-muted">{{$article->created_at->diffForHumans()}} </small>

			<div class="pt-4"></div>

			@if($article->images)
			@foreach($article->images->take(1) as $img)
			<img src="{{ asset('images/'. $img->path)}}" class="mr-3 img-fluid rounded float-left mb-3"
				alt="{{$img->title}}">
			@endforeach
			@endif

			<p>{!!str_limit($article->content, 300)!!}</p>

			<a
				href="{{ route('articles.show', ['kategorie' => strtolower($article->category->slug), 'clanek' => $article->slug])}}">Číst
				celý článek</a>
			<div class="pt-5 pb-5"></div>

			@endforeach
		</div>
		<div class="clearfix"></div>
		<div class="col-md-3 col-lg-3">
			<h5>Popularni clnaky</h>
		</div>

		@else
		<p>Omlouváme se za potíže, články momentáně nejsou k dispozici.</p>
		@endif

	</div>
</div>

@endsection