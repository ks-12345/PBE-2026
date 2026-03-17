<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Fornecedores
        </h2>

         <a href="{{ route('fornecedores.create') }}" 
           class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
            + Novo Fornecedor
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
                                <th class="px-4 py-2">CNPJ</th>
                                <th class="px-4 py-2">Telefone</th>
                                <th class="px-4 py-2">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Fornecedores as $fornecedor)
                                <tr>
                                    <td class="border px-4 py-2">{{ $fornecedor->id }}</td>
                                    <td class="border px-4 py-2">{{ $fornecedor->nome }}</td>
                                    <td class="border px-4 py-2">{{ $fornecedor->cnpj }}</td>
                                    <td class="border px-4 py-2">{{ $fornecedor->telefone }}</td>
                                    <td class="border px-4 py-2">{{ $fornecedor->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>