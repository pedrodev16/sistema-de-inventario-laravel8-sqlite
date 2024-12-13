<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Venta;
use Livewire\Component;

class VerVentas extends Component
{
    public $ventas = [];
    public $filtroDia;
    public $filtroMes;
    public $filtroAno;
    public $filtroMetodoPago;

    public function mount()
    {
        $this->obtenerVentas();
    }

    public function updated($propertyName)
    {
        $this->obtenerVentas();
    }

    public function obtenerVentas()
    {
        $query = Venta::with('detalles.producto', 'user');

        if ($this->filtroDia) {
            $query->whereDay('created_at', $this->filtroDia);
        }

        if ($this->filtroMes) {
            $query->whereMonth('created_at', $this->filtroMes);
        }

        if ($this->filtroAno) {
            $query->whereYear('created_at', $this->filtroAno);
        }

        if ($this->filtroMetodoPago) {
            $query->where(function ($q) {
                $q->where($this->filtroMetodoPago, '>', 0);
            });
        }
        $this->ventas = $query->get();
    }
    public function render()
    {
        return view('livewire.ventas.ver-ventas');
    }
}
