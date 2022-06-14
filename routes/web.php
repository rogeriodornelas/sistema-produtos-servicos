<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ServicoController;
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

Route::get('produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::post('produtos', [ProdutoController::class, 'insert'])->name('produtos.insert');
Route::get('produtos/edit/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
Route::put('produtos/update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
Route::get('produtos/delete/{id}', [ProdutoController::class, 'delete'])->name('produtos.delete');

Route::get('servicos', [ServicoController::class, 'index'])->name('servicos.index');
Route::post('servicos', [ServicoController::class, 'insert'])->name('servicos.insert');
Route::get('servicos/edit/{id}', [ServicoController::class, 'edit'])->name('servicos.edit');
Route::get('servicos/delete/{id}', [ServicoController::class, 'delete'])->name('servicos.delete');

Route::get('/', function () {
    return view('welcome');
});
