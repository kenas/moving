@extends('layout')

@section('title', 'Kontakt | ')

@section('content')
	
<div class="container">
	<div class="row">


		<div class="col-sm-10 col-md-10 col-lg-10">

			<h1>Kontakt</h1>

			@include('messages.errors')

			<div class="form-group">

			{!! Form::open(['route' => 'sendEmail', 'method' => 'post', 'id' => 'contact-form']) !!}

				{{ Form::label('subject', 'Predmet', ['class' => 'control-label'])}}
				{{Form::text('subject', null, ['class' => 'form-control  form-control-lg'])}}

				{{ Form::label('email', 'Vas email', ['class' => 'control-label'])}}
				{{Form::email('email', null, ['class' => 'form-control  form-control-lg', 'placeholder' => '@'])}}

				{{ Form::label('content', '', ['class' => 'control-label'])}}
				{{Form::textarea('content', null, ['class' => 'form-control  form-control-lg', 'rows' => '8', 'placeholder' => 'Vas text ...'])}}

				<div class="pt-3">
					{{Form::submit('Send', ['class' => 'btn btn-primary btn-lg btn-block'])}}
				</div>
			{!! Form::close()!!}
			</div>
		</div>
	</div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
	
(function(){
	document.getElementById('contact-form').addEventListener('submit', function(e) {
		e.preventDefault();

		axios.post(this.action, {

			'subject': document.getElementById('subject').value,
			'email': document.getElementById('email').value,
			'content': document.getElementById('content').value

			})
			.then((response) => {
			console.log('success');
					
				const removePrevErrorsMessage = document.getElementsByClassName('text-danger');

				[...removePrevErrorsMessage].forEach((element) =>  element.remove(element));

			})
			.catch((error) => {
				//console.log(error.response);
				const errors = error.response.data.errors;
				const firstItem = Object.keys(errors)[0];

				const firstItemDom = document.getElementById(firstItem);

				const errorMessage = errors[firstItem][0];

				firstItemDom.scrollIntoView({behavior: "smooth"});

				const removePrevErrorsMessage = document.getElementsByClassName('text-danger');
				//console.log(removePrevErrorsMessage);

				[...removePrevErrorsMessage].forEach((element) =>  element.remove(element));

				const buildDivWithText = document.createElement('div');
				buildDivWithText.className = 'text-danger';
				buildDivWithText.textContent = `${errorMessage}`;

				firstItemDom.parentNode.insertBefore(buildDivWithText, firstItemDom);

		});
	});
})();
	
		
	
</script>
@endsection