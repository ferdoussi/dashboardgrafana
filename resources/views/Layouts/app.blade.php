<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Yokamos SOC')</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> --}}
    @stack('styles')
    <style>
/* ===============================
   SOC DASHBOARD – LIGHT STYLE
================================ */
body.dark {
    --bg-main: #26282f;
    --bg-header: #1d1f28;
    --bg-sidebar: #232531;

    --primary: #38bdf8;
    --primary-soft: rgba(56,189,248,0.15);

    --text-main: #e5e7eb;
    --text-muted: #94a3b8;

    --danger: #f87171;
}

/* Fix extra colors */
body.dark .header {
    border-bottom: 1px solid #1e293b;
}

body.dark .user-dropdown-content {
    background: #020617;
    border-color: #1e293b;
}

body.dark .dropdown-item:hover {
    background: rgba(56,189,248,0.15);
    color: var(--primary);
}

body.dark .content-area {
    background: var(--bg-main);
}

body.dark .sidebar {
    background: linear-gradient(180deg,#020617 0%, #020617 100%);
    box-shadow: 4px 0 25px rgba(0,0,0,0.6);
}

body.dark .sidebar-nav a:hover {
    background: rgba(255,255,255,0.08);
}

body.dark .line {
    background: linear-gradient(to right, transparent, rgba(255,255,255,0.15), transparent);
}
:root {
    --bg-main:  #f5f9ff;
    --bg-header: #ffffff;
    --bg-sidebar: #ffffff;

    --primary: #1970A1;
    --primary-soft: rgb(0, 75, 180);

    --text-main: #1f2937;
    --text-muted: #6b7280;

    --danger: #ef4444;

    --radius: 14px;
    --transition: 0.25s ease;
}

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', 'Segoe UI', sans-serif;
    background: var(--bg-main);
    color: var(--text-main);
    height: 100vh;
    overflow: hidden;
}

/* ===============================
   HEADER
================================ */

.header {
    height: 64px;
    background: var(--bg-header);
    border-bottom: 1px solid #e5e7eb;
    padding: 0 24px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}
.dark-mode {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: var(--text-main);
}
.logo {
    height: 45px;
}

/* ===============================
   USER DROPDOWN
================================ */

.user-dropdown-btn {
    background: var(--primary-soft);
    color: var(--primary);
    border: none;
    padding: 8px 16px;
    border-radius: 999px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    transition: var(--transition);
}

.user-dropdown-btn:hover {
    background: rgba(25,112,161,0.2);
}

.user-dropdown-content {
    display: none;
    position: absolute;
    right: 20px;
    top: 70px;
    width: 260px;

    background: white;
    border-radius: var(--radius);
    border: 1px solid #e5e7eb;

    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    overflow: hidden;
}

.user-info-header {
    background: linear-gradient(135deg, #4b4c4e, #4bb7f5);
    padding: 20px;
    text-align: center;
    color: white;
}

.user-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255,255,255,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin: 0 auto 10px;
}

.user-name {
    font-weight: 600;
}

.user-email {
    font-size: 13px;
    opacity: 0.9;
}

.dropdown-item {
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--text-main);
    text-decoration: none;
    transition: var(--transition);
}

.dropdown-item:hover {
    background: var(--primary-soft);
    color: var(--primary);
}

.logout-btn {
    width: 100%;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    border: none;
    padding: 12px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    margin: 10px 0;
}

/* ===============================
   SIDEBAR
================================ */

.sidebar {
    width: 260px;
    background: linear-gradient(
        180deg,
        #1970A1 0%,
        #4bb7f5 100%
    );
    color: #ffffff;

    position: fixed;
    top: 64px;
    bottom: 0;
    left: 0;

    padding: 20px 16px;
    overflow-y: auto;
    transition: 0.3s ease;

    box-shadow: 4px 0 25px rgba(25, 112, 161, 0.35);
    border-right: none;
}


.sidebar.collapsed {
    transform: translateX(-100%);
}

/* SCROLLBAR */
.sidebar::-webkit-scrollbar {
    width: 5px;
}
/* .sidebar::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
} */

/* CLIENT LOGO */
.client-logo {
    height: 90px;
    border-radius: 16px;
    background: #c6ced6;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
    border: 1px solid #99c8ed;
}

.client-logo img {
    max-height: 65px;
}

/* ===============================
   SIDEBAR MENU
================================ */

.sidebar-section {
    margin-bottom: 25px;
    top: 10px;
}

.sidebar-section h3 {
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: rgba(255,255,255,0.9);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
   
}
.sidebar-section:hover{
    cursor: pointer;
    color: #ffffff;
}

.sidebar-nav {
    list-style: none;
}

.sidebar-nav li {
    margin-bottom: 6px;
}

.sidebar-nav a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    border-radius: var(--radius);
    color: rgba(255,255,255,0.85);
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
}

.sidebar-nav a:hover {
        background: rgba(255,255,255,0.18);
        color: #ffffff;
        transform: translateX(4px);
}

/* ===============================
   DROPDOWN DASHBOARD
================================ */

