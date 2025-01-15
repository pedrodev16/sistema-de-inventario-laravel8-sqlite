<div class=" mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($mensajeError)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $mensajeError }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h2 class="mb-4">Carrito de Compras</h2>

            @if (count($carrito) > 0)
                <table id="dataTable" class="table table-bordered table-hover">
                    <thead class="table-dark">
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
                                <td>
                                    <h4 style="color: #9fa0a3"><strong
                                            style="color: #0a0a0a">{{ $item['precio'] }}$</strong>
                                        ({{ $this->convertir_a_bs($item['precio']) }} BS)
                                    </h4>
                                </td>
                                <td>
                                    <h4 style="color: #9fa0a3"><strong
                                            style="color: #0a0a0a">{{ $item['subtotal'] }}$</strong>
                                        ({{ $this->convertir_a_bs($item['subtotal']) }} BS)</h4>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm"
                                        wire:click="eliminarProductoDelCarrito({{ $index }})">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="background: rgb(238, 248, 248)"
                    class="row justify-content-center align-items-center g-4 mt-4">
                    <div class="col-md-4">
                        <style>
                            .total-dolares {
                                color: green;
                                font-weight: bold;
                            }

                            .total-bolivares {
                                color: blue;
                                font-weight: bold;
                            }
                        </style>

                        <h4 class="text-center">Total del Carrito:
                        </h4>
                        <h4 class="total-dolares mb-3">
                            {{ number_format($totalCarrito, 2, ',', '.') }}$
                        </h4>
                        <h4 class="total-bolivares mb-3">{{ $this->convertir_a_bs($totalCarrito) }} Bs</h4>

                    </div>
                    <div class="col-md-4" style="background: #d3dcef;box-shadow: inset #5d5859 -1px 0px 20px;">
                        <h3 class="mb-3">Métodos de Pago</h3>
                        <div class="mb-3">
                            @foreach ($metodosPago as $metodo)
                                <p><strong>{{ $metodo['metodo'] }}:</strong> {{ $metodo['monto'] }}$</p>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <caption>Seleccione un método de pago y luego ingrese el monto pagado.</caption>
                            <select wire:model="metodoPago" class="form-select form-control mb-2">
                                <option value="" selected>Seleccione un Método de Pago</option>
                                <option value="pagomovil">Pago Móvil</option>
                                <option value="punto_de_venta">Punto de Venta</option>
                                <option value="transferencias">Transferencia</option>
                                <option value="efectivousd">Efectivo USD</option>
                                <option value="efectivobs">Efectivo BS</option>
                                <option value="paypal">Paypal</option>
                                <option value="zelle">Zelle</option>
                            </select>
                            <caption>Ingrese el monto pagado en usd.</caption>
                            <input type="number" wire:model="montoPago" placeholder="Monto Pagado en USD"
                                class="form-control">
                        </div>
                        <button class="btn btn-success" wire:click="agregarMetodoPago">Agregar Pago</button>
                    </div>
                    <div class="col-md-4 text-center">
                        @if ($this->calcularTotalPagado() >= $totalCarrito)
                            <button class="btn btn-primary btn-lg" wire:click="realizarVenta">Finalizar Compra</button>
                        @else
                            <h2 class="total-dolares"> {{ $this->restaDepagos() }}$ </h2>
                            <h2 class="total-bolivares"> {{ $this->convertir_a_bs($this->restaDepagos()) }} BS </h2>
                            <div class="alert alert-warning" role="alert">
                                Añade más métodos de pago para completar el total. </div>
                        @endif
                    </div>
                </div>
        </div>
    @else
        <p class="alert alert-info">No hay productos en el carrito.</p>
        @endif
    </div>
</div>
</div>
