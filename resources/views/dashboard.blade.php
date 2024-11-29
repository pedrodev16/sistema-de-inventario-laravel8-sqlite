@extends('layout.app')

@section('title', 'Bienvenido ')

@section('content')

    <h1 class="text-center"> Bienvenido {{ $user->name }}</h1>
    Nivel {{ $user->tipoAdmin->tipo }}

@endsection
