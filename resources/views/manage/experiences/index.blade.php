@extends('layouts.app')

@section('title', 'Manage | Experiences')
@section('content')
<div id="app" style="margin-top: 35px;">
	<div class="container">
		<div  v-show="successful" class="notification is-success">@{{successful}}
			<span v-on:click="closeSuccessNotification()" class="delete"></span>
		</div>
		<div class="columns">
			<div class="column is-three-fifths">
				<table class="table">

					<thead>
						<tr>
							<th>Year</th>
							<th>Content</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						@foreach($experiences as $experience)
						<tr>
							<th scope="row">{{$experience->year}}</th>

							<td>{{$experience->description}}</td>
							
							<td><button v-on:click="editButtonClicked" class="button is-info">edit {{$experience->id}}</button></td>
							<td><span v-on:click="deleteExperience({{json_decode($experience->id)}})" class="delete"></span></td>
						</tr>
						@endforeach
					</tbody>
				</table>
					{{$experiences->links()}}
			</div>

			<div class="column 100%">
			
				<div class="field">
					<div class="control">
						<input v-model="year" type="number" name="year" placeholder="Year of your experience, example: {{date('Y')}}" class="input is-medium">
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
    		alertConfirmDelete: false,
    		year: null,
    		description: null,
    		successful: false,
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

    					//clean up all filds
    					confirm.description = null;
    					confirm.year = null;
    				}
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
    		},

    		closeSuccessNotification: function () {

    			this.successful = false;
    		},

    		editButtonClicked: function (event) {

    			const editInout = event.target;
    			const placeWhereInputCreate = editInout.parentNode.previousElementSibling;
    		},

    		deleteExperience: function (id) {
    			console.log(id);
    			
    			this.alertConfirmDelete = confirm('Remove the experience? '+id+'');

    			const getObject = this;
    			if(this.alertConfirmDelete) {
    			axios.post('/experiences/' +id, {
    				id: id
    			})
    			.then(function (response) {

    				if(response.status === 200 && response.statusText === 'OK') {

    					getObject.successful = response.data.message;
    					
    				}
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
    		}
    	}
    	}
    });
</script>
@endsection