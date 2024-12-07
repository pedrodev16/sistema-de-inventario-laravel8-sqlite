<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class productos extends Controller
{
    public function index()
    {
        //$stock = ModelsStock::with('productos')->orderBy('id', 'desc')->get();
        return view('productosventas.index');
    }
}
