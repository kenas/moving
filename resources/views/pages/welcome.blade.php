@extends('layout')

@section('content')

	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img class="d-block w-100" src="{{asset('banners/children.jpg')}}" alt="First slide">
	        <div class="carousel-caption d-none d-md-block">
		    	<h2>Eurythmy pohyb pro zdrave telo, duse v rovnovaze, bdelost & soucit</h2>
		  	</div>
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="{{asset('banners/childrenBack.jpg')}}" alt="Second slide">
	      	<div class="carousel-caption d-none d-md-block">
		    	<h2>There are virtually no limits to what Eurythmy can do for you as an individual, a group or as a human being. Look at just a few examples of activities offered by Moving Well to meet your specific needs or conditions.</h2>
		  	</div>
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="{{asset('banners/childrenMoving.jpg')}}" alt="Third slide">
	      	<div class="carousel-caption d-none d-md-block">
	      		<h2>This art of Eurythmy is a social art in the best sense; for its aim is, above all things, to communicate to us the mysteries of human nature.</h2>
	      	</div>
	    </div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
</div>

<div class="container">
	<div class="pt-4"></div>
	<div class="row">
	
	@if($articles)

		@foreach($articles as $article)

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="pt-4"></div>
				@if($article->cover_picture)
					<img src="{{asset('images/'.$article->cover_picture)}}" class="img-fluid rounded float-left" style="padding: 10px;">
				@endif
				<h1><a href="{{ route('articles.show', ['kategorie' => strtolower($article->category->name), 'clanek' => $article->slug])}}">{{$article->title}}</a></h1>
				<i class="far fa-clock"></i> <small class="text-muted">{{date("d F Y, g:i a", strtotime($article->created_at))}} | {{$article->created_at->diffForHumans()}} | {{$article->author}} | Kategorie </small> <a href="{{ route('category.index', strtolower($article->category->name))}}"><span class="badge badge badge-info">{{$article->category->name}}</span></a>
				<p>{!!str_limit($article->content, 300)!!}</p>

				
				@if(!$article->tags->isEmpty())
					<p class="float-right">
						<span class="text-muted">Tags:</span>
						@foreach($article->tags as $tag)
							<a href="{{route('tag.index', strtolower($tag->name))}}" class="badge badge-secondary">{{$tag->name}}</a>
						@endforeach
					</p>
				@endif
			</div>
		@endforeach

			@else
				<p>Omlouváme se za potíže, články momentáně nejsou k dispozici.</p>
			@endif

	</div>
</div>
			
@endsection