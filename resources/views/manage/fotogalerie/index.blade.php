@extends('layouts.app')

@section('title', 'Manage | Fotogalerie')
@section('content')
<div id="app">
  <div class="container">
    <div class="columns is-multiline">
        <div v-for="(picture, index) in allPictures" class="column is-one-quarter">
          <div class="card">
            <div class="card-image">
              <figure class="image">
                  <button v-on:click="deletePicture(picture)" type="submit" class="delete" style="position: absolute; top: 15px; right: 15px; z-index: 1;"></button>
                <img v-bind:src="picture.path">
              </figure>
            </div>
            <div class="card-content">
              <div class="content">
               @{{picture.description}}
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    const  app = new Vue({

      el: '#app',
      data: {
        alertConfirmDelete: false,
        deleteCross: false,
        allPictures: {!!json_encode($all)!!},
      },

    methods: {

      deletePicture: function(picture) {
            this.alertConfirmDelete = confirm('Remove the picture? '+picture.description+' ');
            
              if(this.alertConfirmDelete) {
                //do axios 
                const confirm = this;
                axios.post('/picture/' + picture.id,  {
                  id: picture.id
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

            }
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