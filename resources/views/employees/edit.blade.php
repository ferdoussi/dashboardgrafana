@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/app/edit.css') }}">
@section('content')

<div class="page-container">

    <div class="info-card">

        <div class="info-card-header">
            <h3>{{ translate('Personal Information') }}</h3>
        </div>

        <form method="POST" action="{{ route('employees.update', $employee->id) }}">
            @csrf
            @method('PUT')

            <div class="form-grid">

            

                <div class="form-group">
                    <label>{{ translate('Name') }} <span class="required">*</span></label>
                    <input type="text" name="name"
                           value="{{ old('name', $employee->name) }}">
                </div>

                <div class="form-group">
                    <label>{{ translate('Email Address') }} <span class="required">*</span></label>
                    <input type="email" name="email"
                           value="{{ old('email', $employee->email) }}">
                </div>

                <div class="form-group">
                    <label>{{ translate('Password') }} <span class="required">*</span></label>
                    <input type="password" name="password"
                           value="{{ old('password', $employee->password) }}">
                </div>

                <div class="form-group">
                    <label>{{ translate('Company') }}</label>
                    <input type="text" name="company"
                           value="{{ old('company', $employee->company) }}">
                </div>

                <div class="form-group">
                    <label>{{ translate('Role') }}</label>
                    <select name="role">
                        <option value="">Select Role</option>
                        <option value="admin" {{ $employee->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="superadmin" {{ $employee->role == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                        <option value="user" {{ $employee->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="client_admin" {{ $employee->role == 'client_admin' ? 'selected' : '' }}>Client Admin</option>
                    </select>
                </div>

              

            </div>

            <div class="form-actions">
                <button class="btn-primary" type="submit" onclick="return confirm('{{ translate('Are you sure you want to save changes?') }}')">{{ translate('Save Changes') }}</button>

                <a href="{{ route('superAdmin.superAdmin') }}" class="btn-secondary">
                    {{ translate('Cancel') }}
                </a>
            </div>

        </form>

    </div>

</div>
<script>
    
</script>
@endsection
