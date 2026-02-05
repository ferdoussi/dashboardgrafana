<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ translate('Saved Search') }}</title>
    <link rel="stylesheet" href="{{ asset('css/saved.css') }}">
     <link rel="icon" type="image/png" href="{{ asset('YOKAMOS.png') }}">
</head>
<body>

  @extends('layouts.app') 

@section('content')
<div class="parent-grid">
    @foreach($panels as $index => $panel)
        @php
            /* كنصاوبو class سميتها div1, div2... على حساب الترتيب */
            $divClass = 'div' . ($index + 1);
        @endphp
        
        <div class="{{ $divClass }} widget-card">
            <div class="widget-loader"></div> {{-- اختياري: لودر كيبان قبل ما يشرجي iframe --}}
            <iframe src="{{ $panel }}" frameborder="0" allowfullscreen></iframe>
        </div>
    @endforeach
</div>
@endsection


</body>
</html>