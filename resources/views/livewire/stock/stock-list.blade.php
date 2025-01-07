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

                        @if (count($stock) == 0)
                            <tr>
                                <td colspan="7">No hay registros</td>
                            </tr>
                        @endif
                        @foreach ($stock as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->productos->nombre }}</td>
                                <!-- Usando 'producto' en singular -->
                                <td>{{ $item->cantidad }}</td>
                                <td>{{ $item->ubicacion }}</td>
                                <td>{{ $item->fecha_entrada }}</td>
                                <td>
                                    <div class="alert alert-{{ $item->estado == 'disponible' ? 'success' : 'danger' }}">
                                        {{ $item->estado }}
                                </td>
                                <td>
                                    <div style="flex: 0%; display: flex;">
                                        <!-- Agrega un div para que los botones no se vean tan juntos -->
                                        <button class="btn btn-sm btn-warning"
                                            wire:click="editStock({{ $item->id }})">Editar</button>
                                        <button class="btn btn-sm btn-info"
                                            onclick="toggleDetails({{ $item->id }})">Detalles</button>
                                    </div>
                                </td>

                            </tr>



                            <tr id="details-{{ $item->id }}" style="display: none; background-color: #17a2b836;">
                                <td colspan="7">
                                    <!-- Aquí puedes agregar más detalles del item -->
                                    <p>Descripción: {{ $item->productos->descripcion }}</p>
                                    <p>Proveedor: {{ $item->productos->proveedor->nombre }}</p>
                                    <p>Ubicación almacén: {{ $item->ubicacion2 }}</p>
                                    <p>Ubicación tienda: {{ $item->ubicacion }}</p>
                                    <!-- Agrega más campos según sea necesario -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function toggleDetails(id) {
            var detailsRow = document.getElementById('details-' + id);
            if (detailsRow.style.display === 'none') {
                detailsRow.style.display = 'table-row';
            } else {
                detailsRow.style.display = 'none';
            }
        }



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
