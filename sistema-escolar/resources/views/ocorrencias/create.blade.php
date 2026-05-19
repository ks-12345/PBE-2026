{{-- ============================================================ --}}
{{-- ARQUIVO: resources/views/ocorrencias/create.blade.php      --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Nova Ocorrência')
@section('page-title', 'Registrar Ocorrência')

@section('content')
<div class="pt-4 max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <form method="POST" action="{{ route('ocorrencias.store') }}" class="space-y-5">
            @csrf

            {{-- Aluno --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Aluno *</label>
                <select name="aluno_id" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('aluno_id') border-red-400 @enderror">
                    <option value="">Selecione o aluno...</option>
                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>
                            {{ $aluno->nome }} — RM {{ $aluno->rm }} ({{ $aluno->turma }})
                        </option>
                    @endforeach
                </select>
                @error('aluno_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Tipo --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Ocorrência *</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="relative flex items-center gap-3 border border-gray-200 rounded-xl p-4 cursor-pointer hover:border-orange-400 has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 transition-all">
                        <input type="radio" name="tipo" value="entrada_atrasada" {{ old('tipo') == 'entrada_atrasada' ? 'checked' : '' }} class="accent-orange-500">
                        <div>
                            <p class="text-sm font-medium text-gray-800">⏰ Entrada Atrasada</p>
                            <p class="text-xs text-gray-500">Aluno chegou depois do horário</p>
                        </div>
                    </label>
                    <label class="relative flex items-center gap-3 border border-gray-200 rounded-xl p-4 cursor-pointer hover:border-purple-400 has-[:checked]:border-purple-500 has-[:checked]:bg-purple-50 transition-all">
                        <input type="radio" name="tipo" value="saida_antecipada" {{ old('tipo') == 'saida_antecipada' ? 'checked' : '' }} class="accent-purple-500">
                        <div>
                            <p class="text-sm font-medium text-gray-800">🚪 Saída Antecipada</p>
                            <p class="text-xs text-gray-500">Aluno saindo antes do fim</p>
                        </div>
                    </label>
                </div>
                @error('tipo') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Motivo --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Motivo *</label>
                <textarea name="motivo" rows="3" required
                    placeholder="Descreva o motivo da ocorrência..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none @error('motivo') border-red-400 @enderror">{{ old('motivo') }}</textarea>
                @error('motivo') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Observação --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Observação <span class="text-gray-400">(opcional)</span></label>
                <textarea name="observacao" rows="2"
                    placeholder="Informações adicionais..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none">{{ old('observacao') }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                    Registrar Ocorrência
                </button>
                <a href="{{ route('ocorrencias.index') }}"
                   class="px-6 py-2.5 border border-gray-300 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection


{{-- ============================================================ --}}
{{-- ARQUIVO: resources/views/ocorrencias/index.blade.php        --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Ocorrências')
@section('page-title', 'Ocorrências')

@section('content')
<div class="pt-4 space-y-4">

    {{-- Filtros --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4">
        <form method="GET" class="flex flex-wrap items-end gap-3">
            <div class="flex-1 min-w-48">
                <label class="block text-xs text-gray-500 mb-1">Buscar aluno</label>
                <input type="text" name="busca" value="{{ request('busca') }}"
                    placeholder="Nome ou RM..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Tipo</label>
                <select name="tipo" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Todos</option>
                    <option value="entrada_atrasada" {{ request('tipo') == 'entrada_atrasada' ? 'selected' : '' }}>Entrada Atrasada</option>
                    <option value="saida_antecipada" {{ request('tipo') == 'saida_antecipada' ? 'selected' : '' }}>Saída Antecipada</option>
                </select>
            </div>
            @if(auth()->user()->isAqv())
            <div>
                <label class="block text-xs text-gray-500 mb-1">Status</label>
                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Todos</option>
                    <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="aprovado" {{ request('status') == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                    <option value="negado"   {{ request('status') == 'negado'   ? 'selected' : '' }}>Negado</option>
                </select>
            </div>
            @endif
            <div>
                <label class="block text-xs text-gray-500 mb-1">De</label>
                <input type="date" name="data_inicio" value="{{ request('data_inicio') }}"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Até</label>
                <input type="date" name="data_fim" value="{{ request('data_fim') }}"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                Filtrar
            </button>
            <a href="{{ route('ocorrencias.index') }}" class="px-4 py-2 border border-gray-300 text-gray-600 text-sm rounded-lg hover:bg-gray-50">
                Limpar
            </a>
        </form>
    </div>

    {{-- Tabela --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                <tr>
                    <th class="px-5 py-3 text-left">Aluno</th>
                    <th class="px-5 py-3 text-left">Tipo</th>
                    <th class="px-5 py-3 text-left">Motivo</th>
                    <th class="px-5 py-3 text-left">Data/Hora</th>
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-left">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($ocorrencias as $oc)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3">
                        <p class="font-medium text-gray-800">{{ $oc->aluno->nome }}</p>
                        <p class="text-xs text-gray-400">{{ $oc->aluno->rm }} · {{ $oc->aluno->turma }}</p>
                    </td>
                    <td class="px-5 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            @if($oc->tipo === 'entrada_atrasada') bg-orange-100 text-orange-700
                            @else bg-purple-100 text-purple-700
                            @endif">
                            {{ $oc->tipoLabel() }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-gray-600 max-w-48 truncate">{{ $oc->motivo }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $oc->data_ocorrencia->format('d/m/Y H:i') }}</td>
                    <td class="px-5 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            @if($oc->status === 'aprovado') bg-green-100 text-green-700
                            @elseif($oc->status === 'negado') bg-red-100 text-red-700
                            @else bg-yellow-100 text-yellow-700
                            @endif">
                            {{ $oc->statusLabel() }}
                        </span>
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('ocorrencias.show', $oc) }}"
                               class="text-xs text-blue-600 hover:underline">Ver</a>

                            @if(auth()->user()->isAqv() && $oc->isPendente())
                                <form method="POST" action="{{ route('ocorrencias.aprovar', $oc) }}" class="inline">
                                    @csrf
                                    <button class="text-xs text-green-600 hover:underline">Aprovar</button>
                                </form>
                                <form method="POST" action="{{ route('ocorrencias.negar', $oc) }}" class="inline">
                                    @csrf
                                    <button class="text-xs text-red-600 hover:underline">Negar</button>
                                </form>
                            @endif

                            @if(auth()->user()->isPortaria() && $oc->isAprovado() && !$oc->confirmacao_portaria)
                                <form method="POST" action="{{ route('ocorrencias.confirmar-portaria', $oc) }}" class="inline">
                                    @csrf
                                    <button class="text-xs text-blue-600 hover:underline">Confirmar</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-gray-400">
                        Nenhuma ocorrência encontrada
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginação --}}
        @if($ocorrencias->hasPages())
        <div class="px-5 py-3 border-t border-gray-100">
            {{ $ocorrencias->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection


{{-- ============================================================ --}}
{{-- ARQUIVO: resources/views/alunos/index.blade.php             --}}
{{-- ============================================================ --}}
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