<div class=" mt-5">
    <h2 class="mb-4">Resumen de Ventas y Cuadres</h2>

    <!-- Filtros y Resumen -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="filtroDia" class="form-label">Día:</label>
                    <input type="number" id="filtroDia" wire:model="filtroDia" class="form-control" placeholder="Día">
                </div>
                <div class="col-md-4">
                    <label for="filtroMes" class="form-label">Mes:</label>
                    <input type="number" id="filtroMes" wire:model="filtroMes" class="form-control" placeholder="Mes">
                </div>
                <div class="col-md-4">
                    <label for="filtroAno" class="form-label">Año:</label>
                    <input type="number" id="filtroAno" wire:model="filtroAno" class="form-control" placeholder="Año">
                </div>

            </div>
            <h3 class="text-primary">
                <strong>Ingreso:</strong> {{ number_format($sumaTotalIngreso, 2, ',', '.') }}$
                <strong>Egreso:</strong> {{ number_format($sumaTotalEgreso, 2, ',', '.') }}$
                <strong>Total:</strong> {{ number_format($sumaTotal, 2, ',', '.') }}$
            </h3>
        </div>
    </div>

    <!-- Tabla de Cuadres -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="mb-3">Listado de Cuadres</h3>
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Concepto de Ingreso</th>
                        <th>Total Ingreso</th>
                        <th>Concepto de Egreso</th>
                        <th>Total Egreso</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cuadres as $cuadre)
                        <tr>
                            <td>{{ $cuadre['fecha'] }}</td>
                            <td>{{ $cuadre['estado'] }}</td>
                            <td>{{ $cuadre['concepto_ingreso'] }}</td>
                            <td>{{ number_format($cuadre['total_ingreso'] ?? 0, 2, ',', '.') }}</td>
                            <td>{{ $cuadre['concepto_egreso'] }}</td>
                            <td>{{ number_format($cuadre['total_egreso'] ?? 0, 2, ',', '.') }}</td>
                            <td>{{ number_format($cuadre['total'] ?? 0, 2, ',', '.') }}</td>
                            <td>
                                @if ($cuadre['estado'] == 'si')
                                    <button wire:click="ver_cuadre({{ $cuadre['id'] }})"
                                        class="btn btn-primary btn-sm">Ver Cuadre</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay registros de cuadre.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if (!empty($ventasDelDia))
        <!-- Resumen de Ventas del Día -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h3 class="mb-4">Cuadre del Día - Total: {{ number_format($totalGananciapordia, 2, ',', '.') }}$</h3>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border-info">
                            <div class="card-body">
                                <h5 class="card-title text-info">Totales por Método de Pago</h5>
                                <ul class="list-group">
                                    @foreach ($totalesMetodosPago as $metodo => $total)
                                        @if ($total > 0)
                                            <li class="list-group-item">
                                                <strong>{{ ucfirst(str_replace('_', ' ', $metodo)) }}:</strong>
                                                {{ number_format($total, 2, ',', '.') }}$
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border-info">
                            <div class="card-body">
                                <h5 class="card-title text-info">Ventas por Usuario</h5>
                                <ul class="list-group">
                                    @foreach ($ventasPorUsuario as $userId => $total)
                                        <li class="list-group-item">
                                            <strong>Usuario ID {{ $userId }}:</strong> {{ $total }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detalles de Ventas del Día -->
                <div>
                    @foreach ($ventasDelDia as $venta)
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="card-title mb-0">Venta ID: {{ $venta->id }}</h5>
                                <p class="mb-0">Usuario: {{ $venta->user->name }}</p>
                                <p class="mb-0"><strong>Total:</strong>
                                    {{ number_format($venta->total, 2, ',', '.') }}$</p>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle mb-3">Métodos de Pago:</h6>
                                <ul class="list-group mb-3">
                                    @if ($venta->pagomovil > 0)
                                        <li class="list-group-item">Pago Móvil:
                                            {{ number_format($venta->pagomovil, 2, ',', '.') }}$</li>
                                    @endif
                                    @if ($venta->punto_de_venta > 0)
                                        <li class="list-group-item">Punto de Venta:
                                            {{ number_format($venta->punto_de_venta, 2, ',', '.') }}$</li>
                                    @endif
                                    @if ($venta->transferencias > 0)
                                        <li class="list-group-item">Transferencias:
                                            {{ number_format($venta->transferencias, 2, ',', '.') }}$</li>
                                    @endif
                                    @if ($venta->efectivousd > 0)
                                        <li class="list-group-item">Efectivo USD:
                                            {{ number_format($venta->efectivousd, 2, ',', '.') }}$</li>
                                    @endif
                                    @if ($venta->efectivobs > 0)
                                        <li class="list-group-item">Efectivo BS:
                                            {{ number_format($venta->efectivobs, 2, ',', '.') }}$</li>
                                    @endif
                                    @if ($venta->paypal > 0)
                                        <li class="list-group-item">Paypal:
                                            {{ number_format($venta->paypal, 2, ',', '.') }}$</li>
                                    @endif
                                    @if ($venta->zelle > 0)
                                        <li class="list-group-item">Zelle:
                                            {{ number_format($venta->zelle, 2, ',', '.') }}$</li>
                                    @endif
                                </ul>
                                <h6 class="card-subtitle mb-3">Detalles de la Venta:</h6>
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
            </div>
        </div>
    @endif
</div>
