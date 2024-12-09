<?php

namespace App\Http\Livewire\Productosventa;

use App\Models\Empresa;
use App\Models\productos;
use Livewire\Component;

class ProductosList extends Component
{

    public $productos;
    public $categoriaId;
    public $marcaId;
    public $mensajeError;
    public $empresa;

    public function mount()
    {
        $this->empresa = Empresa::where('id', 1)->get();
        $this->productos = calculos_producto(productos::all());
    }
    protected $listeners = ['categoriaSeleccionada', 'marcaSeleccionada', 'mensajeerrorcarrito'];

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
        $this->productos = calculos_producto(productos::all());
    }

    public function mensajeerrorcarrito($msj)
    {
        $this->mensajeError = $msj;
    }
    public function render()
    {
        return view('livewire.productosventa.productos-list');
    }
}
