<div>
    <div class="card">
        <div class="card-body">
            <div class="container ">
                <h1>Lista de Stock</h1>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-striped" id="stockTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Ubicación</th>
                            <th>Fecha de Entrada</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stock as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->productos->nombre }}</td>
                                <!-- Usando 'producto' en singular -->
                                <td>{{ $item->cantidad }}</td>
                                <td>{{ $item->ubicacion }}</td>
                                <td>{{ $item->fecha_entrada }}</td>
                                <td>{{ $item->estado }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning"
                                        wire:click="editStock({{ $item->id }})">Editar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#stockTable')
                .DataTable({
                    "order": [
                        [0, "desc"]
                    ]
                    // Ordena por la primera columna (ID) en orden descendente 
                });
        });
    </script>
</div>
