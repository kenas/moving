@extends('layout')

@section('title', 'Tag | ' .$getNameOfTag. ' |')
@section('content')

<div class="container pt-4">
	<div class="row">
{{-- {{ $getArticleByTag->articles }} --}}
{{-- 	@foreach($getTag as $article)
		{{ $article->title }}
	@endforeach --}}

			<div class="col-sm-9 col-md-9 col-lg-9">
				@foreach($getArticleByTag->articles as $article)
					<h1><a href="{{ route('articles.show', ['kategorie' => strtolower($article->category->name), 'clanek' => $article->slug]) }}">{{ $article->title }}</a></h1>
					<i class="far fa-clock"></i> <small class="text-muted">{{date("d F Y, g:i a", strtotime($article->created_at))}} | {{$article->created_at->diffForHumans()}} | {{$article->author}}</small>
					<p>{!!str_limit($article->content, 300)!!}</p>

				@endforeach
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3">
				<h5>Vsechny tagy:</h5>
{{-- 				@foreach($allTags as $tagname)
					<a href="{{ route('tag.index', strtolower($tagname->name)) }}" class="badge badge-secondary">{{ $tagname->name }}</a>
				@endforeach --}}
			</div>

	</div>
</div>

@endsection