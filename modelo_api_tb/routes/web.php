<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('user/{ID}', function ($ID) {
    $response =Http::get("https://dummyjson.com/user/{$ID}");
    if ($response->successful()) {
        $dados = $response->json();
        return response()->json([
            'status' => 'Conectado com sucesso',
            'resultado'=> [ 
            'identificador' => $dados['id'],
            'nome_do_usuario' => ucfirst($dados['ID'])            
            ]
        ]);
    }

return response()->json(['erro' => 'Usuario não foi encontrado'], 404);
});
Route::post ('usuario/novo', function(Request $request) {
    $dados = $request->validate ([
        'firstName' => 'required|string|min:3',
        'lastName' => 'required|string|min:3',
        'age' => 'required|integer|max:2',
        'gender' => 'required|string|min:3',
        'city' => 'required|string|min:3',
    ]);

    return response()->json([
        'mensagem'=> 'Usuario cadastrado com sucesso',
        'id_gerado' => rand(1000, 1999),
        'dados_recebidos' => $dados
    ], 201);
});

Route::get('/', function () {
    return view('welcome');
});