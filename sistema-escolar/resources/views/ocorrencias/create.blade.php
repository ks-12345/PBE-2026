{{-- ============================================================ --}}
{{-- ARQUIVO: resources/views/ocorrencias/create.blade.php      --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Nova Ocorrência')
@section('page-title', 'Registrar Ocorrência')

@section('content')
<div class="pt-4 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <form method="POST" action="{{ route('ocorrencias.store') }}" class="space-y-6">
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
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
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

            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-2">
                <a href="{{ route('ocorrencias.index') }}"
                   class="px-6 py-2.5 border border-gray-300 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                    Registrar Ocorrência
                </button>
            </div>
        </form>
    </div>
</div>
@endsection



