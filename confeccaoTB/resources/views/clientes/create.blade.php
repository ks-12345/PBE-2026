<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cadastrar Cliente
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

                <form action="{{ route('cliente.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-bold">Nome</label>
                        <input type="text" name="nome"
                               class="w-full border rounded p-2"
                               value="{{ old('nome') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">CPF</label>
                        <input type="text" name="cpf"
                               class="w-full border rounded p-2"
                               value="{{ old('cpf') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">Email</label>
                        <input type="email" name="email"
                               class="w-full border rounded p-2"
                               value="{{ old('email') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">Telefone</label>
                        <input type="text" name="telefone"
                               class="w-full border rounded p-2"
                               value="{{ old('telefone') }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">Endereço</label>
                        <input type="text" name="endereco"
                               class="w-full border rounded p-2"
                               value="{{ old('endereco') }}">
                    </div>

                    <div class="flex justify-end">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Salvar Cliente
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>