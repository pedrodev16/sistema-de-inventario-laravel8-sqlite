<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stock;

class StockAlert extends Component
{
    public $stocks;
    public $cant_stock;

    public function mount()
    {


        $this->stocks = Stock::where('cantidad', '<', 10)->get();
    }

    public function render()
    {
        $this->cant_stock = count($this->stocks);
        return view('livewire.stock-alert');
    }
}
