<?php

namespace App\Services;

class MitreMapper
{
    public static function map(array $offense): ?array
    {
        $categories = $offense['categories'] ?? [];
        $allCats = strtolower(implode(' ', $categories));

        // Discovery: Network Sweep
        if (stripos($allCats, 'network sweep') !== false) {
            return ['tactic' => 'Discovery', 'technique_id' => 'T1046'];
        }

        // Reconnaissance: Firewall/ACL Deny
        if (stripos($allCats, 'firewall deny') !== false || stripos($allCats, 'acl deny') !== false) {
            return ['tactic' => 'Reconnaissance', 'technique_id' => 'T1592'];
        }

        return null;
    }
}