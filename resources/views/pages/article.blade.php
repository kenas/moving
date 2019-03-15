@extends('layout')

@section('title', $articles->title.' | '.$articles->category->name.' |')

@section('content')
	
<div class="container">
	<div class="row">
		@if($articles)
			<div class="col-12 col-sm-12 col-md-10 col-lg-10 pt-4">

				<article>
					<img src="{{ asset('images/spacer.jpg') }}"  class="slice ml-3 float-right" style="filter:none;" alt="">
					<h1>{{$articles->title}}</h1>
					<i class="far fa-clock"></i> <small class="text-muted">{{date("d F Y, g:i a", strtotime($articles->created_at))}} | {{$articles->created_at->diffForHumans()}}</small>
					<div class="pt-3"></div>

					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="{{ route('welcomepage') }}">Home</a></li>
					    <li class="breadcrumb-item"><a href="{{ route('category.index', strtolower($articles->category->name)) }}">Kategorie</a></li>
					    <li class="breadcrumb-item active" aria-current="page">{{ $articles->title }}</li>
					  </ol>
					</nav>

					<div class="pt-3"></div>
					@if($articles->cover_picture) 
						<img src="{{asset('images/'.$articles->cover_picture)}}"  class="mr-3 img-fluid rounded float-left">
					@endif
					<p>{!! $articles->content !!}</p>
					
					<small class="text-muted"><strong>Autor:</strong> {{$articles->author}}</small>
				</article>
			
				@include('references.references')
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-2 mt-4">

				@if(!$articles->tags->isEmpty())
	    			<div class="mt-5 mb-5">
	    				@if($articles->tags->count() > 1)
		    				<h5>Tags:</h5>
		    			@else
							<h5>Tag:</h5>
		    			@endif
						<p>
							@foreach($articles->tags as $tag)
								<a href="{{route('tag.index', strtolower($tag->name))}}" class="badge badge-secondary">{{$tag->name}}</a>
							@endforeach
						</p>
					</div>
				@endif

				@if($categories)
					<div class="card-fluid">
						@if($categories->articles->count() > 1)
							<div class="mt-4"></div>
							<h5>Mohlo by Vás také zajímat</h5>
						@endif

						<ul class="list-group list-group-flush">
							@foreach($categories->articles as $moreArticles)
								@if($moreArticles->id == $articles->id)
								
							@else
								<li class="list-group-item"><a href="{{ route('articles.show', ['kategorie'=> strtolower($moreArticles->category->name), 'clanek' => $moreArticles->slug])}}">{{$moreArticles->title}}</a></li>
							@endif

							@endforeach

						</ul>
					</div>
				@endif
			</div>
			
		@endif

	</div>
</div>
@endsection