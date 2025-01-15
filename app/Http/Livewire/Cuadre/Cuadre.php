<?php

namespace App\Http\Livewire\Cuadre;

use App\Helpers\HelpersInventario;
use App\Models\Cuadre as ModelsCuadre;
use App\Models\Venta;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class Cuadre extends Component
{
    public $cuadres = [];
    public $idCuadre;
    public $ventasDelDia = [];
    public $concepto_ingreso = '';
    public $registrar_egreso = false;
    public $concepto_egreso = '';
    public $total_egreso = 0;
    public $totalGananciapordia;
    public $totalesPorMetodo = [];
    public $ventasPorUsuario = [];
    public $totalesMetodosPago = [];
    public function mount()
    {
        $this->crearInicioCuadre();
        $this->cuadres = ModelsCuadre::all()->toArray();
    }

    public function crearInicioCuadre()
    {
        $hoy = Carbon::today();

        if (!ModelsCuadre::where('fecha', $hoy)->exists()) {
            ModelsCuadre::create([
                'fecha' => $hoy,
                'estado' => 'no'
            ]);
        }
    }



    public function ver_cuadre($id)
    {
        $this->idCuadre = $id;
        $cuadre = ModelsCuadre::find($id);
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
    public function realizarCuadre($id)
    {

        $cuadre = ModelsCuadre::find($id);
        $fecha = Carbon::parse($cuadre->fecha);


        $this->ventasDelDia = Venta::whereDay('created_at', $fecha)->get()->toArray();
        $totalIngreso = array_sum(array_column($this->ventasDelDia, 'total'));
        $this->ventasDelDia = Venta::whereDay('created_at', $fecha)->get();

        $cuadre->concepto_ingreso = $this->concepto_ingreso;
        $cuadre->total_ingreso = $totalIngreso;

        if ($this->registrar_egreso) {
            $cuadre->concepto_egreso = $this->concepto_egreso;
            $cuadre->total_egreso = $this->total_egreso;
        }
        $cuadre->total = $totalIngreso - $this->total_egreso;
        $cuadre->estado = 'si';
        $cuadre->save();

        // Reiniciar campos de ingreso/egreso
        $this->concepto_ingreso = '';
        $this->registrar_egreso = false;
        $this->concepto_egreso = '';
        $this->total_egreso = 0;
        $this->ventasDelDia = [];
        // Actualizar la lista de cuadre
        $this->cuadres = ModelsCuadre::all()->toArray();
    }

    public function conbertir_a_bs($monto)
    {
        return HelpersInventario::convertir($monto);
    }



    public function render()
    {
        return view('livewire.cuadre.cuadre', [
            'cuadres' => $this->cuadres,
            'ventasDelDia' => $this->ventasDelDia,
            'totalesPorMetodo' => $this->totalesPorMetodo,
            'ventasPorUsuario' => $this->ventasPorUsuario,
            'totalesMetodosPago' => $this->totalesMetodosPago
        ]);
    }
}
