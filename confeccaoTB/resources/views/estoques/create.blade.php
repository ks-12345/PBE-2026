<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cadastrar Estoque
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('estoques.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold">produto_id</label>
                        <input type="text" name="produto_id"
                               class="w-full border rounded p-2"
                               value="{{ old('produto_id') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">quantidade</label>
                        <input type="number" name="quantidade"
                               class="w-full border rounded p-2"
                               value="{{ old('quantidade') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">localizacao</label>
                        <input type="text" name="localizacao"
                               class="w-full border rounded p-2"
                               value="{{ old('localizacao') }}">
                    </div>

                    <div class="flex justify-end">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Salvar estoques
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>