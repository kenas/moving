@extends('layout')

@section('title', 'Zkušenosti | ')

@push('timeLineCss')
<link href="{{ asset('css/timeLineCss.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
	<div class="row justify-content-md-center mt-5">
		<div class="col-sm-12 col-md-4 col-lg-4">
			<h1 class="mt-5">Zkušenosti</h1>
			<p>
				The ‘Moving Well’ founder, Vladimir Havrda, is a fully qualified Eurythmist. <br />He trained with the
				West
				Midlands Eurythmy.
			</p>
		</div>

		<div class="col-sm-12 col-md-6 col-lg-6">

			<div class="timeline">
				<ul>
					@foreach($experiences as $experience)
					<li>
						<div class="experience">

							<p>{{$experience->description}}</p>
						</div>
						<div class="time">
							{{$experience->year}}
						</div>
					</li>
					@endforeach
					<div style="clear: both;"></div>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection