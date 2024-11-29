<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class dashboard extends Controller
{
  public function index()
  {
    $user = Auth::user();

    // Prueba rápida en tu controlador para ver si la relación está funcionando
    // $use = User::with('tipoAdmin')->find(Auth::id());
    // dd($use->toArray());

    return view('dashboard', compact('user'));
  }
}
