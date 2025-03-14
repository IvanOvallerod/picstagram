<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function store(Request $request, User $user)
    {
        // dd('follow', $user->username);
        $user->followers()->attach( Auth::id() );
        return back();
    }

    public function destroy(Request $request, User $user)
    {
        // dd('unfollow', $user->username);
        $user->followers()->detach( Auth::id() );
        return back();
    }
}
