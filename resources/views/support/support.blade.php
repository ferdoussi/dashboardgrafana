@extends('layouts.app')

@section('content')
<style>

/* ── Wrapper ── */
.support-wrapper {
    min-height:      80vh;
    display:         flex;
    align-items:     center;
    justify-content: center;
    padding:         28px 20px;
}

/* ── Card ── */
.support-card {
    background:    var(--bg-header);
    max-width:     480px;
    width:         100%;
    border-radius: 20px;
    padding:       44px 40px 40px;
    border:        1px solid #e5e7eb;
    box-shadow:    0 8px 32px rgba(25,112,161,0.08), 0 2px 8px rgba(0,0,0,0.04);
    text-align:    center;
    transition:    var(--transition);
}
body.dark .support-card {
    border-color: #1e293b;
    box-shadow:   0 20px 50px rgba(0,0,0,0.4);
}

/* ── Icon Header ── */
.icon-header {
    width:           68px;
    height:          68px;
    background:      linear-gradient(135deg, rgba(25,112,161,0.12), rgba(75,183,245,0.18));
    color:           var(--primary);
    border-radius:   50%;
    display:         flex;
    align-items:     center;
    justify-content: center;
    margin:          0 auto 22px;
    font-size:       30px;
    border:          2px solid rgba(25,112,161,0.15);
    animation:       float 3.5s ease-in-out infinite;
    box-shadow:      0 4px 16px rgba(25,112,161,0.15);
}
body.dark .icon-header {
    background: linear-gradient(135deg, rgba(56,189,248,0.12), rgba(56,189,248,0.06));
    border-color: rgba(56,189,248,0.2);
    box-shadow:   0 4px 16px rgba(56,189,248,0.12);
}

@keyframes float {
    0%, 100% { transform: translateY(0);    }
    50%       { transform: translateY(-9px); }
}

/* ── Titles ── */
.support-card h2 {
    color:          var(--text-main);
    font-weight:    800;
    font-size:      24px;
    margin-bottom:  8px;
    letter-spacing: -0.3px;
}

.support-card p.subtitle {
    color:         var(--text-muted);
    margin-bottom: 28px;
    font-size:     14.5px;
    line-height:   1.55;
}

/* ── Divider ── */
.support-divider {
    height:     1px;
    background: linear-gradient(to right, transparent, #e5e7eb, transparent);
    margin:     0 0 22px;
}
body.dark .support-divider {
    background: linear-gradient(to right, transparent, #1e293b, transparent);
}

/* ── Contact Options ── */
.contact-option {
    background:      var(--bg-main);
    border:          1px solid #e5e7eb;
    border-radius:   12px;
    padding:         14px 18px;
    margin-bottom:   10px;
    display:         flex;
    align-items:     center;
    gap:             14px;
    text-decoration: none;
    transition:      var(--transition);
    text-align:      left;
}
body.dark .contact-option {
    background:   #232531;
    border-color: #1e293b;
}

.contact-option:hover {
    border-color: var(--primary);
    background:   var(--primary-soft);
    transform:    translateX(4px);
    box-shadow:   0 4px 14px rgba(25,112,161,0.12);
}
body.dark .contact-option:hover {
    background: rgba(56,189,248,0.08);
}

/* Icon Box inside option */
.contact-icon {
    width:           40px;
    height:          40px;
    border-radius:   10px;
    background:      linear-gradient(135deg, #1970A1, #4bb7f5);
    display:         flex;
    align-items:     center;
    justify-content: center;
    font-size:       17px;
    flex-shrink:     0;
    box-shadow:      0 3px 10px rgba(25,112,161,0.25);
}

.contact-option .info label {
    display:        block;
    font-size:      10.5px;
    font-weight:    700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color:          var(--primary);
    margin-bottom:  3px;
}
body.dark .contact-option .info label { color: #38bdf8; }

.contact-option .info span {
    color:       var(--text-main);
    font-weight: 600;
    font-size:   14.5px;
}

/* ── Phone Button ── */
.phone-btn {
    margin-top:      22px;
    display:         inline-flex;
    align-items:     center;
    gap:             10px;
    padding:         12px 28px;
    border-radius:   999px;
    background:      linear-gradient(135deg, #1970A1, #4bb7f5);
    color:           #fff !important;
    font-weight:     700;
    font-size:       14.5px;
    text-decoration: none;
    transition:      var(--transition);
    box-shadow:      0 4px 16px rgba(25,112,161,0.32);
    letter-spacing:  0.2px;
}
.phone-btn:hover {
    transform:  translateY(-2px);
    box-shadow: 0 8px 24px rgba(25,112,161,0.42);
}

</style>

<div class="support-wrapper">
    <div class="support-card">

        <div class="icon-header">🎧</div>

        <h2>{{ translate('Service Support') }}</h2>
        <p class="subtitle">{{ translate('Need help? Our team is ready to assist you.') }}</p>

        <div class="support-divider"></div>

        <a href="mailto:support@example.com" class="contact-option">
            <div class="contact-icon">✉️</div>
            <div class="info">
                <label>{{ translate('Support Email') }}</label>
                <span>support@example.com</span>
            </div>
        </a>

        <a href="mailto:manager@example.com" class="contact-option">
            <div class="contact-icon">👤</div>
            <div class="info">
                <label>{{ translate('Manager Email') }}</label>
                <span>manager@example.com</span>
            </div>
        </a>

        <a href="tel:+212600000000" class="phone-btn">
            📞 +212 600 000 000
        </a>

    </div>
</div>
@endsection