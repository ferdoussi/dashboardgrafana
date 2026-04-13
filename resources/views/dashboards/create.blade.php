@extends('layouts.app')
<title>{{ translate('Custom Dashboard') }}</title>
@section('content')
<div style="height:90vh; position:relative; background-color: var(--bg-main); border-radius: 16px; box-shadow: 0 4px 24px rgba(25,112,161,0.08);">

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
            <h4 style="margin:0; font-size:1.1rem; border:none; text-align:left;">{{ translate('Available Panels') }}</h4>
            <button class="btnclose" onclick="togglePanels()"><i class="fas fa-times"></i></button>
        </div>

        {{-- ===== SEARCH & CATEGORY FILTER ===== --}}
        <div style="display:flex; gap:10px; margin-bottom:15px;">
            <input type="text" id="panelSearch" class="form-control" placeholder="{{ translate('Search by name...') }}" onkeyup="filterPanels()">
            <select id="categoryFilter" class="form-control" onchange="filterPanels()">
                <option value="">{{ translate('All categories') }}</option>
                @foreach($panels as $module => $categories)
                    <option value="{{ $module }}">{{ $module }}</option>
                @endforeach
            </select>
        </div>

        <div style="max-height:400px; overflow-y:auto; padding-right:5px;" class="custom-scrollbar" id="panelsList">
            @foreach($panels as $module => $categories)
                @foreach($categories as $panelsList)
                    @foreach($panelsList as $panel)
                        <div class="panel-row" data-category="{{ $module }}">
                            <input type="checkbox" class="panel-checkbox"
                                   data-url="{{ $panel->grafana_url }}"
                                   data-name="{{ $panel->name }}"
                                   id="panel_{{ $panel->id }}">
                            <label for="panel_{{ $panel->id }}" class="panel-name">{{ translate($panel->name) }}</label>
                        </div>
                    @endforeach
                @endforeach
            @endforeach
        </div>

        <div style="margin-top:14px;">
            <button class="btn-add-selected" onclick="addSelectedPanels()" id="btn">
                {{ translate('Add Selected Panels') }}
            </button>
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
            <button class="modal-btn modal-btn-confirm" onclick="confirmSave(event)">{{ translate('Confirm') }}</button>
            <button class="modal-btn modal-btn-cancel"  onclick="closeSave()">{{ translate('Cancel') }}</button>
        </div>
    </div>
</div>

{{-- ===== STATUS MODAL ===== --}}
<div id="statusModal" class="save-modal1">
    <div class="modal-box1" style="text-align:center;">
        <div id="statusIcon" style="font-size:50px; margin-bottom:15px;"></div>
        <h4 id="statusTitle"   style="margin-bottom:10px;"></h4>
        <p  id="statusMessage" style="color:#64748b; margin-bottom:20px;"></p>
        <button class="modal-btn modal-btn-confirm" onclick="closeStatusModal()">{{ translate('OK') }}</button>
    </div>
</div>

