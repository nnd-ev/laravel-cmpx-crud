<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
// use Illuminate\Support\Facades\DB; --preko query buildera

class PostsController extends Controller
{

    public function index()
    {
        // $posts= Post::all();
        // $posts= Post::where('title', 'Post Two')->get();
        // $posts= DB::select('SELECT * FROM posts'); --preko query buildera
        // $posts= Post::orderBy('title', 'desc')->paginate(1); --one per page

        $posts= Post::orderBy('created_at', 'desc')->get();
        return view('posts/index')->with('posts', $posts);
    }


    public function create()
    {
        return view('posts/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
        ]);
        //create new post
        $post=new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $post->save();
        return redirect('/posts')->with('success', 'Post created');
    }
    //prosledjujem id preko linka ahref="id" iz index.blade.php
    //prikaz samo jednog posta
    public function show($id)
    {
         $post= Post::find($id);
         return view('posts/show')->with('post', $post);
    }

    //edituj post --> prosledjivanje na edit stranu
    public function edit($id)
    {
        $post= Post::find($id);
        return view('posts/edit')->with('post', $post);
    }

    // update post
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
        ]);
        //create new post
        $post= Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $post->save();
        return redirect('/posts')->with('success', 'Post Updated');
    }


    public function destroy($id)
    {
        // Post::find($id)->delete();
        $post= Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }

}
