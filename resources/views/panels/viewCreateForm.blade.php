@extends('layouts.app')

@section('content')
<style>
/* ── Wrapper ── */
.panel-create-wrapper {
    max-width:  80%;
    margin:     0 auto;
    padding:    28px 24px;
}

.panel-create-wrapper h2 {
    font-size:      22px;
    font-weight:    800;
    color:          var(--text-main);
    margin:         0 0 24px;
    letter-spacing: -0.3px;
}

/* ── Card ── */
.create-card {
    background:    var(--bg-header);
    border-radius: 18px;
    border:        1px solid #e5e7eb;
    padding:       28px;
    box-shadow:    0 2px 14px rgba(25,112,161,0.07), 0 1px 3px rgba(0,0,0,0.04);
    transition:    background var(--transition), border-color var(--transition);
}
body.dark .create-card {
    background:   #1d1f28;
    border-color: #1e293b;
    box-shadow:   0 4px 24px rgba(0,0,0,0.35);
}

/* ── Form Group ── */
.form-group-modern {
    margin-bottom:  20px;
    display:        flex;
    flex-direction: column;
    gap:            7px;
}
.form-group-modern label {
    font-size:      12px;
    font-weight:    700;
    text-transform: uppercase;
    letter-spacing: 0.45px;
    color:          var(--text-muted);
}

