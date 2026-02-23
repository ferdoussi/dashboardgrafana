@extends('layouts.app')

@section('content')
<style>
/* ====== Body Dark/Light Mode ====== */
body {
    background: #f8fafc;
    transition: background 0.3s, color 0.3s;
}

body.dark {
    background: #111827;
    color: #e5e7eb;
}

/* ====== Profile Card ====== */
.profile-card {
    border-radius: 20px;
    padding: 35px;
    transition: background 0.3s, box-shadow 0.3s, color 0.3s;
    background: #fff;
    box-shadow: 0 15px 40px rgba(0,0,0,0.04);
    border: 1px solid #eef2f7;
}

body.dark .profile-card {
    background: #0f141b;
    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
    border: 1px solid #374151;
}

.profile-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 45px rgba(0,0,0,0.06);
}

.profile-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 35px;
}

.avatar-large {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

body.dark .avatar-large { border: 3px solid #111827; }

.badge-info-custom {
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 500;
    transition: background 0.3s, color 0.3s;
}

.bg-danger { background: #fee2e2; color: #ef4444; }
.bg-warning { background: #fef3c7; color: #d97706; }
.bg-primary { background: #dbeafe; color: #2563eb; }

body.dark .bg-danger { background: rgba(220, 38, 38, 0.2); color: #f87171; }
body.dark .bg-warning { background: rgba(217, 119, 6, 0.2); color: #fbbf24; }
body.dark .bg-primary { background: rgba(37, 99, 235, 0.2); color: #60a5fa; }

/* ====== Info Rows ====== */
.info-row {
    display: flex;
    justify-content: space-between;
    padding: 18px 0;
    border-bottom: 1px solid #f1f4f8;
    transition: background 0.3s, color 0.3s;
}

body.dark .info-row { border-bottom: 1px solid #374151; color: #d1d5db; }

.info-label { color: #64748b; font-weight: 500; }
body.dark .info-label { color: #9ca3af; }

.info-value { color: #0f172a; font-weight: 600; }
body.dark .info-value { color: #f3f4f6; }

/* ====== Manage Button ====== */
.manage-link {
    background: #3b82f6;
    color: #fff;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.3s;
}

.manage-link:hover { background: #2563eb; }
</style>

<div class="container mt-5">
    <div class="profile-card">
        <div class="profile-header">
            <div class="d-flex align-items-center">
                <div class="position-relative">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&size=128&background=random" class="avatar-large me-4">
                    <span class="position-absolute bottom-0 end-0 bg-success border border-white border-3 rounded-circle" style="width:20px; height:20px;"></span>
                </div>
                <div>
                    <h2 class="fw-bold mb-1 info-value">{{ $employee->name }}</h2>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge-info-custom bg-primary"><i class='bx bx-shield-alt-2'></i> {{ ucfirst($employee->role) }}</span>
                        <span class="badge-info-custom bg-warning">{{ $employee->id ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            <a href="{{ route('superAdmin.superAdmin') }}" class="manage-link mt-3 mt-md-0">Back to Dashboard</a>
        </div>

        <div class="profile-body">
            <div class="info-row">
                <span class="info-label">Joined</span>
                <span class="info-value">{{ $employee->created_at->format('M d, Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Full Name</span>
                <span class="info-value">{{ $employee->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value">{{ $employee->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Role</span>
                <span class="info-value">{{ ucfirst($employee->role) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">User ID</span>
                <span class="info-value">{{ $employee->id ??'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">User ID</span>
                <span class="info-value">{{ $employee->company ??'N/A' }}</span>
            </div>
        </div>
    </div>
</div>
@endsection