<?php

use App\Http\Livewire\CategoriasController;
use App\Http\Livewire\MedidasController;
use App\Http\Livewire\ProductosController;
use App\Http\Livewire\ClientesController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\UsuariosController;
use App\Http\Livewire\EmpresaController;
use App\Http\Livewire\CondicionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('categorias', CategoriasController::class)->middleware('auth')->name('categorias');
Route::get('medidas', MedidasController::class)->middleware('auth')->name('medidas');
Route::get('productos', ProductosController::class)->middleware('auth')->name('productos');
Route::get('clientes', ClientesController::class)->middleware('auth')->name('clientes');
Route::get('roles', RolesController::class)->middleware('auth')->name('roles');
Route::get('permisos', PermisosController::class)->middleware('auth')->name('permisos');
Route::get('usuarios', UsuariosController::class)->middleware('auth')->name('usuarios');
Route::get('empresa', EmpresaController::class)->middleware('auth')->name('empresa');
Route::get('condicion', CondicionController::class)->middleware('auth')->name('condicion');



