<?php

namespace App\Http\Controllers\Auth;

use Stringable;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);
        // dd($request->all());
        // dd($request->get('name'));

        // Reescribir el username
        $request->request->add([
            'username' => Str::slug($request->username),
        ]);

        // Validación
        $request->validate([
            'name' => 'required|min:3|max:40',
            'username' => 'required|min:3|max:20|unique:users',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|confirmed|min:1',
        ]);
        // if(!$request->validate()){  $request->request->add([ 'username' => $request->username ]); }
        // dd('Creando Usuario...');
        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            // 'password' => bcrypt($request->password),
            'password' => Hash::make($request->password),
        ]);
        // Auntenticación
        // auth()->attempt($request->only('email', 'password'));

        Auth::attempt($request->only('email', 'password'));

        // Redirección
        // return redirect('create-account')->with('status', 'Usuario creado con éxito');
        // return redirect()->route('posts.index');
        return redirect()->route('posts.index', Auth::user()->username);

    }
}
