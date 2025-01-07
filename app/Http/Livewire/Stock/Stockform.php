<?php

namespace App\Http\Livewire\Stock;

use App\Models\HistoriaStock;
use App\Models\Operaciones;
use App\Models\stock;
use Carbon\Carbon;
use Livewire\Component;

class Stockform extends Component
{
    public $stockId;
    public $cantidad;
    public $ubicacion;
    public $ubicacion2;
    public $estado = 'Activo';

    protected $listeners = ['editStock'];
    public function editStock($stockId)
    {
        $stock = stock::findOrFail($stockId);
        $this->stockId = $stock->id;
        $this->cantidad = $stock->cantidad;
        $this->ubicacion = $stock->ubicacion;
        $this->ubicacion2 = $stock->ubicacion2;
        $this->estado = $stock->estado;
    }

    public function updateStock()
    {
        $this->validate(
            [
                'cantidad' => 'required|integer|min:0',
                'ubicacion' => 'nullable|string|max:255',
                'ubicacion2' => 'nullable|string|max:255',
                'estado' => 'required|string|max:255',
            ]
        );
        $stock = stock::findOrFail($this->stockId);

        // Validar que la nueva cantidad sea mayor o igual a la cantidad actual
        if ($this->cantidad >= $stock->cantidad) {


            $stock->update([
                'cantidad' => $this->cantidad,
                'ubicacion' => $this->ubicacion,
                'ubicacion2' => $this->ubicacion2,
                'estado' => $this->estado,
                'fecha_entrada' => Carbon::now(), // Inserta la fecha de entrada actual
            ]);

            $historia = HistoriaStock::create([
                'Producto' => $stock->productos->nombre,
                'IDProducto' => $stock->productos->id,
                'cantidad' => $this->cantidad,
                'tipo_movimiento' => 'Entrada',
                'fecha' => Carbon::now(),
            ]);

            $operacion = Operaciones::create([
                'tipo' => 'Entrada',
                'descripcion' => 'Se ha actualizado el stock del producto ' . $stock->productos->nombre . ' con la cantidad de ' . $this->cantidad . ' unidades.',
            ]);

            session()->flash('success', 'Stock actualizado exitosamente.');
            $this->emit('stockUpdated'); // Emitir evento para actualizar la lista 
            $this->emit('renderlist'); // Emite el evento


        } else {
            $this->emit('mostrarError', "La nueva cantidad no puede ser menor a la cantidad actual.");
        }
    }
    public function render()
    {
        return view('livewire.stock.stockform');
    }
}
