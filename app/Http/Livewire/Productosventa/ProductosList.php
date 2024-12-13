<?php

namespace App\Http\Livewire\Productosventa;

use App\Helpers\HelpersInventario;
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


    protected $rules = ['productos.*.porcentaje_ganacia_tienda' => 'required|numeric|min:0|max:100',];

    public function mount()
    {
        $this->empresa = Empresa::where('id', 1)->get();
        $this->productos = HelpersInventario::calculo_productos(productos::all());
    }
    protected $listeners = ['categoriaSeleccionada', 'marcaSeleccionada', 'mensajeerrorcarrito'];

    public function categoriaSeleccionada($categoriaId)
    {
        $this->categoriaId = $categoriaId;
        $this->productos = HelpersInventario::calculo_productos(productos::where('categorias_id', $categoriaId)->get());
    }
    public function marcaSeleccionada($marcaId)
    {
        $this->marcaId = $marcaId;
        $this->productos = HelpersInventario::calculo_productos(productos::where('marcas_id', $marcaId)->get());
    }

    public function agregarAlCarrito($productoId, $cantidad = 1)
    {
        $this->emit('agregarProductoAlCarrito', $productoId, $cantidad);
        $this->productos = HelpersInventario::calculo_productos(productos::all());
    }

    public function mensajeerrorcarrito($msj)
    {
        $this->mensajeError = $msj;
    }

    public function actualizarPorcentaje($index)
    {
        $this->validate();
        $productoId = $this->productos[$index]['id'];
        $producto = productos::find($productoId);
        $producto->porcentaje_ganacia_tienda = $this->productos[$index]['porcentaje_ganacia_tienda'];
        $producto->save();
        $this->productos = HelpersInventario::calculo_productos(productos::all());
        //session()->flash('success', 'Porcentaje de ganancia actualizado exitosamente.');
        $this->emit('mostrarok', "Porcentaje de ganancia actualizado exitosamente.");
    }

    public function render()
    {
        return view('livewire.productosventa.productos-list');
    }
}
