@extends('layout')

@section('title', 'Zkušenosti | ')

@push('timeLineCss')
    <link href="{{ asset('css/timeLineCss.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div class="container">
		<div class="row">
					<h1>Zkušenosti</h1>
			<p>The ‘Moving Well’ founder, Vladimir Havrda, is a fully qualified Eurythmist. He trained with the West Midlands Eurythmy.</p>

			<div class="timeline">
				<ul>
					@foreach($experiences as $experience)
						<li>
							<div class="experience">
								{{-- <h3>Someting 1</h3> --}}
								<p>{{$experience->description}}</p>
							</div>
							<div class="time">
								@if($experience->year > 1)
									<h4>{{$experience->year}}</h4>
								@else
									
								@endif
							</div>
						</li>
					@endforeach
					<div style="clear: both;"></div>
				</ul>
			</div>
		</div>
	</div>
@endsection
