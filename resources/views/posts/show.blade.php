@extends('layouts.app')

@section('content')
<div class="">
    <div class="card" style="width: 18rem;">
      <img style="width: 100%;" src="/storage/cover_images/{{$post->cover_image}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{$post->body}}</p>
          <small>Written on {{$post->created_at}}</small>
          <a href="/posts/" class="btn btn-dark mt-1">Return</a>
          <a href="/posts/{{$post->id}}/edit" class="btn btn-primary mt-1">Edit</a>
          {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right' ]) !!}
          {{Form::hidden('_method', 'DELETE')}}
          {{Form::submit('Delete',['class' => 'btn btn-danger'] )}}
          {!! Form::close() !!}
        </div>
      </div>
</div>
@endsection