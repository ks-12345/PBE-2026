<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

public function index() {
    $clientes = \App\Models\Clientes::all();
    return view("clientes.index", compact ('clientes'));
}

//Salvar os dados do cliente no banco de dados
public function create() {
    return view("clientes.create");
}
public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|unique:clientes',
        'email' => 'required|email|unique:clientes,email',
        'telefone' => 'required|string|max:20',
        'endereco' => 'required|string|max:255',
    
    ]);
Clientes::create($request->all());
return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
}

    
        // Abre a tela de edição
        public function edit(Clientes $cliente) 
    {
        return view('clientes.edit', compact('cliente'));
    }

//Atualizar os dados do cliente no banco de dados
public function update(Request $request, Clientes $cliente)
{
    // $cliente = Clientes::findOrFail($id);
    $request->validate([
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|unique:clientes,cpf,' . $cliente->id,
        'email' => 'required|email|unique:clientes,email,' . $cliente->id,
        'telefone' => 'required|string|max:20',
        'endereco' => 'required|string|max:255',
    ]);

    $cliente->update($request->all());
    return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');


}
//Deletar os dados do cliente no banco de dados

public function destroy(Clientes $cliente)
{
    $cliente->delete();
    return redirect()->route('clientes.index')->with('success', 'Cliente removido!');

}

}