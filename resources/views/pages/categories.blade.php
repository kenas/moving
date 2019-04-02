@extends('layout')

@section('title')

@section('content')
		
	<div class="container">
		<div class="row">
			@foreach($getAllCategories as $category)
				@if($category->articles->count() >= 1)
					<div class="col-sm-6 mb-4">
						<div class="card">
						<img src="{{ $category->cover_picture }}" class="card-img-top" style="filter: none;" alt="...">
							<div class="card-body">
							<h5 class="card-title">{{ $category->name }}</h5>
								@foreach($category->articles->take(1) as $article)
									<p>{{ str_limit($article->content, 150) }}</p>
								@endforeach
							</div>
							<ul class="list-group list-group-flush">
								@foreach($category->articles->take(3) as $article)
									<li class="list-group-item">{{ $article->title }}</li>
								@endforeach
							</ul>
{{-- 							<div class="card-body">
							    <a href="{{ route('category.index', strtolower($category->name)) }}" class="card-link">Přejít do této kategorie</a>
							    <a href="#" class="card-link">Another link</a>
							</div> --}}
						</div>
					</div>
				@endif		
			@endforeach
		</div>
	</div>
@endsection