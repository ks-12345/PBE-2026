<?php

use App\Http\Controllers\MarvelController;
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

// Route::get('pokedex', [PokemonController::class, 'index']);
Route::get('paises', [MarvelController::class, 'index']);

Route::get('pais/{nome}', function ($nome) {
    $response = Http::get("https://restcountries.com/v3.1/name/{$nome}");

    if ($response->successful()) {
        $dados = $response->json();

        return response()->json([
            'status' => 'Conectado com sucesso',
            'resultado'=> [ 
                'nome_do_pais' => $dados[0]['name']['common'],
                'regiao' => $dados[0]['region'],
                'bandeira' => $dados[0]['flags']['png']
            ]
        ]);
    }

    return response()->json(['erro' => 'País não foi encontrado'], 404);
});
Route::post ('pokemon/novo', function(Request $request) {
    $dados = $request->validate ([
    'county' => 'required|string|min:3',
    'capital' => 'required|string',
    'region' => 'required|string',
    ]);

    return response()->json([
        'mensagem'=> 'País cadastrado com sucesso',
        'id_gerado' => rand(1000, 1999),
        'dados_recebidos' => $dados
    ], 201);
});

Route::get('/', function () {
    return view('welcome');
});