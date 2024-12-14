<?php

namespace App\Http\Controllers;

use App\Models\stock;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class report extends Controller
{
    public $tipo;
    public $ventas;
    public function generarPDF()
    {
        $stocks = stock::all();
        $pdf = FacadePdf::loadView('reporte', compact('stocks'));
        return $pdf->download('reporte.pdf');
    }

    public function reporteventa($id)
    {
        $venta = Venta::findOrFail($id);
        $pdf = FacadePdf::loadView('reportes.reporteventa', compact('venta'));
        return $pdf->download('reporte.pdf');
    }

    public function reporteventa_filtros(Request $request)
    {
        $dias = $request->dia;
        $mes = $request->mes;
        $ano = $request->ano;
        $this->tipo = $request->metod;


        $query = Venta::with('detalles.producto', 'user');

        if ($dias) {
            $query->whereDay('created_at', $dias);
        }

        if ($mes) {
            $query->whereMonth('created_at', $mes);
        }

        if ($ano) {
            $query->whereYear('created_at', $ano);
        }

        if ($this->tipo) {
            $query->where(function ($q) {
                $q->where($this->tipo, '>', 0);
            });
        }
        $this->ventas = $query->get();



        $ventas = $this->ventas;
        $pdf = FacadePdf::loadView('reportes.reporteventasfiltro', compact('ventas'));
        return $pdf->download('reporte.pdf');
    }
}
