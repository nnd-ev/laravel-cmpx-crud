@extends('layout/app')
{{-- CREIRANJE POSTA --}}
@section('content')

<h1>Edit Post</h1>

    {{-- <form role="form" method="post" action="{{URL::to('/update/{{{ $post->id }}}')}}"> --}}
     {{-- <form role="form" method="post" action="{{ 'PostsController@update', $post->id }}"> --}}

     <form role="form" method="post" action="{{ route('posts.update',$post->id) }}">
        @csrf
        @method('PUT')      {{-- OBRATI PAZNJU NA OVO, OVO JE OBAVEZNO --}}
  <div class="form-group">
    <label for="title">Post title:</label>
    <input type="text" class="form-control" placeholder="Enter title" id="title" name="title" value="{{ $post->title }}">
  </div>
  <div class="form-group">
    <label for="pwd">Post Body:</label>
     <textarea name="body" class="form-control" id="article-ckeditor" rows="4" style="min-width: 100%" >{{ $post->body }}</textarea>
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
</form>



@endsection
