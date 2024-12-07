@extends('layout.app')

@section('title', 'categorias ')

@section('content')


    <div class="row">
        <div class="col-md-9">
            @livewire('categorias.categorias-list')
        </div>
        <div class="col-md-3">
            @if (session('error'))
                <div class="alert alert-danger"> {{ session('error') }} </div>
            @endif

            @livewire('categorias.categorias-form')


        </div>



    @endsection
