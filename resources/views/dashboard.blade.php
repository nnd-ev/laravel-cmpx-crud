@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <h3>Your Blog Posts</h3>
                        <a href="/posts/create" class="btn btn-primary">Create Post</a><Br>

                            @if(count($posts) > 0)
                        <table class="table table-striped">

                            <tr>
                            <th>Title</th>
                            <th>Update</th>
                            <th>Delete</th>
                            </tr>
                            @foreach($posts as $post)
                            <tr>
                            <td><a href="/posts/{{ $post->id }}" >{{ $post->title }}</a></td>
                            <td><a href="/posts/{{ $post->id }}/edit" class="btn btn-dark">Edit</a></td>

                            <td><form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            {{-- <a href="" class="btn btn-danger">Delete</a> --}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form></td>
                            </tr>
                            @endforeach

                        </table>
                        <i>Number of posts: {{ count($posts) }}</i>

                            @else
                            <p>You have no posts</p>
                            @endif


                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
