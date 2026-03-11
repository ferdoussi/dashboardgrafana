@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/app/user-management.css') }}">
@endpush

@section('content')
<div class="user-management-container">

    <button class="btn-add-user" onclick="openModal()">
        <i class='bx bx-user-plus'></i>
        {{ translate('Add New User') }}
    </button>

    {{-- MODAL --}}
  <div id="addUserModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">{{ translate('User Creation Limit') }}</h3>
            <span class="close-modal" onclick="closeModal()">&times;</span>
        </div>

        {{-- Step 1: Warning --}}
        <div id="step1" style="padding: 20px; text-align: center;">
            <div style="font-size: 50px; color: #f59e0b; margin-bottom: 15px;">⚠️</div>
            <p style="font-size: 16px; color: var(--text-main); font-weight: 500;">
                {{ translate('Notice: You cannot add more than 10 users to this project.') }}
            </p>
            <div class="form-actions" style="margin-top: 25px; justify-content: center;">
                <button type="button" class="btn-primary" onclick="goToStep2()" style="width: 100%;">
                    {{ translate('Next') }}
                </button>
            </div>
        </div>

        {{-- Step 2: Form --}}
        <div id="step2" style="display: none;">
            <form method="POST" action="{{ route('clientFile.storeUser') }}" autocomplete="off">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>{{ translate('Name') }} *</label>
                        <input type="text" name="name" placeholder="Enter name" required value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label>{{ translate('Email Address') }} *</label>
                        <input type="email" name="email" required 
                            placeholder="example@fortress360 or example@qokpit3d.io" 
                            value="{{ old('email') }}">
                        
                        {{-- Had l-message ghadi i-tla3 fih l-error dial custom check aw regex --}}
                        @error('limit')
                            <small style="color: #ef4444; font-weight: 600; display: block; margin-top: 5px;">
                                {{ $message }}
                            </small>
                        @else
                            {{-- <small>{{ translate('Example: username@fortress360.com') }}</small> --}}
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ translate('Password') }} *</label>
                        <input type="password" name="password" required 
                               placeholder="Enter password"
                               >
                        
                            @error('password')
                                <small style="color: #ef4444; font-weight: 600; display: block; margin-top: 5px;">
                                    {{ $message }}
                                </small>
                            @else
                                <small style="display: block; margin-top: 5px; color: #5188f6;">
                                    {{ translate('Use 8+ chars (Aa, 123, @#$).') }}
                                </small>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ translate('Role') }} *</label>
                        <select name="role" required>
                            <option value="" disabled selected>Select role...</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin_client" {{ old('role') == 'admin_client' ? 'selected' : '' }}>Admin Client</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal()">{{ translate('Cancel') }}</button>
                    <button type="submit" class="btn-primary">{{ translate('Add User') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

    {{-- TABLE --}}
    <div class="table-card">

       <form class="filter-form" id="filterUsersClient">

    <input type="text"
           id="userSearch"
           name="search"
           value="{{ request('search') }}"
           class="filter-input"
           placeholder="{{ translate('Search users, email...') }}"
           oninput="filterUsersClient()">

    <select id="roleFilter"
            name="role"
            class="filter-input2"
            onchange="filterUsersClient()">

        <option value="">{{ translate('All Roles') }}</option>
        <option value="admin_client">Admin Client</option>
        <option value="user">User</option>

    </select>

</form>

        <table>
    <thead>
        <tr>
            <th>{{ translate('Name') }}</th>
            <th>{{ translate('Email') }}</th>
            <th>{{ translate('Company') }}</th>
            <th>{{ translate('Role') }}</th>
            <th>{{ translate('Joined') }}</th>
            <th>{{ translate('Actions') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($employees as $employee)
        <tr class="user-row" data-role="{{ $employee->role }}">

            <td class="user-name">
                <div class="user-cell">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=random"
                         class="avatar">
                    {{ $employee->name }}
                </div>
            </td>

            <td class="user-email">{{ $employee->email }}</td>

            <td class="user-company">
                {{ $employee->company ?? '-' }}
            </td>

            <td>
                <span class="badge {{ $employee->role }}">
                    {{ ucwords(str_replace('_', ' ', $employee->role)) }}
                </span>
            </td>

            <td>{{ $employee->created_at->format('M d, Y') }}</td>

            <td>
                <div class="action-icons">

                    <a href="{{ route('clientFile.employeeDetails',$employee->id) }}"
                       class="action-btn">
                        <i class='bx bx-show'></i>
                    </a>

                    <a href="{{ route('clientFile.editEmployee',$employee->id) }}"
                       class="action-btn">
                        <i class='bx bx-edit'></i>
                    </a>

                    <button type="button" class="action-btn" onclick="openDeleteModal({{ $employee->id }})">
                        <i class='bx bx-trash' style="color: #ef4444;"></i>
                    </button>

                    <form id="delete-form-{{ $employee->id }}" action="{{ route('clientFile.deleteEmployee', $employee->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                   <div id="deleteConfirmModal" class="modal-overlay">
                        <div class="modal-content" style="max-width: 512px; padding: 0; overflow: hidden;">
                            
                            <div class="modal-body-tailwind">
                                <div class="modal-flex-start">
                                    <div class="icon-danger-circle">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    
                                    <div class="modal-content-text">
                                        <h3>{{ translate('Deactivate account') }}</h3>
                                        <p>{{ translate('Are you sure you want to deactivate this account? All of the user data will be permanently removed. This action cannot be undone.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer-tailwind">
                                <button type="button" id="confirmDeleteBtn" class="btn-primary" style="background: #dc2626; border: none;">
                                    {{ translate('Delete') }}
                                </button>
                                <button type="button" class="btn-secondary" onclick="closeDeleteModal()">
                                    {{ translate('Cancel') }}
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

    </div>
</div>

<script>
function openModal() {
    // Check if there are validation errors to skip Step 1
    @if($errors->any())
        goToStep2();
    @else
        document.getElementById('step1').style.display = 'block';
        document.getElementById('step2').style.display = 'none';
        document.getElementById('modalTitle').innerText = "{{ translate('User Creation Limit') }}";
    @endif
    
    document.getElementById('addUserModal').style.display = 'flex';
}

function goToStep2() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
    document.getElementById('modalTitle').innerText = "{{ translate('Add New User') }}";
}

function closeModal() {
    document.getElementById('addUserModal').style.display = 'none';
}

// Auto-open modal if validation failed after redirect
@if($errors->any())
    window.onload = function() {
        openModal();
    };
@endif
function filterUsersClient() {

    const search = document.getElementById('userSearch').value.toLowerCase();
    const role = document.getElementById('roleFilter').value;

    const rows = document.querySelectorAll('.user-row');

    rows.forEach(row => {

        const name = row.querySelector('.user-name').innerText.toLowerCase();
        const email = row.querySelector('.user-email').innerText.toLowerCase();
        const company = row.querySelector('.user-company').innerText.toLowerCase();
        const userRole = row.getAttribute('data-role');

        const matchSearch =
            name.includes(search) ||
            email.includes(search) ||
            company.includes(search);

        const matchRole = role === '' || role === userRole;

        row.style.display = (matchSearch && matchRole) ? '' : 'none';

    });
}
let currentDeleteId = null;

function openDeleteModal(id) {
    currentDeleteId = id; // Store l-ID
    document.getElementById('deleteConfirmModal').style.display = 'flex';
}

function closeDeleteModal() {
    document.getElementById('deleteConfirmModal').style.display = 'none';
    currentDeleteId = null;
}

// Fach l-user i-cliki "Yes, Delete"
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (currentDeleteId) {
        document.getElementById('delete-form-' + currentDeleteId).submit();
    }
});

// Sed l-modal ila clicka l-user l-berra
window.onclick = function(event) {
    let deleteModal = document.getElementById('deleteConfirmModal');
    let updateModal = document.getElementById('updateConfirmModal'); // Ila kant f nefs l-page
    
    if (event.target == deleteModal) closeDeleteModal();
    if (event.target == updateModal) closeUpdateModal(); // function dial l-edit
}
</script>
@endsection