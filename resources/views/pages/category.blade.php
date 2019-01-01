@extends('layout')

@section('head')
	<link rel="next" href="{{$articles->nextPageUrl()}}">
@endsection
@section('title', 'Kategorie '. $title. ' | ')

@section('content')
	
	<div class="container pt-4">
		<div class="row">

			<div class="col-md-10 col-lg-10">
			@if($articles)
				<div class="row">
					@foreach($articles as $article)
					
						<div class="col-md-10 col-lg-10">
							@if($article->cover_picture)
								<img src="{{asset('images/'.$article->cover_picture)}}" class="img-fluid rounded float-left" style="padding: 10px;">
							@endif
							<h1><a href="{{ route('articles.show', ['kategorie' => strtolower($article->category->name), 'clanek' => $article->slug])}}">{{$article->title}}</a></h1>
							<a href="{{route('category.index', strtolower($article->category->name)) }}">{{-- <span class="badge badge badge-info">{{$article->category->name}}</span> --}}</a>
							<i class="far fa-clock"></i> <small class="text-muted">{{date("d F Y, g:i a", strtotime($article->created_at))}} | {{$article->created_at->diffForHumans()}} | {{$article->author}}</small>
							<p>{!!str_limit($article->content, 300)!!}</p>

								@if(!$article->tags->isEmpty())
									<p>
										<span class="text-muted">Tags:</span>
										@foreach($article->tags as $tag)
											<a href="{{route('tag.index', strtolower($tag->name))}}" class="badge badge-secondary">{{$tag->name}}</a>
										@endforeach
									</p>
								@endif
							<hr>
						</div>
				@endforeach
				</div>
			@else
				<p>Omlouváme se za potíže, články momentáně nejsou k dispozici.</p>
			@endif
		</div>

			<div class="col-md-2 col-lg-2">
				@if($categories)

					<div class="card-fluid">
						<h5>Kategorie:</h5>
						
				 		 <ul class="list-group list-group-flush">
					  		@foreach($categories as $category)

					  			@if($category->articles->count())
					    			<li class="list-group-item @if(Request::fullUrl() === route('category.index', strtolower($category->name))) active @endif"><a href="{{ route('category.index', strtolower($category->name))}}">
					    			{{$category->name}}</a> <span class="badge badge-light">{{$category->articles->count()}}</span></li>
					    		@else
					    			
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