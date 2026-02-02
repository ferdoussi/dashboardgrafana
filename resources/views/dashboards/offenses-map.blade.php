<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offenses Map</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="grafana-grid">

    <!-- ROW 1 : 4 small panels -->
    @foreach($panels as $index => $panel)
        @if($index < 4)
            <div class="panel small">
                <iframe src="{{ $panel }}" loading="lazy"></iframe>
            </div>
        @endif
    @endforeach

    <!-- ROW 2 : 1 large panel -->
    @if(isset($panels[4]))
        <div class="panel large">
            <iframe src="{{ $panels[4] }}" loading="lazy"></iframe>
        </div>
    @endif
     @if(isset($panels[4]))
        <div class="panel large">
            <iframe src="{{ $panels[5] }}" loading="lazy"></iframe>
        </div>
    @endif

</div>
@endsection



</div>
</body>
</html>