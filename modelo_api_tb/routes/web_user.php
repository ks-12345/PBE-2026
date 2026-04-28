<?php
use Illuminate\Support\Facades\Http;
use App\Models\Usuario;

Route::get('user/{id}', function ($id) {

    $response = Http::get("https://dummyjson.com/users/{$id}");

    if ($response->successful()) {

        $dados = $response->json(); // já é array

        $usuario = Usuario::create([
            'firstName' => $dados['firstName'],
            'lastName'  => $dados['lastName'],
            'age'       => $dados['age'],
            'gender'    => $dados['gender'],
            'city'      => $dados['address']['city'] ?? null
        ]);

        return response()->json([
            'mensagem' => 'Salvo no banco com sucesso',
            'usuario' => $usuario
        ]);
    }

    return response()->json(['erro' => 'Usuário não encontrado'], 404);
});
Route::post ('usuario/novo', function(Request $request) {
    $dados = $request->validate ([
        'firstName' => 'required|string|min:3',
        'lastName' => 'required|string|min:3',
        'age' => 'required|integer|max:120',
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