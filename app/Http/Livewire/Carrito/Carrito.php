<?php

namespace App\Http\Livewire\Carrito;

use App\Models\productos;
use Illuminate\Support\Facades\DB;


use Livewire\Component;

class Carrito extends Component
{
    public $carrito = [];
    public $mensajeError;
    public $totalCarrito = 0;
    public $metodoPago; // Nuevo campo para el método de pago
    // protected $listeners = ['agregarProductoAlCarrito'];

    public function mount()
    {
        $this->carrito = session()->get('carrito', []);
        $this->calcularTotalCarrito();
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
        $producto = productos::findOrFail($this->carrito[$index]['producto_id']);

        // Verificar si la cantidad no excede el stock disponible 
        if ($cantidad > $producto->stock->cantidad) {
            $this->emit('mostrarError', "No se puede añadir más de la cantidad disponible en stock.");

            //$this->mensajeError = "No se puede añadir más de la cantidad disponible en stock.";
        } else {
            $this->mensajeError = null;
            $this->carrito[$index]['cantidad'] = $cantidad;
            $this->carrito[$index]['subtotal'] = $this->carrito[$index]['precio'] * $cantidad;
            $this->calcularTotalCarrito();
            session()->put('carrito', $this->carrito);
            $this->emit('re'); // Emite el evento
            $this->emit('mostrarok', "Se actualizó el carrito.");
        }
    }

    public function eliminarProductoDelCarrito($index)
    {
        unset($this->carrito[$index]);
        $this->carrito = array_values($this->carrito);
        $this->calcularTotalCarrito();
        session()->put('carrito', $this->carrito);
        $this->emit('re'); // Emite el evento
        $this->emit('mostrarok', "Se quito producto de  carrito.");
    }


    public function realizarVenta()
    {

        $this->calcularTotalCarrito();


        if (count($this->carrito) === 0) {
            session()->flash('error', 'El carrito está vacío. No se puede realizar la venta.');
            return;
        }

        DB::beginTransaction();

        try {
            $venta = \App\Models\Venta::create([
                'user_id' => auth()->id(),
                'total' => $this->totalCarrito,
                'metodo_pago' => $this->metodoPago, // Captura del método de pago
            ]);

            foreach ($this->carrito as $item) {
                $producto = \App\Models\productos::findOrFail($item['producto_id']);

                \App\Models\VentaDetalle::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                    'subtotal' => $item['subtotal'],
                ]);

                $producto->stock->cantidad -= $item['cantidad'];
                $producto->stock->save();
            }

            DB::commit();

            $this->carrito = [];
            session()->forget('carrito');
            session()->flash('success', 'Venta realizada exitosamente.');
            $this->emit('ventaRealizada');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Hubo un problema al realizar la venta: ' . $e->getMessage());
        }
    }

    // public function realizarVenta()
    // {
    //     // Lógica para realizar la venta (guardar en la base de datos, manejar el inventario, etc.)
    //     $this->calcularTotalCarrito();
    //     $this->carrito = [];
    //     session()->forget('carrito');
    //     session()->flash('success', 'Venta realizada exitosamente.');
    // }


    public function calcularTotalCarrito()
    {
        $this->totalCarrito = array_reduce($this->carrito, function ($carry, $item) {
            return $carry + $item['subtotal'];
        }, 0);
    }
    public function render()
    {
        return view('livewire.carrito.carrito');
    }
}
