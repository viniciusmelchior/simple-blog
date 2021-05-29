@extends('layouts.app')

@section('content')
    @if(count($posts) > 0)
        @foreach ($posts as $post)
            <div class="">
                <div class="card" style="width: 18rem;">
                    <img style="width: 100%;" src="/storage/cover_images/{{$post->cover_image}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{$post->title}}</h5>
                      <small>Written by {{$post->user->name}}</small>
                      <p class="card-text">{{$post->body}}</p>
                      <small>Written on {{$post->created_at}}</small>
                      <a href="/posts/{{$post->id}}" class="btn btn-primary mt-1">View Post</a>
                    </div>
                  </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts Found</p>
    @endif
@endsection