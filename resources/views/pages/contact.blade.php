@extends('layout')

@section('title', 'Kontakt |')

@section('content')

<div id="app">	
	<div class="container">
		<div class="row">
			<div class="col-sm-7 col-md-7 col-lg-7">

				<address>
					<strong>Vladimír Havrda</strong>
					<br>
					&#118;&#108;&#97;&#100;&#105;&#109;&#105;&#114;&#104;&#97;&#118;&#114;&#100;&#97;&#64;&#115;&#101;&#122;&#110;&#97;&#109;&#46;&#99;&#122;
				</address>

				<blockquote>
					Curabitur vitae diam non enim vestibulum interdum. Fusce consectetuer risus a nunc. Sed convallis magna eu sem. Nullam dapibus fermentum ipsum. Duis pulvinar. Sed convallis magna eu sem. Curabitur sagittis hendrerit ante. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Nulla non lectus sed nisl molestie malesuada. Curabitur ligula sapien,
				</blockquote>	
			</div>

			<div class="col-sm-5 col-md-5 col-lg-5">

				@include('messages.errors')
				
				<div class="form-group">

				{{-- {!! Form::open(['route' => 'sendEmail', 'method' => 'post', 'id' => 'contact-form']) !!} --}}
				<form action="{{route('sendEmail')}}" method="POST">
					@csrf
					{{-- {{ Form::label('subject', 'Predmet', ['class' => 'control-label'])}}
					{{Form::text('subject', null, ['class' => 'form-control  form-control-lg'])}} --}}
					<label for="subject"></label>
					<input type="text" v-model="subject" name="subject" class="form-control form-control-lg {{$errors->has('subject') ? 'border-danger' : '' }} " value="{{ old('subject') }}" placeholder="Předmět">

					<label for="email"></label>
					<input type="email" v-model="email" name="email" class="form-control form-control-lg {{$errors->has('email') ? 'border-danger' : '' }}" value="{{ old('email') }}" placeholder="Email">
					{{-- {{ Form::label('email', 'Vas email', ['class' => 'control-label'])}}
					{{Form::email('email', null, ['class' => 'form-control  form-control-lg', 'placeholder' => '@'])}} --}}
					<label for="content"></label>
					<textarea v-model="content" name="content" class="form-control form-control-lg {{$errors->has('content') ? 'border-danger' : '' }}" rows="8" placeholder="Zde napište vaši zprávu">{{ old('content') }}</textarea>
					{{-- {{ Form::label('content', '', ['class' => 'control-label'])}}
					{{Form::textarea('content', null, ['class' => 'form-control  form-control-lg', 'rows' => '8', 'placeholder' => 'Vas text ...'])}} --}}

					<div class="pt-3">
						{{-- {{Form::submit('Send', ['class' => 'btn btn-primary btn-lg btn-block'])}} --}}
						<button v-on:click="checkInputs" class="btn btn-primary btn-lg btn-block">Odeslat</button>
					</div>
				</form>
				{{-- {!! Form::close()!!} --}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection