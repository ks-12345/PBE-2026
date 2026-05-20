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
