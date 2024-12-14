   <!DOCTYPE html>
   <html>

   <head>
       <title>Detalles de la Venta</title>

   </head>

   <body>
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
       <h1>Detalles de la Venta</h1>
       @foreach ($ventas as $venta)
           <hr>
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
                               <th>Cod</th>
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




               </div>

           </div>
       @endforeach
       </div>
   </body>

   </html>
