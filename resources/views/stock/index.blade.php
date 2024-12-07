@extends('layout.app')

@section('title', 'Bienvenido ')

@section('content')

    <div class="row">
        <div class="col-md-9">
            @livewire('stock.stock-list')
        </div>
        <div class="col-md-3">
            @if (session('error'))
                <div class="alert alert-danger"> {{ session('error') }} </div>
            @endif

            @livewire('stock.stockform')


        </div>





    </div>



@endsection
