<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Panel;

class PanelSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'sets' => [
                'Sécurité' => [
                    'Status Global'        => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-6&theme=light',
                    'Analyse de Risque'    => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-2&theme=light',
                    'Alertes Critiques'    => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-5&theme=light',
                    'Contrôle d\'Accès'    => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-3&theme=light',
                    'Flux de Données'      => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-4&theme=light',
                    'Résumé Exécutif'      => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-1&theme=light',
                ],
                'Informatique' => [
                    'Status Global'        => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-6&theme=light',
                    'Analyse de Risque'    => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-2&theme=light',
                    'Alertes Critiques'    => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-5&theme=light',
                    'Contrôle d\'Accès'    => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-3&theme=light',
                    'Flux de Données'      => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-4&theme=light',
                    'Résumé Exécutif'      => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-1&theme=light',
                ],
            ],

            'event' => [
                'Sécurité' => [
                    'sources totales' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-2',
                    'Événements Récents'     => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-5',
                    'Trafic Suspect'         => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-6',
                    'Tentatives Connexion'   => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-3',
                    'Logs de Sécurité'       => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-1',
                    'Alertes Système'        => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-7',
                    'Audit des Logs'         => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-4',
                ],
                'Informatique' => [
                     'sources totales' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-2',
                    'Événements Récents'     => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-5',
                    'Trafic Suspect'         => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-6',
                    'Tentatives Connexion'   => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-3',
                    'Logs de Sécurité'       => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-1',
                    'Alertes Système'        => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-7',
                    'Audit des Logs'         => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-4',
                ],
            ],

            'rules' => [
                'Sécurité' => [
                    'Règles Actives'         => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=2',
                    'Violations de Règles'   => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=3',
                    'Configuration Firewall' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=6',
                    'Politiques de Groupe'   => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=1',
                    'Exceptions'             => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=10',
                    'Alertes de Conformité'  => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=9',
                    'Modifications Récentes' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=7',
                    'Statistiques des Règles'=> 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=4',
                ],
            ],

            'saved-search' => [
                'Sécurité' => [
                    'Recherches Favorites'   => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=4',
                    'Filtres Personnalisés'  => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=2',
                    'Historique de Recherche' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=3',
                    'Rapports Sauvegardés'   => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=8',
                    'Indicateurs Clés (KPI)' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=5',
                    'Analyse de Tendances'   => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=6',
                    'Top Menaces'            => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=7',
                    'Vue d\'ensemble'         => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=1',
                ],
            ],

            'offenses' => [
                'Sécurité' => [
                    'Offenses Critiques'     => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=1',
                    'Incidents Ouverts'      => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=3',
                    'Gravité des Attaques'   => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=7',
                    'Cibles Fréquentes'      => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=5',
                    'Sources de Menaces'     => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=4',
                    'Réponse aux Incidents'  => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=9',
                    'Résumé des Offenses'    => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=2',
                ],
            ],

            'offenses-map' => [
                'Sécurité' => [
                    'Carte du Monde'         => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=4',
                    'Origine des Attaques'   => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=5',
                    'Localisation IP'        => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=6',
                    'Hotspots de Menaces'    => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=7',
                    'Trafic Géographique'    => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=1',
                    'Zones à Risque'         => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=3',
                ],
            ],
            'offenses-types' => [
                'Sécurité' => [
                    'Analyse par Type'       => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-4&theme=light',
                    'Distribution des Types' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-3&theme=light',
                    'Types de Menaces'       => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-5&theme=light',
                    'Classification Alertes' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-7&theme=light',
                    'Priorité des Offenses'  => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-2&theme=light',
                    'Top Catégories'         => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-6&theme=light',
                    'Résumé des Types'       => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-1&theme=light',
                ],
            ],

            'general-stats' => [
                'Sécurité' => [
                    'Vue Synthétique'        => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-5&theme=light',
                    'Indicateurs Temps Réel' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-4&theme=light',
                    'Monitoring Global'      => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-2&theme=light',
                    'Statistiques Hebdo'     => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-3&theme=light',
                    'Tableau de Bord New'    => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-1&theme=light',
                ],
            ],
        ];

        foreach ($data as $module => $categories) {
            foreach ($categories as $category => $panels) {
                foreach ($panels as $name => $url) {
                    Panel::create([
                        'module'      => $module,
                        'category'    => $category,
                        'name'        => $name,
                        'grafana_url' => $url,
                        'active'      => true,
                    ]);
                }
            }
        }
    }
}