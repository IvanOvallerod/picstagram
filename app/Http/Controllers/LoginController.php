<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    public function index()
    {
        // return view('posts.index');
        // dd('Muro de publicaciones');
        // dd(Auth::user());
        return view('auth.login');
    }

    public function store(Request $request){
        // dd('Auntenticando...');
        $request->validate([
            'email' => 'required|min:1|email|string',
            'password' => 'required|min:1|string'
        ]);
        // dd($request->all());
        if(! Auth::attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('message', 'Las credenciales proporcionadas no coinciden con nuestros registros');
        }

        return redirect()->route('posts.index', Auth::user()->username);

        // request()->session()->regenerate();


        // $credentials = $request->validate([
        //     'email' => 'required|min:1|email|string',
        //     'password' => 'required|min:1|string'
        // ]);

        // if(Auth::attempt($credentials)){
        //     request()->session()->regenerate();
        //     return redirect()->route('dashboard');
        // }

        // return back()->withErrors([
        //     'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros',
        // ]);
    }
}
