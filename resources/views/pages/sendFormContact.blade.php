<!DOCTYPE html>
<html>
<head>
	<title>Kontakt z webu</title>

</head>
<body>
	<div class="card" style="">
	  <div class="card-header">
	    Predmet: {{ $data['subject'] }}
	  </div>
	  <div class="card-body">
	    <blockquote class="blockquote mb-0">
	      <p>Obsah: {{ $data['content'] }}</p>
	      <footer class="blockquote-footer">Odeslano z:{{ $data['email'] }}</footer>
	    </blockquote>
	  </div>
	</div>
</body>
</html>