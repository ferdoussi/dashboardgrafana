<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ translate('Home Page') }}</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="{{ asset('YOKAMOS.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app/app.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> --}}
    @stack('styles')
  
</head>
<body>

    <!-- HEADER - Fixed -->
    <div class="header">
        <div class="logo-container">
             
            <!-- Menu toggle for mobile -->
            <button class="menu-toggle">
                <i class='bx bx-menu'></i>
            </button>
            <a href="{{ route('app.home') }}"> <img src="{{ asset('logo.png') }}" alt="Yokamos SOC" class="logo"></a>
           
        <div class="switch-container">
        <input type="checkbox" id="sidebarToggle" class="sidebar-checkbox">
        <label for="sidebarToggle" class="menu-icon">
            <i class='bx bx-menu'></i>
        </label>

    </div>
        </div>
      
<div class="header-right">
<div class="lang-container me-3">

    <div class="lang-container">
        <select class="form-select-lang" onchange="window.location.href=this.value;">
            <option value="{{ route('lang.switch', 'en') }}" {{ session('locale') == 'en' ? 'selected' : '' }}> EN</option>
            <option value="{{ route('lang.switch', 'fr') }}" {{ session('locale') == 'fr' ? 'selected' : '' }}> FR</option>
        </select>
    </div>
</div>
    <button id="darkModeToggle" class="dark-mode">
        <i class='bx bx-moon'></i>
    </button>

    <div class="user-dropdown">
        <button class="user-dropdown-btn">
            <i class='bx bx-user' style="color:white"></i>
        </button>

        <div class="user-dropdown-content">
            <button id="closeDropdownBtn" class="close-dropdown">&times;</button>

            <div class="user-info-header">
                <div class="user-avatar">
                    <i class='bx bx-user'></i>
                </div>

                @if(Auth::check())
                    <div class="user-name">{{ Auth::user()->company }}</div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-email">{{ Auth::user()->email }}</div>
                    <div class="user-role">{{ Auth::user()->id }}</div>
                    <div class="user-email">{{ Auth::user()->role }}</div>
                @else
                    <div class="user-name">Verification 2FA</div>
                @endif
            </div>

            <div class="dropdown-divider"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class='bx bx-log-out'></i>
                    <span>{{ translate('Logout') }}</span>
                </button>
            </form>
        </div>
    </div>

</div>

    </div>

    <!-- MAIN LAYOUT -->
    <div class="main-layout">
    
    
    <div class="sidebar">
        <div class="sidebar-header">
            
            <div class="client-info">
                @php
                    $client = session('client', 'default');
                @endphp

                <a href="{{ route('app.home') }}" class="client-logo-link">
                    <div class="client-logo">
                        <img src="{{ asset('assets/logos/' . strtolower($client) . '.png') }}" alt="{{ $client }} logo" class="img">
                    </div>
                </a>
            </div>
        </div>

        <div class="sidebar">
    <div class="sidebar-header">
        <div class="client-info">
            @php $client = session('client', 'default'); @endphp
            <a href="{{ route('app.home') }}" class="client-logo-link">
                <div class="client-logo">
                    <img src="{{ asset('assets/logos/' . $client . '.png') }}" alt="logo" class="img">
                </div>
            </a>
        </div>
    </div> 
     <hr class="line"/>
     <a href="{{ route('app.home') }}" class="sidebar-link" >
      <div class="sidebar-section">
        <h3><i class='bx bx-cog'></i> <span class="nav-text">{{ translate('Home Page') }}</span></h3>
    </div>
    </a> 
    {{-- 1. User Section--}}
   
  @auth
    @if(auth()->user()->role === 'user' || auth()->user()->role === 'admin_client')
        <div class="sidebar-section">
            <h3 class="dropdown-toggle">
                <i class='bx bx-lock-alt'></i>
                <span class="text">{{ translate('Dashboards') }}</span>
                <i class='bx bx-chevron-down arrow'></i>
            </h3>
            <ul class="sidebar-nav dropdown-menu-dashboard">
                <li><a href="{{ route('dashboard.show', 'event') }}"><i class='bx bx-lock-alt'></i> {{ translate('Events') }}</a></li>
                <li><a href="{{ route('dashboard.show', 'offenses') }}"><i class='bx bx-shield-alt'></i> {{ translate('Offenses') }}</a></li>
                <li><a href="{{ route('dashboard.show', 'rules') }}"><i class='bx bx-calendar-event'></i> {{ translate('Rules') }}</a></li>
                <li><a href="{{ route('dashboard.show', 'sets') }}"><i class='bx bx-layer'></i> {{ translate('Sets') }}</a></li>
                <li><a href="{{ route('dashboard.show', 'saved-search') }}"><i class='bx bx-search-alt-2'></i> {{ translate('Saved Search') }}</a></li>
                <li><a href="{{ route('dashboard.show', 'offenses-map') }}"><i class='bx bx-map'></i> {{ translate('Offenses Map') }}</a></li>
                
              @php
              
