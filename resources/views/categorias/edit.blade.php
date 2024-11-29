@extends('layout.app')

@section('title', 'registro')

@section('content')



    <style>
        .form {
            width: 450px;
        }
    </style>

    <div class="card text-center">

        <div class="card-body">



            <h1 class="text-center"> Editar Categoria</h1>

            <div class="container">
                <div class="row justify-content-center">


                    <form action="{{ route('categorias.update', $categorias->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('forms.categorias')

                        <button type="submit" class="btn btn-primary">Aplicar</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
