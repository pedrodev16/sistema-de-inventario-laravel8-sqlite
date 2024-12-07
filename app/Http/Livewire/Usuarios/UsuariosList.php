<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use Livewire\Component;

class UsuariosList extends Component
{

    public $usuarios = [];

    protected $listeners = ['usuarioRegistrado' => 'cargarUsuarios'];

    public function mount()
    {
        $this->cargarUsuarios();
    }

    public function cargarUsuarios()
    {
        $this->usuarios = User::all();
    }

    public function editarUsuario($userId)
    {
        $this->emit('editarUsuario', $userId);
    }

    public function render()
    {
        return view('livewire.usuarios.usuarios-list');
    }
}
