<?php

namespace App\Http\Livewire;

use App\Models\Operaciones;
use Livewire\Component;


class ApplicationHistory extends Component
{
    public $historia;
    public function mount()
    {
        $this->historia = Operaciones::all();
    }
    public function render()
    {
        return view('livewire.application-history');
    }
}
