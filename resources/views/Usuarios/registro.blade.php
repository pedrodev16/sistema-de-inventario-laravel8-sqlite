@extends('layout.app')

@section('title', 'registro')

@section('content')



    <style>
        .form {
            width: 450px;
        }
    </style>

    <li class="nav-item">
        <a class="nav-link " href="{{ route('usuarios.index') }}">Vorver</a>
    </li>

    <h1 class="text-center"> Registro</h1>

    <div class="container">
        <div class="row justify-content-center">

            @php

            @endphp
            <form class="form" method="post" action="{{ route('registro.store') }}">
                @csrf
                @include('forms.usuarios')

                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>

    </div>

@endsection
