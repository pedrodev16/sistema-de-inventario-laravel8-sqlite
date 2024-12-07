<?php

namespace App\Http\Livewire\Proveedores;

use App\Models\proveedores;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormularioProveedor extends Component
{

    use WithFileUploads;

    public $proveedorId;
    public $nombre;
    public $contacto;
    public $estado = 'on';
    public $userId;

    protected $rules = [
        'nombre' => 'required|min:3|max:60',
        'contacto' => 'required|min:3|max:60',
    ];

    protected $listeners = ['editarProveedor' => 'cargarProveedor'];

    public function mount()
    {
        $this->userId = auth()->id();
    }

    public function cargarProveedor($proveedorId)
    {
        $proveedor = proveedores::findOrFail($proveedorId);
        $this->proveedorId = $proveedor->id;
        $this->nombre = $proveedor->nombre;
        $this->contacto = $proveedor->contacto;
        $this->estado = $proveedor->estado;
    }

    public function save()
    {
        $data = $this->validate([
            'nombre' => 'required|min:3|max:60',
            'contacto' => 'required|min:3|max:60',
        ]);

        if ($this->proveedorId) {
            // Editar proveedor existente
            $proveedor = proveedores::findOrFail($this->proveedorId);
            $proveedor->update([
                'nombre' => $this->nombre,
                'contacto' => $this->contacto,
                'estado' => $this->estado,
                'user_id' => $this->userId,
            ]);
            session()->flash('success', 'Proveedor actualizado exitosamente.');
        } else {
            // Crear nuevo proveedor
            proveedores::create([
                'nombre' => $this->nombre,
                'contacto' => $this->contacto,
                'estado' => $this->estado,
                'user_id' => $this->userId,
            ]);
            session()->flash('success', 'Proveedor registrado exitosamente.');
        }

        $this->emit('renderProveedorList');
        $this->reset(['nombre', 'contacto', 'proveedorId', 'estado']);
    }

    public function render()
    {
        return view('livewire.proveedores.formulario-proveedor');
    }
}
