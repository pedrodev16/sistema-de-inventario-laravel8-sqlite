<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .table-responsive {
            width: 100%;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        th {
            background-color: #f4f4f4;
            text-align: left;
        }

        td {
            text-align: left;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        h3 {
            font-size: 18px;
            color: #555;
        }

        p {
            font-size: 14px;
            color: #666;
        }

        .product-info {
            padding: 10px;
        }

        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            text-align: right;
        }
    </style>
</head>

<body>
    <h3>{{ $empresa[0]->nombre_empresa }}<h3>

            <h1>Catálogo de productos</h1>
            <div class="table-responsive">
                <table class="table table-primary">
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr class="">
                                <td scope="row"><img
                                        src="{{ asset(str_replace('public', 'storage', $producto->imagen)) }}"
                                        alt="Imagen de {{ $producto->nombre }}"></td>
                                <td class="product-info">
                                    <h3>{{ $producto->nombre }} </h3>
                                    <p>{{ $producto->descripcion }}</p>
                                    <p><strong>Categoría:</strong> {{ $producto->categorias->nombre }}</p>
                                </td>
                                <td class="product-price">
                                    <h1>{{ $producto->costo_venta_usd }}$</h1>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
</body>

</html>