$userDashboards = \App\Models\UserDashboard::where('client_id', auth()->user()->client_id)
    ->orderBy('created_at', 'desc')
    ->get();
    
    
@endphp

        
   
  @foreach($userDashboards as $dash)
    <li style="display: flex; justify-content: space-between; align-items: center; padding-right: 15px;">
        <a href="{{ route('dashboard.viewCustom', $dash->id) }}" style="flex: 1;">
            <i class='bx bx-layout'></i> {{ $dash->name }}
        </a>
        
        {{-- أيقونة المسح --}}
        @auth
    @if(auth()->user()->role === 'admin_client')
        <form action="{{ route('dashboard.delete', $dash->id) }}" method="POST" onsubmit="return confirm('{{ translate('Are you sure you want to delete this dashboard?') }}');" style="margin-left: 10px;">
            @csrf
            @method('DELETE')
            <button type="submit" style="background: none; border: none; color: #ff4d4d; cursor: pointer; padding: 5px;">
                <i class='bx bx-trash' style="font-size: 1.1em;"></i>
            </button>
        </form>
        @endif
@endauth
    </li>
@endforeach
 
            </ul>
        </div>
    @endif
@endauth


    {{-- 2. Admin Section --}}
{{-- 2. Admin Section --}}
@auth
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
        <div class="sidebar-section">
            <h3 class="dropdown-toggle">
                <i class='bx bx-group'></i>
                <span class="text">{{ translate('List of Clients') }}</span>
                <i class='bx bx-chevron-down arrow'></i>
            </h3>

            <ul class="sidebar-nav dropdown-menu-dashboard">
                @php
                    $all_users = \App\Models\Employee::where('role', 'admin_client')->get();
                @endphp

                @forelse($all_users as $u)
                    <li class="has-submenu">
                        <div class="submenu-toggle">
                            <i class='bx bx-user'></i>
                            <span style="color: rgb(249, 236, 236)">{{ $u->name }}</span>
                            <i class='bx bx-chevron-right arrow-small'></i>
                        </div>

                        <ul class="submenu-list">
                            {{-- القائمة الثابتة --}}
                            <li><a href="{{ route('dashboard.show', ['type' => 'event', 'user_id' => $u->id]) }}"><i class='bx bx-lock-alt'></i>{{ translate('Events') }}</a></li>
                            <li><a href="{{ route('dashboard.show', ['type' => 'offenses', 'user_id' => $u->id]) }}"><i class='bx bx-shield-alt'></i>{{ translate('Offenses') }}</a></li>
                            <li><a href="{{ route('dashboard.show', ['type' => 'rules', 'user_id' => $u->id]) }}"><i class='bx bx-calendar-event'></i>{{ translate('Rules') }}</a></li>
                            <li><a href="{{ route('dashboard.show', ['type' => 'sets', 'user_id' => $u->id]) }}"><i class='bx bx-layer'></i> {{ translate('Sets') }}</a></li>
                            <li><a href="{{ route('dashboard.show', ['type' => 'saved-search', 'user_id' => $u->id]) }}"><i class='bx bx-search-alt-2'></i>{{ translate('Saved Search') }}</a></li>
                            <li><a href="{{ route('dashboard.show', ['type' => 'offenses-map', 'user_id' => $u->id]) }}"><i class='bx bx-map'></i>{{ translate('Offenses Map') }}</a></li>
                            
                           
                            
                            {{-- جلب الـ Custom Dashboards ديال هاد المستخدم بالتحديد --}}
                            @php
                                $u_dashboards = \App\Models\UserDashboard::where('user_id', $u->id)->get();
                            @endphp

                            @foreach($u_dashboards as $cd)
                                <li>
                                    <a href="{{ route('dashboard.viewCustom', $cd->id) }}" title="Voir le dashboard">
                                        <i class='bx bx-layout' style="font-size: 10px;"></i> {{ $cd->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @empty
                    <li style="padding: 10px; color: gray;">{{ translate('No clients available') }}</li>
                @endforelse
               
            </ul>
             
        </div>
          
             
    @endif
@endauth
@auth
    @if (auth()->user()->role ==='superadmin')
    <h3 class="link-title">
                <a href="{{ route('superAdmin.superAdmin') }}" class="sidebar-link" >
                    <i class='bx bx-group'></i>
                    <span style="text">{{ translate('All Users') }}</span>
                </a>
            </h3>

        
    @endif
@endauth

    
   
    
    @auth
        @if (auth()->user()->role === 'admin_client')
        <a href="">
    <div class="sidebar-section">
        <a href="{{ route('clientFile.allUser') }}" class="sidebar-link" >
        <h3><i class='bx bx-user'></i> <span class="nav-text">{{ translate('All Users') }}</span></h3>
    </a>
    </div>
        </a>
            
        @endif
    @endauth
    @auth
    @if(auth()->user()->role === 'user' || auth()->user()->role === 'admin_client')
         {{-- Home Page Link --}}
         <a href="{{ route('app.home') }}" class="sidebar-link" >
    <div class="sidebar-section">
        <a href="{{ route('support.support') }}" class="sidebar-link" >
        <h3><i class='bx bx-help-circle'></i> <span class="nav-text">{{ translate('Aide & Support') }}</span></h3>
    </a>
    </div>
    @endif
    @endauth
    
</div>

            
            <!-- Vous pouvez ajouter d'autres sections ici -->
        </div>

        <!-- CONTENU DYNAMIQUE - Scrollable -->
        <div class="content-area">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
    // Toggle sidebar on mobile
    document.querySelector('.menu-toggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.querySelector('.sidebar');
        const menuToggle = document.querySelector('.menu-toggle');
        
        if (window.innerWidth <= 768 && 
            !sidebar.contains(event.target) && 
            !menuToggle.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    });
    // زيد هاد الجزء ف الـ Script ديالك
document.querySelectorAll('.submenu-toggle').forEach(subToggle => {
    subToggle.addEventListener('click', function(e) {
        e.stopPropagation(); // باش ما يتسدش المنيو الكبير
        const subMenu = this.nextElementSibling;
        
        // تبديل العرض (Toggle display)
        if (subMenu.style.display === "block") {
            subMenu.style.display = "none";
            this.querySelector('.arrow-small').style.transform = "rotate(0deg)";
        } else {
            subMenu.style.display = "block";
            this.querySelector('.arrow-small').style.transform = "rotate(90deg)";
        }
    });
});

    // ---------------------------
    // USER DROPDOWN - Click toggle
    // ---------------------------
    const userDropdownBtn = document.querySelector('.user-dropdown-btn');
    const userDropdownContent = document.querySelector('.user-dropdown-content');

    userDropdownBtn.addEventListener('click', function(event) {
        event.stopPropagation(); 
        if (userDropdownContent.style.display === 'block') {
            userDropdownContent.style.display = 'none';
        } else {
            userDropdownContent.style.display = 'block';
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!userDropdownContent.contains(event.target) && !userDropdownBtn.contains(event.target)) {
            userDropdownContent.style.display = 'none';
        }
    });

    // ---------------------------
    // DASHBOARD dropdown toggle
    // ---------------------------
  // دير هاد الكود بلاصتو
document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
    toggle.addEventListener('click', () => {
        // كيجيب القائمة (ul) اللي جاية مورا العنوان (h3) مباشرة
        const menu = toggle.nextElementSibling; 
        
        if (menu) {
            menu.classList.toggle('open');
            toggle.classList.toggle('active');
        }
    });
});
document.querySelectorAll('.submenu-toggle').forEach(subToggle => {
    subToggle.addEventListener('click', function(e) {
        e.stopPropagation(); // باش ما يتسدش المنيو الكبير فاش تكليكي
        const subMenu = this.nextElementSibling;
        subMenu.classList.toggle('open');
        this.classList.toggle('active');
    });
});
    const closeDropdownBtn = document.getElementById('closeDropdownBtn');
