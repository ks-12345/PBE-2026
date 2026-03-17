<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\Fornecedor;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedidos::all();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::all();
        return view('pedidos.create', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id'   => 'required|string|max:255',
            'quantidade'   => 'required|integer|min:1',
            'data_pedido'  => 'required|date',
            'status'       => 'required|in:pendente,aprovado,cancelado,entregue',
            'fornecedor_id'=> 'required|exists:fornecedores,id',
        ]);

        Pedidos::create($request->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
    }

    public function show(Pedidos $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedidos $pedido)
    {
        $fornecedores = Fornecedor::all();
        return view('pedidos.edit', compact('pedido', 'fornecedores'));
    }

    public function update(Request $request, Pedidos $pedido)
    {
        $request->validate([
            'produto_id'   => 'required|string|max:255',
            'quantidade'   => 'required|integer|min:1',
            'data_pedido'  => 'required|date',
            'status'       => 'required|in:pendente,aprovado,cancelado,entregue',
            'fornecedor_id'=> 'required|exists:fornecedores,id',
        ]);

        $pedido->update($request->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy(Pedidos $pedido)
    {
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido removido!');
    }
}