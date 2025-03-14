<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PostController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(['auth'])->except(['show','index']);
    }
    
    public function index(User $user)
    {
        // return view('posts.index');
        // dd('Muro de publicaciones');
        // dd(Auth::user());
        // dd($user['username']);

        // $post = Post::where('user_id', $user->id)->get();
        $post = Post::where('user_id', $user->id)->paginate(10);
        // $post = Post::where('user_id', $user->id)->simplePaginate(10);
        // dd($post);
        return view('dashboard', [
            'user' => $user,
            'posts' => $post,
        ]);
    }

    public function create()
    {
        // dd('Creando publicación...');
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // dd('Almacenando publicación...');
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'image' => 'required',
        ]);

        // Post::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'user_id' => Auth::user()->id,
        // ]);
        // Otra forma de guardar registros
        // $post = new Post;
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->image = $request->image;
        // $post->user_id = Auth::id();
        // $post->save();

        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('posts.index', Auth::user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show', [
            'user' => $user,
            'post' => $post,
        ]);
    }

    public function destroy(Post $post){
        // dd('Eliminando', $post->id);
        $this->authorize('delete', $post);
        // $policy = new PostPolicy 
        // $policy->authorize('delete', $post);
        $post->delete();
        // Eliminar la imagen 
        $imagen_path = public_path('img/posts/'.$post->image);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        return redirect()->route('posts.index', Auth::user()->username);
    }
}