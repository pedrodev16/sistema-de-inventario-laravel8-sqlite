<?php

namespace App\Http\Livewire\Stock;

use App\Models\stock;
use Livewire\Component;

class StockList extends Component
{

    public $stock;

    protected $listeners = ['renderlist' => 'mount'];
    public function mount()
    {
        $this->stock = stock::orderBy('id', 'desc')->get();
    }

    public function editStock($stockId)
    {
        $this->emit('editStock', $stockId);
    }

    public function render()
    {
        return view('livewire.stock.stock-list');
    }
}
