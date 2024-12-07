@extends('layout.app')

@section('title', 'marcas')

@section('content')


    <div class="row">
        <div class="col-md-9">
            @livewire('marcas.marcas-list')
        </div>
        <div class="col-md-3">
            @if (session('error'))
                <div class="alert alert-danger"> {{ session('error') }} </div>
            @endif

            @livewire('marcas.marcas-form')


        </div>













    @endsection
