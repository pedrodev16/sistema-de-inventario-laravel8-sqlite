<div>
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h2>Perfil de Empresa</h2>
                @if ($empresas->isEmpty())
                    <p>No hay empresas registradas.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre Empresa</th>
                                <th>Fecha Registro</th>
                                <th>Precio Dólar</th>
                                <th> IVA</th>
                                <th>MercadoLibre</th>
                                <th>Ganancia Tienda</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empresas as $empresa)
                                <tr>
                                    <td>{{ $empresa->nombre_empresa }}</td>
                                    <td>{{ $empresa->fecha_registro }}</td>
                                    <td>{{ $empresa->precio_dolar }} Bs</td>
                                    <td>{{ $empresa->porcentaje_iva }}%</td>
                                    <td>{{ $empresa->porcentaje_mercadolibre }}%</td>
                                    <td>{{ $empresa->porcentaje_ganacia_tienda }}%</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"
                                            wire:click="editarEmpresa({{ $empresa->id }})">Editar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
