<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
// use Illuminate\Support\Facades\DB; --preko query buildera

class PostsController extends Controller
{
    // kreiranje middleware (restrikcija pristupa odre]enim stanicam)
    public function __construct(){
        $this->middleware('auth', ['except' =>['index', 'show']]); // stranice kojima dozvoljavam pristup
    }

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
            'cover_image'=>'image|nullable|max:1999|',
        ]);




        // php artisan storage:link
            // kreira storage folder gde ce se cuvati slike

        //Handle FILE UPLOAD
            if($request->hasFile('cover_image')){   // cover_image je name="cover_image" u formi
                $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
             }else{
                $fileNameToStore = 'noimage.jpg';
            }


        //create new post
        $post=new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id; //dodavanje korisnika koji je napisao post
        $post->cover_image= $fileNameToStore;

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

        //provera da li je korisnik registrovan
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('posts/edit')->with('post', $post);
    }

    // update post
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
        ]);




        //Handle FILE UPLOAD
        if($request->hasFile('cover_image')){   // cover_image je name="cover_image" u formi
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }


        //create new post
        $post= Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }


        $post->save();
        return redirect('/posts')->with('success', 'Post Updated');
    }


    public function destroy($id)
    {
        // Post::find($id)->delete();
        $post= Post::find($id);

      //provera da li je korisnik registrovan
      if(auth()->user()->id != $post->user_id){
        return redirect('/posts')->with('error', 'Unauthorized Page');
    }

    //obrisi sliku ukoliko nije default (noimage.jpg)
    if($post->cover_image != 'noimage.jpg'){
        //use Illuminate\Support\Facades\Storage; --> dodato
        Storage::delete('public/cover_images/'.$post->cover_image);
    }


        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }

}
