<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\tipo_admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class FormularioUsuarios extends Component
{


    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $tipo_admin;
    public $tipos = [];

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'nullable|string|min:6|confirmed',
        'tipo_admin' => 'required|exists:tipo_admins,id',
    ];

    protected $listeners = ['editarUsuario' => 'cargarUsuario'];

    public function mount()
    {
        $this->tipos = tipo_admin::all();
    }

    public function cargarUsuario($userId)
    {
        $usuario = User::findOrFail($userId);
        $this->userId = $usuario->id;
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->tipo_admin = $usuario->tipo_admin_id;
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|string|min:6|confirmed',
            'tipo_admin' => 'required|exists:tipo_admins,id',
        ]);

        if ($this->userId) {
            // Editar usuario existente
            $usuario = User::findOrFail($this->userId);
            $usuario->update([
                'name' => $this->name,
                'email' => $this->email,
                'tipo_admin_id' => $this->tipo_admin,
                'password' => $this->password ? Hash::make($this->password) : $usuario->password,
            ]);
            session()->flash('success', 'Usuario actualizado exitosamente.');
        } else {
            // Crear nuevo usuario
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'tipo_admin_id' => $this->tipo_admin,
                'estado' => 'on'
            ]);
            session()->flash('success', 'Usuario registrado exitosamente.');
        }

        $this->emit('usuarioRegistrado');
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'tipo_admin', 'userId']);
    }


    public function render()
    {
        return view('livewire.usuarios.formulario-usuarios');
    }
}
