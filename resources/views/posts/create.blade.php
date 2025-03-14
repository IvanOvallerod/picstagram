@extends('layouts.app')
@section('title')
    Crear un nuevo post
@endsection
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            {{-- <img src="{{ asset('img/crear-post.jpg') }}" alt="Imagen crear post" class="w-full h-full object-cover md:gap-10 p-5 md:items-center"> --}}
            imagen
            <form action="{{ route('images.store') }}" method="post" id="dropzone" enctype="multipart/form-data" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 px-10 bg-white p-10 rounded-lg shadow-xl mt-10 md:mt-10">
            <form action="{{ route('posts.store') }}" method="post" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">Título</label>
                    <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    placeholder="Título de la publicación:" 
                    class="border p-3 w-full rounded @error('title') border-red-500 @enderror"
                    value="{{ old('title') }}">
                    @error('title')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                    <textarea 
                    name="description" 
                    id="description" 
                    placeholder="Descripción de la publicación:" 
                    class="border p-3 w-full rounded @error('description') border-red-500 @enderror"
                    value="{{ old('description') }}">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <input 
                    type="hidden"
                    name="image"
                    id="image"
                    value="{{ old('image') }}"
                    />
                    @error('image')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <input 
                type="submit" 
                value="Crear post"
                class="bg-sky-600 hover:bg-sky-700 transition-colors transition-300 cursor-pointer
                uppercase font-bold w-full p-3 text-white rounded-lg" 
                >
            </form>
        </div>
    </div>
@endsection