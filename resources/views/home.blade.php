@extends('layouts.app')

@section('title')
    Pagina Principal
@endsection

@section('content')
    {{-- Componente --}}
    <x-posts-list :posts="$posts"/>
    {{-- // Ejemplo de slots en components --}}
    {{--<x-posts-list>
         <x-slot:title>
            Este es un header
        </x-slot:title>
            <h1>Mostrando desde slot</h1>
    </x-posts-list> --}}
@endsection