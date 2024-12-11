@extends('layout.app')

@section('title', 'Ventas')

@section('content')

    <div class="row">
        <div class="col-md-9">
            @livewire('ventas.ver-ventas')
        </div>
        <div class="col-md-3">
            @if (session('error'))
                <div class="alert alert-danger"> {{ session('error') }} </div>
            @endif

            {{-- / @livewire('usuarios.formulario-usuarios') --}}


        </div>



    </div>





@endsection
