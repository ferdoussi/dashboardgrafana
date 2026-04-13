@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/app/edit.css') }}">
@section('content')

<div class="page-container">

    <div class="info-card">

        <div class="info-card-header">
            <h3>{{ translate('Personal Information') }}</h3>
        </div>

       <form id="updateEmployeeForm" method="POST" action="{{ route('employees.update', $employee->id) }}">
    @csrf
    @method('PUT')

    <div class="form-grid">
        <div class="form-group">
            <label>{{ translate('Name') }} <span class="required">*</span></label>
            <input type="text" name="name" value="{{ old('name', $employee->name) }}">
        </div>

        <div class="form-group">
            <label>{{ translate('Email Address') }} <span class="required">*</span></label>
            <input type="email" name="email" value="{{ old('email', $employee->email) }}">
        </div>

        <div class="form-group">
            <label>{{ translate('Password') }} <span class="required">*</span></label>
            <input type="password" name="password" 
            value="{{ old('password', $employee->password) }}">
        </div>

        <div class="form-group">
            <label>{{ translate('Company') }}</label>
            <input type="text" name="company" value="{{ old('company', $employee->company) }}">
        </div>

        <div class="form-group">
            <label>{{ translate('Role') }}</label>
            <select name="role">
                <option value="">{{ translate('Select Role') }}</option>
                <option value="admin" {{ $employee->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ $employee->role == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                <option value="user" {{ $employee->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="client_admin" {{ $employee->role == 'client_admin' ? 'selected' : '' }}>Client Admin</option>
            </select>
        </div>
    </div>

    <div class="form-actions">
        <button class="btn-primary" type="button" onclick="confirmUpdate()">
            {{ translate('Save Changes') }}
        </button>

        <a href="{{ route('superAdmin.superAdmin') }}" class="btn-secondary">
            {{ translate('Cancel') }}
        </a>
    </div>
</form>
    </div>

</div>
<script>
    function confirmUpdate() {
    const isDark = document.body.classList.contains('dark');
    const form = document.getElementById('updateEmployeeForm');

    Swal.fire({
        html: `
            <div class="swal-tailwind-body">
                <div class="swal-tailwind-icon-container">
                    <div class="swal-tailwind-icon-bg" style="background-color: #eff6ff;">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="color: #2563eb; width: 1.5rem; height: 1.5rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </div>
                </div>
                <div class="swal-tailwind-content">
                    <h3 id="swal-title">${'{{ translate("Confirm Update") }}'}</h3>
                    <p>${'{{ translate("Are you sure you want to update this employee information? This will overwrite the existing data in the system.") }}'}</p>
                </div>
            </div>
        `,
        background: isDark ? '#1d1f28' : '#ffffff',
        backdrop: `rgba(0, 0, 0, 0.3) blur(4px)`,
        showCancelButton: true,
        confirmButtonText: '{{ translate("Update") }}',
        cancelButtonText: '{{ translate("Cancel") }}',
        reverseButtons: true,
        buttonsStyling: false,
        customClass: {
            popup: 'swal-tailwind-popup',
            actions: 'swal-tailwind-actions',
            confirmButton: 'swal-tailwind-confirm-blue', 
            cancelButton: 'swal-tailwind-cancel'
        },
        width: '32rem',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endsection
