<?php

namespace App\Http\Livewire\Productosventa;

use App\Models\productos;
use Livewire\Component;

class ProductosList extends Component
{

    public $productos;
    public $categoriaId;
    public $marcaId;

    public function mount()
    {
        $this->productos = productos::all();
    }
    protected $listeners = ['categoriaSeleccionada', 'marcaSeleccionada'];

    public function categoriaSeleccionada($categoriaId)
    {
        $this->categoriaId = $categoriaId;
        $this->productos = productos::where('categorias_id', $categoriaId)->get();
    }
    public function marcaSeleccionada($marcaId)
    {
        $this->marcaId = $marcaId;
        $this->productos = productos::where('marcas_id', $marcaId)->get();
    }

    public function agregarAlCarrito($productoId, $cantidad = 1)
    {
        $this->emit('agregarProductoAlCarrito', $productoId, $cantidad);
    }
    public function render()
    {
        return view('livewire.productosventa.productos-list');
    }
}
