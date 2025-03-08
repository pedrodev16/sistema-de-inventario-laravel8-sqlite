@extends('layout.app')

@section('title', 'Bienvenido ')

@section('content')

    {{-- <h1 class="text-center"> Bienvenido {{ $user->name }}</h1>
    Nivel {{ $user->tipoAdmin->tipo }} --}}

<style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
        }

        .sidebar a {
            color: white;
        }

        .header {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }

        .content {
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card-title {
            font-size: 1.25rem;
        }

        .chart {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
 <div class="content">
                    <h4 class=" my-4">{{$hoy['dia']}} de {{$hoy['mes']}} del {{$hoy['ano']}}</h4>

                    <div class="row text-center">

                        <div class="col-md-3">
                            <div class="card" style="background-color: #28a745; color: white;">
                                <div class="card-body">
                                    <h5 class="card-title">VENTAS</h5>
                                   <h1 class="card-text">{{ $ventasdeldia}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">TOTAL</h5>
                                    <h1 class="card-text">{{ $totalventas }}$</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h5 class="card-title">GANANCIAS</h5>
                                   <h1 class="card-text">  {{ $ganancias }}$</h1>
                                </div>
                            </div>
                        </div>
                    </div>
<hr>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="chart">
                                <h5>Productos con stock mínimo</h5>
                                <!-- Aquí puedes añadir un gráfico usando librerías como Chart.js -->



  @foreach ($bajostock as $stock)
                    <a href="#" class="notify-item">
                        <div class="notify-thumb">

                            <img src="{{ asset(str_replace('public', 'storage', $stock->productos->imagen)) }}"
                                alt="image">

                        </div>
                        <div class="notify-text">

                            @if ($stock->cantidad > 0)
                                <div class="alert alert-warning">
                                    <p>El producto <strong>{{ $stock->productos->nombre }}</strong> tiene una cantidad
                                        baja:
                                        <strong>{{ $stock->cantidad }}</strong>
                                    </p>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <p>El producto <strong>{{ $stock->productos->nombre }}</strong>
                                        esta agotado
                                        <strong>agotado</strong>
                                    </p>
                                </div>
                            @endif


                        </div>
                    </a>
                @endforeach











                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="chart">
                                <h5>Los 20 Productos más vendidos</h5>
                                <!-- Aquí puedes añadir un gráfico usando librerías como Chart.js -->

                                @foreach ($masvendidos as $producto)
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb">

                                            <img src="{{ asset(str_replace('public', 'storage', $producto->producto->imagen)) }}"
                                                alt="image">

                                        </div>
                                        <div class="notify-text">
                                            <div class="alert alert-success">
                                                <p>El producto <strong>{{ $producto->producto->nombre }}</strong> ha sido vendido
                                                    <strong>{{ $producto->total_cantidad }}</strong> veces
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
<hr>
    <div class="row">



        <div class="col-md-12">
            @livewire('dashbord.grafico-ventas')
        </div>

        <div class="col-md-12">
            @livewire('dashbord.metodopago-grafico')
        </div>

        <div class="col-md-6 mt-5 mb-3">
            <div class="card">


                {{-- <div class="seo-fact sbg1">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon">PRODUCTOS ACTIVOS </div>
                        <h2>2</h2>
                    </div>

                </div> --}}
            </div>
        </div>

    </div>
@endsection
