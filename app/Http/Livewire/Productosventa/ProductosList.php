<?php

namespace App\Http\Livewire\Productosventa;

use App\Helpers\HelpersInventario;
use App\Http\Controllers\producto;
use App\Models\Categorias;
use App\Models\Empresa;
use App\Models\marcas;
use App\Models\productos;
use Livewire\Component;

class ProductosList extends Component
{

    public $productos;

    public $productos2;
    public $categoriaId;
    public $marcaId;
    public $mensajeError;
    public $empresa;


    public $codigo;
    public $nombre;
    public $categoria;
    public $marca;
    public $x;

    public function mount()
    {
        $this->obtenerProductos();
        $this->empresa = Empresa::where('id', 1)->get();
        $this->productos = HelpersInventario::calculo_productos(productos::all());
    }
    protected $listeners = ['mensajeerrorcarrito'];


    // nueva funcionalidad de filtrado
    public function updated($propertyName)
    {
        $this->obtenerProductos();
    }
    public function obtenerProductos()
    {
        $query = productos::query();
        if ($this->codigo) {
            $query->where('codigo', 'like', '%' . $this->codigo . '%');
        }
        if ($this->nombre) {
            $query->where('nombre', 'like', '%' . $this->nombre . '%');
        }
        if ($this->categoria) {
            $query->where('categorias_id', $this->categoria);
        }
        if ($this->marca) {
            $query->where('marcas_id', $this->marca);
        }
        $this->productos = HelpersInventario::calculo_productos($query->get());
    }

    //_-------------------------------------

    // public function categoriaSeleccionada($categoriaId)
    // {
    //     $this->categoriaId = $categoriaId;
    //     $this->productos = HelpersInventario::calculo_productos(productos::where('categorias_id', $categoriaId)->get());
    // }
    // public function marcaSeleccionada($marcaId)
    // {
    //     $this->marcaId = $marcaId;
    //     $this->productos = HelpersInventario::calculo_productos(productos::where('marcas_id', $marcaId)->get());
    // }

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
        $this->validate(['productos2.' . $index . '.porcentaje_ganacia_tienda' => 'required|numeric|min:0',]);
        $productoId = $this->productos[$index]['id'];
        $producto = Productos::find($productoId); // Asegúrate de que el modelo sea correcto
        if ($producto) {
            $producto->porcentaje_ganacia_tienda = $this->productos2[$index]['porcentaje_ganacia_tienda'];
            $producto->save();
            $this->productos = HelpersInventario::calculo_productos(productos::all());
            //session()->flash('success', 'Porcentaje de ganancia actualizado exitosamente.');
            $this->emit('mostrarok', "Porcentaje de ganancia actualizado exitosamente.");
        } else {
            $this->emit('mostrarError', "Producto no encontrado.");
        }
    }

    public function render()
    {
        return view(
            'livewire.productosventa.productos-list',
            [
                'categorias' => Categorias::all(),
                'marcas' => marcas::all(),
            ]
        );
    }
}
