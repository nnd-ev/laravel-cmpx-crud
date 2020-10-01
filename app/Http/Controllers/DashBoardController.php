<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;


class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts= Post::orderBy('created_at', 'desc')->get();
        $user_id = auth()->user()->id;
        $user= User::find($user_id);
        // $user= User::find($user_id)->sortBy('created_at', 'desc');
        return view('dashboard')->with('posts', $user->posts);

        // return view('dashboard')->with('posts', $user->$posts);
    }



}