/* ── Inputs ── */
.input-modern {
    width:         100%;
    padding:       11px 14px;
    border-radius: 10px;
    border:        1px solid #e2e8f0;
    font-size:     14px;
    font-family:   var(--font-heading);
    color:         var(--text-main);
    background:    var(--bg-main);
    outline:       none;
    transition:    border-color 0.22s, box-shadow 0.22s;
}
.input-modern::placeholder { color: #9ca3af; }
.input-modern:focus {
    border-color: var(--primary);
    box-shadow:   0 0 0 3px var(--primary-soft);
}
body.dark .input-modern {
    background:   #232531;
    color:        #e5e7eb;
    border-color: #334155;
}
body.dark .input-modern::placeholder { color: #64748b; }
body.dark .input-modern:focus {
    border-color: var(--primary);
    box-shadow:   0 0 0 3px var(--primary-soft);
}

/* ── Checkbox Row ── */
.checkbox-group {
    display:       flex;
    align-items:   center;
    gap:           10px;
    margin-bottom: 24px;
    padding:       14px 16px;
    border-radius: 10px;
    border:        1px solid #e2e8f0;
    background:    var(--bg-main);
    cursor:        pointer;
    transition:    border-color 0.22s, background 0.22s;
}
.checkbox-group:hover         { border-color: var(--primary); background: var(--primary-soft); }
body.dark .checkbox-group     { background: #232531; border-color: #334155; }
body.dark .checkbox-group:hover { border-color: var(--primary); background: var(--primary-soft); }

.checkbox-group input[type="checkbox"] {
    width: 18px; height: 18px;
    accent-color: var(--primary);
    cursor: pointer; flex-shrink: 0;
}
.checkbox-group label {
    font-size: 14px; font-weight: 600;
    color: var(--text-main); cursor: pointer;
    margin: 0; user-select: none;
}

/* ── Divider ── */
.form-divider {
    border: none; height: 1px;
    background: linear-gradient(to right, transparent, #e5e7eb, transparent);
    margin: 8px 0 24px;
}
body.dark .form-divider {
    background: linear-gradient(to right, transparent, #1e293b, transparent);
}

/* ── Submit Button ── */
.btn-create {
    display:       inline-flex;
    align-items:   center;
    gap:           8px;
    background:    linear-gradient(135deg, #1970A1, #4bb7f5);
    color:         #fff;
    padding:       11px 26px;
    border-radius: 10px;
    border:        none;
    font-weight:   700;
    font-size:     14px;
    font-family:   var(--font-heading);
    cursor:        pointer;
    box-shadow:    0 4px 14px rgba(25,112,161,0.28);
    transition:    var(--transition);
}
.btn-create:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(25,112,161,0.38); }

/* ══════════════════════════════
   SUCCESS MODAL
══════════════════════════════ */
.success-modal-overlay {
    position:        fixed;
    inset:           0;
    background:      rgba(15,23,42,0.5);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    display:         flex;
    align-items:     center;
    justify-content: center;
    z-index:         9999;
    animation:       backdropIn 0.25s ease;
}
@keyframes backdropIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

.success-modal-box {
    background:    var(--bg-header);
    border-radius: 22px;
    border:        1px solid #e5e7eb;
    padding:       40px 36px;
    width:         100%;
    max-width:     400px;
    text-align:    center;
    box-shadow:    0 30px 70px rgba(0,0,0,0.18);
    animation:     modalPop 0.35s cubic-bezier(.16,1,.3,1);
}
body.dark .success-modal-box {
    background:   #1d1f28;
    border-color: #1e293b;
    box-shadow:   0 30px 70px rgba(0,0,0,0.5);
}
@keyframes modalPop {
    from { opacity: 0; transform: scale(0.88) translateY(20px); }
    to   { opacity: 1; transform: scale(1)    translateY(0); }
}

/* Checkmark circle */
.success-icon-circle {
    width:           72px;
    height:          72px;
    border-radius:   50%;
    background:      linear-gradient(135deg, #22c55e, #4ade80);
    display:         flex;
    align-items:     center;
    justify-content: center;
    margin:          0 auto 22px;
    box-shadow:      0 8px 24px rgba(34,197,94,0.35);
    animation:       iconBounce 0.5s cubic-bezier(.36,1.56,.64,1) 0.2s both;
}
@keyframes iconBounce {
    from { transform: scale(0); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
}
.success-icon-circle i {
    font-size: 32px;
    color:     #fff;
}

.success-modal-box h3 {
    font-size:      20px;
    font-weight:    800;
    color:          var(--text-main);
    margin:         0 0 8px;
    letter-spacing: -0.3px;
}
.success-modal-box p {
    font-size:   14px;
    color:       var(--text-muted);
    margin:      0 0 28px;
    line-height: 1.5;
}

.success-modal-actions {
    display:         flex;
    gap:             10px;
    justify-content: center;
}

.btn-success-ok {
    background:    linear-gradient(135deg, #1970A1, #4bb7f5);
    color:         #fff;
    padding:       10px 28px;
    border-radius: 10px;
    border:        none;
    font-weight:   700;
    font-size:     14px;
    font-family:   var(--font-heading);
    cursor:        pointer;
    box-shadow:    0 4px 14px rgba(25,112,161,0.3);
    transition:    var(--transition);
}
.btn-success-ok:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(25,112,161,0.4); }

.btn-success-new {
    background:    var(--bg-main);
    color:         var(--text-muted);
    padding:       10px 22px;
    border-radius: 10px;
    border:        1px solid #e2e8f0;
    font-weight:   600;
    font-size:     14px;
    font-family:   var(--font-heading);
    cursor:        pointer;
    transition:    var(--transition);
}
.btn-success-new:hover { background: var(--primary-soft); color: var(--primary); border-color: var(--primary); }
body.dark .btn-success-new { background: #232531; border-color: #334155; }
body.dark .btn-success-new:hover { background: var(--primary-soft); }
</style>

<div class="panel-create-wrapper">
    <h2>{{ translate('Add New Widget') }}</h2>

    <div class="create-card">
        <form action="{{ route('panels.createPanel') }}" method="POST" id="createPanelForm">
            @csrf

            {{-- Widget Name --}}
            <div class="form-group-modern">
                <label for="name">{{ translate('Widget Name') }}</label>
                <input type="text"
                       id="name"
                       name="name"
                       class="input-modern"
                       placeholder="Enter widget name"
                       required>
            </div>

            {{-- Module --}}
            <div class="form-group-modern">
                <label for="module">{{ translate('Module') }}</label>
                <input type="text"
                       id="module"
                       name="module"
                       class="input-modern"
                       placeholder="Enter module name"
                       required>
            </div>

            {{-- Widget URL --}}
            <div class="form-group-modern">
                <label for="grafana_url">{{ translate('Widget URL') }}</label>
                <input type="url"
                       id="grafana_url"
                       name="grafana_url"
                       class="input-modern"
                       placeholder="https://Widget.example.com/d/..."
                       required>
            </div>

            <hr class="form-divider">

            {{-- Active --}}
            <div class="checkbox-group" onclick="this.querySelector('input').click(); return false;">
                <input type="checkbox" name="active" value="1" checked id="active" onclick="event.stopPropagation()">
                <label for="active">{{ translate('Active') }}</label>
            </div>

            <button type="button" class="btn-create" onclick="submitPanelForm()">
                <i class='bx bx-plus-circle'></i>
                {{ translate('Create Panel') }}
            </button>
        </form>
    </div>
</div>

{{-- ══ SUCCESS MODAL ══ --}}
@if(session('success'))
<div class="success-modal-overlay" id="successModal">
    <div class="success-modal-box">
        <div class="success-icon-circle">
            <i class='bx bx-check'></i>
        </div>
        <h3>{{ translate('Panel Created!') }}</h3>
        <p>{{ session('success') }}</p>
        <div class="success-modal-actions">
            <button class="btn-success-new" onclick="closeSuccessModal()">
                <i class='bx bx-plus'></i> {{ translate('Add Another') }}
            </button>
            <button class="btn-success-ok" onclick="window.location.href='{{ route('app.home') }}'">
                <i class='bx bx-home'></i> {{ translate('Go Home') }}
            </button>
        </div>
    </div>
</div>
@endif

<script>
/* ── Submit form ── */
function submitPanelForm() {
    const form = document.getElementById('createPanelForm');
    if (form.checkValidity()) {
        form.submit();
    } else {
        form.reportValidity();
    }
}

/* ── Close success modal ── */
function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    if (modal) {
        modal.style.opacity    = '0';
        modal.style.transition = 'opacity 0.3s ease';
        setTimeout(() => modal.remove(), 300);
    }
}

/* ── Close on backdrop click ── */
const successModal = document.getElementById('successModal');
if (successModal) {
    successModal.addEventListener('click', function(e) {
        if (e.target === this) closeSuccessModal();
    });
}
</script>
@endsection