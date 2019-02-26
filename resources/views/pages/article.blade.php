@extends('layout')

@section('title', $articles->category->name.' | '.$articles->title)

@section('content')
	
<div class="container">
	<div class="row">
	
	@if($articles)
		<div class="col-12 col-sm-12 col-md-10 col-lg-10">
			<div class="pt-4">

			</div>

			<article>
				<h1>{{$articles->title}}</h1>
				<i class="far fa-clock"></i> <small class="text-muted">{{date("d F Y, g:i a", strtotime($articles->created_at))}} | {{$articles->created_at->diffForHumans()}} | {{$articles->author}}  | Kategorie </small><a href="{{ route('category.index', strtolower($articles->category->name))}}"><span class="badge badge badge-info">{{$articles->category->name}}</span></a>
				<div class="pt-4"></div>
				@if($articles->cover_picture) 
					<img src="{{asset('images/'.$articles->cover_picture)}}"  class="img-fluid rounded" style="float: left; padding: 10px;">
				@endif
				<p>{!! $articles->content !!}</p>

			</article>
		</div>

		<div class="col-12 col-sm-12 col-md-3 col-lg-2">
			@if($categories)
				
				<div class="card-fluid">
					@if($categories->articles->count() > 1)
						<div class="mt-4"></div>
						<h5>Mohlo by Vás také zajímat</h5>
					@else

					@endif

				  <ul class="list-group list-group-flush">
				  		@foreach($categories->articles as $moreArticles)
				  			@if($moreArticles->id == $articles->id)
				    			
				    		@else
				    			<li class="list-group-item"><a href="{{ route('articles.show', ['kategorie'=> strtolower($moreArticles->category->name), 'clanek' => $moreArticles->slug])}}">{{$moreArticles->title}}</a></li>
				    		@endif

				    	@endforeach

				    	
					    		@if(!$articles->tags->isEmpty())
					    			<div class="mt-5">
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
				  </ul>
				</div>
			@endif

		</div>
		
		@else
			
		@endif

	</div>
</div>
@endsection