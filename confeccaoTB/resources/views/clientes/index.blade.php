<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nossa Confecção</h2>
        
        <a href="{{ route('cliente.create') }}" 
           class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
            + Novo Cliente
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-500 text-green-700 shadow-sm rounded-r">
                {{ session('success') }}
            </div>
        @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    @foreach ($clientes as $cliente)
                        <div class="border p-4 rounded shadow-sm">

                            <h3 class="font-bold text-lg">{{ $cliente->nome }}</h3>
                            <p class="text-sm text-gray-600">CPF: {{ $cliente->cpf }}</p>
                            <p class="mt-2 text-blue-600 font-bold">TELEFONE: {{ $cliente->telefone }}</p>
                            <p class="mt-2 text-blue-600 font-bold">EMAIL: {{ $cliente->email }}</p>
                            <p class="mt-2 text-blue-600 font-bold">ENDEREÇO: {{ $cliente->endereco }}</p>

                            <!-- BOTÕES -->
                            <div class="flex mt-4 space-x-2">

                                <!-- EDITAR -->
                                <a href="{{ route('clientes.edit', $cliente->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 text-sm font-bold">
                                   Editar
                                </a>

                                <!-- EXCLUIR -->
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 text-sm font-bold">
                                        Excluir
                                    </button>
                                </form>

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>