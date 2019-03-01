@if($articles->references->count() > 1)
	<div id="carouselExampleSlidesOnly" class="carousel slide mt-5" data-ride="carousel">

		<h5>reference</h5>
		<div class="carousel-inner">
			@foreach($articles->references as $reference)

				<div class="carousel-item @if($reference->id === 1 ) active @endif">
					<div class="card-header d-block w-100">
						<div class="card-body">
							<blockquote class="mt-3">
								{{ $reference->content }}
								<footer class="blockquote-footer mt-3">Libor Gess</footer>
							</blockquote>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endif