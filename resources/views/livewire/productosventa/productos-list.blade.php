<div>





    <div class="card">
        <div class="card-body">
            <h2>Lista de Productos</h2>
            @if ($mensajeError)
                <div class="alert alert-danger">{{ $mensajeError }}</div>
            @endif
            @if (count($productos) < 1)
                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">No tiene productos registrados</h4>
                    <p>Para registrar productos <a class="btn btn-info" href="{{ route('producto.index') }}">Aqui</a> </p>
                    <hr />
                    <p class="mb-0">...</p>
                </div>
            @endif
            @foreach ($productos as $index => $producto)
                <div class="media mb-4 p-3 border rounded"
                    style="background:{{ $producto->stock->cantidad > 0 ? '#f6fbf' : '#d3dfe1' }} ;">
                    <img style="width: 20%;" class="img-fluid mr-4 rounded"
                        src="{{ asset(str_replace('public', 'storage', $producto->imagen)) }}"
                        alt="Imagen de {{ $producto->nombre }}">

                    <div class="media-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="mb-3">{{ $producto->nombre }}</h4>
                                <p>
                                    <strong>Precio:</strong> {{ $producto->costo }}$<br>
                                    <strong>Ganancia Tienda:</strong> {{ $producto->porcentaje_ganacia_tienda }}%<br>
                                    <strong>Mercado Libre:</strong> {{ $producto->mercad_l }}$<br>
                                    <strong>IVA:</strong> {{ $producto->iva }}$<br>
                                    <strong>Stock:</strong> {{ $producto->stock->cantidad }}
                                </p>
                                <hr>
                                <p>{{ $producto->descripcion }}</p>

                                <span class="badge badge-primary">{{ $producto->categorias->nombre }}</span>
                                <span class="badge badge-secondary">{{ $producto->marcas->nombre }}</span>
                                <span class="badge badge-success">{{ $producto->user_m->name }}</span>
                                <br>
                                <code>Cod: {{ $producto->codigo }}</code>
                            </div>
                            <div class="col-md-4 text-right">
                                <div class="mb-3">
                                    <input type="text" class="form-control mb-2"
                                        wire:model.defer="productos.{{ $index }}.porcentaje_ganacia_tienda"
                                        placeholder="Ganancia Tienda">
                                    <button class="btn btn-info btn-sm"
                                        wire:click="actualizarPorcentaje({{ $index }})">Actualizar Ganancia
                                        Tienda</button>
                                    @error('productos.' . $index . '.porcentaje_ganacia_tienda')
                                        <span class="text-danger d-block mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h3>
                                    <span class="text-primary">{{ $producto->costo_venta_usd }}$</span><br>
                                    <small class="text-muted">{{ $producto->costo_venta_bs }}Bs</small>
                                </h3>

                                @if ($producto->stock->cantidad > 0)
                                    <button class="btn btn-primary btn-sm mt-2"
                                        wire:click="agregarAlCarrito({{ $producto->id }})">Añadir al Carrito</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            @endforeach
        </div>
    </div>


</div>
