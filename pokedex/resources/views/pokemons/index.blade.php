<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pokédex Cards</title>
<script src="https://cdn.tailwindcss.com"></script>

<style>
:root{
    --ink:#172033;
    --paper:#fff7df;
    --gold:#facc15;
}

*{
    box-sizing:border-box;
}

body{
    background:
        radial-gradient(circle at 18% 8%, rgba(250,204,21,.22), transparent 28rem),
        radial-gradient(circle at 88% 18%, rgba(59,130,246,.18), transparent 24rem),
        linear-gradient(135deg,#0f172a 0%,#111827 46%,#020617 100%);
    min-height:100vh;
    color:#f8fafc;
    font-family:Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

.page-shell{
    max-width:1440px;
}

.cards-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));
    gap:34px 30px;
    justify-items:center;
    align-items:start;
}

.topbar{
    background:rgba(15,23,42,.72);
    border:1px solid rgba(250,204,21,.24);
    border-radius:18px;
    box-shadow:0 24px 80px rgba(0,0,0,.34);
    backdrop-filter:blur(14px);
}

.page-title{
    letter-spacing:.02em;
    text-shadow:0 3px 0 rgba(0,0,0,.28), 0 0 26px rgba(250,204,21,.24);
}

.nav-actions{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
    justify-content:flex-end;
}

.nav-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    min-height:44px;
    border-radius:12px;
    padding:10px 18px;
    font-weight:800;
    color:#111827;
    box-shadow:0 12px 28px rgba(0,0,0,.24);
    transition:transform .2s ease, box-shadow .2s ease, filter .2s ease;
}

.nav-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 18px 34px rgba(0,0,0,.34);
    filter:saturate(1.12);
}

.nav-btn:focus-visible,
.btn:focus-visible{
    outline:3px solid rgba(250,204,21,.55);
    outline-offset:3px;
}

