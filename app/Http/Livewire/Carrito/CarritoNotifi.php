<?php

namespace App\Http\Livewire\Carrito;

use App\Http\Controllers\producto;
use App\Models\productos;
use Livewire\Component;

class CarritoNotifi extends Component
{

    public $carrito = [];
    public $cant_not = 0;
    public $mensajeError;
    protected $listeners = ['agregarProductoAlCarrito', 're' => 'mount'];

    public function mount()
    {
        $this->carrito = session()->get('carrito', []);
    }

    public function agregarProductoAlCarrito($productoId, $cantidad)
    {
        $producto = calculo_producto(productos::findOrFail($productoId));

        $index = collect($this->carrito)->search(function ($item) use ($productoId) {
            return $item['producto_id'] === $productoId;
        });


        // Calcular la cantidad total que se quiere agregar al carrito
        $cantidadTotal = $index !== false ? $this->carrito[$index]['cantidad'] + $cantidad : $cantidad;

        // Verificar si la cantidad total no excede el stock disponible 
        if ($cantidadTotal > $producto->stock->cantidad) {
            // $this->mensajeError = "No se puede añadir más de la cantidad disponible en stock.";
            // $this->emit('mensajeerrorcarrito', $this->mensajeError);
            $this->emit('mostrarError', "No se puede añadir más de la cantidad disponible en stock.");
        } else {
            $this->mensajeError = null;
            if ($index !== false) {
                $this->carrito[$index]['cantidad'] += $cantidad;
                $this->carrito[$index]['subtotal'] = $this->carrito[$index]['precio'] * $this->carrito[$index]['cantidad'];
            } else {
                $this->carrito[] = [
                    'img' => $producto->imagen,
                    'producto_id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->costo_venta_usd,
                    'cantidad' => $cantidad,
                    'subtotal' => $producto->costo_venta_usd * $cantidad,
                ];
            }

            session()->put('carrito', $this->carrito);
            $this->emit('mostrarok', "se añadió producto al carrito.");
        }
    }

    public function actualizarCantidad($index, $cantidad)
    {
        $producto = productos::findOrFail($this->carrito[$index]['producto_id']);

        // Verificar si la cantidad no excede el stock disponible 
        if ($cantidad > $producto->stock->cantidad) {
            $this->emit('mostrarError', "No se puede añadir más de la cantidad disponible en stock.");

            // $this->mensajeError = "No se puede añadir más de la cantidad disponible en stock.";
        } else {
            $this->mensajeError = null;
            $this->carrito[$index]['cantidad'] = $cantidad;
            $this->carrito[$index]['subtotal'] = $this->carrito[$index]['precio'] * $cantidad;

            session()->put('carrito', $this->carrito);
            $this->emit('mostrarok', "Se actualizó el carrito.");
        }
    }
    public function eliminarProductoDelCarrito($index)
    {
        unset($this->carrito[$index]);
        $this->carrito = array_values($this->carrito);

        session()->put('carrito', $this->carrito);
        $this->emit('mostrarok', "Se quito producto de  carrito.");
    }

    public function realizarVenta()
    {
        // Lógica para realizar la venta (guardar en la base de datos, manejar el inventario, etc.)

        $this->carrito = [];
        session()->forget('carrito');
        session()->flash('success', 'Venta realizada exitosamente.');
    }
    public function render()
    {

        $this->cant_not = count($this->carrito);
        return view('livewire.carrito.carrito-notifi');
    }
}
