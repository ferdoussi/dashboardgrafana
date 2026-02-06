@extends('layouts.app')
<title>{{ $dashboard->name }}</title>

@section('content')
<div class="dashboard-viewer-container">
    
    {{-- Header بسيط فيه غير السمية ورجوع --}}
    <div class="viewer-header">
        <div class="header-left">
            
            <div class="title-group">
                <h3>{{ $dashboard->name }}</h3>
                
            </div>
        </div>       
        <div class="header-right">
            <span class="last-update"><i class="far fa-clock"></i> {{ translate('Last updated') }} {{ $dashboard->updated_at->addHour()->format('H:i') }}</span>
        </div>
    </div>
@php
    $client = session('client', 'default'); // ولا أي قيمة default عندك
@endphp

    {{-- الشبكة --}}
    <div class="grid-container">
        <div class="grid-stack"></div> 
    </div>
</div>

{{-- CSS --}}
<style>

    /* Dark mode styles */
    /* ===============================
   DARK MODE – DASHBOARD VIEWER
================================ */

body.dark .dashboard-viewer-container {
    background-color: #020617;
}

/* ================= HEADER ================= */

body.dark .viewer-header {
    background: #020617;
    border-color: #1e293b;
    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
}

body.dark .btn-back {
    color: #94a3b8;
}

body.dark .btn-back:hover {
    color: #60a5fa;
}

/* Title */
body.dark .title-group h3 {
    color: #e5e7eb;
}

/* Badge */
body.dark .badge-status {
    background: rgba(59,130,246,0.15);
    color: #60a5fa;
}

/* Last update */
body.dark .last-update {
    color: #64748b;
}

/* ================= GRID ITEMS ================= */

body.dark .grid-stack-item-content {
    background: #020617 !important;
    border-color: #1e293b !important;
    box-shadow: 0 15px 35px rgba(0,0,0,0.85);
}

/* ================= IFRAME ================= */

body.dark .iframe-wrapper {
    background: #020617;
}

    .dashboard-viewer-container {
        background-color: #f4f7f9;
        min-height: 100vh;
        padding-bottom: 30px;
    }

    /* Header View Mode */
    .viewer-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .header-left { display: flex; align-items: center; gap: 20px; }
    
    .btn-back {
        color: #4a5568;
        font-size: 1.1rem;
        transition: 0.2s;
        text-decoration: none;
    }
    .btn-back:hover { color: #3182ce; transform: translateX(-3px); }

    .title-group h3 {
        margin: 0;
        font-weight: 800;
        color: #1a202c;
        font-size: 1.25rem;
    }

    .badge-status {
        font-size: 0.7rem;
        background: #ebf8ff;
        color: #3182ce;
        padding: 2px 10px;
        border-radius: 20px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .last-update { color: #a0aec0; font-size: 0.85rem; }

    /* Grid Styling */
    .grid-container { 
        padding: 0 ;
     }

    .grid-stack-item-content {
        background: #fff !important;
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden !important;
    }

    /* تحسين شكل الـ Iframe */
   
    .iframe-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    background: #fff;
}

.iframe-loader {
    position: absolute;
    inset: 0;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
  background: rgb(255, 255, 255);
    transition: opacity 0.4s ease;
}

.iframe-loader .loader-logo {
    width: 60px;
    height: auto;
}

</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack.min.css">
<script src="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack-all.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const rawLayout = @json($dashboard->layout);

    if (!rawLayout || rawLayout.length === 0) return;

    // تشغيل GridStack في وضع staticGrid (غير قابل للتحريك)
    const grid = GridStack.init({
        staticGrid: true, 
        margin: 10, // خليناه 10 باش يجي الفراغ باين ونقي
        cellHeight: 100
    });

    rawLayout.forEach(item => {
    let finalUrl = item.id;
    finalUrl += (finalUrl.includes('?') ? '&' : '?') + 'kiosk=1&theme=light';

    const widget = grid.addWidget({
        x: item.x,
        y: item.y,
        w: item.w,
        h: item.h,
        content: `
                <div class="iframe-wrapper">
                    <!-- Loader -->
                    <div class="iframe-loader">
                        <img src="{{ asset('assets/logos/' . $client . '.png') }}" 
                            alt="Loading..." 
                            class="loader-logo">
                    </div>

                    <iframe src="${finalUrl}" style="width:100%; height:100%; border:none;" allowfullscreen></iframe>
                </div>
            `

     });

    // Hide loader when iframe is loaded
    const iframe = widget.querySelector('iframe');
    const loader = widget.querySelector('.iframe-loader');
    iframe.addEventListener('load', () => {
        loader.style.opacity = '0';
        setTimeout(() => loader.remove(), 400);
    });
});
});

</script>
@endsection

{{--@extends('layouts.app')

@section('content')
<div class="dashboard-viewer-container">
    <div class="viewer-header">
        <div class="header-left">
            <div class="title-group">
                <h3>{{ $dashboard->name }}</h3>
            </div>
        </div>
        <div class="header-right">
            <span class="last-update"><i class="far fa-clock"></i> Dernière mise à jour: {{ $dashboard->updated_at->format('H:i') }}</span>
        </div>
    </div>

    <div class="grid-container">
        <div class="grid-stack"></div> 
    </div>
</div>

<style>
    .dashboard-viewer-container {
        background-color: #f4f7f9;
        min-height: 100vh;
        padding-bottom: 30px;
    }

    .viewer-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .title-group h3 {
        margin: 0; font-weight: 800; color: #1a202c; font-size: 1.25rem;
    }

    .grid-stack-item-content {
        background: #fff !important;
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden !important;
    }

    /* هاد الجزء هو المهم باش تقدر تحرك */
    .drag-handler {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 10; /* فوق الـ iframe */
        cursor: move;
        background: transparent;
    }

    /* إلا بغيتي تدخل وسط الـ iframe، خاصك تحيد الـ handler أو تصغرو */
    /* هنا غنخليوه يتجر من أي بلاصة، ولكن إلا كليكتي مرتين كيولي الـ iframe هو اللي خدام */
    .grid-stack-item.ui-draggable-dragging .drag-handler {
        background: rgba(49, 130, 206, 0.05);
    }

    .iframe-wrapper { width: 100%; height: 100%; background: #fff; position: relative; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack.min.css">
<script src="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack-all.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const rawLayout = @json($dashboard->layout);
    if (!rawLayout || rawLayout.length === 0) return;

    // 1. ردينا staticGrid: false باش تقدر تحرك
    const grid = GridStack.init({
        staticGrid: false, 
        margin: 10,
        cellHeight: 100,
        float: true,
        resizable: { handles: 'se' } // كايسمح حتى بتغيير الحجم
    });

    rawLayout.forEach(item => {
        let finalUrl = item.id;
        finalUrl += (finalUrl.includes('?') ? '&' : '?') + 'kiosk=1&theme=light';

        grid.addWidget({
            x: item.x, y: item.y, w: item.w, h: item.h,
            content: `
                <div class="iframe-wrapper">
                    <div class="drag-handler"></div>
                    <iframe src="${finalUrl}" style="width:100%; height:100%; border:none;" allowfullscreen></iframe>
                </div>
            `
        });
    });

    // تحسين: إلا بغيتي تكليكي وسط الـ Grafana، خاص الـ handler يختفي
    // هادي اختيارية: كليكي مرتين (Double Click) باش تخدم وسط الـ iframe
    document.querySelectorAll('.drag-handler').forEach(handler => {
        handler.addEventListener('dblclick', function() {
            this.style.display = 'none';
        });
    });
});
</script>
@endsection  --}}