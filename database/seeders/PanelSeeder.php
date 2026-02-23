<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Panel;
use App\Models\Employee;

class PanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'sets' => [
                'Number of reference sets dedicated to User' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-6&theme=light',
                'Indicators Type Distribution' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-2&theme=light',
                'Active Reference Sets' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-5&theme=light',
                'Total Indicators in System' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-3&theme=light',
                'Infrastructure Timeline (Creation Date vs Number of Elements)' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-4&theme=light',
                'Top Reference Sets by Volume' => 'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-1&theme=light',
            ],

            'event' => [
                'Total Sources' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-2',
                'Last Recorded Activity' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-5',
                'Overall Risk Level' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-6',
                'Breakdown by Owner' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-3',
                'Total Sources per Level' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-1',
                'the latest time-based sources' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-7',
                'Security Devices Breakdown' => 'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&panelId=panel-4',
            ],

            'rules' => [
                'Disabled Security Rules' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=2',
                'Total Admin Rules' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=3',
                'Security Offenses Count' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=6',
                'Active Security Rules' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=1',
                'Rules Status Overview' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=10',
                'Rule Analysis (Distinct vs Total)' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=9',
                'Rules Creation Timeline' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=7',
                'Total Rules per Type' => 'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=4',
            ],

            'saved-search' => [
                'System Searches' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=4',
                'Total Search Groups' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=2',
                'Admin-Created Searches' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=3',
                'System Load Status' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=8',
                'Groups Volume per Level' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=5',
                'Search Creation Timeline' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=6',
                'Owner-Level Correlation' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=7',
                'System vs Admin Searches' => 'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&panelId=1',
            ],

            'offenses' => [
                'Total Offenses' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=1',
                'Offenses Ouvertes (Actives)' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=3',
                'New Offenses Over Time' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=7',
                'Current Maximum Severity' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=5',
                'Top Offense Sources' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=4',
                'Most recent offenses' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=9',
                'Total Events' => 'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&panelId=2',
            ],

            'offenses-map' => [
                'Infractions ouvertes' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=4',
                'Importance critique' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=5',
                'Localisation IP' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=6',
                'Haute importance' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=7',
                'Threat Intelligence Map' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=1',
                'Inbound Network Attacks' => 'http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&panelId=3',
            ],

            'offenses-types' => [
                'Total Flow Types' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-4&theme=light',
                'Total Event Types' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-3&theme=light',
                'Security Alert Taxonomy' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-5&theme=light',
                'Custom vs Standard Offenses' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-7&theme=light',
                'Total Offense Types' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-2&theme=light',
                'Offense Distribution by Data Source' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-6&theme=light',
                'Summary of Types' => 'http://192.168.1.14:3000/d-solo/anxfd7c/type-offonses?orgId=1&panelId=panel-1&theme=light',
            ],

            'general-stats' => [
                'Total Admin entries' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-5&theme=light',
                'Reference Data Breakdown' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-4&theme=light',
                'Total Reference Entries' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-2&theme=light',
                'Admin Added' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-3&theme=light',
                'QRadar Reference Data Explorer' => 'http://192.168.1.14:3000/d-solo/anhnskj/new-dashboard?orgId=1&panelId=panel-1&theme=light',
            ],

            'log-sources' => [
                'Total Incoming EPS' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-7&theme=light',
                'EPS Load per Collector' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-8&theme=light',
                'Down Sources' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-14&theme=light',
                'Total Ingestion (EPS)' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-13&theme=light',
                'Sources in Error' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-6&theme=light',
                'EPS Distribution per Collector' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-9&theme=light',
            ],

            'network-activity' => [
                'Total Unique Groups' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-5&theme=light',
                'Network GroupsTotal Networks Distribution' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-4&theme=light',
                'Detailed Network Assets' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-3&theme=light',
                'Network Groups Distribution' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-2&theme=light',
            ],

            'events-retention' => [
                'Retention Periods by Bucket' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-12&theme=light',
                'Active Retention Policies' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-10&theme=light',
                'inActive Retention Policies' => 'http://192.168.1.14:3000/d-solo/anmg2wn/all-panles?orgId=1&panelId=panel-11&theme=light',
            ],
        ];

   // 🔹 نجيب جميع المستخدمين
        $users = Employee::all();

        foreach ($users as $user) {
            $clientId = $user->client_id;

            foreach ($data as $module => $panels) {
                foreach ($panels as $name => $url) {
                    Panel::updateOrCreate(
                        [
                            'grafana_url' => $url,
                            'client_id'   => $clientId,
                        ],
                        [
                            'module'   => $module,
                            'category' => 'General',
                            'name'     => $name,
                            'active'   => true,
                        ]
                    );
                    }
                }
            }
        }

}