.nav-btn.create{
    background:linear-gradient(180deg,#fde047,#facc15 58%,#eab308);
}

.nav-btn.booster{
    color:#fff;
    background:linear-gradient(180deg,#a855f7,#7e22ce);
}

.tcg-card{
    width:350px;
    min-height:500px;
    border-radius:16px;
    padding:12px;
    border:5px solid var(--gold);
    box-shadow:
        0 0 0 1px rgba(255,255,255,.35) inset,
        0 18px 42px rgba(0,0,0,.48);
    position:relative;
    isolation:isolate;
    transition:transform .25s ease, box-shadow .25s ease, filter .25s ease;
}

.tcg-card:hover{
    transform:translateY(-8px) scale(1.025);
    box-shadow:
        0 0 0 1px rgba(255,255,255,.45) inset,
        0 28px 58px rgba(0,0,0,.56);
    filter:saturate(1.08);
}

.fire{ background:linear-gradient(145deg,#fed7aa 0%,#fb923c 34%,#b91c1c 100%); }
.water{ background:linear-gradient(145deg,#bfdbfe 0%,#3b82f6 38%,#1e3a8a 100%); }
.grass{ background:linear-gradient(145deg,#bbf7d0 0%,#22c55e 38%,#14532d 100%); }
.electric{ background:linear-gradient(145deg,#fef08a 0%,#facc15 42%,#d97706 100%); }
.psychic{ background:linear-gradient(145deg,#fbcfe8 0%,#ec4899 38%,#831843 100%); }
.default{ background:linear-gradient(145deg,#cbd5e1 0%,#64748b 38%,#1e293b 100%); }

.tcg-inner{
    background:
        linear-gradient(180deg,rgba(255,255,255,.92),rgba(255,247,223,.96)),
        var(--paper);
    border:1px solid rgba(120,53,15,.22);
    border-radius:10px;
    color:var(--ink);
    min-height:100%;
    display:flex;
    flex-direction:column;
    padding:12px;
    position:relative;
    z-index:1;
    box-shadow:inset 0 0 0 1px rgba(255,255,255,.6);
}

.tcg-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:8px;
    background:linear-gradient(90deg,rgba(250,204,21,.46),rgba(255,255,255,.4));
    border:1px solid rgba(161,98,7,.24);
    border-radius:8px;
    font-weight:800;
    font-size:14px;
    min-height:34px;
    padding:7px 10px;
}

.stage{
    color:#64748b;
    flex:0 0 auto;
    font-size:10px;
    text-transform:uppercase;
}

.name{
    flex:1 1 auto;
    font-size:16px;
    line-height:1.1;
    overflow:hidden;
    text-align:center;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.hp{
    color:#b91c1c;
    flex:0 0 auto;
    font-size:13px;
}

.image-box{
    background:
        radial-gradient(circle at 50% 35%,rgba(255,255,255,.98),rgba(226,232,240,.9) 70%),
        #fff;
    border:2px solid rgba(148,163,184,.8);
    border-radius:8px;
    height:170px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:12px 0;
    overflow:hidden;
    box-shadow:inset 0 3px 12px rgba(15,23,42,.12);
}

.image-box img{
    display:block;
    max-height:148px;
    max-width:92%;
    object-fit:contain;
    filter:drop-shadow(0 8px 10px rgba(15,23,42,.22));
}

.image-box img.fallback-image{
    max-height:128px;
    opacity:.9;
}

.ability-box{
    background: linear-gradient(90deg,#fff7ad,#facc15);
    border:1px solid #b45309;
    border-radius:8px;
    padding:8px 10px;
    margin-top:2px;
    margin-bottom:4px;
    box-shadow:0 2px 0 rgba(120,53,15,.16);
}

.ability-title{
    font-weight:900;
    font-size:12px;
    color:#92400e;
}

.ability-desc{
    font-size:11px;
    color:#78350f;
    line-height:1.35;
}

.attack{
    border-top:1px solid rgba(100,116,139,.45);
    padding-top:10px;
    margin-top:10px;
}

.attack-top{
    display:flex;
    justify-content:space-between;
    gap:8px;
    font-weight:900;
    font-size:13px;
}

.attack-top span:first-child{
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.attack-desc{
    color:#475569;
    font-size:11px;
    line-height:1.35;
    margin-top:5px;
}

.footer{
    margin-top:10px;
    font-size:10px;
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:7px;
    color:#475569;
}

.rarity-badge{
    background:#111827;
    border:1px solid rgba(250,204,21,.6);
    border-radius:999px;
    color:#fde047;
    font-size:9px;
    font-weight:900;
    letter-spacing:.04em;
    padding:3px 8px;
    text-transform:uppercase;
}

.holo {
    position: relative;
    overflow: hidden;
}

.holo::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius:inherit;
    background: linear-gradient(
        120deg,
        rgba(255,255,255,0.1),
        rgba(255,255,255,0.4),
        rgba(255,255,255,0.1)
    );
    mix-blend-mode: overlay;
    pointer-events:none;
    animation: holoMove 3s linear infinite;
}

@keyframes holoMove {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.actions{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:8px;
    margin-top:16px;
}

.btn{
    border:0;
    box-shadow:0 6px 14px rgba(15,23,42,.18);
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-size:11px;
    font-weight:800;
    min-height:28px;
    min-width:74px;
    padding:6px 9px;
    border-radius:7px;
    color:white;
    transition:transform .18s ease, filter .18s ease, box-shadow .18s ease;
}

.btn:hover{
    transform:translateY(-1px);
    filter:brightness(1.08);
    box-shadow:0 10px 18px rgba(15,23,42,.24);
}

.edit{ background:linear-gradient(180deg,#3b82f6,#1d4ed8); }
.delete{ background:linear-gradient(180deg,#ef4444,#b91c1c); }

.raridade-comum {
    filter: none;
}

.raridade-incomum {
    box-shadow: 0 0 10px rgba(255,255,255,0.3), 0 18px 42px rgba(0,0,0,.48);
}

.raridade-rara {
    box-shadow: 0 0 18px rgba(59,130,246,0.7), 0 18px 42px rgba(0,0,0,.48);
}

.raridade-holo::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius:inherit;
    background: linear-gradient(
        120deg,
        red, orange, yellow, green, cyan, blue, violet
    );
    mix-blend-mode: overlay;
    opacity: 0.25;
    pointer-events:none;
    animation: holoRainbow 4s linear infinite;
}

.raridade-ultra {
    box-shadow: 0 0 25px gold, 0 0 50px rgba(255,215,0,0.6), 0 18px 42px rgba(0,0,0,.48);
}

.raridade-secreta::after {
    content:"";
    position:absolute;
    inset:0;
    border-radius:inherit;
    background: linear-gradient(
        45deg,
        #ff0000,
        #ff9900,
        #33ff00,
        #00ffff,
        #0033ff,
        #cc00ff
    );
    opacity:.35;
    mix-blend-mode: overlay;
    pointer-events:none;
    animation: secretMove 2s linear infinite;
}

.raridade-secreta {
    box-shadow: 0 0 40px #fff, 0 0 80px gold, 0 18px 42px rgba(0,0,0,.48);
}

@keyframes holoRainbow {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes secretMove {
    0% { transform: translateX(-100%) rotate(0deg); }
    100% { transform: translateX(100%) rotate(360deg); }
}

@media (max-width: 768px){
    .topbar{
        border-radius:14px;
    }

    .nav-actions{
        justify-content:stretch;
        width:100%;
    }

    .nav-btn{
        flex:1 1 180px;
    }

    .cards-grid{
        grid-template-columns:1fr;
        gap:28px;
    }

    .tcg-card{
        width:min(350px, 100%);
    }
}

@media (prefers-reduced-motion: reduce){
    *,
    *::before,
    *::after{
        animation-duration:.01ms !important;
        animation-iteration-count:1 !important;
        scroll-behavior:auto !important;
        transition-duration:.01ms !important;
    }
}
</style>
</head>

<body>

<div class="page-shell mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">

<div class="topbar flex flex-col md:flex-row justify-between md:items-center gap-6 mb-10 px-5 sm:px-7 py-6">
    <div>
        <h1 class="page-title text-4xl sm:text-5xl font-black text-yellow-400">Pokédex TCG</h1>
        <p class="text-slate-300">Cartas Pokémon estilo TCG</p>
    </div>

    <div class="nav-actions">
        <a href="/pokemons/create" class="nav-btn create">
            + Novo Pokémon
        </a>
        <a href="/booster" class="nav-btn booster">
            🎁 Abrir Booster Pack
        </a>
    </div>
</div>

<div class="cards-grid">

@foreach($pokemons as $pokemon)

@php
$tipo = strtolower($pokemon->tipo);

$classe = match($tipo){
    'fogo' => 'fire',
    'água','agua' => 'water',
    'grama' => 'grass',
    'elétrico','eletrico' => 'electric',
    'psíquico','psiquico' => 'psychic',
    default => 'default'
};

$raridade = strtolower($pokemon->raridade ?? '');

$raridadeClasse = match($raridade){
    'comum' => 'raridade-comum',
    'incomum' => 'raridade-incomum',
    'rara' => 'raridade-rara',
    'rara holo' => 'raridade-holo',
    'ultra rara' => 'raridade-ultra',
    'secreta' => 'raridade-secreta',
    default => 'raridade-comum'
};

$imagem = $pokemon->imagem;
$imagemPath = $imagem ? ltrim(str_replace('\\', '/', $imagem), '/') : null;

$imagemFallback = !$imagemPath;

if (!$imagemPath) {
    $imagemUrl = asset('img/pack.png');
} elseif (str_starts_with($imagemPath, 'data:image')) {
    $imagemUrl = $imagemPath;
} elseif (preg_match('/^https?:\/\//', $imagemPath)) {
    $imagemUrl = $imagemPath;
} else {
    if (str_starts_with($imagemPath, 'public/')) {
        $imagemPath = substr($imagemPath, 7);
    }

    if (str_starts_with($imagemPath, 'storage/')) {
        $imagemPath = substr($imagemPath, 8);
    }

    if (!str_contains($imagemPath, '/')) {
        $imagemPath = 'pokemons/' . $imagemPath;
    }

    $imagemUrl = asset('storage/' . $imagemPath);
}
@endphp

<div class="tcg-card {{ $classe }} holo {{ $raridadeClasse }}">

<div class="tcg-inner">

    <div class="tcg-header">
        <span class="stage">{{ $pokemon->estagio ?? 'Básico' }}</span>
        <span class="name">{{ $pokemon->nome }}</span>
        <span class="hp">{{ $pokemon->hp }} HP</span>
    </div>

    <div class="image-box">
        <img
            src="{{ $imagemUrl }}"
            alt="{{ $pokemon->nome }}"
            class="{{ $imagemFallback ? 'fallback-image' : '' }}"
            onerror="this.onerror=null;this.src='{{ asset("img/pack.png") }}';this.classList.add('fallback-image');"
        >
    </div>

    @if($pokemon->habilidade_especial)
    <div class="ability-box">
        <div class="ability-title">⭐ Habilidade</div>
        <div class="ability-desc">
            {{ $pokemon->habilidade_especial }}
        </div>
    </div>
    @endif

    <div class="attack">
        <div class="attack-top">
            <span>{{ $pokemon->ataque1_nome }}</span>
            <span>{{ $pokemon->ataque1_dano }}</span>
        </div>
        <p class="attack-desc">{{ $pokemon->ataque1_descricao }}</p>
    </div>

    <div class="attack">
        <div class="attack-top">
            <span>{{ $pokemon->ataque2_nome }}</span>
            <span>{{ $pokemon->ataque2_dano }}</span>
        </div>
        <p class="attack-desc">{{ $pokemon->ataque2_descricao }}</p>
    </div>

    <div class="footer">
        <span>Fraq: {{ $pokemon->fraqueza }}</span>
        <span>Res: {{ $pokemon->resistencia }}</span>
        <span>Rec: {{ $pokemon->recuo }}</span>
    </div>

    <div class="footer">
        <span>#{{ $pokemon->numero_card }}</span>
        <span class="rarity-badge">{{ $pokemon->raridade }}</span>
        <span>{{ $pokemon->ilustrador }}</span>
    </div>

    <div class="actions">

        <a href="/pokemons/{{ $pokemon->id }}/edit"
           class="btn edit">✏ Editar</a>

        <form action="/pokemons/{{ $pokemon->id }}" method="POST"
              onsubmit="return confirm('Excluir Pokémon?')">
            @csrf
            @method('DELETE')

            <button class="btn delete">🗑 Excluir</button>
        </form>

    </div>

</div>
</div>

@endforeach

</div>

</div>

</body>
</html>
