<div>
    <h2>Lista de Productos</h2>
    {{-- <table class="table">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->codigo }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>${{ $producto->costo }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" wire:click="agregarAlCarrito({{ $producto->id }})">Añadir
                            al Carrito</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}



    <div class="card">
        <div class="card-body">

            @if ($mensajeError)
                <div class="alert alert-danger">{{ $mensajeError }}</div>
            @endif
            @foreach ($productos as $producto)
                <div class="media">

                    <img style="width: 20%" class="img-fluid mr-4"
                        src="{{ asset(str_replace('public', 'storage', $producto->imagen)) }}" alt="">



                    <div class="media-body">
                        <div class="row">

                            <div class="col">
                                <h4 class="mb-3">{{ $producto->nombre }}</h4>
                                <p> P {{ $producto->costo }}$ /
                                    G.T {{ $producto->g_tienda }}$ /
                                    M.L {{ $producto->mercad_l }}$ /
                                    IVA {{ $producto->iva }}$</p>
                                <HR>
                                <p> {{ $producto->descripcion }}</p>

                                <span class="badge badge-pill badge-primary">{{ $producto->categorias->nombre }}</span>
                                <span class="badge badge-pill badge-secondary">{{ $producto->marcas->nombre }}</span>
                                <span class="badge badge-pill badge-success">{{ $producto->user_m->name }}</span>
                                Cod:<code>{{ $producto->codigo }}</code>
                            </div>
                            <div class="col">


                                <h3 class="mb-3"><br>{{ $producto->costo_venta_usd }}$<br>

                                    {{ $producto->costo_venta_bs }}Bs</h3>
                                <button class="btn btn-primary btn-sm"
                                    wire:click="agregarAlCarrito({{ $producto->id }})">Añadir
                                    al Carrito</button>
                            </div>
                        </div>

                    </div>



                </div>
                <hr>
            @endforeach
        </div>
    </div>


</div>
