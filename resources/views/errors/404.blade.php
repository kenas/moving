@extends('layout')

@section('content')

	<div class="container">
		<div class="row">
			<div class="d-block mx-auto">
				<div class="card text-center">
				  <div class="card-body">
				    <h1 class="card-title">404</h1>
				    <p class="card-text">Oops! Stránka nebyla nalezena. Mohla by Vás zajímat podobná témata.</p>
				  </div>
				</div>

			<br>
			<ul class="list-group list-group-flush">

			  	@foreach($articles as $article)
					{{-- {{ dd($article->category->name) }} --}}
			  		<li class="list-group-item">
			  			<a href="{{route('articles.show', ['kategorie' => 'sdsdsd', 'clanek' => 'sddsds'])}}">{{$article->title}}</a>
			  			{{-- <a href="{{route('category.index', strtolower($article->category->slug))}}"><span class="badge badge badge-info">{{$article->category->name}}</a></span> --}}
			  		</li>


			  	@endforeach

			</ul>
		</div>
		</div>
	</div>

@endsection