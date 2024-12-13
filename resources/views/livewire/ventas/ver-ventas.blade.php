<div class="mt-5">
    <h2 class="mb-4">Ventas Realizadas</h2>

    <div class=" mt-1">


        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-4">Filtros de Ventas</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label for="filtroDia" class="form-label">Día:</label>
                        <input type="number" id="filtroDia" wire:model="filtroDia" class="form-control"
                            placeholder="Día">
                    </div>
                    <div class="col-md-3">
                        <label for="filtroMes" class="form-label">Mes:</label>
                        <input type="number" id="filtroMes" wire:model="filtroMes" class="form-control"
                            placeholder="Mes">
                    </div>
                    <div class="col-md-3">
                        <label for="filtroAno" class="form-label">Año:</label>
                        <input type="number" id="filtroAno" wire:model="filtroAno" class="form-control"
                            placeholder="Año">
                    </div>
                    <div class="col-md-3">
                        <label for="filtroMetodoPago" class="form-label">Método de Pago:</label>
                        <select id="filtroMetodoPago" class="form-control" wire:model="filtroMetodoPago">
                            <option value="">Método de Pago</option>
                            <option value="pagomovil">Pago Móvil</option>
                            <option value="punto_de_venta">Punto de Venta</option>
                            <option value="transferencias">Transferencias</option>
                            <option value="efectivousd">Efectivo USD</option>
                            <option value="efectivobs">Efectivo BS</option>
                            <option value="paypal">Paypal</option>
                            <option value="zelle">Zelle</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach ($ventas as $venta)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Venta ID: {{ $venta->id }}</h5>
                <p class="mb-0">Usuario: {{ $venta->user->name }}</p>
            </div>
            <div class="card-body">
                <p><strong>Total:</strong> {{ number_format($venta->total, 2, ',', '.') }}$</p>
                <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i:s') }}</p>
                <h6>Métodos de Pago:</h6>
                <ul>
                    @if ($venta->pagomovil > 0)
                        <li>Pago Móvil: {{ $venta->pagomovil }}$</li>
                    @endif
                    @if ($venta->punto_de_venta > 0)
                        <li>Punto de Venta: {{ $venta->punto_de_venta }}$</li>
                    @endif
                    @if ($venta->transferencias > 0)
                        <li>Transferencias: {{ $venta->transferencias }}$</li>
                    @endif
                    @if ($venta->efectivousd > 0)
                        <li>Efectivo USD: {{ $venta->efectivousd }}$</li>
                    @endif
                    @if ($venta->efectivobs > 0)
                        <li>Efectivo BS: {{ $venta->efectivobs }}$</li>
                    @endif
                    @if ($venta->paypal > 0)
                        <li>Paypal: {{ $venta->paypal }}$</li>
                    @endif
                    @if ($venta->zelle > 0)
                        <li>Zelle: {{ $venta->zelle }}$</li>
                    @endif
                </ul>
                <h6>Detalles de la Venta:</h6>
                <table class="table table-bordered">
                    <thead class="table-light">
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
