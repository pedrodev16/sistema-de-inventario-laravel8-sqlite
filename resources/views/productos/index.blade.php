@extends('layout.app')

@section('title', 'registro')

@section('content')



    <div class="row">
        <div class="col-md-9">
            @livewire('product.productos-list')
        </div>
        <div class="col-md-3">
            @if (session('error'))
                <div class="alert alert-danger"> {{ session('error') }} </div>
            @endif

            @livewire('product.formulario-product')



        </div>



    </div>



@endsection
