<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    public function index(){


        return view('auth.login');
       }


       public function login(){

        return view('auth.login');

       }

       public function store(Request $request)
       {
           $credentials = $request->validate([
               'email' => 'required|email',
               'password' => 'required',
           ]);

           if (Auth::attempt($credentials)) {
               return redirect()->intended('/dashboard'); // Redirige al dashboard si las credenciales son válidas
           } else {
               throw ValidationException::withMessages([
                   'email' => 'Credenciales incorrectas. Inténtalo de nuevo.',
               ]);
           }
       }

       public function salir()
       {
           Auth::logout();
           return redirect('/'); // Redirige al formulario de inicio de sesión
       }
}
