<?php

namespace App\Http\Livewire\Product;

use App\Models\Categorias;
use App\Models\marcas;
use App\Models\productos;
use App\Models\proveedores;
use App\Models\stock;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormularioProduct extends Component
{
    use WithFileUploads;

    public $productoId;
    public $nombre;
    public $descripcion;
    public $imagen;
    public $nuevaImagen;
    public $costo;
    public $proveedor;
    public $categoria;
    public $marca;
    public $codigo;
    public $porcentaje_ganacia_tienda;

    public $proveedores;
    public $categorias;
    public $marcas;

    protected $rules = [
        'nombre' => 'required|min:3|max:50',
        'descripcion' => 'required|string',
        'nuevaImagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|',
        'costo' => 'required|numeric',
        'porcentaje_ganacia_tienda' => 'required|numeric|min:0|max:100',
        'proveedor' => 'required',
        'categoria' => 'required',
        'marca' => 'required',
        'codigo' => 'required|string|max:255|unique:productos,codigo',
    ];

    protected $listeners = ['editarProducto' => 'cargarProducto'];

    public function mount()
    {
        $this->categorias = Categorias::where('estado', 'on')->get();
        $this->marcas = marcas::where('estado', 'on')->get();
        $this->proveedores = proveedores::where('estado', 'on')->get();
    }

    public function cargarProducto($productoId)
    {
        $producto = productos::findOrFail($productoId);
        $this->productoId = $producto->id;
        $this->nombre = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->imagen = $producto->imagen;
        $this->costo = $producto->costo;
        $this->porcentaje_ganacia_tienda = $producto->porcentaje_ganacia_tienda;
        $this->proveedor = $producto->proveedor_id;
        $this->categoria = $producto->categorias_id;
        $this->marca = $producto->marcas_id;
        $this->codigo = $producto->codigo;
    }

    public function save()
    {
        $data = $this->validate([
            'nombre' => 'required|min:3|max:50',
            'descripcion' => 'required|string',
            'nuevaImagen' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'costo' => 'required|numeric',
            'porcentaje_ganacia_tienda' => 'required|numeric|min:0|max:100',
            'proveedor' => 'required',
            'categoria' => 'required',
            'marca' => 'required',
            'codigo' => 'required|string|max:255|unique:productos,codigo,' . $this->productoId,
        ]);

        if ($this->productoId) {
            // Editar producto existente
            $producto = productos::findOrFail($this->productoId);
            if ($this->nuevaImagen) {
                $data['imagen'] = $this->nuevaImagen->store('public/imagenes');
            } else {
                $data['imagen'] = $producto->imagen;
            }

            $producto->update([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'imagen' => $data['imagen'],
                'costo' => $this->costo,
                'porcentaje_ganacia_tienda' => $this->porcentaje_ganacia_tienda,
                'proveedor_id' => $this->proveedor,
                'categorias_id' => $this->categoria,
                'marcas_id' => $this->marca,
                'codigo' => $this->codigo,
            ]);
            session()->flash('success', 'Producto actualizado exitosamente.');
        } else {
            // Crear nuevo producto
            $path = $this->nuevaImagen->store('public/imagenes');
            $producto = productos::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'imagen' => $path,
                'costo' => $this->costo,
                'porcentaje_ganacia_tienda' => $this->porcentaje_ganacia_tienda,
                'proveedor_id' => $this->proveedor,
                'categorias_id' => $this->categoria,
                'marcas_id' => $this->marca,
                'user_id' => auth()->id(),
                'codigo' => $this->codigo,
            ]);

            // Crear una entrada en la tabla de stock
            stock::create([
                'producto_id' => $producto->id,
                'cantidad' => 0,
                'estado' => 'disponible'
            ]);

            session()->flash('success', 'Producto registrado exitosamente.');
        }

        $this->emit('renderlist');
        $this->reset(['nombre', 'descripcion', 'nuevaImagen', 'costo', 'porcentaje_ganacia_tienda', 'proveedor', 'categoria', 'marca', 'codigo', 'productoId', 'imagen']);
    }

    public function render()
    {
        return view('livewire.product.formulario-product');
    }
}
