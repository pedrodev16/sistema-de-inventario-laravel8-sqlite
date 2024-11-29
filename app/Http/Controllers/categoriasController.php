<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class categoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categorias::all();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.registro');
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
            'name' => 'required|min:3|max:50',

        ]);
        $userId = auth()->user()->id;
        $categorias = Categorias::create([
            'nombre' => $request->input('name'),
            'estado' => 'on',
            'user_id' => $userId

        ]);


        session()->flash('success', 'Categoria Registrada exitosamente.');
        return redirect()->to('/categorias');
    }

    /**
     * Display the specified resource.
     *
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

        $categorias = Categorias::find($id);

        return view('categorias.edit', compact('categorias'));
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
            'name' => 'required|min:3|max:50',

        ]);

        $categorias = Categorias::findOrFail($id);
        $categorias->nombre = $request->input('name');
        $categorias->save();
        //Agregar mensaje flash de éxito
        session()->flash('success', 'Categoria actualizada exitosamente.');
        return redirect()->to('/categorias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $cat = categorias::findOrFail($id);
        $cat->nombre = 'Eliminada_' . $id;
        $cat->estado = 'off';

        $cat->save();
        //Agregar mensaje flash de éxito
        session()->flash('success', 'Categoria Eliminad exitosamente.');
        return redirect()->to('/categorias');
    }
}
