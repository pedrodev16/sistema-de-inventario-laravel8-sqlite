<?php

namespace App\Http\Livewire\Empresa;

use App\Models\Empresa;
use Carbon\Carbon;
use Livewire\Component;

class FormularioEmpresa extends Component
{

    public $empresaId;
    public $nombre_empresa;
    public $fecha_registro;
    public $precio_dolar;
    public $porcentaje_iva;
    public $porcentaje_mercadolibre;
    public $porcentaje_ganacia_tienda;

    protected $rules = [
        'nombre_empresa' => 'required|min:3|max:255',
        'fecha_registro' => 'required|date',
        'precio_dolar' => 'required|numeric|min:0',
        'porcentaje_iva' => 'required|numeric|min:0|max:100',
        'porcentaje_mercadolibre' => 'required|numeric|min:0|max:100',
        'porcentaje_ganacia_tienda' => 'required|numeric|min:0|max:100',
    ];

    protected $listeners = ['editarEmpresa' => 'cargarEmpresa'];

    public function cargarEmpresa($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        $this->empresaId = $empresa->id;
        $this->nombre_empresa = $empresa->nombre_empresa;
        $this->fecha_registro = Carbon::parse($empresa->fecha_registro)->format('Y-m-d');
        $this->precio_dolar = $empresa->precio_dolar;
        $this->porcentaje_iva = $empresa->porcentaje_iva;
        $this->porcentaje_mercadolibre = $empresa->porcentaje_mercadolibre;
        $this->porcentaje_ganacia_tienda = $empresa->porcentaje_ganacia_tienda;
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->empresaId) {
            // Editar empresa existente
            $empresa = Empresa::findOrFail($this->empresaId);
            $empresa->update($data);
            session()->flash('success', 'Perfil de empresa actualizado exitosamente.');
        } else {
            // Crear nueva empresa
            Empresa::create($data);
            session()->flash('success', 'Perfil de empresa registrado exitosamente.');
        }

        $this->emit('renderEmpresaList');
        $this->reset(['empresaId', 'nombre_empresa', 'fecha_registro', 'precio_dolar', 'porcentaje_iva', 'porcentaje_mercadolibre', 'porcentaje_ganacia_tienda']);
    }

    public function render()
    {
        return view('livewire.empresa.formulario-empresa');
    }
}
