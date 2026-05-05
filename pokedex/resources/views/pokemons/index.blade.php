# index.blade.php — Cartas estilo Pokémon TCG

```html
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex Cards</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        body{
            background:
            radial-gradient(circle at top,#1e293b,#020617);
            min-height:100vh;
        }

        .pokemon-card{
            width: 320px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            transition: .4s;
            box-shadow:
            0 15px 40px rgba(0,0,0,.5);
        }

        .pokemon-card:hover{
            transform:
            translateY(-10px)
            scale(1.03)
            rotate(1deg);
        }

        .pokemon-bg{
            position:absolute;
            inset:0;
            opacity:.25;
            background-size:cover;
            background-position:center;
            filter: blur(10px);
            transform: scale(1.2);
        }

        .card-inner{
            position:relative;
            z-index:10;
        }

        .pokemon-image{
            height:220px;
            object-fit:contain;
            transition:.4s;
            filter:
            drop-shadow(0 0 20px rgba(255,255,255,.5));
        }

        .pokemon-card:hover .pokemon-image{
            transform:
            scale(1.1)
            rotate(3deg);
        }

        .electric{
            background:
            linear-gradient(180deg,#ffe45e,#facc15,#f59e0b);
        }

        .fire{
            background:
            linear-gradient(180deg,#fb923c,#ef4444,#b91c1c);
        }

        .water{
            background:
            linear-gradient(180deg,#7dd3fc,#3b82f6,#1d4ed8);
        }

        .grass{
            background:
            linear-gradient(180deg,#86efac,#22c55e,#166534);
        }

        .psychic{
            background:
            linear-gradient(180deg,#f9a8d4,#ec4899,#9d174d);
        }

        .default{
            background:
            linear-gradient(180deg,#cbd5e1,#64748b,#334155);
        }

        .gold-border{
            border: 10px solid #facc15;
        }

        .shine::before{
            content:'';
            position:absolute;
            top:-50%;
            left:-50%;
            width:200%;
            height:200%;
            background:
            linear-gradient(
                45deg,
                transparent,
                rgba(255,255,255,.3),
                transparent
            );

            transform: rotate(25deg);
            animation: brilho 5s linear infinite;
        }

        @keyframes brilho{
            0%{
                transform:
                translateX(-100%) rotate(25deg);
            }

            100%{
                transform:
                translateX(100%) rotate(25deg);
            }
        }

    </style>
</head>
<body class="text-black">

<div class="container mx-auto px-8 py-10">

    <!-- TOPO -->
    <div class="flex justify-between items-center mb-12">

        <div>
            <h1 class="text-6xl font-black text-yellow-400">
                Pokédex TCG
            </h1>

            <p class="text-slate-300 mt-2 text-lg">
                Cartas Pokémon estilo Trading Card Game
            </p>
        </div>

        <a
            href="/pokemons/create"
            class="bg-yellow-400 hover:bg-yellow-300 text-black font-black px-8 py-4 rounded-2xl transition shadow-2xl"
        >
            + Novo Pokémon
        </a>

    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10 justify-items-center">

        @foreach($pokemons as $pokemon)

        @php

            $tipo = strtolower($pokemon->tipo);

            $classe = match($tipo){
                'fogo' => 'fire',
                'água' => 'water',
                'agua' => 'water',
                'grama' => 'grass',
                'elétrico' => 'electric',
                'eletrico' => 'electric',
                'psíquico' => 'psychic',
                'psiquico' => 'psychic',
                default => 'default'
            };

        @endphp

        <div class="pokemon-card gold-border shine {{ $classe }}">

            <!-- BACKGROUND -->
            <div
                class="pokemon-bg"
                style="background-image:url('{{ asset('storage/' . $pokemon->imagem) }}')"
            ></div>

            <div class="card-inner p-4">

                <!-- TOPO -->
                <div class="flex justify-between items-center mb-3">

                    <h2 class="text-3xl font-black capitalize drop-shadow">
                        {{ $pokemon->nome }}
                    </h2>

                    <div class="text-2xl font-black">
                        Lv {{ $pokemon->nivel }}
                    </div>

                </div>

                <!-- IMAGEM -->
                <div class="bg-white/40 border-4 border-yellow-200 rounded-2xl p-4 mb-5 backdrop-blur-sm">

                    @if($pokemon->imagem)

                    <img
                        src="{{ asset('storage/' . $pokemon->imagem) }}"
                        class="pokemon-image w-full"
                    >

                    @else

                    <img
                        src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png"
                        class="pokemon-image w-full"
                    >

                    @endif

                </div>

                <!-- TIPO -->
                <div class="flex justify-between items-center mb-5">

                    <span class="bg-black/20 px-4 py-2 rounded-full text-sm font-black uppercase backdrop-blur-sm">
                        {{ $pokemon->tipo }}
                    </span>

                    <span class="font-black text-lg">
                        HP {{ $pokemon->nivel * 10 }}
                    </span>

                </div>

                <!-- ATAQUE -->
                <div class="bg-white/40 rounded-2xl p-4 mb-5 backdrop-blur-sm border border-white/40">

                    <div class="flex justify-between items-center mb-2">

                        <h3 class="font-black text-xl">
                            Ataque Especial
                        </h3>

                        <span class="font-black text-2xl">
                            {{ $pokemon->nivel }}
                        </span>

                    </div>

                    <p class="text-sm font-semibold leading-relaxed">
                        {{ $pokemon->nome }} usa um ataque poderoso do tipo
                        {{ $pokemon->tipo }} causando dano crítico.
                    </p>

                </div>

                <!-- BOTÕES -->
                <div class="flex gap-3">

                    <a
                        href="/pokemons/{{ $pokemon->id }}/edit"
                        class="flex-1 bg-blue-600 hover:bg-blue-500 text-white text-center py-3 rounded-xl font-black transition"
                    >
                        Editar
                    </a>

                    <form
                        action="/pokemons/{{ $pokemon->id }}"
                        method="POST"
                        class="flex-1"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full bg-red-600 hover:bg-red-500 text-white py-3 rounded-xl font-black transition"
                        >
                            Excluir
                        </button>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <!-- SEM POKÉMON -->
    @if($pokemons->count() == 0)

    <div class="text-center mt-24">

        <h2 class="text-5xl font-black text-yellow-400 mb-4">
            Nenhum Pokémon encontrado
        </h2>

        <p class="text-slate-300 text-lg mb-8">
            Crie sua primeira carta Pokémon.
        </p>

        <a
            href="/pokemons/create"
            class="bg-yellow-400 hover:bg-yellow-300 text-black font-black px-10 py-5 rounded-3xl transition"
        >
            Criar Carta
        </a>

    </div>

    @endif

</div>

</body>
</html>
```

# Resultado

Agora seus Pokémon vão aparecer:

* Em formato de carta Pokémon
* Com borda dourada
* Fundo baseado no tipo
* Brilho animado
* Efeito 3D
* HP automático
* Ataque especial
* Layout estilo Pokémon TCG

# Recomendação

Use imagens PNG transparentes dos Pokémon para ficar MUITO mais bonito.

Exemplo:

```txt
https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png
```

ou

```txt
https://img.pokemondb.net/artwork/large/pikachu.jpg
```
