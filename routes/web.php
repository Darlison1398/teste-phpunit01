<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\NotaCompraController;

Route::resource('produtos', ProdutoController::class);

Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
Route::resource('clientes', ClienteController::class);
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('notas/criar', [NotaCompraController::class, 'create'])->name('notas.create');
Route::post('notas', [NotaCompraController::class, 'store'])->name('notas.store');

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
    return view('welcome');
});
