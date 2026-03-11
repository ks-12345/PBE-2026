<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Produtos
        </h2>
                <a href="{{ route('estoques.create') }}" 
           class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
            + Novo Produto
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Nome</th>
                                <th class="px-4 py-2">Descrição</th>
                                <th class="px-4 py-2">Preço</th>
                                <th class="px-4 py-2">Fornecedor</th>
                                <th class="px-4 py-2">Ativo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estoques as $estoque)
                                <tr>
                                    <td class="border px-4 py-2">{{ $estoque->id }}</td>
                                    <td class="border px-4 py-2">{{ $estoque->name }}</td>
                                    <td class="border px-4 py-2">{{ $estoque->descricao }}</td>
                                    <td class="border px-4 py-2">R$ {{ number_format($estoque->preco, 2, ',', '.') }}</td>
                                    <td class="border px-4 py-2">{{ $estoque->fornecedor_id }}</td>
                                    <td class="border px-4 py-2">
                                        {{ $estoque->ativo ? 'Sim' : 'Não' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>