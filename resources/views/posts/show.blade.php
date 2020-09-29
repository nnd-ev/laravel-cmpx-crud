@extends('layout/app')
{{--PRIKAZI JEDAN POST --}}
@section('content')
<a href="/posts" class="btn btn-secondary">Go Back</a>
<h1>{{ $post->title }}</h1>

<div class="container my-5">
    {!!$post->body !!} {{-- ovo se koristi za prarsiranje html tagova --}}

</div>

<hr>
<small>Written on {{ $post->created_at }}</small>
<hr>
<a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
{{-- <a href="/posts/{{$post->id}}/delete" class="btn btn-danger">Delete</a> --}}

<form action="{{ route('posts.destroy', $post->id) }}" method="POST">
    @csrf
    @method('DELETE')
    {{-- <a href="" class="btn btn-danger">Delete</a> --}}
    <button type="submit" class="btn btn-danger">Delete</button>
</form>


@endsection
