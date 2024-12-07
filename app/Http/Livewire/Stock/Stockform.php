<?php

namespace App\Http\Livewire\Stock;

use App\Models\stock;
use Carbon\Carbon;
use Livewire\Component;

class Stockform extends Component
{
    public $stockId;
    public $cantidad;
    public $ubicacion;

    protected $listeners = ['editStock'];
    public function editStock($stockId)
    {
        $stock = stock::findOrFail($stockId);
        $this->stockId = $stock->id;
        $this->cantidad = $stock->cantidad;
        $this->ubicacion = $stock->ubicacion;
    }

    public function updateStock()
    {
        $this->validate(
            [
                'cantidad' => 'required|integer|min:0',
                'ubicacion' => 'nullable|string|max:255',
            ]
        );
        $stock = stock::findOrFail($this->stockId);
        $stock->update([
            'cantidad' => $this->cantidad,
            'ubicacion' => $this->ubicacion,
            'fecha_entrada' => Carbon::now(), // Inserta la fecha de entrada actual
        ]);
        session()->flash('success', 'Stock actualizado exitosamente.');
        $this->emit('stockUpdated'); // Emitir evento para actualizar la lista 
        $this->emit('renderlist'); // Emite el evento
    }
    public function render()
    {
        return view('livewire.stock.stockform');
    }
}
