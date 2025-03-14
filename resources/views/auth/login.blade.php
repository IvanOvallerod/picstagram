@extends('layouts.app')

@section('title')
    Iniciar sesión en DevStagram
@endsection

@section('content')
    <div class="md:flex md:justify-center md:items-center">
        <div class="md:w-6/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro usuario" class="w-full h-full object-cover md:gap-10 p-5 md:items-center">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('login') }}" method="post" novalidate>
                @if (session('message'))
                    <div class="bg-red-500 text-white p-3 text-center mb-5 rounded-2xl">
                        {{ session('message') }}
                    </div>
                    
                @endif
                @csrf
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input 
                    type="text" 
                    name="email" 
                    id="email" 
                    placeholder="Tu email:" 
                    class="border p-3 w-full rounded @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    placeholder="Password de registro:" 
                    class="border p-3 w-full rounded @error('password') border-red-500 @enderror">
                    @error('password')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="text-gray-500 text-sm">Mantener sesión abierta</label>
                </div>

                <input 
                type="submit" 
                value="Iniciar sesión"
                class="bg-sky-600 hover:bg-sky-700 transition-colors transition-300 cursor-pointer
                uppercase font-bold w-full p-3 text-white rounded-lg" 
                >
            </form>
        </div>
    </div>
@endsection