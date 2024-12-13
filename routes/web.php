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
use App\Http\Controllers\stock;
use App\Http\Controllers\Usuarios;
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

// Route::get('/home', [LoginController::class, 'index'])->name('login.index');


Route::middleware(['guest'])->group(function () {



    Route::get('/', [LoginController::class, 'index'])->name('login.index');

    Route::get('/home', [LoginController::class, 'index'])->name('login.index');



    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

// ruta protegida
Route::middleware(['auth'])->group(function () {


    Route::get('/', [dashboard::class, 'index'])->name('dashboard');
    Route::get('/home', [dashboard::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [dashboard::class, 'index'])->name('dashboard.salir');
    Route::get('/salir', [LoginController::class, 'salir'])->name('login.salir');

    Route::get('/usuarios', [Usuarios::class, 'index'])->name('usuarios.index');
    Route::get('/Us-registro', [Usuarios::class, 'create'])->name('registro.index');
    Route::post('/Us-registro', [Usuarios::class, 'store'])->name('registro.store');
    Route::get('/Us-edit/{id}', [Usuarios::class, 'edit'])->name('Usuario.edit');
    Route::get('/Us-del/{id}', [Usuarios::class, 'elimina'])->name('Usuario.del');
    Route::post('/Us-update/{id}', [Usuarios::class, 'update'])->name('Usuario.update');

    Route::get('/stock', [stock::class, 'index'])->name('stock.index');
    Route::get('/productos', [productos::class, 'index'])->name('productos.index');

    Route::get('/carrito', function () {
        return view('carrito.index');
    })->name('carrito.index');;

    Route::get('/perfilempresa', function () {
        return view('empresa.index');
    })->name('empresa.index');;

    Route::get('/ventas', function () {
        return view('ventas.index');
    })->name('ventas.index');

    Route::get('/cuadre', function () {
        return view('cuadre.index');
    })->name('cuadre.index');

    Route::get('/historiacuadre', function () {
        return view('cuadre.HistoriaCuadre');
    })->name('cuadre.hostoria');


    Route::resource('categorias', categoriasController::class);
    Route::resource('marcas', marcasController::class);
    Route::resource('proveedor', proveedorController::class);
    Route::resource('producto', producto::class);
    //Route::post('productos_r', [Productoscontroller::class, 'store'])->name('producto.r');
});

Route::get('/salir', [LoginController::class, 'salir'])->name('login.salir');
