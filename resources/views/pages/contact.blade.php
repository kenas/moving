@extends('layout')

@section('title', 'Kontakt | ')

@section('content')

<div id="app">	
	<div class="container">
		<div class="row">


			<div class="col-sm-10 col-md-10 col-lg-10">

				<h1>Kontakt</h1>

				@include('messages.errors')

				<div class="form-group">

				{{-- {!! Form::open(['route' => 'sendEmail', 'method' => 'post', 'id' => 'contact-form']) !!} --}}
				<form action="{{route('sendEmail')}}" method="POST">

					{{-- {{ Form::label('subject', 'Predmet', ['class' => 'control-label'])}}
					{{Form::text('subject', null, ['class' => 'form-control  form-control-lg'])}} --}}
					<label for="subject">Predmet</label>
					<input type="text" v-model="subject" name="subject" id="subject" class="form-control form-control-lg"><p v-for="er in errorsMessage">@{{er.subject[0]}}</p>

					<label for="email">Email</label>
					<input type="email" v-model="email" name="email" id="subject" class="form-control form-control-lg" placeholder="@">
					{{-- {{ Form::label('email', 'Vas email', ['class' => 'control-label'])}}
					{{Form::email('email', null, ['class' => 'form-control  form-control-lg', 'placeholder' => '@'])}} --}}
					<label for="content">Vas zprava</label>
					<textarea v-model="content" name="content" class="form-control form-control-lg" rows="8" placeholder="Zda napiste Vasi zpravu"></textarea>
					{{-- {{ Form::label('content', '', ['class' => 'control-label'])}}
					{{Form::textarea('content', null, ['class' => 'form-control  form-control-lg', 'rows' => '8', 'placeholder' => 'Vas text ...'])}} --}}

					<div class="pt-3">
						{{-- {{Form::submit('Send', ['class' => 'btn btn-primary btn-lg btn-block'])}} --}}
						<button v-on:click="checkInputs" class="btn btn-primary btn-lg btn-block">Send</button>
					</div>
				</form>
				{{-- {!! Form::close()!!} --}}
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
<script type="text/javascript">
	
app = new Vue({

		el: '#app',
		data: {
			subject: '',
			email: '',
			content: '',
			errorsMessage: []

		},

		methods: {

			checkInputs: function(event) {
				event.preventDefault();

				let data = {
					subject: this.subject,
					email: this.email,
					content: this.content
				}

				axios.post('/kontakt/send/')
				  .then((response) => {
				    console.log(response);
				  })
				  .catch((error) => {
				  	let testErrors = error.response.data.errors;
				  	this.errorsMessage.push(testErrors);
				  	console.log(this.errorsMessage);
				    //console.log(error.response.data.errors);
				  })
				  .then(function () {
				    // always executed
				  }); 
			}
		},

		watch: {

			errorsMessage:function() {

			}
		}
	});
</script>
@endsection