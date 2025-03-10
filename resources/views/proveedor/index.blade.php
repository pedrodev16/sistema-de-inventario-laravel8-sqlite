@extends('layout.app')

@section('title', 'proveedores')

@section('content')


    <div class="row">
        <div class="col-md-9">
            @livewire('proveedores.proveedores-list')
        </div>
        <div class="col-md-3">
            @if (session('error'))
                <div class="alert alert-danger"> {{ session('error') }} </div>
            @endif

            @livewire('proveedores.formulario-proveedor')


        </div>




    @endsection
