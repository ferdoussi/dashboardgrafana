<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Grafana</title>
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

       

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        
        }

        .logoForm {
            width: 160px;
            height: auto;
            user-select: none;
        }

        /* MENU PROFIL */
        .profile-menu {
            position: relative;
            display: inline-block;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(45deg, #0D3457, #1970A1);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(13, 52, 87, 0.3);
        }

        .profile-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(13, 52, 87, 0.4);
            background: linear-gradient(45deg, #1970A1, #0D3457);
        }

        .profile-btn i {
            font-size: 18px;
        }

        .profile-btn .user-name {
            font-size: 16px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            min-width: 200px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            overflow: hidden;
            margin-top: 10px;
            animation: fadeIn 0.3s ease;
        }

        .dropdown-menu.show {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            text-decoration: none;
            color: #333;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            color: #0D3457;
            padding-left: 25px;
        }

        .dropdown-item:last-child {
            border-bottom: none;
            color: #ff416c;
        }

        .dropdown-item:last-child:hover {
            background: #fff5f7;
        }

        .dropdown-item i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .dashboard-title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            text-align: center;
            font-size: 26px;
            color: #0D3457;
            font-weight: 600;
        }

        .dashboard-title i {
            color: #1970A1;
            font-size: 30px;
        }

        /* GRID PRINCIPALE */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-template-rows: repeat(5, 160px);
            gap: 20px;
            margin-top: 20px;
        }

        /* STYLES DES IFRAMES */
        .dashboard-grid iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: white;
        }

        .dashboard-grid iframe:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

       
        .div1 { grid-column: 1 / span 3; grid-row: 1 / span 1; }
        .div2 { grid-column: 4 / span 3; grid-row: 1 / span 1; }
        .div4 { grid-column: 7 / span 3; grid-row: 1 / span 1; }
        .div7 { grid-column: 10 / span 3; grid-row: 1 / span 1; }
        .div3 { grid-column: 1 / span 6; grid-row: 2 / span 2; }
        .div5 { grid-column: 7 / span 6; grid-row: 2 / span 2; }
        .div6 { grid-column: 1 / span 12; grid-row: 4 / span 2; }

        
        .widget-container {
            position: relative;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .widget-title {
            display: flex;
            align-items: center;
            gap: 10px;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(90deg, #f4fbffff, #f0f9ffff);
            color: #0D3457;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: 600;
            z-index: 10;
            border-radius: 12px 12px 0 0;
            border-bottom: 1px solid #e0f2ff;
        }

        .widget-title i {
            font-size: 16px;
            color: #1970A1;
        }

        /* VERSION RESPONSIVE */
        @media (max-width: 1600px) {
            .dashboard-grid { 
                grid-template-rows: repeat(5, 140px);
                gap: 15px;
            }
        }

        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: repeat(6, 1fr);
                grid-template-rows: repeat(8, 130px);
            }
            
            .div1, .div2, .div4, .div7 {
                grid-column: span 3;
                grid-row: auto;
            }
            
            .div1 { grid-column: 1 / span 3; grid-row: 1; }
            .div2 { grid-column: 4 / span 3; grid-row: 1; }
            .div4 { grid-column: 1 / span 3; grid-row: 2; }
            .div7 { grid-column: 4 / span 3; grid-row: 2; }
            
            .div3 { grid-column: 1 / span 6; grid-row: 3 / span 2; }
            .div5 { grid-column: 1 / span 6; grid-row: 5 / span 2; }
            .div6 { grid-column: 1 / span 6; grid-row: 7 / span 2; }
        }

        @media (max-width: 768px) {
            body { 
                padding: 15px; 
            }
            
            .header {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
                text-align: center;
            }

            .dashboard-title {
                font-size: 20px;
                flex-direction: column;
                gap: 8px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(7, 200px);
                gap: 15px;
            }

            .div1, .div2, .div3, .div4, .div5, .div6, .div7 {
                grid-column: 1;
                grid-row: auto;
            }
            
            .profile-menu {
                width: 100%;
            }
            
            .profile-btn {
                width: 100%;
                justify-content: center;
            }
            
            .dropdown-menu {
                width: 100%;
                right: auto;
                left: 0;
            }
        }

        /* ANIMATION DE CHARGEMENT */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }
    </style>
