@extends('layout.app')

@section('title', 'Cuadre')

@section('content')


    <div class="row">
        <div class="col-md-12">
            @livewire('cuadre.cuadre')
        </div>
        <div class="col-md-3">
            @if (session('error'))
                <div class="alert alert-danger"> {{ session('error') }} </div>
            @endif

            {{-- @livewire('empresa.formulario-empresa') --}}


        </div>


    @endsection
