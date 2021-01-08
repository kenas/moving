@extends('layout')

@section('title', 'Kontakt |')

@section('content')

<div id="app">
	<div class="container">
		<div class="d-flex flex-row">
			<div class="col-sm-12 col-md-5 col-lg-5 mt-5">


				@if(Session::has('status'))
				<div class="alert alert-success" role="alert">
					<h4 class="alert-heading">Zpráva byla odeslána!</h4>
					<p>{{ Session::get('status') }}</p>
				</div>
				@endif
				<div class="form-group">

					<form action="{{route('sendEmail')}}" accept-charset="UTF-8" method="POST">
						@csrf

						<label for="subject"></label>
						<input type="text" v-model="subject" name="subject"
							class=" {{$errors->has('subject') ? 'border-danger' : '' }} " value="{{ old('subject') }}"
							placeholder="Předmět" id="subject" style="border:none; width: 100%;
							border-bottom: 2px solid rgb(196, 196, 196); border-radius: none; margin-bottom: 1rem;">
						@if($errors->has('subject'))
						<p class="text-danger">{{ $errors->first('subject') }}</p>
						@endif

						<label for="email"></label>
						<input type="email" v-model="email" name="email"
							class=" {{$errors->has('email') ? 'border-danger' : '' }}" value="{{ old('email') }}"
							placeholder="E-mail" id="email" style="border:none; width: 100%;
							border-bottom: 2px solid rgb(196, 196, 196); border-radius: none; margin-bottom: 1rem;">
						@if($errors->has('email'))
						<p class="text-danger">{{ $errors->first('email') }}</p>
						@endif

						<label for="content"></label>
						<textarea v-model="content" name="content"
							class=" {{$errors->has('content') ? 'border-danger' : '' }}" rows="11"
							placeholder="Zde napište Vaši zprávu"
							style="border:none; width: 100%;
							border-bottom: 3px solid rgb(196, 196, 196); border-radius: none; margin-bottom: 1rem;">{{ old('content') }}</textarea>
						@if($errors->has('content'))
						<p class="text-danger">{{ $errors->first('content') }}</p>
						@endif


						<div class="mt-3">

							<button v-on:click="checkInputs" class="btn btn-primary btn-lg btn-block">Odeslat</button>
						</div>
					</form>
				</div>


			</div>

			<div class="col-sm-12 col-md-7 col-lg-7 d-flex align-items-center">


				<blockquote class="blockquote">
					<p>This art of Eurythmy is a social art in the best sense; for its aim is,
						above all things, to communicate to us the mysteries of human nature.”</p>
					<footer class="blockquote-footer text-right">
						Rudolf Steiner, October 1919
					</footer>
				</blockquote>


			</div>

		</div>
	</div>
</div>
@endsection