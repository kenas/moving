<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">O nás</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Historie</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Volný Čas</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Doporučuje</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Kontakt</a>
	      </li>
	    </ul>
	  </div>
	</nav>
	
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img class="d-block w-100" src="{{asset('banners/children.jpg')}}" alt="First slide">
	        <div class="carousel-caption d-none d-md-block">
		    	<h2>Eurythmy Movement for healthy body, balanced soul, sound mind & social heart</h2>
		  	</div>
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="{{asset('banners/childrenBack.jpg')}}" alt="Second slide">
	      	<div class="carousel-caption d-none d-md-block">
		    	<h2>There are virtually no limits to what Eurythmy can do for you as an individual, a group or as a human being. Look at just a few examples of activities offered by Moving Well to meet your specific needs or conditions.</h2>
		  	</div>
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="{{asset('banners/childrenMoving.jpg')}}" alt="Third slide">
	      	<div class="carousel-caption d-none d-md-block">
	      		<h2>This art of Eurythmy is a social art in the best sense; for its aim is, above all things, to communicate to us the mysteries of human nature.</h2>
	      	</div>
	    </div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>

	<div class="container">
		<div class="row">

			@if($articles)
				@foreach($articles as $article)
					<div class="col-12 col-sm-12 col-md-3 col-lg-3">
						<img src="">
					</div>
					<div class="col-12 col-sm-12 col-md-9 col-lg-9">
						<div class="pt-4"></div>
						<a href=""><h1>{{$article->title}}</h1></a>
						<small class="text-muted">{{date("d F o, g:i a", strtotime($article->created_at))}} | {{$article->author}}</small> <a href=""><span class="badge badge badge-info">{{$article->category->name}}</span></a>
						<p>{{str_limit($article->content, 300)}}</p>
						<hr>
					</div>
				@endforeach
			@else
				<p>Omlouváme se za potíže, články momentáně nejsou k dispozici.</p>
			@endif

			<div class="mx-auto mt-4" style="width: 200px;">
				{{$articles->links()}}
			</div>
			
		</div>
	</div>

	<footer>
		
	</footer>

</body>
</html>