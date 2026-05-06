<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pokémon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: radial-gradient(circle at top, #1e293b, #020617);
            min-height: 100vh;
            font-family: Georgia, serif;
        }

        .form-card {
            background: linear-gradient(160deg, #c7a84e 0%, #e8c96a 30%, #f5e18a 60%, #c9a030 100%);
            border: 4px solid #8b6914;
            box-shadow: 0 0 0 2px #f5d060, 0 8px 40px rgba(0,0,0,.5);
            border-radius: 18px;
        }

        .card-header {
            background: linear-gradient(90deg, #b8860b, #d4a017, #b8860b);
            border-bottom: 2px solid #8b6914;
        }

        .section-box {
            background: rgba(255,255,255,0.55);
            border: 1.5px solid rgba(139,105,20,0.4);
            border-radius: 10px;
        }

        .section-label {
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.5px;
            color: #6b4f0a;
            text-transform: uppercase;
        }

        .attack-inner {
            background: rgba(255,255,255,0.4);
            border: 1.5px solid rgba(139,105,20,0.35);
            border-radius: 8px;
        }

        label { font-size: 11px; color: #6b4f0a; font-weight: bold; }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            border: 1.5px solid rgba(139,105,20,0.5);
            border-radius: 6px;
            padding: 6px 9px;
            font-size: 13px;
            background: rgba(255,255,255,0.8);
            color: #333;
            width: 100%;
            font-family: inherit;
            outline: none;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #b8860b;
            background: #fff;
        }

        .btn-submit {
            background: linear-gradient(180deg, #d4a017, #b8860b);
            border: 2px solid #8b6914;
            border-radius: 10px;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1px;
            font-family: inherit;
        }

        .btn-submit:hover { opacity: 0.85; }
    </style>
</head>
<body class="py-10">


<div class="max-w-2xl mx-auto px-4">
    <div class="form-card overflow-hidden">

        <!-- Header -->
 <div class="card-header px-6 py-4 flex items-center justify-between">

    <!-- BOTÃO VOLTAR -->
    <a href="{{ route('pokemons.index') }}"
       class="flex items-center gap-2 bg-yellow-300 hover:bg-yellow-200 text-black font-bold px-4 py-2 rounded-xl shadow transition">
        ← Voltar
    </a>

    <!-- TÍTULO -->
    <div class="text-right">
        <h1 class="text-2xl font-bold text-white"
            style="text-shadow:1px 1px 3px rgba(0,0,0,.5);letter-spacing:1px;">
            Cadastrar Pokémon
            <span class="text-xs ml-2 bg-yellow-900 text-yellow-200 px-2 py-0.5 rounded-full align-middle">
                TCG
            </span>
        </h1>

        <p class="text-yellow-100 text-xs mt-1 opacity-75">
            Preencha os dados do card completo
        </p>
    </div>

</div>

        <div class="p-6">
            <form action="/pokemons" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- IDENTIDADE --}}
                <div class="section-box p-4 mb-4">
                    <p class="section-label mb-3">Identidade</p>

                    <div class="flex gap-3 mb-3">
                        <div class="flex-1">
                            <label class="block mb-1">Nome</label>
                            <input type="text" name="nome" placeholder="Ex: Charizard" required>
                        </div>
                        <div style="width:130px">
                            <label class="block mb-1">Estágio</label>
                            <select name="estagio">
                                <option>Básico</option>
                                <option>Estágio 1</option>
                                <option>Estágio 2</option>
                                <option>EX</option>
                                <option>GX</option>
                                <option>V</option>
                                <option>VMAX</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-3 mb-3">
                        <div class="flex-1">
                            <label class="block mb-1">Evolui de</label>
                            <input type="text" name="evolui_de" placeholder="Nome do pré-evolução">
                        </div>
                        <div style="width:90px">
                            <label class="block mb-1">HP</label>
                            <input type="number" name="hp" placeholder="340" min="10" max="999" value="100">
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex-1">
                            <label class="block mb-1">Tipo</label>
                            <select name="tipo">
                                <option>Fogo</option>
                                <option>Água</option>
                                <option>Grama</option>
                                <option>Elétrico</option>
                                <option>Psíquico</option>
                                <option>Lutador</option>
                                <option>Sombrio</option>
                                <option>Metal</option>
                                <option>Normal</option>
                            </select>
                        </div>
                        <div style="width:80px">
                            <label class="block mb-1">Nível</label>
                            <input type="number" name="nivel" placeholder="50" min="1" max="100">
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1">Imagem</label>
                            <input type="file" name="imagem" accept="image/*">
                        </div>
                    </div>
                </div>

                {{-- ATAQUES --}}
                <div class="section-box p-4 mb-4">
                    <p class="section-label mb-3">Ataques</p>

                    <div class="attack-inner p-3 mb-3">
                        <p class="section-label mb-2">Ataque 1</p>
                        <div class="flex gap-3 mb-2">
                            <div class="flex-1">
                                <label class="block mb-1">Nome do Ataque</label>
                                <input type="text" name="ataque1_nome" placeholder="Ex: Calor de Lascar">
                            </div>
                            <div style="width:80px">
                                <label class="block mb-1">Dano</label>
                                <input type="text" name="ataque1_dano" placeholder="80+">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-1">Descrição</label>
                            <textarea name="ataque1_descricao" rows="2" placeholder="Efeito do ataque..."></textarea>
                        </div>
                    </div>

                    <div class="attack-inner p-3">
                        <p class="section-label mb-2">Ataque 2</p>
                        <div class="flex gap-3 mb-2">
                            <div class="flex-1">
                                <label class="block mb-1">Nome do Ataque</label>
                                <input type="text" name="ataque2_nome" placeholder="Ex: Meteoro Vulcânico">
                            </div>
                            <div style="width:80px">
                                <label class="block mb-1">Dano</label>
                                <input type="text" name="ataque2_dano" placeholder="280">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-1">Descrição</label>
                            <textarea name="ataque2_descricao" rows="2" placeholder="Efeito do ataque..."></textarea>
                        </div>
                    </div>
                </div>

                {{-- ESTATÍSTICAS --}}
                <div class="section-box p-4 mb-4">
                    <p class="section-label mb-3">Estatísticas de Batalha</p>
                    <div class="flex gap-3">
                        <div class="flex-1">
                            <label class="block mb-1">Fraqueza</label>
                            <select name="fraqueza">
                                <option>Nenhuma</option>
                                <option>Água ×2</option>
                                <option>Fogo ×2</option>
                                <option>Grama ×2</option>
                                <option>Elétrico ×2</option>
                                <option>Lutador ×2</option>
                                <option>Psíquico ×2</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1">Resistência</label>
                            <select name="resistencia">
                                <option>Nenhuma</option>
                                <option>Grama -30</option>
                                <option>Fogo -30</option>
                                <option>Água -30</option>
                                <option>Metal -30</option>
                                <option>Sombrio -30</option>
                            </select>
                        </div>
                        <div style="width:80px">
                            <label class="block mb-1">Recuo</label>
                            <input type="text" name="recuo" placeholder="●●">
                        </div>
                    </div>
                </div>

                {{-- INFO DO CARD --}}
                <div class="section-box p-4 mb-5">
                    <p class="section-label mb-3">Informações do Card</p>
                    <div class="flex gap-3 mb-3">
                        <div class="flex-1">
                            <label class="block mb-1">Ilustrador</label>
                            <input type="text" name="ilustrador" placeholder="Ex: 5ban Graphics">
                        </div>
                        <div style="width:100px">
                            <label class="block mb-1">Número</label>
                            <input type="text" name="numero_card" placeholder="022/132">
                        </div>
                        <div style="width:120px">
                            <label class="block mb-1">Raridade</label>
                            <select name="raridade">
                                <option>Comum</option>
                                <option>Incomum</option>
                                <option>Rara</option>
                                <option>Rara Holo</option>
                                <option>Ultra Rara</option>
                                <option>Secreta</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-1">Habilidade / Regra Especial</label>
                        <textarea name="habilidade_especial" rows="2" placeholder="Ex: Quando seu Pokémon GX de Megaevolução é Nocauteado, seu oponente pega 3 cartas de Prêmio."></textarea>
                    </div>
                </div>

                <button type="submit" class="btn-submit w-full py-3 text-base transition">
                    Salvar Pokémon
                </button>

            </form>
        </div>
    </div>
</div>

</body>
</html>