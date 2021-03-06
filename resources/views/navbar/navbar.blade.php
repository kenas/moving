<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav navbar-nav ml-auto text-right">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('aboutme')}}">O mně</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('experiences')}}">Zkušenosti</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="/kategorie" id="navbarDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          Kategorie
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @if($getAllCategories)

          @foreach($getAllCategories as $category)

          @if($category->articles->count())
          <a class="dropdown-item
                  @if(Request::fullUrl() === route('category.index', strtolower($category->name)))
                    active
                @else

                @endif

                " href="{{route('category.index', strtolower($category->slug)) }}">{{$category->name}}</a>
          @else

          @endif

          @endforeach

          @endif
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('fotogalerie')}}">Fotogalerie</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('getEmail')}}">Kontakt</a>
      </li>
    </ul>
  </div>
</nav>