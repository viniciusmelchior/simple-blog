@extends('layouts.app')

@section('content')
<div class="">
    <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{$post->body}}</p>
          <small>Written on {{$post->created_at}}</small>
          <a href="/posts/" class="btn btn-dark mt-1">Return</a>
        </div>
      </div>
</div>
@endsection