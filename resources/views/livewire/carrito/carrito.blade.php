<div>
    <div class="mt-5">
        <div class="card">

            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($mensajeError)
                    <div class="alert alert-danger">{{ $mensajeError }}</div>
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
                                    <td>{{ $item['precio'] }}$ {{ $item['precio_proveedor'] }}</td>
                                    <td>{{ $item['subtotal'] }}$ {{ $item['subtotal_proveedor'] }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm"
                                            wire:click="eliminarProductoDelCarrito({{ $index }})">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <h4>Total del Carrito: {{ number_format($totalCarrito, 2, ',', '.') }}$ <button
                                class="btn btn-success" onclick="openModal()">Aplicar Venta</button></h4>

                    </div>



                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span class="close">×</span>



                            <div class="mt-4">
                                <label for="metodoPago">Método de Pago:</label>
                                <select id="metodoPago" wire:model="metodoPago" class="form-control">
                                    <option value="">Seleccione un método de pago</option>
                                    <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="transferencia">Transferencia Bancaria y Pago Movil</option>
                                    <option value="EfectivoBs">Efectivo Bs</option>
                                    <option value="EfectivoUsd">Efectivo Usd</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary form-control" wire:click="realizarVenta">Realizar
                                    Venta</button>
                            </div>
                        </div>
                    </div>
                @else
                    <p>No hay productos en el carrito.</p>
                @endif
            </div>
        </div>
    </div>




    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 22px;
            /* border: 1px solid #888; */
            width: 65%;
            height: 50%;
        }
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>






    <script>
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        // Abre el modal
        function openModal() {
            modal.style.display = "block";
        }

        // Cierra el modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Cierra el modal cuando el usuario hace clic fuera de él
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</div>