{{-- ===== LIBS ===== --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack-all.js"></script>

<style>
/* ── Animations ── */
@keyframes modalSlideUp {
    from { transform: translateY(22px); opacity: 0; }
    to   { transform: translateY(0);    opacity: 1; }
}
@keyframes backdropIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* ═══════════════════════════════
   DASHBOARD HEADER
═══════════════════════════════ */
.dashboard-header {
    display:         flex;
    justify-content: space-between;
    align-items:     center;
    padding:         14px 24px;
    background:      var(--bg-header);
    border-radius:   14px;
    margin:          15px 15px 0;
    border:          1px solid #e2e8f0;
    box-shadow:      0 2px 10px rgba(25,112,161,0.07);
    transition:      background 0.25s, border-color 0.25s;
}

.header-title { display: flex; align-items: center; gap: 12px; }

.title-icon { color: #1970A1; font-size: 1.35rem; }

.header-title h3 {
    font-weight:    800;
    color:          var(--text-main);
    margin:         0;
    font-size:      1.18rem;
    letter-spacing: -0.3px;
}

.header-actions { display: flex; gap: 10px; }

.btn-action {
    display:       flex;
    align-items:   center;
    gap:           8px;
    padding:       9px 18px;
    border-radius: 10px;
    font-weight:   600;
    font-size:     13.5px;
    border:        1px solid transparent;
    cursor:        pointer;
    transition:    all 0.22s ease;
    font-family:   var(--font-heading, 'Inter', sans-serif);
}

.btn-add  { background: rgba(25,112,161,0.10); color: #1970A1; border-color: rgba(25,112,161,0.18); }
.btn-add:hover  {
    background:   #1970A1;
    color:        #fff;
    border-color: #1970A1;
    box-shadow:   0 4px 14px rgba(25,112,161,0.3);
    transform:    translateY(-1px);
}

.btn-save { background: rgba(34,197,94,0.10); color: #16a34a; border-color: rgba(34,197,94,0.2); }
.btn-save:hover {
    background:   #16a34a;
    color:        #fff;
    border-color: #16a34a;
    box-shadow:   0 4px 14px rgba(22,163,74,0.28);
    transform:    translateY(-1px);
}

/* ═══════════════════════════════
   GRID ITEM + CUSTOM PANEL HEADER
═══════════════════════════════ */
.grid-stack-item-content {
    background:    var(--bg-header) !important;
    border:        1px solid #e2e8f0 !important;
    height:        100%;
    position:      relative;
    overflow:      hidden;
    border-radius: 14px;
    cursor:        default;
    transition:    border-color 0.2s, box-shadow 0.2s;
    box-shadow:    0 2px 8px rgba(0,0,0,0.04);
}
.grid-stack-item-content:hover {
    border-color: rgba(25,112,161,0.28) !important;
    box-shadow:   0 6px 20px rgba(25,112,161,0.09);
}

/* Panel custom header bar */
.custom-panel-header {
    display:         flex;
    justify-content: space-between;
    align-items:     center;
    padding:         0 12px;
    height:          42px;
    background:      var(--bg-header);
    border-bottom:   1px solid rgba(25,112,161,0.10);
    flex-shrink:     0;
    user-select:     none;
}

.panel-title {
    display:     flex;
    align-items: center;
    gap:         8px;
    font-weight: 700;
    font-size:   0.88rem;
    color:       var(--text-main);
    overflow:    hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.panel-title .title-icon {
    color:      #1970A1;
    font-size:  0.85rem;
    flex-shrink: 0;
}

.panel-controls {
    display:     flex;
    align-items: center;
    gap:         6px;
    flex-shrink: 0;
}

/* Drag handle inside header */
.panel-handle {
    cursor:        move;
    color:         #94a3b8;
    padding:       4px 6px;
    border-radius: 6px;
    font-size:     13px;
    transition:    color 0.18s, background 0.18s;
    display:       flex;
    align-items:   center;
}
.panel-handle:hover { color: #1970A1; background: rgba(25,112,161,0.08); }

/* Delete button inside header */
.delete-btn-custom {
    display:         flex;
    align-items:     center;
    justify-content: center;
    width:     26px;
    height:    26px;
    border-radius: 7px;
    background:  rgba(239,68,68,0.0);
    color:       #94a3b8;
    border:      1px solid transparent;
    cursor:      pointer;
    font-size:   11px;
    transition:  all 0.18s;
}
.delete-btn-custom:hover {
    background:   rgba(239,68,68,0.12);
    color:        #ef4444;
    border-color: rgba(239,68,68,0.25);
}

/* ── iframe container ── */
.iframe-container {
    position: absolute;
    top:      42px; /* height of custom-panel-header */
    left:     0;
    right:    0;
    bottom:   0;
    overflow: hidden;
}

.my-iframe {
    position: absolute;
    left:     0;
    width:    100%;
    border:   none;
    display:  block;
    background: var(--bg-header);
    cursor:   default;
    z-index:  1;
}

/*
 * Grafana: kiosk=1 يحذف الـ top bar عادةً
 * نزيدوا offset صغير كـ fallback
 */
.grafana-frame {
    top:    -38px;
    height: calc(100% + 38px);
}

/*
 * OpenSearch/Kibana: embed=true ما كيكفيش دايماً
 * كنرفعوا أكثر باش نقطعوا الـ nav + filter bar
 */
.os-frame {
    top:    -48px;
    height: calc(100% + 48px);
}

/* ═══════════════════════════════
   MODALS
═══════════════════════════════ */
.save-modal, .save-modal1 {
    position:        fixed;
    inset:           0;
    display:         none;
    z-index:         9999;
    align-items:     center;
    justify-content: center;
    animation:       backdropIn 0.25s ease;
}
.save-modal  { background: rgba(0,0,0,0.48);   backdrop-filter: blur(8px);  -webkit-backdrop-filter: blur(8px); }
.save-modal1 { background: rgba(15,23,42,0.52); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }

.modal-box, .modal-box1 {
    background:    var(--bg-header);
    border-radius: 20px;
    box-shadow:    0 30px 70px rgba(0,0,0,0.18);
    animation:     modalSlideUp 0.32s cubic-bezier(.16,1,.3,1);
    border:        1px solid #e2e8f0;
}
.modal-box  { width: 100%; max-width: 500px; padding: 28px; }
.modal-box1 { width: 420px; padding: 30px; }

.modal-box h4, .modal-box1 h4 {
    font-size:      20px;
    font-weight:    800;
    color:          var(--text-main);
    margin-bottom:  22px;
    text-align:     center;
    letter-spacing: -0.3px;
}

/* ── Form Controls ── */
.form-control, .form-control1 {
    width:         100%;
    padding:       11px 14px;
    border-radius: 10px;
    border:        1px solid #e2e8f0;
    font-size:     14px;
    outline:       none;
    background:    var(--bg-main);
    color:         var(--text-main);
    font-family:   var(--font-heading, 'Inter', sans-serif);
    transition:    border-color 0.22s, box-shadow 0.22s;
}
.form-control1 { min-height: 88px; resize: none; }
.form-control:focus, .form-control1:focus {
    border-color: #1970A1;
    box-shadow:   0 0 0 3px rgba(25,112,161,0.14);
}

.form-group { margin-bottom: 16px; }
.form-group label {
    font-size:      13px;
    font-weight:    600;
    color:          var(--text-muted);
    margin-bottom:  6px;
    display:        block;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

.modal-actions { margin-top: 24px; display: flex; gap: 10px; justify-content: center; }

/* ── Modal Buttons ── */
.modal-btn {
    padding:       10px 28px;
    border-radius: 999px;
    font-size:     14px;
    font-weight:   600;
    cursor:        pointer;
    border:        none;
    font-family:   var(--font-heading, 'Inter', sans-serif);
    transition:    all 0.22s ease;
}
.modal-btn-confirm {
    background: linear-gradient(135deg, #1970A1, #4bb7f5);
    color:      #fff;
    box-shadow: 0 4px 14px rgba(25,112,161,0.3);
}
.modal-btn-confirm:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(25,112,161,0.4); }
.modal-btn-cancel  { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
.modal-btn-cancel:hover { background: #e2e8f0; color: #1e293b; }

/* ── Add Selected Button ── */
.btn-add-selected {
    display:        block;
    width:          100%;
    padding:        12px 0;
    border-radius:  10px;
    font-size:      14px;
    font-weight:    700;
    color:          white;
    background:     linear-gradient(135deg, #1970A1, #4bb7f5);
    border:         none;
    cursor:         pointer;
    font-family:    var(--font-heading, 'Inter', sans-serif);
    transition:     all 0.22s ease;
    box-shadow:     0 4px 14px rgba(25,112,161,0.28);
    letter-spacing: 0.2px;
}
.btn-add-selected:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(25,112,161,0.38); }

/* ── Close Button ── */
.btnclose {
    border-radius: 7px;
    width:  26px; height: 26px;
    display:    flex;
    align-items:     center;
    justify-content: center;
    color:      white;
    background: #ef4444;
    border:     none;
    cursor:     pointer;
    font-size:  11px;
    transition: background 0.2s, transform 0.2s;
    flex-shrink: 0;
}
.btnclose:hover { background: #dc2626; transform: scale(1.08); }

/* ── Panel Rows ── */
.panel-row {
    display:         flex;
    justify-content: space-between;
    align-items:     center;
    padding:         10px 8px;
    border-bottom:   1px solid #f1f5f9;
    border-radius:   8px;
    transition:      background 0.18s;
    gap:             10px;
}
.panel-row:last-child { border-bottom: none; }
.panel-row:hover      { background: #f0f7ff; }

.panel-checkbox { width:16px; height:16px; accent-color:#1970A1; cursor:pointer; flex-shrink:0; }

.panel-name {
    font-size:   14px;
    font-weight: 500;
    color:       #1970A1;
    font-family: var(--font-heading, 'Inter', sans-serif);
    cursor:      pointer;
    flex:        1;
    transition:  color 0.18s;
}
.panel-row:hover .panel-name { color: #0f5a87; }

/* ── Scrollbar ── */
.custom-scrollbar::-webkit-scrollbar       { width: 5px; }
.custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #1970A1; border-radius: 10px; }

#statusIcon { font-size: 52px; margin-bottom: 14px; }

/* ═══════════════════════════════
   DARK MODE
═══════════════════════════════ */
body.dark .dashboard-header { background: var(--bg-header); border-color: #1e293b; box-shadow: 0 2px 12px rgba(0,0,0,0.3); }
body.dark .title-icon        { color: #38bdf8; }
body.dark .header-title h3   { color: #e5e7eb; }

body.dark .btn-add           { background: rgba(56,189,248,0.1); color: #38bdf8; border-color: rgba(56,189,248,0.2); }
body.dark .btn-add:hover     { background: #38bdf8; color: #020617; border-color: #38bdf8; }
body.dark .btn-save          { background: rgba(74,222,128,0.1); color: #4ade80; border-color: rgba(74,222,128,0.2); }
body.dark .btn-save:hover    { background: #4ade80; color: #020617; border-color: #4ade80; }

body.dark .grid-stack-item-content { background: #1d1f28 !important; border-color: #1e293b !important; }
body.dark .grid-stack-item-content:hover { border-color: rgba(56,189,248,0.28) !important; box-shadow: 0 6px 20px rgba(0,0,0,0.3); }

body.dark .custom-panel-header { background: #1d1f28; border-bottom-color: rgba(56,189,248,0.1); }
body.dark .panel-title         { color: #e5e7eb; }
body.dark .panel-title .title-icon { color: #38bdf8; }
body.dark .panel-handle        { color: #4a5568; }
body.dark .panel-handle:hover  { color: #38bdf8; background: rgba(56,189,248,0.08); }
body.dark .delete-btn-custom   { color: #4a5568; }
body.dark .delete-btn-custom:hover { background: rgba(239,68,68,0.12); color: #f87171; border-color: rgba(239,68,68,0.2); }

body.dark .my-iframe { background: #1d1f28; }

body.dark .modal-box, body.dark .modal-box1  { background: #1d1f28; border-color: #1e293b; box-shadow: 0 30px 70px rgba(0,0,0,0.45); }
body.dark .modal-box h4, body.dark .modal-box1 h4 { color: #e5e7eb; }
body.dark .form-group label    { color: #94a3b8; }
body.dark .form-control,
body.dark .form-control1       { background: #232531; border-color: #334155; color: #e5e7eb; }
body.dark .form-control:focus,
body.dark .form-control1:focus { border-color: #38bdf8; box-shadow: 0 0 0 3px rgba(56,189,248,0.14); }
body.dark .modal-btn-cancel    { background: #232531; color: #cbd5e1; border-color: #334155; }
body.dark .modal-btn-cancel:hover { background: #2d3748; color: #e5e7eb; }

body.dark .panel-row          { border-color: #1e293b; background: transparent; }
body.dark .panel-row:hover    { background: rgba(56,189,248,0.06); }
body.dark .panel-name         { color: #38bdf8; }
body.dark .panel-row:hover .panel-name { color: #7dd3fc; }

body.dark .custom-scrollbar::-webkit-scrollbar-track { background: #1d1f28; }
body.dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #38bdf8; }
body.dark #statusMessage { color: #94a3b8 !important; }
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
        btn.addEventListener('click', () => addPanel(btn.dataset.url, btn.dataset.name));
    });

    @if(!empty($savedLayout))
    // عوض ما نديرو grid.load مباشرة، غادي نخدمو بـ addPanel لكل عنصر
    const savedData = @json($savedLayout);
    savedData.forEach(item => {
        // كنعيطو لـ addPanel وكنعطيوها الـ URL والـ Name لي حفظنا
        // الـ id هنا هو الـ URL، والـ name هو لي زدنا في التعديل لي فوق
        addPanelFromSave(item);
    });
@endif

    (new MutationObserver(updateIframesTheme))
        .observe(document.body, { attributes: true, attributeFilter: ['class'] });
});

/* ── Theme helpers ── */
function getGrafanaTheme() {
    return document.body.classList.contains('dark') ? 'dark' : 'light';
}

function updateIframesTheme() {
    document.querySelectorAll('.my-iframe').forEach(iframe => {
        iframe.src = iframe.src.replace(/theme=(dark|light)/, 'theme=' + getGrafanaTheme());
    });
}
function addPanelFromSave(item) {
    const finalUrl = item.id; // هدا هو الـ URL لي ديجا فيه buildUrl
    const displayName = item.name || 'Monitoring Panel';
    const osPanel = isOpenSearch(finalUrl);
    const frameClass = 'my-iframe ' + (osPanel ? 'os-frame' : 'grafana-frame');

    const content = `
    <div class="grid-stack-item-content">
        <div class="custom-panel-header">
            <div class="panel-title">
                <i class="fas fa-chart-bar title-icon"></i>
                <span>${displayName}</span>
            </div>
            <div class="panel-controls">
                <div class="panel-handle" title="Drag"><i class="fas fa-grip-vertical"></i></div>
                <button class="delete-btn-custom" title="Remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="iframe-container">
            <iframe src="${finalUrl}" class="${frameClass}" scrolling="no"></iframe>
        </div>
    </div>`;

    const el = grid.addWidget({ 
        x: item.x, y: item.y, w: item.w, h: item.h, 
        id: finalUrl, 
        content: content 
    });
    setupWidget(el);
}
/* ── Detect source & build final URL ── */
function isOpenSearch(url) {
    return url.includes('opensearch') || url.includes('kibana') || url.includes('/_dashboards');
}

function buildUrl(url) {
    const theme = getGrafanaTheme();
    const sep   = url.includes('?') ? '&' : '?';

    if (isOpenSearch(url)) {
        // embed=true   → يخبي الـ top nav bar
        // hide-filter-bar=true → يخبي الـ filter bar
        const base = url.includes('embed=true') ? url : url.replace('app/visualize?', 'app/visualize?embed=true&');
        return base + (base.includes('?') ? '&' : '?') + 'hide-filter-bar=true';
    }

    // Grafana: /d-solo/ + kiosk=1 = panel-only view بلا header
    return url.replace('/d/', '/d-solo/')
        + sep
        + 'theme=' + theme
        + '&kiosk=1'
        + '&viewPanel=1'
        + '&hideControls=true';
}

/* ── Add Panel ── */
function addPanel(url, name = '', closeModal = true) {
    if (closeModal) togglePanels();

    const finalUrl    = buildUrl(url);
    const osPanel     = isOpenSearch(url);
    const frameClass  = 'my-iframe ' + (osPanel ? 'os-frame' : 'grafana-frame');
    const displayName = name || 'Panel';

    const content = `
    <div class="grid-stack-item-content">
        <div class="custom-panel-header">
            <div class="panel-title">
                <i class="fas fa-chart-bar title-icon"></i>
                <span>${displayName}</span>
            </div>
            <div class="panel-controls">
                <div class="panel-handle" title="Drag"><i class="fas fa-grip-vertical"></i></div>
                <button class="delete-btn-custom" title="Remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="iframe-container">
            <iframe src="${finalUrl}" class="${frameClass}" scrolling="no"></iframe>
        </div>
    </div>`;

    const el = grid.addWidget({ w: 4, h: 4, id: finalUrl, content: content });
    setupWidget(el);
}

/* ── Widget helpers ── */
function togglePanels() {
    const modal = document.getElementById('panelsSidebar');
    modal.style.display = modal.style.display === 'flex' ? 'none' : 'flex';
}

function setupWidget(el) {
    const delBtn = el.querySelector('.delete-btn-custom');
    if (delBtn) {
        delBtn.onclick = (e) => { e.stopPropagation(); grid.removeWidget(el); };
    }
}

/* FIX: pass both url AND name */
function addSelectedPanels() {
    const checkboxes = document.querySelectorAll('.panel-checkbox:checked');
    if (!checkboxes.length) {
        showStatus('{{ translate("Selection") }}', '{{ translate("Please select at least one panel") }}', false);
        return;
    }
    checkboxes.forEach(cb => {
        addPanel(cb.dataset.url, cb.dataset.name || '', false);
        cb.checked = false;
    });
    togglePanels();
}

/* ── Save Modal ── */
function saveLayout() {
    if (!grid.engine.nodes.length) {
        showStatus('{{ translate("Empty") }}', '{{ translate("Add at least one panel before saving") }}', false);
        return;
    }
    document.getElementById('saveModal').style.display = 'flex';
}

function closeSave() { document.getElementById('saveModal').style.display = 'none'; }

function confirmSave(event) {
    const nameInput = document.getElementById('dashboardName');
    if (!nameInput.value.trim()) {
        showStatus('{{ translate("Required") }}', '{{ translate("Dashboard name is required") }}', false);
        return;
    }

    const btn = event.target;
    btn.innerText = '{{ translate("Saving...") }}';
    btn.disabled = true;

    // تعديل هنا: كنجمعو البيانات وكنزيدو ليها الـ name يدوياً
    const layoutData = grid.getGridItems().map(el => {
        const node = el.gridstackNode;
        // كنقلبو على السمية وسط الـ span لي كاين في الـ header
        const panelTitle = el.querySelector('.panel-title span').innerText;
        return {
            x: node.x,
            y: node.y,
            w: node.w,
            h: node.h,
            id: node.id, // هذا هو الـ URL
            name: panelTitle // كنحفظو السمية هنا باش متطلعش false
        };
    });

    fetch("{{ route('dashboard.saveCustom') }}", {
        method:  'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body:    JSON.stringify({
            name:        nameInput.value,
            description: document.getElementById('dashboardDescription').value,
            layout:      layoutData
        })
    })
    .then(r => {
        if (r.ok) {
            closeSave();
            showStatus('{{ translate("Success") }}', '{{ translate("Dashboard saved successfully!") }}', true);
        } else {
            throw new Error();
        }
    })
    .catch(() => {
        showStatus('{{ translate("Error") }}', '{{ translate("Failed to save. Try again.") }}', false);
        btn.innerText = '{{ translate("Confirm") }}';
        btn.disabled  = false;
    });
}

/* ── Filter ── */
function filterPanels() {
    const input    = document.getElementById('panelSearch').value.toLowerCase();
    const category = document.getElementById('categoryFilter').value;

    document.querySelectorAll('#panelsList .panel-row').forEach(row => {
        const name = row.querySelector('.panel-name').innerText.toLowerCase();
        const cat  = row.getAttribute('data-category');
        row.style.display =
            (name.includes(input) && (category === '' || cat === category)) ? 'flex' : 'none';
    });
}

/* ── Status Modal ── */
function showStatus(title, message, isSuccess) {
    document.getElementById('statusTitle').innerText   = title;
    document.getElementById('statusMessage').innerText = message;
    document.getElementById('statusIcon').innerHTML    = isSuccess
        ? '<i class="fas fa-check-circle"       style="color:#22c55e;"></i>'
        : '<i class="fas fa-exclamation-circle" style="color:#ef4444;"></i>';

    document.getElementById('statusModal').style.display = 'flex';
    if (isSuccess) setTimeout(() => { location.href = "{{ route('app.home') }}"; }, 2000);
}

function closeStatusModal() {
    document.getElementById('statusModal').style.display = 'none';
}
</script>
@endsection