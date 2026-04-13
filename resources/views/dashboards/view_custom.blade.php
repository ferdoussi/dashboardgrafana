@extends('layouts.app')

@section('title', $dashboard->name)

@section('content')
@php
    $client = session('client', 'default');
@endphp

<div class="dashboard-viewer-container">

    {{-- Header --}}
    <div class="viewer-header">
        <div class="header-left">
            <a href="{{ url()->previous() }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="title-group">
                <i class="fas fa-chart-line title-icon"></i>
                <h3>{{ $dashboard->name }}</h3>
            </div>
        </div>
        <div class="header-right">
            <span class="last-update">
                <i class="far fa-clock"></i>
                {{ translate('Last updated') }}: {{ $dashboard->updated_at->addHour()->format('d/m/Y H:i') }}
            </span>
        </div>
    </div>

    {{-- Grid Stack --}}
    <div class="grid-container">
        <div class="grid-stack"></div>
    </div>
</div>

<style>
:root {
    --bg-dashboard: #f0f5ff;
    --bg-card:      #ffffff;
    --border-color: #e2e8f0;
    --text-main:    #1a202c;
    --text-muted:   #64748b;
    --accent-color: #1970A1;
}
body.dark {
    --bg-dashboard: #1a1c24;
    --bg-card:      #1d1f28;
    --border-color: #1e293b;
    --text-main:    #e5e7eb;
    --text-muted:   #94a3b8;
    --accent-color: #38bdf8;
}

.dashboard-viewer-container {
    background-color: var(--bg-dashboard);
    min-height: 100vh;
    padding: 20px;
    transition: background 0.25s;
}

.viewer-header {
    display:         flex;
    justify-content: space-between;
    align-items:     center;
    padding:         13px 24px;
    background:      var(--bg-card);
    border:          1px solid var(--border-color);
    border-radius:   14px;
    box-shadow:      0 2px 10px rgba(25,112,161,0.07);
    margin-bottom:   18px;
    transition:      background 0.25s, border-color 0.25s;
}

.header-left { display: flex; align-items: center; gap: 14px; }

.btn-back {
    display:         flex;
    align-items:     center;
    justify-content: center;
    width: 34px; height: 34px;
    border-radius:   8px;
    color:           var(--text-muted);
    background:      transparent;
    border:          1px solid var(--border-color);
    text-decoration: none;
    transition:      all 0.22s;
}
.btn-back:hover {
    color:        var(--accent-color);
    border-color: var(--accent-color);
    background:   rgba(25,112,161,0.07);
    transform:    translateX(-2px);
}
body.dark .btn-back:hover { background: rgba(56,189,248,0.1); }

.title-group { display: flex; align-items: center; gap: 10px; }
.title-icon  { color: var(--accent-color); font-size: 1.25rem; }
.title-group h3 {
    margin: 0; font-weight: 800; color: var(--text-main);
    font-size: 1.15rem; letter-spacing: -0.3px;
}

.last-update {
    font-size:    13px;
    color:        var(--text-muted);
    display:      flex;
    align-items:  center;
    gap:          6px;
    background:   rgba(25,112,161,0.06);
    padding:      6px 14px;
    border-radius: 999px;
    border:       1px solid rgba(25,112,161,0.12);
}
body.dark .last-update {
    background:   rgba(56,189,248,0.07);
    border-color: rgba(56,189,248,0.15);
}

/* ── Grid Items ── */
.grid-stack-item-content {
    background:    var(--bg-card) !important;
    border-radius: 14px !important;
    border:        1px solid var(--border-color) !important;
    box-shadow:    0 2px 8px rgba(0,0,0,0.04);
    overflow:      hidden !important;
    transition:    border-color 0.2s, box-shadow 0.2s;
}

