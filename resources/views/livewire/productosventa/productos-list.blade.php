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
            @foreach ($productos as $producto)
                <div class="media">

                    <img style="width: 20%" class="img-fluid mr-4"
                        src="{{ asset(str_replace('public', 'storage', $producto->imagen)) }}" alt="">



                    <div class="media-body">
                        <div class="row">

                            <div class="col">
                                <span class="badge badge-pill badge-primary">{{ $producto->categorias->nombre }}</span>
                                <span class="badge badge-pill badge-secondary">{{ $producto->marcas->nombre }}</span>
                                <span class="badge badge-pill badge-success">{{ $producto->user_m->name }}</span>
                                <h4 class="mb-3">{{ $producto->nombre }}</h4>
                                Cod:<code>{{ $producto->codigo }}</code>
                                <p> {{ $producto->descripcion }}</p>


                            </div>
                            <div class="col">
                                <h5 class="mb-3">Precio:{{ $producto->costo }}$</h5>
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
