<div class="container mt-5">
    <h2>Cuadre Diario</h2>

    <table class="table table-bordered">
        <thead>
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
                        @if ($cuadre['estado'] == 'no')
                            <button wire:click="ver_cuadre({{ $cuadre['id'] }})" class="btn btn-primary">Realizar
                                Cuadre</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay registros de cuadre.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $x }}
    @if (!empty($ventasDelDia))
        <h3>Ventas del día</h3>
        <div>
            @foreach ($ventasDelDia as $venta)
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

        <div>
            <label for="concepto_ingreso">Concepto de Ingreso</label>
            <input type="text" id="concepto_ingreso" wire:model="concepto_ingreso" class="form-control">
        </div>

        <div>
            <input type="checkbox" id="registrar_egreso" wire:model="registrar_egreso">
            <label for="registrar_egreso">Registrar Egreso</label>
        </div>

        @if ($registrar_egreso)
            <div>
                <label for="concepto_egreso">Concepto de Egreso</label>
                <input type="text" id="concepto_egreso" wire:model="concepto_egreso" class="form-control">

                <label for="total_egreso">Total de Egreso</label>
                <input type="number" id="total_egreso" wire:model="total_egreso" class="form-control">
            </div>
        @endif

        @if ($cuadre['estado'] == 'no')
            <button wire:click="realizarCuadre({{ $idCuadre }})" class="btn btn-primary">Realizar
                Cuadre</button>
        @endif
    @endif
</div>
