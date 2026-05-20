@extends('layouts.app')

@section('title', 'Notificações')
@section('page-title', 'Notificações')

@section('content')
<div class="pt-4 max-w-4xl mx-auto space-y-4">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-slate-900">Notificações</h2>
            <p class="text-sm text-gray-500">Últimas notificações enviadas para sua conta.</p>
        </div>
        <div class="text-sm text-gray-500">
            {{ $notificacoes->total() }} notificação(ões)
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        @if($notificacoes->isEmpty())
            <div class="px-6 py-12 text-center text-sm text-gray-500">Nenhuma notificação encontrada.</div>
        @else
            <div class="divide-y divide-gray-100">
                @foreach($notificacoes as $notificacao)
                    <div class="px-6 py-4 flex items-start gap-4 hover:bg-gray-50">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">{{ $notificacao->titulo ?? 'Notificação' }}</p>
                                    <p class="text-xs text-gray-500">{{ $notificacao->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                @if($notificacao->ocorrencia)
                                    <a href="{{ route('ocorrencias.show', $notificacao->ocorrencia) }}" class="text-xs text-blue-600 hover:underline">Ver ocorrência</a>
                                @endif
                            </div>

                            <p class="mt-2 text-sm text-gray-700">{{ $notificacao->mensagem }}</p>
                        </div>

                        <div class="flex items-center gap-2">
                            @if(!$notificacao->lida)
                                <span class="inline-flex items-center rounded-full bg-yellow-100 text-yellow-700 px-2 py-0.5 text-xs font-semibold">Nova</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-600 px-2 py-0.5 text-xs">Lida</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="px-6 py-4 border-t border-gray-100">
                {{ $notificacoes->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
