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

Route::get('/cliente/create',[ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente',[ClienteController::class, 'store'])->name('cliente.store');
// ---------------------------------------------------------------------------------
//Atualizar os dados do cliente no banco de dados

Route::get('/clientes/edit/{cliente}', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/update/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');

// ---------------------------------------------------------------------------------

//Deletar os dados do cliente no banco de dados
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

// ---------------------------------------------------------------------------------

Route::get('/estoques/create',[estoqueController::class, 'create'])->name('estoques.create');
Route::post('/estoques',[estoqueController::class, 'store'])->name('estoques.store');
// ---------------------------------------------------------------------------------
//Atualizar os dados do estoques no banco de dados

Route::get('/estoques/edit/{estoques}', [estoqueController::class, 'edit'])->name('estoques.edit');
Route::put('/estoques/update/{estoques}', [estoqueController::class, 'update'])->name('estoques.update');

// ---------------------------------------------------------------------------------

//Deletar os dados do estoques no banco de dados
Route::delete('/estoques/{estoques}', [estoqueController::class, 'destroy'])->name('estoques.destroy');




Route::get('/cliente', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/fornecedores', [FornecedoresController::class, 'index'])->name('fornecedores.index');
Route::get('/estoques', [EstoqueController::class, 'index'])->name('estoques.index');
Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index');
Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
