<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::all();
        return view('pokemons.index', compact('pokemons'));
    }

    public function create()
    {
        return view('pokemons.create');
    }

public function store(Request $request)
{
    $dados = $request->all();

    if ($request->hasFile('imagem')) {

        $imagem = $request->file('imagem')
                        ->store('pokemons', 'public');

        $dados['imagem'] = $imagem;
    }
    $dados['raridade'] = strtolower($dados['raridade']);

    Pokemon::create($dados);

    return redirect('/pokemons');
}

    public function edit(Pokemon $pokemon)
    {
        return view('pokemons.edit', compact('pokemon'));
    }

public function update(Request $request, Pokemon $pokemon)
{
    $dados = $request->all();

    if ($request->hasFile('imagem')) {

        $imagem = $request->file('imagem')
                        ->store('pokemons', 'public');

        $dados['imagem'] = $imagem;
    }
    $dados['raridade'] = strtolower($dados['raridade']);
    $pokemon->update($dados);

    return redirect('/pokemons');
}

    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();

        return redirect('/pokemons');
    }

public function booster()
{
    // comuns
    $comuns = Pokemon::where('raridade', 'comum')
        ->inRandomOrder()
        ->take(3)
        ->get();

    // incomum (fallback se não existir)
    $incomum = Pokemon::where('raridade', 'incomum')
        ->inRandomOrder()
        ->first();

    if (!$incomum) {
        $incomum = Pokemon::inRandomOrder()->first();
    }

    // raro ou melhor
    $raros = Pokemon::whereIn('raridade', [
        'rara', 'rara holo', 'ultra rara', 'secreta'
    ])
    ->inRandomOrder()
    ->first();

    if (!$raros) {
        $raros = Pokemon::inRandomOrder()->first();
    }

    // monta pack SEM null
    $pack = collect()
        ->merge($comuns)
        ->push($incomum)
        ->push($raros)
        ->filter()
        ->values();

    return view('booster', compact('pack'));
}

}