.dropdown-menu-dashboard {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease;
    margin-left: 12px;
    border-left: 2px solid #e5e7eb;
    padding-left: 10px;
}

.dropdown-menu-dashboard.open {
    max-height: 500px;
}

/* SUBMENU */
.submenu-toggle {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    color: var(--text-muted);
    padding: 8px 10px;
    border-radius: 10px;
    transition: var(--transition);
}

.submenu-toggle:hover {
    background: #1f3a56;
    color: var(--primary);
}

.submenu-list {
    list-style: none;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    margin-left: 18px;
}

.submenu-list.open {
    max-height: 300px;
}

/* ===============================
   CONTENT AREA
================================ */

.content-area {
    margin-left: 260px;
    margin-top: 64px;
    padding: 24px;
    height: calc(100vh - 64px);
    overflow-y: auto;
    transition: var(--transition);
}

.content-area.collapsed {
    margin-left: 0;
}

/* ===============================
   SIDEBAR TOGGLE BUTTON
================================ */

/* حاوية الـ Switch */
.switch-container {
    display: flex;
    align-items: center;
    margin-right: 30px;
    margin-top: 20px;
}

/* نخبيو checkbox */
.sidebar-checkbox {
    display: none;
}

/* menu icon */
.menu-icon {
    font-size: 28px;
    cursor: pointer;
    color: #03a1f6; /* بدلها حسب اللون */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px;
    border-radius: 8px;
    transition: background 0.3s ease;
}

.menu-icon:hover {
    background: rgba(255, 255, 255, 0.1);
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 30px;
    position: relative;
}

.sidebar.collapsed + .sidebar-checkbox {
   transform: translateX(-100%);
}

/* ===============================
   RESPONSIVE
================================ */
.menu-toggle {
    display: none !important;
}
/* تنسيق الخط الفاصل في الـ Sidebar */
.line {
   
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.1), transparent);
    margin: 10px 5px;
    opacity: 0.5;
    width: 100%;
}

/* إضافة عنوان صغير اختياري تحت الخط باش ينظم الأقسام */
.sidebar-label {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #636e72;
    padding-left: 20px;
    margin-bottom: 10px;
    display: block;
    
}
.sidebar-link {
    text-decoration: none;
    display: block;
}
/* Right side of header */
.header-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

/* Dark mode button */
.dark-mode {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: var(--text-main);
    display: flex;
    align-items: center;
}

/* Close dropdown */
.close-dropdown {
    position: absolute;
    top: 10px;
    left: 10px;
    background: transparent;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: white;
}


@media (max-width: 768px) {
    /* Sidebar يتحرك خارج الشاشة */
    .sidebar {
        position: fixed;
        width: 100%;
        max-height: 60vh; /* أو حسب ما بغيت */
        top: 64px; /* تحت الهيدر */
        left: 0;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        z-index: 998;
    }

    /* ملي active يظهر */
    .sidebar.active {
        transform: translateX(0);
    }

    /* Content area كامل العرض */
    .content-area {
        margin-left: 0;
        padding: 20px;
    }

    /* Header أصغر شوي */
    .header {
        padding: 15px 20px;
        height: 60px;
    }

    /* User dropdown fixed */
    .user-dropdown-content {
        position: fixed;
        top: 60px; /* تحت الهيدر */
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 300px;
    }

    /* إزالة السهم في dropdown */
    .user-dropdown-content::before {
        display: none;
    }

    /* Menu toggle button: مخفي أو يظهر حسب اختيارك */
    .menu-toggle {
        display: flex; /* أو inline-flex حسب الحاجة */
        /* display: flex; */ /* أو تقدر تفعّلها باش يظهر فـ mobile */
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--primary);
        position: absolute;
        top: 18px;
        left: 15px;
        z-index: 1001;
    }

    /* Sidebar toggle button (إذا كاين) فوق المحتوى */
    .sidebar-checkbox {
        top: 70px; 
        left: 10px;
    }
}




    </style>
</head>
<body>

    <!-- HEADER - Fixed -->
    <div class="header">
        <div class="logo-container">
             
            <!-- Menu toggle for mobile -->
            <button class="menu-toggle">
                <i class='bx bx-menu'></i>
            </button>
            
            <img src="{{ asset('logo.png') }}" alt="Yokamos SOC" class="logo">
        <div class="switch-container">
        <input type="checkbox" id="sidebarToggle" class="sidebar-checkbox">
        <label for="sidebarToggle" class="menu-icon">
            <i class='bx bx-menu'></i>
        </label>

    </div>
        </div>
      
