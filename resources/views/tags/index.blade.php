@extends('layout')

@section('title', 'Tag | ' .$getNameOfTag. ' |')
@section('content')

<div class="container pt-4">
	<div class="row">

			<div class="col-sm-9 col-md-9 col-lg-9">
				@foreach($getArticleByTag->articles as $article)
					@if($article->cover_picture)
						<img src="{{ asset('images/'.$article->cover_picture) }}" alt="" class="img-fluid rounded float-left" style="padding: 10px;">
					@endif
					<h1><a href="{{ route('articles.show', ['kategorie' => strtolower($article->category->name), 'clanek' => $article->slug]) }}">{{ $article->title }}</a></h1>
					<i class="far fa-clock"></i> <small class="text-muted">{{date("d F Y, g:i a", strtotime($article->created_at))}} | {{$article->created_at->diffForHumans()}} | autor: {{$article->author}} | kategorie <a href="{{ route('category.index', strtolower($article->category->name)) }}"><span class="badge badge-info">{{ $article->category->name }}</span></a></small>
					<p>{!!str_limit($article->content, 300)!!}</p>

				@endforeach
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3">
				@if($allTags)
					<h5>Všechny tagy:</h5>
						
						@foreach($allTags as $tagname)
							@if($tagname->articles->count())
								<a href="{{ route('tag.index', strtolower($tagname->name)) }}" class="badge badge-secondary">{{ $tagname->name }}</a>
							@endif
						@endforeach
				@endif
			</div>

	</div>
</div>

@endsection