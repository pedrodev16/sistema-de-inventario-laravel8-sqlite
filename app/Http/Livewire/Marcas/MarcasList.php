<?php

namespace App\Http\Livewire\Marcas;

use App\Models\marcas;
use Livewire\Component;

class MarcasList extends Component
{

    public $marcas;

    protected $listeners = ['renderMarcaList' => 'cargarMarcas'];

    public function mount()
    {
        $this->cargarMarcas();
    }

    public function cargarMarcas()
    {
        $this->marcas = marcas::all();
    }

    public function editarMarca($marcaId)
    {
        $this->emit('editarMarca', $marcaId);
    }

    public function render()
    {
        return view('livewire.marcas.marcas-list');
    }
}
