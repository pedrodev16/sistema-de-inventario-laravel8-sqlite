@extends('layout.app')

@section('title', 'registro')

@section('content')



    <style>
        .form {
            width: 450px;
            padding: 0%;
        }
    </style>

    <li class="nav-item">
        <a class="nav-link " href="{{ route('proveedor.index') }}">Vorver</a>
    </li>

    <h1 class="text-center"> <em>ditar marcas</em></h1>

    <div class="container">
        <div class="row justify-content-center">


            <form action="{{ route('proveedor.update', $proveedor->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('forms.proveedores')

                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>

    </div>

@endsection
