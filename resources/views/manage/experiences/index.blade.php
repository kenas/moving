@extends('layouts.app')

@section('title', 'Manage | Experiences')
@section('content')
<div id="app" style="margin-top: 35px;">
	<div class="container">
		<div  v-show="successful" class="notification is-success">@{{successful}}</div>
		<div class="columns">
			<div class="column is-three-fifths">
				<h5>Experiences</h5>
				<table class="table">

					<thead>
						<tr>
							<th>Year</th>
							<th>Count</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						@foreach($experiences as $experience)
						<tr>
							<th scope="row">{{$experience->year}}</th>

							<td>{{$experience->cnt}}</td>
							<td><button class="button is-info">edit</button></td>
							<td><span class="delete"></span></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="column 100%">
				<h5>Add experiences</h5>
				
				<div class="field">
					<div class="control">
						<input v-model="year" type="number" name="year" placeholder="{{date('Y')}}" class="input is-medium">
					</div>
				</div>

				<div class="field">
					<div class="control">
						<textarea v-model="description" name="description" class="textarea" rows="10" placeholder="Description of new experiences"></textarea>
					</div>
				</div>
				<button v-on:click="saveExperience()" class="button is-primary is-medium is-fullwidth">Save</button>
		
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    const  app = new Vue({
    	el: '#app',
    	data: {
    		year: null,
    		description: null,
    		successful: false
    	},

    	methods: {
    		saveExperience: function () {
    			
    			event.preventDefault();
    			const confirm = this;
    			axios.post('/dashboard/experiences/store', {
    				year: this.year,
    				description: this.description
    			})
    			.then(function (response) {

    				if(response.status === 200 && response.statusText === 'OK') {
    					confirm.successful = response.data.message;
    				}
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
    		}
    	}
    });
</script>
@endsection