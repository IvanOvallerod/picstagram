@extends('layouts.app')
@section('title')
    {{ $post->title }}
@endsection
@section('content')
    {{-- {{ var_dump($post); }} --}}
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('img/posts/').'/'.$post->image }}" alt="Imagen del post {{ $post->title }}">
            <div class="p-3 flex items-center gap-4">
                @auth
                @livewire('like-post', ['post'=>$post])
                {{-- <@livewire('component', ['user' => $user], key($user->id)) --}}
                {{-- @if ($post->checkLike(Auth::user()))
                    <form action="{{ route('posts.likes.destroy', $post) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <div class="my-4">
                            <button type="submit" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                @else
                    <form action="{{ route('posts.likes.store', $post) }}" method="post">
                        @csrf
                        <div class="my-4">
                            <button type="submit" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                @endif --}}
                @endauth
                {{-- <p class="font-bold">
                    {{ $post->likes->count() }}
                    <span class="font-normal ml-1">{{ ($post->likes->count()>1)?'Likes':'Like' }}</span>
                </p> --}}
            </div>
            <div>
                <p class="font-bold">{{ $post->user->name }} - {{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>
            @auth
                @if ($post->user_id === Auth::id())
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @method('DELETE') {{-- method spoofing --}}
                    @csrf
                    <input type="submit" 
                    value="Eliminar post"
                    class="bg-red-500 hover:bg-red-700 p-2 rounded text-white font-bold mt-4 cursor-pointer transition"
                    >
                </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white rounded-2xl py-3 px-6">
                <p class="text-xl font-bold tex-center mb-4">
                    Comentarios
                </p>
                @auth
                @if (session('message'))
                    <div class="bg-green-500 text-white py-1 text-center font-bold rounded mb-0.5">
                        {{ session('message') }}
                    </div>
                @endif
                <form action="{{ route('comments.store', ['user' => $user,'post' => $post]) }}" method="post">
                    @csrf
                    <div class="mb-5">
                        <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">Añade un comentario...</label>
                        <input 
                        type="text" 
                        name="comment" 
                        id="comment" 
                        placeholder="Agrega un comentario:" 
                        class="border p-2 w-full rounded border-gray-300 @error('comment') border-red-500 @enderror"
                        value="{{ old('comment') }}">
                        @error('comment')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <input 
                    type="submit" 
                    value="Comentar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors transition-300 cursor-pointer
                    uppercase font-bold w-full p-2 text-white rounded-lg" 
                    >
                </form>
                @endauth
                <div class="bg-white shadow mb-5 overflow-y-scroll">
                    @if ($post->comments->count() > 0 )
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comment->user) }}" class="font-bold">{{ $comment->user->username }}</a>
                                <p>{{ $comment->comment }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans(); }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center text-gray-400">Aún no hay comentarios en esta publicación...</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection