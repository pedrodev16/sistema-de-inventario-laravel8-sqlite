<div>



    <!-- data table start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Tabla de Usuarios</h4>

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
                            @foreach ($usuarios as $lista)
                                @if ($lista->estado != 'off')
                                    <tr>
                                        <td>{{ $lista->id }}</td>
                                        <td>{{ $lista->name }}</td>
                                        <td> {{ $lista->created_at }} </td>
                                        <td> {{ $lista->tipoAdmin->tipo }}
                                        </td>
                                        <td>
                                            <div class="row">
                                                <button class="btn btn-warning btn-sm"
                                                    wire:click="editarUsuario({{ $lista->id }})">Editar</button>

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
