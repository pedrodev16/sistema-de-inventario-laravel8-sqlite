<?php

namespace App\Http\Controllers;

use App\Helpers\HelpersInventario;
use App\Models\Empresa;
use App\Models\productos;
use App\Models\stock;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class report extends Controller
{

    public $cod;
    public $categoria;
    public $marca;
    public $nombre;

    public $productos;

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

    public function catalago_de_productos(Request $request)
    {
        $this->categoria = $request->categoria;
        $this->marca = $request->categoria;
        $this->nombre = $request->categoria;
        $this->cod = $request->categoria;

        $empresa = Empresa::where('id', 1)->get();
        $query = productos::query();
        if ($this->cod) {
            $query->where('codigo', 'like', '%' . $this->cod . '%');
        }
        if ($this->nombre) {
            $query->where('nombre', 'like', '%' . $this->nombre . '%');
        }
        if ($this->categoria) {
            $query->where('categorias_id', $this->categoria);
        }
        if ($this->marca) {
            $query->where('marcas_id', $this->marca);
        }
        $this->productos = HelpersInventario::calculo_productos($query->get());
        $productos = $this->productos;
        $pdf = FacadePdf::loadView('reportes.catalagop', compact('productos', 'empresa'));
        return $pdf->download('catalogo_de_productos.pdf');
    }
}
