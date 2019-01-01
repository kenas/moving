@if(Session::has('status'))
	<div class="notification is-success">
	  <strong>Well done!</strong> 
	  		{{Session::get('status')}}	
	</div>
@endif