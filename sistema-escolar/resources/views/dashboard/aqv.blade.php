{{-- ============================================================ --}}
{{-- ARQUIVO: resources/views/dashboard/aqv.blade.php          --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Dashboard AQV')
@section('page-title', 'Dashboard — AQV')

@section('content')
<div class="pt-4 space-y-6">

    {{-- Cards de estatísticas --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Atrasos Hoje</p>
            <p class="text-3xl font-bold text-orange-600 mt-1">{{ $stats['total_atrasos_hoje'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Saídas Hoje</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $stats['total_saidas_hoje'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Pendentes</p>
            <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $stats['pendentes'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Aprovados Hoje</p>
            <p class="text-3xl font-bold text-green-600 mt-1">{{ $stats['aprovados_hoje'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Total Alunos</p>
            <p class="text-3xl font-bold text-slate-700 mt-1">{{ $stats['total_alunos'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Pendentes --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">⏳ Pendentes de Aprovação</h2>
                <a href="{{ route('ocorrencias.index') }}?status=pendente" class="text-xs text-blue-600 hover:underline">Ver todos</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($pendentes as $oc)
                <div class="px-5 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $oc->aluno->nome }}</p>
                        <p class="text-xs text-gray-500">{{ $oc->aluno->rm }} · {{ $oc->aluno->turma }} · {{ $oc->tipoLabel() }}</p>
                    </div>
                    <div class="flex gap-2">
                        <form method="POST" action="{{ route('ocorrencias.aprovar', $oc) }}">
                            @csrf
                            <button class="text-xs px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 font-medium">Aprovar</button>
                        </form>
                        <form method="POST" action="{{ route('ocorrencias.negar', $oc) }}">
                            @csrf
                            <button class="text-xs px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-medium">Negar</button>
                        </form>
                    </div>
                </div>
                @empty
                <p class="px-5 py-6 text-sm text-gray-400 text-center">Nenhuma ocorrência pendente 🎉</p>
                @endforelse
            </div>
        </div>

        {{-- Recentes --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">📋 Ocorrências Recentes</h2>
                <a href="{{ route('ocorrencias.index') }}" class="text-xs text-blue-600 hover:underline">Ver todas</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($ocorrencias_recentes as $oc)
                <a href="{{ route('ocorrencias.show', $oc) }}" class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 block">
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $oc->aluno->nome }}</p>
                        <p class="text-xs text-gray-500">{{ $oc->tipoLabel() }} · {{ $oc->data_ocorrencia->format('d/m H:i') }}</p>
                    </div>
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                        @if($oc->status === 'aprovado') bg-green-100 text-green-700
                        @elseif($oc->status === 'negado') bg-red-100 text-red-700
                        @else bg-yellow-100 text-yellow-700
                        @endif">
                        {{ $oc->statusLabel() }}
                    </span>
                </a>
                @empty
                <p class="px-5 py-6 text-sm text-gray-400 text-center">Nenhuma ocorrência hoje</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Atalhos --}}
    <div class="grid grid-cols-2 gap-4">
        <a href="{{ route('ocorrencias.create') }}"
           class="flex items-center gap-4 bg-blue-600 hover:bg-blue-700 text-white p-5 rounded-xl transition-colors">
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold">Registrar Ocorrência</p>
                <p class="text-sm text-blue-200">Novo atraso ou saída antecipada</p>
            </div>
        </a>
        <a href="{{ route('alunos.create') }}"
           class="flex items-center gap-4 bg-slate-700 hover:bg-slate-800 text-white p-5 rounded-xl transition-colors">
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold">Cadastrar Aluno</p>
                <p class="text-sm text-slate-300">Adicionar novo aluno</p>
            </div>
        </a>
    </div>
</div>
@endsection


{{-- ============================================================ --}}
{{-- ARQUIVO: resources/views/dashboard/portaria.blade.php       --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Dashboard Portaria')
@section('page-title', 'Dashboard — Portaria')

@section('content')
<div class="pt-4 space-y-6">

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Liberações Hoje</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $stats['liberacoes_hoje'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Entradas Auth.</p>
            <p class="text-3xl font-bold text-orange-600 mt-1">{{ $stats['entradas_hoje'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Saídas Auth.</p>
            <p class="text-3xl font-bold text-purple-600 mt-1">{{ $stats['saidas_hoje'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Confirmadas</p>
            <p class="text-3xl font-bold text-green-600 mt-1">{{ $stats['confirmadas'] }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">✅ Autorizações do Dia</h2>
            <p class="text-xs text-gray-500 mt-0.5">Apenas autorizações aprovadas pela AQV</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-5 py-3 text-left">Aluno</th>
                        <th class="px-5 py-3 text-left">Turma</th>
                        <th class="px-5 py-3 text-left">Tipo</th>
                        <th class="px-5 py-3 text-left">Horário</th>
                        <th class="px-5 py-3 text-left">Portaria</th>
                        <th class="px-5 py-3 text-left">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($liberacoes_hoje as $oc)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3">
                            <p class="font-medium text-gray-800">{{ $oc->aluno->nome }}</p>
                            <p class="text-xs text-gray-400">RM: {{ $oc->aluno->rm }}</p>
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ $oc->aluno->turma }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @if($oc->tipo === 'entrada_atrasada') bg-orange-100 text-orange-700
                                @else bg-purple-100 text-purple-700
                                @endif">
                                {{ $oc->tipoLabel() }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ $oc->data_ocorrencia->format('H:i') }}</td>
                        <td class="px-5 py-3">
                            @if($oc->confirmacao_portaria)
                                <span class="text-xs text-green-600 font-medium">✓ Confirmado {{ $oc->confirmacao_portaria->format('H:i') }}</span>
                            @else
                                <span class="text-xs text-gray-400">Aguardando</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            @if(!$oc->confirmacao_portaria)
                                <form method="POST" action="{{ route('ocorrencias.confirmar-portaria', $oc) }}">
                                    @csrf
                                    <button class="text-xs px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 font-medium">
                                        Confirmar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-gray-400">Nenhuma autorização para hoje ainda</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


{{-- ============================================================ --}}
{{-- ARQUIVO: resources/views/dashboard/professor.blade.php      --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Dashboard Professor')
@section('page-title', 'Dashboard — Professor')

@section('content')
<div class="pt-4 space-y-6">

    @if($nao_lidas > 0)
    <div class="bg-blue-50 border border-blue-200 rounded-xl px-5 py-4 flex items-center gap-3">
        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
            {{ $nao_lidas }}
        </div>
        <div>
            <p class="text-sm font-medium text-blue-800">Você tem {{ $nao_lidas }} notificação(ões) não lida(s)</p>
            <a href="{{ route('notificacoes.index') }}" class="text-xs text-blue-600 hover:underline">Ver todas →</a>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Não Lidas</p>
            <p class="text-3xl font-bold text-red-500 mt-1">{{ $stats['notificacoes_nao_lidas'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Total Notificações</p>
            <p class="text-3xl font-bold text-slate-700 mt-1">{{ $stats['total_notificacoes'] }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-800">🔔 Notificações Recentes</h2>
            <a href="{{ route('notificacoes.index') }}" class="text-xs text-blue-600 hover:underline">Ver todas</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($notificacoes as $notif)
            <div class="px-5 py-4 {{ !$notif->lida ? 'bg-blue-50/50' : '' }}">
                <div class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0 {{ !$notif->lida ? 'bg-blue-500' : 'bg-gray-300' }}"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">{{ $notif->titulo }}</p>
                        <p class="text-xs text-gray-600 mt-0.5">{{ $notif->mensagem }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            @empty
            <p class="px-5 py-8 text-center text-sm text-gray-400">Nenhuma notificação ainda</p>
            @endforelse
        </div>
    </div>
</div>
@endsection