<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokémon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: radial-gradient(circle at top,#1e293b,#020617); min-height:100vh; font-family: Georgia, serif; }
        .form-card { background: linear-gradient(160deg,#c7a84e 0%,#e8c96a 30%,#f5e18a 60%,#c9a030 100%); border:4px solid #8b6914; box-shadow:0 0 0 2px #f5d060,0 8px 40px rgba(0,0,0,.5); border-radius:18px; }
        .card-header { background: linear-gradient(90deg,#b8860b,#d4a017,#b8860b); border-bottom:2px solid #8b6914; }
        .section-box { background:rgba(255,255,255,0.55); border:1.5px solid rgba(139,105,20,0.4); border-radius:10px; }
        .section-label { font-size:10px; font-weight:bold; letter-spacing:1.5px; color:#6b4f0a; text-transform:uppercase; }
        .attack-inner { background:rgba(255,255,255,0.4); border:1.5px solid rgba(139,105,20,0.35); border-radius:8px; }
        label { font-size:11px; color:#6b4f0a; font-weight:bold; }
        input[type="text"],input[type="number"],input[type="file"],select,textarea { border:1.5px solid rgba(139,105,20,0.5); border-radius:6px; padding:6px 9px; font-size:13px; background:rgba(255,255,255,0.8); color:#333; width:100%; font-family:inherit; outline:none; }
        input:focus,select:focus,textarea:focus { border-color:#b8860b; background:#fff; }
        .btn-submit { background:linear-gradient(180deg,#d4a017,#b8860b); border:2px solid #8b6914; border-radius:10px; color:#fff; font-weight:bold; letter-spacing:1px; font-family:inherit; }
        .btn-submit:hover { opacity:0.85; }
    </style>
</head>
<body class="py-10">

<div class="max-w-2xl mx-auto px-4">

    <!-- TOPO COM VOLTAR -->
<div class="flex items-center justify-between mb-6">

    <a href="/pokemons"
       class="flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-5 py-2 rounded-xl shadow-lg transition">
        ⬅ Voltar
    </a>

    <div class="text-right">
        <h1 class="text-2xl font-black text-yellow-400">
            Editar Pokémon
        </h1>
        <p class="text-slate-300 text-sm">
            Atualize os dados da carta
        </p>
    </div>

</div>

    <div class="form-card overflow-hidden">

    <div class="p-6">
    <form action="/pokemons/{{ $pokemon->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- IDENTIDADE --}}
        <div class="section-box p-4 mb-4">
            <p class="section-label mb-3">Identidade</p>
            <div class="flex gap-3 mb-3">
                <div class="flex-1">
                    <label class="block mb-1">Nome</label>
                    <input type="text" name="nome" value="{{ $pokemon->nome }}" required>
                </div>
                <div style="width:130px">
                    <label class="block mb-1">Estágio</label>
                    <select name="estagio">
                        @foreach(['Básico','Estágio 1','Estágio 2','EX','GX','V','VMAX'] as $e)
                        <option {{ $pokemon->estagio == $e ? 'selected' : '' }}>{{ $e }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex gap-3 mb-3">
                <div class="flex-1">
                    <label class="block mb-1">Evolui de</label>
                    <input type="text" name="evolui_de" value="{{ $pokemon->evolui_de }}">
                </div>
                <div style="width:90px">
                    <label class="block mb-1">HP</label>
                    <input type="number" name="hp" value="{{ $pokemon->hp }}" min="10" max="999">
                </div>
            </div>
            <div class="flex gap-3">
                <div class="flex-1">
                    <label class="block mb-1">Tipo</label>
                    <select name="tipo">
                        @foreach(['Fogo','Água','Grama','Elétrico','Psíquico','Lutador','Sombrio','Metal','Normal'] as $t)
                        <option {{ $pokemon->tipo == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="width:80px">
                    <label class="block mb-1">Nível</label>
                    <input type="number" name="nivel" value="{{ $pokemon->nivel }}" min="1" max="100">
                </div>
                <div class="flex-1">
                    <label class="block mb-1">Nova Imagem</label>
                    <input type="file" name="imagem" accept="image/*">
                </div>
            </div>
            @if($pokemon->imagem)
            <p class="text-xs mt-2" style="color:#6b4f0a;">Imagem atual: {{ $pokemon->imagem }}</p>
            @endif
        </div>

        {{-- ATAQUES --}}
        <div class="section-box p-4 mb-4">
            <p class="section-label mb-3">Ataques</p>
            <div class="attack-inner p-3 mb-3">
                <p class="section-label mb-2">Ataque 1</p>
                <div class="flex gap-3 mb-2">
                    <div class="flex-1"><label class="block mb-1">Nome</label><input type="text" name="ataque1_nome" value="{{ $pokemon->ataque1_nome }}"></div>
                    <div style="width:80px"><label class="block mb-1">Dano</label><input type="text" name="ataque1_dano" value="{{ $pokemon->ataque1_dano }}"></div>
                </div>
                <div><label class="block mb-1">Descrição</label><textarea name="ataque1_descricao" rows="2">{{ $pokemon->ataque1_descricao }}</textarea></div>
            </div>
            <div class="attack-inner p-3">
                <p class="section-label mb-2">Ataque 2</p>
                <div class="flex gap-3 mb-2">
                    <div class="flex-1"><label class="block mb-1">Nome</label><input type="text" name="ataque2_nome" value="{{ $pokemon->ataque2_nome }}"></div>
                    <div style="width:80px"><label class="block mb-1">Dano</label><input type="text" name="ataque2_dano" value="{{ $pokemon->ataque2_dano }}"></div>
                </div>
                <div><label class="block mb-1">Descrição</label><textarea name="ataque2_descricao" rows="2">{{ $pokemon->ataque2_descricao }}</textarea></div>
            </div>
        </div>

        {{-- ESTATÍSTICAS --}}
        <div class="section-box p-4 mb-4">
            <p class="section-label mb-3">Estatísticas de Batalha</p>
            <div class="flex gap-3">
                <div class="flex-1">
                    <label class="block mb-1">Fraqueza</label>
                    <select name="fraqueza">
                        @foreach(['Nenhuma','Água ×2','Fogo ×2','Grama ×2','Elétrico ×2','Lutador ×2','Psíquico ×2'] as $f)
                        <option {{ $pokemon->fraqueza == $f ? 'selected' : '' }}>{{ $f }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block mb-1">Resistência</label>
                    <select name="resistencia">
                        @foreach(['Nenhuma','Grama -30','Fogo -30','Água -30','Metal -30','Sombrio -30'] as $r)
                        <option {{ $pokemon->resistencia == $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="width:80px">
                    <label class="block mb-1">Recuo</label>
                    <input type="text" name="recuo" value="{{ $pokemon->recuo }}">
                </div>
            </div>
        </div>

        {{-- INFO DO CARD --}}
        <div class="section-box p-4 mb-5">
            <p class="section-label mb-3">Informações do Card</p>
            <div class="flex gap-3 mb-3">
                <div class="flex-1"><label class="block mb-1">Ilustrador</label><input type="text" name="ilustrador" value="{{ $pokemon->ilustrador }}"></div>
                <div style="width:100px"><label class="block mb-1">Número</label><input type="text" name="numero_card" value="{{ $pokemon->numero_card }}"></div>
                <div style="width:120px">
                    <label class="block mb-1">Raridade</label>
                    <select name="raridade">
                        @foreach(['Comum','Incomum','Rara','Rara Holo','Ultra Rara','Secreta'] as $r)
                        <option {{ $pokemon->raridade == $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div><label class="block mb-1">Habilidade / Regra Especial</label><textarea name="habilidade_especial" rows="2">{{ $pokemon->habilidade_especial }}</textarea></div>
        </div>

        <button type="submit" class="btn-submit w-full py-3 text-base transition">
            Atualizar Pokémon
        </button>

    </form>
    </div>
</div>
</div>
</body>
</html>