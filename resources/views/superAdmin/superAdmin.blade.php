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



<form id="filterForm" method="GET" style="display:flex; gap:12px; margin-bottom:20px; align-items:center;">

    <!-- Search input -->
   <div style="position:relative; flex:1;">
    <i class="bx bx-search" 
        style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af;"></i>

   <input type="text"
       id="userSearch"
       placeholder="Search name, email, company..."
       onkeyup="filterUsers()"
       style="width:100%; padding:10px 14px 10px 36px; border-radius:8px; border:1px solid #d1d5db;"
       class="userSearch"
       >
    

</div>


    <!-- Role select -->
    <select id="roleFilter" onchange="filterUsers()" style="padding:10px 14px; border-radius:8px; border:1px solid #d1d5db;">
        <option value="" {{ request('role') == '' ? 'selected' : '' }}>{{ translate('All Roles') }}</option>   
        <option value="admin_client" {{ request('role') == 'admin_client' ? 'selected' : '' }}>Admin_client</option>

        @auth
            @if (auth()->user()->role === 'superadmin')
                <option value="superadmin" {{ request('role') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            @endif
        @endauth

        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
    </select>
    {{-- select status --}}
    @if(auth()->user()->role === 'superadmin')
        <select id="statusFilter" onchange="filterUsers()" style="padding:10px; border-radius:8px; border:1px solid #ddd;">
            <option value="">{{ translate('All Statuses') }}</option>
            <option value="active">{{ translate('Active') }}</option>
            <option value="inactive">{{ translate('Inactive') }}</option>
        </select>
    @endif


</form>


        <div style="width:100%; overflow-x:auto;">
            <table class="table" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr > 
                        <th style="text-align:left;">{{ translate('Name') }}</th>
                        <th > {{ translate('Company') }}</th>
                        <th>{{ translate('Role') }}</th>
                        <th>{{ translate('Status') }}</th>
                        <th>{{ translate('Joined') }}</th>
                        <th style="text-align:right;">{{ translate('Actions') }}</th>
                        @if (auth()->user()->role === 'superadmin')
                            <th style="text-align:right;">{{ translate("validate") }}</th>
                        @endif
                    </tr>
                </thead>

               <tbody>
                    @forelse($employees as $employee)
                        @php
                            $roleColor = match($employee->role) {
                                'admin' => 'danger',
                                'superadmin' => 'warning',
                                default => 'primary',
                            };

                            $currentUserRole = auth()->user()->role;
                        @endphp

                   
                        @if(!($currentUserRole === 'admin' && in_array($employee->role, ['admin', 'superadmin'])))
                        <tr class="user-row" data-role="{{ $employee->role }}">
                            <td>
                                <div class="user-cell">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=random" class="avatar">
                                    <div>
                                        <span class="user-name">{{ $employee->name }}</span>
                                        <span class="user-email">{{ $employee->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td  class="user-company" style="text-align:center; color:#6b7280;">
                                {{ $employee->company ?? 'N/A' }}
                            </td>
                            <td style="text-align:center;">
                                <span class="badge bg-{{ $roleColor }}">
                                    {{ ucfirst($employee->role) }}
                                </span> 
                            </td>
                          <td style="text-align:center;">
                                @php
                                    // N-naddfou l-status bach may-kounoch machakil dyal l-espace
                                    $cleanStatus = trim(strtolower($employee->status));
                                @endphp

                                @if($cleanStatus === 'active')
                                    <span class="badge status-badge-active">active</span>
                                @else
                                    <span class="badge status-badge-inactive">inactive</span>
                                @endif
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
                                    @if (auth()->user()->role === 'superadmin')
                                        <form method="POST" action="{{ route('employees.destroy', $employee->id) }}" class="delete-form" style="display:inline;">
                                            @csrf 
                                            @method('DELETE')

                                            <button type="button" onclick="confirmDeleteEmployee(this)" class="action-btn delete-btn" title="Delete">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                        {{-- valider users per status --}}
                                           

                                @endif
                                
                            </td>
                             @if (auth()->user()->role === 'superadmin')
                            <td class="actions" style="text-align:right;">

                                <form method="POST" action="{{ route('employees.toggleStatus', $employee->id) }}" style="display:inline;">
                                    @csrf

                                    <button type="submit"
                                        class="action-btn {{ $employee->status === 'active' ? 'text-danger' : 'text-success' }}"
                                        title="{{ $employee->status === 'active' ? 'Deactivate' : 'Activate' }}"
                                        style="background:none;border:none;cursor:pointer;">

                                        @if(trim(strtolower($employee->status)) === 'active')
                                            <i class='bx bx-user-x' style="font-size:1.2rem;"></i>
                                        @else
                                            <i class='bx bx-user-check' style="font-size:1.2rem;"></i>
                                        @endif

                                    </button>

                                </form>

                            </td>
                             @endif
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:40px; color:#9ca3af;">
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
                                         @auth
                                @if (auth()->user()->role === 'superadmin')
                                     <option value="new">{{ translate('Add New Company') }} +</option>
                                @endif
                            @endauth
                                       
                                    </select>
                                </div>
                                 @auth
                                @if (auth()->user()->role === 'superadmin')
                                     <div class="form-group" id="newCompanyDiv" style="display:none;">
                                        <label>{{ translate('New Company Name') }}</label>
                                        <input type="text" name="new_company" placeholder="{{ translate('Enter company name') }}">
                                     </div>
                                @endif
                            @endauth
                               

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
                            @auth
                                @if (auth()->user()->role === 'superadmin')
                                    <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="superadmin" {{ old('role')=='superadmin' ? 'selected' : '' }}>Superadmin</option>
                                @endif
                            @endauth
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
                             minlength="8"
                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                               title="{{ translate('Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character.') }}"
                               required>
                            <small id="passError" style="color: #417df4" >
                                {{ translate('Password must be at least 8 characters.') }}
                            </small>
                            
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
function filterUsers() {

    const search = document.getElementById('userSearch').value.toLowerCase();
    const role = document.getElementById('roleFilter').value;

    const statusEl = document.getElementById('statusFilter');
    const statusFilter = statusEl ? statusEl.value.toLowerCase().trim() : '';

    const rows = document.querySelectorAll('.user-row');

    rows.forEach(row => {

        const name = row.querySelector('.user-name').innerText.toLowerCase();
        const email = row.querySelector('.user-email').innerText.toLowerCase();
        const company = row.querySelector('.user-company').innerText.toLowerCase();
        const userRole = row.getAttribute('data-role');

        // status الصحيح
        const statusBadge = row.querySelector('.status-badge-active, .status-badge-inactive');
        const statusValue = statusBadge ? statusBadge.textContent.toLowerCase().trim() : '';

        const matchSearch = name.includes(search) || email.includes(search) || company.includes(search);
        const matchRole = (role === '') || (userRole === role);
        const matchStatus = (statusFilter === '') || (statusValue === statusFilter);

        if (matchSearch && matchRole && matchStatus) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }

    });
}
function confirmDeleteEmployee(button) {
    const form = button.closest('.delete-form');
    const isDark = document.body.classList.contains('dark');

    Swal.fire({
        html: `
            <div class="swal-tailwind-body">
                <div class="swal-tailwind-icon-container">
                    <div class="swal-tailwind-icon-bg">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                </div>
                <div class="swal-tailwind-content">
                    <h3 id="swal-title">${'{{ translate("Delete User") }}'}</h3>
                    <p>${'{{ translate("Are you sure you want to delete this user? All of the user data will be permanently removed. This action cannot be undone.") }}'}</p>
                </div>
            </div>
        `,
        background: isDark ? '#1d1f28' : '#ffffff',
        backdrop: `rgba(0, 0, 0, 0.3) blur(4px)`,
        showCancelButton: true,
        confirmButtonText: '{{ translate("Delete") }}',
        cancelButtonText: '{{ translate("Cancel") }}',
        reverseButtons: true,
        buttonsStyling: false,
        customClass: {
            popup: 'swal-tailwind-popup',
            actions: 'swal-tailwind-actions',
            confirmButton: 'swal-tailwind-confirm',
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