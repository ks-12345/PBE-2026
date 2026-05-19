
@extends('layouts.app')
@section('title', 'Novo Aluno')
@section('page-title', 'Cadastrar Aluno')
 
@section('content')
<div class="pt-4 max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <form method="POST" action="{{ route('alunos.store') }}" class="space-y-4">
            @csrf
 
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome completo *</label>
                    <input type="text" name="nome" value="{{ old('nome') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500">
                    @error('nome') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
 
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">RM / Matrícula *</label>
                    <input type="text" name="rm" value="{{ old('rm') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500">
                    @error('rm') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
 
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Turma *</label>
                    <input type="text" name="turma" value="{{ old('turma') }}" required placeholder="ex: 3ºA"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500">
                    @error('turma') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
 
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Curso *</label>
                    <input type="text" name="curso" value="{{ old('curso') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500">
                    @error('curso') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
 
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Responsável *</label>
                    <input type="text" name="responsavel" value="{{ old('responsavel') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500">
                    @error('responsavel') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
 
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telefone do Responsável *</label>
                    <input type="text" name="telefone_responsavel" value="{{ old('telefone_responsavel') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500">
                    @error('telefone_responsavel') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
 
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail do Responsável</label>
                    <input type="email" name="email_responsavel" value="{{ old('email_responsavel') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
 
            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                    Cadastrar Aluno
                </button>
                <a href="{{ route('alunos.index') }}"
                   class="px-6 py-2.5 border border-gray-300 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection