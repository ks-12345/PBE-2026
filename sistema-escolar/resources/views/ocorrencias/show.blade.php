@extends('layouts.app')

@section('title', 'Ocorrência')
@section('page-title', 'Detalhes da Ocorrência')

@section('content')
<div class="pt-4 max-w-5xl mx-auto space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-slate-900">Ocorrência de {{ $ocorrencia->aluno->nome }}</h2>
            <p class="text-sm text-slate-500">Visualize o registro, status e histórico de autorização.</p>
        </div>

        <div class="flex flex-wrap gap-3 items-center">
            <a href="{{ route('ocorrencias.index') }}"
               class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">
                Voltar
            </a>

            @if(auth()->user()->isAqv() && $ocorrencia->isPendente())
                <form method="POST" action="{{ route('ocorrencias.aprovar', $ocorrencia) }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">Aprovar</button>
                </form>
                <form method="POST" action="{{ route('ocorrencias.negar', $ocorrencia) }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">Negar</button>
                </form>
            @endif

            @if(auth()->user()->isPortaria() && $ocorrencia->isAprovado() && !$ocorrencia->confirmacao_portaria)
                <form method="POST" action="{{ route('ocorrencias.confirmar-portaria', $ocorrencia) }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">Confirmar</button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-[1.4fr_0.9fr]">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Aluno</p>
                    <a href="{{ route('alunos.show', $ocorrencia->aluno) }}" class="mt-2 block text-sm font-semibold text-slate-900 hover:text-blue-600">{{ $ocorrencia->aluno->nome }}</a>
                    <p class="text-xs text-gray-500">RM {{ $ocorrencia->aluno->rm }} · {{ $ocorrencia->aluno->turma }}</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Tipo</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900">{{ $ocorrencia->tipoLabel() }}</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Status</p>
                    <span class="mt-2 inline-flex rounded-full px-2.5 py-1 text-xs font-semibold
                        @if($ocorrencia->status === 'aprovado') bg-green-100 text-green-700
                        @elseif($ocorrencia->status === 'negado') bg-red-100 text-red-700
                        @else bg-yellow-100 text-yellow-700
                        @endif">
                        {{ $ocorrencia->statusLabel() }}
                    </span>
                </div>
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Registrada por</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900">{{ $ocorrencia->aqv?->name ?? '—' }}</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Professor notificado</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900">{{ $ocorrencia->professor?->name ?? '—' }}</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Falta</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900">
                        @if($ocorrencia->tera_falta)
                            Sim, {{ $ocorrencia->aulas_falta }} aula(s)
                        @else
                            Não
                        @endif
                    </p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Data/horário</p>
                    <p class="mt-2 text-sm text-slate-900">{{ $ocorrencia->data_ocorrencia->format('d/m/Y H:i') }}</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Autorizado em</p>
                    <p class="mt-2 text-sm text-slate-900">{{ optional($ocorrencia->data_autorizacao)->format('d/m/Y H:i') ?? 'Aguardando' }}</p>
                </div>
            </div>

            @if($ocorrencia->confirmacao_portaria)
            <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-xs uppercase tracking-wide text-gray-500">Confirmado pela portaria</p>
                <p class="mt-2 text-sm text-slate-900">{{ optional($ocorrencia->confirmacao_portaria)->format('d/m/Y H:i') }}</p>
                <p class="text-xs text-gray-500">Responsável: {{ $ocorrencia->portaria?->name ?? '—' }}</p>
            </div>
            @endif

            <div class="space-y-4">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Motivo</p>
                    <p class="mt-2 text-sm text-slate-800 leading-relaxed">{{ $ocorrencia->motivo }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Observação</p>
                    <p class="mt-2 text-sm text-slate-800 leading-relaxed">
                        {{ $ocorrencia->observacao ?: 'Nenhuma observação registrada.' }}
                    </p>
                </div>
            </div>
        </div>

        <aside class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-5">
            <div class="space-y-2">
                <p class="text-sm font-semibold text-slate-900">Detalhes adicionais</p>
                <div class="text-sm text-gray-600">
                    <p><span class="font-semibold text-slate-800">AQV:</span> {{ $ocorrencia->aqv?->name ?? '—' }}</p>
                    <p><span class="font-semibold text-slate-800">Professor:</span> {{ $ocorrencia->professor?->name ?? '—' }}</p>
                    <p><span class="font-semibold text-slate-800">Portaria:</span> {{ $ocorrencia->portaria?->name ?? '—' }}</p>
                    <p><span class="font-semibold text-slate-800">Notificações:</span> {{ $ocorrencia->notificacoes->count() }}</p>
                </div>
            </div>

            <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-900">Ações disponíveis</p>
                <p class="mt-2 text-sm text-gray-600">Esta tela mostra o histórico e o status atual da ocorrência.</p>
            </div>
        </aside>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="text-sm font-semibold text-slate-900">Notificações</h3>
        </div>

        @if($ocorrencia->notificacoes->isEmpty())
            <div class="px-6 py-12 text-center text-sm text-gray-500">
                Nenhuma notificação associada.
            </div>
        @else
            <div class="space-y-3 px-6 py-5">
                @foreach($ocorrencia->notificacoes as $notificacao)
                    <div class="rounded-2xl border border-gray-200 bg-slate-50 p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $notificacao->titulo ?? 'Notificação' }}</p>
                                <p class="text-xs text-gray-500">Enviada por {{ $notificacao->usuario?->name ?? 'Sistema' }} em {{ $notificacao->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <p class="mt-3 text-sm text-gray-700">{{ $notificacao->mensagem }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
