<?php

namespace App\Http\Livewire\Dashbord;

use App\Models\Venta;
use Carbon\Carbon;
use Livewire\Component;

class MetodopagoGrafico extends Component
{

    public $montosPorMetodo = [];

    public function mount()
    {
        $this->obtenerDatos();
    }

    public function obtenerDatos()
    {
        $fecha = Carbon::today();
        $ventas = Venta::whereDay('created_at', $fecha)->get();

        $this->montosPorMetodo = [
            'pagomovil' => $ventas->sum('pagomovil'),
            'punto_de_venta' => $ventas->sum('punto_de_venta'),
            'transferencias' => $ventas->sum('transferencias'),
            'efectivousd' => $ventas->sum('efectivousd'),
            'efectivobs' => $ventas->sum('efectivobs'),
            'paypal' => $ventas->sum('paypal'),
            'zelle' => $ventas->sum('zelle')
        ];
    }
    public function render()
    {
        return view('livewire.dashbord.metodopago-grafico');
    }
}
