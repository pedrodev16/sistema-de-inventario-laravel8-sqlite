<?php

use App\Http\Controllers\categoriasController;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\marcasController;
use App\Http\Controllers\producto;
use App\Http\Controllers\productos;
use App\Http\Controllers\Productoscontroller;
use App\Http\Controllers\proveedorController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\report;
use App\Http\Controllers\stock;
use App\Http\Controllers\Usuarios;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
7| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login.index');

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::get('/home', [LoginController::class, 'index'])->name('login.index');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

// ruta protegida
Route::middleware(['auth'])->group(function () {


    Route::get('/salir', [LoginController::class, 'salir'])->name('login.salir');



    Route::get('/', function () {

        return view('dashboard');
    })->name('dashboard');;


    Route::get('/home', function () {
        return view('dashboard');
    })->name('dashboard');;

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');;


    Route::get('/usuarios', function () {
        if (Auth::user()->hasRole('alto')) {
            return view('usuarios.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('usuarios.index');;



    Route::get('/stock', function () {
        if (Auth::user()->hasRole('alto')) {
            return view('stock.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('stock.index');;

    Route::get('/productos', function () {
        if (Auth::user()->hasRole('medio') || Auth::user()->hasRole('alto')) {
            return view('productosventas.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('productos.index');;


    Route::get('/carrito', function () {
        if (Auth::user()->hasRole('medio') || Auth::user()->hasRole('alto')) {
            return view('carrito.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('carrito.index');;

    Route::get('/perfilempresa', function () {
        if (Auth::user()->hasRole('alto')) {
            return view('empresa.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('empresa.index');;

    Route::get('/ventas', function () {
        if (Auth::user()->hasRole('medio') || Auth::user()->hasRole('alto')) {
            return view('ventas.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('ventas.index');

    Route::get('/cuadre', function () {
        if (Auth::user()->hasRole('alto')) {
            return view('cuadre.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('cuadre.index');

    Route::get('/historiacuadre', function () {
        if (Auth::user()->hasRole('alto')) {
            return view('cuadre.HistoriaCuadre');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('cuadre.hostoria');

    Route::get('/categorias', function () {
        if (Auth::user()->hasRole('alto')) {
            return view('categorias.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('categorias.index');

    Route::get('/proveedor', function () {
        if (Auth::user()->hasRole('alto')) {
            return view('proveedor.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('proveedor.index');

    Route::get('/marcas', function () {
        if (Auth::user()->hasRole('alto')) {
            return view('marcas.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('marcas.index');

    Route::get('/producto', function () {
        if (Auth::user()->hasRole('alto')) {
            return view('productos.index');
        }
        return redirect('/'); // Redirigir a página de acceso denegado
    })->name('producto.index');
});

Route::get('/salir', [LoginController::class, 'salir'])->name('login.salir');


Route::get('/reporte', [report::class, 'generarPDF'])->name('reporte.pdf');
Route::get('/reportev/{id}', [report::class, 'reporteventa'])->name('reporte.venta');
Route::post('/reportev', [report::class, 'reporteventa_filtros'])->name('reporte.ventafiltro');
Route::post('/catalagop', [report::class, 'catalago_de_productos'])->name('catalagop');
