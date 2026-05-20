@extends('layouts.app')
@section('title', 'Alunos')
@section('page-title', 'Alunos')
 
@section('content')
<div class="pt-4 space-y-4">
 
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">{{ $alunos->total() }} alunos cadastrados</p>
        @if(auth()->user()->isAqv())
        <a href="{{ route('alunos.create') }}"
           class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 font-medium">
            + Novo Aluno
        </a>
        @endif
    </div>
 
    {{-- Filtros --}}
    <div class="bg-white rounded-xl border border-gray-200 p-4">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-48">
                <label class="block text-xs text-gray-500 mb-1">Buscar</label>
                <input type="text" name="busca" value="{{ request('busca') }}"
                    placeholder="Nome, RM ou turma..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Turma</label>
                <select name="turma" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Todas</option>
                    @foreach($turmas as $turma)
                        <option value="{{ $turma }}" {{ request('turma') == $turma ? 'selected' : '' }}>{{ $turma }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">Buscar</button>
            <a href="{{ route('alunos.index') }}" class="px-4 py-2 border border-gray-300 text-gray-600 text-sm rounded-lg hover:bg-gray-50">Limpar</a>
        </form>
    </div>
 
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($alunos as $aluno)
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-sm">
                        {{ strtoupper(substr($aluno->nome, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">{{ $aluno->nome }}</p>
                        <p class="text-xs text-gray-500">RM: {{ $aluno->rm }}</p>
                    </div>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-full {{ $aluno->ativo ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                    {{ $aluno->ativo ? 'Ativo' : 'Inativo' }}
                </span>
            </div>
 
            <div class="mt-3 space-y-1">
                <p class="text-xs text-gray-500">🎓 {{ $aluno->curso }} · Turma {{ $aluno->turma }}</p>
                <p class="text-xs text-gray-500">👤 {{ $aluno->responsavel }}</p>
                <p class="text-xs text-gray-500">📱 {{ $aluno->telefone_responsavel }}</p>
            </div>
 
            <div class="mt-3 flex items-center justify-between">
                <span class="text-xs text-gray-400">{{ $aluno->ocorrencias_count }} ocorrência(s)</span>
                <div class="flex gap-2">
                    <a href="{{ route('alunos.show', $aluno) }}"
                       class="text-xs text-blue-600 hover:underline">Ver histórico</a>
                    @if(auth()->user()->isAqv())
                    <a href="{{ route('alunos.edit', $aluno) }}"
                       class="text-xs text-gray-500 hover:underline">Editar</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 py-12 text-center text-gray-400">
            <p class="text-lg">Nenhum aluno encontrado</p>
            @if(auth()->user()->isAqv())
            <a href="{{ route('alunos.create') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">Cadastrar primeiro aluno →</a>
            @endif
        </div>
        @endforelse
    </div>
 
    @if($alunos->hasPages())
    <div>{{ $alunos->withQueryString()->links() }}</div>
    @endif
</div>
@endsection