<div class="header-right">

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
                    <div class="user-email">{{ Auth::user()->email }}</div>
                @else
                    <div class="user-name">Verification 2FA</div>
                @endif
            </div>

            <div class="dropdown-divider"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class='bx bx-log-out'></i>
                    <span>Déconnexion</span>
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
                        <img src="{{ asset('assets/logos/' . $client . '.png') }}" alt="{{ $client }} logo" class="img">
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
        <h3><i class='bx bx-cog'></i> <span class="nav-text">Home Page</span></h3>
    </div>
    </a> 
    {{-- 1. User Section--}}
   
  @auth
    @if(auth()->user()->role === 'user')
        <div class="sidebar-section">
            <h3 class="dropdown-toggle">
                <i class='bx bx-lock-alt'></i>
                <span class="text">Dashboards</span>
                <i class='bx bx-chevron-down arrow'></i>
            </h3>
            <ul class="sidebar-nav dropdown-menu-dashboard">
                <li><a href="{{ route('dashboard.show', 'event') }}"><i class='bx bx-lock-alt'></i> Événements</a></li>
                <li><a href="{{ route('dashboard.show', 'offenses') }}"><i class='bx bx-shield-alt'></i> Offenses</a></li>
                <li><a href="{{ route('dashboard.show', 'rules') }}"><i class='bx bx-calendar-event'></i> Rules</a></li>
                <li><a href="{{ route('dashboard.show', 'sets') }}"><i class='bx bx-layer'></i> Sets</a></li>
                <li><a href="{{ route('dashboard.show', 'saved-search') }}"><i class='bx bx-search-alt-2'></i> Saved Search</a></li>
                <li><a href="{{ route('dashboard.show', 'offenses-map') }}"><i class='bx bx-map'></i> Offenses Map</a></li>
                @php
            // كنجيبو غير الـ Dashboards ديال المستخدم اللي داخل دابا
            $userDashboards = \App\Models\UserDashboard::where('user_id', auth()->id())
                                ->orderBy('created_at', 'desc')
                                ->get();
        @endphp

  @foreach($userDashboards as $dash)
    <li style="display: flex; justify-content: space-between; align-items: center; padding-right: 15px;">
        <a href="{{ route('dashboard.viewCustom', $dash->id) }}" style="flex: 1;">
            <i class='bx bx-layout'></i> {{ $dash->name }}
        </a>
        
        {{-- أيقونة المسح --}}
        <form action="{{ route('dashboard.delete', $dash->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce dashboard ?')">
            @csrf
            @method('DELETE')
            <button type="submit" style="background: none; border: none; color: #ff4d4d; cursor: pointer; padding: 5px;">
                <i class='bx bx-trash' style="font-size: 1.1em;"></i>
            </button>
        </form>
    </li>
@endforeach
            </ul>
        </div>
    @endif
@endauth


    {{-- 2. Admin Section --}}
{{-- 2. Admin Section --}}
@auth
    @if(auth()->user()->role === 'admin')
        <div class="sidebar-section">
            <h3 class="dropdown-toggle">
                <i class='bx bx-group'></i>
                <span class="text">Liste des Clients</span>
                <i class='bx bx-chevron-down arrow'></i>
            </h3>

            <ul class="sidebar-nav dropdown-menu-dashboard">
                @php
                    $all_users = \App\Models\Employee::where('role', 'user')->get();
                @endphp

                @forelse($all_users as $u)
                    <li class="has-submenu">
                        <div class="submenu-toggle">
                            <i class='bx bx-user'></i>
                            <span>{{ $u->name }}</span>
                            <i class='bx bx-chevron-right arrow-small'></i>
                        </div>

                        <ul class="submenu-list">
                            {{-- القائمة الثابتة --}}
                            <li><a href="{{ route('dashboard.show', ['type' => 'event', 'user_id' => $u->id]) }}"><i class='bx bx-lock-alt'></i>Événements</a></li>
                            <li><a href="{{ route('dashboard.show', ['type' => 'offenses', 'user_id' => $u->id]) }}"><i class='bx bx-shield-alt'></i>Offenses</a></li>
                            <li><a href="{{ route('dashboard.show', ['type' => 'rules', 'user_id' => $u->id]) }}"><i class='bx bx-calendar-event'></i>Rules</a></li>
                            <li><a href="{{ route('dashboard.show', ['type' => 'sets', 'user_id' => $u->id]) }}"><i class='bx bx-layer'></i> Sets</a></li>
                            <li><a href="{{ route('dashboard.show', ['type' => 'saved-search', 'user_id' => $u->id]) }}"><i class='bx bx-search-alt-2'></i>Saved Search</a></li>
                            <li><a href="{{ route('dashboard.show', ['type' => 'offenses-map', 'user_id' => $u->id]) }}"><i class='bx bx-map'></i>Offenses Map</a></li>
                            
                           
                            
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
                    <li style="padding: 10px; color: gray;">Aucun utilisateur trouvé</li>
                @endforelse
            </ul>
        </div>
    @endif
@endauth

    {{-- الأقسام المشتركة --}}
    <div class="sidebar-section">
        <h3><i class='bx bx-cog'></i> <span class="nav-text">Paramètres</span></h3>
    </div>
    @auth
    @if(auth()->user()->role === 'user')
    <div class="sidebar-section">
        <a href="{{ route('support.support') }}" class="sidebar-link" >
        <h3><i class='bx bx-help-circle'></i> <span class="nav-text">Aide & Support</span></h3>
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