@extends('layouts.app')

@section('content')
<style>
    /* =========================================
       Base Variables (Light & Dark)
    ========================================= */
    :root {
        --bg-main: #f5f9ff;
        --bg-header: #ffffff;
        --text-main: #1f2937;
        --border-color: #cbd5e1;
    }

    body.dark {
        --bg-main: #26282f;
        --bg-header: #1d1f28;
        --text-main: #ffffff;
        --border-color: #1e293b;
    }

    /* تطبيق الخلفية والنص بناء على الـ Mode */
    body.dark .content-area, 
    body.dark {
        background-color: var(--bg-main) !important;
        color: var(--text-main);
    }

    /* ===============================
       MATRIX GRID (Style Dyalek)
    ================================ */
    .mitre-grid {
        display: grid;
        grid-template-columns: repeat(14, minmax(150px, 1fr));
        gap: 6px;
        padding: 10px;
        overflow-x: auto;
        height: calc(100vh - 150px);
    }

    .tactic-col {
        display: flex;
        flex-direction: column;
        border: 1px solid var(--border-color);
        background: var(--bg-header); /* كيتغير مع الـ Dark Mode */
    }

    .tactic-header {
        font-size: 13px;
        font-weight: bold;
        text-align: center;
        padding: 8px 4px;
        border-bottom: 1px solid var(--border-color);
        color: #111827; /* اللون الأصلي للهيدر */
    }

    /* Tactic colors (Light Mode) */
    .tactic-col:nth-child(1) .tactic-header { background: #dbeafe; }
    .tactic-col:nth-child(2) .tactic-header { background: #e0f2fe; }
    .tactic-col:nth-child(3) .tactic-header { background: #dcfce7; }
    .tactic-col:nth-child(4) .tactic-header { background: #fef9c3; }
    .tactic-col:nth-child(5) .tactic-header { background: #fee2e2; }
    .tactic-col:nth-child(6) .tactic-header { background: #ffedd5; }
    .tactic-col:nth-child(7) .tactic-header { background: #fef08a; }

    /* Dark Mode Adjustment for Headers */
    body.dark .tactic-header {
        color: #ffffff; /* نص أبيض فالهيدر */
        filter: brightness(0.8) saturate(1.2); /* كينقص الجهد ديال اللون باش يجي زوين فـ Dark */
    }

    /* ===============================
       TECHNIQUE BOX (Style Dyalek)
    ================================ */
    .tech-box {
        background: #fff7cc;
        border: 1px solid var(--border-color);
        margin: 4px;
        padding: 6px;
        font-size: 11px;
        line-height: 1.3;
        cursor: pointer;
        height: 70px;
        color: #111827;
    }

    /* Dark Mode Adjustment for Tech Box */
    body.dark .tech-box {
        background: var(--bg-main); /* كياخد لون الخلفية الغامق */
        color: var(--text-main);
    }

    .tech-box.empty {
        background: #f8fafc;
        color: #94a3b8;
    }

    body.dark .tech-box.empty {
        background: rgba(255,255,255,0.03);
        color: #64748b;
    }

    /* Severity Colors (Kifma kano rir m9adin l Dark Mode) */
    .tech-box.sev-low { background: #fff7cc; }
    .tech-box.sev-med { background: #fde68a; }
    .tech-box.sev-high { background: #fca5a5; color: #111827; font-weight: bold; }
    .tech-box.high-activity { background: #ef4444; color: #ffffff; font-weight: bold; }

    body.dark .tech-box.sev-low { background: #2d2f39; border-left: 3px solid #fff7cc; }
    body.dark .tech-box.sev-med { background: #3e3223; border-left: 3px solid #fde68a; }
    body.dark .tech-box.sev-high { background: #4a2020; color: #fecaca; }

    /* Modal Dark Fix */
    body.dark .modal-content {
        background: var(--bg-header);
        color: var(--text-main);
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 px-3">
    <h3 class="fw-bold" style="color: var(--text-main)">MITRE ATT&CK Matrix</h3>
    {{-- <span class="badge bg-dark">QRadar Real-time Feed</span> --}}
</div>

<div class="mitre-grid">
    @foreach($tacticsOrder as $tacticName)
        <div class="tactic-col">
            <div class="tactic-header">{{ $tacticName }}</div>
            
            @if(isset($matrix[$tacticName]))
                @foreach($matrix[$tacticName] as $id => $tech)
                    @php
                        $sevClass = 'empty';
                        if($tech['count'] > 0) {
                            if($tech['severity'] >= 7) $sevClass = 'sev-high';
                            elseif($tech['severity'] >= 4) $sevClass = 'sev-med';
                            else $sevClass = 'sev-low';
                        }
                    @endphp

                    <div class="tech-box {{ $tech['count'] > 0 ? 'has-data' : 'empty' }} {{ $sevClass }} {{ $tech['count'] > 100 ? 'high-activity' : '' }}"
                         data-tech-name="{{ $tech['name'] }}"
                         data-offenses="{{ json_encode($tech['offenses']) }}">
                        
                        <div class="d-flex justify-content-between">
                            <strong>{{ $id }}</strong>
                            @if($tech['count'] > 0)
                                <span class="badge bg-secondary" style="font-size: 9px;">{{ $tech['count'] }}</span>
                            @endif
                        </div>
                        <small class="d-block mt-1">{{ $tech['name'] }}</small>
                    </div>
                @endforeach
            @else
                <div class="text-center p-2 text-muted" style="font-size: 10px;">No Techniques</div>
            @endif
        </div>
    @endforeach
</div>
{{-- java script for code of dashboard  --}}
<script>
    document.querySelectorAll('.tech-box').forEach(box => {
        box.addEventListener('click', () => {
            const offenses = JSON.parse(box.getAttribute('data-offenses') || '[]');
            if (offenses.length === 0) return;
            // ... (Rest of your modal logic)
            const modal = new bootstrap.Modal(document.getElementById('offenseModal'));
            modal.show();
        });
    });
</script>
@endsection