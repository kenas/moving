@extends('layouts.app')

@section('title', 'Manage | Categories')
@section('content')

<div id="app" style="margin-top: 35px;">
	<div class="container">
		<div class="columns">
			
			<div class="column is-three-fifths">
				<div  v-show="msg" v-bind:class="[activeClass , errorClass]">@{{msg}}</div>
				<table class="table is-fullwidth">
					<thead>
						<th>#</th>
						<th>Name</th>
						<th>Number of articles</th>
						<th>Delete</th>
					</thead>
					<tbody>
						@foreach($categories as $category)
							<tr>
								<td>{{$category->id}}</td>
								<td><a href="">{{$category->name}}</a></td>
								<td><span class="tag is-info is-medium">{{$category->articles->count()}}</span></td>
								<td><button v-on:click="deleteCategory({{json_encode($category)}})" type="submit" class="delete"></button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="column 100%">
				{!! Form::open(['route' => 'categories.store']) !!}
				<div class="field">
	  				<div class="control">
				{{Form::text('category', null, ['class' => 'input is-medium', 'placeholder' => 'Název nové kategorie'])}}
					</div>
				</div>

				<div class="field">
	  				<div class="control">
				{{ Form::text('slug', null, ['class' => 'input is-medium', 'placeholder' => 'Dvě slova o čem je kategorie']) }}
					</div>
				</div>
				<button class="button is-primary is-medium is-fullwidth">Save</button>
				{!! Form::close() !!}
			</div>
		</div>
		 {{$categories->links()}}
	</div>
</div>

<script type="text/javascript">
    const  app = new Vue({

    	el: '#app',
    	data: {
    		alertConfirmDelete: false,
    		alertConfirmMsg: null,
    		msg: '',
			activeClass: '',
			errorClass: '',
 			
    	},

    	methods: {

    		deleteCategory: function(category) {
    			this.alertConfirmDelete = confirm('Remove the category? '+category.name+' ');

    			if(this.alertConfirmDelete) {
                //do axios 
                const confirm = this;
                axios.post('/category/' + category.id,  {
                	id: category.id
                })
                .then(function (response) {

                	if(response.status === 200 && response.statusText === 'OK') {

						confirm.msg = response.data;

                		if(confirm.msg.message_error) {

                			confirm.msg = confirm.msg.message_error;
                			confirm.errorClass = 'notification is-danger';

                		} else if(confirm.msg.message_success) {

                			confirm.msg = confirm.msg.message_success;
                			confirm.activeClass  = 'notification is-success';

                			setTimeout(function(){ 
                				window.location.reload(true);
                			}, 2100);
                		}
                	}
                })
                .catch(function (error) {
                	console.log(error);
                });
            }

        	}
    	},

    	watch: {

    		msg: function () {

    		}
    	}
    });
</script>
@endsection