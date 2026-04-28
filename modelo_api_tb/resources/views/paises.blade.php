<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Países</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: #0a1628;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            font-family: sans-serif;
        }

        .grid-lines {
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .meridian {
            position: fixed; inset: 0;
            background-image:
                radial-gradient(ellipse 85% 60% at 50% 50%, transparent 59%, rgba(100,180,255,0.07) 60%, transparent 61%),
                radial-gradient(ellipse 60% 60% at 50% 50%, transparent 59%, rgba(100,180,255,0.05) 60%, transparent 61%),
                radial-gradient(ellipse 35% 60% at 50% 50%, transparent 59%, rgba(100,180,255,0.04) 60%, transparent 61%);
            pointer-events: none;
        }

        .card-wrap {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            perspective: 1000px;
        }

        .card {
            width: 280px;
            height: 400px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.8s;
            cursor: pointer;
        }

        .card-wrap:hover .card { transform: rotateY(180deg); }

        .card-face {
            position: absolute;
            width: 100%; height: 100%;
            border-radius: 16px;
            backface-visibility: hidden;
            overflow: hidden;
        }

        .card-front {
            background: linear-gradient(160deg, #1a2e4a 0%, #0d1f35 100%);
            border: 2px solid #2a6496;
            box-shadow: 0 0 30px rgba(42,100,150,0.4), 0 20px 40px rgba(0,0,0,0.6);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px 8px;
            border-bottom: 1px solid rgba(42,100,150,0.4);
        }

        .country-name {
            font-size: 15px;
            font-weight: 700;
            color: #e8f4fd;
            text-transform: capitalize;
        }

        .card-tag {
            font-size: 10px;
            background: rgba(42,100,150,0.5);
            color: #7ec8e3;
            border: 1px solid #2a6496;
            border-radius: 4px;
            padding: 2px 6px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .flag-area {
            margin: 10px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid rgba(42,100,150,0.5);
            position: relative;
            height: 148px;
            background: #0d1f35;
        }

        .flag-area img { width: 100%; height: 100%; object-fit: cover; }

        .flag-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(13,31,53,0.7));
        }

        .region-badge {
            display: flex;
            justify-content: center;
            margin: 6px 14px;
        }

        .region-badge span {
            background: rgba(42,100,150,0.35);
            border: 1px solid #2a6496;
            color: #7ec8e3;
            font-size: 11px;
            padding: 3px 12px;
            border-radius: 20px;
        }

        .divider {
            height: 1px;
            margin: 4px 14px;
            background: rgba(42,100,150,0.3);
        }

        .langs-section {
            padding: 4px 14px;
            font-size: 12px;
            color: #a8c8e0;
            max-height: 90px;
            overflow: hidden;
        }

        .langs-section p {
            padding: 2px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .lang-dot {
            width: 5px; height: 5px;
            background: #2a6496;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .card-footer {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 8px 14px;
            font-size: 11px;
            color: #7ec8e3;
            background: rgba(10,22,40,0.85);
            border-top: 1px solid rgba(42,100,150,0.3);
            display: flex;
            justify-content: space-between;
        }

        .card-back {
            background: radial-gradient(ellipse at center, #0d2a4a 0%, #050e1a 100%);
            transform: rotateY(180deg);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #2a6496;
            box-shadow: 0 0 30px rgba(42,100,150,0.4);
        }

        .reload-btn {
            padding: 10px 28px;
            background: transparent;
            color: #7ec8e3;
            font-weight: 600;
            font-size: 13px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            border: 1.5px solid #2a6496;
            letter-spacing: 0.5px;
        }

        .reload-btn:hover {
            background: rgba(42,100,150,0.3);
            transform: scale(1.04);
            box-shadow: 0 0 16px rgba(42,100,150,0.5);
        }
    </style>
</head>

<body>
    <div class="grid-lines"></div>
    <div class="meridian"></div>

    <div class="card-wrap">
        <div class="card">

            <!-- FRENTE -->
            <div class="card-face card-front">
                <div class="card-header">
                    <span class="country-name">{{ $dados[0]['name']['common'] }}</span>
                    <span class="card-tag">GEO</span>
                </div>

                <div class="flag-area">
                    <img src="{{ $dados[0]['flags']['png'] }}" alt="Bandeira">
                    <div class="flag-overlay"></div>
                </div>

                <div class="region-badge">
                    <span>{{ $dados[0]['region'] }}</span>
                </div>

                <div class="divider"></div>

                <div class="langs-section">
                    @foreach ($dados[0]['languages'] as $lang)
                        <p><span class="lang-dot"></span>{{ $lang }}</p>
                    @endforeach
                </div>

                <div class="card-footer">
                    <span>Capital: {{ $dados[0]['capital'][0] ?? 'N/A' }}</span>
                    <span>Pop: {{ number_format($dados[0]['population']) }}</span>
                </div>
            </div>

            <!-- VERSO -->
            <div class="card-face card-back">
                <svg width="160" height="160" viewBox="0 0 160 160">
                    <circle cx="80" cy="80" r="70" fill="none" stroke="#2a6496" stroke-width="1.5"/>
                    <ellipse cx="80" cy="80" rx="45" ry="70" fill="none" stroke="#2a6496" stroke-width="0.8" stroke-dasharray="4,3"/>
                    <ellipse cx="80" cy="80" rx="20" ry="70" fill="none" stroke="#2a6496" stroke-width="0.8" stroke-dasharray="4,3"/>
                    <line x1="10" y1="80" x2="150" y2="80" stroke="#2a6496" stroke-width="0.8"/>
                    <ellipse cx="80" cy="80" rx="70" ry="30" fill="none" stroke="#2a6496" stroke-width="0.8" stroke-dasharray="4,3"/>
                    <ellipse cx="80" cy="80" rx="70" ry="55" fill="none" stroke="#1a4060" stroke-width="0.6" stroke-dasharray="3,4"/>
                    <circle cx="80" cy="80" r="6" fill="#2a6496"/>
                    <circle cx="80" cy="80" r="3" fill="#7ec8e3"/>
                </svg>
            </div>

        </div>

        <button onclick="window.location.reload()" class="reload-btn">
            Explorar Outro País
        </button>
    </div>
</body>
</html>