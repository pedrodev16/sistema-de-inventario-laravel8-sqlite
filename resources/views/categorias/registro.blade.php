@extends('layout.app')

@section('title', 'registro')

@section('content')



    <style>
        .form {
            width: 450px;
        }
    </style>


    <h3 class="text-center mt-5"> Registro De Categoria</h3>

    <div class="container">
        <div class="row justify-content-center">

            @php

            @endphp
            <form class="form" method="post" action="{{ route('categorias.store') }}">
                @csrf
                @include('forms.categorias')

                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>

    </div>

@endsection
