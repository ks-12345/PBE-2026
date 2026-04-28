<?php

use App\Http\Controllers\MarvelController;
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('pokedex', [PokemonController::class, 'index']);
Route::get('paises', [MarvelController::class, 'index']);

Route::get('pokemon/{nome}', function ($nome) {
    $response =Http::get("https://pokeapi.co/api/v2/pokemon/{$nome}");
    if ($response->successful()) {
        $dados = $response->json();
        return response()->json([
            'status' => 'Conectado com sucesso',
            'resultado'=> [ 
            'identificador' => $dados['id'],
            'nome_do_pokemon' => ucfirst($dados['name']),
            'foto' => $dados ['sprites']['front_default']
            ]
        ]);
    }

return response()->json(['erro' => 'Pokemon não foi encontrado'], 404);
});
Route::post ('pokemon/novo', function(Request $request) {
    $dados = $request->validate ([
        'name' => 'required[string|min:3',
        'tipo' => 'required[string',
        'ataque' => 'required[integer'
    ]);

    return response()->json([
        'mensagem'=> 'pokemon cadastrado com sucesso',
        'id_gerado' => rand(1000, 1999),
        'dados_recebidos' => $dados
    ], 201);
});

Route::get('/', function () {
    return view('welcome');
});