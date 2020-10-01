@extends('layout/app')
{{--PRIKAZI JEDAN POST --}}
@section('content')
<a href="/posts" class="btn btn-secondary">Go Back</a>
<h1>{{ $post->title }}</h1>

           <img src="/storage/cover_images/{{ $post->cover_image }}" alt="" style="width:50%; display: block; margin: 0 auto">
<div class="container my-5">
    {!!$post->body !!} {{-- ovo se koristi za prarsiranje html tagova --}}

</div>

<hr>
<small>Written on {{ $post->created_at }}, Written by  {{ $post->user->name }}</small>
<hr>

@if(!Auth::guest()) {{-- ako korisnik nije "guest" mocice da edituje ili obrise post--}}
@if(Auth::user()->id == $post->user_id)

<a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
{{-- <a href="/posts/{{$post->id}}/delete" class="btn btn-danger">Delete</a> --}}

<form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    {{-- <a href="" class="btn btn-danger">Delete</a> --}}
    <button type="submit" class="btn btn-danger">Delete</button>
</form>

@endif
@endif

@endsection
