<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pedidos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Cliente</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                                <tr>
                                    <td class="border px-4 py-2">{{ $pedido->id }}</td>
                                    <td class="border px-4 py-2">{{ $pedido->client_id }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($pedido->status) }}</td>
                                    <td class="border px-4 py-2">
                                        R$ {{ number_format($pedido->valor, 2, ',', '.') }}
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