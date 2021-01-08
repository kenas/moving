@extends('layout')

@section('content')

<div class="container">
	<div class="row d-flex flex-column">
		<div class="d-flex justify-content-around">
			<div class="col-sm-12 col-md-7 col-lg-7 flex-column">
				<span class="d-flex justify-content-center">

					<img src="{{ asset('local_images/candl.png') }}" alt="" class="img-fluid mt-4">
				</span>
				<span class="text-center">

					<h1 class="mb-5">404</h1>
					<p class="text-muted">Oops! <br />
						Stránka nebyla nalezena. <br />
						Mohla by Vás zajímat podobná témata.
					</p>


					<br>
				</span>
				<ul class="list-group list-group-flush mt-5">

					@foreach($articles as $article)
					<li class="list-group-item">
						<a
							href="{{route('articles.show', ['kategorie' => $article->category->slug, 'clanek' => $article->slug])}}">{{$article->title}}</a>
						{{-- <a href="{{route('category.index', strtolower($article->category->slug))}}"><span
							class="badge badge badge-info">{{$article->category->name}}</a></span> --}}
					</li>


					@endforeach

				</ul>
			</div>
		</div>
	</div>

	@endsection