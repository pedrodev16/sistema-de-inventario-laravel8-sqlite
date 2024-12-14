<div>

    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Lista de productos</h4>


            <div class="data-tables ">
                <table id="productos" style="width: 100%" class=" table table-bordered ">
                    <thead class="bg-light">
                        <tr>
                            <th>Codigo</th>
                            <th>imAgen de prod</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Us R</th>
                            <th scope="col">acc</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $lista)
                            @if ($lista->estado != 'off')
                                <tr>
                                    <td>{{ $lista->codigo }}</td>
                                    <td>
                                        <div>
                                            @if ($lista->imagen)
                                                <img style="width: 150px; height: 150px;"
                                                    src="{{ asset(str_replace('public', 'storage', $lista->imagen)) }}"
                                                    alt="Imagen del Producto">
                                            @else
                                                <p>No hay imagen disponible</p>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $lista->nombre }}</td>
                                    <td>{{ $lista->costo }}</td>
                                    <td>{{ $lista->user_m->name }}</td>

                                    <td>

                                        <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a href="#"
                                                    wire:click="editarProducto({{ $lista->id }})"
                                                    class="text-secondary"><i class="fa fa-edit"></i></a>
                                            </li>
                                            <li><a href="#" class="text-danger"><i class="ti-trash"></i></a></li>
                                        </ul>

                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
                @if (count($productos) < 1)
                    <div class="alert alert-info" role="alert">
                        NO TIENE PRODUCTOS REGISTRADOS
                    </div>
                @endif









                <script>
                    $(document).ready(function() {
                        $('#productos').DataTable({
                            "order": [
                                [0, "desc"]
                            ] // Ordenar por la primera columna (ID) en orden descendente
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
