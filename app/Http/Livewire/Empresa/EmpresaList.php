<?php

namespace App\Http\Livewire\Empresa;

use App\Models\Empresa;
use Livewire\Component;

class EmpresaList extends Component
{

    public $empresas;

    protected $listeners = ['renderEmpresaList' => 'cargarEmpresas'];

    public function mount()
    {
        $this->cargarEmpresas();
    }

    public function cargarEmpresas()
    {
        $this->empresas = Empresa::all();
    }

    public function editarEmpresa($empresaId)
    {
        $this->emit('editarEmpresa', $empresaId);
    }


    public function render()
    {
        return view('livewire.empresa.empresa-list');
    }
}
