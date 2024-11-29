<?php

namespace App\Http\Controllers;

use App\Models\tipo_admin;
use App\Models\User;
use Illuminate\Http\Request;


class Usuarios extends Controller
{
    public function index()
    {
        //$usuarios = User::with('tipoAdmin')->get();
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }
    public function create()
    {
        $tipo = tipo_admin::obtenerIdYNombre();

        return view('usuarios.registro', compact('tipo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'tipo_admin' => 'required'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), // Encripta la contraseña
            'estado' => 'on',
            'tipo_admin_id' => $request->input('tipo_admin')
        ]);


        session()->flash('success', 'Usuario Registrado exitosamente.');
        return redirect()->to('/usuarios');
    }
    public function edit($id)
    {
        $tipo = tipo_admin::obtenerIdYNombre();
        $usuario = User::find($id);

        return view('usuarios.edit', compact(['tipo', 'usuario']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
            'tipo_admin' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password')); // Encripta la contraseña solo si se proporciona una nueva
        }

        $user->tipo_admin_id = $request->input('tipo_admin');

        $user->save();
        //Agregar mensaje flash de éxito
        session()->flash('success', 'Usuario actualizado exitosamente.');
        return redirect()->to('/usuarios');
    }

    public function elimina($id)
    {


        $user = User::findOrFail($id);
        $user->email = $user->email . '#' . $id;
        $user->password = ''; // Encripta la contraseña solo si se proporciona una nueva
        $user->estado = 'off';

        $user->save();
        //Agregar mensaje flash de éxito
        session()->flash('success', 'Usuario Eliminad exitosamente.');
        return redirect()->to('/usuarios');
    }
}
