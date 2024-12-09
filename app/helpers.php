<?php

use App\Models\Empresa;



function porsentaje($valor, $porcentaje)
{
    return $valor * $porcentaje / 100;
}
function convertir($cost)
{
    $empresa = Empresa::first();
    if (!$empresa) {
        throw new \Exception('No se ha encontrado ninguna empresa registrada.');
    }
    $precioDolar = (float) $empresa->precio_dolar;
    return $cost * $precioDolar;
}

function calculos_producto($productos)
{
    $empresa = Empresa::first();
    if (!$empresa) {
        throw new \Exception('No se ha encontrado ninguna empresa registrada.');
    }
    $precioDolar = $empresa->precio_dolar;
    $por_iv = (float) $empresa->porcentaje_iva;
    $por_g = (float) $empresa->porcentaje_ganacia_tienda;
    $mer_l = (float) $empresa->porcentaje_mercadolibre;
    return $productos->map(function ($producto) use ($precioDolar, $por_iv, $mer_l, $por_g) {

        $iva = porsentaje($producto->costo, $por_iv);
        $p_venta = porsentaje($producto->costo, $por_g);
        $merc_l = porsentaje($producto->costo, $mer_l);


        $producto->costo = $producto->costo;
        $producto->iva = $iva;
        $producto->mercad_l = $merc_l;
        $producto->g_tienda = $p_venta;

        $total  = (float) ($producto->costo + $iva + $p_venta + $merc_l);
        $producto->costo_venta_usd = $total;
        $producto->costo_venta_bs = number_format(convertir($total), 2, ',', '.');
        return $producto;
    });
}
