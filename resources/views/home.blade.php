@extends('layouts.app')

@section('titulo')
    pagina Principal

@endsection


@section('contenido')
    <x-listar-post :posts="$posts" />
   
@endsection