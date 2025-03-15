@extends('layouts.app')

@section('title')
    Registrarme en Picstagram
@endsection

@section('content')
    <div class="md:flex md:justify-center md:items-center">
        <div class="md:w-6/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro usuario" class="w-full h-full object-cover md:gap-10 p-5 md:items-center">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('create-account-submit') }}" method="post" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    placeholder="Tu nombre:" 
                    class="border p-3 w-full rounded @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}">
                    @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Nombre de usuario</label>
                    <input 
                    type="text" 
                    name="username" 
                    id="username" 
                    placeholder="Tu nombre de usuario:" 
                    class="border p-3 w-full rounded @error('username') border-red-500 @enderror"
                    value="{{ old('username') }}">
                    @error('username')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
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
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmar password</label>
                    <input 
                    type="password_confirmation" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    placeholder="Confirma Password:" 
                    class="border p-3 w-full rounded @error('password_confirmation') border-red-500 @enderror">
                    @error('password_confirmation')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <input 
                type="submit" 
                value="Crear cuenta"
                class="bg-sky-600 hover:bg-sky-700 transition-colors transition-300 cursor-pointer
                uppercase font-bold w-full p-3 text-white rounded-lg" 
                >
            </form>
        </div>
    </div>
@endsection