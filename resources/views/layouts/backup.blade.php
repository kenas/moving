<!DOCTYPE html>
<html>
<head>
    @yield('head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Moving Well') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('dashboard')}}">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
             @guest
                
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                
            @else
            
                <span href="{{ route('login')}}"> {{ Auth::user()->name }}</span>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            @endguest
      </div>
    </nav>

        @yield('content')

<script type="text/javascript">

    const  app = new Vue({
        el: '#app',
        data: {
          toogleModal: false,
          placeHolderArticle: '',
        },

        methods: {
          openModal: function(article) {
            //console.log(article);
            this.placeHolderArticle = article;
            
          },

          sendReqestUpdate: function (article) {

            axios.post('/article/' + article.id,  {
                title:        this.placeHolderArticle.title,
                content:      this.placeHolderArticle.content,
                category_id:  this.placeHolderArticle.category_id,
                publish:      this.placeHolderArticle.publish,
              })
              .then(function (response) {
                if(response.status === 200 && response.statusText === 'OK') {
                  
                }
              })
              .catch(function (error) {
                console.log(error);
              });
          }
        },

        watch: {
          placeHolderArticle: function () {
            
          }
        }

    });
</script>
</body>
</html>