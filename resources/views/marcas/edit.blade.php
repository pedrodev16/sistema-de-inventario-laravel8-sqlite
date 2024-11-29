@extends('layout.app')

@section('title', 'registro')

@section('content')



    <style>
        .form {
            width: 450px;
        }
    </style>

    <li class="nav-item">
        <a class="nav-link " href="{{ route('marcas.index') }}">Vorver</a>
    </li>

    <h1 class="text-center"> <em>ditar marcas</em></h1>

    <div class="container">
        <div class="row justify-content-center">


            <form action="{{ route('marcas.update', $marcas->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('forms.marcas')

                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>

    </div>

@endsection
