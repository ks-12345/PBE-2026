<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Booster Pack</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body{
    background: radial-gradient(circle at top,#1e293b,#020617);
    min-height:100vh;
}

/* PACK */
.pack{
    width:200px;
    margin:auto;
    cursor:pointer;
    transition:.3s;
}

.pack:hover{
    transform:scale(1.1);
}

/* ANIMAÇÃO RASGAR */
.opening{
    animation: tearPack .8s forwards;
}

@keyframes tearPack{
    0% { transform:scale(1); }
    50% { transform:scale(1.2) rotate(5deg); }
    100% { transform:scale(0); opacity:0; }
}

/* FLASH */
.flash{
    position:fixed;
    inset:0;
    background:white;
    opacity:0;
    pointer-events:none;
}

.flash.active{
    animation: flashAnim .5s;
}

@keyframes flashAnim{
    0% { opacity:0; }
    50% { opacity:1; }
    100% { opacity:0; }
}

/* CARDS */
.cards{
    display:none;
}

.card{
    width:260px;
    background:white;
    border-radius:12px;
    padding:10px;
    color:black;
    transform:translateY(50px);
    opacity:0;
    transition:.5s;
}

.card.show{
    transform:translateY(0);
    opacity:1;
}

/* brilho raro */
.rara{
    box-shadow:0 0 20px gold;
}
</style>
</head>

<body class="text-center text-white">

<div class="py-10">

    <h1 class="text-5xl font-black text-yellow-400 mb-10">
        🎁 Booster Pack
    </h1>

    <!-- PACK -->
    <div id="pack">
        <img src="/img/pack.png" class="pack" onclick="abrirPack()">
        <p class="mt-2 text-slate-300">Clique para abrir</p>
    </div>

    <!-- FLASH -->
    <div id="flash" class="flash"></div>

    <!-- CARTAS -->
    <div id="cards" class="cards flex flex-wrap justify-center gap-10 mt-10">

        @foreach($pack as $pokemon)

        <div class="card 
            {{ str_contains($pokemon->raridade, 'rara') ? 'rara' : '' }}">

            <h2 class="font-bold text-lg">
                {{ $pokemon->nome }}
            </h2>

            <p>{{ $pokemon->hp }} HP</p>

            <img 
                src="{{ $pokemon->imagem 
                    ? asset('storage/'.$pokemon->imagem)
                    : 'https://img.pokemondb.net/artwork/large/pikachu.jpg' }}"
                class="mx-auto my-2 h-24"
            >

            <p class="text-xs font-bold text-purple-600">
                {{ $pokemon->raridade }}
            </p>

        </div>

        @endforeach

    </div>

</div>

<script>
function abrirPack(){

    const pack = document.getElementById('pack');
    const flash = document.getElementById('flash');
    const cards = document.querySelectorAll('.card');
    const cardsContainer = document.getElementById('cards');

    // rasgar pack
    pack.classList.add('opening');

    // flash
    setTimeout(()=>{
        flash.classList.add('active');
    }, 400);

    // mostrar cartas
    setTimeout(()=>{
        pack.style.display = 'none';
        cardsContainer.style.display = 'flex';

        cards.forEach((card, index)=>{
            setTimeout(()=>{
                card.classList.add('show');
            }, index * 300);
        });

    }, 800);
}
</script>

</body>
</html>