<?php

namespace App\Http\Controllers;

use App\Models\stock as ModelsStock;
use Illuminate\Http\Request;

class stock extends Controller
{
    public function index()
    {
        $stock = ModelsStock::with('productos')->orderBy('id', 'desc')->get();
        return view('stock.index', compact('stock'));
    }
}
