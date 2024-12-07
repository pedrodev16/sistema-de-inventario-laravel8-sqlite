@extends('layout.app')

@section('title', 'Bienvenido ')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                @livewire('productosventa.b-producto')
                @livewire('navegacion.menu.categorias')
                @livewire('navegacion.menu.marcas')


            </div>
            <div class="col-md-9">




                @livewire('productosventa.productos-list')
            </div>




        </div>

    </div>



@endsection
