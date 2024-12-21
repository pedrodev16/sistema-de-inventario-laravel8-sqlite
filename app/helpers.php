<?php

namespace App\Helpers;

use App\Models\Empresa;
use App\Models\Venta;
use Illuminate\Support\Collection;

class HelpersInventario
{
    public static function convertir($cost)
    {
        $empresa = Empresa::first();
        if (!$empresa) {
            throw new \Exception('No se ha encontrado ninguna empresa registrada.');
        }
        $precioDolar = (float) $empresa->precio_dolar;
        return $cost * $precioDolar;
    }

    public static function calculo_productos(Collection $productos)
    {
        $empresa = Empresa::first();
        if (!$empresa) {
            throw new \Exception('No se ha encontrado ninguna empresa registrada.');
        }
        $precioDolar = $empresa->precio_dolar;
        $por_iv = (float) $empresa->porcentaje_iva;
        $mer_l = (float) $empresa->porcentaje_mercadolibre;

        return $productos->map(function ($producto) use ($precioDolar, $por_iv, $mer_l) {
            $iva = self::porsentaje($producto->costo, $por_iv);
            $p_venta = self::porsentaje($producto->costo, $producto->porcentaje_ganacia_tienda);
            $merc_l = self::porsentaje($producto->costo, $mer_l);

            $producto->costo = $producto->costo;
            $producto->iva = $iva;
            $producto->mercad_l = $merc_l;
            $producto->g_tienda = $p_venta;

            $producto->ganancia = $p_venta;
            $total  = (float) ($producto->costo + $iva + $p_venta + $merc_l);
            $producto->costo_venta_usd = $total;
            $producto->costo_venta_bs = number_format(self::convertir($total), 2, ',', '.');
            return $producto;
        });
    }

    public static function calculo_producto($producto)
    {
        $empresa = Empresa::first();
        if (!$empresa) {
            throw new \Exception('No se ha encontrado ninguna empresa registrada.');
        }

        $precioDolar = $empresa->precio_dolar;
        $por_iv = (float) $empresa->porcentaje_iva;
        $mer_l = (float) $empresa->porcentaje_mercadolibre;

        $iva = self::porsentaje($producto->costo, $por_iv);
        $p_venta = self::porsentaje($producto->costo, $producto->porcentaje_ganacia_tienda);
        $merc_l = self::porsentaje($producto->costo, $mer_l);

        $producto->iva = $iva;
        $producto->mercad_l = $merc_l;
        $producto->g_tienda = $p_venta;

        $total = (float) ($producto->costo + $iva + $p_venta + $merc_l);
        $producto->ganancia = $p_venta;
        $producto->costo_venta_usd = $total;
        $producto->costo_venta_bs = number_format(self::convertir($total), 2, ',', '.');

        return $producto;
    }

    public static function formatCurrency($amount, $currency = 'USD')
    {
        return number_format($amount, 2) . ' ' . $currency;
    }

    public static function porsentaje($valor, $porcentaje)
    {
        $total = $valor * $porcentaje / 100;
        $total = (float) self::formatCurrency($total);
        return  $total;
    }




    public static function calcularTotalesMetodosPago($ventas)
    {
        return [
            'pagomovil' => $ventas->sum('pagomovil'),
            'punto_de_venta' => $ventas->sum('punto_de_venta'),
            'transferencias' => $ventas->sum('transferencias'),
            'efectivousd' => $ventas->sum('efectivousd'),
            'efectivobs' => $ventas->sum('efectivobs'),
            'paypal' => $ventas->sum('paypal'),
            'zelle' => $ventas->sum('zelle')
        ];
    }



    // public static function calcularTotalesPorMetodo($period, $fecha)
    // {
    //     switch ($period) {
    //         case 'day':
    //             $ventas = Venta::whereDay('created_at', $fecha)->get();
    //             break;
    //         case 'month':
    //             $ventas = Venta::whereMonth('created_at', $fecha->month)->whereYear('created_at', $fecha->year)->get();
    //             break;
    //         case 'year':
    //             $ventas = Venta::whereYear('created_at', $fecha->year)->get();
    //             break;
    //     }
    //     $totalesPorMetodo = $ventas->groupBy('metodo_pago')->map(function ($row) {
    //         return $row->sum('total');
    //     });

    //     return $totalesPorMetodo;
    // }

    public static function calcularTotalesPorUsuario($period, $fecha)
    {
        switch ($period) {
            case 'day':
                $ventas = Venta::whereDay('created_at', $fecha)->get();
                break;
            case 'month':
                $ventas = Venta::whereMonth('created_at', $fecha->month)->whereYear('created_at', $fecha->year)->get();
                break;
            case 'year':
                $ventas = Venta::whereYear('created_at', $fecha->year)->get();
                break;
        }
        $ventasPorUsuario = $ventas->groupBy('user_id')->map(function ($row) {
            return $row->sum('total');
        });
        return $ventasPorUsuario;
    }


    public static function sumarVentasPorPeriodo($periodo, $fecha)
    {
        switch ($periodo) {
            case 'day':
                $ventas = Venta::whereDay('created_at', $fecha)->count();
                break;
            case 'month':
                $ventas = Venta::whereMonth('created_at', $fecha->month)->whereYear('created_at', $fecha->year)->count();
                break;
            case 'year':
                $ventas = Venta::whereYear('created_at', $fecha->year)->count();
                break;
            default:
                throw new \Exception('Periodo no válido');
        }
        return $ventas;
    }

    public static function sumarVentasPorUsuario($periodo, $fecha)
    {
        switch ($periodo) {
            case 'day':
                $ventas = Venta::whereDay('created_at', $fecha)->get();
                break;
            case 'month':
                $ventas = Venta::whereMonth('created_at', $fecha->month)->whereYear('created_at', $fecha->year)->get();
                break;
            case 'year':
                $ventas = Venta::whereYear('created_at', $fecha->year)->get();
                break;
            default:
                throw new \Exception('Periodo no válido');
        }
        return $ventas->groupBy('user_id')->map(function ($ventasUsuario) {
            return $ventasUsuario->count();
        });
    }
}
