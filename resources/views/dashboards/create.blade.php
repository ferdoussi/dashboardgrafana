@extends('layouts.app')

@section('content')
<div style="height:90vh;position:relative; background-color: #f4f7f9;border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">

    {{-- ===== TOP BAR ===== --}}
    <div class="dashboard-header">
    <div class="header-title">
        <i class="fas fa-chart-line title-icon"></i>
        <h3>Custom Monitoring Dashboard</h3>
    </div>

    <div class="header-actions">
        <button class="btn-action btn-add" onclick="togglePanels()">
            <i class="fas fa-plus-circle"></i> 
            <span>Ajouter un Panel</span>
        </button>

        <button class="btn-action btn-save" onclick="saveLayout()">
            <i class="fas fa-save"></i> 
            <span>Enregistrer</span>
        </button>
    </div>
</div>

    {{-- ===== GRID ===== --}}
    <div style="padding:15px; height: calc(90vh - 80px); overflow-y: auto;">
        <div class="grid-stack"></div>
    </div>
</div>

{{-- ===== SIDEBAR ===== --}}
<div id="panelsSidebar" class="panels-sidebar">
    <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:2px solid #007bff; padding-bottom:10px; margin-bottom:20px;">
        <h4 style="margin:0; font-weight: bold;">Panels Disponibles</h4>
        <button class="btnclose btn-sm" onclick="togglePanels()"><i class="fas fa-times"></i></button>
    </div>

    @foreach($panels as $module => $categories)

        @foreach($categories as $panelsList)
            @foreach($panelsList as $panel)
                <div class="panel-row">
                    <span style="font-size: 0.9rem; font-weight: 500;">{{ $panel->name }}</span>
                    <button class="btnadd btn-sm btn-add-panel" data-url="{{ $panel->grafana_url }}">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            @endforeach
        @endforeach
    @endforeach
</div>

<div id="overlay" onclick="togglePanels()"></div>

{{-- ===== SAVE MODAL ===== --}}
<div id="saveModal" class="save-modal">
    <div class="modal-box">
        <h4 style="font-weight: bold;">Enregistrer le Dashboard</h4>
        <div class="form-group mt-3">
            <label style="font-weight: 600;">Nom du Dashboard</label>
            <input id="dashboardName" class="form-control" placeholder="Ex: Monitoring Reseau">
        </div>
        <div class="form-group mt-3">
            <label style="font-weight: 600;">Description</label>
            <textarea id="dashboardDescription" class="form-control" placeholder="Détails..."></textarea>
        </div>
        <div class="modal-actions">
            <button class="btn btn-primary" style="border-radius: 8px;" onclick="confirmSave(event)">Confirmer</button>
            <button class="btn btn-light" style="border-radius: 8px;" onclick="closeSave()">Annuler</button>
        </div>
    </div>
</div>

