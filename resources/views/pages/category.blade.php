@extends('layout')

@section('head')
	@if($articles->onFirstPage())
		<link rel="next" href="{{$articles->nextPageUrl()}}">
	@elseif($articles->previousPageUrl() && $articles->nextPageUrl() )
		<link rel="prev" href="{{ $articles->previousPageUrl() }}">
		<link rel="next" href="{{$articles->nextPageUrl()}}">
	@elseif($articles->nextPageUrl() == null )
		<link rel="prev" href="{{ $articles->previousPageUrl() }}">
	@endif
@endsection


@section('content')
	<div class="container pt-4">
		<div class="row">
			<div class="col-sm-8 col-md-8 col-lg-8">
				@if($articles)
					@foreach($articles as $article)
						<article class="mb-5">
							<h1><a href="{{ route('articles.show', ['kategorie' => strtolower($article->category->slug), 'clanek' => $article->slug])}}">{{$article->title}}</a></h1>

							@if($article->images)
								@foreach($article->images->slice(1) as $img)
							
									<img src="{{asset('images/'.$img->path)}}" class="mr-3 img-fluid rounded float-left" alt="{{$img->title}}">
									
								@endforeach
							@endif
							<div class="clearfix"></div>
					<!-- 		<a href="{{route('category.index', strtolower($article->category->slug)) }}"><span class="badge badge badge-info">{{$article->category->name}}</span></a> -->
							<!-- <i class="far fa-clock"></i> <small class="text-muted">{{date("d F Y, g:i a", strtotime($article->created_at))}} | {{$article->created_at->diffForHumans()}} | autor: {{$article->author}}</small> -->
							<p class="mt-4">{!!str_limit($article->content, 300)!!}</p>
<!-- 
							@if(!$article->tags->isEmpty())
									@if($article->tags->count() > 1)
										<span class="text-muted">Tags:</span>
									@else
										<span class="text-muted">Tag:</span>
									@endif
									@foreach($article->tags as $tag)
										<a href="{{route('tag.index', strtolower($tag->name))}}" class="badge badge-secondary">{{$tag->name}}</a>
									@endforeach
							@endif -->
						
						</article>

				@endforeach


			@else
				<p>Omlouváme se za potíže, články momentáně nejsou k dispozici.</p>
			@endif
		</div>
		
		<div class="col-md-3 col-lg-3">
			@if($categories)
			<div class="card-fluid">
				<h5>Všechny kategorie:</h5>
				<ul class="list-group list-group-flush">
					@foreach($categories as $category)

					@if($category->articles->count())
					<li class="list-group-item @if(Request::fullUrl() === route('category.index', strtolower($category->name))) active @endif"><a href="{{ route('category.index', strtolower($category->slug))}}">
						{{$category->name}}</a> <span class="badge badge-light">{{$category->articles->count()}}</span></li>	
						@endif

						@endforeach
					</ul>
				</div>	
				@endif
			</div>



			<div class="mx-auto mt-4">
				{{$articles->links()}}
			</div>

		</div>			
	</div>
@endsection