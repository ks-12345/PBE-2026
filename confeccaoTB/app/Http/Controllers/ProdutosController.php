<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Fornecedor;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::all();
        return view('produtos.create', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'descricao'     => 'nullable|string',
            'preco'         => 'required|numeric|min:0',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'ativo'         => 'boolean',
        ]);

        Produto::create([
            ...$request->all(),
            'ativo' => $request->boolean('ativo'),
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $fornecedores = Fornecedor::all();
        return view('produtos.edit', compact('produto', 'fornecedores'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'descricao'     => 'nullable|string',
            'preco'         => 'required|numeric|min:0',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'ativo'         => 'boolean',
        ]);

        $produto->update([
            ...$request->all(),
            'ativo' => $request->boolean('ativo'),
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto removido!');
    }
}