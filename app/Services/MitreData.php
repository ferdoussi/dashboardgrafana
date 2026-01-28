<?php

namespace App\Services;

class MitreData {
    public static function getFullStructure() {
        return [
            'Reconnaissance' => [
                'T1595' => ['name' => 'Active Scanning', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1592' => ['name' => 'Gather Victim Info', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Resource Development' => [
                'T1583' => ['name' => 'Acquire Infrastructure', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1588' => ['name' => 'Obtain Capabilities', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Initial Access' => [
                'T1190' => ['name' => 'Exploit Public-Facing App', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1566' => ['name' => 'Phishing', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Execution' => [
                'T1059' => ['name' => 'Command & Scripting', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1204' => ['name' => 'User Execution', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Persistence' => [
                'T1098' => ['name' => 'Account Manipulation', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1547' => ['name' => 'Boot/Logon Autostart', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Privilege Escalation' => [
                'T1068' => ['name' => 'Exploitation for Privilege Escalation', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1548' => ['name' => 'Abuse Elevation Control', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Defense Evasion' => [
                'T1112' => ['name' => 'Modify Registry', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1070' => ['name' => 'Indicator Removal', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Credential Access' => [
                'T1110' => ['name' => 'Brute Force', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1003' => ['name' => 'OS Credential Dumping', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Discovery' => [
                'T1087' => ['name' => 'Account Discovery', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1046' => ['name' => 'Network Service Scanning', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Lateral Movement' => [
                'T1021' => ['name' => 'Remote Services', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1570' => ['name' => 'Lateral Tool Transfer', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Collection' => [
                'T1005' => ['name' => 'Data from Local System', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1074' => ['name' => 'Data Staged', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Command and Control' => [
                'T1071' => ['name' => 'Application Layer Protocol', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1105' => ['name' => 'Ingress Tool Transfer', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Exfiltration' => [
                'T1041' => ['name' => 'Exfiltration Over C2 Channel', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1048' => ['name' => 'Exfiltration Over Alternative Protocol', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
            'Impact' => [
                'T1486' => ['name' => 'Data Encrypted for Impact', 'count' => 0, 'severity' => 0, 'offenses' => []],
                'T1485' => ['name' => 'Data Destruction', 'count' => 0, 'severity' => 0, 'offenses' => []],
            ],
        ];
    }
}