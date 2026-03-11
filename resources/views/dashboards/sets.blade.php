<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Sets Dashboard') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/sets.css') }}">
     <link rel="icon" type="image/png" href="{{ asset('YOKAMOS.png') }}">
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="parent-grid">
    @php
        $client = session('client', 'default');
    @endphp

    @foreach($panels as $index => $panel)
    {{-- Ensure index matches your div1, div2, etc. classes --}}
    <div class="div{{ $index + 1 }} widget-container">
        <div class="iframe-wrapper">
            <div class="iframe-loader">
                <img src="{{ asset('assets/logos/' . $client . '.png') }}" 
                     alt="{{ $client }} logo" 
                     class="logo-client"
                     onerror="this.src='{{ asset('assets/logos/default.png') }}'">
            </div>

            <iframe src="{{ $panel }}" loading="lazy"></iframe>
        </div>
    </div>
    @endforeach
</div>
<script>
document.querySelectorAll('.iframe-wrapper').forEach(wrapper => {
    const iframe = wrapper.querySelector('iframe');
    const loader = wrapper.querySelector('.iframe-loader');

    iframe.addEventListener('load', () => {
        if(loader){
            
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => loader.remove(), 400);
            }, 300);
        }
    });

    
    setTimeout(() => {
        if(loader) {
            loader.style.opacity = '0';
            setTimeout(() => loader.remove(), 400);
        }
    }, 10000);
});
</script>
@endsection




</body>
</html>