{{-- ===== LIBS ===== --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/gridstack@10.0.0/dist/gridstack-all.js"></script>

<style>
    /* dark mode styles */
    /* ===============================
   DARK MODE – CUSTOM DASHBOARD
================================ */

body.dark {
    background: #020617;
}

/* Wrapper */
body.dark [style*="background-color: #f4f7f9"] {
    background-color: #020617 !important;
}

/* ================= HEADER ================= */

body.dark .dashboard-header {
    background: #020617;
    border-color: #1e293b;
    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
}

body.dark .header-title h3 {
    color: #e5e7eb;
}

body.dark .title-icon {
    color: #60a5fa;
}

/* Buttons */
body.dark .btn-add {
    background: rgba(59,130,246,0.15);
    color: #60a5fa;
}

body.dark .btn-add:hover {
    background: #3b82f6;
    color: white;
}

body.dark .btn-save {
    background: rgba(34,197,94,0.15);
    color: #4ade80;
}

body.dark .btn-save:hover {
    background: #22c55e;
    color: #020617;
}

/* ================= GRID ================= */

body.dark .grid-stack-item-content {
    background: #020617 !important;
    border-color: #1e293b !important;
    box-shadow: 0 10px 25px rgba(0,0,0,0.8);
}

/* iframe stays clean */
body.dark .my-iframe {
    background: #020617;
}

/* Delete button */
body.dark .delete-btn {
    background: rgba(239,68,68,0.9);
}

/* ================= SIDEBAR ================= */

body.dark .panels-sidebar {
    background: #020617;
    box-shadow: 8px 0 30px rgba(0,0,0,0.8);
}

body.dark .panels-sidebar h4 {
    color: #e5e7eb;
}

body.dark .panel-row {
    border-color: #1e293b;
    color: #e5e7eb;
}

body.dark .panel-row span {
    color: #cbd5f5;
}

/* Scrollbar */
body.dark .panels-sidebar::-webkit-scrollbar-track {
    background: #020617;
}
body.dark .panels-sidebar::-webkit-scrollbar-thumb {
    background: #334155;
}

/* ================= MODAL ================= */

body.dark .save-modal {
    background: rgba(0,0,0,0.75);
}

body.dark .modal-box {
    background: #020617;
    border-color: #1e293b;
}

body.dark .modal-box h4 {
    color: #e5e7eb;
    border-color: #1e293b;
}

body.dark .form-group label {
    color: #cbd5e1;
}

body.dark .modal-box .form-control {
    background: #020617;
    border-color: #1e293b;
    color: #e5e7eb;
}

body.dark .modal-box .form-control::placeholder {
    color: #64748b;
}

body.dark .modal-box .form-control:focus {
    background: #020617;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.25);
}

/* Modal buttons */
body.dark .modal-actions .btn-primary {
    background: #3b82f6;
}

body.dark .modal-actions .btn-light {
    background: #1e293b;
    color: #e5e7eb;
}

body.dark .modal-actions .btn-light:hover {
    background: #334155;
}

    /* Container الأساسي */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 25px;
    background: #ffffff;
    border-radius: 12px;
    margin: 15px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
}

/* جهة العنوان */
.header-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.title-icon {
    color: #3182ce;
    font-size: 1.4rem;
}

.header-title h3 {
    font-weight: 800;
    color: #1a202c;
    margin: 0;
    letter-spacing: -0.5px;
    font-size: 1.25rem;
}

/* جهة الأزرار */
.header-actions {
    display: flex;
    gap: 12px;
}

/* ستايل الأزرار الموحد */
.btn-action {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

/* زر الإضافة */
.btn-add {
    background-color: #ebf8ff;
    color: #3182ce;
}

.btn-add:hover {
    background-color: #3182ce;
    color: #ffffff;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(49, 130, 206, 0.2);
}

/* زر الحفظ */
.btn-save {
    background-color: #f0fff4;
    color: #38a169;
}

.btn-save:hover {
    background-color: #38a169;
    color: #ffffff;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(56, 161, 105, 0.2);
}

/* تأثير عند الضغط */
.btn-action:active {
    transform: translateY(0);
}
/* GRID CONTAINER */
.grid-stack {
    min-height: 600px;
}

.grid-stack-item-content {
    background: #fff !important; /* خلفية بيضاء عوض الأسود */
    border: 1px solid #e2e8f0 !important; /* حدود خفيفة */
    height: 100%;
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    cursor: move;
}

/* Style button add and close */
.btnadd {
    border-radius: 6px;
    width: 24px;
    height: 24px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    background-color: #5e80f0;
    border: none;
    cursor: pointer;
}
.btnclose {
    border-radius: 6px;
    width: 24px;
    height: 24px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    background-color: #f05454;
    border: none;
    cursor: pointer;
}

/* الطبقة الشفافة التي تسمح بسحب البانيل بالكامل */
.drag-overlay {
    position: absolute;
    inset: 0;
    z-index: 5;
    background: transparent;
}

.my-iframe {
    width: 100%;
    height: 100%;
    border: none;
    display: block;
    background: #fff;
}

/* منع الـ iframe من سرقة الماوس وقت التحريك */
.grid-stack-item.ui-draggable-dragging iframe,
.grid-stack-item.grid-stack-moving iframe {
    pointer-events: none !important;
}

/* زر الحذف */
.delete-btn {
    position: absolute;
    top: 8px;
    right: 8px;
    z-index: 10;
    background: rgba(220, 53, 69, 0.9);
    color: white;
    border: none;
    border-radius: 6px;
    width: 28px;
    height: 28px;
    opacity: 0;
    transition: 0.3s;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.grid-stack-item-content:hover .delete-btn {
    opacity: 1;
}

/* SIDEBAR & RED SCROLLBAR */
.panels-sidebar { 
    position: fixed; top: 0; left: -320px; width: 300px; height: 100vh; 
    background: #fff; padding: 20px; transition: .3s; z-index: 1001; 
    overflow-y: auto;
    box-shadow: 4px 0 10px rgba(0,0,0,0.1);
}
.panels-sidebar.open { left: 0; }

/* تخصيص السكرول بار باللون الأحمر */
.panels-sidebar::-webkit-scrollbar { width: 6px; }
.panels-sidebar::-webkit-scrollbar-track { background: #f1f1f1; }
.panels-sidebar::-webkit-scrollbar-thumb { background: red; border-radius: 10px; }
.panels-sidebar { scrollbar-width: thin; scrollbar-color: rgb(0, 149, 255) #f1f1f1; }

.module-title { background: #f8fafc; color: #475569; padding: 8px 12px; border-radius: 8px; font-weight: bold; margin-top: 15px; font-size: 0.8rem; }
.panel-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f1f5f9; }

/* MODAL */
.save-modal {
    position: fixed; inset: 0; display: none; background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(4px); z-index: 3000; align-items: center; justify-content: center;
}
.modal-box {
    background: #fff; padding: 30px; border-radius: 20px; width: 450px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}
/* الخلفية اللي كتغطي الشاشة كاملة */
.save-modal {
    position: fixed;
    inset: 0;
    display: none; /* كيولي flex بـ JS */
    background: rgba(0, 0, 0, 0.5); /* ضل شفاف */
    backdrop-filter: blur(8px); /* تأثير الضباب على الخلفية */
    z-index: 9999;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

/* الصندوق الأبيض (الوسط) */
.modal-box {
    background: #ffffff;
    padding: 30px;
    border-radius: 20px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    border: 1px solid rgba(255, 255, 255, 0.3);
    animation: modalSlideUp 0.4s ease-out; /* أنيماسيون خفيفة */
}

/* الأنيماسيون ديال الطلوع */
@keyframes modalSlideUp {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* العناوين */
.modal-box h4 {
    margin-bottom: 25px;
    color: #1a202c;
    font-size: 1.5rem;
    text-align: center;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 15px;
}

/* الـ Labels */
.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #4a5568;
    font-size: 0.9rem;
}

/* الـ Inputs و الـ Textarea */
.modal-box .form-control {
    width: 100%;
    border: 2px solid #edf2f7;
    border-radius: 12px;
    padding: 12px 15px;
    font-size: 0.95rem;
    transition: all 0.2s;
    background: #f8fafc;
    margin-bottom: 15px;
}

.modal-box .form-control:focus {
    outline: none;
    border-color: #3182ce;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(66, 153, 225, 0.1);
}

/* الأزرار (Actions) */
.modal-actions {
    margin-top: 25px;
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}

.modal-actions .btn {
    padding: 10px 24px;
    font-weight: 600;
    transition: all 0.2s;
}

.modal-actions .btn-primary {
    background: #3182ce;
    border: none;
    box-shadow: 0 4px 6px rgba(49, 130, 206, 0.2);
}

.modal-actions .btn-primary:hover {
    background: #2b6cb0;
    transform: translateY(-1px);
}

.modal-actions .btn-light {
    background: #edf2f7;
    color: #4a5568;
    border: none;
}

.modal-actions .btn-light:hover {
    background: #e2e8f0;
}
</style>

<script>
let grid;

document.addEventListener('DOMContentLoaded', () => {
    grid = GridStack.init({
        float: true,
        cellHeight: 100,
        margin: 15, // إضافة المارجن الذي طلبته سابقاً
        disableOneColumnMode: true,
        resizable: { handles: 'se' }
    });

    document.querySelectorAll('.btn-add-panel').forEach(btn => {
        btn.addEventListener('click', () => addPanel(btn.dataset.url));
    });

    @if(!empty($savedLayout))
        // تحميل البيانات السابقة مع التأكد من وجود الـ id
        grid.load(@json($savedLayout));
        document.querySelectorAll('.grid-stack-item').forEach(el => setupWidget(el));
    @endif
});

function togglePanels() {
    document.getElementById('panelsSidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('show');
}

function setupWidget(el) {
    const delBtn = el.querySelector('.delete-btn');
    if (delBtn) {
        delBtn.onclick = (e) => {
            e.stopPropagation();
            grid.removeWidget(el);
        };
    }
}

function addPanel(url) {
    togglePanels();

    let finalUrl = url.replace('/d/', '/d-solo/');
    if (finalUrl.includes('theme=dark')) {
        finalUrl = finalUrl.replace('theme=dark', 'theme=light');
    } else if (!finalUrl.includes('theme=')) {
        finalUrl += (finalUrl.includes('?') ? '&' : '?') + 'theme=light';
    }
    finalUrl += '&kiosk=1&viewPanel=1';

    const content = `
        <div class="grid-stack-item-content">
            <div class="drag-overlay"></div>
            <button class="delete-btn" title="Supprimer">
                <i class="fas fa-times"></i>
            </button>
            <iframe src="${finalUrl}" class="my-iframe" scrolling="no"></iframe>
        </div>
    `;

    // المهم هنا: إضافة الرابط كـ id للـ widget ليتم حفظه
    const el = grid.addWidget({ 
        w: 4, 
        h: 4, 
        id: finalUrl, // تخزين الرابط هنا ليتمكن grid.save من التقاطه
        content: content 
    });
    setupWidget(el);
}

function saveLayout() {
    if (!grid.engine.nodes.length) return alert('Ajoutez au moins un panel');
    document.getElementById('saveModal').style.display = 'flex';
}

function closeSave() { document.getElementById('saveModal').style.display = 'none'; }

function confirmSave(event) {
    const nameInput = document.getElementById('dashboardName');
    const descInput = document.getElementById('dashboardDescription');

    if (!nameInput.value.trim()) return alert('Nom obligatoire');

    const btn = event.target;
    btn.innerText = 'Enregistrement...';
    btn.disabled = true;

    // تعديل الحفظ: نستخدم true أو نقوم بتمرير الـ id يدوياً
    const layoutData = grid.save(false).map(item => {
        return {
            x: item.x,
            y: item.y,
            w: item.w,
            h: item.h,
            id: item.id // هذا سيعيد الرابط (finalUrl) الذي وضعناه في الـ addWidget
        }; 
    });
// send data to server
    fetch("{{ route('dashboard.saveCustom') }}", {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': '{{ csrf_token() }}' 
        },
        body: JSON.stringify({
            name: nameInput.value,
            description: descInput.value,
            layout: layoutData
        })
    })
    .then(r => {
        if (r.ok) location.href = "{{ route('app.home') }}";
        else {
            alert('Erreur lors de l\'enregistrement');
            btn.innerText = 'Confirmer';
            btn.disabled = false;
        }
    });
}
</script>
@endsection