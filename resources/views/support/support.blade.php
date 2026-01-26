@extends('layouts.app')

@section('content')
<style>
    /* Integration m3a l-variables dyalek */
    .support-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .support-card {
        background: var(--bg-header); /* t-it-badal m3a light/dark */
        max-width: 480px;
        width: 100%;
        border-radius: var(--radius);
        padding: 40px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        text-align: center;
        transition: var(--transition);
    }

    /* Dark Mode specific tweaks */
    body.dark .support-card {
        border-color: #1e293b;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .icon-header {
        width: 70px;
        height: 70px;
        background: var(--primary-soft);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 30px;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .support-card h2 {
        color: var(--text-main);
        font-weight: 700;
        font-size: 26px;
        margin-bottom: 10px;
    }

    .support-card p.subtitle {
        color: var(--text-muted);
        margin-bottom: 30px;
        font-size: 15px;
    }

    .contact-option {
        background: var(--bg-main);
        border: 1px solid transparent;
        border-radius: var(--radius);
        padding: 15px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
        transition: var(--transition);
        text-align: left;
    }

    .contact-option:hover {
        border-color: var(--primary);
        transform: scale(1.02);
    }

    .contact-option .info label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--primary);
        margin-bottom: 2px;
    }

    .contact-option .info span {
        color: var(--text-main);
        font-weight: 600;
        font-size: 15px;
    }

    .phone-btn {
        margin-top: 25px;
        background: var(--primary);
        color: #fff !important;
        padding: 12px 25px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }

    .phone-btn:hover {
        opacity: 0.9;
        box-shadow: 0 5px 15px var(--primary-soft);
    }
</style>

<div class="support-wrapper">
    <div class="support-card">
        <div class="icon-header">
            🎧
        </div>
        <h2>Service Support</h2>
        <p class="subtitle">Besoin d'aide ? Notre équipe est prête à vous répondre.</p>

        <a href="mailto:support@example.com" class="contact-option">
            <div class="info">
                <label>Soutien Public</label>
                <span>support@example.com</span>
            </div>
        </a>

        <a href="mailto:manager@example.com" class="contact-option">
            <div class="info">
                <label>Le Responsable</label>
                <span>manager@example.com</span>
            </div>
        </a>

        <a href="tel:+212600000000" class="phone-btn">
            📞 +212 600 000 000
        </a>
    </div>
</div>
@endsection

