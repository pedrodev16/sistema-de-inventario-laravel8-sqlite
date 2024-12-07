<?php

namespace App\Http\Livewire\Navegacion\Menu;

use App\Models\marcas as ModelsMarcas;
use Livewire\Component;

class Marcas extends Component
{

    public $marcas;
    public $marcaSeleccionadaId;

    public function mount()
    {
        $this->marcas = ModelsMarcas::where('estado', 'on')->get();
        $this->marcaSeleccionadaId = null;
    }

    public function seleccionarmarca($marcaId)
    {
        $this->marcaSeleccionadaId = $marcaId;
        $this->emit('marcaSeleccionada', $marcaId);
    }

    public function render()
    {
        return view('livewire.navegacion.menu.marcas');
    }
}