/* ── Panel Header ── */
.custom-panel-header {
    display:       flex;
    align-items:   center;
    padding:       0 14px;
    height:        42px;
    background:    var(--bg-card);
    border-bottom: 1px solid var(--border-color);
    flex-shrink:   0;
    transition:    background 0.25s, border-color 0.25s;
}
.panel-title {
    display:     flex;
    align-items: center;
    gap:         8px;
    font-weight: 700;
    font-size:   0.87rem;
    color:       var(--text-main);
    overflow:    hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.panel-title i { color: var(--accent-color); font-size: 0.82rem; flex-shrink: 0; }

/* ── iFrame container ── */
.iframe-container {
    position: absolute;
    top: 42px; left: 0; right: 0; bottom: 0;
    overflow: hidden;
}

.my-iframe {
    position:   absolute;
    left:       0;
    width:      100%;
    border:     none;
    display:    block;
    background: var(--bg-card);
    z-index:    1;
    /* transition smooth على الـ filter */
    transition: filter 0.3s ease;
}

.grafana-frame { top: -38px; height: calc(100% + 38px); }
.os-frame      { top: -48px; height: calc(100% + 48px); }

/*
 * Dark mode filter لـ OpenSearch
 * CSS class بدل inline style باش يكون أنظف
 */
.os-frame.dark-filter {
    filter: invert(1) hue-rotate(180deg) brightness(0.88) contrast(0.92) saturate(1.1);
}

/* ── Loader ── */
.iframe-loader {
    position:        absolute;
    inset:           0; z-index: 10;
    display:         flex;
    align-items:     center;
    justify-content: center;
    background:      var(--bg-card);
    transition:      opacity 0.4s ease;
}
.loader-logo { width: 48px; height: auto; animation: pulse 1.5s ease-in-out infinite; }
@keyframes pulse {
    0%,100% { transform: scale(0.95); opacity: 0.55; }
    50%      { transform: scale(1.05); opacity: 1; }
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack-all.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const rawLayout = @json($dashboard->layout);
    if (!rawLayout || rawLayout.length === 0) return;

    const grid = GridStack.init({ staticGrid: true, margin: 10, cellHeight: 100 });

    /* ── Helpers ── */
    const isOS    = url => url.includes('opensearch') || url.includes('kibana') || url.includes('/_dashboards');
    const getTheme = () => document.body.classList.contains('dark') ? 'dark' : 'light';

    function buildGrafanaUrl(rawUrl, theme) {
        const sep = rawUrl.includes('?') ? '&' : '?';
        return rawUrl.replace('/d/', '/d-solo/')
            + sep + 'theme=' + theme
            + '&kiosk=1&viewPanel=1&hideControls=true';
    }

    function buildOSUrl(rawUrl) {
        // OpenSearch: embed فقط — dark عبر CSS filter
        const base = rawUrl.includes('embed=true')
            ? rawUrl
            : rawUrl.replace('app/visualize?', 'app/visualize?embed=true&');
        const s = base.includes('?') ? '&' : '?';
        return base + s + 'hide-filter-bar=true';
    }

    /*
     * applyThemeToIframe
     * ─────────────────
     * Grafana  → يبدل الـ src (theme param في الـ URL)
     * OpenSearch → يبدل CSS class (filter)
     */
    function applyThemeToIframe(iframe, theme) {
        const rawUrl = iframe.dataset.rawUrl;

        if (isOS(rawUrl)) {
            /* Dark filter ON/OFF */
            if (theme === 'dark') {
                iframe.classList.add('dark-filter');
            } else {
                iframe.classList.remove('dark-filter');
            }
        } else {
            /* Grafana: reload بـ theme الجديد فقط إذا تغير */
            if (iframe.dataset.loadedTheme !== theme) {
                iframe.src = buildGrafanaUrl(rawUrl, theme);
            }
        }

        iframe.dataset.loadedTheme = theme;
    }

    /* ── Render widgets ── */
    rawLayout.forEach(item => {
        const rawUrl   = item.id;
        const theme    = getTheme();
        const osPanel  = isOS(rawUrl);
        const finalUrl = osPanel ? buildOSUrl(rawUrl) : buildGrafanaUrl(rawUrl, theme);

        /* نحددوا الـ class ديال dark filter من الأول إذا dark */
        const darkClass = (osPanel && theme === 'dark') ? ' dark-filter' : '';
        const frameClass = 'my-iframe ' + (osPanel ? 'os-frame' : 'grafana-frame') + darkClass;

        const name = item.name || 'Monitoring Panel';

        const content = `
            <div class="grid-stack-item-content">
                <div class="custom-panel-header">
                    <div class="panel-title">
                        <i class="fas fa-chart-bar"></i>
                        <span>${name}</span>
                    </div>
                </div>
                <div class="iframe-container">
                    <div class="iframe-loader">
                        <img src="{{ asset('assets/logos/' . $client . '.png') }}" class="loader-logo">
                    </div>
                    <iframe
                        src="${finalUrl}"
                        class="${frameClass}"
                        data-raw-url="${rawUrl}"
                        data-loaded-theme="${theme}"
                        scrolling="no"
                    ></iframe>
                </div>
            </div>`;

        const widget = grid.addWidget({ x: item.x, y: item.y, w: item.w, h: item.h, content });

        const iframe = widget.querySelector('iframe');
        const loader = widget.querySelector('.iframe-loader');
        if (iframe && loader) {
            function hideLoader() {
                if (!loader.parentNode) return;
                loader.style.transition = 'opacity 0.5s ease';
                loader.style.opacity    = '0';
                setTimeout(() => { if (loader.parentNode) loader.remove(); }, 500);
            }
           
            iframe.addEventListener('load', () => setTimeout(hideLoader, 2500));
           
            setTimeout(hideLoader, 9000);
        }
    });

    
    new MutationObserver(() => {
        const currentTheme = getTheme();
        document.querySelectorAll('iframe[data-raw-url]').forEach(iframe => {
            applyThemeToIframe(iframe, currentTheme);
        });
    }).observe(document.body, { attributes: true, attributeFilter: ['class'] });

});
</script>
@endsection