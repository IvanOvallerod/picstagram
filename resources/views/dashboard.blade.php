@extends('layouts.app')
@section('title')
    Perfil de {{ $user->username }}
@endsection

@section('content')
{{-- {{ $user }} --}}
<div class="flex justify-center">
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col md:flex-row items-center justify-center md:justify-center py-10 md:py-10">
        <div class="w-8/12 lg:w-6/12 px-5 flex items-center md:items-center justify-center md:justify-center py-10 md:py-10">
            {{-- <img src="{{ (strlen(trim($user->profileimage)) > 0 )?asset('img/profiles/'.$user->profileimage):asset('img/usuario.svg') }}" alt="Imagen Usuario" class="rounded-full"> --}}
            {{-- <img src="{{ ( $user->profileimage )?asset('img/profiles/'.$user->profileimage):asset('img/usuario.svg') }}" alt="Imagen Usuario" class="rounded-full"> --}}
            <img src="{{ ( $user->profileimage )?asset('img/profiles/'.$user->profileimage):asset('img/usuario.svg') }}" alt="Imagen Usuario" class="rounded-full">
        </div>
        <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start justify-center py-10 md:py-10">
            {{-- {{ dd($user) }} --}}
            {{-- <p class="text-gray-700 text-2xl">{{ Auth::user()->username }}</p> --}}
            <div class="flex flex-row items-center justify-center gap-2 mb-5">
                <p class="text-gray-700 text-2xl flex flex-row items-center justify-center">{{ $user->username }}</p>
                @auth
                    @if ($user->id === Auth::id())
                        <a href="{{ route('profile.index', Auth::user()) }}" class="flex flex-row items-center justify-center text-gray-500 hover:text-gray-700 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                    @endif
                @endauth
            </div>
            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->followers()->count() }}
                <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers()->count())</span>
            </p>
            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->followings()->count() }}
                <span class="font-normal">Siguiendo</span>
            </p>
            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->posts()->count() }}
                <span class="font-normal">Posts</span>
            </p>
            @auth
            @if ($user->id !== Auth::id())
            @if (! $user->isFollowing(Auth::user()))
            <form action="{{ route('user.follow', $user) }}" method="post">
                @csrf
                <input type="submit" value="Follow" class="bg-blue-600 hover:bg-blue-500 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold">
            </form>
            @else
            <form action="{{ route('user.unfollow', $user) }}" method="post">
                @method('DELETE')
                @csrf
                <input type="submit" value="Unfollow" class="bg-red-600 hover:bg-red-500 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold">
            </form>
            @endif
            @endauth
            @endif
        </div>
    </div>
</div>

<section class="container mx-auto mt-10">
    <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
    {{-- Componente --}}
    <x-posts-list :posts="$posts"/>
</section>
@endsection