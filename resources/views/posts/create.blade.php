@extends('layout/app')
{{-- CREIRANJE POSTA --}}
@section('content')

<h1>Create Post</h1>

{{-- <form action="{{ "PostsController@store") }}" method="POST"> --}}
    {{-- <form  method="post" action="{{URL::to('/create')}}"> --}}
        <form role="form" action="{{ route('posts.store') }}" method="POST">
            @csrf
  <div class="form-group">
    <label for="title">Post title:</label>
    <input type="text" class="form-control" placeholder="Enter title" id="title" name="title">
  </div>
  <div class="form-group">
    <label for="pwd">Post Body:</label>
     <textarea name="body" class="form-control" id="article-ckeditor" rows="4" style="min-width: 100%" ></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>



@endsection
