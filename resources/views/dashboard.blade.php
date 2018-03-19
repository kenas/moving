@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="float-right">
            <div class="mb-4">
                <a  class="btn btn-primary" href="">Create an article</a>
            </div>
        </div>
        
    <table class="table">
        <caption>  {{$articles->links()}} </caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Cover picture</th>
                <th scope="col">Category</th>
                <th scope="col">Publish</th>
                <th scope="col">Author</th>
                <th scope="col">Created at</th>
                <th scope="col">View</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($articles as $article)
                <tr>
                    <th scope="row">{{ $article->id}}</th>
                    <td>{{ str_limit($article->title, 30)}}</td>
                    <td><strong>{{ ($article->cover_picture) ? 'Yes' : 'No' }}</strong></td>
                    <td><span class="badge badge badge-info">{{ $article->category->name }}</span></td>
                    <td>
                        @if($article->publish) 
                                <span class="badge badge-success">Active</span>
                        @else 
                                <span class="badge badge-warning">Inactive</span> 
                        @endif
                    </td>
                    <td>{{ $article->author}}</td>
                    <td>{{ date("d F o, g:i a", strtotime($article->created_at)) }}</td>
                    <td><button type="button" class="btn btn-outline-info">View</button></td>
                    <td><form action="" method="POST"><input name="_method" type="hidden" value="PUT"><button type="submit" class="btn btn-outline-success">Edit</button></form></td>
                    <td><button type="button" class="btn btn-outline-danger">Delete</button></td>
                </tr>
            @endforeach
          
        </tbody>

    </table>
    </div>
</div>

@endsection