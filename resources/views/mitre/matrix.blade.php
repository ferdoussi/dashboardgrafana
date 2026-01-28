<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MITRE ATT&CK Matrix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f1f5f9; }
        
        /* إعداد الشبكة لـ 14 عموداً ثابتة */
        .mitre-grid {
            display: grid;
            grid-template-columns: repeat(14, minmax(130px, 1fr));
            gap: 10px;
            padding: 15px;
            overflow-x: auto; /* سكرول عرضي إذا كانت الشاشة صغيرة */
        }

        .tactic-col {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .tactic-header {
            background: #1f2937;
            color: #fff;
            padding: 12px 5px;
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            border-radius: 4px;
            margin-bottom: 10px;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tech-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            margin-bottom: 8px;
            padding: 10px;
            font-size: 12px;
            transition: all 0.2s ease;
            cursor: pointer;
            border-left: 4px solid #cbd5e1; /* الافتراضي */
        }

        .tech-box:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        /* الخلايا الفارغة */
        .tech-box.empty {
            opacity: 0.6;
            color: #94a3b8;
        }

        /* تلوين الخلايا التي تحتوي على بيانات (Active) */
        .tech-box.has-data {
            background-color: #fffbeb !important;
            font-weight: 500;
        }

        /* تلوين الحافة بناءً على Severity */
        .tech-box.sev-low { border-left-color: #22c55e; }
        .tech-box.sev-med { border-left-color: #f59e0b; background-color: #fffbeb !important; }
        .tech-box.sev-high { border-left-color: #ef4444; background-color: #fef2f2 !important; }

        /* حالة النشاط المكثف */
        .tech-box.high-activity {
            background-color: #ef4444 !important;
            color: white !important;
            border-left-color: #991b1b;
        }
        .tech-box.high-activity small { color: #fee2e2; }
    </style>
</head>

<body class="p-3">

<div class="d-flex justify-content-between align-items-center mb-4 px-3">
    <h3 class="fw-bold text-dark">MITRE ATT&CK Matrix</h3>
    <span class="badge bg-dark">QRadar Real-time Feed</span>
</div>

<div class="mitre-grid">
    @foreach($tacticsOrder as $tacticName)
        <div class="tactic-col">
            <div class="tactic-header">{{ $tacticName }}</div>
            
            @if(isset($matrix[$tacticName]))
                @foreach($matrix[$tacticName] as $id => $tech)
                    @php
                        // تحديد كلاس اللون بناء على Severity
                        $sevClass = 'empty';
                        if($tech['count'] > 0) {
                            if($tech['severity'] >= 7) $sevClass = 'sev-high';
                            elseif($tech['severity'] >= 4) $sevClass = 'sev-med';
                            else $sevClass = 'sev-low';
                        }
                    @endphp

                    <div class="tech-box {{ $tech['count'] > 0 ? 'has-data' : 'empty' }} {{ $sevClass }} {{ $tech['count'] > 100 ? 'high-activity' : '' }}"
                         data-tech-name="{{ $tech['name'] }}"
                         data-count="{{ $tech['count'] }}"
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

<div class="modal fade" id="offenseModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="modalTitle">Offenses Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div id="offenseList" class="list-group list-group-flush">
                    </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.tech-box').forEach(box => {
    box.addEventListener('click', () => {
        const rawData = box.getAttribute('data-offenses');
        const techName = box.getAttribute('data-tech-name');
        const offenses = rawData ? JSON.parse(rawData) : [];
        
        document.getElementById('modalTitle').innerText = `Technique: ${techName} (${offenses.length})`;
        
        const list = document.getElementById('offenseList');
        list.innerHTML = '';

        if (offenses.length === 0) {
            list.innerHTML = '<div class="p-5 text-center text-muted">No active offenses found for this technique.</div>';
        } else {
            offenses.forEach(o => {
                const item = document.createElement('div');
                item.className = 'list-group-item p-3';
                item.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-primary mb-1">ID: #${o.id}</span>
                            <h6 class="mb-1 fw-bold">${o.description || 'No description available'}</h6>
                            <div class="text-muted small">
                                <strong>Categories:</strong> ${o.categories ? o.categories.join(', ') : 'N/A'}
                            </div>
                        </div>
                        <div class="text-center ms-3">
                            <div class="h4 mb-0 text-danger fw-bold">${o.severity}</div>
                            <small class="text-uppercase text-muted" style="font-size: 10px;">Severity</small>
                        </div>
                    </div>
                `;
                list.appendChild(item);
            });
        }

        const modal = new bootstrap.Modal(document.getElementById('offenseModal'));
        modal.show();
    });
});
</script>

</body>
</html>