<div>
    <!-- Filtros -->
    <div class="card shadow-sm mb-4">
        <div class="card-body bg-light">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="codigo" class="form-label">Código:</label>
                    <input type="text" id="codigo" wire:model="codigo" class="form-control" placeholder="Código">
                </div>
                <div class="col-md-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" wire:model="nombre" class="form-control" placeholder="Nombre">
                </div>

                <div class="col-md-3">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select id="categoria" wire:model="categoria" class="form-select">
                        <option value="">Seleccione Categoría</option>
                        @foreach ($categorias as $categoriaa)
                            <option value="{{ $categoriaa->id }}">{{ $categoriaa->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="marca" class="form-label">Marca:</label>
                    <select id="marca" wire:model="marca" class="form-select">
                        <option value="">Seleccione Marca</option>
                        @foreach ($marcas as $marcaa)
                            <option value="{{ $marcaa->id }}">{{ $marcaa->nombre }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

        </div>
    </div>
    <form action="{{ route('catalagop') }}" method="post">
        @csrf
        <input hidden type="text" name="" value="{{ $nombre }}">
        <input hidden type="text" name="" value="{{ $categoria }}">
        <input hidden type="text" name="" value="{{ $marca }}">
        <input hidden type="text" name="" value="{{ $codigo }}">
        <button type="submit" class="btn btn-primary">
            catalogo de productos en PDF
        </button>

    </form>
    <div class="card">
        <div class="card-body">
            <h2>Lista de Productos</h2>
            @if ($mensajeError)
                <div class="alert alert-danger">{{ $mensajeError }}</div>
            @endif
            @if (count($productos) < 1)
                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">No tiene productos registrados</h4>
                    <p>Para registrar productos <a class="btn btn-info" href="{{ route('producto.index') }}">Aquí</a>
                    </p>
                    <hr />
                    <p class="mb-0">...</p>
                </div>
            @endif
            @foreach ($productos as $index => $producto)
                @if ($producto->stock->estado == 'disponible')
                    <div class="media mb-4 p-3 border rounded"
                        style="background:{{ $producto->stock->cantidad > 0 ? '#f6f8fb' : '#d3dfe1' }};">
                        <img style="width: 20%;" class="img-fluid mr-4 rounded"
                            src="{{ asset(str_replace('public', 'storage', $producto->imagen)) }}"
                            alt="Imagen de {{ $producto->nombre }}">

                        <div class="media-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="mb-3">{{ $producto->nombre }}</h4>
                                    <p>
                                       <strong>Precio:</strong> {{ $producto->costo }}$<br>
                                        <strong>Ganancia Tienda:</strong> {{ $producto->porcentaje_ganacia_tienda }}%:
                                         {{ $producto->ganancia }}<br>

                                        <strong>Mercado Libre:</strong> {{ $empresa[0]->porcentaje_mercadolibre }}%:

                                        {{ $producto->mercad_l }}$<br>

                                      <strong>IVA:</strong> {{ $empresa[0]->porcentaje_iva }}%:


                                        {{ $producto->iva }}$<br>
                                        <strong>Stock:</strong> {{ $producto->stock->cantidad }}<br>
                                        <strong>ub-tienda:</strong> {{ $producto->stock->ubicacion }},
                                        <strong>ub-almacén :</strong> {{ $producto->stock->ubicacion2 }}<br>

                                    </p>
                                    <hr>
                                    <div style="background: #ffffff; padding: 10px; border-radius: 10px;">
                                        <p>{{ $producto->descripcion }}</p>
                                        <style>
                                            .badge {
                                                color: #fff;
                                                height: 23px;
                                                box-shadow: #a49eb9 0px -1px 6px 1px;
                                                /* background-color: #6841ea; */
                                                /* border: #df5c5c solid 1px; */
                                                font-size: 12pt;
                                            }
                                        </style>
                                        <span class="badge badge-primary">{{ $producto->categorias->nombre }}</span>
                                        <span class="badge badge-secondary">{{ $producto->marcas->nombre }}</span>
                                        <span class="badge badge-success">{{ $producto->user_m->name }}</span>
                                        <span class="badge badge-warning">{{ $producto->proveedor->nombre }}</span>
                                        <br>
                                        <code>Cod: {{ $producto->codigo }}</code>
                                    </div>
                                </div>
                                <div class="col-md-4 text-right">
                                    <div class="mb-3">
                                        <input type="text" class="form-control mb-2"
                                            wire:model.defer="productos2.{{ $index }}.porcentaje_ganacia_tienda"
                                            value="{{ $producto->porcentaje_ganancia_tienda }}"
                                            placeholder="Ganancia Tienda">
                                        <button class="btn btn-info btn-sm"
                                            wire:click="actualizarPorcentaje({{ $index }})">Actualizar Ganancia
                                            Tienda</button>
                                        {{ $x }}
                                        @error('productos2.' . $index . '.porcentaje_ganacia_tienda')
                                            <span class="text-danger d-block mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <h3>
                                        <span class="text-primary">{{ $producto->costo_venta_usd }}$</span><br>
                                        <small class="text-muted">{{ $producto->costo_venta_bs }}Bs</small>
                                    </h3>
                                    @if ($producto->stock->cantidad > 0)
                                        <button class="btn btn-primary btn-sm mt-2"
                                            wire:click="agregarAlCarrito({{ $producto->id }})">Añadir al
                                            Carrito</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endif
            @endforeach
        </div>
    </div>
</div>
