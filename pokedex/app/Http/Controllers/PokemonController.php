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

    $pokemon->update($dados);

    return redirect('/pokemons');
}

    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();

        return redirect('/pokemons');
    }
}