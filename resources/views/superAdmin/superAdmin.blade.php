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

</form>


        <div style="width:100%; overflow-x:auto;">
            <table class="table" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr > 
                        <th style="text-align:left;">{{ translate('Name') }}</th>
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
                                    <form method="POST"
                                        action="{{ route('employees.destroy', $employee->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this employee?')"
                                        style="display:inline;">
                                        @csrf 
                                        @method('DELETE')

                                        <button type="submit" class="action-btn delete-btn" title="Delete">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
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



</script>

@endsection