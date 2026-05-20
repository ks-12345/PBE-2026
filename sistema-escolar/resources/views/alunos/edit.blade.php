@extends('layouts.app')

@section('title', 'Editar Aluno')
@section('page-title', 'Editar Aluno')

@section('content')
<div class="pt-6 max-w-3xl">
    <div class="mb-5 flex items-center justify-between gap-4">
        <div>
            <h2 class="page-title">Dados do aluno</h2>
            <p class="page-subtitle">Atualize as informa&ccedil;&otilde;es cadastrais de {{ $aluno->nome }}.</p>
        </div>

        <a href="{{ route('alunos.show', $aluno) }}" class="btn-secondary">
            Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('alunos.update', $aluno) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="form-group md:col-span-2">
                        <label for="nome" class="form-label">Nome completo *</label>
                        <input
                            id="nome"
                            type="text"
                            name="nome"
                            value="{{ old('nome', $aluno->nome) }}"
                            required
                            class="form-input @error('nome') error @enderror"
                        >
                        @error('nome')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rm" class="form-label">RM / Matr&iacute;cula *</label>
                        <input
                            id="rm"
                            type="text"
                            name="rm"
                            value="{{ old('rm', $aluno->rm) }}"
                            required
                            class="form-input @error('rm') error @enderror"
                        >
                        @error('rm')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="turma" class="form-label">Turma *</label>
                        <input
                            id="turma"
                            type="text"
                            name="turma"
                            value="{{ old('turma', $aluno->turma) }}"
                            required
                            placeholder="ex: 3A"
                            class="form-input @error('turma') error @enderror"
                        >
                        @error('turma')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group md:col-span-2">
                        <label for="curso" class="form-label">Curso *</label>
                        <input
                            id="curso"
                            type="text"
                            name="curso"
                            value="{{ old('curso', $aluno->curso) }}"
                            required
                            class="form-input @error('curso') error @enderror"
                        >
                        @error('curso')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="responsavel" class="form-label">Nome do Respons&aacute;vel *</label>
                        <input
                            id="responsavel"
                            type="text"
                            name="responsavel"
                            value="{{ old('responsavel', $aluno->responsavel) }}"
                            required
                            class="form-input @error('responsavel') error @enderror"
                        >
                        @error('responsavel')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telefone_responsavel" class="form-label">Telefone do Respons&aacute;vel *</label>
                        <input
                            id="telefone_responsavel"
                            type="text"
                            name="telefone_responsavel"
                            value="{{ old('telefone_responsavel', $aluno->telefone_responsavel) }}"
                            required
                            class="form-input @error('telefone_responsavel') error @enderror"
                        >
                        @error('telefone_responsavel')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group md:col-span-2">
                        <label for="email_responsavel" class="form-label">E-mail do Respons&aacute;vel</label>
                        <input
                            id="email_responsavel"
                            type="email"
                            name="email_responsavel"
                            value="{{ old('email_responsavel', $aluno->email_responsavel) }}"
                            class="form-input @error('email_responsavel') error @enderror"
                        >
                        @error('email_responsavel')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <input type="hidden" name="ativo" value="0">

                        <label for="ativo" class="flex cursor-pointer items-start gap-3">
                            <input
                                id="ativo"
                                type="checkbox"
                                name="ativo"
                                value="1"
                                @checked(old('ativo', $aluno->ativo))
                                class="mt-1 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                            >
                            <span>
                                <span class="block text-sm font-semibold text-slate-700">Aluno ativo</span>
                                <span class="block text-xs text-slate-400">Alunos inativos continuam no hist&oacute;rico, mas podem ser filtrados e identificados no cadastro.</span>
                            </span>
                        </label>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <button type="submit" class="btn-primary">
                        Salvar altera&ccedil;&otilde;es
                    </button>

                    <a href="{{ route('alunos.show', $aluno) }}" class="btn-secondary">
                        Cancelar
                    </a>

                    <a href="{{ route('alunos.index') }}" class="btn-ghost">
                        Lista de alunos
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
