<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function index()
    {
        dd('Cerrando sesión...');
        Auth::logout();
        return redirect()->route('login');
    }

    public function store(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
