@extends('layouts.app')

@section('content')

<div class="container">
	{!! Form::open(['route' => 'categories.store']) !!}
		{{Form::text('category', null, ['class' => 'input is-medium', 'placeholder' => 'Nova kategorie?'])}}
	{!! Form::close() !!}
	<div class="mt-5"></div>
	<table class="table is-fullwidth">
		<thead>
			<th>#</th>
			<th>Name</th>
			<th>Number of articles</th>
		</thead>
		<tbody>
			@foreach($categories as $category)
				<tr>
					<td>{{$category->id}}</td>
					<td><a href="">{{$category->name}}</a></td>
					<td><span class="tag is-info is-medium">{{$category->articles->count()}}</span></td>
				</tr>
			@endforeach
		</tbody>
	</table>
	 {{$categories->links()}}
</div>

@endsection