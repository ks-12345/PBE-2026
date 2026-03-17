<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------------------------------------------------------------------------------
// Clientes
// ---------------------------------------------------------------------------------
Route::resource('clientes', ClienteController::class);

// ---------------------------------------------------------------------------------
// Fornecedores
// ---------------------------------------------------------------------------------
Route::resource('fornecedores', FornecedoresController::class);

// ---------------------------------------------------------------------------------
// Estoques
// ---------------------------------------------------------------------------------
Route::resource('estoques', EstoqueController::class);

// ---------------------------------------------------------------------------------
// Pedidos
// ---------------------------------------------------------------------------------
Route::resource('pedidos', PedidosController::class);

// ---------------------------------------------------------------------------------
// Produtos
// ---------------------------------------------------------------------------------
Route::resource('produtos', ProdutosController::class);

require __DIR__.'/auth.php';