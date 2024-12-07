<?php

namespace App\Http\Livewire\Proveedores;

use App\Models\proveedores;
use Livewire\Component;

class ProveedoresList extends Component
{

    public $proveedores;

    protected $listeners = ['renderProveedorList' => 'cargarProveedores'];

    public function mount()
    {
        $this->cargarProveedores();
    }

    public function cargarProveedores()
    {
        $this->proveedores = proveedores::all();
    }

    public function editarProveedor($proveedorId)
    {
        $this->emit('editarProveedor', $proveedorId);
    }

    public function render()
    {
        return view('livewire.proveedores.proveedores-list');
    }
}
