<?php

namespace App\Http\Livewire\Categorias;

use App\Models\Categorias;
use Livewire\Component;

class CategoriasForm extends Component
{

    public $categoriaId;
    public $nombre;
    public $estado = 'on';
    public $userId;

    protected $rules = [
        'nombre' => 'required|min:3|max:50',
    ];

    protected $listeners = ['editarCategoria' => 'cargarCategoria'];

    public function mount()
    {
        $this->userId = auth()->id();
    }

    public function cargarCategoria($categoriaId)
    {
        $categoria = Categorias::findOrFail($categoriaId);
        $this->categoriaId = $categoria->id;
        $this->nombre = $categoria->nombre;
        $this->estado = $categoria->estado;
    }

    public function save()
    {
        $data = $this->validate([
            'nombre' => 'required|min:3|max:50',
        ]);

        if ($this->categoriaId) {
            // Editar categoría existente
            $categoria = Categorias::findOrFail($this->categoriaId);
            $categoria->update([
                'nombre' => $this->nombre,
                'estado' => $this->estado,
                'user_id' => $this->userId,
            ]);
            session()->flash('success', 'Categoría actualizada exitosamente.');
        } else {
            // Crear nueva categoría
            Categorias::create([
                'nombre' => $this->nombre,
                'estado' => $this->estado,
                'user_id' => $this->userId,
            ]);
            session()->flash('success', 'Categoría registrada exitosamente.');
        }

        $this->emit('renderCategoriaList');
        $this->reset(['nombre', 'categoriaId', 'estado']);
    }
    public function render()
    {
        return view('livewire.categorias.categorias-form');
    }
}
