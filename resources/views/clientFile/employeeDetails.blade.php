@extends('layouts.app')

@section('content')
<style>

/* ── Page wrapper ── */
.show-wrapper {
    padding:    28px 24px;
    max-width:  100%;
    margin:     0 auto;
}

/* ── Profile Card ── */
.profile-card {
    background:    var(--bg-header);
    border-radius: 20px;
    border:        1px solid #e5e7eb;
    overflow:      hidden;
    box-shadow:    0 4px 20px rgba(25,112,161,0.07), 0 1px 4px rgba(0,0,0,0.04);
    transition:    background var(--transition), border-color var(--transition), box-shadow var(--transition);
}
body.dark .profile-card {
    background:   #1d1f28;
    border-color: #1e293b;
    box-shadow:   0 8px 32px rgba(0,0,0,0.4);
}

/* ── Profile Header ── */
.profile-header {
    display:         flex;
    justify-content: space-between;
    align-items:     center;
    flex-wrap:       wrap;
    gap:             20px;
    padding:         28px 30px;
    background:      linear-gradient(135deg, rgba(25,112,161,0.06) 0%, rgba(75,183,245,0.04) 100%);
    border-bottom:   1px solid #e5e7eb;
}
body.dark .profile-header {
    background:   linear-gradient(135deg, rgba(56,189,248,0.06) 0%, rgba(56,189,248,0.02) 100%);
    border-color: #1e293b;
}

.profile-identity {
    display:     flex;
    align-items: center;
    gap:         18px;
}

/* ── Avatar ── */
.avatar-wrapper { position: relative; flex-shrink: 0; }

.avatar-large {
    width:         120px;
    height:        120px;
    border-radius: 50%;
    object-fit:    cover;
    border:        5px solid var(--bg-header);
    box-shadow:    0 6px 22px rgba(25,112,161,0.22);
    display:       block;
}
body.dark .avatar-large { border-color: #1d1f28; }

.avatar-status-dot {
    position:      absolute;
    bottom:        4px;
    right:         4px;
    width:         16px;
    height:        16px;
    border-radius: 50%;
    background:    #22c55e;
    border:        3px solid var(--bg-header);
}
body.dark .avatar-status-dot { border-color: #1d1f28; }

/* ── Name & badges ── */
.profile-name {
    margin:         0 0 8px;
    font-size:      20px;
    font-weight:    800;
    color:          var(--text-main);
    letter-spacing: -0.3px;
}

.badge-row {
    display:     flex;
    align-items: center;
    gap:         8px;
    flex-wrap:   wrap;
}

.status-badge-active,
.status-badge-inactive {
    padding:        5px 14px;
    border-radius:  999px;
    font-size:      11px;
    font-weight:    700;
    display:        inline-block;
    min-width:      72px;
    text-align:     center;
    letter-spacing: 0.3px;
}
.status-badge-active   { background: #dcfce7; color: #16a34a; }
.status-badge-inactive { background: #fee2e2; color: #dc2626; }
body.dark .status-badge-active   { background: rgba(34,197,94,0.15);  color: #4ade80; }
body.dark .status-badge-inactive { background: rgba(239,68,68,0.15);  color: #f87171; }

.badge-info-custom {
    padding:        5px 12px;
    border-radius:  999px;
    font-size:      11px;
    font-weight:    700;
    letter-spacing: 0.3px;
}
.bg-warning { background: #fef3c7; color: #d97706; }
body.dark .bg-warning { background: rgba(217,119,6,0.18); color: #fbbf24; }

/* ── Back Button ── */
.manage-link {
    display:         inline-flex;
    align-items:     center;
    gap:             8px;
    background:      linear-gradient(135deg, #1970A1, #4bb7f5);
    color:           #fff;
    padding:         10px 20px;
    border-radius:   10px;
    text-decoration: none;
    font-weight:     600;
    font-size:       14px;
    font-family:     var(--font-heading);
    box-shadow:      0 4px 14px rgba(25,112,161,0.28);
    transition:      var(--transition);
    white-space:     nowrap;
}
.manage-link:hover {
    transform:  translateY(-1px);
    box-shadow: 0 6px 18px rgba(25,112,161,0.38);
    color:      #fff;
}

/* ── Profile Body ── */
.profile-body { padding: 0 30px 8px; }

/* ── Info Rows ── */
.info-row {
    display:         flex;
    justify-content: space-between;
    align-items:     center;
    padding:         16px 0;
    border-bottom:   1px solid #f1f5f9;
    gap:             16px;
}
.info-row:last-child { border-bottom: none; }
body.dark .info-row  { border-bottom-color: #1e293b; }

.info-label {
    color:       var(--text-muted);
    font-weight: 500;
    font-size:   13.5px;
    flex-shrink: 0;
}
.info-value {
    color:       var(--text-main);
    font-weight: 600;
    font-size:   14px;
    text-align:  right;
}

</style>

<div class="show-wrapper">
    <div class="profile-card">

        {{-- ── Header ── --}}
        <div class="profile-header">
            <div class="profile-identity">
                <div class="avatar-wrapper">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&size=128&background=random"
                         class="avatar-large">
                    <span class="avatar-status-dot"></span>
                </div>

                <div>
                    <h2 class="profile-name">{{ $employee->name }}</h2>
                    <div class="badge-row">
                        @php $status = trim(strtolower($employee->status)); @endphp
                        <span class="{{ $status === 'active' ? 'status-badge-active' : 'status-badge-inactive' }}">
                            {{ ucfirst($status) }}
                        </span>
                        <span class="badge-info-custom bg-warning">
                            #{{ $employee->id ?? 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>

            <a href="{{ route('clientFile.allUser') }}" class="manage-link">
                <i class='bx bx-arrow-back'></i>
                {{ translate('Back to Dashboard') }}
            </a>
        </div>

        {{-- ── Body ── --}}
        <div class="profile-body">
            <div class="info-row">
                <span class="info-label">{{ translate('Joined') }}</span>
                <span class="info-value">{{ $employee->created_at->format('M d, Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ translate('Full Name') }}</span>
                <span class="info-value">{{ $employee->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ translate('Email') }}</span>
                <span class="info-value">{{ $employee->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ translate('Role') }}</span>
                <span class="info-value">{{ ucfirst($employee->role) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ translate('User ID') }}</span>
                <span class="info-value">{{ $employee->id ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ translate('Company') }}</span>
                <span class="info-value">{{ $employee->company ?? 'N/A' }}</span>
            </div>
        </div>

    </div>
</div>
@endsection