<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class dashboard extends Controller
{
    public function index()
    {

        $fechaActual = Carbon::now();
        $hoy = [
            'dia' => $fechaActual->day,
            'mes' => $fechaActual->month,
            'ano' => $fechaActual->year
        ];


        $ventasdeldia = Venta::ventasDelDia();
        $totalventas = Venta::totalVentasDelDia();
        $ganancias = Venta::gananciasDelDia();
        return view('dashboard', compact(['ventasdeldia', 'totalventas', 'ganancias', 'hoy']));
    }
}
