<?php

namespace App\Http\Controllers;

use App\Models\proveedores;
use Illuminate\Http\Request;

class proveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedor = proveedores::all();
        return view('proveedor.index', compact('proveedor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedor.registro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:60',
            'contacto' => 'required|min:3|max:60',

        ]);
        $userId = auth()->user()->id;
        $proveedor = proveedores::create([
            'nombre' => $request->input('name'),
            'contacto' => $request->input('contacto'),
            'estado' => 'on',
            'user_id' => $userId

        ]);


        session()->flash('success', 'proveedor Registrada exitosamente.');
        return redirect()->to('/proveedor');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $proveedor = proveedores::find($id);

        return view('proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:60',
            'contacto' => 'required|min:3|max:60',

        ]);

        $provedor = proveedores::findOrFail($id);
        $provedor->nombre = $request->input('name');
        $provedor->contacto = $request->input('contacto');
        $provedor->save();
        //Agregar mensaje flash de éxito
        session()->flash('success', 'proveedor actualizado exitosamente.');
        return redirect()->to('/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $provedor = proveedores::findOrFail($id);
        $provedor->nombre = 'Eliminada_' . $id;
        $provedor->estado = 'off';

        $provedor->save();
        //Agregar mensaje flash de éxito
        session()->flash('success', 'proveedor Eliminad exitosamente.');
        return redirect()->to('/proveedor');
    }
}
