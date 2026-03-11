<style>
     .dashboard-title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            text-align: center;
            font-size: 26px;
            color: #0D3457;
            font-weight: 600;
        }

        .dashboard-title i {
            color: #1970A1;
            font-size: 30px;
        }

        /* GRID PRINCIPALE */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-template-rows: repeat(5, 160px);
            gap: 20px;
            margin-top: 20px;
        }

        /* STYLES DES IFRAMES */
        .dashboard-grid iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: white;
        }

        .dashboard-grid iframe:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

       
        .div1 { grid-column: 1 / span 3; grid-row: 1 / span 1; }
        .div2 { grid-column: 4 / span 3; grid-row: 1 / span 1; }
        .div4 { grid-column: 7 / span 3; grid-row: 1 / span 1; }
        .div7 { grid-column: 10 / span 3; grid-row: 1 / span 1; }
        .div3 { grid-column: 1 / span 6; grid-row: 2 / span 2; }
        .div5 { grid-column: 7 / span 6; grid-row: 2 / span 2; }
        .div6 { grid-column: 1 / span 12; grid-row: 4 / span 2; }

        
        .widget-container {
            position: relative;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .widget-title {
            display: flex;
            align-items: center;
            gap: 10px;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(90deg, #f4fbffff, #f0f9ffff);
            color: #0D3457;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: 600;
            z-index: 10;
            border-radius: 12px 12px 0 0;
            border-bottom: 1px solid #e0f2ff;
        }

        .widget-title i {
            font-size: 16px;
            color: #1970A1;
        }

        /* VERSION RESPONSIVE */
        @media (max-width: 1600px) {
            .dashboard-grid { 
                grid-template-rows: repeat(5, 140px);
                gap: 15px;
            }
        }

        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: repeat(6, 1fr);
                grid-template-rows: repeat(8, 130px);
            }
            
            .div1, .div2, .div4, .div7 {
                grid-column: span 3;
                grid-row: auto;
            }
            
            .div1 { grid-column: 1 / span 3; grid-row: 1; }
            .div2 { grid-column: 4 / span 3; grid-row: 1; }
            .div4 { grid-column: 1 / span 3; grid-row: 2; }
            .div7 { grid-column: 4 / span 3; grid-row: 2; }
            
            .div3 { grid-column: 1 / span 6; grid-row: 3 / span 2; }
            .div5 { grid-column: 1 / span 6; grid-row: 5 / span 2; }
            .div6 { grid-column: 1 / span 6; grid-row: 7 / span 2; }
        }

        @media (max-width: 768px) {
            body { 
                padding: 15px; 
            }
            
            .header {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
                text-align: center;
            }

            .dashboard-title {
                font-size: 20px;
                flex-direction: column;
                gap: 8px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(7, 200px);
                gap: 15px;
            }

            .div1, .div2, .div3, .div4, .div5, .div6, .div7 {
                grid-column: 1;
                grid-row: auto;
            }
            
            .profile-menu {
                width: 100%;
            }
            
            .profile-btn {
                width: 100%;
                justify-content: center;
            }
            
            .dropdown-menu {
                width: 100%;
                right: auto;
                left: 0;
            }
        }

        /* ANIMATION DE CHARGEMENT */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        .iframe-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
}

.iframe-wrapper iframe {
    width: 100%;
    height: 100%;
    border: none;
    
}

.iframe-loader {
    position: absolute;
    inset: 0;
    z-index: 10;
    pointer-events: none;
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    background: rgb(255, 255, 255);

    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-client {
    width: 64px;
    opacity: 0.9;
    animation: pulse 1.6s ease-in-out infinite;
}

@keyframes pulse {
    0% { transform: scale(1); opacity: .7; }
    50% { transform: scale(1.06); opacity: 1; }
    100% { transform: scale(1); opacity: .7; }
}

</style>

<!-- DASHBOARD GRID -->
@extends('layouts.app')

@section('content')
@php
    $client = session('client', 'default');
    $titles = [
        'Total Offenses',
        'Offenses Ouvertes',
        'Carte des Événements',
        'Sévérité Maximale Actuelle',
        'Journal des Événements',
        'Analyse Temporelle',
        'Total des Événements'
    ];

    $icons = [
        'bx-bar-chart-alt-2',
        'bx-trending-up',
        'bx-map',
        'bx-bell',
        'bx-book-content',
        'bx-time-five',
        'bx-lock-alt'
    ];
@endphp

<div class="dashboard-grid">
    @foreach($panels as $index => $panel)
        <div class="widget-container div{{ $index + 1 }}">
            <div class="widget-title">
                <i class="bx {{ $icons[$index] ?? 'bx-bar-chart-alt-2' }}"></i>
                {{ $titles[$index] ?? 'Widget ' . ($index + 1) }}
            </div>

            <div class="iframe-wrapper">
                
                <div class="iframe-loader">
                    <img src="{{ asset('assets/logos/' . $client . '.png') }}" alt="{{ $client }} logo" class="logo-client">
                </div>

                <iframe src="{{ $panel }}" frameborder="0"></iframe>
            </div>
        </div>
    @endforeach
</div>


<script>
window.addEventListener('load', () => {
    document.querySelectorAll('.iframe-loader').forEach(loader => {
        loader.style.opacity = '0';
        loader.style.transition = 'opacity .4s ease';
        setTimeout(() => loader.remove(), 400);
    });
});
</script>
@endsection


    