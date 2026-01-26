<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Analytics Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/sets.css') }}">
</head>
<body>

@extends('layouts.app') {{-- تأكد بلي هادا هو الملف اللي فيه الـ Sidebar --}}

@section('content')
<div class="parent-grid">
    @foreach($panels as $index => $panel)
        <div class="div{{ $index + 1 }} widget-container">
          
            <iframe src="{{ $panel }}" frameborder="0"></iframe>
        </div>
    @endforeach
</div>
@endsection

</body>
</html>