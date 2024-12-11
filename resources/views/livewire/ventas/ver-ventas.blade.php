<div class="container mt-5">
    <h2>Ventas Realizadas</h2>

    <div class="row mb-3">
        <div class="col-md-3">
            <label for="filtroDia">Día:</label>
            <input type="number" id="filtroDia" wire:model="filtroDia" class="form-control" placeholder="Día">
        </div>
        <div class="col-md-3">
            <label for="filtroMes">Mes:</label>
            <input type="number" id="filtroMes" wire:model="filtroMes" class="form-control" placeholder="Mes">
        </div>
        <div class="col-md-3">
            <label for="filtroAno">Año:</label>
            <input type="number" id="filtroAno" wire:model="filtroAno" class="form-control" placeholder="Año">
        </div>
        <div class="col-md-3">
            <label for="filtroMetodoPago">Método de Pago:</label>
            <select id="filtroMetodoPago" wire:model="filtroMetodoPago" class="form-control">
                <option value="">Todos</option>
                <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                <option value="paypal">PayPal</option>
                <option value="transferencia">Transferencia Bancaria</option>
                <option value="efectivo">Efectivo</option>
            </select>
        </div>
    </div>

    @foreach ($ventas as $venta)
        <div class="card mb-3">
            <div class="card-header">
                <h5>Venta ID: {{ $venta->id }}</h5>
                <p>Usuario: {{ $venta->user->name }}</p>
                <p>Total: {{ number_format($venta->total, 2, ',', '.') }}$</p>
                <p>Método de Pago: {{ ucfirst($venta->metodo_pago) }}</p>
                <p>Fecha: {{ $venta->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div class="card-body">
                <h6>Detalles de la Venta:</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($venta->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ number_format($detalle->precio, 2, ',', '.') }}$</td>
                                <td>{{ number_format($detalle->subtotal, 2, ',', '.') }}$</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
