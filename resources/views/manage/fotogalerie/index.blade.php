@extends('layouts.app')

@section('content')
<div id="app">
	<div class="container">
		<div class="columns is-multiline">
			@foreach($all as $img)
				<div class="column is-one-quarter">
					<div class="card">
					  <div class="card-image">
					    <figure class="image">
					    		<button v-on:click="deletePicture({{json_encode($img)}})" type="submit" class="card-footer-item delete" style="position: absolute; top: 15px; right: 15px; z-index: 1;"></button>
					    	<img src="{{$img->path}}" @mouseover="hoverIn($event, {{json_encode($img)}})" @mouseout="hoverOut($event)">
					    </figure>
					  </div>
					  <div class="card-content">
					    <div class="media">
					      <div class="media-left">

					      </div>
					    </div>

					    <div class="content">
					  		{{$img->description}}
					    </div>
					  </div>
					</div>
				</div>
		@endforeach
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>

<script type="text/javascript">
    const  app = new Vue({

    	el: '#app',
    	data: {
    		id: null,
    		alertConfirmDelete: false,
    		deleteCross: false,
    	},

		methods: {

			getId: function (img) {

				event.preventDefault();
				this.id = img.id;
			},

			deletePicture: function(img) {
            this.alertConfirmDelete = confirm('Remove the picture? '+img.description+' ');
            
              if(this.alertConfirmDelete) {
                //do axios 
                const confirm = this;
                axios.post('/picture/' + img.id,  {
                  id: img.id
              })
              .then(function (response) {
               
                if(response.status === 200 && response.statusText === 'OK') {
                  
                   	setTimeout(function(){ 
                		window.location.reload(true);
              		}, 500);
                }
              })
              .catch(function (error) {
                console.log(error);
              });
              } else {
                //do nothing
              }

          	},

          	hoverIn: function (event, img) {
          		this.id = img.id;
          		this.deleteCross = true;

          	},

          	hoverOut: function (event) {
          		this.deleteCross = false;
          	},

		},

		watch: {

			id: function () {
			},
			deleteCross: function () {

			}
		}
    });
</script>
@endsection