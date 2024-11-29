@extends('layout.app')

@section('title', 'marcas')

@section('content')

    <h1 class="text-center">Marca</h1>

    <li class="nav-item">
        <a class="nav-link " href="{{ route('marcas.create') }}">Registro</a>
    </li>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($marcas as $lista)
        @if ($lista->estado != 'off')
            {{ $lista->nombre }}
            {{ $lista->user_m->name }}



            <a name="" id="" class="btn btn-primary" href="{{ url('marcas/' . $lista->id . '/edit') }}"
                role="button">Edit</a>
            <form method="post" action="{{ route('marcas.destroy', $lista->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DEL</button>
            </form>



            <hr>
        @endif
    @endforeach
@endsection
