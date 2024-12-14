<!DOCTYPE html>
<html>

<head>
    <title>Detalles de la Venta</title>

</head>

<body>
    <div class="container mt-5">
        <h1>Detalles de la Venta</h1>
        <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i:s') }}</p>
        <p><strong>ID de la Venta:</strong> {{ $venta->id }}</p>
        <p><strong>Vendedor:</strong> {{ $venta->user->name }}</p>
        <p><strong>Total:</strong> {{ $venta->total }}</p>
        {{-- <p><strong>Ganancia:</strong> {{ $venta->ganancia }}</p> --}}
        <!-- Agrega más detalles según tus necesidades -->
    </div>
    <hr>



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

    <hr>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
    </style>
    <table>
        <thead>
            <tr>
                <th>cod</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->codigo }}</td>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ number_format($detalle->precio, 2, ',', '.') }}$</td>
                    <td>{{ number_format($detalle->subtotal, 2, ',', '.') }}$</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
