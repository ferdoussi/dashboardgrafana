@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/app/edit.css') }}">

@section('content')

<div class="page-container">
    <div class="info-card">
        <div class="info-card-header">
            <h3>{{ translate('Personal Information') }}</h3>
        </div>

        {{-- 1. Zid id="editEmployeeForm" bach JavaScript i-9der i-sifto --}}
        <form id="editEmployeeForm" method="POST" action="{{ route('clientFile.updateEmployee', $employee->id) }}">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label>{{ translate('Name') }} <span class="required">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $employee->name) }}" required>
                </div>

                <div class="form-group">
                    <label>{{ translate('Email Address') }} <span class="required">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $employee->email) }}" required>
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
                        <option value="user" {{ $employee->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="client_admin" {{ $employee->role == 'client_admin' ? 'selected' : '' }}>Client Admin</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                {{-- 2. Type khasso ikoun "button" o l-function hiya "openUpdateModal" --}}
                <button class="btn-primary" type="button" onclick="openUpdateModal()">
                    {{ translate('Save Changes') }}
                </button>

                <a href="{{ route('clientFile.allUser') }}" class="btn-secondary">
                    {{ translate('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DIAL CONFIRMATION (Tailwind Style) --}}
<div id="updateConfirmModal" class="modal-overlay">
    <div class="modal-content">
        
        <div class="modal-body-tailwind">
            <div class="modal-flex-start">
                <div class="icon-info-circle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                
                <div class="modal-content-text">
                    <h3>{{ translate('Confirm Update') }}</h3>
                    <p>{{ translate('Are you sure you want to update this employee information? This will overwrite the existing data in the system.') }}</p>
                </div>
            </div>
        </div>

        <div class="modal-footer-tailwind">
            <button type="button" class="btn-primary" onclick="submitUpdateForm()">
                {{ translate('Update') }}
            </button>
            <button type="button" class="btn-secondary" onclick="closeUpdateModal()">
                {{ translate('Cancel') }}
            </button>
        </div>

    </div>
</div>

<script>
    // Function bach n-7ello l-modal
    function openUpdateModal() {
        document.getElementById('updateConfirmModal').style.display = 'flex';
    }

    // Function bach n-seddo l-modal
    function closeUpdateModal() {
        document.getElementById('updateConfirmModal').style.display = 'none';
    }

    // Function bach n-sifto l-form dial sa7 fach ikliki "Yes"
    function submitUpdateForm() {
        document.getElementById('editEmployeeForm').submit();
    }

    // Sed modal ila clicka l-user l-berra
    window.onclick = function(event) {
        let modal = document.getElementById('updateConfirmModal');
        if (event.target == modal) {
            closeUpdateModal();
        }
    }
</script>

@endsection