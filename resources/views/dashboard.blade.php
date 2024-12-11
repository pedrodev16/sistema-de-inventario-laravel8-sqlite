@extends('layout.app')

@section('title', 'Bienvenido ')

@section('content')

    <h1 class="text-center"> Bienvenido {{ $user->name }}</h1>
    Nivel {{ $user->tipoAdmin->tipo }}




    <div class="row">



        <div class="col-md-12">
            @livewire('dashbord.grafico-ventas')
        </div>

        <div class="col-md-12">
            @livewire('dashbord.metodopago-grafico')
        </div>

        <div class="col-md-6 mt-5 mb-3">
            <div class="card">


                <div class="seo-fact sbg1">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon">PRODUCTOS ACTIVOS </div>
                        <h2>2</h2>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
