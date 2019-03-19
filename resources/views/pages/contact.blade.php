@extends('layout')

@section('title', 'Kontakt |')

@section('content')

<div id="app">	
	<div class="container">
		<div class="row">
			<div class="col-sm-5 col-md-5 col-lg-5">
				@if(Session::has('status'))
					send
				@endif
				<div class="form-group">

				{{-- {!! Form::open(['route' => 'sendEmail', 'method' => 'post', 'id' => 'contact-form']) !!} --}}
				<form action="{{route('sendEmail')}}" accept-charset="UTF-8" method="POST">
					@csrf
					{{-- {{ Form::label('subject', 'Predmet', ['class' => 'control-label'])}}
					{{Form::text('subject', null, ['class' => 'form-control  form-control-lg'])}} --}}
					<label for="subject"></label>
					<input type="text" v-model="subject" name="subject" class="form-control form-control-lg {{$errors->has('subject') ? 'border-danger' : '' }} " value="{{ old('subject') }}" placeholder="Předmět">
					@if($errors->has('subject'))
						<p class="text-danger">{{ $errors->first('subject') }}</p>
					@endif

					<label for="email"></label>
					<input type="email" v-model="email" name="email" class="form-control form-control-lg {{$errors->has('email') ? 'border-danger' : '' }}" value="{{ old('email') }}" placeholder="E-mail">
					@if($errors->has('email'))
						<p class="text-danger">{{ $errors->first('email') }}</p>
					@endif
					{{-- {{ Form::label('email', 'Vas email', ['class' => 'control-label'])}}
					{{Form::email('email', null, ['class' => 'form-control  form-control-lg', 'placeholder' => '@'])}} --}}
					<label for="content"></label>
					<textarea v-model="content" name="content" class="form-control form-control-lg {{$errors->has('content') ? 'border-danger' : '' }}" rows="8" placeholder="Zde napište vaši zprávu">{{ old('content') }}</textarea>
					@if($errors->has('content'))
						<p class="text-danger">{{ $errors->first('content') }}</p>
					@endif
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

			<div class="col-sm-7 col-md-7 col-lg-7">
				<address>
					<strong>Vladimír Havrda</strong>
					<br>
					&#118;&#108;&#97;&#100;&#105;&#109;&#105;&#114;&#104;&#97;&#118;&#114;&#100;&#97;&#64;&#115;&#101;&#122;&#110;&#97;&#109;&#46;&#99;&#122;
				</address>

				<blockquote class="blockquote">
					<p>“This art of Eurythmy is a social art in the best sense; for its aim is,
					above all things, to communicate to us the mysteries of human nature.”</p>
					<footer class="blockquote-footer">
						Rudolf Steiner, October 1919
					</footer>
				</blockquote>	
			</div>
		</div>
	</div>
</div>
@endsection