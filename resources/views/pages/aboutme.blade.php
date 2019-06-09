@extends('layout')

@section('title', 'O mně | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-lg-3">
				<figure class="figure">
				  	<img src="{{ asset('images/vladimirHavrda.jpg')}}" class="figure-img img-fluid rounded" alt="Vladimír Havrda">
				  	<figcaption class="figure-caption text-right">Vladimír Havrda</figcaption>
				</figure>
			</div>

			<div class="col-sm-12 col-md-8 col-lg-8">
				<h1>O mně</h1>
				<p>
				Moving Well was born in October 2013 out of love for the ensouled movement of Eurythmy and out of a desire to bring this wonderful gift out of narrow circles to the general public.
				Our modern world is so much in need of healing and Eurythmy can meet these needs if it becomes better known to the wide world and practiced by many more people.
				Its use can be truly unlimited - as an art of movement, educational tool for children, enjoyable social activity, hygienic and health promoting exercises, therapy for illnesses and ailments, rehabilitation from addictions and traumatic experiences, for improvement of mobility of the elderly and frail in care homes, for team building, alignment and task solving in workplaces, as a means of self-development, meditation, etc.
				Vladimir Havrda, founder of Moving Well, was born in 1958 in former Czechoslovakia. After ‘Velvet Revolution’ he travelled abroad to find new impulses for renewal of post-communist society. One of them was Eurythmy. He lived, learned and worked in the UK, USA and Germany and is now based in East Sussex.
				</p>
			</div>
		</div>

	</div>
@endsection
