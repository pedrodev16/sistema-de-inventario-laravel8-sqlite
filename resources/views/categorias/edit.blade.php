@extends('layout.app')

@section('title', 'registro')

@section('content')



    <style>
        .form {
            width: 450px;
        }
    </style>

    <li class="nav-item">
        <a class="nav-link " href="{{ route('categorias.index') }}">Vorver</a>
    </li>

    <h1 class="text-center"> <em>ditar Usuario Admin</em></h1>

    <div class="container">
        <div class="row justify-content-center">


            <form action="{{ route('categorias.update', $categorias->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('forms.categorias')

                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>

    </div>

@endsection
