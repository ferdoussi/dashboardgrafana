<style>
.parent {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    grid-template-rows: repeat(11, 1fr);
    gap: 8px;
}

.div1 { grid-row: span 2 / span 2; }
.div3 { grid-row: span 2 / span 2; }
.div4 { grid-row: span 2 / span 2; }

.div5 {
    grid-column: span 2 / span 2;
    grid-row: span 5 / span 5;
}

.div6 {
    grid-column: span 3 / span 3;
    grid-row: span 3 / span 3;
    grid-row-start: 3;
    margin-top: -5px;
}

.div7 {
    grid-column: span 5 / span 5;
    grid-row: span 3 / span 3;
    grid-row-start: 6;
}

.div8 {
    grid-column: span 5 / span 5;
    grid-row: span 3 / span 3;
    grid-row-start: 9;
}

/* ====== WIDGET STYLE ====== */
.widget-container {
    position: relative;
    height: 100%;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.widget-title {
    display: flex;
    align-items: center;
    gap: 10px;

    position: absolute;
    top: 0;
    left: 0;
    right: 0;

    background: linear-gradient(90deg, #f4fbff, #f0f9ff);
    color: #0D3457;

    padding: 8px 12px;
    font-size: 13px;
    font-weight: 600;

    z-index: 10;
    border-bottom: 1px solid #e0f2ff;
}

.widget-title i {
    font-size: 16px;
    color: #1970A1;
}

/* Décalage iframe pour laisser la place au titre */
.widget-container iframe {
   border: none;
    width: 100%;
    height: 100%;
    padding-top: 0 !important; /* Had !important ghadi i-annuler l-42px li khassra l-mandar */
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




@extends('layouts.app')

@section('content')
@php
    $client = session('client', 'default'); 
    $gridClasses = ['div1', 'div3', 'div4', 'div5', 'div6', 'div7', 'div8'];
@endphp

<div class="parent">
    @foreach($panels as $index => $panel)
        @if(isset($gridClasses[$index]))
            <div class="{{ $gridClasses[$index] }} widget-container">

                {{-- Loader --}}
                <div class="iframe-wrapper">
                    <div class="iframe-loader">
                        <img src="{{ asset('assets/logos/' . $client . '.png') }}" alt="{{ $client }} logo" class="logo-client">
                    </div>

                    <iframe src="{{ $panel }}&kiosk=tv" frameborder="0" allowfullscreen></iframe>
                </div>

            </div>
        @endif
    @endforeach
</div>
@endsection

<script>
window.addEventListener('load', () => {
    document.querySelectorAll('.iframe-loader').forEach(loader => {
        loader.style.opacity = '0';
        loader.style.transition = 'opacity .4s ease';
        setTimeout(() => loader.remove(), 400);
    });
});
</script>
