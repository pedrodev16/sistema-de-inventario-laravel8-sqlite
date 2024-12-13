<?php

namespace App\Http\Livewire\Cuadre;

use App\Helpers\HelpersInventario;
use App\Models\Cuadre;
use App\Models\Venta;
use Carbon\Carbon;
use Livewire\Component;

class HistoriaCuadre extends Component
{
    public $cuadres = [];
    public $filtroDia;
    public $filtroMes;
    public $filtroAno;
    public $filtroMetodoPago;


    public $idCuadre;
    public $ventasDelDia = [];
    public $concepto_ingreso = '';
    public $registrar_egreso = false;
    public $concepto_egreso = '';
    public $total_egreso = 0;
    public $totalGananciapordia;
    public $totalesPorMetodo = [];
    public $totalesMetodosPago;
    public $ventasPorUsuario = [];

    public $sumaTotalIngreso = 0;
    public $sumaTotalEgreso = 0;
    public $sumaTotal = 0;
    public function mount()
    {
        $this->obtenerCuadre();
        $this->obtenerCuadresYSumas();
    }

    public function updated($propertyName)
    {
        $this->obtenerCuadre();
        $this->obtenerCuadresYSumas();
    }

    public function obtenerCuadre()
    {
        $query = Cuadre::query();
        if ($this->filtroDia) {
            $query->whereDay('created_at', $this->filtroDia);
        }
        if ($this->filtroMes) {
            $query->whereMonth('created_at', $this->filtroMes);
        }
        if ($this->filtroAno) {
            $query->whereYear('created_at', $this->filtroAno);
        }
        // if ($this->filtroMetodoPago) {
        //     $query->where('metodo_pago', $this->filtroMetodoPago);
        // }
        $this->cuadres = $query->get();
    }


    public function ver_cuadre($id)
    {
        $this->idCuadre = $id;
        $cuadre = Cuadre::find($id);
        $fecha = Carbon::parse($cuadre->fecha);
        // Calcular totales por método de pago 

        $this->ventasPorUsuario = HelpersInventario::sumarVentasPorUsuario('day', $fecha);
        if (!$cuadre) {
            return;
        }
        $this->ventasDelDia = Venta::whereDay('created_at', $fecha)->get()->toArray();
        $totalIngreso = array_sum(array_column($this->ventasDelDia, 'total'));
        $this->ventasDelDia = Venta::whereDay('created_at', $fecha)->get();
        $this->totalesMetodosPago = HelpersInventario::calcularTotalesMetodosPago($this->ventasDelDia);

        $this->totalGananciapordia = $totalIngreso;
    }
    public function obtenerCuadresYSumas()
    {
        // $this->cuadres = Cuadre::all();
        $this->sumaTotalIngreso = $this->cuadres->sum('total_ingreso');
        $this->sumaTotalEgreso = $this->cuadres->sum('total_egreso');
        $this->sumaTotal = $this->cuadres->sum('total');
    }

    public function render()
    {
        return view('livewire.cuadre.historia-cuadre', [
            'sumaTotalIngreso' => $this->sumaTotalIngreso,
            'sumaTotalEgreso' => $this->sumaTotalEgreso,
            'sumaTotal' => $this->sumaTotal,
            'totalesMetodosPago' => $this->totalesMetodosPago
        ]);
    }
}
