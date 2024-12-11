<?php

namespace App\Http\Livewire\Dashbord;

use App\Models\Venta;
use Livewire\Component;
use Illuminate\Support\Carbon;

class GraficoVentas extends Component
{

    public $ventasPorMes = [];
    public $ventasPorAno = [];
    public $ventasPorMetodo = [];

    public function mount()
    {
        $this->obtenerDatosVentas();
    }

    public function obtenerDatosVentas()
    {
        // Obtener ventas por mes
        $ventasMes = Venta::all()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $this->ventasPorMes = $ventasMes->map(function ($ventas, $mes) {
            return [
                'mes' => $mes,
                'total' => $ventas->count(),
            ];
        })->values()->toArray();

        // Obtener ventas por año
        $ventasAno = Venta::all()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y');
        });

        $this->ventasPorAno = $ventasAno->map(function ($ventas, $ano) {
            return [
                'ano' => $ano,
                'total' => $ventas->count(),
            ];
        })->values()->toArray();

        // Obtener ventas por método de pago
        $this->ventasPorMetodo = Venta::selectRaw('metodo_pago, COUNT(*) as total')
            ->groupBy('metodo_pago')
            ->get()
            ->keyBy('metodo_pago')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.dashbord.grafico-ventas', [
            'ventasPorMes' => $this->ventasPorMes,
            'ventasPorAno' => $this->ventasPorAno,
            'ventasPorMetodo' => $this->ventasPorMetodo,
        ]);
    }
}
