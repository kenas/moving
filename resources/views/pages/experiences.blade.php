@extends('layout')

@section('title', 'Zkušenosti | ')

@push('timeLineCss')
    <link href="{{ asset('css/timeLineCss.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<h1>Zkušenosti</h1>
				<p>The ‘Moving Well’ founder, Vladimir Havrda, is a fully qualified Eurythmist. He trained with the West Midlands Eurythmy.</p>

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
