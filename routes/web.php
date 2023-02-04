<?php

use App\Http\Livewire\CategoriasController;
use App\Http\Livewire\MedidasController;
use App\Http\Livewire\ProductosController;
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
