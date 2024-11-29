@extends('layout.app')

@section('title', 'Bienvenido ')

@section('content')

    <h1 class="text-center">USUARIOS</h1>

    <li class="nav-item">
        <a class="nav-link " href="{{ route('registro.index') }}">Registro</a>
    </li>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($usuarios as $lista)
        @if ($lista->estado != 'off')
            {{ $lista->name }}
            {{ $lista->tipoAdmin->tipo }}

            <a name="" id="" class="btn btn-primary" href="{{ route('Usuario.edit', ['id' => $lista->id]) }}"
                role="button">Edit</a>
            <a name="" id="" class="btn btn-danger" href="{{ route('Usuario.del', ['id' => $lista->id]) }}"
                role="button">Del</a>

            <hr>
        @endif
    @endforeach
@endsection
