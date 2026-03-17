<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoques = Estoque::all();
        return view('estoques.index', compact('estoques'));
    }

    // Exibir formulário de criação
    public function create()
    {
        return view('estoques.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|string|unique:estoques,produto_id',
            'quantidade' => 'required|integer|min:0',
            'localizacao' => 'required|string|max:255',
        ]);

        Estoque::create($request->all());

        return redirect()->route('estoques.index')->with('success', 'Estoque criado com sucesso!');
    }

    // Abre a tela de edição
    public function edit(Estoque $estoque)
    {
        return view('estoques.edit', compact('estoque'));
    }

    // Atualizar os dados do estoque no banco de dados
    public function update(Request $request, Estoque $estoque)
    {
        $request->validate([
            'produto_id' => 'required|string|unique:estoques,produto_id,' . $estoque->id,
            'quantidade' => 'required|integer|min:0',
            'localizacao' => 'required|string|max:255',
        ]);

        $estoque->update($request->all());
        return redirect()->route('estoques.index')->with('success', 'Estoque atualizado com sucesso!');
    }

    // Deletar os dados do estoque no banco de dados
    public function destroy(Estoque $estoque)
    {
        $estoque->delete();
        return redirect()->route('estoques.index')->with('success', 'Estoque removido!');
    }
}


