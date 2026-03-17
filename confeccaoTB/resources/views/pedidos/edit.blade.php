<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Pedido
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pedidos.update', $pedido->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="produto_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Produto
                            </label>
                            <input
                                type="text"
                                id="produto_id"
                                name="produto_id"
                                value="{{ old('produto_id', $pedido->produto_id) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="quantidade" class="block text-sm font-medium text-gray-700 mb-1">
                                Quantidade
                            </label>
                            <input
                                type="number"
                                id="quantidade"
                                name="quantidade"
                                value="{{ old('quantidade', $pedido->quantidade) }}"
                                min="1"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="data_pedido" class="block text-sm font-medium text-gray-700 mb-1">
                                Data do Pedido
                            </label>
                            <input
                                type="date"
                                id="data_pedido"
                                name="data_pedido"
                                value="{{ old('data_pedido', \Carbon\Carbon::parse($pedido->data_pedido)->format('Y-m-d')) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>
                            <select
                                id="status"
                                name="status"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                                @foreach (['pendente', 'aprovado', 'cancelado', 'entregue'] as $s)
                                    <option value="{{ $s }}" {{ old('status', $pedido->status) == $s ? 'selected' : '' }}>
                                        {{ ucfirst($s) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="fornecedor_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Fornecedor
                            </label>
                            <select
                                id="fornecedor_id"
                                name="fornecedor_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                                <option value="">Selecione...</option>
                                @foreach ($fornecedores as $fornecedor)
                                    <option value="{{ $fornecedor->id }}" {{ old('fornecedor_id', $pedido->fornecedor_id) == $fornecedor->id ? 'selected' : '' }}>
                                        {{ $fornecedor->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <button
                                type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-md shadow-sm transition"
                            >
                                Atualizar
                            </button>
                            <a
                                href="{{ route('pedidos.index') }}"
                                class="text-gray-600 hover:text-gray-800 font-medium transition"
                            >
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>