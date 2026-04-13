@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/app/settings.css') }}">

<div class="settings-wrapper">
    <h2 class="settings-title">{{ translate('Account Settings') }}</h2>

    <div class="settings-card">
        {{-- Success Message Alert --}}
        @if(session('success'))
            <div class="alert-success-modern">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('settings.profile') }}" method="POST">
            @csrf

            {{-- Full Name --}}
            <div class="form-group-modern">
                <label>{{ translate('Full Name') }}</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', auth()->user()->name) }}" 
                       class="input-modern @error('name') is-invalid @enderror"
                       placeholder="Enter your full name">
                @error('name') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            {{-- Email Address --}}
            <div class="form-group-modern">
                <label>{{ translate('Email Address') }}</label>
                <input type="email" 
                       value="{{ auth()->user()->email }}" 
                       class="input-modern input-disabled" 
                       disabled>
                <small style="color: #6b7280;">{{ translate('Email address cannot be changed') }}.</small>
            </div>
                {{-- Company Name --}}
                <div class="form-group-modern">
                    <label>{{ translate('Company Name') }}</label>
                    <input type="text" 
                        name="company" 
                        value="{{ old('company', auth()->user()->company) }}" 
                        class="input-modern input-disabled"
                        placeholder="Enter your company name" disabled>
                         <small style="color: #6b7280;">{{ translate('Company name cannot be changed') }}.</small>
                </div>

            <hr class="divider">

            {{-- Current Password --}}
            <div class="form-group-modern">
                <label>{{ translate('Current Password') }} <span style="color: var(--danger);">*</span></label>
                <input type="password" 
                    name="current_password" 
                    placeholder="{{ translate('Enter current password to confirm changes') }}" 
                    class="input-modern @error('current_password') is-invalid @enderror"
                    required> 
                @error('current_password') <span class="error-msg">{{ $message }}</span> @enderror
                
            </div>

            {{-- New Password --}}
            <div class="form-group-modern">
                <label>{{ translate('New Password') }}</label>
                <input type="password" 
                    name="password" 
                    placeholder="{{ translate('Leave blank to keep current password') }}"
                    class="input-modern @error('password') is-invalid @enderror">
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-primary-modern">
               {{{ translate('Update Settings') }}}
            </button>
        </form>
    </div> 

    {{-- Danger Zone --}}
    <div class="danger-card">
        <div class="danger-header">{{ translate('⚠️ Danger Zone') }}</div>
        <div class="danger-body">
            <div class="danger-text">
                <h4>{{ translate('Delete Account') }}</h4>
                <p>{{ translate('Your account and all your data will be permanently deleted.') }}</p>
            </div>
            <form action="{{ route('settings.delete') }}" method="POST" >
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDeleteCount(this)" class="btn-danger-outline">{{ translate('Delete Account') }}</button>
            </form>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert-success-modern');
        if (alert) {
            alert.remove();
        }
        
    }, 5000);
    function confirmDeleteCount(button) {
    // Kan-cheddo l-form li 9rib l had l-bouton
    const form = button.closest('.delete-form');
    // Kan-cheufou wach dark mode m-activé f l-body
    const isDark = document.body.classList.contains('dark');

    Swal.fire({
        html: `
            <div class="swal-tailwind-container">
                <div class="swal-tailwind-body">
                    <div class="swal-tailwind-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div class="swal-tailwind-content">
                        <h3 id="swal-title">${'{{ translate("Delete Account") }}'}</h3>
                        <p>${'{{ translate("Are you sure you want to delete your account permanently? This action cannot be undone.") }}'}</p>
                    </div>
                </div>
            </div>
        `,
        // Stylat d-debaba o l-alwan
        background: isDark ? '#1d1f28' : '#ffffff',
        backdrop: `rgba(0, 0, 0, 0.3) blur(8px)`,
        
        // Buttons config
        showCancelButton: true,
        confirmButtonText: '{{ translate("Delete Account") }}',
        cancelButtonText: '{{ translate("Cancel") }}',
        reverseButtons: true,
        buttonsStyling: false,
        
        // Classes dial Tailwind/Custom CSS
        customClass: {
            popup: 'swal-tailwind-popup',
            actions: 'swal-tailwind-actions',
            confirmButton: 'swal-tailwind-confirm',
            cancelButton: 'swal-tailwind-cancel'
        },
        width: '32rem',
    }).then((result) => {
        // Ila user cliqua 3la Delete, kansifto l-form
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endsection