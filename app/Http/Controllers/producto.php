<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\marcas;
use App\Models\productos;
use App\Models\proveedores;
use Illuminate\Http\Request;

class producto extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = productos::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categorias = Categorias::where('estado', 'on')->get();
        $marcas = marcas::where('estado', 'on')->get();
        $proveedores = proveedores::where('estado', 'on')->get();

        return view('productos.registro', compact(['categorias', 'marcas', 'proveedores']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'costo' => 'required|numeric',
            'proveedor' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:productos',
        ]);

        try {
            $path = $request->file('imagen')->store('public/imagenes');
            productos::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'imagen' => $path,
                'costo' => $request->costo,
                'proveedor_id' => $request->proveedor,
                'categorias_id' => $request->categoria,
                'marcas_id' => $request->marca,
                'codigo' => $request->codigo,
                'user_id' => auth()->id(),
            ]);
            session()->flash('success', 'producto Registrado exitosamente.');
            return redirect()->to('/producto');
            //return response()->json(['mensaje' => 'Producto registrado con éxito'], 200);
        } catch (\Exception $e) {
            // Guarda el error en el registro o maneja de alguna manera 
            session()->flash('error', 'Hubo un problema al registrar el producto: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
