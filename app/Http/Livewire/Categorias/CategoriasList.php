<?php

namespace App\Http\Livewire\Categorias;

use App\Models\Categorias;
use Livewire\Component;

class CategoriasList extends Component
{


    public $categorias;

    protected $listeners = ['renderCategoriaList' => 'cargarCategorias'];

    public function mount()
    {
        $this->cargarCategorias();
    }

    public function cargarCategorias()
    {
        $this->categorias = Categorias::all();
    }

    public function editarCategoria($categoriaId)
    {
        $this->emit('editarCategoria', $categoriaId);
    }

    public function render()
    {
        return view('livewire.categorias.categorias-list');
    }
}
