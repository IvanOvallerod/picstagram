@extends('layouts.app')
@section('title')
    Editando perfil: {{ $user->username }}
@endsection
@section('content')
    <div class="md:flex md:justify-center">
        <div class="w-8/12 md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('profile.store', $user) }}" method="post" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input 
                    type="text" 
                    name="username" 
                    id="username" 
                    placeholder="Nombre de usuario:" 
                    class="border p-3 w-full rounded @error('username') border-red-500 @enderror"
                    value="{{ Auth::user()->username }}">
                    @error('username')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="profileimage" class="mb-2 block uppercase text-gray-500 font-bold">Foto de perfil</label>
                    <input 
                    accept="image/*"
                    type="file" 
                    name="profileimage" 
                    id="profileimage" 
                    placeholder="" 
                    class="border p-3 w-full rounded @error('profileimage') border-red-500 @enderror"
                    value="">
                    @error('profileimage')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <input 
                type="submit" 
                value="Guardar cambios"
                class="bg-sky-600 hover:bg-sky-700 transition-colors transition-300 cursor-pointer
                uppercase font-bold w-full p-3 text-white rounded-lg" 
                >
            </form>
        </div>
    </div>
@endsection