<div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2>Carrito de Compras</h2>

    @if (count($carrito) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carrito as $index => $item)
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td>
                            <input type="number" min="1" class="form-control"
                                wire:model.lazy="carrito.{{ $index }}.cantidad"
                                wire:change="actualizarCantidad({{ $index }}, $event.target.value)">
                        </td>
                        <td>{{ $item['precio'] }}</td>
                        <td>{{ $item['subtotal'] }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm"
                                wire:click="eliminarProductoDelCarrito({{ $index }})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-primary" wire:click="realizarVenta">Realizar Venta</button>
    @else
        <p>No hay productos en el carrito.</p>
    @endif
</div>
