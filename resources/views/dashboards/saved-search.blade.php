<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Rules Dashboard') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/rules.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('YOKAMOS.png') }}">
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="parent">
    @php
        $titles = [
            'Total Offenses', 'Offenses Ouvertes', 'Carte des Événements',
            'Sévérité Maximale', 'Journal des Événements', 'Analyse Temporelle', 'Total'
        ];
        $icons = ['bx-bar-chart-alt-2', 'bx-trending-up', 'bx-map', 'bx-bell', 'bx-book-content', 'bx-time-five', 'bx-lock-alt'];
        $client = session('client', 'default');
    @endphp

    @foreach($panels as $index => $panel)
        <div class="div{{ $index + 1 }} widget-card">
            {{-- <div class="widget-header">
                <i class="bx {{ $icons[$index] ?? 'bx-stats' }}"></i>
                <span>{{ $titles[$index] ?? 'Panel ' . ($index + 1) }}</span>
            </div> --}}

            <div class="iframe-wrapper">

                <div class="iframe-loader">
                    <img src="{{ asset('assets/logos/' . $client . '.png') }}"
                         alt="{{ $client }} logo"
                         class="logo-client">
                </div>

                <iframe src="{{ $panel }}&kiosk=tv" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
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

</body>
</html>
