<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\marcas;
use Illuminate\Http\Request;

class marcasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = marcas::all();
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.registro');
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

        ]);
        $userId = auth()->user()->id;
        $marcas = marcas::create([
            'nombre' => $request->input('name'),
            'estado' => 'on',
            'user_id' => $userId

        ]);


        session()->flash('success', 'marca Registrada exitosamente.');
        return redirect()->to('/marcas');
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

        $marcas = marcas::find($id);

        return view('marcas.edit', compact('marcas'));
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

        ]);

        $marcas = marcas::findOrFail($id);
        $marcas->nombre = $request->input('name');
        $marcas->save();
        //Agregar mensaje flash de éxito
        session()->flash('success', 'Marca actualizada exitosamente.');
        return redirect()->to('/marcas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $mar = marcas::findOrFail($id);
        $mar->nombre = 'Eliminada_' . $id;
        $mar->estado = 'off';

        $mar->save();
        //Agregar mensaje flash de éxito
        session()->flash('success', 'Marca Eliminad exitosamente.');
        return redirect()->to('/marcas');
    }
}
