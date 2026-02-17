@extends('layouts.app')
<title>{{ translate('Custom Dashboard') }}</title>
@section('content')
<div style="height:90vh;position:relative; background-color: #f4f7f9;border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">

    {{-- ===== TOP BAR ===== --}}
    <div class="dashboard-header">
        <div class="header-title">
            <i class="fas fa-chart-line title-icon"></i>
            <h3>{{ translate('Custom Monitoring Dashboard') }}</h3>
        </div>

        <div class="header-actions">
            <button class="btn-action btn-add" onclick="togglePanels()">
                <i class="fas fa-plus-circle"></i> 
                <span>{{ translate('Add Visualization') }}</span>
            </button>

            <button class="btn-action btn-save" onclick="saveLayout()">
                <i class="fas fa-save"></i> 
                <span>{{ translate('Save') }}</span>
            </button>
        </div>
    </div>

    {{-- ===== GRID ===== --}}
    <div style="padding:15px; height: calc(90vh - 80px); overflow-y: auto;">
        <div class="grid-stack"></div>
    </div>
</div>

{{-- ===== MODAL (Panels Selection) ===== --}}
<div id="panelsSidebar" class="save-modal">
    <div class="modal-box">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h4 style="margin:0; font-size: 1.1rem; border:none; text-align:left;">{{ translate('Available Panels') }}</h4>
            <button class="btnclose" onclick="togglePanels()"><i class="fas fa-times"></i></button>
        </div>

        {{-- ===== SEARCH & CATEGORY FILTER ===== --}}
        <div style="display:flex; gap:10px; margin-bottom: 15px;">
            <input type="text" id="panelSearch" class="form-control" placeholder="{{ translate('Search by name...') }}" onkeyup="filterPanels()">

            <select id="categoryFilter" class="form-control" onchange="filterPanels()">
                <option value="">{{ translate('All categories') }}</option>
                @foreach($panels as $module => $categories)
                    <option value="{{ $module }}">{{ $module }}</option>
                @endforeach
            </select>
        </div>

        <div style="max-height: 400px; overflow-y: auto; padding-right: 5px;" class="custom-scrollbar" id="panelsList">
            @foreach($panels as $module => $categories)
                @foreach($categories as $panelsList)
                    @foreach($panelsList as $panel)
                        <div class="panel-row" data-category="{{ $module }}">
                            <input type="checkbox" class="panel-checkbox" data-url="{{ $panel->grafana_url }}" id="panel_{{ $panel->id }}">
                            <label for="panel_{{ $panel->id }}" class="panel-name" >{{ translate($panel->name) }}</label>
                        </div>
                    @endforeach
                @endforeach
            @endforeach
        </div>

        {{-- زر لإضافة جميع المحددين --}}
        <div style="margin-top: 10px; text-align: right;">
            <button class="btn btn-primary" onclick="addSelectedPanels()" id="btn" style="border-radius: 8px ;font-size: 20px;background-color: #037aeb;border: none;width: 100%;height: 40px; color: white;top:10px">{{ translate('Add Selected Panels') }}</button>
        </div>
    </div>
</div>

{{-- ===== SAVE MODAL ===== --}}
<div id="saveModal" class="save-modal1">
    <div class="modal-box1">
        <h4>{{ translate('Save Dashboard') }}</h4>
        <div class="form-group">
            <label>{{ translate('Dashboard Name') }}</label>
            <input id="dashboardName" class="form-control" placeholder="{{ translate('Enter dashboard name') }}">
        </div>
        <div class="form-group">
            <label>{{ translate('Description') }}</label>
            <textarea id="dashboardDescription" class="form-control1" placeholder="{{ translate('Enter dashboard description') }}"></textarea>
        </div>
        <div class="modal-actions">
 <button
    class="btn btn-primary"
    style="
        border-radius: 999px;
        background-color: #2563eb;
        color: #ffffff;
        font-size: 16px;
        padding: 10px 22px;
        font-weight: 600;
        cursor: pointer;
        border: none ;
    "
    onclick="confirmSave(event)">
    {{ translate('Confirm') }}
</button>


 <button
    class="btn btn-light"
    style="
        border-radius: 999px;
        background-color: #f1f5f9;
        color: #475569;
        font-size: 16px;
        padding: 10px 22px;
        font-weight: 600;
        border: 1px solid #e2e8f0;
        cursor: pointer;
    "
    onclick="closeSave()">
    {{ translate('Cancel') }}
