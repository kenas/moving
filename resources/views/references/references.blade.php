@if($articles->references->count() >= 1)
	<div id="carouselExampleSlidesOnly" class="carousel slide mt-5" data-ride="carousel">

		<h5>Reference</h5>
		<div class="carousel-inner">
			@foreach($articles->references as $reference)
			{{-- {{ dd($loop->first) }} --}}
				<div class="carousel-item @if($loop->first) active @endif">
					<div class="card-header d-block w-100">
						<div class="card-body">
							<blockquote class="mt-3">
								<img src="{{ asset('images/reference_icon.jpg') }}" class="img-fluid rounded-circle img-thumbnail mr-3" style="filter: none;" width="60px" height="60px" alt="reference icon Moving Well">
								{{ $reference->content }}
								<footer class="blockquote-footer mt-3">
									Libor Gess
								</footer>
							</blockquote>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endif