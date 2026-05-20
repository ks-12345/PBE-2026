@extends('layouts.app')

@section('title', $aluno->nome)
@section('page-title', 'Aluno — ' . $aluno->nome)

@section('content')
<div class="pt-4 max-w-6xl mx-auto space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-slate-900">Ficha do aluno</h2>
            <p class="text-sm text-slate-500">Veja informações cadastrais, histórico de ocorrências e status do aluno.</p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('alunos.index') }}"
               class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">
                Voltar
            </a>

            @if(auth()->user()->isAqv())
            <a href="{{ route('alunos.edit', $aluno) }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
                Editar aluno
            </a>
            @endif
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-[1.45fr_0.95fr]">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-5">
            <div class="space-y-3">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nome completo</p>
                        <p class="mt-1 text-lg font-semibold text-slate-900">{{ $aluno->nome }}</p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-{{ $aluno->ativo ? 'green' : 'gray' }}-100 px-3 py-1 text-xs font-semibold text-{{ $aluno->ativo ? 'green' : 'gray' }}-700">
                        {{ $aluno->ativo ? 'Ativo' : 'Inativo' }}
                    </span>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-wide text-gray-500">RM / Matrícula</p>
                        <p class="mt-2 text-sm text-slate-800 font-medium">{{ $aluno->rm }}</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Turma</p>
                        <p class="mt-2 text-sm text-slate-800 font-medium">{{ $aluno->turma }}</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Curso</p>
                        <p class="mt-2 text-sm text-slate-800 font-medium">{{ $aluno->curso }}</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Responsável</p>
                        <p class="mt-2 text-sm text-slate-800 font-medium">{{ $aluno->responsavel }}</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Telefone</p>
                    <p class="mt-2 text-sm text-slate-800">{{ $aluno->telefone_responsavel }}</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">E-mail</p>
                    <p class="mt-2 text-sm text-slate-800">{{ $aluno->email_responsavel ?? '—' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-5">
            <div>
                <p class="text-sm text-gray-500">Resumo de ocorrências</p>
                <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $ocorrencias->total() }} registros</h3>
            </div>

            <div class="grid gap-4">
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Total de atrasos</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $stats['total_atrasos'] }}</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Total de saídas antecipadas</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $stats['total_saidas'] }}</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Atrasos neste mês</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $stats['atrasos_mes'] }}</p>
                </div>
                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Saídas neste mês</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $stats['saidas_mes'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="text-sm font-semibold text-slate-900">Histórico de ocorrências</h3>
        </div>

        @if($ocorrencias->isEmpty())
            <div class="px-6 py-12 text-center text-sm text-gray-500">
                Nenhuma ocorrência registrada para este aluno.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-4 py-3">Tipo</th>
                            <th class="px-4 py-3">Motivo</th>
                            <th class="px-4 py-3">Data</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($ocorrencias as $oc)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $oc->tipoLabel() }}</td>
                            <td class="px-4 py-3 text-gray-600 truncate max-w-xs">{{ $oc->motivo }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $oc->data_ocorrencia->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold
                                    @if($oc->status === 'aprovado') bg-green-100 text-green-700
                                    @elseif($oc->status === 'negado') bg-red-100 text-red-700
                                    @else bg-yellow-100 text-yellow-700
                                    @endif">
                                    {{ $oc->statusLabel() }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('ocorrencias.show', $oc) }}" class="text-xs text-blue-600 hover:underline">Ver</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-100">
                {{ $ocorrencias->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
