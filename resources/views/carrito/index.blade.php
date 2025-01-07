@extends('layout.app')

@section('title', 'Carrito')

@section('content')

    @livewire('carrito.carrito')


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
