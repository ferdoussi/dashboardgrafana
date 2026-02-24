@extends('layouts.app')

@section('title', 'Home')

@section('content')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
{{-- Check User Role --}}
@if(auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
    
    {{-- ================= ADMIN VIEW ================= --}}
    <div class="top-bar">
        <div class="title-section">
            <h2>{{ translate('System Administration') }}</h2>
            <p>{{ translate('Global statistics and platform overview') }}</p>
        </div>
      
    </div>

    @php
        // جلب الإحصائيات (Calculations)
        $totalUsers = \App\Models\Employee::where('role', 'user')->count();
        $totalAdmins = \App\Models\Employee::where('role', 'admin')->count();
        $totalClientAdmins = \App\Models\Employee::where('role', 'admin_client')->count();
        $totalsuperAdmins = \App\Models\Employee::where('role', 'superadmin')->count();
        $totalDashboards = \App\Models\UserDashboard::count();
        // تأكد من اسم الموديل الخاص بالـ Panels عندك
        $totalPanels = \App\Models\Panel::count(); 
    @endphp

    <div class="widgets-grid">
        {{-- Total Users Card --}}
        <div class="widget-card stats-card">
            <div class="widget-icon bg-blue">
                <i class='bx bx-user'></i>
            </div>
            <div class="stats-info">
                <h4>{{ translate('Total Users') }}</h4>
                <h2 class="stats-number">{{ $totalUsers }}</h2>
                <p>{{ translate('Registered users') }}</p>
            </div>
        </div>

        {{-- Total Admins Card --}}
        <div class="widget-card stats-card">
            <div class="widget-icon bg-purple">
                <i class='bx bx-shield-quarter'></i>
            </div>
            <div class="stats-info">
                <h4>{{ translate('Total Admins') }}</h4>
                <h2 class="stats-number">{{ $totalAdmins }}</h2>
                <p>{{ translate('System administrators') }}</p>
            </div>
        </div>
        {{-- total client admin card --}}
        <div class="widget-card stats-card">
            <div class="widget-icon bg-purple">
                <i class='bx bx-shield-quarter'></i>
            </div>
            <div class="stats-info">
                <h4>{{ translate('Total Client Admins') }}</h4>
                <h2 class="stats-number">{{ $totalClientAdmins }}</h2>
                <p>{{ translate('Client administrators') }}</p>
            </div>
        </div>
        {{-- total super admin card --}}
        <div class="widget-card stats-card">
            <div class="widget-icon bg-purple">
                <i class='bx bx-shield-quarter'></i>
            </div>
            <div class="stats-info">
                <h4>{{ translate('Total Super Admins') }}</h4>
                <h2 class="stats-number">{{ $totalsuperAdmins }}</h2>
                <p>{{ translate('Super administrators') }}</p>
            </div>
        </div>

        {{-- Total Dashboards Card --}}
        <div class="widget-card stats-card">
            <div class="widget-icon bg-green">
                <i class='bx bx-layout'></i>
            </div>
            <div class="stats-info">
                <h4>{{ translate('Total Dashboards') }}</h4>
                <h2 class="stats-number">{{ $totalDashboards }}</h2>
                <p>{{ translate('Custom created layouts') }}</p>
            </div>
        </div>

        {{-- Total Panels Card --}}
        <div class="widget-card stats-card">
            <div class="widget-icon bg-orange">
                <i class='bx bx-grid-alt'></i>
            </div>
            <div class="stats-info">
                <h4>{{ translate('Total Panels') }}</h4>
                <h2 class="stats-number">{{ $totalPanels }}</h2>
                <p>{{ translate('Active monitoring panels') }}</p>
            </div>
        </div>
    </div>

@else

    {{-- ================= USER VIEW ================= --}}
    @auth
        @if(auth()->user()->role === 'admin_client')
            
      
    
    <div class="top-bar">
        <div class="title-section">
            <h2>{{ translate('Security Dashboards') }}  </h2>
            <p>{{ translate('Monitor your infrastructure in real-time') }}</p>
        </div>
        
        {{-- زر الإنشاء يظهر فقط للمستخدم العادي --}}
        <a href="{{ route('dashboard.create') }}" class="btn-create-dashboard">
            <i class='bx bx-plus'></i> <span>{{ translate('Create Dashboard') }}</span>
        </a>
    </div>
      @endif
@endauth
    <div class="widgets-grid">

        {{-- Événements --}}
        <a href="{{ route('dashboard.show', 'event') }}" class="widget-card-link">
            <div class="widget-card">
                <div class="widget-icon bg-blue">
                    <i class='bx bx-pulse'></i>
                </div>
                <h4>{{ translate('Events') }}</h4>
                <p>{{ translate('Security event stream') }}</p>
            </div>
        </a>
        <a href="{{ route('mitre.matrix') }}" class="widget-card-link">
            <div class="widget-card">
                <div class="widget-icon bg-blue">
                    <i class='bx bx-shield'></i> 
                </div>
                <h4>{{ translate('MITRE ATT&CK') }}</h4>
                <p>{{ translate('Security event stream') }}</p>
            </div>
        </a>

        {{-- Offenses --}}
        <a href="{{ route('dashboard.show', 'offenses') }}" class="widget-card-link">
            <div class="widget-card">
                <div class="widget-icon bg-red">
                    <i class='bx bx-error'></i>
                </div>
                <h4>{{ translate('Offenses') }}</h4>
                <p>{{ translate('Detected and correlated threats') }}</p>
            </div>
        </a>

        {{-- Rules --}}
        <a href="{{ route('dashboard.show', 'rules') }}" class="widget-card-link">
            <div class="widget-card">
                <div class="widget-icon bg-purple">
                    <i class='bx bx-shield'></i>
                </div>
                <h4>{{ translate('Rules') }}</h4>
                <p>{{ translate('Active detection rules') }}</p>
            </div>
        </a>

        {{-- Sets --}}
        <a href="{{ route('dashboard.show', 'sets') }}" class="widget-card-link">
            <div class="widget-card">
                <div class="widget-icon bg-green">
                    <i class='bx bx-layer'></i>
                </div>
                <h4>{{ translate('Sets') }}</h4>
                <p>{{ translate('Groupes & classifications') }}</p>
            </div>
        </a>

        {{-- Saved Search --}}
        <a href="{{ route('dashboard.show', 'saved-search') }}" class="widget-card-link">
            <div class="widget-card">
                <div class="widget-icon bg-orange">
                    <i class='bx bx-save'></i>
                </div> 
                <h4>{{ translate('Saved Search') }}</h4>
                <p>{{ translate('Saved searches') }}</p>
            </div>
        </a>

        {{-- Custom Dashboards (Dynamic) --}}
      @php
    $clientId = auth()->user()->client_id;

    $customDashboards = \App\Models\UserDashboard::where(
        'client_id',
        $clientId
    )->latest()->get();
@endphp


        @foreach($customDashboards as $custom)
            <a href="{{ route('dashboard.viewCustom', $custom->id) }}" class="widget-card-link">
                <div class="widget-card custom-card">
                    <div class="widget-icon" style="background: #2d3436; color: #fff;">
                        <i class='bx bx-layout'></i>
                    </div>
                    <h4>{{ $custom->name }}</h4>
                    <p>{{ $custom->description }}</p>
                </div>
            </a>
        @endforeach

        {{-- Offenses Map (BIG) --}}
        <a href="{{ route('dashboard.show', 'offenses-map') }}" class="widget-card-link widget-map-wrapper">
            <div class="widget-card widget-map">
                <div class="widget-map-header">
                    <h4><i class='bx bx-map'></i> {{ translate('Offenses Map') }}</h4>
                    <span class="status-live"><span class="pulse-dot"></span> {{ translate('LIVE') }}</span>
                </div>
                <div class="map-placeholder">
                    <div class="map-dot dot-red" style="top:30%; left:40%"></div>
                    <div class="map-dot dot-orange" style="top:55%; left:60%"></div>
                    <div class="map-dot dot-red" style="top:45%; left:25%"></div>
                    <span class="map-text">{{ translate('Attacks detected worldwide') }}</span>
                </div>
            </div>
        </a>

    </div>
@endif
@endsection