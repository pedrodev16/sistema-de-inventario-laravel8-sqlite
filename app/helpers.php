<?php

use App\Models\Empresa;




function convertir($cost)
{
    $empresa = Empresa::first();
    if (!$empresa) {
        throw new \Exception('No se ha encontrado ninguna empresa registrada.');
    }
    $precioDolar = (float) $empresa->precio_dolar;
    return $cost * $precioDolar;
}

function calculo_productos($productos)
{
    $empresa = Empresa::first();
    if (!$empresa) {
        throw new \Exception('No se ha encontrado ninguna empresa registrada.');
    }
    $precioDolar = $empresa->precio_dolar;
    $por_iv = (float) $empresa->porcentaje_iva;

    $mer_l = (float) $empresa->porcentaje_mercadolibre;
    return $productos->map(function ($producto) use ($precioDolar, $por_iv, $mer_l) {

        $iva = porsentaje($producto->costo, $por_iv);
        $p_venta = porsentaje($producto->costo, $producto->porcentaje_ganacia_tienda);
        $merc_l = porsentaje($producto->costo, $mer_l);


        $producto->costo = $producto->costo;
        $producto->iva = $iva;
        $producto->mercad_l = $merc_l;
        $producto->g_tienda = $p_venta;

        $total  = (float) ($producto->costo + $iva + $p_venta + $merc_l);
        //$total = (float) formatCurrency($total);
        $producto->costo_venta_usd = $total;
        $producto->costo_venta_bs = number_format(convertir($total), 2, ',', '.');
        return $producto;
    });
}


function calculo_producto($producto)
{
    $empresa = Empresa::first();
    if (!$empresa) {
        throw new \Exception('No se ha encontrado ninguna empresa registrada.');
    }

    $precioDolar = $empresa->precio_dolar;
    $por_iv = (float) $empresa->porcentaje_iva;
    $mer_l = (float) $empresa->porcentaje_mercadolibre;

    $iva = porsentaje($producto->costo, $por_iv);
    $p_venta = porsentaje($producto->costo, $producto->porcentaje_ganacia_tienda);
    $merc_l = porsentaje($producto->costo, $mer_l);

    $producto->iva = $iva;
    $producto->mercad_l = $merc_l;
    $producto->g_tienda = $p_venta;

    $total = (float) ($producto->costo + $iva + $p_venta + $merc_l);
    $producto->costo_venta_usd = $total;
    $producto->costo_venta_bs = number_format(convertir($total), 2, ',', '.');

    return $producto;
}

function formatCurrency($amount, $currency = 'USD')
{
    return number_format($amount, 2) . ' ' . $currency;
}

function porsentaje($valor, $porcentaje)
{
    $total = $valor * $porcentaje / 100;
    $total = (float)  formatCurrency($total);
    return  $total;
}
