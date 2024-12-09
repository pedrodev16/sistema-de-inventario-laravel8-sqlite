@extends('layout.app')

@section('title', 'Empresa')

@section('content')


    <div class="row">
        <div class="col-md-9">
            @livewire('empresa.empresa-list')
        </div>
        <div class="col-md-3">
            @if (session('error'))
                <div class="alert alert-danger"> {{ session('error') }} </div>
            @endif

            @livewire('empresa.formulario-empresa')


        </div>













    @endsection
