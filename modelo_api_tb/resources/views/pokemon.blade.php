<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex API</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .card-container {
            perspective: 1000px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .card {
            width: 260px;
            height: 380px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.8s;
        }

        .card-container:hover .card {
            transform: rotateY(180deg);
        }

        .card-face {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 16px;
            backface-visibility: hidden;
            overflow: hidden;
        }

        .card-front {
            background: linear-gradient(#fdfdfd, #eaeaea);
            border: 10px solid #f6c700;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            padding: 8px;
        }

        .name {
            text-transform: capitalize;
        }

        .hp {
            color: red;
        }

        .card-image {
            background: linear-gradient(to bottom, #b3e5fc, #e1f5fe);
            margin: 5px;
            border-radius: 10px;
            padding: 10px;
        }

        .card-image img {
            width: 100%;
        }

        .card-types {
            display: flex;
            gap: 5px;
            justify-content: center;
            margin: 5px;
        }

        .card-types span {
            background: #ffcc00;
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 10px;
        }

        .card-attacks {
            padding: 8px;
            font-size: 12px;
        }

        .card-footer {
            font-size: 10px;
            text-align: center;
            padding: 5px;
        }

        .holo {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255,255,255,0.4),
                transparent
            );
            animation: holoMove 3s infinite;
        }

        @keyframes holoMove {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .card-back {
            background: radial-gradient(circle, #1e3a8a, #000);
            transform: rotateY(180deg);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pokeball {
            width: 100px;
            height: 100px;
            background: linear-gradient(red 50%, white 50%);
            border-radius: 50%;
            border: 5px solid black;
            position: relative;
        }

        .pokeball::after {
            content: "";
            width: 20px;
            height: 20px;
            background: white;
            border: 4px solid black;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* BOTÃO */
        .reload-btn {
            padding: 10px 20px;
            background: #facc15;
            color: black;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .reload-btn:hover {
            background: #eab308;
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center min-h-screen font-sans">

<div class="card-container">

    <div class="card">

        <!-- FRENTE -->
        <div class="card-face card-front">

            <div class="card-header">
                <span class="name">{{ $pokemon['name'] }}</span>
                <span class="hp">HP {{ rand(60,150) }}</span>
            </div>

            <div class="card-image">
                <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}">
            </div>

            <div class="card-types">
                @foreach ($pokemon['types'] as $tipo)
                    <span>{{ $tipo['type']['name'] }}</span>
                @endforeach
            </div>

            <div class="card-attacks">
                @foreach ($pokemon['abilities'] as $ataque)
                    <p>⚡ {{ $ataque['ability']['name'] }}</p>
                @endforeach
            </div>

            <div class="card-footer">
                Altura: {{ $pokemon['height'] / 10 }}m • Peso: {{ $pokemon['weight'] / 10 }}kg
            </div>

            <div class="holo"></div>
        </div>

        <!-- VERSO -->
        <div class="card-face card-back">
            <div class="pokeball"></div>
        </div>

    </div>

    <!-- BOTÃO CORRIGIDO -->
    <button onclick="window.location.reload()" class="reload-btn">
        Abrir Outro Pacote
    </button>

</div>

</body>
</html>