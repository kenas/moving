<!DOCTYPE html>
<html>
<head>
    @yield('head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

</head>
<body>
  <nav class="navbar" role="navigation" aria-label="main navigation">
  

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  
        @guest

        @else

        <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="{{route('dashboard')}}">
        Home
      </a>

      <a class="navbar-item">
        <a class="navbar-item" href="{{route('dashboard.categories')}}">Categories</a>
      </a>

      <a class="navbar-item">
        <a class="navbar-item" href="{{route('dashboard.fotogalerie')}}">fotogalerie</a>
      </a>

      <a class="navbar-item">
        {{ Auth::user()->name }}
        @endguest
      </a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
           @guest
{{--               <a class="button is-light" href="{{route('login')}}">
                Login
              </a> --}}
            @else

              <a href="{{route('articles.create')}}" class="button is-info">Create article</a>
              <a class="button is-primary" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <strong>Logout</strong>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
             @endguest
        </div>
      </div>
    </div>
  </div>
</nav>

  @yield('content')


</body>
</html>