closeDropdownBtn.addEventListener('click', function() {
    userDropdownContent.style.display = 'none';
});

const sidebar = document.querySelector('.sidebar');
const contentArea = document.querySelector('.content-area');
const toggleBtn = document.getElementById('sidebarToggle');

toggleBtn.addEventListener('click', () => {
    const isCollapsed = sidebar.classList.toggle('collapsed');
    contentArea.classList.toggle('collapsed');

    const icon = toggleBtn.querySelector('i');

    if (isCollapsed) {
        toggleBtn.style.left = '10px'; 
        icon.className = 'bx bx-chevron-right';
    } else {
        toggleBtn.style.left = '280px'; 
        icon.className = 'bx bx-chevron-left';
    }
});
const darkToggle = document.getElementById('darkModeToggle');
const body = document.body;

// Load mode from localStorage
if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark');
    darkToggle.innerHTML = "<i class='bx bx-sun'></i>";
}

darkToggle.addEventListener('click', () => {
    body.classList.toggle('dark');

    if (body.classList.contains('dark')) {
        localStorage.setItem('theme', 'dark');
        darkToggle.innerHTML = "<i class='bx bx-sun'></i>";
    } else {
        localStorage.setItem('theme', 'light');
        darkToggle.innerHTML = "<i class='bx bx-moon'></i>";
    }
});

</script>

</body>
</html>