</button>


    </div>
</div>

{{-- ===== LIBS ===== --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack-all.js"></script>

<style>
    @keyframes modalSlideUp { 
        from { transform: translateY(20px); opacity: 0; } 
        to { transform: translateY(0); opacity: 1; } 
    }
  
    .dashboard-header { display: flex; justify-content: space-between; align-items: center; padding: 12px 25px; background: #ffffff; border-radius: 12px; margin: 15px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    .header-title { display: flex; align-items: center; gap: 12px; }
    .title-icon { color: #3182ce; font-size: 1.4rem; }
    .header-title h3 { font-weight: 800; color: #1a202c; margin: 0; font-size: 1.25rem; }
    .header-actions { display: flex; gap: 12px; }
    .btn-action { display: flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 10px; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s; }
    .btn-add { background-color: #ebf8ff; color: #3182ce; }
    .btn-save { background-color: #f0fff4; color: #38a169; }

    .grid-stack-item-content { background: #fff !important; border: 1px solid #e2e8f0 !important; height: 100%; position: relative; overflow: hidden; border-radius: 12px; cursor: move; }

    .my-iframe { width: 100%; height: 100%; border: none; display: block; background: #fff; position: relative; cursor: grab; z-index: 1; }
    .panel-handle { width: 100%; height: 12px; background: rgba(0,0,0,0.05); cursor: move; position: absolute; top: 0; left: 0; border-top-left-radius: 12px; border-top-right-radius: 12px; z-index: 5; }

    .delete-btn { position: absolute; top: 8px; right: 8px; z-index: 10; background: rgba(220, 53, 69, 0.9); color: white; border: none; border-radius: 6px; width: 28px; height: 28px; opacity: 0; transition: 0.3s; cursor: pointer; display: flex; align-items: center; justify-content: center; }
    .grid-stack-item-content:hover .delete-btn { opacity: 1; }

    .panel-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f1f5f9; }
    .btnclose { border-radius: 6px; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; color: white; background-color: #f05454; border: none; cursor: pointer; }
    .panel-row:hover { background: #f1f5f9; }
    .save-modal, .save-modal1 { position: fixed; inset: 0; display: none; z-index: 9999; align-items: center; justify-content: center; transition: all 0.3s ease; }
    .save-modal { background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(8px); }
    .panel-name { font-size: 0.95rem; color: #1e293b;font-family: 'Segoe UI';color: #3182ce ;margin-right: 20px;cursor: pointer; }
    .save-modal1 {
    background: rgba(15, 23, 42, 0.55);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}
    .modal-box, .modal-box1 { background: #ffffff; padding: 30px; border-radius: 20px; width: 100%; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); animation: modalSlideUp 0.4s ease-out; }
    .modal-box { max-width: 500px; }
   .modal-box1 {
    background: linear-gradient(145deg, #ffffff, #f1f5f9);
    width: 420px;
    padding: 28px;
    border-radius: 18px;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
    animation: modalSlideUp 0.4s ease-out, scaleIn 0.35s ease;
}
#saveModal.active {
    display: flex;
}


 .modal-box h4, .modal-box1 h4 {
    font-size: 22px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 20px;
    text-align: center;
}
   .form-control,
.form-control1 {
    width: 100%;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #cbd5e1;
    font-size: 14px;
    outline: none;
    transition: all 0.25s ease;
    background: #ffffff;
}

.form-control1 {
    min-height: 90px;
    resize: none;
}

/* Focus */
.form-control:focus,
.form-control1:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

    .form-group { margin-bottom: 16px; }
    .form-group label {
    font-size: 14px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 6px;
    display: block;
}
    .modal-actions { margin-top: 25px; display: flex; gap: 12px; justify-content: center; }

    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #3182ce; border-radius: 10px; }
    #btn{
        cursor: pointer;
        border: none
    }
    /* DARK MODE */
    body.dark { background: #020617; }
    body.dark [style*="background-color: #f4f7f9"] { background-color: #020617 !important; }
    body.dark .dashboard-header { background: #020617; border-color: #1e293b; }
    body.dark .header-title h3 { color: #e5e7eb; }
    body.dark .title-icon { color: #60a5fa; }
    body.dark .btn-add { background: rgba(59,130,246,0.15); color: #60a5fa; }
    body.dark .btn-save { background: rgba(34,197,94,0.15); color: #4ade80; }
    body.dark .grid-stack-item-content { background: #020617 !important; border-color: #1e293b !important; }
    body.dark .modal-box, body.dark .modal-box1 { background: #020617; border: 1px solid #1e293b; }
    body.dark .modal-box h4, body.dark .modal-box1 h4 { color: #e5e7eb; border-color: #1e293b; }
    body.dark .form-group label { color: #cbd5e1; }
    body.dark .form-control, body.dark .form-control1 { background: #1e293b; border-color: #334155; color: #e5e7eb; }
    body.dark .panel-row { border-color: #1e293b; color: #e5e7eb; }
    body.dark .custom-scrollbar::-webkit-scrollbar-track { background: #020617; }
</style>

<script>
let grid;

document.addEventListener('DOMContentLoaded', () => {
   grid = GridStack.init({
        float: true,
        cellHeight: 100,
        margin: 15,
        disableOneColumnMode: true,
        resizable: { handles: 'se' },
        draggable: { handle: '.panel-handle' }
    });

    document.querySelectorAll('.btn-add-panel').forEach(btn => {
        btn.addEventListener('click', () => addPanel(btn.dataset.url));
    });

    @if(!empty($savedLayout))
        grid.load(@json($savedLayout));
        document.querySelectorAll('.grid-stack-item').forEach(el => setupWidget(el));
    @endif
});

function togglePanels() {
    const modal = document.getElementById('panelsSidebar');
    modal.style.display = modal.style.display === 'flex' ? 'none' : 'flex';
}

function setupWidget(el) {
    const delBtn = el.querySelector('.delete-btn');
    if (delBtn) {
        delBtn.onclick = (e) => { e.stopPropagation(); grid.removeWidget(el); };
    }
}

function addPanel(url, closeModal = true) {
    if(closeModal) togglePanels();
    
    let finalUrl = url.replace('/d/', '/d-solo/') + (url.includes('?') ? '&' : '?') + 'theme=light&kiosk=1&viewPanel=1';
    
    const content = `<div class="grid-stack-item-content">
        <div class="panel-handle"></div>
        <button class="delete-btn"><i class="fas fa-times"></i></button>
        <iframe src="${finalUrl}" class="my-iframe" scrolling="no"></iframe>
    </div>`;
    
    const el = grid.addWidget({ w: 4, h: 4, id: finalUrl, content: content });
    setupWidget(el);
}

function addSelectedPanels() {
    const checkboxes = document.querySelectorAll('.panel-checkbox:checked');
    if (!checkboxes.length) return alert('{{ translate('Select at least one panel') }}');

    checkboxes.forEach(cb => {
        addPanel(cb.dataset.url, false);
        cb.checked = false;
    });

    togglePanels();
}

function saveLayout() { 
    if (!grid.engine.nodes.length) return alert('{{ translate('Add at least one panel') }}');
    document.getElementById('saveModal').style.display = 'flex'; 
}

function closeSave() { document.getElementById('saveModal').style.display = 'none'; }

function confirmSave(event) {
    const nameInput = document.getElementById('dashboardName');
    if (!nameInput.value.trim()) return alert('{{ translate('Dashboard name is required') }}');
    
    const btn = event.target;
    btn.innerText = 'Registration...'; btn.disabled = true;

    const layoutData = grid.save(false).map(item => ({ x: item.x, y: item.y, w: item.w, h: item.h, id: item.id }));

    fetch("{{ route('dashboard.saveCustom') }}", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ name: nameInput.value, description: document.getElementById('dashboardDescription').value, layout: layoutData })
    })
    .then(r => r.ok ? location.href = "{{ route('app.home') }}" : (alert('Erreur'), btn.innerText='Confirmer', btn.disabled=false));
}

function filterPanels() {
    const input = document.getElementById('panelSearch').value.toLowerCase();
    const selectedCategory = document.getElementById('categoryFilter').value;
    const panelRows = document.querySelectorAll('#panelsList .panel-row');

    panelRows.forEach(row => {
        const name = row.querySelector('.panel-name').innerText.toLowerCase();
        const category = row.getAttribute('data-category');

        const matchesName = name.includes(input);
        const matchesCategory = selectedCategory === '' || category === selectedCategory;

        row.style.display = (matchesName && matchesCategory) ? 'flex' : 'none';
    });
}
</script>
@endsection
