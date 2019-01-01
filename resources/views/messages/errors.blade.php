<div class="notification is-danger">
  <strong>Please have a look down below!</strong>
  	<ul>
  		  @foreach ($errors->all() as $error)
  		  	<li>{{$error}}</li>
  		  @endforeach
  	</ul>
</div>