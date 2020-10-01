@extends('layouts/app')

@section('content')

<h1>Posts</h1>

{{-- SVI POSTOVI --}}

@if(count($posts)>0)
    @foreach($posts as $post)
    <div class="card bg-light mt-3">
        <div class="card-body">

        <div class="row">
        <div class="col-md-3 col-sm-3">
          <img src="/storage/cover_images/{{ $post->cover_image }}" alt="" style="width: 100%; max-height: 210px;">
        </div>
        <div class="col-md-9 col-sm-9">
        <h3> <a href="/posts/{{$post->id}}">{{ $post->title }}</a></h3>
        <small>Written on {{ $post->created_at }} , Written by  {{ $post->user->name }}</small>
        </div>
        </div>

        </div>
    </div>
    @endforeach
    {{-- {{ $posts->links() }} --}}
@else
<p>No posts found</p>
@endif

@endsection
