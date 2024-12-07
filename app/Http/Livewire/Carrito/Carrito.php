<?php

namespace App\Http\Livewire\Carrito;

use App\Models\productos;
use Livewire\Component;

class Carrito extends Component
{
    public $carrito = [];

    // protected $listeners = ['agregarProductoAlCarrito'];

    public function mount()
    {
        $this->carrito = session()->get('carrito', []);
    }

    // public function agregarProductoAlCarrito($productoId, $cantidad)
    // {
    //     $producto = productos::findOrFail($productoId);

    //     $index = collect($this->carrito)->search(function ($item) use ($productoId) {
    //         return $item['producto_id'] === $productoId;
    //     });

    //     if ($index !== false) {
    //         $this->carrito[$index]['cantidad'] += $cantidad;
    //         $this->carrito[$index]['subtotal'] = $this->carrito[$index]['precio'] * $this->carrito[$index]['cantidad'];
    //     } else {
    //         $this->carrito[] = [
    //             'producto_id' => $producto->id,
    //             'nombre' => $producto->nombre,
    //             'precio' => $producto->costo,
    //             'cantidad' => $cantidad,
    //             'subtotal' => $producto->costo * $cantidad,
    //         ];
    //     }

    //     session()->put('carrito', $this->carrito);
    // }

    public function actualizarCantidad($index, $cantidad)
    {
        $this->carrito[$index]['cantidad'] = $cantidad;
        $this->carrito[$index]['subtotal'] = $this->carrito[$index]['precio'] * $cantidad;

        session()->put('carrito', $this->carrito);
    }

    public function eliminarProductoDelCarrito($index)
    {
        unset($this->carrito[$index]);
        $this->carrito = array_values($this->carrito);

        session()->put('carrito', $this->carrito);
        $this->emit('re'); // Emite el evento
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
        return view('livewire.carrito.carrito');
    }
}
