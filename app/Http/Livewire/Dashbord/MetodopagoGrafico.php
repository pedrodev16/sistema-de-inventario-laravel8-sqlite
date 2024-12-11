<?php

namespace App\Http\Livewire\Dashbord;

use App\Models\Venta;
use Carbon\Carbon;
use Livewire\Component;

class MetodopagoGrafico extends Component
{

    public $ventasPorDiaMetodo = [];

    public function mount()
    {
        $this->obtenerDatosVentas();
    }

    public function obtenerDatosVentas()
    {
        $ventas = Venta::all()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $this->ventasPorDiaMetodo = $ventas->map(function ($ventasDia, $dia) {
            return $ventasDia->groupBy('metodo_pago')->map->count();
        });
    }
    public function render()
    {
        return view('livewire.dashbord.metodopago-grafico');
    }
}
