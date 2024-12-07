<?php

namespace App\Http\Livewire\Marcas;

use App\Models\marcas;
use Livewire\Component;

class MarcasForm extends Component
{


    public $marcaId;
    public $nombre;
    public $estado = 'on';
    public $userId;

    protected $rules = [
        'nombre' => 'required|min:3|max:60',
    ];

    protected $listeners = ['editarMarca' => 'cargarMarca'];

    public function mount()
    {
        $this->userId = auth()->id();
    }

    public function cargarMarca($marcaId)
    {
        $marca = marcas::findOrFail($marcaId);
        $this->marcaId = $marca->id;
        $this->nombre = $marca->nombre;
        $this->estado = $marca->estado;
    }

    public function save()
    {
        $data = $this->validate([
            'nombre' => 'required|min:3|max:60',
        ]);

        if ($this->marcaId) {
            // Editar marca existente
            $marca = marcas::findOrFail($this->marcaId);
            $marca->update([
                'nombre' => $this->nombre,
                'estado' => $this->estado,
                'user_id' => $this->userId,
            ]);
            session()->flash('success', 'Marca actualizada exitosamente.');
        } else {
            // Crear nueva marca
            marcas::create([
                'nombre' => $this->nombre,
                'estado' => $this->estado,
                'user_id' => $this->userId,
            ]);
            session()->flash('success', 'Marca registrada exitosamente.');
        }

        $this->emit('renderMarcaList');
        $this->reset(['nombre', 'marcaId', 'estado']);
    }



    public function render()
    {
        return view('livewire.marcas.marcas-form');
    }
}
