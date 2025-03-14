<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommmentsController extends Controller
{
    public function store(Request $request, User $user, Post $post){
        // dd('Comentario...');
        $request->validate([
            'comment' => 'required|max:255'
        ]);
        Comments::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'comment' => $request->comment,
        ]);
        return back()->with('message', 'Comentario realizado');
    }
}