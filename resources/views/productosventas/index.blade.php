@extends('layout.app')

@section('title', 'Bienvenido ')

@section('content')

    <div class="row">

        <div class="col-md-3">
            @livewire('productosventa.b-producto')
            @livewire('navegacion.menu.categorias')
            @livewire('navegacion.menu.marcas')


        </div>
        <div class="col-md-9">




            @livewire('productosventa.productos-list')




        </div>

    </div>



@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('mostrarError', mensaje => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: mensaje,
            });
        });



        Livewire.on('mostrarok', mensaje => {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: mensaje,
                showConfirmButton: false,
                timer: 1500
            });
        })
    </script>
@endsection