</head>
<body>
    <!-- EN-TÊTE -->
    <div class="header">
        {{-- <img class="logoForm" src="{{ asset('logo.png') }}" alt="Logo"> --}}
        
        <div class="profile-menu">
            
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="#" class="dropdown-item">
                    <i class='bx bx-user'></i>
                    <span>Mon Profil</span>
                </a>
              
                <div class="dropdown-separator" style="height: 1px; background: #f0f0f0;"></div>
                <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                    @csrf
                    <button type="submit" class="dropdown-item" style="background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                        <i class='bx bx-log-out'></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- DASHBOARD GRID -->
    <div class="dashboard-grid">
        <!-- Widget 1 - Total Offenses -->
        <div class="widget-container div1">
            <div class="widget-title">
                <i class='bx bx-bar-chart-alt-2'></i>
                Total Offenses
            </div>
            <iframe src="http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1765773121307&to=1765794721307&timezone=browser&theme=light&panelId=panel-1&__feature.dashboardSceneSolo=true"></iframe>
        </div>

        <!-- Widget 2 - Offenses Ouvertes -->
        <div class="widget-container div2">
            <div class="widget-title">
                <i class='bx bx-trending-up'></i>
                Offenses Ouvertes
            </div>
            <iframe src="http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1765530496414&to=1765552096414&timezone=browser&theme=light&panelId=panel-3&__feature.dashboardSceneSolo=true"></iframe>
        </div>

        <!-- Widget 4 - Alertes -->
        <div class="widget-container div4">
            <div class="widget-title">
                <i class='bx bx-bell'></i>
               Sévérité Maximale Actuelle
            </div>
            <iframe src="http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1765530496414&to=1765552096414&timezone=browser&theme=light&panelId=panel-5&__feature.dashboardSceneSolo=true"></iframe>
        </div>

        <!-- Widget 7 - Sécurité -->
        <div class="widget-container div7">
            <div class="widget-title">
                <i class='bx bx-lock-alt'></i>
                tentatives de connection
            </div>
            <iframe src="http://192.168.1.14:3000/d-solo/ad8598d/securite-des-tentatives-de-connexion?orgId=1&from=1765782560239&to=1765804160239&timezone=browser&showCategory=Value%20mappings&theme=light&panelId=panel-3&__feature.dashboardSceneSolo=true"></iframe>
        </div>

        <!-- Widget 3 - Carte -->
        <div class="widget-container div3">
            <div class="widget-title">
                <i class='bx bx-map'></i>
                Carte des Événements
            </div>
            <iframe src="http://192.168.1.14:3000/d-solo/advvt7n/dash?orgId=1&from=1765782863493&to=1765804463493&timezone=browser&theme=light&panelId=panel-1&__feature.dashboardSceneSolo=true"></iframe>
        </div>

        <!-- Widget 5 - Journal -->
        <div class="widget-container div5">
            <div class="widget-title">
                <i class='bx bx-book-content'></i>
                Journal des Événements
            </div>
            <iframe src="http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1765530496414&to=1765552096414&timezone=browser&theme=light&panelId=panel-4&__feature.dashboardSceneSolo=true"></iframe>
        </div>

        <!-- Widget 6 - Analyse Temporelle -->
        <div class="widget-container div6">
            <div class="widget-title">
                <i class='bx bx-time-five'></i>
                Analyse Temporelle
            </div>
            <iframe src="http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1765530496414&to=1765552096414&timezone=browser&theme=light&panelId=panel-7&__feature.dashboardSceneSolo=true"></iframe>
        </div>
    </div>

    <script>
        // Gestion du menu profil
        document.addEventListener('DOMContentLoaded', function() {
            const profileBtn = document.getElementById('profileBtn');
            const dropdownMenu = document.getElementById('dropdownMenu');
            
            // Ouvrir/fermer le menu au clic
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });
            
            // Fermer le menu en cliquant ailleurs
            document.addEventListener('click', function(e) {
                if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
            
            // Empêcher la fermeture quand on clique dans le menu
            dropdownMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
            
            // Animation de chargement des iframes
            const iframes = document.querySelectorAll('iframe');
            
            iframes.forEach(iframe => {
                iframe.classList.add('loading');
                
                iframe.onload = function() {
                    iframe.classList.remove('loading');
                };
                
                // Fallback si l'iframe ne charge pas
                setTimeout(() => {
                    iframe.classList.remove('loading');
                }, 5000);
            });
            
            // Ajouter un effet de survol sur les éléments du menu
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html>