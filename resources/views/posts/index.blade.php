@extends('layout/app')

@section('content')

<h1>Posts</h1>

{{-- SVI POSTOVI --}}

@if(count($posts)>0)
    @foreach($posts as $post)
    <div class="card bg-light mt-3">
        <div class="card-body">
        <h3> <a href="/posts/{{$post->id}}">{{ $post->title }}</a></h3>
        <small>Written on {{ $post->created_at }}</small>
        </div>
    </div>
    @endforeach
    {{-- {{ $posts->links() }} --}}
@else
<p>No posts found</p>
@endif

@endsection
