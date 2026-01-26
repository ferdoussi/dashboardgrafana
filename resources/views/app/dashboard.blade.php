@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @if (View::exists("dashboards.$type"))
        @include("dashboards.$type")
    @else
        <p>Dashboard introuvable</p>
    @endif
    

@endsection
