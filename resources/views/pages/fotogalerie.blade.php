@extends('layout')

@section('title', 'Fotogalerie |')

@section('content')
	
<div class="container">
	<div class="row">
		@foreach($all as $picture)
			<div class="col-md-3">
				<div class="card mb-3">
					<a href="{{ asset('fotogalerie/'.$picture->path)}}" data-mediabox="my-gallery-name" data-title="{{$picture->description}}">
						<img src="{{ asset('fotogalerie/thumbnail/'.$picture->path)}}" class="card-img-top" alt="...">
					</a>
					<div class="card-body">
					<p class="card-text">{{$picture->description}}</p>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
@endsection