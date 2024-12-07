<?php

namespace App\Http\Livewire\Navegacion\Menu;

use App\Models\Categorias as ModelsCategorias;
use Livewire\Component;

class Categorias extends Component
{
    public $categorias;
    public $categoriaSeleccionadaId;

    public function mount()
    {
        $this->categorias = ModelsCategorias::where('estado', 'on')->get();
        $this->categoriaSeleccionadaId = null;
    }

    public function seleccionarCategoria($categoriaId)
    {
        $this->categoriaSeleccionadaId = $categoriaId;
        $this->emit('categoriaSeleccionada', $categoriaId);
    }

    public function render()
    {
        return view('livewire.navegacion.menu.categorias');
    }
}
