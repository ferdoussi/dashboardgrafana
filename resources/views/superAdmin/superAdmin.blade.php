@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/app/alluser.css') }}">
{{-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> --}}
<div style="width:100%; padding:20px;right:0; display:flex; flex-direction:column; gap:20px;">
<div>
    <button class="btn-add-user" onclick="openCreateUserModal()">
        <i class='bx bx-user-plus'></i>
        {{ translate('Add New User') }}
    </button>
</div>

    <div class="card">

        <form method="GET" style="display:flex; gap:12px; margin-bottom:20px;">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   class="filter-input"
                   placeholder="{{ translate('Search users, email...') }}" 
                   style="flex:1; padding:10px 14px; border-radius:8px;">

            <select name="role" class="filter-input" style="padding:10px 14px; border-radius:8px;">
                <option value="">{{ translate('All Roles') }}</option>
                <option value="admin">Admin</option>
                <option value="admin_client">Admin_client</option>
                <option value="superadmin">Superadmin</option>
                <option value="user">User</option>
            </select>

            <button type="submit" style="padding:10px 18px; border:none; border-radius:8px; background:#2563eb; color:white; font-weight:600; cursor:pointer;">
                {{ translate('Filter') }}
            </button>
        </form>

        <div style="width:100%; overflow-x:auto;">
            <table class="table" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="text-align:left;">{{ translate('User') }}</th>
                        <th > {{ translate('Company') }}</th>
                        <th>{{ translate('Role') }}</th>
                        <th>{{ translate('Joined') }}</th>
                        <th style="text-align:right;">{{ translate('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($employees as $employee)
                    @php
                        $roleColor = match($employee->role) {
                            'admin' => 'danger',
                            'Superadmin' => 'warning',
                            default => 'primary',
                        };
                    @endphp

                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=random" class="avatar">
                                <div>
                                    <span class="user-name">{{ $employee->name }}</span>
                                    <span class="user-email">{{ $employee->email }}</span>
                                </div>
                            </div>
                        </td>
                        <td style="text-align:center; color:#6b7280;">
                            {{ $employee->company ?? 'N/A' }}
                        </td>
                        <td style="text-align:center;">
                            <span class="badge bg-{{ $roleColor }}">
                                {{ ucfirst($employee->role) }}
                            </span>
                        </td>

                        <td style="text-align:center; color:#6b7280; font-size: 0.85rem;">
                            {{ $employee->created_at->format('M d, Y') }}
                        </td>

                        <td class="actions" style="text-align:right;">
                            <a href="{{ route('employees.show', $employee->id) }}" class="action-btn">
                                <i class='bx bx-show'></i>
                            </a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="action-btn">
                                <i class='bx bx-edit'></i>
                            </a>
                            <form method="POST"
                                action="{{ route('employees.destroy', $employee->id) }}"
                                onsubmit="return confirm('Are you sure you want to delete this employee?')"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="action-btn delete-btn" title="Delete" >
                                    <i class='bx bx-trash'></i>
                                </button>
                        </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:40px; color:#9ca3af;">
                            <i class='bx bx-search-alt' style="font-size: 2rem; display:block; margin-bottom:10px;"></i>
                            {{ translate('No users found') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-overlay" id="createUserModal">
    <div class="modal-card">

        <!-- Header -->
        <div class="modal-header">
            <h3>{{ translate('Add New User') }}</h3>
            <button class="close-btn" onclick="closeCreateUserModal()">
                <i class='bx bx-x'></i>
            </button>
        </div>

        <form method="POST" action="{{ route('employees.store') }}">
            @csrf

            <!-- Body -->
            <div class="modal-body">

                <div class="form-grid">

                    <!-- Name -->
                    <div class="form-group">
                        <label>{{ translate('Name') }} <span class="required">*</span></label>
                        <input
                            type="text"
                            name="name"
                            placeholder="{{ translate('Enter name') }}"
                            value="{{ old('name') }}"
                            required>
                    </div>

                    <!-- Company (optional) -->
                    <div class="form-group">
                                    <label>{{ translate('Company') }}</label>
                                    <select name="company_id" id="companySelect" class="filter-input" onchange="toggleNewCompanyField()">
                                        <option value="">{{ translate('Select Existing Company') }}</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                        <option value="new">{{ translate('Add New Company') }} +</option>
                                    </select>
                                </div>

                                <div class="form-group" id="newCompanyDiv" style="display:none;">
                                    <label>{{ translate('New Company Name') }}</label>
                                    <input type="text" name="new_company" placeholder="{{ translate('Enter company name') }}">
                    </div>

                        <!-- Email -->
                    <div class="form-group full">
                        <label>{{ translate('Email Address') }} <span class="required">*</span></label>
                        <input
                            type="email"
                            name="email"
                            placeholder="example@fortress360 or example@qokpit3d.io"
                            value="{{ old('email') }}"
                            pattern="^.+@(fortress360|qokpit3d\.io)$"
                            title="Please use an email ending with @fortress360 or @qokpit3d.io"
                            required>
                    </div>

                    <!-- Role -->
                    <div class="form-group full">
                        <label>{{ translate('Role') }} <span class="required">*</span></label>
                        <select name="role" required>
                            <option value="">{{ translate('Select role...') }}</option>
                            <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                            <option value="superadmin" {{ old('role')=='superadmin' ? 'selected' : '' }}>Superadmin</option>
                            <option value="admin_client" {{ old('role')=='admin_client' ? 'selected' : '' }}>Admin Client</option>
                            <option value="user" {{ old('role')=='user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label>{{ translate('Password') }} <span class="required">*</span></label>
                        <input
                            type="password"
                            name="password"
                            placeholder="{{ translate('Enter password') }}"
                            required>
                    </div>

                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeCreateUserModal()">
                    {{ translate('Cancel') }}
                </button>

                <button type="submit" class="btn-primary">
                    {{ translate('Add User') }}
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function openCreateUserModal() {
    document.getElementById('createUserModal').classList.add('show');
}

function closeCreateUserModal() {
    document.getElementById('createUserModal').classList.remove('show');
}
function toggleNewCompanyField() {
    const select = document.getElementById('companySelect');
    const newDiv = document.getElementById('newCompanyDiv');
    newDiv.style.display = (select.value === 'new') ? 'block' : 'none';
}
</script>

@endsection