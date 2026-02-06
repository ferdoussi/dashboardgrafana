<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Offenses Map') }}</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
     <link rel="icon" type="image/png" href="{{ asset('YOKAMOS.png') }}">
</head>
<body>
@extends('layouts.app')

@section('content')
@php
    $client = session('client', 'default'); // جلب client ديناميكياً
@endphp

<div class="grafana-grid">

    <!-- ROW 1 : 4 small panels -->
    @foreach($panels as $index => $panel)
        @if($index < 4)
            <div class="panel small">
                <div class="iframe-wrapper">
                    <div class="iframe-loader">
                        <img src="{{ asset('assets/logos/' . $client . '.png') }}"
                             alt="{{ $client }} logo"
                             class="logo-client">
                    </div>
                    <iframe src="{{ $panel }}" loading="lazy" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        @endif
    @endforeach

    <!-- ROW 2 : 2 large panels -->
    @if(isset($panels[4]))
        <div class="panel large">
            <div class="iframe-wrapper">
                <div class="iframe-loader">
                    <img src="{{ asset('assets/logos/' . $client . '.png') }}"
                         alt="{{ $client }} logo"
                         class="logo-client">
                </div>
                <iframe src="{{ $panels[4] }}" loading="lazy" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    @endif

    @if(isset($panels[5]))
        <div class="panel large">
            <div class="iframe-wrapper">
                <div class="iframe-loader">
                    <img src="{{ asset('assets/logos/' . $client . '.png') }}"
                         alt="{{ $client }} logo"
                         class="logo-client">
                </div>
                <iframe src="{{ $panels[5] }}" loading="lazy" frameborder="0" allowfullscreen></iframe>
            </div>
        </div> 
    @endif

</div>

{{-- JS باش يتحيد loader --}}
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




</div>
</body>
</html>