@extends('layout.app')

@section('title', 'marcas')

@section('content')





    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Tabla de Marcas</h4>
                        <a class="btn btn-rounded btn-primary mb-3" href="{{ url('marcas/create') }}">Nuevo Registro</a>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="data-tables">
                            <table id="dataTable" style="width: 100%" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>id</th>
                                        <th>Nombre</th>
                                        <th>dia de reg</th>
                                        <th>User R</th>
                                        <th>acc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($marcas as $lista)
                                        @if ($lista->estado != 'off')
                                            <tr>
                                                <td>{{ $lista->id }}</td>
                                                <td>{{ $lista->nombre }}</td>
                                                <td> {{ $lista->created_at }} </td>
                                                <td>{{ $lista->user_m->name }}</td>
                                                <td>
                                                    <div class="row">
                                                        <a name="" id="" class="btn btn-primary"
                                                            href="{{ url('marcas/' . $lista->id . '/edit') }}"
                                                            role="button">Edit</a>
                                                        <form method="post"
                                                            action="{{ route('marcas.destroy', $lista->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">DEL</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>












@endsection
