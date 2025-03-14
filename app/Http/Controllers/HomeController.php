<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as Controller;

class HomeController extends Controller
{
    public function __construct()
    {  
        $this->middleware('auth');
    }
    public function __invoke() 
    {
        // dd('Home');
        // dd(Auth::user()->followings->pluck('id')->toArray());
        $following_ids =  Auth::user()->followings->pluck('id')->toArray();
        // $posts = Post::whereIn('user_id' ,$following_ids)->orderBy('id','desc')->paginate(10);
        $posts = Post::whereIn('user_id' ,$following_ids)->latest()->paginate(10);
        // dd($posts);
        return view('home', [
            'posts' => $posts,
        ]);
    }
}
