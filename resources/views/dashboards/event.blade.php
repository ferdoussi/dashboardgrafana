<style>
.parent {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    grid-template-rows: repeat(11, 1fr);
    gap: 8px;
}

.div1 { grid-row: span 2 / span 2; }
.div3 { grid-row: span 2 / span 2; }
.div4 { grid-row: span 2 / span 2; }

.div5 {
    grid-column: span 2 / span 2;
    grid-row: span 5 / span 5;
}

.div6 {
    grid-column: span 3 / span 3;
    grid-row: span 3 / span 3;
    grid-row-start: 3;
    margin-top: -5px;
}

.div7 {
    grid-column: span 5 / span 5;
    grid-row: span 3 / span 3;
    grid-row-start: 6;
}

.div8 {
    grid-column: span 5 / span 5;
    grid-row: span 3 / span 3;
    grid-row-start: 9;
}

/* ====== WIDGET STYLE ====== */
.widget-container {
    position: relative;
    height: 100%;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.widget-title {
    display: flex;
    align-items: center;
    gap: 10px;

    position: absolute;
    top: 0;
    left: 0;
    right: 0;

    background: linear-gradient(90deg, #f4fbff, #f0f9ff);
    color: #0D3457;

    padding: 8px 12px;
    font-size: 13px;
    font-weight: 600;

    z-index: 10;
    border-bottom: 1px solid #e0f2ff;
}

.widget-title i {
    font-size: 16px;
    color: #1970A1;
}

/* Décalage iframe pour laisser la place au titre */
.widget-container iframe {
   border: none;
    width: 100%;
    height: 100%;
    padding-top: 0 !important; /* Had !important ghadi i-annuler l-42px li khassra l-mandar */
}
</style>




@extends('layouts.app') {{-- هادا هو الملف اللي فيه الـ Sidebar والـ Layout --}}
<title>{{ translate('Events Dashboard') }}</title>
@section('content') {{-- هاد البلاصة هي اللي كتمثل الـ Content الوسطاني --}}
<div class="parent">
    @php
        $gridClasses = ['div1', 'div3', 'div4', 'div5', 'div6', 'div7', 'div8'];
    @endphp

    @foreach($panels as $index => $panel)
        @if(isset($gridClasses[$index]))
            <div class="{{ $gridClasses[$index] }} widget-container">
                <iframe src="{{ $panel }}" frameborder="0"></iframe>
            </div>
        @endif
    @endforeach
</div>
@endsection
</div>