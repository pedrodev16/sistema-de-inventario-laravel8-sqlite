<?php

namespace App\Http\Livewire\Product;

use App\Models\productos;
use Livewire\Component;

class ProductosList extends Component
{

    public $productos;

    protected $listeners = ['renderlist' => 'mount', 'renderlist' => 'cargarProductos'];
    public function mount()
    {
        $this->productos = Productos::orderBy('id', 'desc')->get();
        $this->cargarProductos();
    }

    public function cargarProductos()
    {
        $this->productos = productos::all();
    }
    public function editarProducto($productoId)
    {
        $this->emit('editarProducto', $productoId);
    }
    public function render()
    {
        //$this->productos = Productos::orderBy('id', 'desc')->get();
        return view('livewire.product.productos-list');
    }
}
