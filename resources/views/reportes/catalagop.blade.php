<!DOCTYPE html>
<html lang="en">

<head>

    <title>Document</title>
</head>

<body>
    <div class="table-responsive">
        <table class="table table-primary">
            <tbody>
                @foreach ($productos as $producto)
                    <tr class="">
                        <td scope="row"><img style="width: 330px"
                                src="{{ asset(str_replace('public', 'storage', $producto->imagen)) }}"
                                alt="Imagen de {{ $producto->nombre }}"></td>
                        <td>
                            <h3>{{ $producto->nombre }} </h3>
                            {{ $producto->categorias->nombre }}

                        </td>
                        <td>
                            <h1>{{ $producto->costo_venta_usd }}$</h1>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>

</html>
